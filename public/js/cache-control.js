function forgetAllSmarty() {
    var cache = true;
    var type = 'smarty';
    $.post('/cache-adm/removeAll', {cache: cache, type: type}, function (res) {
        if (res[0].success) {
            $('#systeminfo').html('<div class="alert alert-success" role="alert"><strong class="lead">Выполнено: </strong>'+res[0].err+'</div>');
            setTimeout(function () {
                $('#system').fadeOut().modal('hide');
            }, 3000);
            $('#system').fadeIn().modal('show');
        }
    })
}

function forgetAllData() {
    var cache = true;
    var type = 'data';

    $.post('/cache-adm/removeAll', {cache: cache, type: type}, function (res) {
        if (res[0].success) {
            var html = '<div class="alert alert-success" role="alert"><strong class="lead">Выполнено: </strong>'+res[0].err+'</div>';
            $('#systeminfo').html(html);
              setTimeout(function () {
              $('#system').fadeOut().modal('hide');
          }, 3000);
            $('#system').fadeIn().modal('show');
        }
    })
}