var breadcrumbTextXl = $('#breadcrumb-xl').html();
var breadcrumbTextXs = $('#breadcrumb-xs').html();

$('#searchText-right').on('keyup', function () {
    var text = $('#searchText-right').val().trim().replace(/<[^>]+>/g, '');
    $('#main-search').html('');
    search(text, 'breadcrumb-xl', breadcrumbTextXl)
});
$('#searchText').on('keyup', function () {
    var text = $('#searchText').val().trim().replace(/<[^>]+>/g, '');
    $('#main-search').html('');
    search(text, 'breadcrumb-xs', breadcrumbTextXs)
});
function search(text, breadcrumb, breadcrumbText){

    if (text.length < 3) {
        $('#'+breadcrumb).html(breadcrumbText);
        $('#main').attr('style', 'display: block;');
        $('#pagination').attr('style', 'display: block;');
        $('#breadcrumb_title').text($('#breadcrumb_hidden').val().trim());
        $('#main-search').empty('');
        $('#main-search').attr('style', 'display: none;');
        return;//если мение 3х букв в запросе выходим
    }
    if (breadcrumb === 'breadcrumb-xl'){
        $('#'+breadcrumb).html('<ul class="breadcrumb">\n' +
            '<li class="breadcrumb-item"><a href="/">Головна</a></li>\n' +
            '<li class="breadcrumb-item active">Швидкий пошук</li>\n' +
            '                </ul>');
    }else {
        $('#'+breadcrumb).html('<ul class="breadcrumb breadcrumb-sm">\n' +
            '<li class="breadcrumb-item"><a href="/">Головна</a></li>\n' +
            '<li class="breadcrumb-item active">Швидкий пошук</li>\n' +
            '                </ul>');
    }

    $('#main').attr('style', 'display: none !important;');
    $('#pagination').attr('style', 'display: none !important;');
    $('#breadcrumb_title').text('Швидкий пошук');
    $.post('/search/make', {text: text}, function (res) {

        if (res[0][0].data.length == 0) {
            $('#main-search').attr('style', 'display: block;');
            $('#main-search').prepend('<p>На жаль по вашому запиту нічого не знайдено. Спробуйте змінити критерії пошуку, або скористатися сторінкою <a href="/search">розширеного пошуку</a></p>');
            return;
        }

        $('#main-search').empty('');
        $('#main-search').attr('style', 'display: block;');
        var len = res[0][0].data.length;

        var html = '';
        for (var i = 0; i < len; i++) {
            html = '<article role="article">\n' +
                '    <div class="blog_left_sidebar">\n' +
                '        <div class="blog_item">\n' +
                '            <div class="blog_details">\n' +
                '                <div class="col-12 text-center"><a class="d-inline-block" target="_blank" href="/blog/article/' + res[0][0].data[i].url + '">\n' +
                '                    <h2  style="font-size: 28px !important;">' + res[0][0].data[i].title + '</h2>\n' +
                '                </a></div>\n' +
                '               <div class="row"><div class="col-md-4">' +
                '            <div class="blog_item_img">\n' +
                '                <a href="/public/pic/img-art/' + res[0][0].data[i].file + '" class="progressive replace card-img">\n' +
                '                    <img src="/public/pic/img-art/' + res[0][0].data[i].file + '" class="preview card-img" alt="' + res[0][0].data[i].alt + '"/>\n' +
                '                </a>\n' +
                '            </div>\n' +
                '           </div>\n' +
                '               <div class="col-md-8">\n' +
                '                <p>' + res[0][0].data[i].intro + '</p>\n' +
                '                <div class="col-12" style="min-height: 20px">\n' +
                '                    <span class=" news_more float-right">\n' +
                '                        <a target="_blank" href="/blog/article/' + res[0][0].data[i].url + '">Детальніше</a>\n' +
                '                    </span>\n' +
                '                </div>\n' +
                '               </div></div>\n' +
                '            </div>\n' +
                '        </div>\n' +
                '    </div>\n' +
                '</article>';

            $('#main-search').append(html);
        }
        $('#main-search').append('<p>Якщо Ви не знайшли того, що шукали, скористайтеся сторінкою <a href="/search">розширеного пошуку</a></p>');
    });
}

