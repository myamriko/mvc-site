<?php
/* Smarty version 3.1.34-dev-7, created on 2020-03-28 21:14:40
  from 'D:\php\domains\mvc-site-ikeya\views\public\include\navigation.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5e7f9410ed7008_82063498',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2e73666e693c9bdf7d0ca99bff3e4216bebd2fbf' => 
    array (
      0 => 'D:\\php\\domains\\mvc-site-ikeya\\views\\public\\include\\navigation.tpl',
      1 => 1585133693,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e7f9410ed7008_82063498 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="navigation">
    <?php if (!empty($_SESSION['user']['id'])) {?>
        <button class="navigation-login" onclick="window.location.href='users/logout'">
            <i class="fas fa-sign-out-alt"> </i> Выйти</span>
        </button>
    <?php } else { ?>
        <button class="navigation-login" data-toggle="modal" data-target="#login">
            <i class="fas fa-sign-in-alt"> </i> Войти</span>
        </button>
    <?php }?>

    <div class="navigation-search">
        <div id="search">
            <input type="text" name="input" class="input" placeholder="Поиск"/>
            <button type="reset" class="search" id="search-button"></button>
        </div>
    </div>
    <div class="navigation-content">

        <h3>Menu</h3>
        <ul class="navigation-menu">
            <li><a href="/" class="active">Главная</a></li>
            <?php if (!empty($_SESSION['user']['id']) && $_SESSION['user']['role'] != 'admin') {?>
                <li><a href="#"> <i class="red fa fa-circle"></i> Личный кабинет</a></li>
            <?php }?>
            <?php if (!empty($_SESSION['user']['id']) && $_SESSION['user']['role'] == 'admin') {?>
                <li><a href="/info-adm"> <i class="red fa fa-circle"></i> Админ панель</a></li>
            <?php }?>
            <li><a href="#"><i class="beige fa fa-circle"></i> Kitchen cabinets</a></li>
            <li><a href="#"><i class="orange fa fa-circle"></i> Counters</a></li>
            <li><a href="#"><i class="blue fa fa-circle"></i> Other</a></li>
        </ul>
        <h3>More</h3>
        <ul class="navigation-menu">
            <li><a href="#">About Us</a></li>
            <li><a href="#">Contact</a></li>
            <li><a href="#">Info</a></li>
            <li><a href="#">Collaboration</a></li>
            <li><a href="#">Customer Service</a></li>
        </ul>
    </div>
</div><?php }
}
