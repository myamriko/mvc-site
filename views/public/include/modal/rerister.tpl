<div class="modal-reg modal fade modal-active" id="register" tabindex="-1" role="dialog" aria-labelledby="registerTitle"
        {*класс active-modal размывае фон *}
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="registerTitle">Регистрация</h5>

            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="reg_login" class="col-sm-2 col-form-label">Логин:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="reg_login" name="reg_login"
                               placeholder="Введите логин">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="reg_pass" class="col-sm-2 col-form-label">Пароль:</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="reg_pass" name="reg_pass"
                               placeholder="Введите пароль">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="reg_repass" class="col-sm-2 col-form-label">Re пароль:</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="reg_repass" name="reg_repass"
                               placeholder="Подтвердите пароль">
                    </div>
                </div>
                <div id="reg_info"><div class="alert alert-info hidden-xs hidden-sm" role="alert">Пароль должен содержать не мение 6-ти симолов,
                        хотябы одну строчную и одну заглавную ланитскую букву, одну цифру. </div></div>
                <div class="form-group row">
                    <label for="reg_name" class="col-sm-2 col-form-label">Имя:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="reg_name" name="reg_name"
                               placeholder="Введите имя">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="reg_mail" class="col-sm-2 col-form-label">@mail:</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="reg_mail" name="reg_mail"
                               placeholder="Введите @mail">
                    </div>
                </div>

            </div>
            <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
            <div id="reg_err" class="alert alert-danger ml-3 mr-3" style="display: none" role="alert"><strong>Error:</strong><span id="message_reg"></span></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть </button>
                <button type="button" class="btn btn-primary"  onclick="makeRegister()">Регистрация</button>
            </div>
        </div>
    </div>
</div>