<?php
/* Smarty version 3.1.34-dev-7, created on 2020-04-09 22:49:54
  from 'D:\php\domains\mvc-site-ikeya\views\admin\layout.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5e8f7c62c09623_10960380',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '44f9d9b67034f4c8e87634327d5f8a9f7870b6ea' => 
    array (
      0 => 'D:\\php\\domains\\mvc-site-ikeya\\views\\admin\\layout.tpl',
      1 => 1586356145,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:admin/modal/system.tpl' => 1,
    'file:admin/modal/remove.tpl' => 1,
    'file:admin/modal/menu-add.tpl' => 1,
  ),
),false)) {
function content_5e8f7c62c09623_10960380 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <link rel="icon" href="/public/pic/res/cogs.svg"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="/public/css/panelthem.css">
    <link  type="text/html" href="/public/font-awesome/css/all.min.css">
    <?php echo '<script'; ?>
 src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"><?php echo '</script'; ?>
>
    <title><?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_18095917555e8f7c62c02065_28075111', 'title');
?>
</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/info-adm"><img src="/public/pic/res/cogs.png" style="height: 35px; width: auto">
        Админ панель</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">

    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mt-2 mt-lg-0">
            <li class="nav dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="cachnavbar" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    Очистить кеш
                </a>
                <div class="dropdown-menu " aria-labelledby="navbarDropdown">
                    <button class="dropdown-item" onclick="forgetAllSmarty()">Шаблона</button>

                    <div class="dropdown-divider"></div>
                    <button class="dropdown-item" onclick="forgetAllData()">Данных</button>

                </div>
            </li>
        </ul>

        </ul>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/users-adm">Пользватели
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/menu-adm">Меню
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/categories-adm">Категории
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/articles-adm">Статьи
                </a>
            </li>
        </ul>

        <ul class="navbar-nav mt-2 mt-lg-0">
            <?php if (!empty($_SESSION['user']['id'])) {?>
            <li class="nav dropdown dropleft">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <?php echo $_SESSION['user']['login'];?>
<!-- из сессии берем логин -->
                </a>
                <div class="dropdown-menu " aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/">Перейти на сайт</a>

                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/users/logout">LogOut</a>

                </div>
            </li>
            <?php } else { ?>

        </ul>

        <?php }?>
    </div>
</nav>
<div class="container-fluid">
    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_2322290225e8f7c62c04430_32933235', 'body');
?>

    <?php $_smarty_tpl->_subTemplateRender("file:admin/modal/system.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <?php $_smarty_tpl->_subTemplateRender("file:admin/modal/remove.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <?php $_smarty_tpl->_subTemplateRender("file:admin/modal/menu-add.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
</div>

<?php echo '<script'; ?>
 src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/public/js/esc.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/public/js/removed.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/public/js/cache-control.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/public/them-js/all.min.js"><?php echo '</script'; ?>
></body>
</html><?php }
/* {block 'title'} */
class Block_18095917555e8f7c62c02065_28075111 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'title' => 
  array (
    0 => 'Block_18095917555e8f7c62c02065_28075111',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'title'} */
/* {block 'body'} */
class Block_2322290225e8f7c62c04430_32933235 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'body' => 
  array (
    0 => 'Block_2322290225e8f7c62c04430_32933235',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'body'} */
}
