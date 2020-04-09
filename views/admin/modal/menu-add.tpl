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
                    {if ($menuName)}
                        <label for="menu_name" class="col-sm-3 col-form-label mt-3">Админ название:</label>
                        <div class="col-sm-9 mt-3">
                            <input type="text" class="form-control" id="menu_name" placeholder="Техническое название *">
                        </div>
                        <div class="d-flex justify-content-end">
                            <div class="col-sm-9 mt-2">
                                <div class="p-2 alert alert-info hidden-xs hidden-sm" role="alert">* Сдужит для
                                    идентификации меню системой, может содержать только латинские буквы, цифры и символ
                                    "_".
                                </div>
                            </div>
                        </div>
                    {/if}
                    <label for="title" class="col-sm-3 col-form-label">Название:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="title" placeholder="Название">
                    </div>
                    <label for="description" class="col-sm-3 col-form-label mt-3">Описание:</label>
                    <div class="col-sm-9 mt-3">
                        <input type="text" class="form-control" id="description" placeholder="Описание">
                    </div>
                    {if (!$menuName)}
                        <label for="url" class="col-sm-3 col-form-label mt-3">URL:</label>
                        <div class="col-sm-9 mt-3">
                            <input type="text" class="form-control" id="url" placeholder="URL ссылки">
                        </div>
                    {/if}
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
                        class="btn btn-primary" {if ($menuName)} onclick="add_menu()"{else}onclick ="add_link('{$param}')"{/if}>
                    Добавить
                </button>
            </div>
        </div>
    </div>
</div>