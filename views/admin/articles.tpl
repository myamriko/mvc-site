{extends file="admin/layout.tpl"}
{block name=title}Статьи - Админ панель{/block}
{block name=body}
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mb-5 mt-5"><h3>Статьи</h3>
                    <hr>
                </div>
                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Название</th>
                        <th scope="col">Описание</th>
                        <th scope="col">URL</th>
                        <th scope="col">Дата</th>
                        <th scope="col">Аффтар</th>
                        <th scope="col">Категория</th>
                        <th scope="col">Публикация</th>
                        <th scope="col">Главная</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    {foreach $articles as $articl}
                        <tr>
                            <td class="align-middle">{$articl['id']}</td>
                            <td class="align-middle">{$articl['title']}</td>
                            <td class="align-middle">{$articl['intro']}</td>
                            <td class="align-middle">{$articl['slug']}</td>
                            <td class="align-middle">{$articl['date']|date_format:"%d-%m-%Y  %H:%M"}</td>
                            <td class="align-middle">{$articl['avtor']}</td>
                            <td class="align-middle">{$articl['category']}</td>
                            <td class="align-middle">{$articl['published']}</td>
                            <td class="align-middle">{$articl['front']}</td>
                            <td class="align-middle">
                                <div class="btn-group dropleft">
                                    <button type="button" class="btn btn-outline-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Редактировать
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item text-success" href="#"><i class="far fa-edit"></i> Изменить</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item text-danger" href="#"><i class="far fa-trash-alt"></i> Удалить</a>
                                    </div>
                                </div>
                            </td>

                        </tr>
                    {/foreach}
                    </tbody>
                </table>
            </div>
        </div>
    </section>
{/block}