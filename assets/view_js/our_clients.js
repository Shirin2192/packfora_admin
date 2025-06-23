$("#OurClientForm").on("submit", function (e) {
	e.preventDefault();

	var formData = new FormData(this);

	$.ajax({
		url: frontend + "admin/upload_client_image", // Update as necessary
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,
		dataType: "json",
		beforeSend: function () {
			// Clear previous error
			$("#error_img").text("").hide();
		},
		success: function (response) {
			if (response.status) {
				Swal.fire({
					icon: "success",
					title: "Success!",
					text: response.message,
					timer: 1000,
					timerProgressBar: true,
					showConfirmButton: false,
					willClose: () => {
						$("#OurClientForm")[0].reset();
						$(".text-danger").text("").hide();
						table.ajax.reload();
					},
				});
				location.reload();
			} else {
				// Clear existing error first
				$("#error_img").text("").hide();

				// Display returned error message below file input
				if (response.message) {
					$("#error_img").text(response.message).fadeIn();
					setTimeout(() => {
						$("#error_img").fadeOut();
					}, 4000);
				}
			}
		},
		error: function () {
			$("#error_img").html("Something went wrong while uploading.").fadeIn();
			setTimeout(() => {
				$("#error_img").fadeOut();
			}, 4000);
		},
	});
});
$(document).ready(function () {
	const table = $("#ClientImageTable").DataTable({
		ajax: frontend + "admin/get_clients_data", // your API route
		processing: true,
		serverSide: false,
		columns: [
			{
				data: null,
				render: (data, type, row, meta) => meta.row + 1,
				orderable: false,
			},
			{
				data: "image",
				render: function (data) {
					var imageUrl = frontend + data;
					return `<img src="${imageUrl}" alt="Client" style="height: 40px; width: auto;">`;
				},
				orderable: false,
			},
			{
				data: null,
				orderable: false,
				render: function (data, type, row) {
					return `
                        <a href="#" class="delete-btn" data-id="${row.id}" title="Delete">
                            <i class="fas fa-trash-alt text-danger"></i>
                        </a>
					`;
				},
			},
		],
	});
	 // <a href="#" class="view-btn" data-id="${row.id}" title="View">
     //                        <i class="fas fa-eye text-info "></i>
     //                    </a>
     //                    <a href="#" class="edit-btn" data-id="${row.id}" title="Edit">
     //                        <i class="fas fa-edit text-warning "></i>
     //                    </a>
	$("#ClientImageTable").on("click", ".view-btn", function (e) {
        e.preventDefault();
        const id = $(this).data("id");
        $.ajax({
            url: frontend + "admin/get_clients_details",
            type: "POST",
            dataType: "json",
            data: { id: id }, // send id in POST data
            success: function (response) {
                if (response.data.image) {
                	const imageUrl = response.data.image;
                $("#view_image").html('<img src="' + imageUrl + '" class="img-fluid" style="max-height: 150px;">');
            } else {
                $("#view_image").html('');
            }
            $('#ViewModal').modal('show');
            },
            error: function () {
                $("#view_title").text("Error loading data");
                $("#view_date").text("Error loading data");
                $("#view_image").hide();
            },
        });
    });
    $("#ClientImageTable").on("click", ".edit-btn", function (e) {
        e.preventDefault();
        const id = $(this).data("id");
        // Fetch details from server via POST
        $.ajax({
            url: frontend + "admin/get_clients_details",
            type: "POST",
            dataType: "json",
            data: { id: id }, // send id in POST data
            success: function (response) {
                    $("#edit_id").val(response.data.id);
                    $("#edit_previous_image").val(response.data.image); // Handle empty image case
                    if (response.data.image) {
                        const imageUrl = frontend + response.data.image;
                        $("#edit_image_preview").html('<img src="' + imageUrl + '" class="img-fluid" style="max-height: 150px;">');
                    } else {
                        $("#edit_image_preview").html('');
                    }
                    $('#EditModal').modal('show');                
            },
            error: function () {
                $("#edit_title").val("Error loading data");
                $("#edit_date").val("Error loading data");
                $("#edit_image_preview").html('');
            },
        });
    });
	// Delete action
	$("#ClientImageTable").on("click", ".delete-btn", function (e) {
		e.preventDefault();
		const id = $(this).data("id");
		Swal.fire({
			title: "Are you sure?",
			text: "This image will be deleted!",
			icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#d33",
			cancelButtonColor: "#6c757d",
			confirmButtonText: "Yes, delete it!",
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: frontend + "admin/delete_clients_image",
					type: "POST",
					data: { id: id },
					dataType: "json",
					success: function (response) {
						if (response.status) {
							Swal.fire("Deleted!", response.message, "success");
							table.ajax.reload(null, false);
						} else {
							Swal.fire("Error", response.message, "error");
						}
					},
					error: function () {
						Swal.fire("Error", "Server error, please try again", "error");
					},
				});
			}
		});
	});
});
