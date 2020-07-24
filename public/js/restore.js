function restorePass() {
    var g_recaptcha_response = $('#g-recaptcha-response').val().trim();
    var restoreEmail = $('#restoreEmail').val().trim().replace(/<[^>]+>/g, '');
    if (restoreEmail.indexOf('@') <= 0 || restoreEmail.indexOf('.') <= 0) {
        var html = '<div class="alert alert-danger" role="alert"><strong>Введіть дійсну адресу електронної пошти.</strong></div>';
        $('#systeminfo').html(html);
        setTimeout(function () {
            $('#system').fadeOut().modal('hide');
        }, 7000);
        $('#system').fadeIn().modal('show');
        return;
    }

    $('#restoreBtn').attr('disabled', true);

    $.post('restore/restorePass', {
        restoreEmail: restoreEmail,
        g_recaptcha_response: g_recaptcha_response
    }, function (res) {
        if (!res[0].success) {
           /* $('#restoreBtn').prop('disabled', false);*/
            var html = '<div class="alert alert-danger" role="alert"><strong class="lead">Ошибка: </strong>' + res[0].err + '</div>';
            $('#systeminfo').html(html);
            setTimeout(function () {
                $('#system').fadeOut().modal('hide');
            }, 7000);
            $('#system').fadeIn().modal('show');
            $('#restoreBtn').removeAttr('disabled');
            return;
        }
        var html = '<div class="alert alert-success" role="alert"><strong>На вашу електронну адресу надіслано повідомлення</strong></div>';
        $('#systeminfo').html(html);
        setTimeout(function () {
            $('#system').fadeOut().modal('hide');
            location.replace('/');
        }, 7000);
        $('#system').fadeIn().modal('show');
        return;
    })
}