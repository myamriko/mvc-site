{extends file="admin/layout.tpl"}
{block name=hint}{$hint}{/block}
{block name=title}Категории - Админ панель{/block}
{block name=body}
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12 mb-5 mt-5"><h3>Категории</h3>
                    <hr>
                </div>
                <div class="form-inline mb-2">
                    <button class="btn btn-outline-secondary" data-toggle="modal" data-target="#menu-add"><i
                                class="fas fa-folder-plus"></i> Добавить категорию
                    </button>
                    <input type="search" class="ml-2 form-control acInput search-panel" id="searchTitle"
                           placeholder="Сортировка:" autocomplete="on">
                    <input type="text" class="ml-2 form-control pageLimit" id="pageLimitCategoryPanel"
                           placeholder="Отображать {$categoryLimit} строк" data-cache="categories-site">
                </div>
                <table class="table table-striped">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Название</th>
                        <th scope="col">Описание</th>
                        <th scope="col">Url</th>
                        <th scope="col">Отображение</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody id="holder">
                    {if (!$categories)}
                        <tr>
                            <td colspan="6"><span class="blockquote">Не создано ни одной категории.</span></td>
                        </tr>
                    {/if}
                    {foreach $categories as $category}
                        <tr id="{$category['id']}">
                            <td>{$category['id']}</td>
                            <td id="name-{$category['id']}">{$category['name']}</td>
                            <td id="description-{$category['id']}">{$category['description']}</td>
                            <td>{$category['url']}</td>
                            <td id="enabled-{$category['id']}">{$category['enabled']}</td>
                            <td>
                                <button class="btn btn-linc btn-sm text-danger"
                                        onclick="removedStart('{$category['id']}','{$category['name']}','categories')">
                                    <i
                                            class="far fa-trash-alt"></i> Удалить
                                </button>
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
    <script src="/public/js/categories.js"></script>
{/block}