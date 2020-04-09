{extends file="admin/layout.tpl"}
{block name=title}Ссылки меню - Админ панель{/block}
{block name=body}
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12 mb-3 mt-5"><h3>Ссылки</h3>
                    <hr>
                </div>
                <a class="btn btn-outline-primary mb-2 mr-2" href="/menu-adm"><i class="far fa-arrow-alt-circle-left"></i> Назад</a>
                <button class="btn btn-outline-secondary mb-2"  data-toggle="modal" data-target="#menu-add"><i class="fas fa-folder-plus"></i> Добавить ссылку</button>
                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Назавание</th>
                        <th scope="col">Описание</th>
                        <th scope="col">URL</th>
                        <th scope="col">Отображение</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody id="holder-lnk">
                    {if ({$empty})}
                        <tr>
                            <td colspan="5">{$empty}</td>
                        </tr>
                        {/if}
                    {foreach $menuEdits as $menuEdit}
                        <tr id="{$menuEdit['id']}">
                            <td class="align-middle">{$menuEdit['id']}</td>
                            <td id="title-{$menuEdit['id']}" class="align-middle">{$menuEdit['title']}</td>
                            <td id="description-{$menuEdit['id']}" class="align-middle">{$menuEdit['description']}</td>
                            <td id="url-{$menuEdit['id']}" class="align-middle">{$menuEdit['url']}</td>
                            <td id="enabled-{$menuEdit['id']}" class="align-middle">{$menuEdit['enabled']}</td>
                            <td>
                                <button class="btn btn-linc btn-sm text-danger" onclick="removedStart('{$menuEdit['id']}','{$menuEdit['title']}','link' )"><i class="far fa-trash-alt"></i> Удалить</button>
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