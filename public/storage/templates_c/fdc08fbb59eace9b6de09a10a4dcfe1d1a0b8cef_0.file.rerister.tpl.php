<?php
/* Smarty version 3.1.34-dev-7, created on 2020-03-28 21:14:40
  from 'D:\php\domains\mvc-site-ikeya\views\public\include\modal\rerister.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5e7f9410dcb8f2_10256245',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fdc08fbb59eace9b6de09a10a4dcfe1d1a0b8cef' => 
    array (
      0 => 'D:\\php\\domains\\mvc-site-ikeya\\views\\public\\include\\modal\\rerister.tpl',
      1 => 1585324962,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e7f9410dcb8f2_10256245 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="modal-reg modal fade modal-active" id="register" tabindex="-1" role="dialog" aria-labelledby="registerTitle"
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
                    <label for="reg_repass" class="col-sm-2 col-form-label">Подтвердите пароль:</label>
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
            <div id="reg_err" class="alert alert-danger ml-3 mr-3" style="display: none" role="alert"><strong>Error:</strong><span id="message_reg"></span></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть </button>
                <button type="button" class="btn btn-primary"  onclick="makeRegister()">Регистрация</button>
            </div>
        </div>
    </div>
</div><?php }
}
