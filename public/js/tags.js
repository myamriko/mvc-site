function add_tag() {

    var tag = $('#tag').val().trim().replace(/<[^>]+>/g, '');
    if (!tag) {
        $('#systeminfo').html('<div class="alert alert-danger" role="alert">' +
            '    <strong>Error: Все поля обязательны для заполнения ;)</strong>' +
            '</div>');
        setTimeout(function () {
            $('#system').fadeOut().modal('hide');
        }, 3000);
        $('#system').fadeIn().modal('show');
        return;
    }
    $.post('/tags-adm/add', {tag: tag}, function (res) {
        if (!res[0].success) {
            $('#systeminfo').html('<div class="alert alert-danger" role="alert"><strong class="lead">Ошибка: </strong>'+res[0].err+'</div>');
            setTimeout(function () {
                $('#system').fadeOut().modal('hide');
            }, 7000);
            $('#system').fadeIn().modal('show');
            return;
        }
        $('#tag').val('');
        $('#empty').html('');
        var html = '<tr id="' + res[0].success + '" style="color: #a80000; font-weight: bold;">\n' + //id передаем как res[0].success
            '<td data-label="Id">' + res[0].success + '</td>\n' +
            '<td data-label="Тег">' + tag + '</td>\n' +
            '<td data-label="URL">' + res[0].url + '</td>\n' +
            '<td data-label=" ">\n' +
            '  <button class="btn btn-linc btn-sm text-danger" onclick="removedStart(\''+ res[0].success +'\',\' '+ tag +'\',\'tags\' )"><i class="far fa-trash-alt"></i> Удалить</button>\n' +
            '</td>\n' +
            '</tr>';
        $('#holder').prepend(html);
    });
}

$(document).ready(function () {// отловим нажатие на энтер
    $(".add").keyup(function (event) {
        var key = event.which;// определяем нажатую клавишу
        if (key === 13){
            add_tag();
        };
    });
});