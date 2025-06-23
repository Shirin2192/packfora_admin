$(document).ready(function () {
    $('#SliderForm').on('submit', function (e) {
        e.preventDefault();

        // Clear previous error messages
        $('.text-danger').text('');

        var formData = new FormData(this);

        $.ajax({
            url: frontend + "admin/save_slider",
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    alert('Slider saved successfully!');
                    $('#SliderForm')[0].reset();
                    $('.file-upload-info').val('');
                } else if (response.status === 'error' && response.errors) {
                    if (response.errors.title) {
                        $('#error_title').html(response.errors.title);
                    }
                    if (response.errors.subtitle) {
                        $('#error_subtitle').html(response.errors.subtitle);
                    }
                    if (response.errors.button_text) {
                        $('#error_button_text').html(response.errors.button_text);
                    }
                    if (response.errors.button_link) {
                        $('#error_button_link').html(response.errors.button_link);
                    }
                    if (response.errors.slide_order) {
                        $('#error_slide_order').html(response.errors.slide_order);
                    }
                    if (response.errors.image) {
                        $('#error_img').html(response.errors.image);
                    }
                } else {
                    alert('Something went wrong. Please try again.');
                }
            },
            error: function () {
                alert('Server error. Please contact support.');
            }
        });
    });
});
