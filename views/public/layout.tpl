<html lang="uk">
{*head*}
{include file="public/include/head.tpl"}
<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
{* Modal *}

{include file='public/include/modal/rerister.tpl'}
{include file='public/include/modal/login.tpl'}
{include file='public/include/modal/system.tpl'}
{*preloader*}
<div class="loaderArea">
    <div class="load">
        <hr/>
        <hr/>
        <hr/>
        <hr/>
    </div>
</div>

    {*navBar*}
    {include file="public/include/navbar.tpl"}
    {*Content*}
    {block name=body}{/block}
    {*Contact*}
    {include file="public/include/front-contact.tpl"}
    {*footer*}
    {include file="public/include/footer.tpl"}



<!-- NAVIGATION
{include file="public/include/navigation.tpl"}-->

<script src="/public/them-js/jquery-3.5.1.min.js"></script>
<!--задержка js до появления на экране-->
<script src="/public/them-js/jquery.viewportchecker.min.js"></script>
<!--анимация цифер-->
<script src="/public/them-js/jquery.animateNumber.js"></script>
<script src="/public/js/number.js"></script>

<script src="/public/them-js/wow.min.js"></script>
<script src="/public/them-js/popper.min.js"></script>
<script src="/public/them-js/bootstrap.min.js"></script>
<!-- owl carousel js-->
<script src="/public/owl-carousel/owl.carousel.min.js"></script>

<!--wow-->
<script src="/public/them-js/main.js"></script>


</body>
</html>