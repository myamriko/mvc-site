<?php
/* Smarty version 3.1.34-dev-7, created on 2020-04-09 22:51:43
  from 'D:\php\domains\mvc-site-ikeya\views\admin\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5e8f7ccf51a840_65730974',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a7d2df3a568c9e0df7b0da358e4a1c603bc65df4' => 
    array (
      0 => 'D:\\php\\domains\\mvc-site-ikeya\\views\\admin\\index.tpl',
      1 => 1585640302,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e8f7ccf51a840_65730974 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_733868505e8f7ccf5116e7_03863329', 'title');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_18652328695e8f7ccf5121f8_12365194', 'body');
?>



<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "admin/layout.tpl");
}
/* {block 'title'} */
class Block_733868505e8f7ccf5116e7_03863329 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'title' => 
  array (
    0 => 'Block_733868505e8f7ccf5116e7_03863329',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
Админ панель<?php
}
}
/* {/block 'title'} */
/* {block 'body'} */
class Block_18652328695e8f7ccf5121f8_12365194 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'body' => 
  array (
    0 => 'Block_18652328695e8f7ccf5121f8_12365194',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-12 mb-5 mt-5"><h3>Основные настройки</h3>
                    <hr>
                </div>
                <div class="col-lg-6">
                    <div class="col-12">
                        <div class="form-group row">
                            <h4>Имя сайта:</h4>
                            <div id="sitename" class="col-lg-6 col-md-6 col-sm-6 col-11 edit">
                                <span class="lead"><?php echo $_smarty_tpl->tpl_vars['sitedata']->value['sitename'];?>
</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group row">
                            <h4>Девиз:</h4>
                            <div id="propaganda" class="col-lg-6 col-md-6 col-sm-6 col-11 edit">
                                <span class="lead"><?php echo $_smarty_tpl->tpl_vars['sitedata']->value['propaganda'];?>
</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="form-group row">
                            <h4>@mail сайта:</h4>
                            <div id="sitemail" class="col-lg-6 col-md-6 col-sm-6 col-11 edit">
                                <span class="lead"><?php echo $_smarty_tpl->tpl_vars['sitedata']->value['sitemail'];?>
</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-3">
                        <div class="form-group row">
                            <h4>@mail администратора:</h4>
                            <div id="adminmail" class="col-lg-6 col-md-6 col-sm-6 col-11 edit">
                                <span class="lead"><?php echo $_smarty_tpl->tpl_vars['sitedata']->value['adminmail'];?>
</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-3">
                        <div class="form-group row">
                            <h4>ID pixel FB:</h4>
                            <div id="fbpixel" class="col-lg-6 col-md-6 col-sm-6 col-11 edit">
                                <span class="lead"><?php echo $_smarty_tpl->tpl_vars['sitedata']->value['fbpixel'];?>
</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="form-group row">
                            <h4>Кеш в секундах:</h4>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-11">
                                <select name="cache" id="cechetime" class="form-control ">
                                    <optgroup label="Установите кеш:">
                                        <option value='3800'>1 ч</option>
                                        <option value='10800'>3 ч</option>
                                        <option value='21600'>6 ч</option>
                                        <option value='43200'>12 ч</option>
                                        <option value='86400'>1 д</option>
                                        <option value='172800'>2 д</option>
                                        <option value='259200'>3 д</option>
                                        <option value='345600'>4 д</option>
                                    </optgroup>
                                    <optgroup label="Установлено в сек:">
                                        <option selected
                                                value="<?php echo $_smarty_tpl->tpl_vars['sitedata']->value['cechetime'];?>
"><?php echo $_smarty_tpl->tpl_vars['sitedata']->value['cechetime'];?>

                                        </option>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="alert alert-info mt-1" role="alert"><strong>Время жизни кеша по умолчанию 1
                                    день (86400 сек).</strong></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="col-12">
                        <div class="form-group row">
                            <h4 class="mt-2">Иконка:</h4>
                            <div id="ico" class="col-lg-6 col-md-6 col-sm-6 col-11 edit">
                                <img src="/public/pic/res/<?php echo $_smarty_tpl->tpl_vars['sitedata']->value['ico'];?>
" style="width: 40px; height: auto">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="form-group row">
                            <h4 class="mt-2">Логотип:</h4>
                            <div id="logo" class="col-lg-6 col-md-6 col-sm-6 col-11 edit">
                                <img src="/public/pic/res/<?php echo $_smarty_tpl->tpl_vars['sitedata']->value['logo'];?>
" style="width: 40px; height: auto">
                            </div>
                        </div>
                    </div>
                    <div>
                        <hr>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="form-group row">
                            <h4>Социальные сети:</h4>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-11">
                                <select name="social" id="social" class="form-control">
                                    <optgroup label="ВКЛ/ВЫКЛ">
                                        <option value='ON'>ON</option>
                                        <option value='OFF'>OFF</option>
                                    </optgroup>
                                    <optgroup label="Вкладка соцсети:">
                                        <option selected value="<?php echo $_smarty_tpl->tpl_vars['sitedata']->value['social'];?>
"><?php echo $_smarty_tpl->tpl_vars['sitedata']->value['social'];?>
</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group row">
                            <h4>Facebook:</h4>
                            <div id="facebook" class="col-lg-6 col-md-6 col-sm-6 col-11 edit">
                                <span class="lead">
                                    <i class="fab fa-facebook-f"></i> <?php echo $_smarty_tpl->tpl_vars['sitedata']->value['facebook'];?>

                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="form-group row">
                            <h4>Instagram:</h4>
                            <div id="instagram" class="col-lg-6 col-md-6 col-sm-6 col-11 edit">
                                <span class="lead">
                                    <i class="fab fa-instagram"></i> <?php echo $_smarty_tpl->tpl_vars['sitedata']->value['instagram'];?>

                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="form-group row">
                            <h4>Twitter:</h4>
                            <div id="twitter" class="col-lg-6 col-md-6 col-sm-6 col-11 edit">
                                <span class="lead">
                                    <i class="fab fa-twitter"></i> <?php echo $_smarty_tpl->tpl_vars['sitedata']->value['twitter'];?>

                                </span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php echo '<script'; ?>
 src="/public/js/info.js"><?php echo '</script'; ?>
>
<?php
}
}
/* {/block 'body'} */
}
