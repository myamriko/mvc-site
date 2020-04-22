{extends file="admin/layout.tpl"}
{block name=hint}{$hint}{/block}
{block name=title}Меню - Админ панель{/block}
{block name=body}
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12 mb-3 mt-5"><h3>Меню</h3>
                    <hr>
                </div>
                <div class="form-inline mb-2">
                    <button class="btn btn-outline-secondary" data-toggle="modal" onclick="call_menu()"><i
                                class="fas fa-folder-plus"></i> Добавить меню
                    </button>
                    <input type="search" class="ml-2 form-control acInput search-panel" id="searchTitle"
                           placeholder="Сортировка:" autocomplete="on">
                    <input type="text" class="ml-2 form-control pageLimit" id="pageLimitMenuPanel"
                           placeholder="Отображать {$menuLimit} строк" data-cache="menu-all-panel">
                </div>
                <table class="table table-striped">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Назавание</th>
                        <th scope="col">Описание</th>
                        <th scope="col">Отображение</th>
                        <th scope="col">Админ название</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody id="holder">
                    {if (!$menuNames)}
                        <tr>
                            <td colspan="6" id="empty"><span class="blockquote">Не создано ни одного меню.</span></td>
                        </tr>
                    {/if}
                    {foreach $menuNames as $menuName}
                        <tr id="{$menuName['id']}">
                            <td>{$menuName['id']}</td>
                            <td id="title-{$menuName['id']}">{$menuName['title']}</td>
                            <td id="description-{$menuName['id']}">{$menuName['description']}</td>
                            <td id="enabled-{$menuName['id']}">{$menuName['enabled']}</td>
                            <td>{$menuName['menu_name']}</td>
                            <td>
                                <div class="btn-group dropleft">
                                    <button type="button" class="btn btn-outline-secondary btn-sm dropdown-toggle"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Редактировать
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item text-success"
                                           href="/link-adm/index/{$menuName['menu_name']}"><i class="far fa-edit"></i>
                                            Изменить</a>
                                        <div class="dropdown-divider"></div>
                                        <button class="dropdown-item text-danger"
                                                onclick="removedStart('{$menuName['id']}','{$menuName['title']}','menu')">
                                            <i class="far fa-trash-alt"></i> Удалить
                                        </button>
                                    </div>
                                </div>
                            </td>
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
    <script src="/public/js/menu.js"></script>
{/block}