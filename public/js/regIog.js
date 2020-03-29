function makeRegister() {

    var login = $('#reg_login').val();
    var pass = $('#reg_pass').val();
    var rePass = $('#reg_repass').val();
    var userName = $('#reg_name').val();
    var mail = $('#reg_mail').val();
    var data = {
        login: login,
        pass: pass,
        repass: rePass,
        name: userName,
        mail: mail
    };
    if (!login || !pass || !userName || !mail || !rePass){
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
    var login = $('#login1').val();
    var pass = $('#pass').val();
    var data = {
        login: login,
        pass: pass
    };
    if (!login || !pass){
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

