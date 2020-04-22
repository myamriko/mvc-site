<div class="modal fade" id="menu-add" tabindex="-1" role="dialog" aria-labelledby="menu-addModalLongTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="menu-addModalLongTitle">Добавить</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">

                        <label for="menu_name" class="menuName col-sm-3 col-form-label mt-3" style="display: none;">Админ название:</label>
                        <div class="col-sm-9 mt-3">
                            <input type="text" class="menuName form-control" id="menu_name" style="display: none;" placeholder="Техническое название *">
                        </div>
                        <div class="menuName d-flex justify-content-end" style="display: none;">
                            <div class="col-sm-9 mt-2">
                                <div class="menuName p-2 alert alert-info hidden-xs hidden-sm" role="alert"  style="display: none;">* Сдужит для
                                    идентификации меню системой, может содержать только латинские буквы, цифры и символ
                                    "_".
                                </div>
                            </div>
                        </div>

                    <label for="title" class="col-sm-3 col-form-label">Название:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="title" placeholder="Название">
                    </div>
                    <label for="description" class="col-sm-3 col-form-label mt-3">Описание:</label>
                    <div class="col-sm-9 mt-3">
                        <input type="text" class="form-control" id="description" placeholder="Описание">
                    </div>

                        <label for="url" class="link col-sm-3 col-form-label mt-3">URL:</label>
                        <div class="col-sm-9 mt-3 link">
                            <input type="text" class="link form-control" id="url" placeholder="URL ссылки">
                        </div>

                    <label for="enabled" class="col-sm-3 col-form-label mt-3">Отображение:</label>
                    <div class="col-sm-9 mt-3">
                        <select name="enabled" id="enabled" class="form-control">
                            <optgroup label="ВКЛ/ВЫКЛ">
                                <option selected value='ON'>ON</option>
                                <option value='OFF'>OFF</option>
                            </optgroup>
                        </select>
                    </div>
                </div>
            </div>
            <div id="menu_err" class="alert alert-danger ml-3 mr-3" style="display: none"><strong>Error:</strong><span
                        id="message"></span></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Отменить</button>
                <button type="button"
                        class="menuName btn btn-primary " style="display: none;" onclick="add_menu()">
                    Добавить
                </button>
                <button type="button"
                        class="link btn btn-primary"
                        {if ($param)}onclick ="add_link('{$param}')"{else}onclick="add_category()"{/if}>
                    Добавить
                </button>
            </div>
        </div>
    </div>
</div>