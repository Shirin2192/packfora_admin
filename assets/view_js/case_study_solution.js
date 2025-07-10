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