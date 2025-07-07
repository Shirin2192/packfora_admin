$(document).ready(function () {
    $('#CaseStudyForm').on('submit', function (e) {
        e.preventDefault();
        // Clear previous error messages
        $('#error_link, #error_description, #error_image').text('');
        var formData = new FormData(this);
        $.ajax({
            url: frontend + "admin/save_case_study",  // Adjust URL accordingly
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
                    $('#CaseStudyForm')[0].reset();
                     // Reload the DataTable
                    CaseSṭudyTable.ajax.reload(null, false);
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

    CaseSṭudyTable = $('#CaseSṭudyTable').DataTable({
        ajax: {
            url: frontend + "admin/get_case_study_data",  // Adjust URL accordingly
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
            { data: 'image', 
                render: function (data) {
                // Ensure 'frontend' ends with a slash if needed
                var imageUrl = frontend +data;
                console.log(imageUrl);
                return `<img src="${imageUrl}" alt="Image" style="width: 50px; height: 50px; background-color:#5555; ">`;
            }},            
            { data: 'title' },
            { data: 'description' },
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
    $("#CaseSṭudyTable").on("click", ".view-btn", function (e) {
        e.preventDefault();
        const id = $(this).data("id");

        $.ajax({
            url: frontend + "admin/get_case_study_details",
            type: "POST",
            dataType: "json",
            data: { id: id }, // send id in POST data
            success: function (response) {
                $("#view_title").text(response.data.title);
                $("#view_description").text(response.data.description);
                $("#view_link").text(response.data.link);
                $("#view_date").text(response.data.date);
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

    $("#CaseSṭudyTable").on("click", ".edit-btn", function (e) {
    e.preventDefault();
    const id = $(this).data("id");

    // Fetch details from server
    $.ajax({
        url: frontend + "admin/get_case_study_details",
        type: "POST",
        dataType: "json",
        data: { id: id },
        success: function (response) {
                const data = response.data;

                $("#edit_id").val(data.id);
                $("#edit_title").val(data.title);
                $("#edit_description").val(data.description);
                $("#edit_link").val(data.slug_url);
                $("#edit_badge").val(data.badge);
                $("#edit_previous_image").val(data.image);
                $('#edit_previous_video').val(data.video);

                // Date
                if (data.date && /^\d{4}-\d{2}-\d{2}$/.test(data.date)) {
                    $("#edit_date").val(data.date);
                } else {
                    $("#edit_date").val("");
                }

                // Tags - assuming it's comma-separated IDs
                if (data.tag_id) {
                    const tagArray = data.tag_id.split(',');
                    $("#edit_tags").val(tagArray).trigger("chosen:updated");
                }

                // Image Preview
                if (data.image) {
                    const imageUrl = frontend + data.image;
                    $("#current_image").html(`<img src="${imageUrl}" class="img-fluid" style="max-height: 150px; background-color:#5555;">`);
                } else {
                    $("#current_image").html('');
                }

                // Video Preview
                if (data.video) {
                    const videoUrl = frontend + data.video;
                    console.log(videoUrl);
                    $("#current_video").html(`
                        <video width="100%" controls style="max-height: 200px;">
                            <source src="${videoUrl}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    `);
                } else {
                    $("#current_video").html('');
                }

                $('#EditModal').modal('show');
        },
        error: function () {
            alert("Error while fetching case study details.");
        },
    });
});

    // Delete action
	$("#CaseSṭudyTable").on("click", ".delete-btn", function (e) {
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
					url: frontend + "admin/delete_case_study",
					type: "POST",
					data: { id: id },
					dataType: "json",
					success: function (response) {
						if (response.status) {
							Swal.fire("Deleted!", response.message, "success");
							CaseSṭudyTable.ajax.reload(null, false);
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

$('#EditCaseStudyForm').submit(function (e) {
    e.preventDefault();

    let formData = new FormData(this);
    // Clear previous errors
    $('#error_edit_link, #error_edit_description, #error_edit_image').text('');

    $.ajax({
        url: frontend + "admin/update_case_study", // adjust to your route
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
                $('#EditCaseStudyForm')[0].reset();
                // Clear previous image preview
                $('#edit_image_preview').html('');
                // Reload the DataTable
                CaseSṭudyTable.ajax.reload(null, false);
                $('#EditModal').modal('hide');
                // Optional: refresh data table or show toast
            } else if (response.status === 'error') {
                // Show validation errors
                if (response.errors.title) {
                    $('#error_edit_link').text(response.errors.link);
                }
                if (response.errors.description) {
                    $('#error_edit_description').text(response.errors.description);
                }
                if (response.errors.image) {
                    $('#error_edit_image').text(response.errors.image);
                }
            }
        }
    });
});
