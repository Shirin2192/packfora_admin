$(document).ready(function () {
	let CarrerFormTable = $("#CarrerFormTable").DataTable({
		ajax: frontend + "admin/get_career_enquiry_data",
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
			{ data: "phone" },
			{ data: "position" },
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
	$("#CarrerFormTable").on("click", ".view-btn", function (e) {
		e.preventDefault();
		const id = $(this).data("id");
		// Fetch details from server via POST
		$.ajax({
			url: frontend + "admin/get_career_enquiry_details",
			type: "POST",
			dataType: "json",
			data: { id: id }, // send id in POST data
			success: function (response) {
            $("#view_name").text(response.data.name);
            $("#view_email").text(response.data.email);
            $("#view_contact_no").text(response.data.phone);
            $("#view_position").text(response.data.position);
            $("#view_message").text(response.data.message);

            // Handle resume download/view link
            if (response.data.resume) {
                base_url = 'http://localhost/packfora/packfora/';
                const resumeFile = response.data.resume;
                const resumeLink = `<a href="${base_url}uploads/resumes/${resumeFile}" target="_blank">View Resume</a>`;
                $("#view_resume").html(resumeLink);
            } else {
                $("#view_resume").text("No resume uploaded");
            }

            $('#ViewContactModal').modal('show');
        },
		});
	});
});