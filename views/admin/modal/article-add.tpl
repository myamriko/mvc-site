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
                    <input type="text" class="form-control mb-2" id="title"
                           placeholder="Заголовок, он же title длина составляет 30-70 символов.">
                    <textarea class="form-control mb-2" rows="2" name="intro" id="intro"
                              placeholder="Описание, оно же description. Размер мета-тега description 150-160 символов."></textarea>
                    <textarea name="text" id="editor" placeholder="Текст статьи"></textarea>
                    <input type="search" class="form-control mt-2 acInputTag" id="tags" name="tags"
                           placeholder="Теги. Вводить через запятую. Чем меньше, тем лучше.">
                    <input type="text" class="form-control mb-2 mt-2" id="url" name="url"
                           placeholder="Постоянная ссылка, ее длина - чем меньше, тем лучше. Не больше 3х слов.">
                    <select class="form-control mb-2" id="category" name="category">
                        <option selected >Выбрать категорию</option>
                        <optgroup label="Доступные категории">
                            {foreach $categories as $category}
                                <option value="{$category['url']}">{$category['name']}</option>
                            {/foreach}
                        </optgroup>
                    </select>
                    <input type="text" class="form-control mb-2" id="author" name="author" placeholder="Аффтар"
                           value="{$smarty.session.user.username}">
                    <div class="row">
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="alt" name="alt"
                               placeholder="Alt - 3-5 слов, не более 75 сим.">
                    </div>
                    <label for="file" class="col-sm-2 col-form-label ml-1 ">Изображение: </label>
                    <div class="col-sm-4 mt-2">
                        <input  type="file"  class="form-control-file" id="files" name="files" placeholder="Загрузить фаил">
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label for="published">Опубликовать:</label>
                        <select name="published" id="published" class="form-control">
                            <optgroup label="ВКЛ/ВЫКЛ">
                                <option selected value='ON'>ON</option>
                                <option value='OFF'>OFF</option>
                            </optgroup>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label for="front">Поместить на главную:</label>
                        <select name="front" id="front" class="form-control">
                            <optgroup label="ВКЛ/ВЫКЛ">
                                <option value='ON'>ON</option>
                                <option selected value='OFF'>OFF</option>
                            </optgroup>
                        </select>
                    </div>
                </div>
            </div>
            <div id="err" class="alert alert-danger ml-3 mr-3" style="display: none"><strong>Error:</strong><span
                        id="message"></span></div>
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
