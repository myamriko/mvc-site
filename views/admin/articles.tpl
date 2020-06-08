{extends file="admin/layout.tpl"}
{block name=hint}{$hint}{/block}
{block name=tagSearch}{$tagSearch}{/block}
{block name=title}Статьи - Админ панель{/block}
{block name=body}
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mb-5 mt-5"><h3>Статьи</h3>
                    <hr>
                </div>
                <div class="form-inline mb-2">
                    <button class="btn btn-outline-secondary" data-toggle="modal"
                            data-target="#article-add"><i
                                class="fas fa-folder-plus"></i> Добавить статью
                    </button>
                    <input type="search" class="ml-2 form-control acInput search-panel" id="searchArticle"
                           placeholder="Поиск:">
                    <input type="text" class="ml-2 form-control pageLimit" id="pageLimitArticlePanel"
                           placeholder="Отображать {$articleLimit} строк" data-cache="article-site">
                </div>
                <table class="table table-striped" id="articles">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Название</th>
                        <th scope="col">Описание</th>
                        <th scope="col">Категория</th>
                        <th scope="col">Теги</th>
                        <th scope="col">Картинка</th>
                        <th scope="col">Дата</th>
                        <th scope="col">Аффтар</th>
                        <th scope="col">Публикация</th>
                        <th scope="col">Главная</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody id="holder">
                    {if (!$articles)}
                        <tr>
                            <td colspan="11"><span class="blockquote">Статей нет.</span></td>
                        </tr>
                    {/if}
                    {foreach $articles as $articl}
                        <tr id="{$articl['id']}">
                            <td id="id">{$articl['id']}</td>
                            <td><a class="text-dark text-uppercase" href="/article/{$articl['url']}">{$articl['title']}</a></td>
                            <td>{$articl['intro']}</td>
                            <td><a class="text-dark" href="/category/{$articl['category']}">{$articl['name']}</a></td>
                            <td>{$articl['tags']}</td>
                            <td><a data-toggle="modal"
                                   onclick="imgView('{$articl['file']}','{$articl['alt']}')"
                                   href="#"><img class="img-thumbnail" style="height: 70px;"
                                                 src="/public/pic/img-art/{$articl['file']}"></a>
                            </td>
                            <td>{$articl['date']|date_format:"%d.%m.%Y,  %H:%M:%S"}</td>
                            <td>{$articl['author']}</td>
                            <td>{$articl['published']}</td>
                            <td>{$articl['front']}</td>
                            <td>
                                <div class="btn-group dropleft">
                                    <button type="button" class="btn btn-outline-secondary btn-sm dropdown-toggle"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Редактировать
                                    </button>
                                    <div class="dropdown-menu">
                                        <button type="button" class="dropdown-item text-success"
                                                onclick="edit('{$articl['id']}')"><i class="far fa-edit"></i>
                                            Изменить
                                        </button>
                                        <div class="dropdown-divider"></div>
                                        <button type="button" class="dropdown-item text-danger"
                                                onclick="removedStart('{$articl['id']}','{$articl['title']}','articles')">
                                            <i class="far fa-trash-alt"></i>
                                            Удалить
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
        <script>
            //сдушаем input по отпущенной клавише извлекаем val потом передаем через POST
            $('#searchArticle').on('keyup', function () {

                var text = $('#searchArticle').val().trim();
               /* if (text.length < 3) {
                    return;//если мение 3х букв в запросе выходим
                }*/
                console.log(text);
               /* $.post('/search/make', {
                    text: text
                }, function (res) {
                    console.log('cache: '+res.cache);
                    $('#holder').empty();//очистить блок
                    var len = res.data.length;// колво элементов в массиве
                    var html = '';
                    for (var i = 0; i < len; i++) {
                        html = "<div>" + res.data[i].name + "</div>" +
                            "<div>" + res.data[i].description + "</div>" +
                            "<div>" + res.data[i].price +"$" + "</div>" +
                            "<hr>";
                        $('#holder').append(html);//добавить в id holder
                    }
                });*/
            });
        </script>
    </section>
    {include file="admin/modal/img.tpl"}
    {include file="admin/modal/article-add.tpl"}
    {include file="admin/modal/article-edit.tpl"}
    <script src="/libs/ckeditor5-classik-full/ckeditor.js"></script>
    <script src="/libs/ckfinder/ckfinder.js"></script>
    <script src="/public/js/ckeditorEditOptions.js"></script>
    <script src="/public/js/ckeditorOptions.js"></script>{*Для каждой копии эдитора свои настройки*}
    <script src="/public/js/aricles.js"></script>
{/block}