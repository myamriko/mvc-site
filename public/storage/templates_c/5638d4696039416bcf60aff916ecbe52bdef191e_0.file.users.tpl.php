<?php
/* Smarty version 3.1.34-dev-7, created on 2020-04-09 22:49:54
  from 'D:\php\domains\mvc-site-ikeya\views\admin\users.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5e8f7c62bf24c4_53557782',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5638d4696039416bcf60aff916ecbe52bdef191e' => 
    array (
      0 => 'D:\\php\\domains\\mvc-site-ikeya\\views\\admin\\users.tpl',
      1 => 1586260143,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e8f7c62bf24c4_53557782 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_20736134705e8f7c62bddd29_53422364', 'title');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_18994585245e8f7c62bde899_07655531', 'body');
?>



<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "admin/layout.tpl");
}
/* {block 'title'} */
class Block_20736134705e8f7c62bddd29_53422364 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'title' => 
  array (
    0 => 'Block_20736134705e8f7c62bddd29_53422364',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
Пользователи - Админ панель <?php
}
}
/* {/block 'title'} */
/* {block 'body'} */
class Block_18994585245e8f7c62bde899_07655531 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'body' => 
  array (
    0 => 'Block_18994585245e8f7c62bde899_07655531',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-12 mb-5 mt-5"><h3>Пользователи</h3>
                    <hr>
                </div>
                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Аватар</th>
                        <th scope="col">Имя</th>
                        <th scope="col">@mail</th>
                        <th scope="col">Логин</th>
                        <th scope="col">Роль</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['users']->value, 'User');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['User']->value) {
?>
                        <tr id="<?php echo $_smarty_tpl->tpl_vars['User']->value['id'];?>
">
                            <td class="align-middle" scope="row"><?php echo $_smarty_tpl->tpl_vars['User']->value['id'];?>
</td>
                            <td id="avatar-<?php echo $_smarty_tpl->tpl_vars['User']->value['id'];?>
" class="align-middle"><img
                                        src="/public/pic/avatar/<?php echo $_smarty_tpl->tpl_vars['User']->value['avatar'];?>
" style="height: 35px; width: auto">
                            </td>
                            <td id="username-<?php echo $_smarty_tpl->tpl_vars['User']->value['id'];?>
" class="align-middle"><?php echo $_smarty_tpl->tpl_vars['User']->value['username'];?>
</td>
                            <td id="email-<?php echo $_smarty_tpl->tpl_vars['User']->value['id'];?>
" class="align-middle"><?php echo $_smarty_tpl->tpl_vars['User']->value['email'];?>
</td>

                            <?php if (!empty($_SESSION['user']['id'] === $_smarty_tpl->tpl_vars['User']->value['id'])) {?>
                                <td class="align-middle  text-black-50"><?php echo $_smarty_tpl->tpl_vars['User']->value['login'];?>
</td>
                                <td class="align-middle text-black-50"><?php echo $_smarty_tpl->tpl_vars['User']->value['role'];?>
</td>
                                <td class="align-middle">
                                    <button class="btn btn-linc btn-sm text-secondary" onclick="#" disabled><i class="far fa-trash-alt"></i>  Удалить</button>
                                </td>
                            <?php } else { ?>
                                <td id="login-<?php echo $_smarty_tpl->tpl_vars['User']->value['id'];?>
" class="align-middle"><?php echo $_smarty_tpl->tpl_vars['User']->value['login'];?>
</td>
                                <td id="role-<?php echo $_smarty_tpl->tpl_vars['User']->value['id'];?>
" class="align-middle"><?php echo $_smarty_tpl->tpl_vars['User']->value['role'];?>
</td>
                                <td class="align-middle">
                                    <button class="btn btn-linc btn-sm text-danger" onclick="removedStart('<?php echo $_smarty_tpl->tpl_vars['User']->value['id'];?>
','<?php echo $_smarty_tpl->tpl_vars['User']->value['login'];?>
','users')"><i class="far fa-trash-alt"></i> Удалить</button>
                                </td>
                            <?php }?>
                        </tr>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <?php echo '<script'; ?>
 src="/public/js/users.js"><?php echo '</script'; ?>
>
<?php
}
}
/* {/block 'body'} */
}
