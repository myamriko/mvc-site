{extends file="admin/layout.tpl"}
{block name=hint}{$hint}{/block}
{block name=title}Теги - Админ панель{/block}
{block name=body}
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12 mb-3 mt-5"><h3>Теги</h3>
                    <hr>
                </div>
                <div class="form-inline mb-2">
                    <input type="text" class="add form-control ml-2 mb-2" id="tag" placeholder="Новый тег">
                    <button class="btn btn-outline-secondary ml-2 mb-2" data-toggle="modal" onclick="add_tag()"><i
                                class="fas fa-tags"></i> Добавить
                    </button>
                    <input type="search" class="ml-2 mb-2 form-control acInput search-panel" id="searchTitle"
                           placeholder="Сортировка по тегам:" autocomplete="on">
                    <input type="text" class="pageLimit ml-2 mb-2 form-control" id="pageLimitTagPanel"
                           placeholder="Отображать {$tagsLimit} строк" data-cache="tags-site">
                </div>
                <table class="table table-striped table-mob">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Тег</th>
                        <th scope="col">URL</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody id="holder">
                    {if (!$tags)}
                        <tr>
                            <td id="empty" colspan="4"><span class="blockquote">Еще нет тегов.</span></td>
                        </tr>
                    {/if}
                    {foreach $tags as $tag}
                        <tr id="{$tag['id']}">
                            <td data-label="Id">{$tag['id']}</td>
                            <td data-label="Тег" id="title-{$tag['id']}">{$tag['tag']}</td>
                            <td data-label="URL">{$tag['url']}</td>
                            <td data-label=" ">
                                <button class="btn btn-linc btn-sm text-danger"
                                        onclick="removedStart('{$tag['id']}','{$tag['tag']}','tags' )"><i
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
    <script src="/public/js/tags.js"></script>
{/block}