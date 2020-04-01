<?php
/* Smarty version 3.1.34-dev-7, created on 2020-04-01 11:55:38
  from 'D:\php\domains\mvc-site-ikeya\views\public\layout.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5e84570a6e8980_60313002',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '75f611254bcbc66dfe53a512a28793de95326b5d' => 
    array (
      0 => 'D:\\php\\domains\\mvc-site-ikeya\\views\\public\\layout.tpl',
      1 => 1585731334,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:public/include/head.tpl' => 1,
    'file:public/include/modal/project.tpl' => 1,
    'file:public/include/modal/rerister.tpl' => 1,
    'file:public/include/modal/login.tpl' => 1,
    'file:public/include/navbar.tpl' => 1,
    'file:public/include/footer.tpl' => 1,
    'file:public/include/navigation.tpl' => 1,
  ),
),false)) {
function content_5e84570a6e8980_60313002 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
<html>
<?php $_smarty_tpl->_subTemplateRender("file:public/include/head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<body>
<?php $_smarty_tpl->_subTemplateRender('file:public/include/modal/project.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:public/include/modal/rerister.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:public/include/modal/login.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<div id="preloader">
    <div id="pagetransition" class="loaderArea">
        <div class="square black"></div>
        <div class="square white"></div>
        <div class="square gold"></div>
        <div class="square grey"></div>
        <div class="vic-gb"></div>
    </div>
    <div id="bg" class="bgPreloader loaderArea"></div>
</div>
<div  class="site-outer">
        <?php $_smarty_tpl->_subTemplateRender("file:public/include/navbar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
        <div class="site-inner">
        <section id="site" class="container-fluid">
            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_17706492835e84570a6e6de3_00722503', 'body');
?>

    </div>
    </section>
        <?php $_smarty_tpl->_subTemplateRender("file:public/include/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <!-- NAVIGATION -->
    <?php $_smarty_tpl->_subTemplateRender("file:public/include/navigation.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
</div>

<?php echo '<script'; ?>
 src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/public/them-js/jquery-ui.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.9.8/TweenMax.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/3.0.0/handlebars.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/public/js/regIog.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/public/them-js/all.min.js"><?php echo '</script'; ?>
><?php echo '<script'; ?>
 src="/public/them-js/wow.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/public/them-js/them.js"><?php echo '</script'; ?>
>
</body>
</html><?php }
/* {block 'body'} */
class Block_17706492835e84570a6e6de3_00722503 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'body' => 
  array (
    0 => 'Block_17706492835e84570a6e6de3_00722503',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'body'} */
}
