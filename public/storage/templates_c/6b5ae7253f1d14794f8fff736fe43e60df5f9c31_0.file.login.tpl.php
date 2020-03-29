<?php
/* Smarty version 3.1.34-dev-7, created on 2020-03-28 21:14:40
  from 'D:\php\domains\mvc-site-ikeya\views\public\include\modal\login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5e7f9410df59f7_33717519',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6b5ae7253f1d14794f8fff736fe43e60df5f9c31' => 
    array (
      0 => 'D:\\php\\domains\\mvc-site-ikeya\\views\\public\\include\\modal\\login.tpl',
      1 => 1585238712,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e7f9410df59f7_33717519 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="modal fade modal-active" id="login" tabindex="-1" role="dialog" aria-labelledby="loginTitle"
     aria-hidden="true">
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
                <button type="button" class="btn btn-primary" onclick="makeLogin()">Войти</button>

            </div>

        </div>
    </div>
</div><?php }
}
