<div class="modal-reg modal fade modal-active" id="register" tabindex="-1" role="dialog" aria-labelledby="registerTitle"
        {*класс active-modal размывае фон *}
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="registerTitle">Реєстрація</h5>

            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="reg_login" class="col-sm-2 col-form-label">Логін:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="reg_login" name="reg_login"
                               placeholder="Введіть логін">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="reg_pass" class="col-sm-2 col-form-label">Пароль:</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control newpssReg passwordReg" id="reg_pass" name="reg_pass"
                               placeholder="Введіть пароль">
                        <span class= "complexity aviso text-danger"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="reg_repass" class="col-sm-2 col-form-label">Re пароль:</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control repssReg passwordReg mt-2" id="reg_repass" name="reg_repass"
                               placeholder="Підтвердіть пароль">
                        <span class= "equality aviso p-1 text-danger"></span>
                    </div>
                </div>
                <div id="reg_info"><div class="alert alert-info hidden-xs hidden-sm" role="alert">
                        Пароль повинен містіті не менш 6-ти сімолів, великі і малі
                        латинські літери, а також цифри та спеціальні символи. </div></div>
                <div class="form-group row">
                    <label for="reg_name" class="col-sm-2 col-form-label">Ім'я:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="reg_name" name="reg_name"
                               placeholder="Введіть ім'я">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="reg_mail" class="col-sm-2 col-form-label">@mail:</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="reg_mail" name="reg_mail"
                               placeholder="Введіть @mail">
                    </div>
                </div>

            </div>
            <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
            <div id="reg_err" class="alert alert-danger ml-3 mr-3" style="display: none" role="alert"><strong>Error:</strong><span id="message_reg"></span></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary"  onclick="makeRegister()">Реєстрація</button>
            </div>
        </div>
    </div>
</div>