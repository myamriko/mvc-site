<?php
/* Smarty version 3.1.34-dev-7, created on 2020-04-01 11:38:27
  from 'D:\php\domains\mvc-site-ikeya\views\public\include\footer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5e84530324ac56_16663549',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '30e5b1332e0206a8e5e79456a7aed7790b582b43' => 
    array (
      0 => 'D:\\php\\domains\\mvc-site-ikeya\\views\\public\\include\\footer.tpl',
      1 => 1585144381,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e84530324ac56_16663549 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="footer">
    <footer class="footer-inner">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h3 class="h3">About us</h3>
                    <ul class="footer-list">
                        <li><a href="#">Our story</a></li>
                        <li><a href="#">Venue</a></li>
                        <li><a href="#">Other</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h3 class="h3">Partners</h3>
                    <ul class="footer-list">
                        <li><a href="#">IKEA</a></li>
                        <li><a href="#">MIO</a></li>
                        <li><a href="#">BAUHAUS</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h3 class="h3">Customer support</h3>
                    <ul class="footer-list">
                        <li><a href="#">Chat with us</a></li>
                        <li><a href="#">+46(0)2453 352</a></li>
                        <li><a href="#">E-mail us</a></li>
                    </ul>
                </div>
                <?php ob_start();
echo $_smarty_tpl->tpl_vars['sitedata']->value['social'];
$_prefixVariable1 = ob_get_clean();
if (($_prefixVariable1 === 'ON')) {?>
                <div class="col-md-3">
                    <h3 class="h3">Socials</h3>
                    <ul class="footer-list footer-list-inline">
                        <?php ob_start();
echo $_smarty_tpl->tpl_vars['sitedata']->value['facebook'];
$_prefixVariable2 = ob_get_clean();
if (($_prefixVariable2)) {?>
                            <li><a href="https://www.facebook.com/<?php echo $_smarty_tpl->tpl_vars['sitedata']->value['facebook'];?>
"><i
                                            class="fab fa-facebook-f"></i></a></li>
                        <?php }?>
                        <?php ob_start();
echo $_smarty_tpl->tpl_vars['sitedata']->value['instagram'];
$_prefixVariable3 = ob_get_clean();
if (($_prefixVariable3)) {?>
                        <li><a href="https://www.instagram.com/<?php echo $_smarty_tpl->tpl_vars['sitedata']->value['instagram'];?>
"><i
                                        class="fab fa-instagram"></i></a></li>
                        <?php }?>
                        <?php ob_start();
echo $_smarty_tpl->tpl_vars['sitedata']->value['twitter'];
$_prefixVariable4 = ob_get_clean();
if (($_prefixVariable4)) {?>
                        <li><a href="https://twitter.com/<?php echo $_smarty_tpl->tpl_vars['sitedata']->value['twitter'];?>
"><i class="fab fa-twitter"></i></a></li>
                        <?php }?>
                    </ul>
                </div>
                <?php }?>
            </div>
        </div>
    </footer>
</div><?php }
}
