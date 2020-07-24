<div class="modal fade modal-active" id="login" tabindex="-1" role="dialog" aria-labelledby="loginTitle"
     aria-hidden="true">
    {*класс modal-active размывае фон *}
    <div id="gtco-main-mod" class="modal-dialog  slideOutUp animated modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button"  class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="loginLongTitle">Вхід</h5>

            </div>

            <div class="modal-body">
                <form autocomplete="on">
                <div class="form-group row">
                    <label for="login1" class="col-sm-2 col-form-label">Логін:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="login1" name="login1" placeholder="Введіть логін">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="pass" class="col-sm-2 col-form-label">Пароль:</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="pass" name="pass" placeholder="Введіть пароль">
                    </div>
                </div>
                </form>
            </div>
            <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
            <div id="login_err" class="alert alert-danger ml-3 mr-3" style="display: none"><strong>Error:</strong><span id="message"></span></div>
            <div class="modal-footer">
                <a class="recordatorio" href="/restore">Забули пароль?</a>
                <a class="btn btn-outline-dark my-2 my-sm-0 text-uppercase" onclick="makeLogin()">Увійти</a>

            </div>

        </div>
    </div>
</div>