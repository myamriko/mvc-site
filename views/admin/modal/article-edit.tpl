<div class="modal" id="article-edit" tabindex="-1" role="dialog" aria-labelledby="article-editModalLongTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="article-editModalLongTitle">Добавить</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row ml-1 mr-1">
                    <input type="hidden" id="id-article">
                    <label for="titleEdit">Заголовок:</label>
                    <input type="text" class="form-control mb-2" id="titleEdit"
                           placeholder="Заголовок, он же title длина составляет 30-70 символов.">
                    <label for="introEdit">Описание:</label>
                    <textarea class="form-control mb-2" rows="2" name="introEdit" id="introEdit"
                              placeholder="Описание, оно же description. Размер мета-тега description 150-160 символов."></textarea>
                    <label for="editorEdit">Статья:</label>
                    <textarea name="text" id="editorEdit" placeholder="Текст статьи"></textarea>
                    <label class="mt-2" for="tagsEdit">Теги:</label>
                    <input type="search" class="form-control acInputTag" id="tagsEdit" name="tagsEdit"
                           placeholder="Теги. Вводить через запятую. Чем меньше, тем лучше.">
                    <label class="mt-2" for="urlEdit">Постоянная ссылка:<br><span class="text-danger" style="font-size: small">Индексируется, менять только в крайнем случае!</span></label>
                    <input type="text" class="form-control mb-2" id="urlEdit" name="urlEdit"
                           placeholder="Постоянная ссылка, ее длина - чем меньше, тем лучше. Не больше 3х слов.">
                    <label for="categoryEdit">Категории:</label>
                    <select class="form-control mb-2" id="categoryEdit" name="categoryEdit">
                        <optgroup label="Доступные категории">
                            {foreach $categories as $category}
                                <option value="{$category['url']}">{$category['name']}</option>
                            {/foreach}
                        </optgroup>
                    </select>
                    <label for="authorEdit">Аффтар:</label>
                    <input type="text" class="form-control mb-2" id="authorEdit" name="authorEdit" placeholder="Аффтар"
                           value="{$smarty.session.user.username}">
                    <div class="col-12" id="imgEdit"></div>
                    <div class="col-12">Изменить изображение: </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="altEdit" name="altEdit"
                                   placeholder="Alt - 3-5 слов, не более 75 сим.">
                        </div>

                        <div  class="col-sm-4 mt-2">
                            <input type="file" id="filesEdit" class="ml-2 form-control-file" name="filesEdit" placeholder="Загрузить фаил">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label for="publishedEdit">Опубликовать:</label>
                        <select name="publishedEdit" id="publishedEdit" class="form-control">
                            <optgroup label="ВКЛ/ВЫКЛ">
                                <option value='ON'>ON</option>
                                <option value='OFF'>OFF</option>
                            </optgroup>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label for="frontEdit">Поместить на главную:</label>
                        <select name="frontEdit" id="frontEdit" class="form-control">
                            <optgroup label="ВКЛ/ВЫКЛ">
                                <option value='ON'>ON</option>
                                <option selected value='OFF'>OFF</option>
                            </optgroup>
                        </select>
                    </div>
                </div>
            </div>
            <div id="errEdit" class="alert alert-danger ml-3 mr-3" style="display: none"><strong>Error:</strong><span
                        id="messageEdit"></span></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Отменить</button>
                <button type="button"
                        class="btn btn-primary" onclick="update()">
                    Изменить
                </button>
            </div>
        </div>
    </div>
</div>
