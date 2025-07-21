ClassicEditor
    .create(document.querySelector("#content"))
    .then(editor => {
        editorInstance = editor;
    })
    .catch(error => {
        console.error(error);
    });

    ClassicEditor
    .create(document.querySelector("#edit_content"))
    .then(editor => {
        editorInstance = editor;
    })
    .catch(error => {
        console.error(error);
    });
$('#BlogsForm').on('submit', function (e) {
    e.preventDefault();

    let formData = new FormData(this);

    // Clear old errors
    $('small.text-danger').text('').show(); // show in case previously faded out

    $.ajax({
        url: frontend + "admin/save_blogs",
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function (response) {
            if (response.status === true) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: response.message,
                    timer: 1000,
                    timerProgressBar: true,
                    showConfirmButton: false
                });
                $('#BlogsForm')[0].reset();
                BlogsTable.ajax.reload(null, false);
            } else {
                // Show validation errors
                $.each(response.errors, function (key, val) {
                    $('#error_' + key).text(val).show();

                    // Set timeout to clear each error message after 3s
                    setTimeout(function () {
                        $('#error_' + key).fadeOut('slow', function () {
                            $(this).text('').show(); // reset text and keep element visible for next time
                        });
                    }, 3000);
                });
            }
        },
        error: function () {
            Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: 'Something went wrong. Please try again.',
            });
        }
    });
});


$(document).ready(function () {
    // Ensure 'frontend' variable is defined and points to your base URL
    if (typeof frontend === 'undefined') {
        console.error('The "frontend" variable is not defined.');
        return;
    }
    BlogsTable = $('#BlogsTable').DataTable({
        ajax: {
            url: frontend + "admin/get_blogs_data",  // Adjust URL accordingly
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
            { data: 'summary' },
            { data: 'image', render: function (data) {
                // Ensure 'frontend' ends with a slash if needed
                var imageUrl = frontend + data;
                return `<img src="${imageUrl}" alt="Image" style="width: 50px; height: 50px;">`;
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
 $("#BlogsTable").on("click", ".view-btn", function (e) {
    e.preventDefault();
    const id = $(this).data("id");

    $.ajax({
        url: frontend + "admin/get_blogs_details",
        type: "POST",
        dataType: "json",
        data: { id: id },
        success: function (response) {
            if (response.data) {
                const blog = response.data;

                $("#view_title").text(blog.title || "N/A");
                $("#view_summary").text(blog.summary || "N/A");
                $("#view_content").html(blog.content || "N/A");
                $("#view_slug").text(blog.slug || "N/A");
                $("#view_publish_date").text(blog.publish_date || "N/A");
                $("#view_read_time").text(blog.read_time || "N/A");

                if (blog.image) {
                    const blogimageUrl = frontend + blog.image;
                    $("#view_image").html(
                        '<img src="' + blogimageUrl + '" class="img-fluid" style="max-height: 150px;">'
                    );
                } else {
                    $("#view_image").html('<span>No image</span>');
                }

                $('#viewBlogModal').modal('show');
            } else {
                alert("Blog details not found.");
            }
        },
        error: function () {
            alert("Error loading blog details.");
        }
    });
});


    $("#BlogsTable").on("click", ".edit-btn", function (e) {
        e.preventDefault();
        const id = $(this).data("id");
        // Fetch details from server via POST
        $.ajax({
            url: frontend + "admin/get_blogs_details",
            type: "POST",
            dataType: "json",
            data: { id: id }, // send id in POST data
            success: function (response) {
                    $("#edit_id").val(response.data.id);
                    $("#edit_title").val(response.data.title);
                    $('#edit_id').val(response.data.id);
                    $("#edit_description").val(response.data.description);
                    $("#edit_previous_image").val(response.data.image); // Handle empty image case
                    if (response.data.image) {
                        const imageUrl = frontend + response.data.image;
                        $("#edit_image_preview").html('<img src="' + imageUrl + '" class="img-fluid" style="max-height: 150px;">');
                    } else {
                        $("#edit_image_preview").html('');
                    }
                    $('#editBlogModal').modal('show');
                
            },
            error: function () {
                $("#edit_title").val("Error loading data");
                $("#edit_description").val("Error loading data");
                $("#edit_image_preview").html('');
            },
        });
    });
    // Delete action
	$("#BlogsTable").on("click", ".delete-btn", function (e) {
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
					url: frontend + "admin/delete_blogs",
					type: "POST",
					data: { id: id },
					dataType: "json",
					success: function (response) {
						if (response.status) {
							Swal.fire("Deleted!", response.message, "success");
							BlogsTable.ajax.reload(null, false);
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

// $('#EditBlogsForm').submit(function (e) {
//     e.preventDefault();

//     let formData = new FormData(this);
//     // Clear previous errors
//     $('#error_edit_title, #error_edit_description, #error_edit_image').text('');

//     $.ajax({
//         url: frontend + "admin/update_blogs", // adjust to your route
//         type: "POST",
//         data: formData,
//         dataType: "json",
//         contentType: false,
//         processData: false,
//         success: function (response) {
//             if (response.status === 'success') {
//                 Swal.fire({
//                     icon: 'success',
//                     title: 'Success!',
//                     text: response.message,
//                     timer: 1000,
//                     timerProgressBar: true,
//                     showConfirmButton: false
//                 });
//                 // Reset the form
//                 $('#EditBlogsForm')[0].reset();
//                 // Clear previous image preview
//                 $('#edit_image_preview').html('');
//                 // Reload the DataTable
//                 BlogsTable.ajax.reload(null, false);
//                 $('#EditModal').modal('hide');
//                 // Optional: refresh data table or show toast
//             } else if (response.status === 'error') {
//                 // Show validation errors
//                 if (response.errors.title) {
//                     $('#error_edit_title').text(response.errors.title);
//                 }
//                 if (response.errors.description) {
//                     $('#error_edit_description').text(response.errors.description);
//                 }
//                 if (response.errors.image) {
//                     $('#error_edit_image').text(response.errors.image);
//                 }
//             }
//         }
//     });
// });
