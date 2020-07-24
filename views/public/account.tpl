{extends file="public/layout.tpl"}
{block name=title}Особистий аккаунт - {$sitedata['sitename']}{/block}
{block name=body}

    <section class="gtco-banner-area pri-column">
        <div class="container">
            <div class="col-lg-12">
                <header class="mt-lg-5 mb-lg-5" ><h2 id="name-acc" class="text-center text-success">Вітаю {$user.username}!</h2></header>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h3 class="text-center">Профіль користувача</h3>
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row no-gutters">
                            <div class="col-md-4 mt-4">
                                <img id="img-avatar" src="/public/pic/avatar/{$user.avatar}" class="card-img" alt="{$user.username}">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <p class="card-text pt-3">Логін: <span id="loginRePass">{$user.login}</span><br>
                                        <span id="mail-acc">@mail: {$user.email}</span><br>
                                        Роль: {$user.role}<br>
                                        Дата реєстрації: {$user.date}</p>
                                    <button type="button" class="submit-button" data-toggle="modal" data-target="#account">Змінити <i class="fa ico-angle-right" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 contact-info">
                    <h3 class="mb-4 text-center">Змінити пароль</h3>
                    <input id="pssOld" type="password" class="form-control" placeholder="Існуючий пароль">
                    <input id="newPss" type="password" class="form-control newpss password" placeholder="Новий пароль">
                    <span class= "complexity aviso text-danger"></span>
                    <input id="rePss" type="password" class="form-control repss password" placeholder="Підтвердити пароль">
                    <span class= "equality aviso text-danger"></span>
                    <div class="text-md-center mb-5"><button type="button" class="submit-button" onclick = "editPass()">Підтвердити <i class="fa ico-angle-right" aria-hidden="true"></i></button></div>

                </div>
            </div>
            <div id="reLogin"></div>
        </div>
    </section>
    <script src="/public/js/account.js"></script>
{/block}