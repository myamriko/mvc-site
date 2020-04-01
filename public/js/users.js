/*при нажатии на элемент определяем id*/
$("td").on("dblclick", function () {
    var id = $(this).attr("id");
    if (id) {
        var text = $('#' + id).text().trim();
        var idr = id.replace(/[0-9]/g, '');
        switch (true) {
            case idr !== 'role-' && idr !== 'avatar-':
                var oldHtml = $('#' + id).html().trim();
                var html = "<div class='row'><input id='new_" + id + "' class='form-control  form-control-sm' style='width: 150px' type='text' value='" + text + "' >" +
                    "<button id='update_sitemail' type='button' class='btn badge-success btn-sm ml-2' onclick='updateUser(\"" + id + "\",\"" + idr + "\")'><i class='far fa-save'></i></button></div>";

                $('#' + id).html(html);
                $('#new_' + id).select();//выделить текст в input
                esc(id, oldHtml);
                break;
            /*для роли*/
            case idr === 'role-':
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
                            var html = '<div class="alert alert-danger" role="alert"><strong>' + res[0].err + '</strong></div>';
                            $('#systeminfo').html(html);
                            setTimeout(function () {
                                $('#system').fadeOut().modal('hide');
                            }, 3000);
                            $('#system').fadeIn().modal('show');
                        }
                        $('#new_' + id).remove();
                        $('#' + id).html('<b>' + text + '</b>').attr('style', 'color: #a80000;');
                    });
                })
                break;
            /*ДЛЯ аватарки*/
            case idr === 'avatar-':
                var oldHtml = $('#' + id).html().trim();
                var html = '<input type="file" id="new_' + id + '" name="new_' + id + '" class="mt-2" style="width: 200px">' +
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
                var html = '<div class="alert alert-danger" role="alert"><strong>' + res[0].err + '</strong></div>';
                $('#systeminfo').html(html);
                setTimeout(function () {
                    $('#system').fadeOut().modal('hide');
                }, 3000);
                $('#system').fadeIn().modal('show');
                $('#' + id).html('<img src="/public/pic/avatar/' + res[0].name_pic_old + '" style="width: 40px; height: auto">');
                return;
            }
            $('#' + id).html('<img src="/public/pic/avatar/' + res[0].name_pic + '" style="width: 40px; height: auto">');
        }
    });
}

function updateUser(id, idr) {

    var text = $('#new_' + id).val().trim().replace(/<[^>]+>/g, '');
    if (idr === 'email-' && text.indexOf('@') <= 0 || idr === 'email-' && text.indexOf('.') <= 0) {
        var html = '<div class="alert alert-danger" role="alert"><strong>Введите действительный адрес электронной почты.</strong></div>';
        $('#systeminfo').html(html);
        setTimeout(function () {
            $('#system').fadeOut().modal('hide');
        }, 3000);
        $('#system').fadeIn().modal('show');
    }

    $.post('/users-adm/update', {text: text, id: id}, function (res) {
        if (!res[0].success) {
            var html = '<div class="alert alert-danger" role="alert"><strong>' + res[0].err + '</strong></div>';
            $('#systeminfo').html(html);
            setTimeout(function () {
                $('#system').fadeOut().modal('hide');
            }, 3000);
            $('#system').fadeIn().modal('show');
        }
        $('#new_' + id).remove();
        $('#' + id).html('<b>' + text + '</b>').attr('style', 'color: #a80000;');
    });

}

function removedStart(id, login) {
    var html = '<div class="col-12"><p class="alert alert-secondary">Вы действительно хотите удалить пользователя <span class="lead"><strong>' + login + '</strong></span>?</p></div>' +
        '<div class="col-12">' +
        '<button type="button" class="btn badge-success btn-block" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">НЕТ</span></button>' +
        '<button id="update_sitemail" type="button" class="btn badge-danger btn-block" onclick="removedFinish(\'' + id + '\')">ДА </button>' +
        '</div>';
    $('#removedinfo').html(html);
    $('#removed').fadeIn().modal('show');
}

function removedFinish(id) {
    $.post('/users-adm/removed', {id: id}, function (res) {
        if (!res[0].success) {
            var html = '<div class="alert alert-danger" role="alert"><strong>' + res[0].err + '</strong></div>';
            $('#systeminfo').html(html);
            setTimeout(function () {
                $('#system').fadeOut().modal('hide');
            }, 3000);
            $('#system').fadeIn().modal('show');
        }
        $('#' + id).remove();
        $('#removed').fadeOut().modal('hide');
    });
}
