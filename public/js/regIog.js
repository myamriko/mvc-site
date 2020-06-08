function makeRegister() {

    var login = $('#reg_login').val().trim().replace(/<[^>]+>/g, '');
    var pass = $('#reg_pass').val().trim().replace(/<[^>]+>/g, '');
    var rePass = $('#reg_repass').val().trim().replace(/<[^>]+>/g, '');
    var userName = $('#reg_name').val().trim().replace(/<[^>]+>/g, '');
    var mail = $('#reg_mail').val().trim().replace(/<[^>]+>/g, '');
    var data = {
        login: login,
        pass: pass,
        repass: rePass,
        name: userName,
        mail: mail
    };
    if (!login || !pass || !userName || !mail || !rePass) {
        $('#message_reg').text(' Все поля обязательны для заполнения');
        $('#reg_err').fadeIn().show();
        /*  setTimeout(function () {
              $('.alert-danger').fadeOut();
          }, 3000);*/
        $('#register').fadeIn().modal('show');
        return;
    }

    $.post('/users/registr', data, function (res) {
        console.log(res);
        if (!res[0].success) {
            console.log(res)
            $('#message_reg').text(res[0].err);
            $('#reg_err').fadeIn().show();
            /*  setTimeout(function () {
                  $('.alert-danger').fadeOut();
              }, 3000);*/
            $('#register').fadeIn().modal('show');
            return;
        }
        location.reload();
    });
}

function makeLogin() {
    var g_recaptcha_response = $('#g-recaptcha-response').val();
    var login = $('#login1').val().trim().replace(/<[^>]+>/g, '');
    var pass = $('#pass').val().trim().replace(/<[^>]+>/g, '');
    var data = {
        g_recaptcha_response:g_recaptcha_response,
        login: login,
        pass: pass
    };
    if (!login || !pass) {
        $('#message').text(' Все поля обязательны для заполнения');
        $('#login_err').fadeIn().show();
        /*  setTimeout(function () {
              $('.alert-danger').fadeOut();
          }, 3000);*/
        $('#login').fadeIn().modal('show');
        return;
    }
    $.post('/users/login', data, function (res) {

        if (!res[0].success) {
            $('#message').text(res[0].err);
            $('#login_err').fadeIn().show();
            /* setTimeout(function () {
                 $('.alert-danger').fadeOut();
             }, 3000);*/
            $('#login').fadeIn().modal('show');
            return;
        }
        location.reload();
    });
}

$(document).ready(function () {// отловим нажатие на энтер
    $(".modal").keyup(function (event) {
        var id = $(this).attr('id');// определяем id активного элемента
        var key = event.which;// определяем нажатую клавишу
        switch (true) {
            case key === 13 && id === 'login':
                makeLogin();
                break;
            case key === 13 && id === 'register':
                makeRegister();
                break;
        }
    });
});