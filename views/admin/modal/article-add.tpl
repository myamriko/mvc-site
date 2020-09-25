<div class="modal" id="article-add" tabindex="-1" role="dialog" aria-labelledby="article-addModalLongTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="article-addModalLongTitle">Добавить</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row ml-1 mr-1">
                    <input id="titleArticle" type="text" class="form-control mb-2"
                           placeholder="Заголовок, он же title длина составляет 30-70 символов.">
                    <textarea id="introArticle" class="form-control mb-2" rows="2" name="intro"
                              placeholder="Описание, оно же description. Размер мета-тега description 150-160 символов."></textarea>
                    <textarea name="text" id="editor" placeholder="Текст статьи"></textarea>
                    <input id="tagsArticle" type="search" class="form-control mt-2 acInputTag"  name="tags"
                           placeholder="Теги. Вводить через запятую. Чем меньше, тем лучше.">
                    <input id="urlArticle" type="text" class="form-control mb-2 mt-2" name="url"
                           placeholder="Постоянная ссылка, ее длина - чем меньше, тем лучше. Не больше 3х слов.">
                    <select id="categoryArticle" class="form-control mb-2"  name="category">
                        <option selected >Выбрать категорию</option>
                        <optgroup label="Доступные категории">
                            {foreach $categories as $category}
                                <option value="{$category['url']}">{$category['name']}</option>
                            {/foreach}
                        </optgroup>
                    </select>
                    <input id="authorArticle" type="text" class="form-control mb-2"  name="author" placeholder="Аффтар"
                           value="{$smarty.session.user.username}">
                    <div class="col-12 ">Выбрать изображение:</div>
                    <div class="row">
                    <div class="col-sm-5">
                        <input id="altArticle" type="text" class="form-control"  name="alt"
                               placeholder="Alt - 3-5 слов, не более 75 сим.">
                    </div>

                    <div class="col-sm-4 mt-2">
                        <input id="filesArticle"  type="file"  class="form-control-file" name="files" placeholder="Загрузить фаил">
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label for="published">Опубликовать:</label>
                        <select name="published" id="publishedArticle" class="form-control">
                            <optgroup label="ВКЛ/ВЫКЛ">
                                <option selected value='ON'>ON</option>
                                <option value='OFF'>OFF</option>
                            </optgroup>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label for="front">Поместить на главную:</label>
                        <select name="front" id="frontArticle" class="form-control">
                            <optgroup label="ВКЛ/ВЫКЛ">
                                <option value='ON'>ON</option>
                                <option selected value='OFF'>OFF</option>
                            </optgroup>
                        </select>
                    </div>
                </div>
            </div>
            <div id="errArticle" class="alert alert-danger ml-3 mr-3" style="display: none"><strong>Error:</strong><span
                        id="messageArticle"></span></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Отменить</button>
                <button type="button"
                        class="btn btn-primary" onclick="add()">
                    Добавить
                </button>
            </div>
        </div>
    </div>
</div>
