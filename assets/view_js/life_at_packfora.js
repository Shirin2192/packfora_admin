$(document).ready(function () {
    $('#LifeAtpackforaForm').on('submit', function (e) {
        e.preventDefault();
        // Clear previous error messages
        $('#error_video').text('');
        var formData = new FormData(this);
        $.ajax({
            url: frontend + "admin/save_life_at_packfora",  // Adjust URL accordingly
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
                    $('#LifeAtpackforaForm')[0].reset();
                     // Reload the DataTable
                    LifeAtpackforaTable.ajax.reload(null, false);
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
    LifeAtpackforaTable = $('#LifeAtpackforaTable').DataTable({
        ajax: {
            url: frontend + "admin/get_life_at_packfora_data",  // Adjust URL accordingly
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
            {
            data: 'image',
            title: 'Image',
            render: function (data) {
                if (data) {
                    const imageUrl = frontend + data;
                    return `<img src="${imageUrl}" alt="Thumbnail" width="70" height="50">`;
                } else {
                    return `<span class="text-muted">No Image</span>`;
                }
            },
            orderable: false
        },
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
   $("#LifeAtpackforaTable").on("click", ".view-btn", function (e) {
    e.preventDefault();
    const id = $(this).data("id");

    $.ajax({
        url: frontend + "admin/get_life_at_packfora_details",
        type: "POST",
        dataType: "json",
        data: { id: id }, // send id in POST data
        success: function (response) {
            if (response.data) {
                // Display video if exists
                if (response.data.video) {
                    const videoUrl = frontend + response.data.video;
                    $("#view_video").html(`
                        <video width="320" height="240" controls>
                            <source src="${videoUrl}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    `);
                } else {
                    $("#view_video").html('<span class="text-muted">No video uploaded</span>');
                }

                // Display image if exists
                if (response.data.image) {
                    const imageUrl = frontend + response.data.image;
                    $("#view_image").html(`
                        <img src="${imageUrl}" alt="Thumbnail" width="320" height="200" class="img-fluid" />
                    `);
                } else {
                    $("#view_image").html('<span class="text-muted">No image uploaded</span>');
                }

                // Show modal
                $('#ViewModal').modal('show');
            } else {
                $("#view_video").html('<span class="text-danger">Data not found.</span>');
                $("#view_image").html('');
            }
        },
        error: function () {
            $("#view_video").html('<span class="text-danger">Error loading video.</span>');
            $("#view_image").html('<span class="text-danger">Error loading image.</span>');
        }
    });
});


   $("#LifeAtpackforaTable").on("click", ".edit-btn", function (e) {
    e.preventDefault();
    const id = $(this).data("id");

    $.ajax({
        url: frontend + "admin/get_life_at_packfora_details",
        type: "POST",
        dataType: "json",
        data: { id: id },
        success: function (response) {
            if (response.data) {
                $("#edit_id").val(response.data.id);
                $("#edit_previous_video").val(response.data.video);
                $("#edit_previous_image").val(response.data.image); // Store previous image

                // Video Preview
                if (response.data.video) {
                    const videoUrl = frontend + response.data.video;
                    $("#edit_video_preview").html(`
                        <video width="320" height="240" controls>
                            <source src="${videoUrl}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    `);
                } else {
                    $("#edit_video_preview").html('<span class="text-muted">No video</span>');
                }

                // Image Preview
                if (response.data.image) {
                    const imageUrl = frontend + response.data.image;
                    $("#edit_image_preview").html(`
                        <img src="${imageUrl}" alt="Thumbnail" width="150" class="img-fluid border rounded" />
                    `);
                } else {
                    $("#edit_image_preview").html('<span class="text-muted">No image</span>');
                }

                $('#EditModal').modal('show');
            }
        },
        error: function () {
            $("#edit_video_preview").html('');
            $("#edit_image_preview").html('');
        }
    });
});

    // Delete action
	$("#LifeAtpackforaTable").on("click", ".delete-btn", function (e) {
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
					url: frontend + "admin/delete_life_at_packfora",
					type: "POST",
					data: { id: id },
					dataType: "json",
					success: function (response) {
						if (response.status) {
							Swal.fire("Deleted!", response.message, "success");
							LifeAtpackforaTable.ajax.reload(null, false);
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

$('#EditLifeAtpackforaForm').submit(function (e) {
    e.preventDefault();

    let formData = new FormData(this);
    // Clear previous errors
    $('#error_edit_video').text('');

    $.ajax({
        url: frontend + "admin/update_life_at_packfora", // adjust to your route
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
                $('#EditLifeAtpackforaForm')[0].reset();
                // Clear previous image preview
                $('#edit_video_preview').html('');
                // Reload the DataTable
                LifeAtpackforaTable.ajax.reload(null, false);
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
