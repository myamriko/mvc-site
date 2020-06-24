<nav class="nav-container navbar navbar-expand-lg navbar-dark ftco_navbar ftco-navbar-light site-navbar-target"
     id="gtco-main-nav">
    <div class="container">
        <a class="navbar-brand">atty<span>.</span>kiev<span>.</span>ua</a>

        <button class="navbar-toggler js-fh5co-nav-toggle fh5co-nav-toggle" type="button" onclick="myFunction(this)"
                data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false"
                aria-label="Toggle navigation">
            <span
                    class="bar1"></span> <span class="bar2"></span> <span class="bar3"></span>
        </button>
        <div id="ftco-nav" class="collapse navbar-collapse">
            {if ($menu[0]['enabled'] === 'ON')}
                <ul class="navbar-nav mr-auto">
                    {foreach $links as $link}
                        {foreach $link as $value}
                            {if ({$value['menu_name'] === $menu[0]['menu_name']})}
                                {if ($value['enabled'] === 'ON')}
                                    <li class="nav-item"><a class="nav-link" href="/{$value['url']}">
                                            <span  {if ({$value['url']}===$controller)||({$value['url']}===''&&$controller==='main')}class="activity"{/if}>{$value['title']}</span></a>
                                    </li>
                                {/if}
                            {/if}
                        {/foreach}
                    {/foreach}
                </ul>
            {/if}

            {if !empty($smarty.session.user.id)}
                {if ($menu[1]['enabled'] === 'ON')}
                    <ul class="navbar-nav mr-5">
                        <li class="nav dropdown">
                            <a class="nav-link dropdown-toggle  text-dark" id="navbarDropdown" role="button"
                               data-toggle="dropdown" {*onclick="showMenu()*}">
                                {$smarty.session.user.login}<!-- из сессии берем логин -->
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                {foreach $links as $link}
                                    {foreach $link as $value}
                                        {if ({$value['menu_name'] === $menu[1]['menu_name']})}
                                            {if ($value['enabled'] === 'ON')}
                                                {if  ($smarty.session.user.role === 'admin')}
                                                    <a class="dropdown-item"
                                                       href="/{$value['url']}">{$value['title']}</a>
                                                {/if}
                                            {/if}
                                        {/if}
                                    {/foreach}
                                {/foreach}
                            </div>
                        </li>
                    </ul>
                {/if}
            {/if}
            <form class="form-inline my-2 my-lg-0">
                {if !empty($smarty.session.user.id)}
                    <a class="btn btn-outline-dark my-2 my-sm-0 mr-3 text-uppercase"
                       onclick="window.location.href='users/logout'">Вихід</a>
                {else}
                    <a class="btn btn-outline-dark my-2 my-sm-0 mr-3 text-uppercase" data-toggle="modal"
                       data-target="#login">Вхід</a>
                    <a class="btn btn-info my-2 my-sm-0 text-uppercase" data-toggle="modal" data-target="#register">Реєстрація</a>
                {/if}
            </form>
        </div>
    </div>
</nav>