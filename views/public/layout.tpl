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
<div id="site" class="site-outer">{*id ->site отвечает за размытие*}
    {*navBar*}
    {include file="public/include/navbar.tpl"}
    {*Content*}
    {block name=body}{/block}
    {*footer*}
    {include file="public/include/footer.tpl"}
</div>
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
<script src="/public/them-js/them.js"></script>{*навбар WOW прелоадер*}
{*Гугл АПИ, нужен ключ платный*}
<script src="/public/them-js/google-map-settings.js"></script>
{*ключ для гугл апи*}
{*AIzaSyANwMfPkr9h6v6mzrSpEfwKZbz827FhAiU
AIzaSyB6w8j2weabWNNnmQbh4Vsi2-sd7Sqv5zM - чужой*}
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB6w8j2weabWNNnmQbh4Vsi2-sd7Sqv5zM&callback=initMap"
        async defer></script>
</body>
</html>