<?php
/* Smarty version 3.1.34-dev-7, created on 2020-03-28 21:14:40
  from 'D:\php\domains\mvc-site-ikeya\views\public\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5e7f9410cb1778_23214679',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a2dbdd95482ff48f2d4be177f52dde95f7d3f188' => 
    array (
      0 => 'D:\\php\\domains\\mvc-site-ikeya\\views\\public\\index.tpl',
      1 => 1585238039,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e7f9410cb1778_23214679 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_6396134395e7f9410c5cdc4_76806138', 'title');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_7401485935e7f9410c9e4a1_17446183', 'body');
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "public/layout.tpl");
}
/* {block 'title'} */
class Block_6396134395e7f9410c5cdc4_76806138 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'title' => 
  array (
    0 => 'Block_6396134395e7f9410c5cdc4_76806138',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
echo $_smarty_tpl->tpl_vars['sitedata']->value['sitename'];
}
}
/* {/block 'title'} */
/* {block 'body'} */
class Block_7401485935e7f9410c9e4a1_17446183 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'body' => 
  array (
    0 => 'Block_7401485935e7f9410c9e4a1_17446183',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <!-- ACCORDION ROW -->
    <div class="row">
        <ul class="accordion-group" id="accordion">
            <li style="background-image: url('https://images.unsplash.com/photo-1556912172-45b7abe8b7e1?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1950&q=80');">
                <div class="accordion-overlay"></div>
                <h3>Rustic</h3>
                <section class="hidden-xs">
                    <article>
                        <a href="#"><p>Rual and rustic</p></a>
                    </article>
                </section>
            </li>
            <li class="out"
                style="background-image: url('https://images.unsplash.com/photo-1484154218962-a197022b5858?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1953&q=80');">
                <div class="accordion-overlay"></div>
                <h3>Clean</h3>
                <section class="hidden-xs">
                    <article>
                        <p>For the single or couple
                        </p>
                    </article>
                </section>
            </li>
            <li style="background-image: url('https://images.unsplash.com/photo-1507089947368-19c1da9775ae?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1955&q=80');">
                <div class="accordion-overlay"></div>
                <h3>Stylish</h3>
                <section class="hidden-xs">
                    <article>
                        <p>When people want it cosy but stylish</p>
                    </article>
                </section>
            </li>
            <li style="background-image: url('https://images.unsplash.com/photo-1495433324511-bf8e92934d90?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1950&q=80');">
                <div class="accordion-overlay"></div>
                <h3>Family</h3>
                <section class="hidden-xs">
                    <article>
                        <p>For the family dinner</p>
                    </article>
                </section>
            </li>
        </ul>
    </div>
    <?php echo $_smarty_tpl->tpl_vars['str']->value;?>

    <!-- BEGIN NEW ROW AFTER ACCORDION -->
    <div class="row mg">
        <!-- FIRST ROW -->
        <div class="container">
            <h1 class="text-center head red">Quality</h1>
            <div class="row">
                <div class="col-md-4 col-sm-6 col-xs-12 ">
                    <div class="product-box">
                        <h3 class="text-center">High quality</h3>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry's standard dummy text ever since the 1500s, when an unknown printer took a
                            galley of type and scrambled it to make a type specimen book. It has survived not only five
                            centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                            It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum
                            passages, and more recently with desktop publishing software like Aldus PageMaker including
                            versions of Lorem Ipsum.</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="product-box">
                        <h3 class="text-center">Smart design</h3>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry's standard dummy text ever since the 1500s, when an unknown printer took a
                            galley of type and scrambled it to make a type specimen book. It has survived not only five
                            centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                            It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum
                            passages, and more recently with desktop publishing software like Aldus PageMaker including
                            versions of Lorem Ipsum.</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="product-box">
                        <h3 class="text-center">Modern or retro</h3>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry's standard dummy text ever since the 1500s, when an unknown printer took a
                            galley of type and scrambled it to make a type specimen book. It has survived not only five
                            centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                            It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum
                            passages, and more recently with desktop publishing software like Aldus PageMaker including
                            versions of Lorem Ipsum.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--project-->
    <div class=" row">
        <ul role="navigation" class="grid">
            <li>
                <a href="#myModal2" data-toggle="modal">
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/74321/wvfrkayr0mg-christelle-bourgeois-776x1063.jpg"
                         alt="">
                    <span class="description">Project Uno</span>
                </a>
            </li>
            <li>
                <a href="#myModal2" data-toggle="modal">
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/74321/fbanijhrol4-annie-spratt-776x951.jpg"
                         alt="">
                </a>
                <span class="description">Project Dos</span>
            </li>
            <li>
                <a href="#myModal2" data-toggle="modal">
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/74321/2rm8p0rkxiw-marius-masalar-776x582.jpg"
                         alt="">
                    <span class="description">Project Tres</span>
                </a>
            </li>
            <li>
                <a href="#myModal2" data-toggle="modal">
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/74321/71nlan-2ya-andrew-neel-2-776x620.jpg"
                         alt="">
                    <span class="description">Project cuatro</span>
                </a>
            </li>
            <li>
                <a href="#myModal2" data-toggle="modal">
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/74321/hdyo6rr3kqk-scott-webb-1172x780.jpg"
                         alt="">
                    <span class="description">Project cinco</span>
                </a>
            </li>
            <li>
                <a href="#myModal2" data-toggle="modal">
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/74321/fvazbu6zae-andrew-neel-776x517.jpg"
                         alt="">
                    <span class="description">Project seis</span>
                </a>
            </li>
            <li>
                <a href="#myModal2" data-toggle="modal">
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/74321/typewriter-1-776x968.jpg" alt="">
                    <span class="description">Project Siete</span>
                </a>
            </li>
            <li>
                <a href="#myModal2" data-toggle="modal">
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/74321/xohlruw4k8-christelle-bourgeois-776x758.jpg"
                         alt="">
                    <span class="description">Project Ocho</span>
                </a>
            </li>
        </ul>
    </div>
<?php
}
}
/* {/block 'body'} */
}
