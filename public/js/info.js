$(".edit").on("contextmenu", function () {
    var id = $(this).attr("id");

    switch (true) {
        case id === 'ico' || id === 'logo':
            var oldHtml = $('#' + id).html().trim();
            var html = '<div class="row"><input type="file" id="new_' + id + '" name="new_' + id + '" class="mt-2" style="width: 200px">' +
                '<button id="update_' + id + '" class="btn badge-success btn-sm ml-2" onclick="endPicUpdate(\'' + id + '\')"><i class="fas fa-file-download"></i></button></div>';
            $('#' + id).html(html);
            esc(id, oldHtml);
            break;
        case id === 'pss_admin':
            var text = $('#' + id).text().trim();
            var oldHtml = $('#' + id).html().trim();
            var html = '<div class="row"><input id="new_' + id + '" class="form-control  form-control-sm" style="width: 150px" type="password" value="' + text + '" >' +
                '<button id="update_' + id + '" class="btn badge-success btn-sm ml-2" onclick="endUpdate(\'' + id + '\')"><i class="fas fa-save"></i></button></div>';
            $('#' + id).html(html);
            $('#new_' + id).select();//выделить текст
            esc(id, oldHtml);//esc.js подключен в admin/layout.tpl
            break;

        default:
            var text = $('#' + id).text().trim();
            var oldHtml = $('#' + id).html().trim();
            var html = '<div class="row"><input id="new_' + id + '" class="form-control  form-control-sm" style="width: 150px" type="text" value="' + text + '" >' +
                '<button id="update_' + id + '" class="btn badge-success btn-sm ml-2" onclick="endUpdate(\'' + id + '\')"><i class="fas fa-save"></i></button></div>';
            $('#' + id).html(html);
            $('#new_' + id).select();//выделить текст
            esc(id, oldHtml);//esc.js подключен в admin/layout.tpl
            break;
    }
});

$(document).ready(function () {// отловим нажатие на энтер
    $(".edit").keyup(function (event) {
        var id = $(this).attr('id');// определяем id активного элемента
        var key = event.which;// определяем нажатую клавишу
        if (key === 13 && id !== 'ico' && id !== 'logo') {
            endUpdate(id);
        }
        ;
    });
});

function endUpdate(id) {
    var text = $('#new_' + id).val().trim().replace(/<[^>]+>/g, '');
    if (id === 'sitemail' && text.indexOf('@') <= 0 || id === 'sitemail' && text.indexOf('.') <= 0 || id === 'adminmail' && text.indexOf('@') <= 0 || id === 'adminmail' && text.indexOf('.') <= 0) {
        var html = '<div class="alert alert-danger" role="alert"><strong>Введите действительный адрес электронной почты.</strong></div>';
        $('#systeminfo').html(html);
        setTimeout(function () {
            $('#system').fadeOut().modal('hide');
        }, 7000);
        $('#system').fadeIn().modal('show');
        return;
    }

    $.post('/info-adm/update', {text: text, column: id}, function (res) {

        if (!res[0].success) {
            var html = '<div class="alert alert-danger" role="alert"><strong class="lead">Ошибка: </strong>' + res[0].err + '</div>';
            $('#systeminfo').html(html);
            setTimeout(function () {
                $('#system').fadeOut().modal('hide');
            }, 7000);
            $('#system').fadeIn().modal('show');
            return;
        }
        if (id === 'pss_admin') {
            $('#' + id).html('<span class="lead">**********</span>').attr('style', 'color: #a80000;');
            $('#update_' + id).html('<i class="fas fa-pencil-alt"></i>').attr('class', 'btn badge-primary btn-sm').attr('onclick', 'updateStart(\'' + id + '\')');
            return;
        }
        $('#' + id).html('<span class="lead"><b>' + text + '</b></span>').attr('style', 'color: #a80000;');/*для отображения в броузере передаем новое значение категории в таблицу name*/
        $('#update_' + id).html('<i class="fas fa-pencil-alt"></i>').attr('class', 'btn badge-primary btn-sm').attr('onclick', 'updateStart(\'' + id + '\')');
    });

}

$('#cechetime').change(function () {// изменяет значение select при клике
    var text = $('#cechetime').val();
    $.post('/info-adm/update', {text: text, column: 'cechetime'}, function (res) {
        if (!res[0].success) {
            var html = '<div class="alert alert-danger" role="alert"><strong class="lead">Ошибка: </strong>' + res[0].err + '</div>';
            $('#systeminfo').html(html);
            setTimeout(function () {
                $('#system').fadeOut().modal('hide');
            }, 7000);
            $('#system').fadeIn().modal('show');
        }
    });
})

$("#social").change(function () {// изменяет значение select при клике
    var text = $('#social').val();
    $.post('/info-adm/update', {text: text, column: 'social'}, function (res) {
        if (!res[0].success) {
            var html = '<div class="alert alert-danger" role="alert"><strong class="lead">Ошибка: </strong>' + res[0].err + '</div>';
            $('#systeminfo').html(html);
            setTimeout(function () {
                $('#system').fadeOut().modal('hide');
            }, 7000);
            $('#system').fadeIn().modal('show');
        }
    });
})

function endPicUpdate(id) {
    var img = $('#new_' + id).prop('files')[0];
    var data = new FormData();
    data.append('file', img);
    data.append('column', id);
    $.ajax({
        url: '/info-adm/update',
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
                $('#' + id).html('<img src="/public/pic/res/' + res[0].name_pic_old + '" style="width: 40px; height: auto">');
                return;
            }
            $('#' + id).html('<img src="/public/pic/res/' + res[0].name_pic + '" style="width: 40px; height: auto">');
        }
    });
}



