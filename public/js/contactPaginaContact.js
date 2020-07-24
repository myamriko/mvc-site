function send() {
    var g_recaptcha_response = $('#g-recaptcha-response').val();
    var name = $('#name').val().trim().replace(/<[^>]+>/g, '');
    var mail = $('#mail').val().trim().replace(/<[^>]+>/g, '');
    var phone = $('#phone').val().trim().replace(/<[^>]+>/g, '');
    var date = $('#date').val().trim().replace(/<[^>]+>/g, '');
    var subject = $('#subject').val().trim().replace(/<[^>]+>/g, '');
    var text = $('#text').val().trim().replace(/<[^>]+>/g, '');
    $('#sendFrontContactBtn').attr('disabled', true);
    $('#sendFrontContactBtn').attr('class', 'mt-5 disabledBtn ');

    var data = {
        g_recaptcha_response:g_recaptcha_response,
        name: name,
        mail: mail,
        phone: phone,
        date: date,
        subject: subject,
        text: text
    };

    $.post('/contacts/send_mail', data, function (res) {

        if (!res[0].success) {
            var html = '<div class="alert alert-danger" role="alert"><strong class="lead">Помилка:</strong> ' + res[0].err + '</div>';
            $('#systeminfo').html(html);
            setTimeout(function () {
                $('#system').fadeOut().modal('hide');
            }, 7000);
            $('#system').modal('show');
            $('#sendFrontContactBtn').removeAttr('disabled');
            $('#sendFrontContactBtn').attr('class', 'submit-button mt-5');
            return;
        }
        var html = '<div class="alert alert-success" role="alert"> <strong class="lead">Ошибка: </strong>' + res[0].err + '</div>';
        $('#systeminfo').html(html);
        setTimeout(function () {
            $('#system').fadeOut().modal('hide');
        }, 7000);
        $('#system').modal('show');

        $('#name').val('');
        $('#mail').val('');
        $('#phone').val('');
        $('#subject').val('');
        $('#text').val('');
        $('#date').datepicker({dateFormat: "yy-mm-dd"}).datepicker("setDate", new Date());
        $('#sendFrontContactBtn').removeAttr('disabled');
        $('#sendFrontContactBtn').attr('class', 'submit-button mt-5');
        return;
    })
}