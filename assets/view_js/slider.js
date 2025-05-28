$(document).ready(function () {
    $('#SliderForm').on('submit', function (e) {
        e.preventDefault();

        // Clear all previous error messages
        $('.text-danger').text('');

        var formData = new FormData(this);

        $.ajax({
            url: frontend + "admin/save_slider",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (response) {
                if (response.status === true) {
                    alert(response.message);
                    $('#SliderForm')[0].reset();
                    $('.file-upload-info').val('');
                } else if (response.errors) {
                    if (response.errors.title) {
                        $('#error_title').html(response.errors.title);
                    }
                    if (response.errors.description) {
                        $('#error_description').html(response.errors.description);
                    }
                    if (response.errors.link) {
                        $('#error_link').html(response.errors.link);
                    }
                    if (response.errors.img) {
                        $('#error_img').html(response.errors.img);
                    }
                } else {
                    alert('An unknown error occurred. Please try again.');
                }
            },
            error: function () {
                alert('Server error. Please contact support.');
            }
        });
    });
});