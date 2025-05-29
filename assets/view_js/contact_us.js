$(document).ready(function () {
	$("#contactUsForm").on("submit", function (e) {
		e.preventDefault();

		// Clear and show all error containers
		$(".text-danger").text("").show();

		var formData = new FormData(this);

		$.ajax({
			url: frontend + "admin/save_contactus_form",
			type: "POST",
			data: formData,
			processData: false,
			contentType: false,
			dataType: "json",
			success: function (response) {
				if (response.status === true) {
					Swal.fire({
						icon: "success",
						title: "Success!",
						text: response.message,
						timer: 3000, // auto close after 3 seconds
						timerProgressBar: true,
						showConfirmButton: false, // hides the OK button
						willClose: () => {
							$("#contactUsForm")[0].reset();
							$(".text-danger").text("").show(); // Reset error containers
							ContactUsTable.ajax.reload(); // Reload the DataTable
						},
					});
				} else if (response.errors) {
					// Show individual errors and hide after delay
					$.each(response.errors, function (field, message) {
						$("#error_" + field)
							.html(message)
							.fadeIn();
						setTimeout(() => {
							$("#error_" + field).fadeOut();
						}, 4000);
					});
				} else {
					Swal.fire({
						icon: "error",
						title: "Oops!",
						text: "An unknown error occurred. Please try again.",
					});
				}
			},
			error: function () {
				Swal.fire({
					icon: "error",
					title: "Server Error",
					text: "Please contact support.",
				});
			},
		});
	});
});
$(document).ready(function () {
	let ContactUsTable = $("#ContactUsTable").DataTable({
		ajax: frontend + "admin/get_contact_us",
		processing: true,
		serverSide: false, // ⛔ Turn OFF server-side processing
		columns: [
			{
				data: null,
				render: function (data, type, row, meta) {
					return meta.row + 1;
				},
				orderable: false,
			},
			{ data: "name" },
			{ data: "email" },
			{ data: "contact_no" },
			{ data: "designation" },
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
	});
	// Optional: Handle clicks for view/edit/delete
	$("#ContactUsTable").on("click", ".view-btn", function (e) {
		e.preventDefault();
		const id = $(this).data("id");
		// Fetch details from server via POST
		$.ajax({
			url: frontend + "admin/get_contact_us_details",
			type: "POST",
			dataType: "json",
			data: { id: id }, // send id in POST data
			success: function (response) {				
                $("#view_name").text(response.data.name);
                $("#view_email").text(response.data.email);
                $("#view_contact_no").text(response.data.contact_no);
                $("#view_designation").text(response.data.designation);
                $('#ViewContactModal').modal('show');
			},
		});
	});

	$("#ContactUsTable").on("click", ".edit-btn", function (e) {
		e.preventDefault();
		const id = $(this).data("id");

		// Fetch details from server via POST
		$.ajax({
			url: frontend + "admin/get_contact_us_details",
			type: "POST",
			dataType: "json",
			data: { id: id }, // send id in POST data
			success: function (response) {				
                $("#edit_name").val(response.data.name);
                $('#edit_id').val(response.data.id);
                $("#edit_email").val(response.data.email);
                $("#edit_contact_no").val(response.data.contact_no);
               // Set designation and append if not found
                const designation = response.data.designation;
                const $designationSelect = $('#edit_designation');

                if (!$designationSelect.find(`option[value="${designation}"]`).length) {
                    $designationSelect.append(
                        $('<option>', {
                            value: designation,
                            text: designation
                        })
                    );
                }
                $designationSelect.val(designation);
                $('#EditModal').modal('show');
			},
			error: function () {
				$("#edit_title").val("Error loading data");
				$("#edit_location").val("Error loading data");
				$("#edit_description").val("Error loading data");
			},
		});
	});

	$("#ContactUsTable").on("click", ".delete-btn", function () {
    const id = $(this).data("id");
    Swal.fire({
        title: 'Are you sure?',
        text: "You are about to delete this record!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Perform AJAX delete
            $.ajax({
                url: frontend + 'admin/delete_contactus',
                type: 'POST',
                data: { id: id },
                dataType: 'json',
                success: function (response) {
                    if (response.status) {
                        Swal.fire(
                            'Deleted!',
                            response.message,
                            'success'
                        );
                        $('#ContactUsTable').DataTable().ajax.reload(null, false); // Reload table
                    } else {
                        Swal.fire('Error', response.message || 'Unable to delete', 'error');
                    }
                },
                error: function () {
                    Swal.fire('Error', 'Server error, please try again later', 'error');
                }
            });
        }
    });
});

});
$("#EditContactUsForm").on("submit", function (e) {
		e.preventDefault();

		// Clear and show all error containers
		$(".text-danger").text("").show();

		var formData = new FormData(this);
		$.ajax({
			url: frontend + "admin/update_contactus",
			type: "POST",
			data: formData,
			processData: false,
			contentType: false,
			dataType: "json",
			success: function (response) {
				if (response.status === true) {
                     $('#EditModal').modal('hide');
					Swal.fire({
						icon: "success",
						title: "Success!",
						text: response.message,
						timer: 3000, // auto close after 3 seconds
						timerProgressBar: true,
						showConfirmButton: false, // hides the OK button
						willClose: () => {
							$("#EditContactUsForm")[0].reset();
							$(".text-danger").text("").show(); // Reset error containers
							
                            $('#ContactUsTable').DataTable().ajax.reload(null, false); 
						},
					});
				} else if (response.errors) {
					// Show individual errors and hide after delay
					$.each(response.errors, function (field, message) {
						$("#error_" + field)
							.html(message)
							.fadeIn();
						setTimeout(() => {
							$("#error_" + field).fadeOut();
						}, 4000);
					});
				} else {
					Swal.fire({
						icon: "error",
						title: "Oops!",
						text: "An unknown error occurred. Please try again.",
					});
				}
			},
			error: function () {
				Swal.fire({
					icon: "error",
					title: "Server Error",
					text: "Please contact support.",
				});
			},
		});
	});