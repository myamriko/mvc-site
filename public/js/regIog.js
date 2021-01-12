function makeRegister() {

    var login = $('#reg_login').val().trim().replace(/<[^>]+>/g, '');
    var pass = $('#reg_pass').val().trim().replace(/<[^>]+>/g, '');
    var rePass = $('#reg_repass').val().trim().replace(/<[^>]+>/g, '');
    var userName = $('#reg_name').val().trim().replace(/<[^>]+>/g, '');
    var mail = $('#reg_mail').val().trim().replace(/<[^>]+>/g, '');
    var g_recaptcha_response = $('#g-recaptcha-response').val();
    var data = {
        g_recaptcha_response:g_recaptcha_response,
        login: login,
        pass: pass,
        repass: rePass,
        name: userName,
        mail: mail
    };
    if (!login || !pass || !userName || !mail || !rePass) {
        $('#message_reg').text(' Всі поля обов\'язкові для заповнення');
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
        $('#message').text(' Всі поля обов\'язкові для заповнення');
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

/**
 * Проверка нового пароля на фронте в соответствии с патеррном регистрация  изменение
 */
$('.newpssReg').on('keyup', function () {
    var str = $('.newpssReg').val();
    var patt = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^\\w\\s]).{6,}");
    var res = patt.test(str);
    if (str.length < 6){
        $('.complexity').text('');
        return;
    }
    if (res) {
        $('.complexity').text('OK');
        $('.complexity').attr('class', 'complexity aviso p-1');
        return;
    }
    $('.complexity').attr('class', 'complexity aviso p-1 text-danger');
    $('.complexity').text('Пароль не відповідає критеріям');
});

/**
 * Совпадение нового и ReПароля на фронте регистрация  изменение
 */
$('.passwordReg').on('keyup', function () {
    var newPss = $('.newpssReg').val();
    var rePss = $('.repssReg').val();
    if (newPss.length < 3 || rePss < 3){
        $('.equality').text('');
        return;
    }
    if (rePss === newPss) {
        $('.equality').text('Паролі співпадають');
        $('.equality').attr('class', 'equality aviso p-1');
        return;
    }
    $('.equality').attr('class', 'equality aviso p-1 text-danger');
    $('.equality').text('Паролі не співпадають');
});