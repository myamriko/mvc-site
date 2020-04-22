$(document).ready(function () {//изменим кол-во ссылок на странице
    $(".pageLimit").keyup(function (event) {
        var text = $(this).val();// определяем id активного элемента
        var id = $(this).attr('id');
        var cacheName = $(this).attr('data-cache');
        var key = event.which;// определяем нажатую клавишу
        var data = {
            text: text,
            column: id,
            cacheName: cacheName
        };
        if (key === 13) {
            $.post('/info-adm/update', data, function (res) {
                    if (!res[0].success) {
                        var html = '<div class="alert alert-danger" role="alert"><strong>' + res[0].err + '</strong></div>';
                        $('#systeminfo').html(html);
                        setTimeout(function () {
                            $('#system').fadeOut().modal('hide');
                        }, 5000);
                        $('#system').fadeIn().modal('show');
                        return;
                    }
                    document.location.reload(true);
                }

            )
            ;
        }
    });
});