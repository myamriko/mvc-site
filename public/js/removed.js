function removedStart(id, param, controller) {
    var html = '<div class="col-12"><p class="alert alert-info">Вы действительно хотите удалить <span class="lead"><strong>' + param + '</strong></span>?</p></div>' +
        '<div class="col-12">' +
        '<button type="button" class="btn badge-success btn-block" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">НЕТ</span></button>' +
        '<button id="update_sitemail" type="button" class="btn badge-danger btn-block" onclick="removedFinish(\'' + id + '\',\'' + controller+ '\')">ДА </button>' +
        '</div>';
    $('#removedinfo').html(html);
    $('#removed').fadeIn().modal('show');
}

function removedFinish(id,controller) {
    $.post('/'+controller+'-adm/removed', {id: id}, function (res) {
        if (!res[0].success) {
            var html = '<div class="alert alert-danger" role="alert"><strong>' + res[0].err + '</strong></div>';
            $('#systeminfo').html(html);
            setTimeout(function () {
                $('#system').fadeOut().modal('hide');
            }, 5000);
            $('#system').fadeIn().modal('show');
            $('#removed').fadeOut().modal('hide');
            return;
        }
        $('#' + id).remove();
        $('#removed').fadeOut().modal('hide');
    });
}