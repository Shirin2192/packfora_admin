 document.addEventListener('DOMContentLoaded', function () {
        const titleInput = document.getElementById('title');
        const slugInput = document.getElementById('slug');

        titleInput.addEventListener('keyup', function () {
            let slug = this.value
                .toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');
            slugInput.value = slug;
        });
    });

      document.addEventListener('DOMContentLoaded', function () {
        const titleInput = document.getElementById('edit_title');
        const slugInput = document.getElementById('edit_slug');

        titleInput.addEventListener('keyup', function () {
            let slug = this.value
                .toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');
            slugInput.value = slug;
        });
    });
CKEDITOR.replace('content');
CKEDITOR.replace('edit_content');
// ClassicEditor
//     .create(document.querySelector("#content"))
//     .then(editor => {
//         editorInstance = editor;
//     })
//     .catch(error => {
//         console.error(error);
//     });

   let editContentEditor;

// ClassicEditor
// .create(document.querySelector('#edit_content'))
//     .then(editor => {
//         editContentEditor = editor;
//     })
//     .catch(error => {
//         console.error(error);
//     });
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

          $.ajax({
            url: frontend + "admin/get_blogs_details",
            type: "POST",
            dataType: "json",
            data: { id: id },
            success: function (response) {
            
                const data = response.data;
                $("#edit_id").val(data.id);
                $("#edit_title").val(data.title);
                $("#edit_slug").val(data.slug);
                $("#edit_summary").val(data.summary);
                $("#edit_read_time").val(data.read_time);
                $("#edit_publish_date").val(data.publish_date);
                $("#current_image").val(data.image);
                // if (editContentEditor) {
                  // editContentEditor.setData(data.content);
                CKEDITOR.instances['edit_content'].setData(data.content);
                // }

                // $("#edit_previous_image").val(data.image);
                if (data.image) {
                  const imageUrl = frontend + data.image;
                  $("#preview_edit_image").html(`<img src="${imageUrl}" class="img-fluid" style="max-height: 150px;">`);
                } else {
                  $("#preview_edit_image").html('');
                }

                $("#editBlogModal").modal("show");            
            },
            error: function () {
              alert("An error occurred while loading blog details.");
            }
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
$("#EditBlogForm").submit(function (e) {
    e.preventDefault();

    // Clear previous error messages
    $(".text-danger").html("");

    // Get CKEditor content manually
    let contentData = CKEDITOR.instances.edit_content.getData();
    // Set it back into textarea before FormData reads it
    $("#edit_content").val(contentData);

    // Prepare FormData
    let formData = new FormData(this);

    $.ajax({
        url: frontend + "admin/update_blogs", // Replace with your update endpoint
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (response) {
            if (response.status === "success") {
                $("#editBlogModal").modal("hide");
                Swal.fire("Success", response.message, "success");
                $("#BlogsTable").DataTable().ajax.reload(); // Reload DataTable
            } else if (response.status === "error") {
                // Show validation errors
                if (response.errors.title) {
                    $("#error_title").html(response.errors.title);
                }
                if (response.errors.edit_slug) {
                    $("#error_slug").html(response.errors.edit_slug);
                }
                if (response.errors.edit_summary) {
                    $("#error_summary").html(response.errors.edit_summary);
                }
                if (response.errors.edit_read_time) {
                    $("#error_read_time").html(response.errors.edit_read_time);
                }
                if (response.errors.edit_publish_date) {
                    $("#error_publish_date").html(response.errors.edit_publish_date);
                }
                if (response.errors.edit_image) {
                    $("#error_image").html(response.errors.edit_image);
                }
                if (response.errors.edit_content) {
                    $("#error_edit_content").html(response.errors.edit_content);
                }
            }
        },
        error: function () {
            Swal.fire("Error", "Something went wrong while updating blog.", "error");
        }
    });
});



