{extends file="admin/layout.tpl"}
{block name=title}Пользователи - Админ панель {/block}
{block name=body}
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12 mb-5 mt-5"><h3>Пользователи</h3>
                    <hr>
                </div>
                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Аватар</th>
                        <th scope="col">Имя</th>
                        <th scope="col">@mail</th>
                        <th scope="col">Логин</th>
                        <th scope="col">Роль</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    {foreach $users as $User}
                        <tr id="{$User['id']}">
                            <td class="align-middle" scope="row">{$User['id']}</td>
                            <td id="avatar-{$User['id']}" class="align-middle"><img
                                        src="/public/pic/avatar/{$User['avatar']}" style="height: 35px; width: auto">
                            </td>
                            <td id="username-{$User['id']}" class="align-middle">{$User['username']}</td>
                            <td id="email-{$User['id']}" class="align-middle">{$User['email']}</td>

                            {if !empty($smarty.session.user.id === $User['id'])}
                                <td class="align-middle  text-black-50">{$User['login']}</td>
                                <td class="align-middle text-black-50">{$User['role']}</td>
                                <td class="align-middle">
                                    <button class="btn btn-linc btn-sm text-secondary" onclick="#" disabled><i class="far fa-trash-alt"></i>  Удалить</button>
                                </td>
                            {else}
                                <td id="login-{$User['id']}" class="align-middle">{$User['login']}</td>
                                <td id="role-{$User['id']}" class="align-middle">{$User['role']}</td>
                                <td class="align-middle">
                                    <button class="btn btn-linc btn-sm text-danger" onclick="removedStart('{$User['id']}','{$User['login']}','users')"><i class="far fa-trash-alt"></i> Удалить</button>
                                </td>
                            {/if}
                        </tr>
                    {/foreach}
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <script src="/public/js/users.js"></script>
{/block}


