<div class="modal fade modal-active" id="account" tabindex="-1" role="dialog" aria-labelledby="accountTitle"
     aria-hidden="true">
    {*класс modal-active размывае фон *}
    <div id="gtco-main-mod" class="modal-dialog  slideOutUp animated modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button"  class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="accountLongTitle">Редагування профіля</h5>

            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="files" class="col-sm-2 col-form-label">Аватар:</label>
                    <div class="col-sm-10">
                        <input  type="hidden" id="userId" value="{$smarty.session.user.id}">
                        <input  type="hidden" id="fileOld" value="{$user.avatar}">
                        <input type="file" class="form-control-file" id="files">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="username" class="col-sm-2 col-form-label">Ім'я:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Введіть Ім'я" value="{$user.username}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">E-mail:</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Введіть E-mail" value="{$user.email}">
                    </div>
                </div>
            </div>

            <div id="acc_err" class="alert alert-danger ml-3 mr-3" style="display: none"><strong>Error:</strong><span id="message-acc"></span></div>
            <div class="modal-footer">
                <a type="button" class="btn btn-outline-dark my-2 my-sm-0 text-uppercase" onclick="editData()">Змінити</a>
            </div>
        </div>
    </div>
</div>