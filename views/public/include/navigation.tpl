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

        <h3>Menu</h3>
        <ul class="navigation-menu">
            <li><a href="/" class="active">Главная</a></li>
            {if !empty($smarty.session.user.id) && $smarty.session.user.role !='admin'}
                <li><a href="#"> <i class="red fa fa-circle"></i> Личный кабинет</a></li>
            {/if}
            {if !empty($smarty.session.user.id) && $smarty.session.user.role == 'admin'}
                <li><a href="/info-adm"> <i class="red fa fa-circle"></i> Админ панель</a></li>
            {/if}
            <li><a href="#"><i class="beige fa fa-circle"></i> Kitchen cabinets</a></li>
            <li><a href="#"><i class="orange fa fa-circle"></i> Counters</a></li>
            <li><a href="#"><i class="blue fa fa-circle"></i> Other</a></li>
        </ul>
        <h3>More</h3>
        <ul class="navigation-menu">
            <li><a href="#">About Us</a></li>
            <li><a href="#">Contact</a></li>
            <li><a href="#">Info</a></li>
            <li><a href="#">Collaboration</a></li>
            <li><a href="#">Customer Service</a></li>
        </ul>
    </div>
</div>