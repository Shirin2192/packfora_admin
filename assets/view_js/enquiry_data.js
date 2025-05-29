$(document).ready(function () {
	let CarrerFormTable = $("#ContactFormTable").DataTable({
		ajax: frontend + "admin/get_enquiry_contact_data",
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
			{ data: "inquiry_type" },
			{ data: "full_name" },
			{ data: "company_name" },
			{ data: "email" },
			{ data: "phone_number" },
			{ data: "message" },
			{ data: "hear_about_us" },
			{
				data: null,
				orderable: false,
				render: function (data, type, row) {
					return `
                        <a href="#" class="view-btn" data-id="${row.id}" title="View">
                            <i class="fas fa-eye text-info "></i>
                        </a>
                    `;
				},
			},
		],
	});
	// Optional: Handle clicks for view/edit/delete
	$("#ContactFormTable").on("click", ".view-btn", function (e) {
    e.preventDefault();
    const id = $(this).data("id");

    $.ajax({
        url: frontend + "admin/get_enquiry_contact_details", // Adjust URL as per your backend
        type: "POST",
        dataType: "json",
        data: { id: id },
        success: function (response) {
            const data = response.data;
            $("#view_inquiry_type").text(data.inquiry_type);
            $("#view_full_name").text(data.full_name);
            $("#view_company_name").text(data.company_name);
            $("#view_email").text(data.email);
            $("#view_phone_number").text(data.phone_number);
            $("#view_message").text(data.message);
            $("#view_hear_about_us").text(data.hear_about_us);

            $('#ViewContactModal').modal('show');
        },
        error: function () {
            alert("Failed to load contact details.");
        }
    });
});

});