function reSend(id) {
    $.post('/contact-adm/send',{id: id},function (res) {
        if (!res[0].success){
            var html = '<div class="alert alert-danger" role="alert"><strong>Ошибка:</strong> ' + res[0].err + '</div>';
            $('#systeminfo').html(html);
            setTimeout(function () {
                $('#system').fadeOut().modal('hide');
            }, 10000);
            $('#system').modal('show');
            return;
        }
        $('#idMess').val(res[0].id);
        $('#mailTo').val(res[0].mailTo);
        $('#subject').val('Re:'+res[0].subject);
        var mess = '<p>Имя: <span id="name">' + res[0].name +  '</span><br>'+
        '@mail: ' + res[0].mailTo + '<br>'+
        'Телефон: <span id="phone">' + res[0].phone + '</span><br>'+ res[0].date +'</p>'+
        '<p id="messageRe">'+ res[0].message + '</p>';
        $('#mess').html(mess);
        $('#reply').modal('show');
    });
}



function reply() {

    var id = $('#idMess').val().trim().replace(/<[^>]+>/g, '');
    var name = $('#name').text().trim().replace(/<[^>]+>/g, '');
    var mail = $('#mailTo').val().trim().replace(/<[^>]+>/g, '');
    var phone = $('#phone').text().trim().replace(/<[^>]+>/g, '');
    var subject = $('#subject').val().trim().replace(/<[^>]+>/g, '');
    var copyCC = $('#copyCC').val().trim().replace(/<[^>]+>/g, '');
    var copyBCC = $('#copyBCC').val().trim().replace(/<[^>]+>/g, '');
    var message = $('#messageRe').text().trim().replace(/<[^>]+>/g, '');
    var text = myEditor.getData();
    var htmlBtn = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Отменить</button>\n' +
        '          <button id="btnSend" type="button" class="btn btn-primary" onclick="reply()" disabled>Отправить</button>';

    $('#btnSend').html(htmlBtn);

    var data = new FormData();
    data.append('id', id);
    data.append('name', name);
    data.append('mail', mail);
    data.append('phone', phone);
    data.append('copyCC', copyCC);
    data.append('copyBCC', copyBCC);
    data.append('subject', subject);
    data.append('text', text);
    data.append('message', message);

    $.ajax({
        url: '/contact-adm/reply',
        type: 'POST',
        cache: false,
        processData: false,
        contentType: false,
        data: data,

        success: function (res) {
             htmlBtn = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Отменить</button>\n' +
                 '      <button id="btnSend" type="button" class="btn btn-primary" onclick="reply()">Отправить</button>';
            if (!res[0].success){
                var html = '<div class="alert alert-danger" role="alert"><strong>Ошибка:</strong> ' + res[0].err + '</div>';
                $('#reply').modal('hide');
                $('#systeminfo').html(html);
                setTimeout(function () {
                    $('#system').fadeOut().modal('hide');
                }, 7000);
                $('#system').modal('show');
                $('#btnSend').html(htmlBtn);
                return;
            }
            var html = '<div class="alert alert-success" role="alert">' + res[0].err + '</div>';
            $('#reply').modal('hide');
            $('#systeminfo').html(html);
            setTimeout(function () {
                $('#system').fadeOut().modal('hide');
            }, 5000);
            myEditor.setData('');
            $('#resend-'+id).remove();
            $('#holder-'+id).append('<div class="col-1 text-success"><i class="fas fa-share-square"></i></div>');
            $('#system').modal('show');
            $('#btnSend').html(htmlBtn);
        }
    });
}