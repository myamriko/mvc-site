/*при нажатии на элемент определяем id*/
$("td").on("contextmenu", function () {
    var id = $(this).attr("id");
    if (id) {
        var text = $('#' + id).text().trim();
        var idr = id.replace(/[0-9-]/g, '');
        switch (true) {
            case idr !== 'role' && idr !== 'avatar':
                var oldHtml = $('#' + id).html().trim();
                var html = "<div class='row'><input id='new_" + id + "' class='form-control  form-control-sm width-mob' type='text' value='" + text + "' >" +
                    "<button id='update_sitemail' type='button' class='btn badge-success btn-sm ml-2' onclick='updateUser(\"" + id + "\")'><i class='far fa-save'></i></button></div>";

                $('#' + id).html(html);
                $('#new_' + id).select();//выделить текст в input
                esc(id, oldHtml);
                break;
            /*для роли*/
            case idr === 'role':
                var oldHtml = $('#' + id).html().trim();
                var html = '<select name="new_' + id + '" id="new_' + id + '"  class="form-control" style=\'width: 100px\'>\n' +
                    '                                    <optgroup label="Выбрать роль:">\n' +
                    '                                        <option value=\'admin\'>admin</option>\n' +
                    '                                        <option value=\'editor\'>editor</option>\n' +
                    '                                        <option value=\'user\'>user</option>\n' +
                    '                                    </optgroup>\n' +
                    '                                    <optgroup label="Текущая роль:">\n' +
                    '                                        <option selected value="' + text + '">' + text + '</option>\n' +
                    '                                    </optgroup>\n' +
                    '                                </select>';
                $('#' + id).html(html);
                esc(id, oldHtml);//esc.js подключен в admin/layout.tpl
                /*вносим изменения*/
                $('#new_' + id).change(function () {
                    var text = $('#new_' + id).val();
                    $.post('/users-adm/update', {text: text, id: id}, function (res) {

                        if (!res[0].success) {
                            var html = '<div class="alert alert-danger" role="alert"><strong class="lead">Ошибка: </strong>' + res[0].err + '</div>';
                            $('#systeminfo').html(html);
                            setTimeout(function () {
                                $('#system').fadeOut().modal('hide');
                            }, 7000);
                            $('#system').fadeIn().modal('show');
                        }
                        $('#new_' + id).remove();
                        $('#' + id).html('<b>' + text + '</b>').attr('style', 'color: #a80000;');
                    });
                })
                break;
            /*ДЛЯ аватарки*/
            case idr === 'avatar':
                var oldHtml = $('#' + id).html().trim();
                var html = '<input type="file" id="new_' + id + '" name="new_' + id + '" class="mt-2 width-mob">' +
                    '<button id="new_' + id + '" type="button" class="btn badge-success btn-sm mb-1" onclick="updateAvatar(\'' + id + '\')"><i class="fas fa-file-download"></i></button></div>';
                $('#' + id).html(html);
                esc(id, oldHtml);
                break;
        }

    }
})

function updateAvatar(id) {
    var img = $('#new_' + id).prop('files')[0];
    var data = new FormData();
    data.append('file', img);
    data.append('id', id);
    $.ajax({
        url: '/usersadm/update',
        type: 'POST',
        cache: false,
        processData: false,
        contentType: false,
        data: data,

        success: function (res) {
            $('#new_' + id).remove();
            if (!res[0].success) {
                var html = '<div class="alert alert-danger" role="alert"><strong class="lead">Ошибка: </strong>' + res[0].err + '</div>';
                $('#systeminfo').html(html);
                setTimeout(function () {
                    $('#system').fadeOut().modal('hide');
                }, 7000);
                $('#system').fadeIn().modal('show');
                $('#' + id).html('<img src="/public/pic/avatar/' + res[0].name_pic_old + '" style="width: 40px; height: auto">');
                return;
            }
            $('#' + id).html('<img src="/public/pic/avatar/' + res[0].name_pic + '" style="width: 40px; height: auto">');
        }
    });
}

function updateUser(id) {
    var idr = id.replace(/[0-9-]/g, '');
    var text = $('#new_' + id).val().trim().replace(/<[^>]+>/g, '');
    if (idr === 'email' && text.indexOf('@') <= 0 || idr === 'email' && text.indexOf('.') <= 0) {
        var html = '<div class="alert alert-danger" role="alert"><strong>Введите действительный адрес электронной почты.</strong></div>';
        $('#systeminfo').html(html);
        setTimeout(function () {
            $('#system').fadeOut().modal('hide');
        }, 7000);
        $('#system').fadeIn().modal('show');
        return;
    }

    $.post('/users-adm/update', {text: text, id: id}, function (res) {
        if (!res[0].success) {
            var html = '<div class="alert alert-danger" role="alert"><strong class="lead">Ошибка: </strong>' + res[0].err + '</div>';
            $('#systeminfo').html(html);
            setTimeout(function () {
                $('#system').fadeOut().modal('hide');
            }, 7000);
            $('#system').fadeIn().modal('show');
            return;
        }
        $('#new_' + id).remove();
        $('#' + id).html('<b>' + text + '</b>').attr('style', 'color: #a80000;');
    });

}

$(document).ready(function () {// отловим нажатие на энтер
    $("td").keyup(function (event) {
        var id = $(this).attr('id');// определяем id активного элемента
        var idr = id.replace(/[0-9-]/g, '');
        var key = event.which;// определяем нажатую клавишу
        if (key === 13 && idr !== 'avatar' && idr !== 'role'){
            updateUser(id);
        };
    });
});

