<div class="modal fade modal-active" id="login" tabindex="-1" role="dialog" aria-labelledby="loginTitle"
     aria-hidden="true">
    {*класс modal-active размывае фон *}
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="loginLongTitle">Вход</h5>

            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="login1" class="col-sm-2 col-form-label">Логин:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="login1" name="login1" placeholder="Введите логин">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="pass" class="col-sm-2 col-form-label">Пароль:</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="pass" name="pass" placeholder="Введите пароль">
                    </div>
                </div>
            </div>
            <div id="login_err" class="alert alert-danger ml-3 mr-3" style="display: none"><strong>Error:</strong><span id="message"></span></div>
            <div class="modal-footer">
                <button type="button" class=" btn btn-secondary" data-dismiss="modal"  data-toggle="modal" data-target="#register">Регистрация</button>
                <button type="button" class=" btn btn-secondary"  data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-log" onclick="makeLogin()">Войти</button>

            </div>

        </div>
    </div>
</div>