$(document).ready(function () {
    $('#SupplyChainVideoBannerForm').on('submit', function (e) {
        e.preventDefault();
        // Clear previous error messages
        $('#error_video').text('');
        var formData = new FormData(this);
        $.ajax({
            url: frontend + "admin/save_supply_chain_banner_video",  // Adjust URL accordingly
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message,
                        timer: 1000,
                        timerProgressBar: true,
                        showConfirmButton: false
                    });
                    $('#SupplyChainVideoBannerForm')[0].reset();
                     // Reload the DataTable
                    SupplyChainVideoBannerTable.ajax.reload(null, false);
                } else if (response.status === 'error') {
                    $.each(response.errors, function (key, val) {
                        $('#error_' + key).text(val);
                    });
                }
            }
        });
    });
});

$(document).ready(function () {
    // Ensure 'frontend' variable is defined and points to your base URL
    if (typeof frontend === 'undefined') {
        console.error('The "frontend" variable is not defined.');
        return;
    }
    SupplyChainVideoBannerTable = $('#SupplyChainVideoBannerTable').DataTable({
        ajax: {
            url: frontend + "admin/get_supply_chain_banner_video_data",  // Adjust URL accordingly
            type: 'POST',
            dataSrc: function (json) {
                // Ensure the response is an array; adjust if your backend wraps data in an object
                if (Array.isArray(json)) {
                    return json;
                } else if (json.data) {
                    return json.data;
                } else {
                    console.error('Unexpected data format:', json);
                    return [];
                }
            }
        },
        columns: [
            {
                data: null,
                render: function (data, type, row, meta) {
                    return meta.row + 1;
                },
                title: 'Sr. No.',
                orderable: false
            },
            { data: 'title' },
            { data: 'sub_title' },
            { data: 'description' },
           { data: 'video', render: function (data) {
                var videoUrl = frontend + data;
                return `
                    <video width="100" height="70" controls>
                        <source src="${videoUrl}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                `;
            }},
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
        order: [[0, 'desc']],
        responsive: true
    });

    // Optional: Handle clicks for view/edit/delete
    $("#SupplyChainVideoBannerTable").on("click", ".view-btn", function (e) {
        e.preventDefault();
        const id = $(this).data("id");

        $.ajax({
            url: frontend + "admin/get_supply_chain_banner_video_details",
            type: "POST",
            dataType: "json",
            data: { id: id }, // send id in POST data
            success: function (response) {
                $("#view_title").text(response.data.title);
                $("#view_sub_title").text(response.data.sub_title);
                $("#view_description").text(response.data.description);
                if (response.data.video) {
                const imageUrl = frontend + response.data.video;
                $("#view_image").html(`
                    <video width="320" height="240" controls>
                        <source src="${imageUrl}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                `);
            } else {
                $("#view_image").html('');
            }
            $('#ViewModal').modal('show');
            },
            error: function () {
                $("#view_title").text("Error loading data");
                $("#view_description").text("Error loading data");
                $("#view_image").hide();
            },
        });
    });

    $("#SupplyChainVideoBannerTable").on("click", ".edit-btn", function (e) {
        e.preventDefault();
        const id = $(this).data("id");
        // Fetch details from server via POST
        $.ajax({
            url: frontend + "admin/get_supply_chain_banner_video_details",
            type: "POST",
            dataType: "json",
            data: { id: id }, // send id in POST data
            success: function (response) {
                    $("#edit_id").val(response.data.id);
                    $("#edit_title").val(response.data.title);
                    $("#edit_sub_title").val(response.data.sub_title);
                    $("#edit_description").val(response.data.description);
                    $("#edit_id").val(response.data.id);
                    $("#edit_previous_video").val(response.data.video); // Handle empty image case
                    if (response.data.video) {
                        const imageUrl = frontend + response.data.video;
                        $("#edit_video_preview").html(`
                            <video width="320" height="240" controls>
                                <source src="${imageUrl}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        `);
                    } else {
                        $("#edit_video_preview").html('');
                    }
                    $('#EditModal').modal('show');
                
            },
            error: function () {
                $("#edit_title").val("Error loading data");
                $("#edit_description").val("Error loading data");
                $("#edit_video_preview").html('');
            },
        });
    });
    // Delete action
	$("#SupplyChainVideoBannerTable").on("click", ".delete-btn", function (e) {
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
					url: frontend + "admin/delete_supply_chain_banner_video",
					type: "POST",
					data: { id: id },
					dataType: "json",
					success: function (response) {
						if (response.status) {
							Swal.fire("Deleted!", response.message, "success");
							SupplyChainVideoBannerTable.ajax.reload(null, false);
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

$('#EditSupplyChainVideoBannerForm').submit(function (e) {
    e.preventDefault();

    let formData = new FormData(this);
    // Clear previous errors
    $('#error_edit_video').text('');

    $.ajax({
        url: frontend + "admin/update_supply_chain_banner_video", // adjust to your route
        type: "POST",
        data: formData,
        dataType: "json",
        contentType: false,
        processData: false,
        success: function (response) {
            if (response.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: response.message,
                    timer: 1000,
                    timerProgressBar: true,
                    showConfirmButton: false
                });
                // Reset the form
                $('#EditSupplyChainVideoBannerForm')[0].reset();
                // Clear previous image preview
                $('#edit_video_preview').html('');
                // Reload the DataTable
                SupplyChainVideoBannerTable.ajax.reload(null, false);
                $('#EditModal').modal('hide');
                // Optional: refresh data table or show toast
            } else if (response.status === 'error') {
                // Show validation errors
                if (response.errors.image) {
                    $('#error_edit_image').text(response.errors.image);
                }
            }
        }
    });
});
