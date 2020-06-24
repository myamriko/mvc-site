function sendFrontContact() {
    var g_recaptcha_response = $('#g-recaptcha-response').val();
    var name = $('#nameContactFront').val().trim().replace(/<[^>]+>/g, '');
    var phone = $('#phoneContactFront').val().trim().replace(/<[^>]+>/g, '');
    var mail = $('#mailContactFront').val().trim().replace(/<[^>]+>/g, '');
    var d = new Date();
    var date = d.getFullYear() + "-" + (d.getMonth()+1) + "-" + d.getDate() + " " + d.getHours() +":"+ d.getMinutes();
    var subject = 'Форма связи главной страницы сайта';
    var text = $('#messageContactFront').val().trim().replace(/<[^>]+>/g, '');

    if (!name || !mail|| !text) {
        var html = '<div class="alert alert-danger" role="alert"><strong>Поля: ім\'я, електронна адреса та повідомлення - обов\'язкові для заповнення</div>';
        $('#systeminfo').html(html);
        setTimeout(function () {
            $('#system').fadeOut().modal('hide');
        }, 7000);
        $('#system').modal('show');
        $('#btn').html(htmlBtn);
        return;
    }
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
            var html = '<div class="alert alert-danger" role="alert"><strong>Помилка:</strong> ' + res[0].err + '</div>';
            $('#systeminfo').html(html);
            setTimeout(function () {
                $('#system').fadeOut().modal('hide');
            }, 7000);
            $('#system').modal('show');
            $('#sendFrontContactBtn').removeAttr('disabled');
            $('#sendFrontContactBtn').attr('class', 'submit-button mt-5');
            return;
        }
        var html = '<div class="alert alert-success" role="alert">' + res[0].err + '</div>';
        $('#systeminfo').html(html);
        setTimeout(function () {
            $('#system').fadeOut().modal('hide');
        }, 5000);
        $('#system').modal('show');
        $('#nameContactFront').val('');
        $('#mailContactFront').val('');
        $('#phoneContactFront').val('');
        $('#messageContactFront').val('');
        $('#sendFrontContactBtn').removeAttr('disabled');
        $('#sendFrontContactBtn').attr('class', 'submit-button mt-5');
        return;
    })
}