function imgView(urlimg, alt) {
    var html = '<img class="img-thumbnail" style="width: 800px;"  src="/public/pic/img-art/' + urlimg + '"><span class="img-thumbnail alt">Alt: ' + alt + '</span>';
    $('#show-img').html(html);
    $('#img').fadeIn().modal('show');
}

function add() {
    var title = $('#titleArticle').val().trim().replace(/<[^>]+>/g, '');
    var intro = $('#introArticle').val().trim().replace(/<[^>]+>/g, '');
    var text = myEditor.getData();
    var tags = $('#tagsArticle').val().trim().replace(/<[^>]+>/g, '');
    var url = $('#urlArticle').val().trim().replace(/<[^>]+>/g, '');
    var category = $('#categoryArticle').val().trim().replace(/<[^>]+>/g, '');
    var author = $('#authorArticle').val().trim().replace(/<[^>]+>/g, '');
    var alt = $('#altArticle').val().trim().replace(/<[^>]+>/g, '');
    var file = $('#filesArticle').prop('files')[0];
    var published = $('#publishedArticle').val().trim().replace(/<[^>]+>/g, '');
    var front = $('#frontArticle').val().trim().replace(/<[^>]+>/g, '');
    var time = new Date().toLocaleString();

    var data = new FormData();
    data.append('title', title);
    data.append('intro', intro);
    data.append('text', text);
    data.append('tags', tags);
    data.append('url', url);
    data.append('category', category);
    data.append('author', author);
    data.append('alt', alt);
    data.append('file', file);
    data.append('published', published);
    data.append('front', front);

    $.ajax({
        url: '/articles-adm/add',
        type: 'POST',
        cache: false,
        processData: false,
        contentType: false,
        data: data,

        success: function (res) {
            console.log(res[0].success);
            if (!res[0].success || res[0].success == 0) {
                $('#messageArticle').text(res[0].err);
                $('#errArticle').fadeIn().show();
                return;
            }
            $('#errArticle').fadeOut();
            // если удачно удаляем внесенные в модаль значения
            $('#titleArticle').val('');
            $('#introArticle').val('');
            myEditor.setData('');
            $('#tagsArticle').val('');
            $('#urlArticle').val('');
            $('#categoryArticle').val('');
            $('#authorArticle').val('');
            $('#altArticle').val('');
            $('#filesArticle').val('');
            $('#publishedArticle').val('');
            $('#frontArticle').val('');
            var html = '<tr id="' + res[0].success + '">\n' +
                '                            <td id="id" data-label="Id">' + res[0].success + '</td>\n' +
                '                            <td data-label="Название"><a class="text-dark text-uppercase" href="/article/' + res[0].url + '">' + title + '</a></td>\n' +
                '                            <td data-label="Описание">' + intro + '</td>\n' +
                '                            <td data-label="Категория"><a class="text-dark" href="/category/' + res[0].category + '">' + category + '</a></td>\n' +
                '                            <td data-label="Теги">' + res[0].tags + '</td>\n' +
                '                            <td data-label="Картинка"><a data-toggle="modal"\n' +
                '                                   onclick="imgView(\'' + res[0].file + '\',\'' + alt + '\')"\n' +
                '                                   href="#"><img class="img-thumbnail" style="height: 70px;"\n' +
                '                                                 src="/public/pic/img-art/' + res[0].file + '"></a>\n' +
                '                            </td>\n' +
                '                            <td data-label="Дата">' + time + '</td>\n' +
                '                            <td data-label="Аффтар">' + author + '</td>\n' +
                '                            <td data-label="Публикация">' + published + '</td>\n' +
                '                            <td data-label="Главная">' + front + '</td>\n' +
                '                            <td data-label=" ">\n' +
                '                                <div class="btn-group dropleft">\n' +
                '                                    <button type="button" class="btn btn-outline-secondary btn-sm dropdown-toggle"\n' +
                '                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">\n' +
                '                                        Редактировать\n' +
                '                                    </button>\n' +
                '                                    <div class="dropdown-menu">\n' +
                '                                        <button type="button" class="dropdown-item text-success"\n' +
                '                                                onclick="edit(\'' + res[0].success + '\')"><i class="far fa-edit"></i>\n' +
                '                                            Изменить\n' +
                '                                        </button>\n' +
                '                                        <div class="dropdown-divider"></div>\n' +
                '                                        <button type="button" class="dropdown-item text-danger"\n' +
                '                                                onclick="removedStart(\'' + res[0].success + '\',\'' + title + '\',\'articles\')">\n' +
                '                                            <i class="far fa-trash-alt"></i>\n' +
                '                                            Удалить\n' +
                '                                        </button>\n' +
                '                                    </div>\n' +
                '                                </div>\n' +
                '                            </td>\n' +
                '                        </tr>';
            $('#holder').prepend(html);
            $('#article-add').fadeOut().modal('hide');
        }
    });
}

function edit(id) {
    $('#catdef').remove();
    $('#errEdit').fadeOut();
    $('img').val('');
    $.post('/articles-adm/edit', {id: id}, function (res) {
        if (!res[0].success) {
            $('#systeminfo').html('<div class="alert alert-danger" role="alert"><strong class="lead">Ошибка: </strong>' + res[0].err + '</div>');
            setTimeout(function () {
                $('#system').fadeOut().modal('hide');
            }, 7000);
            $('#system').fadeIn().modal('show');
            return;
        }
        $('#id-article').val(id);
        $('#titleEdit').val(res[0].title);
        $('#introEdit').val(res[0].intro);
        myEditorEdit.setData(res[0].text);
        $('#tagsEdit').val(res[0].tags);
        $('#urlEdit').val(res[0].url);
        $('#categoryEdit').prepend('<option id="catdef" selected value="' + res[0].category + '">' + res[0].name + '</option>');
        $('#altEdit').val(res[0].alt);
        var img = '<img class="mb-2" style="width: 100%;" src="/public/pic/img-art/' + res[0].file + '">' +
            '<input id="oldFile" type="hidden" value="' + res[0].file + '">';
        $('#imgEdit').html(img);
        $('#publishedEdit').prepend('<option selected value="' + res[0].published + '">' + res[0].published + '</option>');
        $('#frontEdit').prepend('<option selected value="' + res[0].front + '">' + res[0].front + '</option>');
        $('#article-edit').modal('show');
    })
}

function update() {
    var id = $('#id-article').val().trim().replace(/<[^>]+>/g, '');
    var title = $('#titleEdit').val().trim().replace(/<[^>]+>/g, '');
    var intro = $('#introEdit').val().trim().replace(/<[^>]+>/g, '');
    var text = myEditorEdit.getData();
    var tags = $('#tagsEdit').val().trim().replace(/<[^>]+>/g, '');
    var url = $('#urlEdit').val().trim().replace(/<[^>]+>/g, '');
    var category = $('#categoryEdit').val().trim().replace(/<[^>]+>/g, '');
    var author = $('#authorEdit').val().trim().replace(/<[^>]+>/g, '');
    var alt = $('#altEdit').val().trim().replace(/<[^>]+>/g, '');
    var file = $('#filesEdit').prop('files')[0];
    var oldFile = $('#oldFile').val();
    var published = $('#publishedEdit').val().trim().replace(/<[^>]+>/g, '');
    var front = $('#frontEdit').val().trim().replace(/<[^>]+>/g, '');
    var time = new Date().toLocaleString();

    var data = new FormData();
    data.append('id', id);
    data.append('title', title);
    data.append('intro', intro);
    data.append('text', text);
    data.append('tags', tags);
    data.append('url', url);
    data.append('category', category);
    data.append('author', author);
    data.append('alt', alt);
    data.append('file', file);
    data.append('oldFile', oldFile);
    data.append('published', published);
    data.append('front', front);


    $.ajax({
        url: '/articles-adm/update',
        type: 'POST',
        cache: false,
        processData: false,
        contentType: false,
        data: data,

        success: function (res) {
            if (!res[0].success || res[0].success == 0) {
                $('#messageEdit').text(res[0].err);
                $('#errEdit').fadeIn().show();
                return;
            }
            $('#err').fadeOut();
            // если удачно удаляем внесенные в модаль значения
            $('#title').val('');
            $('#intro').val('');
            myEditor.setData('Текст статьи');
            $('#url').val('');
            $('#category').val('');
            $('#author').val('');
            $('#alt').val('');
            $('#files').val('');
            $('#published').val('');
            $('#front').val('');
            var html = '<tr id="' + id + '">\n' +
                '                            <td id="id" data-label="Id">' + id + '</td>\n' +
                '                            <td data-label="Название"><a class="text-dark text-uppercase" href="/article/' + res[0].url + '">' + title + '</a></td>\n' +
                '                            <td data-label="Описание">' + intro + '</td>\n' +
                '                            <td data-label="Категория"><a class="text-dark" href="/category/' + res[0].category + '">' + category + '</a></td>\n' +
                '                            <td data-label="Теги">' + res[0].tags + '</td>\n' +
                '                            <td data-label="Картинка"><a data-toggle="modal"\n' +
                '                                   onclick="imgView(\'' + res[0].file + '\',\'' + alt + '\')"\n' +
                '                                   href="#"><img class="img-thumbnail" style="height: 70px;"\n' +
                '                                                 src="/public/pic/img-art/' + res[0].file + '"></a>\n' +
                '                            </td>\n' +
                '                            <td data-label="Дата">' + time + '</td>\n' +
                '                            <td data-label="Аффтар">' + author + '</td>\n' +
                '                            <td data-label="Публикация">' + published + '</td>\n' +
                '                            <td data-label="Главная">' + front + '</td>\n' +
                '                            <td data-label=" ">\n' +
                '                                <div class="btn-group dropleft">\n' +
                '                                    <button type="button" class="btn btn-outline-secondary btn-sm dropdown-toggle"\n' +
                '                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">\n' +
                '                                        Редактировать\n' +
                '                                    </button>\n' +
                '                                    <div class="dropdown-menu">\n' +
                '                                        <button type="button" class="dropdown-item text-success"\n' +
                '                                                onclick="edit(\'' + id + '\')"><i class="far fa-edit"></i>\n' +
                '                                            Изменить\n' +
                '                                        </button>\n' +
                '                                        <div class="dropdown-divider"></div>\n' +
                '                                        <button type="button" class="dropdown-item text-danger"\n' +
                '                                                onclick="removedStart(\'' + id + '\',\'' + title + '\',\'articles\')">\n' +
                '                                            <i class="far fa-trash-alt"></i>\n' +
                '                                            Удалить\n' +
                '                                        </button>\n' +
                '                                    </div>\n' +
                '                                </div>\n' +
                '                            </td>\n' +
                '                        </tr>';
            $('#' + id).remove();
            $('#holder').prepend(html);
            $('#article-edit').fadeOut().modal('hide');
        }
    });
}




