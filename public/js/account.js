function editData() {
    var file = $('#files').prop('files')[0];
    var userId = $('#userId').val().trim().replace(/<[^>]+>/g, '');
    var fileOld = $('#fileOld').val().trim().replace(/<[^>]+>/g, '');
    var username = $('#username').val().trim().replace(/<[^>]+>/g, '');
    var email = $('#email').val().trim().replace(/<[^>]+>/g, '');

    var data = new FormData();
    data.append('file', file);
    data.append('userId', userId);
    data.append('fileOld', fileOld);
    data.append('username', username);
    data.append('email', email);

    $.ajax({
        url: 'account/editData',
        type: 'POST',
        cache: false,
        processData: false,
        contentType: false,
        data: data,

        success: function (res) {
            if (!res[0].success) {
                console.log(res[0].err);
                $('#message-acc').text(res[0].err);
                $('#acc_err').fadeIn().show();
                return;
            }
            $('#acc_err').fadeOut().hide();
            $('#reLogin').html('<h4 class="text-danger text-center pb-5">Для застосування змін необхідно заново увійти на сайт!</h4>');
            $('#account').modal('hide');
            $('#img-avatar').attr('src', '/public/pic/avatar/' + res[0].data[0]);
            $('#mail-acc').text('@mail: ' + res[0].data[2]);
            $('#name-acc').text('Вітаю ' + res[0].data[1] + '!');
        }
    });
}

function editPass() {
    var login = $('#loginRePass').text().trim().replace(/<[^>]+>/g, '');
    var oldPass = $('#pssOld').val().trim().replace(/<[^>]+>/g, '');
    var pass = $('#newPss').val().trim().replace(/<[^>]+>/g, '');
    var rePass = $('#rePss').val().trim().replace(/<[^>]+>/g, '');

    var data = {
        login: login,
        oldPass: oldPass,
        pass: pass,
        rePass: rePass
    };

    if (!oldPass || !pass || !rePass) {
        var html = '<div class="alert alert-danger" role="alert"><strong> Усі поля обов\'язкові до заповнення</strong></div>';
        $('#systeminfo').html(html);
        setTimeout(function () {
            $('#system').fadeOut().modal('hide');
        }, 5000);
        $('#system').fadeIn().modal('show');
        return;
    }

    $.post('account/editPass', data, function (res) {
        if (!res[0].success) {
            var html = '<div class="alert alert-danger" role="alert"><strong>' + res[0].err + '</strong></div>';
            $('#systeminfo').html(html);
            setTimeout(function () {
                $('#system').fadeOut().modal('hide');
            }, 5000);
            $('#system').fadeIn().modal('show');
            return;
        }
        $('#pssOld').val('');
        $('#newPss').val('');
        $('#rePss').val('');
        $('.equality').text(' ');
        $('.complexity').text(' ');
        var html = '<div class="alert alert-success" role="alert"><strong>Пароль змінено</strong></div>';
        $('#systeminfo').html(html);
        setTimeout(function () {
            $('#system').fadeOut().modal('hide');
        }, 5000);
        $('#system').fadeIn().modal('show');
        return;
    });
}

/**
 * Проверка нового пароля на фронте изменение в соответствии с патеррном
 */
$('.newpss').on('keyup', function () {
    var str = $('.newpss').val();
    var patt = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^\\w\\s]).{6,}");
    var res = patt.test(str);
    if (str.length < 6) {
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
 * Совпадение нового и ReПароля на фронте изменение
 */
$('.password').on('keyup', function () {
    var newPss = $('.newpss').val();
    var rePss = $('.repss').val();
    if (newPss.length < 3 || rePss < 3) {
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