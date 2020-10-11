<section id="comment-visibility" class="contact_section" style="display: none;">
    <div class="estimate_form" style="margin-top: 0px;">
        <div id="comment_form" >
            <div class="row">
                <div class="col-md-6">
                    <div class="contact-info">
                        <input id="username_comment" type="text" placeholder="Ім'я" value="{$smarty.session.user.username}">
                        <input id="username_session" type="hidden" value="{$smarty.session.user.username}">
                        <input id="article_id_comment" type="hidden" value="{$article['id']}">
                        <input id="article_title_comment" type="hidden" value="{$article['title']}">
                        <input id="user_id_comment" type="hidden" value="{$smarty.session.user.id}">
                        <input id="g-recaptcha-response" type="hidden" name="g-recaptcha-response">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="contact-info">
                        <textarea id="text_comment" class="textarea-height-min" placeholder="Текст коментаря"></textarea>
                    </div>
                </div>
                <div class="col-12">
                <div id="btn_comment" class="text-center">
                    <div class="btn sub-button  text-uppercase blanco">
                        <a id="send_comment" class="submit-button mt-5" onclick="sendComment()">Надіслати <i class="fa ico-angle-right" aria-hidden="true"></i></a>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</section>
