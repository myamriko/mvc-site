<div class="modal" id="reply" tabindex="-1" role="dialog" aria-labelledby="replyModalLongTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group ml-1 mr-1">
                    <div class="form-inline">
                        <label class="text-info font-weight-bolder" for="mailTo">Кому:</label>
                        <input id="mailTo" type="text" class="col-sm-10 form-control-plaintext"
                               placeholder="Адрес получателя">
                    </div>
                    <div class="form-inline">
                        <label class="text-info font-weight-bolder" for="copyCC">Копия:</label>
                        <input id="copyCC" type="text" class="col-sm-10 form-control-plaintext"
                               placeholder="Адрес получателя копии" value="{$siteData['sitemail']}">
                    </div>
                    <div class="form-inline">
                        <label class="text-info font-weight-bolder" for="copyBCC">Скрытая копия:</label>
                        <input id="copyBCC" type="text" class="col-sm-10 form-control-plaintext"
                               placeholder="Адрес получателя копии2" value="{$siteData['adminmail']}">
                    </div>
                    <div class="form-inline mb-3">
                        <label class="text-info font-weight-bolder" for="subject">Тема:</label>
                        <input id="subject" type="text" class="col-sm-10 form-control-plaintext"
                               placeholder="Тема">
                    </div>
                    <textarea id="editor" placeholder="Введите ответ"></textarea>
                    <div class="pt-3">
                        <h4 class="text-info"> Исходное сообщение:</h4>
                        <input id="idMess" type="hidden">
                        <div id="mess" class="pb-3"></div>
                        <div id="errEdit" class="alert alert-danger ml-3 mr-3" style="display: none">
                            <strong>Error:</strong><span
                                    id="messageEdit"></span></div>
                        <div id="btnSend" class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Отменить</button>
                            <button id="btnSend" type="button" class="btn btn-primary" onclick="reply()">Отправить
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>