<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    {* <link rel="icon" href="/public/pic/res/cogs.svg"/>*}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="/public/css/panelthem.css">
    <link rel="stylesheet" href="/public/css/jquery-ui.css">
    <link type="text/html" href="/public/font-awesome/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>{block name=title}{/block}</title>
</head>
<body>
{include file="admin/modal/system.tpl"}
{include file="admin/modal/remove.tpl"}
{include file="admin/modal/menu-add.tpl"}
<nav class="navbar sticky-top  navbar-expand-lg navbar-dark bg-secondary ">
    <a class="navbar-brand  text-white" href="/info-adm"><img src="/public/pic/res/cogs.png"
                                                              style="height: 35px; width: auto">
        Админ панель</a>
    <button  class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" onclick="myFunction(this)">
        <span class="bar1"></span> <span class="bar2"></span> <span class="bar3"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mt-2 mt-lg-0">
            <li class="nav dropdown">
                <a class="nav-link dropdown-toggle  text-white" href="#" id="cachnavbar" role="button"
                   data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    Очистить кеш
                </a>
                <div class="dropdown-menu " aria-labelledby="navbarDropdown">
                    <button class="dropdown-item" onclick="forgetAllSmarty()">Шаблона</button>
                    <div class="dropdown-divider"></div>
                    <button class="dropdown-item" onclick="forgetAllData()">Данных</button>
                </div>
            </li>
        </ul>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link  text-white" href="/users-adm">Пользователи
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  text-white" href="/contact-adm">Почта
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  text-white" href="/menu-adm">Меню
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  text-white" href="/categories-adm">Категории
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link  text-white" href="/tags-adm">Теги
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  text-white" href="/articles-adm">Статьи
                </a>
            </li>
        </ul>
        <ul class="navbar-nav mt-2 mt-lg-0">
            {if !empty($smarty.session.user.id)}
                <li class="nav dropdown dropleft">
                    <a class="nav-link dropdown-toggle  text-white" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        {$smarty.session.user.login}<!-- из сессии берем логин -->
                    </a>
                    <div class="dropdown-menu " aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/">Перейти на сайт</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/users/logout">LogOut</a>
                    </div>
                </li>
            {/if}
        </ul>
    </div>
</nav>
<div class="container-fluid">
    {block name=body}{/block}
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
<script src="/public/them-js/jquery-ui.min.js"></script>
<script src="/public/js/esc.js"></script>
<script src="/public/js/removed.js"></script>
<script src="/public/js/cache-control.js"></script>
<script src="/public/them-js/all.min.js"></script>{*иконки*}
<script type="text/javascript">
    function myFunction(x) {
        x.classList.toggle("change");
    }
    var hint = [{block name=hint}{/block}];
    var tagSearch = [{block name=tagSearch}{/block}];
</script>
<script src="/public/js/search.js"></script>
<script src="/public/js/pageLimit.js"></script>
{include file="admin/footer.tpl"}
</body>
</html>