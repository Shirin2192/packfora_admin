$(document).ready(function () {
    $('#SupplyChainMarketTrendsForm').on('submit', function (e) {
        e.preventDefault();
        // Clear previous error messages
        $('#error_title, #error_description').text('');
        var formData = new FormData(this);
        $.ajax({
            url: frontend + "admin/save_supply_chain_market_trends",  // Adjust URL accordingly
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
                    $('#SupplyChainMarketTrendsForm')[0].reset();
                     // Reload the DataTable
                    SupplyChainMarketTrendsTable.ajax.reload(null, false);
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
    SupplyChainMarketTrendsTable = $('#SupplyChainMarketTrendsTable').DataTable({
        ajax: {
            url: frontend + "admin/get_supply_chain_market_trends_data",  // Adjust URL accordingly
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

    // Optional: Handle clicks for view/edit/delete
    $("#SupplyChainMarketTrendsTable").on("click", ".view-btn", function (e) {
        e.preventDefault();
        const id = $(this).data("id");
        $.ajax({
            url: frontend + "admin/get_supply_chain_market_trends_details",
            type: "POST",
            dataType: "json",
            data: { id: id }, // send id in POST data
            success: function (response) {
                $("#view_title").text(response.data.title);
                $("#view_description").text(response.data.description);
                $('#ViewModal').modal('show');
            },
            error: function () {
                $("#view_title").text("Error loading data");
                $("#view_description").text("Error loading data");
            },
        });
    });

    $("#SupplyChainMarketTrendsTable").on("click", ".edit-btn", function (e) {
        e.preventDefault();
        const id = $(this).data("id");
        // Fetch details from server via POST
        $.ajax({
            url: frontend + "admin/get_supply_chain_market_trends_details",
            type: "POST",
            dataType: "json",
            data: { id: id }, // send id in POST data
            success: function (response) {
                    $("#edit_id").val(response.data.id);
                    $("#edit_title").val(response.data.title);
                    $("#edit_description").val(response.data.description);                  
                    $('#EditModal').modal('show');                
            },
            error: function () {
                $("#edit_title").val("Error loading data");
                $("#edit_description").val("Error loading data");               
            },
        });
    });
    // Delete action
	$("#SupplyChainMarketTrendsTable").on("click", ".delete-btn", function (e) {
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
					url: frontend + "admin/delete_supply_chain_market_trends",
					type: "POST",
					data: { id: id },
					dataType: "json",
					success: function (response) {
						if (response.status) {
							Swal.fire("Deleted!", response.message, "success");
							SupplyChainMarketTrendsTable.ajax.reload(null, false);
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
$('#EditSupplyChainMarketTrendsForm').submit(function (e) {
    e.preventDefault();
    let formData = new FormData(this);
    // Clear previous errors
    $('#error_edit_title, #error_edit_description').text('');
    $.ajax({
        url: frontend + "admin/update_supply_chain_market_trends_details", // adjust to your route
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
                $('#EditSupplyChainMarketTrendsForm')[0].reset();
                // Clear previous image preview
                $('#edit_image_preview').html('');
                // Reload the DataTable
                SupplyChainMarketTrendsTable.ajax.reload(null, false);
                $('#EditModal').modal('hide');
                // Optional: refresh data table or show toast
            } else if (response.status === 'error') {
                // Show validation errors
                if (response.errors.title) {
                    $('#error_edit_title').text(response.errors.title);
                }
                if (response.errors.description) {
                    $('#error_edit_description').text(response.errors.description);
                }
            }
        }
    });
});
