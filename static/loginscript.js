$(document).ready(function() {
    $('#form').submit(function(event) {
        event.preventDefault(); // Останавливаем стандартную отправку формы

        var formData = new FormData(this);

        $.ajax({
            url: 'login_check.php',
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