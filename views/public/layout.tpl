<html>
{*head*}
{include file="public/include/head.tpl"}
<body>
{* Modal *}
{include file='public/include/modal/project.tpl'}
{include file='public/include/modal/rerister.tpl'}
{include file='public/include/modal/login.tpl'}
{*preloader*}
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
    {*navBar*}
    {include file="public/include/navbar.tpl"}
    {*Content*}
    <div class="site-inner">
        <section id="site" class="container-fluid">
            {block name=body}{/block}
    </div>
    </section>
    {*footer*}
    {include file="public/include/footer.tpl"}
    <!-- NAVIGATION -->
    {include file="public/include/navigation.tpl"}
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="/public/them-js/jquery-ui.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.9.8/TweenMax.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/3.0.0/handlebars.min.js"></script>
<script src="/public/js/regIog.js"></script>
<script src="/public/them-js/all.min.js"></script>{*иконки*}
<script src="/public/them-js/wow.min.js"></script>
<script src="/public/them-js/them.js"></script>{*навбар*WOW*прелоадер*}

</body>
</html>