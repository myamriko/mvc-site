<html lang="uk">
{*head*}
{include file="public/include/head.tpl"}
<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
{* Modal *}

{include file='public/include/modal/rerister.tpl'}
{include file='public/include/modal/login.tpl'}
{include file='public/include/modal/system.tpl'}
{include file='public/include/modal/account.tpl'}
{*preloader*}
<div class="loaderArea">
    <div class="load">
        <div class="spinner-border text-danger" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
</div>

<div id="site" class="">
    {*navBar*}
    {include file="public/include/navbar.tpl"}
    {*Content*}
    {block name=body}{/block}
</div>
{*footer*}
{include file="public/include/footer.tpl"}

<script  src="/public/them-js/jquery-ui.min.js"  defer></script>
<script  src="/public/them-js/popper.min.js"  defer></script>
<script  src="/public/them-js/bootstrap.min.js"  defer></script>
{*анимация цифер*}
{if ($controller === 'main')}
<script  src="/public/them-js/jquery.animateNumber.js"  defer></script>
<script  src="/public/them-js/number.js"  defer></script>
{/if}
{*эффекты анимации*}
<script  src="/public/them-js/wow.min.js" defer></script>
{*Регистрация*}
<script  src="/public/js/regIog.js" defer></script>
{*owl carousel js*}
<script  src="/public/owl-carousel/owl.carousel.min.js" defer></script>
{*js темы*}
<script  src="/public/them-js/main.js" defer></script>
</body>
</html>