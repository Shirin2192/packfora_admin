// Submit form
    $('#CaseStudyBusinessImpactForm').on('submit', function (e) {
        e.preventDefault();

        // Clear previous errors
        $('#error_case_study_id, #success_msg').text('');
        $('#card_title_error, #card_description_error, #card_image_error').text('');

        const formData = new FormData(this);

        $.ajax({
            url: frontend +'admin/save_study_business_impact',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',

            success: function (res) {
                if (res.status === 'success') {
                    $('#success_msg').text(res.message);
                    $('#CaseStudyBusinessImpactForm')[0].reset();
                  
                } else if (res.errors) {
                    if (res.errors.case_study_id) {
                        $('#error_case_study_id').text(res.errors.case_study_id);
                    }
                  
                    if (res.errors.card_title_error) {
                        $('#card_title_error:first').text(res.errors.card_title_error);
                    }
                     if (res.errors.card_description_error) {
                        $('#card_description_error:first').text(res.errors.card_description_error);
                    }
                     if (res.errors.card_image_error) {
                        $('#card_image_error:first').text(res.errors.card_image_error);
                    }
                }
            },

            error: function () {
                alert('Something went wrong. Please try again.');
            }
        });
    });