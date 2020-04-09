{extends file="admin/layout.tpl"}
{block name=title}Категории - Админ панель{/block}
{block name=body}
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12 mb-5 mt-5"><h3>Категории</h3>
                    <hr>
                </div>
                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Название</th>
                        <th scope="col">Описание</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    {foreach $categories as $category}
                        <tr>
                            <td class="align-middle">{$category['id']}</td>
                            <td class="align-middle">{$category['name']}</td>
                            <td class="align-middle">{$category['description']}</td>
                            <td class="align-middle">
                                <button class="btn btn-linc btn-sm text-danger"
                                        onclick="removedStart('{$User['id']}','{$User['login']}')"><i
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
{/block}