function addComment() {
    $('#comment-visibility').fadeToggle("slow");
    $('#noComments').fadeToggle("slow");
}

function sendComment(id) {

    if (id) {
        var parentId = id;
        var userNameSession = $('#username_session_reply-' + id).val().trim().replace(/<[^>]+>/g, '');
        var userName = $('#username_comment_reply-' + id).val().trim().replace(/<[^>]+>/g, '');
        var userId = $('#user_id_comment_reply-' + id).val().trim().replace(/<[^>]+>/g, '');
        var article_id_comment = $('#article_id_comment_reply-' + id).val().trim().replace(/<[^>]+>/g, '');
        var article_title_comment = $('#article_title_comment_reply-' + id).val().trim().replace(/<[^>]+>/g, '');
        var text = $('#text_comment_reply-' + id).val().trim().replace(/<[^>]+>/g, '');
        var g_recaptcha_response = $('#g-recaptcha-response').val();
    } else {
        var parentId = 0;
        var userNameSession = $('#username_session').val().trim().replace(/<[^>]+>/g, '');
        var userName = $('#username_comment').val().trim().replace(/<[^>]+>/g, '');
        var userId = $('#user_id_comment').val().trim().replace(/<[^>]+>/g, '');
        var article_id_comment = $('#article_id_comment').val().trim().replace(/<[^>]+>/g, '');
        var article_title_comment = $('#article_title_comment').val().trim().replace(/<[^>]+>/g, '');
        var text = $('#text_comment').val().trim().replace(/<[^>]+>/g, '');
        var g_recaptcha_response = $('#g-recaptcha-response').val();
    }


    if (!userName || !text) {
        var html = '<div class="alert alert-danger" role="alert"><strong class="lead">Помилка:</strong> усі поля обов\'язкові для заповнення</div>';
        $('#systeminfo').html(html);
        setTimeout(function () {
            $('#system').fadeOut().modal('hide');
        }, 7000);
        $('#system').modal('show');
        return;
    }

    if (text.length < 3) {
        var html = '<div class="alert alert-danger" role="alert"><strong class="lead">Помилка:</strong> дуже короткий коментар</div>';
        $('#systeminfo').html(html);
        setTimeout(function () {
            $('#system').fadeOut().modal('hide');
        }, 5000);
        $('#system').modal('show');
        return;
    }

    var data = {
        g_recaptcha_response: g_recaptcha_response,
        userName: userName,
        userId: userId,
        article_id_comment: article_id_comment,
        article_title_comment: article_title_comment,
        text: text,
        parentId: parentId
    };

    $.post('/comments/send', data, function (res) {

        if (!res[0].success) {
            var html = '<div class="alert alert-danger" role="alert"><strong class="lead">Помилка:</strong> ' + res[0].err + '</div>';
            $('#systeminfo').html(html);
            setTimeout(function () {
                $('#system').fadeOut().modal('hide');
            }, 5000);
            $('#system').modal('show');
            return;
        }

        var avatar = !res[0].avatar ? 'anonimus.png' : res[0].avatar;
        var html = '<li id="' + res[0].success + '">\n' +
            '    <div id="add-' + res[0].success + '" class="comment-list">\n' +
            '        <div class="single-comment justify-content-between d-flex">\n' +
            '            <div class="user justify-content-between d-flex">\n' +
            '                <div class="thumb"> <img src="/public/pic/avatar/' + avatar + '"> </div>\n' +
            '                <div class="desc">\n' +
            '                    <p id="text-' + res[0].success + '" class="comment">\n' +
            res[0].text +
            '                    </p>\n' +
            '                </div>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '        <div class="d-flex justify-content-between">\n' +
            '            <div class="d-flex align-items-center">\n' +
            '                <h5>\n' +
            '                    <em style="color: #607e89; font-weight: 600;">' + res[0].username + '</em>\n' +
            '                </h5>\n' +
            '                <p id="date-' + res[0].success + '" class="date">' + res[0].date + ' </p>\n' +
            '            </div>\n' +
            '            <div class="reply-btn">\n' +
            '               <div class="row">\n';
        if (userNameSession) {
            html = html + '<a class="btn btn-del text-danger text-uppercase" onclick="remComment(\'' + res[0].success + '\', \'' + article_title_comment + '\')">вилучити</a>\n' +
                '<a class="btn btn-edit text-uppercase" onclick="editComment(\'' + res[0].success + '\',\'' + userName + '\', \'' + userNameSession + '\', \'' + article_title_comment + '\')">редагувати</a>';
        }
        html = html + '<a id="btn-reply-' + res[0].success + '" class="btn btn-reply text-uppercase" onclick="reply(\'' + res[0].success + '\',\'' + userName + '\', \'' + userNameSession + '\', \'' + article_id_comment + '\', \'' + article_title_comment + '\', \'' + userId + '\')">відповісти</a>\n' +
            '               </div>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '    </div>\n' +
            '                                                            </li>';
        if (!id) {
            $('#text_comment').val('');
            $('#comment-visibility').fadeToggle("slow");
            $('#comment_container').prepend(html);
            return;
        }
        html = '<ul>' + html + '</ul>';
        $('#text_comment_reply-' + id).val('');
        $('#comment-visibility-reply-' + id).fadeToggle("slow");
        $('#' + id).append(html);
    })

}

function remComment(id, article_title) {

    $.post('/comments/removed', {id: id, article_title: article_title}, function (res) {
        if (!res[0].success) {
            var html = '<div class="alert alert-danger" role="alert"><strong class="lead">Помилка:</strong> ' + res[0].err + '</div>';
            $('#systeminfo').html(html);
            setTimeout(function () {
                $('#system').fadeOut().modal('hide');
            }, 8000);
            $('#system').modal('show');
            return;
        }
        $('#' + id).remove();
    })

}

function editComment(id, name, sessionUserName, articleTitle) {

    $('#comment-visibility-reply-' + id).fadeOut();
    var text = $('#text-'+id).text().trim().replace(/<[^>]+>/g, '');
    var html = '<section id="comment-visibility-edit-' + id + '" class="contact_section" style="display: none; margin-bottom: -120px; margin-top: 45px;">\n' +
        '    <div class="estimate_form" style="margin-top: 0px;">\n' +
        '        <div id="comment_form_edit-' + id + '" >\n' +
        '            <div class="row">\n' +
        '                <div class="col-md-6">\n' +
        '                    <div class="contact-info">\n' +
        '                        <input id="username_comment_edit-' + id + '" type="text" placeholder="Ім\'я" value="' + sessionUserName + '">\n' +
        '                        <input id="username_session_edit-' + id + '" type="hidden" value="' + sessionUserName + '">\n' +
        '                        <input id="article_title_comment_edit-' + id + '" type="hidden" value="' + articleTitle + '">\n' +
        '                        <input id="g-recaptcha-response" type="hidden" name="g-recaptcha-response">\n' +
        '                    </div>\n' +
        '                </div>\n' +
        '                <div class="col-md-12">\n' +
        '                    <div class="contact-info">\n' +
        '                        <textarea id="text_comment_edit-' + id + '" class="textarea-height-min" placeholder="Текст коментаря">'+text+'</textarea>\n' +
        '                    </div>\n' +
        '                </div>\n' +
        '                <div class="col-12">\n' +
        '                <div id="btn_comment_edit-' + id + '" class="text-center">\n' +
        '                    <div class="btn sub-button  text-uppercase blanco">\n' +
        '                        <a id="send_comment_edit-' + id + '" class="submit-button mt-5" onclick="sendEditComment(\'' + id + '\')">Надіслати <i class="fa ico-angle-right" aria-hidden="true"></i></a>\n' +
        '                    </div>\n' +
        '                </div>\n' +
        '                </div>\n' +
        '            </div>\n' +
        '        </div>\n' +
        '    </div>\n' +
        '</section>';
    $('#add-' + id).append(html);
    $('#comment-visibility-edit-' + id).fadeToggle("slow");
}

function sendEditComment(id) {

    var text = $('#text_comment_edit-' + id).val().trim().replace(/<[^>]+>/g, '');
    var article_title_comment = $('#article_title_comment_edit-' + id).val().trim().replace(/<[^>]+>/g, '');
    var g_recaptcha_response = $('#g-recaptcha-response').val();
    if (text.length < 3) {
        var html = '<div class="alert alert-danger" role="alert"><strong class="lead">Помилка:</strong> дуже короткий коментар</div>';
        $('#systeminfo').html(html);
        setTimeout(function () {
            $('#system').fadeOut().modal('hide');
        }, 5000);
        $('#system').modal('show');
        return;
    }

    var data = {
        id: id,
        text: text,
        article_title_comment: article_title_comment,
        g_recaptcha_response: g_recaptcha_response
    };

    $.post('/comments/edit', data, function (res) {

        if (!res[0].success) {
            var html = '<div class="alert alert-danger" role="alert"><strong class="lead">Помилка:</strong> ' + res[0].err + '</div>';
            $('#systeminfo').html(html);
            setTimeout(function () {
                $('#system').fadeOut().modal('hide');
            }, 7000);
            $('#system').modal('show');
            return;
        }

        $('#text-'+id).text(text);
        $('#date-'+id).text(res[0].date);
        $('#text_comment_edit-').val('');
        $('#comment-visibility-edit-' + id).fadeToggle("slow");
    })

}

function reply(id, name, sessionUserName, articleId, articleTitle, sessionUserId) {

    $('#comment-visibility-edit-' + id).fadeOut();
    var html = '<section id="comment-visibility-reply-' + id + '" class="contact_section" style="display: none; margin-bottom: -120px; margin-top: 45px;">\n' +
        '    <div class="estimate_form" style="margin-top: 0px;">\n' +
        '        <div id="comment_form_reply" >\n' +
        '            <div class="row">\n' +
        '                <div class="col-md-6">\n' +
        '                    <div class="contact-info">\n' +
        '                        <input id="username_comment_reply-' + id + '" type="text" placeholder="Ім\'я" value="' + sessionUserName + '">\n' +
        '                        <input id="username_session_reply-' + id + '" type="hidden" value="' + sessionUserName + '">\n' +
        '                        <input id="article_id_comment_reply-' + id + '" type="hidden" value="' + articleId + '">\n' +
        '                        <input id="article_title_comment_reply-' + id + '" type="hidden" value="' + articleTitle + '">\n' +
        '                        <input id="user_id_comment_reply-' + id + '" type="hidden" value="' + sessionUserId + '">\n' +
        '                        <input id="g-recaptcha-response" type="hidden" name="g-recaptcha-response">\n' +
        '                    </div>\n' +
        '                </div>\n' +
        '                <div class="col-md-12">\n' +
        '                    <div class="contact-info">\n' +
        '                        <textarea id="text_comment_reply-' + id + '" class="textarea-height-min" placeholder="Текст коментаря"></textarea>\n' +
        '                    </div>\n' +
        '                </div>\n' +
        '                <div class="col-12">\n' +
        '                <div id="btn_comment_reply-' + id + '" class="text-center">\n' +
        '                    <div class="btn sub-button  text-uppercase blanco">\n' +
        '                        <a id="send_comment_reply-' + id + '" class="submit-button mt-5" onclick="sendComment(\'' + id + '\')">Надіслати <i class="fa ico-angle-right" aria-hidden="true"></i></a>\n' +
        '                    </div>\n' +
        '                </div>\n' +
        '                </div>\n' +
        '            </div>\n' +
        '        </div>\n' +
        '    </div>\n' +
        '</section>';
    $('#add-' + id).append(html);
    $('#comment-visibility-reply-' + id).fadeToggle("slow");

}
