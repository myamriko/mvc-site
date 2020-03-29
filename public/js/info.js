function updateStart(id) {
    var text = $('#' + id).text().trim();
    var html = "<input id='new_" + id + "' class='form-control  form-control-sm' style='width: 150px' type='text' value='" + text + "' >";
    $('#' + id).html(html);
    $('#new_' + id).select();//выделить текст
    $('#update_' + id).html('<i class="far fa-save"></i>').attr('class', 'btn badge-success btn-sm').attr('onclick', 'endUpdate(\'' + id + '\')');
}


function endUpdate(id) {
    var text = $('#new_' + id).val().trim().replace(/<[^>]+>/g, '');

    $.post('/infoadm/update', {text: text, column: id}, function (res) {
        if (!res[0].success) {
            var html = '<div class="alert alert-danger" role="alert"><strong>' + res[0].err + '</strong></div>';
            $('#systeminfo').html(html);
            setTimeout(function () {
                $('#system').fadeOut().modal('hide');
            }, 3000);
            $('#system').fadeIn().modal('show');
            var html = "<input id='new_" + id + "' class='form-control  form-control-sm' style='width: 150px' type='text' value='" + text + "' >";
            $('#' + id).html(html);
            $('#update_' + id).html('<i class="far fa-save"></i>').attr('class', 'btn badge-success btn-sm').attr('onclick', 'endUpdate(\'' + id + '\')');
            return;
        }
    });
    $('#' + id).html('<span class="lead"><b>' + text + '</b></span>').attr('style', 'color: #a80000;');/*для отображения в броузере передаем новое значение категории в таблицу name*/
    $('#update_' + id).html('<i class="fas fa-pencil-alt"></i>').attr('class', 'btn badge-primary btn-sm').attr('onclick', 'updateStart(\'' + id + '\')');
}

$('#cechetime').change(function () {// изменяет значение select при клике
    var text = $('#cechetime').val();
    $.post('/infoadm/update', {text: text, column: 'cechetime'}, function (res) {
        console.log(res[0].success)
        if (!res[0].success) {
            var html = '<div class="alert alert-danger" role="alert"><strong>' + res[0].err + '</strong></div>';
            $('#systeminfo').html(html);
            setTimeout(function () {
                $('#system').fadeOut().modal('hide');
            }, 3000);
            $('#system').fadeIn().modal('show');
        }
    });
})

$("#social").change(function () {// изменяет значение select при клике
    var text = $('#social').val();
    $.post('/infoadm/update', {text: text, column: 'social'}, function (res) {
        console.log(res[0].success)
        if (!res[0].success) {
            var html = '<div class="alert alert-danger" role="alert"><strong>' + res[0].err + '</strong></div>';
            $('#systeminfo').html(html);
            setTimeout(function () {
                $('#system').fadeOut().modal('hide');
            }, 3000);
            $('#system').fadeIn().modal('show');
        }
    });
})

function updatePicStart(id) {
    var html = '<input type="file" id="new_' + id + '" name="new_' + id + '" class="mt-2">';
    $('#' + id).html(html);
    $('#update_' + id).html('<i class="far fa-save"></i>').attr('class', 'btn badge-success btn-sm').attr('onclick', 'endPicUpdate(\'' + id + '\')');
}

function endPicUpdate(id) {
    var img = $('#new_' + id).prop('files')[0];
    console.log(img);
    var data = new FormData(); // создаем объект FormData для передачи через аякс данных на сервер
    data.append('file', img);
    data.append('column', id);
    $.ajax({
        url: '/infoadm/update', /*url где обрабатываем данные*/
        type: 'POST',/*метод передачи*/
        cache: false,/*кеш не используем, нам он тут не надо*/
        processData: false,// отключаем приобразование в строку, чтобы отправить фаил. Данные передадутся как есть
        contentType: false,// при передаче данных серверу сообщает content-type. По умолчанию - application/x-www-form-urlencoded. отключаем что бы сервер не говорил что это строка
        data: data,

        success: function (res) {
            if (!res[0].success) {
                var html = '<div class="alert alert-danger" role="alert"><strong>' + res[0].err + '</strong></div>';
                $('#systeminfo').html(html);
                setTimeout(function () {
                    $('#system').fadeOut().modal('hide');
                }, 3000);
                $('#system').fadeIn().modal('show');
                return;
            }
            $('#' + id).html('<img src="/public/pic/res/' + res[0].name_pic + '" style="width: 40px; height: auto">');
            $('#update_' + id).html('<i class="fas fa-file-download"></i>').attr('class', 'btn badge-primary btn-sm').attr('onclick', 'updatePicStart(\'' + id + '\')');


        }
    });

}

