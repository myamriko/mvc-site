<?php
/* Smarty version 3.1.34-dev-7, created on 2020-04-01 11:38:27
  from 'D:\php\domains\mvc-site-ikeya\views\public\include\head.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5e84530311e858_78551626',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9fbcffe3bf7d3b85928e8e7ab03e25884b55e7f6' => 
    array (
      0 => 'D:\\php\\domains\\mvc-site-ikeya\\views\\public\\include\\head.tpl',
      1 => 1585225616,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e84530311e858_78551626 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <link rel="icon" href="/public/pic/res/<?php echo $_smarty_tpl->tpl_vars['sitedata']->value['ico'];?>
"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/font-awesome/css/all.min.css">
    <link rel="stylesheet" href="/public/css/main.css">
    <link rel="stylesheet" href="/public/css/animate.min.css">
    <title><?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_10670002115e84530311c695_83963001', 'title');
?>
</title>
    <!-- Facebook Pixel Code -->
    
    <?php echo '<script'; ?>
>
        !function(f,b,e,v,n,t,s)
                {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
                n.callMethod.apply(n,arguments):n.queue.push(arguments)};
                if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
                n.queue=[];t=b.createElement(e);t.async=!0;
                t.src=v;s=b.getElementsByTagName(e)[0];
                s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '<?php echo $_smarty_tpl->tpl_vars['sitedata']->value['fbpixel'];?>
');
        fbq('track', 'PageView');
    <?php echo '</script'; ?>
>
    
    <noscript><img height="1" width="1" style="display:none"
                   src="https://www.facebook.com/tr?id=<?php echo $_smarty_tpl->tpl_vars['sitedata']->value['fbpixel'];?>
&ev=PageView&noscript=1"
        /></noscript>
    <!-- End Facebook Pixel Code -->
</head><?php }
/* {block 'title'} */
class Block_10670002115e84530311c695_83963001 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'title' => 
  array (
    0 => 'Block_10670002115e84530311c695_83963001',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
echo $_smarty_tpl->tpl_vars['sitedata']->value['sitename'];
}
}
/* {/block 'title'} */
}
