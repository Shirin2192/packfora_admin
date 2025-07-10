$('#ValueChainForm').submit(function (e) {
    e.preventDefault();

    let formData = $(this).serialize(); // use serialize since there's no file upload

    // Clear any previous errors
    $('#error_main_title, #error_main_description').text('');
    for (let i = 0; i < 4; i++) {
        $('#error_title_' + i).text('');
        $('#error_description_' + i).text('');
    }

    $.ajax({
        url: frontend + 'admin/save_value_chain_section', // adjust if needed
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function (response) {
            if (response.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: response.message,
                    timer: 1500,
                    showConfirmButton: false
                });

                $('#ValueChainForm')[0].reset(); // Reset form
                // Optionally refresh the section list if it's shown dynamically
            } else if (response.status === 'error') {
                // Display validation errors
                if (response.errors.main_title) {
                    $('#error_main_title').text(response.errors.main_title);
                }
                if (response.errors.main_description) {
                    $('#error_main_description').text(response.errors.main_description);
                }

                // Loop through dynamic expertise errors (if added later)
                for (let i = 0; i < 4; i++) {
                    if (response.errors['title_' + i]) {
                        $('#error_title_' + i).text(response.errors['title_' + i]);
                    }
                    if (response.errors['description_' + i]) {
                        $('#error_description_' + i).text(response.errors['description_' + i]);
                    }
                }
            }
        },
        error: function () {
            Swal.fire('Error', 'Something went wrong while submitting the form.', 'error');
        }
    });
});

$(document).ready(function () {
    // Ensure 'frontend' variable is defined and points to your base URL
    if (typeof frontend === 'undefined') {
        console.error('The "frontend" variable is not defined.');
        return;
    }
    ValueChain = $('#ValueChain').DataTable({
        ajax: {
            url: frontend + "admin/get_value_chain_expertise_data",  // Adjust URL accordingly
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
            { data: 'main_title' },
            { data: 'main_description' },
          
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

    $("#ValueChain").on("click", ".view-btn", function (e) {
            e.preventDefault();
            const id = $(this).data("id");

            $.ajax({
                url: frontend + "admin/get_value_chain_expertise_details",
                type: "POST",
                dataType: "json",
                data: { id: id },
                success: function (response) {
                    if (response.status === true) {
                        const section = response.section;
                        const expertise = response.expertise;

                        // Main title and description
                        $("#view_main_title").text(section.main_title || "-");
                        $("#view_main_description").text(section.main_description || "-");

                        // Expertise blocks
                        let html = "";
                        if (expertise.length > 0) {
                            expertise.forEach(function (item) {
                                html += `
                                    <div class="col-md-6 mb-3">
                                        <div class="border p-3 rounded bg-light">
                                            <h6 class="mb-1">${item.title}</h6>
                                            <p class="mb-0">${item.description}</p>
                                        </div>
                                    </div>`;
                            });
                        } else {
                            html = '<div class="col-12"><p>No expertise available.</p></div>';
                        }

                        $("#view_expertise_blocks").html(html);

                        // Show modal
                        $("#ViewModal").modal("show");
                    } else {
                        alert("Error: " + response.message);
                    }
                },
                error: function () {
                    alert("An error occurred while fetching data.");
                }
            });
        });


    $("#ValueChain").on("click", ".edit-btn", function (e) {
        e.preventDefault();
        const id = $(this).data("id");

        $.ajax({
            url: frontend + "admin/get_value_chain_expertise_details",
            type: "POST",
            dataType: "json",
            data: { id },
            success: function (response) {

                // 1. SECTION (Main title & description)
                const section = response.section;
                if (section) {
                    $("#edit_id").val(section.id);
                    $("#edit_main_title").val(section.main_title);
                    $("#edit_main_description").val(section.main_description);
                }

                // 2. EXPERTISE BLOCKS
                if (Array.isArray(response.expertise)) {
                    // Clear previous values
                    $("input[name^='edit_id']").val("");
                    $("input[name^='edit_expertise'][name$='[title]']").val("");
                    $("textarea[name^='edit_expertise'][name$='[description]']").val("");

                    response.expertise.forEach(function (item, index) {
                        $(`input[name='edit_id[${index}]']`).val(item.id);
                        $(`input[name='edit_expertise[${index}][title]']`).val(item.title);
                        $(`textarea[name='edit_expertise[${index}][description]']`).val(item.description);
                    });
                }

                $("#EditModal").modal("show");
            },
            error: function () {
                alert("Something went wrong while fetching data.");
            }
        });
    });


    // Delete action
    $("#ValueChain").on("click", ".delete-btn", function (e) {
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
                    url: frontend + "admin/delete_holistic_model_data",
                    type: "POST",
                    data: { id: id },
                    dataType: "json",
                    success: function (response) {
                        if (response.status) {
                            Swal.fire("Deleted!", response.message, "success");
                            ValueChain.ajax.reload(null, false);
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

$('#EditValueChainForm').submit(function (e) {
    e.preventDefault();

    let formData = new FormData(this);

    // Clear previous validation errors
    $('#error_edit_main_title, #error_edit_main_description').text('');
    $('[id^="error_edit_expertise_title_"]').text('');
    $('[id^="error_edit_expertise_description_"]').text('');

    $.ajax({
        url: frontend + "admin/update_value_chain_data", // Controller route
        type: "POST",
        data: formData,
        dataType: "json",
        contentType: false,
        processData: false,
        success: function (response) {
            if (response.status === true) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: response.message || 'Updated successfully',
                    timer: 1500,
                    timerProgressBar: true,
                    showConfirmButton: false
                });

                $('#EditValueChainForm')[0].reset();
                $('#EditModal').modal('hide');
                location.reload();

                if (typeof ValueChainTable !== 'undefined') {
                    ValueChainTable.ajax.reload(null, false);
                }

            } else if (response.errors) {
                // Show validation errors for main fields
                if (response.errors.main_title) {
                    $('#error_edit_main_title').text(response.errors.main_title);
                }
                if (response.errors.main_description) {
                    $('#error_edit_main_description').text(response.errors.main_description);
                }

                // Show validation errors for expertise blocks
                if (response.errors.expertise && Array.isArray(response.errors.expertise)) {
                    response.errors.expertise.forEach((err, index) => {
                        if (err.title) {
                            $('#error_edit_expertise_title_' + index).text(err.title);
                        }
                        if (err.description) {
                            $('#error_edit_expertise_description_' + index).text(err.description);
                        }
                    });
                }
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Failed!',
                    text: response.message || 'Something went wrong.',
                });
            }
        },
        error: function () {
            Swal.fire({
                icon: 'error',
                title: 'Server Error',
                text: 'Something went wrong on the server.',
            });
        }
    });
});

