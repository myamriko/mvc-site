/*при нажатии на элемент определяем id*/
$("td").on("contextmenu", function () {
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
                    $.post('/link-adm/update', data, function (res) {
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
                });
                break;
            default :
                var oldHtml = $('#' + id).html().trim();
                var html = "<div class='row'><input id='new_" + id + "' class='form-control  form-control-sm width-mob' type='text' value='" + text + "' >" +
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
    $.post('/link-adm/update', data, function (res) {
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
        if (res[0].url) {
            text = res[0].url;
        }
        $('#' + id).html('<b>' + text + '</b>').attr('style', 'color: #a80000;');
    });
}

function add_link(menu_name) {
    var menu_name = menu_name.trim().replace(/<[^>]+>/g, '');
    var title = $('#title').val().trim().replace(/<[^>]+>/g, '');
    var description = $('#description').val().trim().replace(/<[^>]+>/g, '');
    var url = $('#url').val().trim().replace(/<[^>]+>/g, '');
    var enabled = $('#enabled').val().trim().replace(/<[^>]+>/g, '');
    var data = {
        menu_name: menu_name,
        title: title,
        description: description,
        url: url,
        enabled: enabled
    };
    if (!title || !description || !url) {
        $('#message').text(' Все поля обязательны для заполнения');
        $('#menu_err').fadeIn().show();
        return;
    }
    $.post('/link-adm/add', data, function (res) {
        if (!res[0].success) {
            $('#message').text(res[0].err);
            $('#menu_err').fadeIn().show();
            return;
        }
        if (res[0].success === '0') {
            $('#message').text(' такой URL уже существует');
            $('#menu_err').fadeIn().show();
            return;
        }
        $('#empty').html('');
        var html = '<tr id="' + res[0].success + '" style="color: #a80000; font-weight: bold;">\n' + //id передаем как res[0].success
            '<td >' + res[0].success + '</td>\n' +
            '<td >' + title + '</td>\n' +
            '<td >' + description + '</td>\n' +
            '<td >' + res[0].url + '</td>\n' +
            '<td >' + enabled + '</td>\n' +
            '<td>\n' +
            '  <button class="btn btn-linc btn-sm text-danger" onclick=" "><i class="far fa-trash-alt"></i> Удалить</button>\n' +
            '</td>\n' +
            '</tr>';
        $('#holder').prepend(html);
        $('#menu-add').modal('toggle');//закрыть модаль
    });
}

$(document).ready(function () {// отловим нажатие на энтер
    $("td").keyup(function (event) {
        var id = $(this).attr('id');// определяем id активного элемента
        var idr = id.replace(/[0-9-]/g, '');
        var key = event.which;// определяем нажатую клавишу
        if (key === 13 && idr !== 'enabled'){
            updateMenu(id);
        };
    });
});