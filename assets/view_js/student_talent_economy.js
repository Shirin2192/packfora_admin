//  let descriptionEditor;
//     ClassicEditor
//         .create(document.querySelector('#description'))
//         .then(editor => {
//             descriptionEditor = editor;
//         })
//         .catch(error => {
//             console.error(error);
//         });
$('#StudentTalentEconomyForm').on('submit', function(e) {
    e.preventDefault();

    // Update hidden input with CKEditor value
    // $('#description').val(descriptionEditor.getData());

    let formData = new FormData(this);

    $.ajax({
        url: frontend + 'admin/save_update_student_talent_economy', // Adjust URL as needed
        type: 'POST',
        data: formData,
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function(response) {
            $('.text-danger').html('');
            if (response.status === 'error') {
                if (response.errors && response.errors.title) $('#error_title').html(response.errors.title);
                if (response.errors && response.errors.description) $('#error_description').html(response.errors.description);
                if (response.errors && response.errors.image) $('#error_image').html(response.errors.image);
            } else {
                 Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message,
                        timer: 1000,
                        timerProgressBar: true,
                        showConfirmButton: false
                    });                              
            }
        }
    });
});

