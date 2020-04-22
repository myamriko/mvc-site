{extends file="admin/layout.tpl"}
{block name=hint}{$hint}{/block}
{block name=tagSearch}{$tagSearch}{/block}
{block name=title}Пользователи - Админ панель {/block}
{block name=body}
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12 mb-5 mt-5"><h3>Пользователи</h3>
                    <hr>
                </div>
                <div class="form-inline mb-2">
                    <input type="search" class="ml-2 form-control acInput search-panel" id="searchTitle"
                           placeholder="Сортировка по имени" autocomplete="on">
                    <input type="search" class="ml-2 form-control acInputTag search-panel" id="searchTag"
                           placeholder="Сортировка по Логину" autocomplete="on">
                    <input type="text" class="pageLimit ml-2 form-control" id="pageLimitUserPanel"
                           placeholder="Отображать {$userLimit} строк" data-cache="users-panel">
                </div>

                <table class="table table-striped">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Имя</th>
                        <th scope="col">@mail</th>
                        <th scope="col">Аватар</th>
                        <th scope="col">Логин</th>
                        <th scope="col">Роль</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    {if (!$users)}
                        <tr>
                            <td id="empty" colspan="5"><span class="blockquote">Нет ни одного пользователя.</span></td>
                        </tr>
                    {/if}
                    {foreach $users as $User}
                        <tr id="{$User['id']}">
                            <td scope="row">{$User['id']}</td>
                            <td id="username-{$User['id']}">{$User['username']}</td>
                            <td id="email-{$User['id']}">{$User['email']}</td>
                            <td id="avatar-{$User['id']}"><img
                                        src="/public/pic/avatar/{$User['avatar']}" style="height: 35px; width: auto">
                            </td>
                            {if $smarty.session.user.id === $User['id']}
                                <td class="align-middle  text-black-50">{$User['login']}</td>
                                <td class="align-middle text-black-50">{$User['role']}</td>
                                <td>
                                    <button class="btn btn-linc btn-sm text-secondary" onclick="#" disabled><i
                                                class="far fa-trash-alt"></i> Удалить
                                    </button>
                                </td>
                            {else}
                                <td id="login-{$User['id']}">{$User['login']}</td>
                                <td id="role-{$User['id']}">{$User['role']}</td>
                                <td>
                                    <button class="btn btn-linc btn-sm text-danger"
                                            onclick="removedStart('{$User['id']}','{$User['login']}','users')"><i
                                                class="far fa-trash-alt"></i> Удалить
                                    </button>
                                </td>
                            {/if}
                        </tr>
                    {/foreach}
                    </tbody>
                </table>
                <div class="col-12 justify-content-end">
                    {$pagination}
                </div>
            </div>
        </div>
    </section>
    <script src="/public/js/users.js"></script>
{/block}


