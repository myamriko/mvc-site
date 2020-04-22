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
            $('#systeminfo').html('<div class="alert alert-danger" role="alert">' +
                '    <strong>Error:'+res[0].err+'</strong>' +
                '</div>');
            setTimeout(function () {
                $('#system').fadeOut().modal('hide');
            }, 5000);
            $('#system').fadeIn().modal('show');
            return;
        }
        $('#tag').val('');
        $('#empty').html('');
        var html = '<tr id="' + res[0].success + '" style="color: #a80000; font-weight: bold;">\n' + //id передаем как res[0].success
            '<td >' + res[0].success + '</td>\n' +
            '<td >' + tag + '</td>\n' +
            '<td >' + res[0].url + '</td>\n' +
            '<td>\n' +
            '  <button class="btn btn-linc btn-sm text-danger" onclick=" "><i class="far fa-trash-alt"></i> Удалить</button>\n' +
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