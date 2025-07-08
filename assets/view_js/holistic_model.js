$('#HolisticValueForm').on('submit', function (e) {
    e.preventDefault();
    var formData = $(this).serialize();

    // Clear all error messages first
    $('.text-danger').html('');

    $.ajax({
        url: frontend + 'admin/save_holistic_model_data',
        method: 'POST',
        data: formData,
        dataType: 'json',
        success: function (response) {
            if (response.status === true) {
                alert(response.message);
                $('#HolisticValueForm')[0].reset();
            } else if (response.errors) {
                // Show validation errors
                $.each(response.errors, function (field, message) {
                    // Escape brackets in field name for ID
                    var safeField = field.replace(/\[/g, '\\[').replace(/\]/g, '\\]');
                    $('#error_' + safeField).html(message);
                });
            } else {
                alert(response.message);
            }
        }
    });
});
$(document).ready(function () {
    // Ensure 'frontend' variable is defined and points to your base URL
    if (typeof frontend === 'undefined') {
        console.error('The "frontend" variable is not defined.');
        return;
    }
    HolisticValue = $('#HolisticValue').DataTable({
        ajax: {
            url: frontend + "admin/get_holistic_model_data",  // Adjust URL accordingly
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

    $("#HolisticValue").on("click", ".view-btn", function (e) {
        e.preventDefault();
        const id = $(this).data("id");

        $.ajax({
            url: frontend + "admin/get_holistic_model_details",
            type: "POST",
            dataType: "json",
            data: { id: id },
            success: function (response) {
                const section = response.section[0];
                const strategies = response.strategies;
                const levers = response.levers;

                // Set title and description
                $("#view_title").text(section.title || "-");
                $("#view_description").text(section.description || "-");

                // Group strategies by section_type and pillar
                const grouped = {};
                strategies.forEach(item => {
                    const { section_type, pillar, items } = item;
                    if (!grouped[section_type]) grouped[section_type] = {};
                    grouped[section_type][pillar] = items;
                });

                // Generate strategy HTML
                let strategyHtml = '';
                Object.entries(grouped).forEach(([sectionType, pillars]) => {
                    strategyHtml += `
                        <div class="col-12 mt-3">
                            <h6 class="fw-bold text-primary">${sectionType}</h6>
                        </div>
                        <div class="row">`;

                    Object.entries(pillars).forEach(([pillar, items]) => {
                        const itemList = (items || '').split(',').map(i => i.trim()).filter(i => i !== '');
                        strategyHtml += `
                            <div class="col-md-4 mb-3">
                                <strong>${pillar}:</strong>
                                <ul>`;
                        itemList.forEach(i => {
                            strategyHtml += `<li>${i}</li>`;
                        });
                        strategyHtml += `</ul></div>`;
                    });

                    strategyHtml += `</div>`; // close row
                });

                $("#view_strategies").html(strategyHtml);

                // Generate levers list
                let leverHtml = '<ul>';
                if (levers && levers.length > 0) {
                    levers.forEach(l => {
                        leverHtml += `<li>${l.title}</li>`;
                    });
                } else {
                    leverHtml += '<li>-</li>';
                }
                leverHtml += '</ul>';
                $("#view_levers").html(leverHtml);

                $('#ViewModal').modal('show');
            },
            error: function () {
                $("#view_title").text("Error loading data");
                $("#view_description").text("-");
                $('#view_strategies').html('<p class="text-danger">Error loading strategies</p>');
                $('#view_levers').html('<p class="text-danger">Error loading levers</p>');
            }
        });
    });

    $("#HolisticValue").on("click", ".edit-btn", function (e) {
    e.preventDefault();
    const id = $(this).data("id");

    $.ajax({
        url: frontend + "admin/get_holistic_model_details",
        type: "POST",
        dataType: "json",
        data: { id },
        success: function (response) {

            /* ---------- 1. SECTION ---------- */
            if (response.section?.length) {
                const s = response.section[0];
                $("#edit_id").val(s.id);
                $("#edit_title").val(s.title);
                $("#edit_description").val(s.description);
            }

            /* ---------- 2. STRATEGIES ---------- */
            const pillarMap = {
                'Technology': ['Reduce', 'Replace', 'Redesign'],
                'Procurement': ['Supplier Strategy', 'Should Cost', 'Future Proofing']
            };

            // Clear all strategy inputs first
            $.each(pillarMap, function (sectionType, pillarsArr) {
                pillarsArr.forEach(pillar => {
                    const selector = `input[name="edit_strategy[${sectionType}][${pillar}]"]`;
                    $(selector).val('');
                });
            });

            // Populate strategy values
            if (Array.isArray(response.strategies)) {
                response.strategies.forEach(st => {
                    const selector = `input[name="edit_strategy[${st.section_type}][${st.pillar}]"]`;
                    $(selector).val(st.items);
                });
            }

            /* ---------- 3. LEVERS ---------- */
            if (Array.isArray(response.levers)) {
                $("input[name='edit_levers[]']").each(function (i) {
                    $(this).val(response.levers[i] ? response.levers[i].title : '');
                });
            }

            $('#EditModal').modal('show');
        },
        error: () => alert("Failed to load data.")
    });
});


    // Delete action
    $("#HolisticValue").on("click", ".delete-btn", function (e) {
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
                            HolisticValue.ajax.reload(null, false);
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

$('#EditHolisticValueForm').submit(function (e) {
    e.preventDefault();

    let formData = new FormData(this);

    // Clear previous error messages
    $('#error_edit_title, #error_edit_description, #error_edit_image').text('');

    $.ajax({
        url: frontend + "admin/update_holistic_model_data", // Update with your controller method
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

                $('#EditHolisticValueForm')[0].reset();
                $('#edit_image_preview').html('');
                $('#EditModal').modal('hide');

                // Refresh your DataTable
                if (typeof HowWeDoItTable !== 'undefined') {
                    HowWeDoItTable.ajax.reload(null, false);
                }

            } else if (response.errors) {
                // Validation error mapping
                if (response.errors.title) {
                    $('#error_edit_title').text(response.errors.title);
                }
                if (response.errors.description) {
                    $('#error_edit_description').text(response.errors.description);
                }
                if (response.errors.image) {
                    $('#error_edit_image').text(response.errors.image);
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
                text: 'An unexpected error occurred. Please try again.',
            });
        }
    });
});
