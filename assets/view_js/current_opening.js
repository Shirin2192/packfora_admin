$(document).ready(function () {
	$("#CurrentOpeningForm").on("submit", function (e) {
		e.preventDefault();

		// Clear and show all error containers
		$(".text-danger").text("").show();

		var formData = new FormData(this);

		$.ajax({
			url: frontend + "admin/save_current_opening",
			type: "POST",
			data: formData,
			processData: false,
			contentType: false,
			dataType: "json",
			success: function (response) {
				if (response.status === true) {
					Swal.fire({
						icon: "success",
						title: "Success!",
						text: response.message,
						timer: 1000, // auto close after 3 seconds
						timerProgressBar: true,
						showConfirmButton: false, // hides the OK button
						willClose: () => {
							$("#CurrentOpeningForm")[0].reset();
							$(".text-danger").text("").show(); // Reset error containers
							currentOpeningTable.ajax.reload(); // Reload the DataTable
						},
					});
				} else if (response.errors) {
					// Show individual errors and hide after delay
					$.each(response.errors, function (field, message) {
						$("#error_" + field)
							.html(message)
							.fadeIn();
						setTimeout(() => {
							$("#error_" + field).fadeOut();
						}, 4000);
					});
				} else {
					Swal.fire({
						icon: "error",
						title: "Oops!",
						text: "An unknown error occurred. Please try again.",
					});
				}
			},
			error: function () {
				Swal.fire({
					icon: "error",
					title: "Server Error",
					text: "Please contact support.",
				});
			},
		});
	});
});
$(document).ready(function () {
	let currentOpeningTable = $("#CurrentOpeningTable").DataTable({
		ajax: frontend + "admin/get_current_openings",
		processing: true,
		serverSide: false, // ⛔ Turn OFF server-side processing
		columns: [
			{
				data: null,
				render: function (data, type, row, meta) {
					return meta.row + 1;
				},
				orderable: false,
			},
			{ data: "title" },
			{ data: "location" },
			{ data: "description" },
			{
				data: null,
				orderable: false,
				render: function (data, type, row) {
					return `
                        <a href="#" class="view-btn" data-id="${row.id}" title="View">
                            <i class="fas fa-eye text-info "></i>
                        </a>
                        <a href="#" class="edit-btn" data-id="${row.id}" title="Edit">
                            <i class="fas fa-edit text-warning "></i>
                        </a>
                        <a href="#" class="delete-btn" data-id="${row.id}" title="Delete">
                            <i class="fas fa-trash-alt text-danger"></i>
                        </a>
                    `;
				},
			},
		],
	});

	// Optional: Handle clicks for view/edit/delete
	$("#CurrentOpeningTable").on("click", ".view-btn", function (e) {
		e.preventDefault();
		const id = $(this).data("id");

		// Optional: Show loading text
		$("#view_title").text("Loading...");
		$("#view_location").text("Loading...");
		$("#view_description").text("Loading...");		

		// Fetch details from server via POST
		$.ajax({
			url: frontend + "admin/get_current_opening_detail",
			type: "POST",
			dataType: "json",
			data: { id: id }, // send id in POST data
			success: function (response) {				
                $("#view_title").text(response.data.title);
                $("#view_location").text(response.data.location);
                $("#view_description").text(response.data.description);
                $('#ViewModal').modal('show');
			},
			error: function () {
				$("#view_title").text("Error loading data");
				$("#view_location").text("Error loading data");
				$("#view_description").text("Error loading data");
			},
		});
	});

	$("#CurrentOpeningTable").on("click", ".edit-btn", function (e) {
		e.preventDefault();
		const id = $(this).data("id");

		// Fetch details from server via POST
		$.ajax({
			url: frontend + "admin/get_current_opening_detail",
			type: "POST",
			dataType: "json",
			data: { id: id }, // send id in POST data
			success: function (response) {				
                $("#edit_title").val(response.data.title);
                $('#edit_id').val(response.data.id);
                $("#edit_location").val(response.data.location);
                $("#edit_description").val(response.data.description);
                $('#EditModal').modal('show');
			},
			error: function () {
				$("#edit_title").val("Error loading data");
				$("#edit_location").val("Error loading data");
				$("#edit_description").val("Error loading data");
			},
		});
	});

	$("#CurrentOpeningTable").on("click", ".delete-btn", function () {
    const id = $(this).data("id");

    Swal.fire({
        title: 'Are you sure?',
        text: "You are about to delete this record!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Perform AJAX delete
            $.ajax({
                url: frontend + 'admin/delete_current_opening',
                type: 'POST',
                data: { id: id },
                dataType: 'json',
                success: function (response) {
                    if (response.status) {
                        Swal.fire(
                            'Deleted!',
                            response.message,
                            'success'
                        );
                        $('#CurrentOpeningTable').DataTable().ajax.reload(null, false); // Reload table
                    } else {
                        Swal.fire('Error', response.message || 'Unable to delete', 'error');
                    }
                },
                error: function () {
                    Swal.fire('Error', 'Server error, please try again later', 'error');
                }
            });
        }
    });
});

});
$("#EditCurrentOpeningForm").on("submit", function (e) {
		e.preventDefault();

		// Clear and show all error containers
		$(".text-danger").text("").show();

		var formData = new FormData(this);
		$.ajax({
			url: frontend + "admin/update_current_opening",
			type: "POST",
			data: formData,
			processData: false,
			contentType: false,
			dataType: "json",
			success: function (response) {
				if (response.status === true) {
                     $('#EditModal').modal('hide');
					Swal.fire({
						icon: "success",
						title: "Success!",
						text: response.message,
						timer: 1000, // auto close after 3 seconds
						timerProgressBar: true,
						showConfirmButton: false, // hides the OK button
						willClose: () => {
							$("#EditCurrentOpeningForm")[0].reset();
							$(".text-danger").text("").show(); // Reset error containers
							
                            $('#CurrentOpeningTable').DataTable().ajax.reload(null, false); 
						},
					});
				} else if (response.errors) {
					// Show individual errors and hide after delay
					$.each(response.errors, function (field, message) {
						$("#error_" + field)
							.html(message)
							.fadeIn();
						setTimeout(() => {
							$("#error_" + field).fadeOut();
						}, 4000);
					});
				} else {
					Swal.fire({
						icon: "error",
						title: "Oops!",
						text: "An unknown error occurred. Please try again.",
					});
				}
			},
			error: function () {
				Swal.fire({
					icon: "error",
					title: "Server Error",
					text: "Please contact support.",
				});
			},
		});
	});