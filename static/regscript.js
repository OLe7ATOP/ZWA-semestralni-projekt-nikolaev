$(document).ready(function() {
    $('#form').submit(function(event) {
        event.preventDefault(); // Останавливаем стандартную отправку формы

        var password1 = $('#password').val().trim();
        var password2 = $('#reppassword').val().trim();

        if (password1.length < 6) {
            showModal('Password must be at least 6 characters!');
            return;
        }
        if (password1 !== password2) {
            showModal('Passwords do not match!');
            return;
        }

        var formData = new FormData(this);

        $.ajax({
            url: 'save_form.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.status === 'error') {
                    showModal(response.message);
                } else if (response.status === 'success') {
                    window.location.href = response.redirect;
                }
            },
            error: function() {
                showModal('Connection error with the server.');
            }
        });
    });

    function showModal(message) {
        $('#modal-message').text(message);
        $('#modal').fadeIn();
    }

    $('.close-btn').click(function() {
        $('#modal').fadeOut();
    });

    $(window).click(function(event) {
        if (event.target.id === 'modal') {
            $('#modal').fadeOut();
        }
    });
});