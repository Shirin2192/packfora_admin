$(document).ready(function () {
    $('#SliderForm').on('submit', function (e) {
        e.preventDefault();

        // Clear previous error messages
        $('.text-danger').text('');

        var formData = new FormData(this);

        $.ajax({
            url: frontend + "admin/save_slider",
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    alert('Slider saved successfully!');
                    $('#SliderForm')[0].reset();
                    $('.file-upload-info').val('');
                } else if (response.status === 'error' && response.errors) {
                    if (response.errors.title) {
                        $('#error_title').html(response.errors.title);
                    }
                    if (response.errors.subtitle) {
                        $('#error_subtitle').html(response.errors.subtitle);
                    }
                    if (response.errors.button_text) {
                        $('#error_button_text').html(response.errors.button_text);
                    }
                    if (response.errors.button_link) {
                        $('#error_button_link').html(response.errors.button_link);
                    }
                    if (response.errors.slide_order) {
                        $('#error_slide_order').html(response.errors.slide_order);
                    }
                    if (response.errors.image) {
                        $('#error_img').html(response.errors.image);
                    }
                } else {
                    alert('Something went wrong. Please try again.');
                }
            },
            error: function () {
                alert('Server error. Please contact support.');
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

    SliderTable = $('#SliderTable').DataTable({
        ajax: {
            url: frontend + "admin/get_slider_data",  // Adjust URL accordingly
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
            { data: 'subtitle' },              
            { data: 'image', render: function (data) {
                // Ensure 'frontend' ends with a slash if needed
                var imageUrl = frontend + data;
                return `<img src="${imageUrl}" alt="Image" style="width: 50px; height: 50px; background-color:#5555; ">`;
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
                        <a href="#" class="delete-btn" data-id="${row.id}" title="Delete">                           <i class="fas fa-trash-alt text-danger"></i>
                         </a>`;
				},
			},
        ],
        order: [[0, 'desc']],
        responsive: true
    });
// 
    // Optional: Handle clicks for view/edit/delete
    $("#SliderTable").on("click", ".view-btn", function (e) {
        e.preventDefault();
        const id = $(this).data("id");

        $.ajax({
            url: frontend + "admin/get_slider_details",
            type: "POST",
            dataType: "json",
            data: { id: id }, // send id in POST data
            success: function (response) {               
                $("#view_title").text(response.data.title);                 
                $("#view_subtitle").text(response.data.subtitle);                 
                $("#view_button_text").text(response.data.button_text);                 
                $("#view_button_link").text(response.data.button_link);                 
                if (response.data.image) {
                const imageUrl = frontend + response.data.image;
                $("#view_image").html('<img src="' + imageUrl + '" class="img-fluid" style="max-height: 150px; background-color:#5555;">');
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

    $("#SliderTable").on("click", ".edit-btn", function (e) {
        e.preventDefault();
        const id = $(this).data("id");
        // Fetch details from server via POST
        $.ajax({
            url: frontend + "admin/get_slider_details",
            type: "POST",
            dataType: "json",
            data: { id: id }, // send id in POST data
            success: function (response) {
                    $("#edit_id").val(response.data.id);
                    $("#edit_title").val(response.data.title);                 
                    $("#edit_subtitle").val(response.data.subtitle);                 
                    $("#edit_button_text").val(response.data.button_text);                 
                    $("#edit_button_link").val(response.data.button_link);  
                    $("#edit_slide_order").val(response.data.slide_order);  
                    $("#edit_previous_image").val(response.data.image); // Handle empty image case
                    if (response.data.image) {
                        const imageUrl = frontend + response.data.image;
                        $("#edit_image_preview").html('<img src="' + imageUrl + '" class="img-fluid" style="max-height: 150px; background-color:#5555;">');
                    } else {
                        $("#edit_image_preview").html('');
                    }
                    $('#EditModal').modal('show');
                
            },
            error: function () {
                $("#edit_title").val("Error loading data");
                $("#edit_description").val("Error loading data");
                $("#edit_image_preview").html('');
            },
        });
    });
    // Delete action
	$("#SliderTable").on("click", ".delete-btn", function (e) {
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
					url: frontend + "admin/delete_slider",
					type: "POST",
					data: { id: id },
					dataType: "json",
					success: function (response) {
						if (response.status) {
							Swal.fire("Deleted!", response.message, "success");
							SliderTable.ajax.reload(null, false);
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
$('#EditSliderForm').submit(function (e) {
    e.preventDefault();

    let formData = new FormData(this);
    // Clear previous errors
    $('#error_edit_subtitle, #error_edit_button_text, #error_edit_image, #error_edit_title, #error_edit_button_link').text('');

    $.ajax({
        url: frontend + "admin/update_slider", // adjust to your route
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
                $('#EditSliderForm')[0].reset();
                // Clear previous image preview
                $('#edit_image_preview').html('');
                // Reload the DataTable
                SliderTable.ajax.reload(null, false);
                $('#EditModal').modal('hide');
                // Optional: refresh data table or show toast
            } else if (response.status === 'error') {
                // Show validation errors
               if (response.errors.title) {
                        $('#error_edit_title').html(response.errors.title);
                    }
                    if (response.errors.subtitle) {
                        $('#error_edit_subtitle').html(response.errors.subtitle);
                    }
                    if (response.errors.button_text) {
                        $('#error_edit_button_text').html(response.errors.button_text);
                    }
                    if (response.errors.button_link) {
                        $('#error_edit_button_link').html(response.errors.button_link);
                    }
                    if (response.errors.slide_order) {
                        $('#error_edit_slide_order').html(response.errors.slide_order);
                    }
                if (response.errors.image) {
                    $('#error_edit_image').text(response.errors.image);
                }
            }
        }
    });
});