
let editorInstance;

ClassicEditor
    .create(document.querySelector("#edit_description"))
    .then(editor => {
        editorInstance = editor;
    })
    .catch(error => {
        console.error(error);
    });
$(document).ready(function () {
    // Add More
    $('#addMoreBtn').click(function () {
        const cardHtml = `
        <div class="row solution-card mb-3">
            <div class="col-md-4">
                <label>Card Title</label>
                <input type="text" name="card_title[]" class="form-control" placeholder="Card Title">
                <div class="text-danger card_title_error"></div>
            </div>
            <div class="col-md-4">
                <label>Card Description</label>
                <input type="text" name="card_description[]" class="form-control" placeholder="Card Description">
                <div class="text-danger card_description_error"></div>
            </div>
            <div class="col-md-3">
                <label>Card Image</label>
                <input type="file" name="card_image[]" class="form-control">
                <div class="text-danger card_image_error"></div>
            </div>
            <div class="col-md-1 d-flex align-items-end">
                <button type="button" class="btn btn-danger remove-card">×</button>
            </div>
        </div>`;
        $('#solutionCards').append(cardHtml);
    });

    // Remove Card
    $(document).on('click', '.remove-card', function () {
        $(this).closest('.solution-card').remove();
    });
});

// Submit form
$('#CaseStudySolutionForm').on('submit', function (e) {
    e.preventDefault();

    // Clear previous errors
    $('#error_case_study_id, #main_title_error, #main_description_error, #success_msg').text('');
    $('.card_title_error, .card_description_error, .card_image_error').text('');

    const formData = new FormData(this);

    $.ajax({
        url: frontend +'admin/save_case_study_solution',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',

        success: function (res) {
            if (res.status === 'success') {
                $('#success_msg').text(res.message);
                $('#CaseStudySolutionForm')[0].reset();
                $('#solutionCards').html('');
                $('#addMoreBtn').click(); // add default card again
                 CaseSṭudySolutionTable.ajax.reload(null, false);
            } else if (res.errors) {
                if (res.errors.case_study_id) {
                    $('#error_case_study_id').text(res.errors.case_study_id);
                }
                if (res.errors.main_title) {
                    $('#main_title_error').text(res.errors.main_title);
                }
                if (res.errors.main_description) {
                    $('#main_description_error').text(res.errors.main_description);
                }
                if (res.errors.card_title_error) {
                    $('.card_title_error:first').text(res.errors.card_title_error);
                }
            }
        },

        error: function () {
            alert('Something went wrong. Please try again.');
        }
    });
});

  $(document).ready(function () {
    // Ensure 'frontend' variable is defined and points to your base URL
    if (typeof frontend === 'undefined') {
        console.error('The "frontend" variable is not defined.');
        return;
    }

    CaseSṭudySolutionTable = $('#CaseSṭudySolutionTable').DataTable({
        ajax: {
            url: frontend + "admin/get_case_study_solution_data",  // Adjust URL accordingly
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
            { data: 'image', render: function (data) {
                // Ensure 'frontend' ends with a slash if needed
                var imageUrl = frontend + data;
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

  $("#CaseSṭudySolutionTable").on("click", ".view-btn", function (e) {
    e.preventDefault();
    const id = $(this).data("id");

    $.ajax({
        url: frontend + "admin/get_case_study_solution_details",
        type: "POST",
        dataType: "json",
        data: { id: id },
        success: function (response) {
            if (response) {
                // Fill main title & description
                $("#view_main_title").text(response.main_title || "NA");
                $("#view_main_description").text(response.main_description || "NA");

                // Fill individual title & description
                $("#view_title").text(response.title || "NA");
                $("#view_description").text(response.description || "NA");

                // Fill image if present
                if (response.image) {
                    const imageUrl = frontend + response.image;
                    $("#view_image").html(`
                        <div style="background-color: #f8f9fa; padding: 0px; border-radius: 5px;">
                            <img src="` + imageUrl + `" class="img-fluid rounded" style="max-height: 150px;">
                        </div>`);
                } else {
                    $("#view_image").html('<em>No image uploaded</em>');
                }

                // Show modal
                $('#ViewModal').modal('show');
            } else {
                alert("No data received from server.");
            }
        },
        error: function () {
            $("#view_main_title").text("Error loading data");
            $("#view_main_description").text("Error loading data");
            $("#view_title").text("Error");
            $("#view_description").text("Error");
            $("#view_image").html("");
        },
    });
});

$("#CaseSṭudySolutionTable").on("click", ".edit-btn", function () {
    const id = $(this).data("id");

    $.ajax({
        url: frontend + "admin/get_case_study_solution_details",
        type: "POST",
        dataType: "json",
        data: { id: id },
        success: function (response) {
            if (response) {
                $("#edit_id").val(response.id);
                $("#edit_main_title").val(response.main_title || "");
                $("#edit_main_description").val(response.main_description || "");
                $("#edit_title").val(response.title || "");
                // $("#edit_description").val(response.description);
                // // ✅ Set CKEditor content
                if (editorInstance) {
                    editorInstance.setData(response.description || "");
                }

                // ✅ Set image preview
                if (response.image) {
                    let imageUrl = frontend + response.image;
                    $("#current_image").html(`
                        <div class="bg-light p-2 rounded">
                            <img src="${imageUrl}" class="img-fluid rounded" style="max-height: 150px;">
                        </div>
                    `);
                    $("#edit_previous_image").val(response.image);
                } else {
                    $("#current_image").html('<em>No image available</em>');
                    $("#edit_previous_image").val('');
                }

                $("#EditModal").modal("show");
            }
        },
        error: function () {
            alert("Error loading data for edit.");
        }
    });
});


    // Delete action
    $("#CaseSṭudySolutionTable").on("click", ".delete-btn", function (e) {
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
                    url: frontend + "admin/delete_case_study_business_impact",
                    type: "POST",
                    data: { id: id },
                    dataType: "json",
                    success: function (response) {
                        if (response.status) {
                            Swal.fire("Deleted!", response.message, "success");
                            CaseSṭudySolutionTable.ajax.reload(null, false);
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
$(document).on("submit", "#EditCaseStudySolutionForm", function (e) {
    e.preventDefault();

    // // ✅ Sync CKEditor content
    // if (editorInstance) {
    //     $("#edit_description").val(editorInstance.getData());
    // }

    const formData = new FormData(this);

    $.ajax({
        url: frontend + "admin/update_case_study_solution",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (res) {
            if (res.status === "success") {
                alert(res.message);
                CaseSṭudySolutionTable.ajax.reload(null, false);
                $("#EditModal").modal("hide");
            } else if (res.status === "error" && res.errors) {
                $.each(res.errors, function (key, msg) {
                    $("#error_" + key).text(msg);
                });
            }
        }
    });
});


