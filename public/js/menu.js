/*при нажатии на элемент определяем id*/
$("td").on("dblclick", function () {
    var id = $(this).attr("id");
    if (id) {
        var text = $('#' + id).text().trim();
        var idr = id.replace(/[0-9-]/g, '');
        switch (true) {
            /*для отображения*/
            case idr === 'enabled':
                var oldHtml = $('#' + id).html().trim();
                var html = '<select name="new_' + id + '" id="new_' + id + '"  class="form-control" style=\'width: 100px\'>\n' +
                    '                                    <optgroup label="ВКЛ/ВЫКЛ">\n' +
                    '                                        <option value=\'ON\'>ON</option>\n' +
                    '                                        <option value=\'OFF\'>OFF</option>\n' +
                    '                                    </optgroup>\n' +
                    '                                    <optgroup label="Отображение:">\n' +
                    '                                        <option selected value="' + text + '">' + text + '</option>\n' +
                    '                                    </optgroup>\n' +
                    '                                </select>';
                $('#' + id).html(html);
                esc(id, oldHtml);//esc.js подключен в admin/layout.tpl
                /*вносим изменения*/
                $('#new_' + id).change(function () {
                    var text = $('#new_' + id).val();
                    var data = {
                        text: text,
                        id: id
                    };
                    $.post('/menu-adm/update', data, function (res) {
                        if (!res[0].success) {
                            var html = '<div class="alert alert-danger" role="alert"><strong>' + res[0].err + '</strong></div>';
                            $('#systeminfo').html(html);
                            setTimeout(function () {
                                $('#system').fadeOut().modal('hide');
                            }, 5000);
                            $('#system').fadeIn().modal('show');
                        }
                        $('#new_' + id).remove();
                        $('#' + id).html('<b>' + text + '</b>').attr('style', 'color: #a80000;');
                    });
                });
                break;
            default :
                var oldHtml = $('#' + id).html().trim();
                var html = "<div class='row'><input id='new_" + id + "' class='form-control  form-control-sm' style='width: 150px' type='text' value='" + text + "' >" +
                    "<button id='update_sitemail' type='button' class='btn badge-success btn-sm ml-2' onclick='updateMenu(\"" + id + "\")'><i class='far fa-save'></i></button></div>";
                $('#' + id).html(html);
                $('#new_' + id).select();//выделить текст в input
                esc(id, oldHtml);
                break;
        }
    }
})

function updateMenu(id) {

    var text = $('#new_' + id).val().trim().replace(/<[^>]+>/g, '');
    var data = {
        text: text,
        id: id
    };
    $.post('/menu-adm/update', data, function (res) {
        if (!res[0].success) {
            var html = '<div class="alert alert-danger" role="alert"><strong>' + res[0].err + '</strong></div>';
            $('#systeminfo').html(html);
            setTimeout(function () {
                $('#system').fadeOut().modal('hide');
            }, 5000);
            $('#system').fadeIn().modal('show');
            return;
        }
        $('#new_' + id).remove();
        $('#' + id).html('<b>' + text + '</b>').attr('style', 'color: #a80000;');
    });
}

function add_menu() {
    var menu_name = $('#menu_name').val().trim().replace(/<[^>]+>/g, '');
    var title = $('#title').val().trim().replace(/<[^>]+>/g, '');
    var description = $('#description').val().trim().replace(/<[^>]+>/g, '');
    var enabled = $('#enabled').val().trim().replace(/<[^>]+>/g, '');
    var data = {
        menu_name: menu_name,
        title: title,
        description: description,
        enabled: enabled
    };
    if (!menu_name || !title || !description) {
        $('#message').text(' Все поля обязательны для заполнения');
        $('#menu_err').fadeIn().show();
        return;
    }
    $.post('/menu-adm/add', data, function (res) {
        if (!res[0].success) {
            $('#message').text(res[0].err);
            $('#menu_err').fadeIn().show();
            return;
        }
        var html = '<tr id="' + res[0].success + '" style="color: #a80000; font-weight: bold;">\n' + //id передаем как res[0].success
            '                            <td class="align-middle">' + res[0].success + '</td>\n' +
            '                            <td class="align-middle">' + menu_name + '</td>\n' +
            '                            <td class="align-middle">' + title + '</td>\n' +
            '                            <td class="align-middle">' + description + '</td>\n' +
            '                            <td class="align-middle">' + enabled + '</td>\n' +
            '                            <td>\n' +
            '                                <div class="btn-group dropleft">\n' +
            '                                    <button type="button" class="btn btn-outline-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">\n' +
            '                                        Редактировать\n' +
            '                                    </button>\n' +
            '                                    <div class="dropdown-menu">\n' +
            '                                            <a class="dropdown-item text-success" href="/link-adm/index/' + menu_name + '"><i class="far fa-edit"></i> Изменить</a>\n' +
            '                                        <div class="dropdown-divider"></div>\n' +
            '                                            <button class="dropdown-item text-danger" onclick="removedStart(\'' + res[0].success + '\',\'' + title + '\',\'menu\' )"><i class="far fa-trash-alt"></i> Удалить</button>\n' +
            '                                    </div>\n' +
            '                                </div>\n' +
            '                            </td>\n' +
            '                        </tr>';

        $('#holder').prepend(html);
        $('#menu-add').modal('toggle');//закрыть модаль
    });
}

