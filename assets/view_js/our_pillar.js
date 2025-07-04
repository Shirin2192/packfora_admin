$('#PillarsFullForm').on('submit', function(e) {
    e.preventDefault();

    var form = $(this)[0];
    var formData = new FormData(form);

    $('.text-danger').text('');

    $.ajax({
        url: frontend + "admin/save_pillars_section",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(response) {
            if (response.status === false) {
                $.each(response.errors, function(field, msg) {
                    $('#error_' + field).text(msg);
                });
            } else {
                alert(response.message);
                $('#PillarsFullForm')[0].reset();
            }
        },
        error: function() {
            alert("Something went wrong.");
        }
    });
});
    $('#pillarsTable').DataTable({
    "ajax": {
        "url": frontend + 'admin/get_all_pillar',
        "type": "POST"
    },
    "columns": [
        {
            "data": null, // No actual field from the server
            "render": function (data, type, row, meta) {
                return meta.row + 1; // Auto-increment based on row index
            }
        },
        { "data": "main_title" },
        { "data": "subtitle" },
        { "data": "sub_heading" },
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
    ]
});
       // Optional: Handle clicks for view/edit/delete
    $("#pillarsTable").on("click", ".view-btn", function (e) {
        e.preventDefault();
        const id = $(this).data("id");

       $.ajax({
        url: frontend + 'admin/get_pillar_by_id',
        type: 'POST',
        data: { id: id },
        dataType: 'json',
        success: function(response) {
            if (response.status === true) {
                const data = response.data;

                $('#view_main_title').text(data.intro.main_title);
                $('#view_subtitle').text(data.intro.subtitle);
                $('#view_sub_heading').text(data.intro.sub_heading);

                $('#view_science_title_1').text(data.science_titles[0]);
                $('#view_science_title_2').text(data.science_titles[1]);
                $('#view_science_title_3').text(data.science_titles[2]);

                for (let i = 0; i < 3; i++) {
                    $('#opt_desc_' + (i + 1)).text(data.optimize_points[i]?.description ?? '');
                    if (data.optimize_points[i]?.icon) {
                        $('#opt_icon_' + (i + 1)).html('<img src="' + frontend + data.optimize_points[i].icon + '" width="50">');
                    }
                }
                if (data.right_image) {
                    $('#right_image_preview').html('<img src="' + frontend + data.right_image + '" class="img-fluid" width="200">');
                } else {
                    $('#right_image_preview').html('');
                }
                $('#ViewModal').modal('show');
            } else {
                alert('No data found!');
            }
        }
    });
    });

    $("#pillarsTable").on("click", ".edit-btn", function (e) {
        e.preventDefault();
        const id = $(this).data("id");

           $.ajax({
            url: frontend + 'admin/get_pillar_by_id',
            type: 'POST',
            data: { id: id },
            dataType: 'json',
            success: function(response) {
                if (response.status === true) {
                    const data = response.data;

                    $('#edit_main_title').val(data.intro.main_title);
                    $('#edit_subtitle').val(data.intro.subtitle);
                    $('#edit_sub_heading').val(data.intro.sub_heading);

                    $('#edit_science_title_1').val(data.science_titles[0]);
                    $('#edit_science_title_2').val(data.science_titles[1]);
                    $('#edit_science_title_3').val(data.science_titles[2]);

                    for (let i = 0; i < 3; i++) {
                        $('#edit_opt_desc_' + (i + 1)).val(data.optimize_points[i]?.description ?? '');
                        if (data.optimize_points[i]?.icon) {
                            $('#edit_opt_icon_' + (i + 1)).html('<img src="' + frontend + data.optimize_points[i].icon + '" width="50">');
                        }
                    }
                    if (data.right_image) {
                        $('#edit_right_image_preview').html('<img src="' + frontend + data.right_image + '" class="img-fluid" width="200">');
                    } else {
                        $('#edit_right_image_preview').html('');
                    }
                    $('#EditModal').modal('show');
                } else {
                    alert('No data found!');
                }
            }
        });
    });