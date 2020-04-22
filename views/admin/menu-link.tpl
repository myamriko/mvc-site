{extends file="admin/layout.tpl"}
{block name=hint}{$hint}{/block}
{block name=title}Ссылки меню - Админ панель{/block}
{block name=body}
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12 mb-3 mt-5"><h3>Ссылки</h3>
                    <hr>
                </div>
                <div class="form-inline mb-2">
                    <a class="btn btn-outline-primary mr-2" href="/menu-adm"><i
                                class="far fa-arrow-alt-circle-left"></i> Назад</a>
                    <button class="btn btn-outline-secondary" data-toggle="modal" data-target="#menu-add"><i
                                class="fas fa-folder-plus"></i> Добавить ссылку
                    </button>
                    <input type="search" class="ml-2 form-control acInput search-panel" id="searchTitle" placeholder="Поиск:" autocomplete="on">
                </div>
                <table class="table table-striped">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Назавание</th>
                        <th scope="col">Описание</th>
                        <th scope="col">URL</th>
                        <th scope="col">Отображение</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody id="holder">
                    {if (!$menuEdits)}
                        <tr>
                            <td id="empty" colspan="6"><span class="blockquote">В этом меню еще нет ссылок.</span></td>
                        </tr>
                    {/if}
                    {foreach $menuEdits as $menuEdit}
                        <tr id="{$menuEdit['id']}">
                            <td >{$menuEdit['id']}</td>
                            <td id="title-{$menuEdit['id']}" >{$menuEdit['title']}</td>
                            <td id="description-{$menuEdit['id']}" >{$menuEdit['description']}</td>
                            <td id="url-{$menuEdit['id']}" >{$menuEdit['url']}</td>
                            <td id="enabled-{$menuEdit['id']}" >{$menuEdit['enabled']}</td>
                            <td>
                                <button class="btn btn-linc btn-sm text-danger"
                                        onclick="removedStart('{$menuEdit['id']}','{$menuEdit['title']}','link' )"><i
                                            class="far fa-trash-alt"></i> Удалить
                                </button>
                            </td>
                        </tr>
                    {/foreach}
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <script src="/public/js/link.js"></script>
{/block}