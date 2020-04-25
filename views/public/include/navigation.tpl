<div class="navigation">
    {if !empty($smarty.session.user.id)}
        <button class="navigation-login" onclick="window.location.href='users/logout'">
            <i class="fas fa-sign-out-alt"> </i> Выйти</span>
        </button>
    {else}
        <button class="navigation-login" data-toggle="modal" data-target="#login">
            <i class="fas fa-sign-in-alt"> </i> Войти</span>
        </button>
    {/if}

    <div class="navigation-search">
        <div id="search">
            <input type="text" name="input" class="input" placeholder="Поиск"/>
            <button type="reset" class="search" id="search-button"></button>
        </div>
    </div>
    <div class="navigation-content">
        {if ($menu[0]['enabled'] === 'ON')}
            <h3>{$menu[0]['title']}</h3>
            <ul class="navigation-menu">
                {foreach $links as $link}
                    {foreach $link as $value}
                        {if ({$value['menu_name'] === $menu[0]['menu_name']})}
                            {if ($value['enabled'] === 'ON')}
                                <li><a href="/{$value['url']}"
                                       {if ({$value['url']}===$controller)||({$value['url']}===''&&$controller==='main')}class="active"{/if}>{$value['title']}</a>
                                </li>
                            {/if}
                        {/if}
                    {/foreach}
                {/foreach}
            </ul>
        {/if}
        {if !empty($smarty.session.user.id)}
        {if ($menu[1]['enabled'] === 'ON')}
        <h3>{$menu[1]['title']}</h3>
        <ul class="navigation-menu">
            {foreach $links as $link}
            {foreach $link as $value}
                {if ({$value['menu_name'] === $menu[1]['menu_name']})}
                {if ($value['enabled'] === 'ON')}
            {if  ($smarty.session.user.role === 'admin' && {$value['title']} === 'Admin panel')}
                <li><a href="/{$value['url']}"> <i class="orange fa fa-circle"></i> {$value['title']}</a></li>
                {elseif ({$value['title']} !== 'Admin panel')}
                <li><a href="/{$value['url']}"> <i class="red fa fa-circle"></i> {$value['title']}</a></li>
            {/if}
           {* <li><a href="#"><i class="beige fa fa-circle"></i> Kitchen cabinets</a></li>
            <li><a href="#"><i class="orange fa fa-circle"></i> Counters</a></li>
            <li><a href="#"><i class="blue fa fa-circle"></i> Other</a></li>*}
                {/if}
                {/if}
            {/foreach}
            {/foreach}
        </ul>
        {/if}
        {/if}
    </div>
</div>