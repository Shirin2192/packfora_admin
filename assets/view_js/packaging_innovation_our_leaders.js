$(document).ready(function () {
    $('#PackagingInnovationOurLeadersForm').on('submit', function (e) {
        e.preventDefault();
       // Clear previous error messages
        $('#error_name, #error_designation, #error_image, #error_link').text('');
        var formData = new FormData(this);
        $.ajax({
            url: frontend + "admin/save_packaging_innovation_our_leaders",  // Adjust URL accordingly
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
                    $('#PackagingInnovationOurLeadersForm')[0].reset();
                     // Reload the DataTable
                    PackagingInnovationOurLeadersTable.ajax.reload(null, false);
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
    PackagingInnovationOurLeadersTable = $('#PackagingInnovationOurLeadersTable').DataTable({
        ajax: {
            url: frontend + "admin/get_packaging_innovation_our_leaders_data",  // Adjust URL accordingly
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
            { data: 'name' },
            { data: 'designation' },
            { data: 'link' },
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
    $("#PackagingInnovationOurLeadersTable").on("click", ".view-btn", function (e) {
        e.preventDefault();
        const id = $(this).data("id");

        $.ajax({
            url: frontend + "admin/get_packaging_innovation_our_leaders_details",
            type: "POST",
            dataType: "json",
            data: { id: id }, // send id in POST data
            success: function (response) {
                $("#view_name").text(response.data.name);
                $("#view_designation").text(response.data.designation);
                $("#view_link").text(response.data.link);
                if (response.data.image) {
                const imageUrl = frontend + response.data.image;
                $("#view_image").html('<img src="' + imageUrl + '" class="img-fluid" style="max-height: 150px;">');
            } else {
                $("#view_image").html('');
            }
            $('#ViewModal').modal('show');
            },
            error: function () {
                $("#view_name").text("Error loading data");
                $("#view_designation").text("Error loading data");
                $("#view_image").hide();
            },
        });
    });

    $("#PackagingInnovationOurLeadersTable").on("click", ".edit-btn", function (e) {
        e.preventDefault();
        const id = $(this).data("id");
        // Fetch details from server via POST
        $.ajax({
            url: frontend + "admin/get_packaging_innovation_our_leaders_details",
            type: "POST",
            dataType: "json",
            data: { id: id }, // send id in POST data
            success: function (response) {
                    $("#edit_id").val(response.data.id);
                    $("#edit_name").val(response.data.name);
                    $("#edit_designation").val(response.data.designation);
                    $("#edit_link").val(response.data.link);
                    $("#edit_previous_image").val(response.data.image); // Handle empty image case
                    if (response.data.image) {
                        const imageUrl = frontend + response.data.image;
                        $("#edit_image_preview").html('<img src="' + imageUrl + '" class="img-fluid" style="max-height: 150px;">');
                    } else {
                        $("#edit_image_preview").html('');
                    }
                    $('#EditModal').modal('show');
                
            },
            error: function () {
                $("#edit_name").val("Error loading data");
                $("#edit_designation").val("Error loading data");
                $("#edit_image_preview").html('');
            },
        });
    });
    // Delete action
    $("#PackagingInnovationOurLeadersTable").on("click", ".delete-btn", function (e) {
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
                    url: frontend + "admin/delete_packaging_innovation_our_leaders",
                    type: "POST",
                    data: { id: id },
                    dataType: "json",
                    success: function (response) {
                        if (response.status) {
                            Swal.fire("Deleted!", response.message, "success");
                            PackagingInnovationOurLeadersTable.ajax.reload(null, false);
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

$('#EditPackagingInnovationOurLeadersForm').submit(function (e) {
    e.preventDefault();

    let formData = new FormData(this);
    // Clear previous errors
    $('#error_edit_name, #error_edit_designation, #error_edit_image, #error_edit_link').text('');

    $.ajax({
        url: frontend + "admin/update_packaging_innovation_our_leaders", // adjust to your route
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
                $('#EditPackagingInnovationOurLeadersForm')[0].reset();
                // Clear previous image preview
                $('#edit_image_preview').html('');
                // Reload the DataTable
                PackagingInnovationOurLeadersTable.ajax.reload(null, false);
                $('#EditModal').modal('hide');
                // Optional: refresh data table or show toast
            } else if (response.status === 'error') {
                // Show validation errors
                if (response.errors.name) {
                    $('#error_edit_name').text(response.errors.name);
                }
                if (response.errors.designation) {
                    $('#error_edit_designation').text(response.errors.designation);
                }
                if (response.errors.image) {
                    $('#error_edit_image').text(response.errors.image);
                }
            }
        }
    });
});
