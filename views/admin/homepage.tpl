{extends file="admin/layout.tpl"}
{block name=title}Настройка Главной страницы{/block}
{block name=body}
    <div class="container">
        {*Про мну*}
        <section id="frontAbout" class="border-bottom mt-5">
            <div class="row ml-0">
                <h4 id="{$frontContent[0]['id']}-section">{$frontContent[0]['section']}</h4>
                <p class="ml-2">
                    <select name="social" id="{$frontContent[0]['id']}-display" class="form-control">
                        <optgroup label="ВКЛ/ВЫКЛ">
                            <option value='ON'>ON</option>
                            <option value='OFF'>OFF</option>
                        </optgroup>
                        <optgroup label="Секция:">
                            <option selected
                                    value="{$frontContent[0]['display']}">{$frontContent[0]['display']}</option>
                        </optgroup>
                    </select>
                </p>
            </div>
            <div class="row">
                <div class="col-md-6 mt-1 mb-3">
                    <div class="card">
                        <img class="img-fluid" id="{$frontContent[0]['id']}-img"
                             src="/public/images/{$frontContent[0]['img']}">
                        <button id="{$frontContent[0]['id']}-btnImg" type="button" class="btn btn-secondary btn-sm"
                                style="position: absolute;">
                            Изменить
                        </button>
                    </div>
                </div>
                <div class="col-md-6 mt-1 mb-1">
                    <p class="lead"><span id="{$frontContent[0]['id']}-Title"
                                          class="text-muted">{$frontContent[0]['title']}</span></p class="lead">


                    <p class="lead">Текст:</p>
                    <p id="{$frontContent[0]['id']}-text" class="mb-3">{$frontContent[0]['text']}</p>

                    <p class="lead">Переход: <span id="{$frontContent[0]['id']}-goByLink"
                                                   class="text-muted">{$frontContent[0]['goByLink']}</span></p>
                </div>
            </div>
        </section>
        {*Услуги*}
        <section id="frontServices" class="border-bottom  mt-5">
            <div class="row ml-0">
                <h4 id="{$frontContent[1]['id']}-section">{$frontContent[1]['section']}</h4>
                <p class="ml-2">
                    <select name="social" id="{$frontContent[1]['id']}-display" class="form-control">
                        <optgroup label="ВКЛ/ВЫКЛ">
                            <option value='ON'>ON</option>
                            <option value='OFF'>OFF</option>
                        </optgroup>
                        <optgroup label="Секция:">
                            <option selected
                                    value="{$frontContent[1]['display']}">{$frontContent[1]['display']}</option>
                        </optgroup>
                    </select>
                </p>
            </div>
            <div class="row">
                <div class="col-md-12 mt-1 mb-1 mr-2">
                    <p class="lead"><span id="{$frontContent[1]['id']}-title"
                                          class="text-muted">{$frontContent[1]['title']}</span></p>

                    <p class="lead">Текст:</p>
                    <p class="mb-3" id="{$frontContent[1]['id']}-text">{$frontContent[1]['text']}</p>

                    <p class="lead">Переход: <span id="{$frontContent[1]['id']}-goByLink"
                                                   class="text-muted">{$frontContent[1]['goByLink']}</span></p>
                </div>
                <div class="col-md-6 mb-3 orange-line">
                    <p class="lead"><span id="{$frontContent[2]['id']}-title"
                                          class="text-muted">{$frontContent[2]['title']}</span></p>
                    <select name="{$frontContent[2]['id']}-display" id="{$frontContent[2]['id']}-display"
                            class="form-control">
                        <optgroup label="ВКЛ/ВЫКЛ">
                            <option value='ON'>ON</option>
                            <option value='OFF'>OFF</option>
                        </optgroup>
                        <optgroup label="Карточка:">
                            <option selected
                                    value="{$frontContent[2]['display']}">{$frontContent[2]['display']}</option>
                        </optgroup>
                    </select>
                    <div class="mt-2">
                        <p class="lead">Текст:</p>
                        <p id="{$frontContent[2]['id']}-text" class="mb-3">{$frontContent[2]['text']}</p>
                    </div>
                    <div><p class="lead">Описание:</p>
                        <p id="{$frontContent[2]['id']}-description"
                           class="mb-3">{$frontContent[2]['description']}</p>
                    </div>
                    <div><p class="lead">Переход: <span id="{$frontContent[2]['id']}-goByLink"
                                                        class="text-muted">{$frontContent[2]['goByLink']}</span>
                        </p>
                    </div>
                </div>
                <div class="col-md-6 mb-3 green-line">
                    <p class="lead"><span id="{$frontContent[4]['id']}-title"
                                          class="text-muted">{$frontContent[4]['title']}</span>
                    </p>
                    <select name="social" id="{$frontContent[4]['id']}-display" class="form-control">
                        <optgroup label="ВКЛ/ВЫКЛ">
                            <option value='ON'>ON</option>
                            <option value='OFF'>OFF</option>
                        </optgroup>
                        <optgroup label="Карточка:">
                            <option selected
                                    value="{$frontContent[4]['display']}">{$frontContent[4]['display']}</option>
                        </optgroup>
                    </select>
                    <div class="mt-2"><p class="lead">Текст:</p>
                        <p id="{$frontContent[4]['id']}-text" class="mb-3">{$frontContent[4]['text']}</p>
                    </div>
                    <div><p class="lead">Описание:</p>
                        <p id="{$frontContent[4]['id']}-description"
                           class="mb-3">{$frontContent[4]['description']}</p>
                    </div>
                    <div><p class="lead">Переход: <span id="{$frontContent[4]['id']}-goByLink"
                                                        class="text-muted">{$frontContent[4]['goByLink']}</span>
                        </p>
                    </div>
                </div>
                <div class="col-md-6 mb-3 green-line">
                    <p class="lead"><span id="{$frontContent[3]['id']}-title"
                                          class="text-muted">{$frontContent[3]['title']}</span>
                    </p>
                    <select name="social" id="{$frontContent[3]['id']}-display" class="form-control">
                        <optgroup label="ВКЛ/ВЫКЛ">
                            <option value='ON'>ON</option>
                            <option value='OFF'>OFF</option>
                        </optgroup>
                        <optgroup label="Карточка:">
                            <option selected
                                    value="{$frontContent[3]['display']}">{$frontContent[3]['display']}</option>
                        </optgroup>
                    </select>
                    <div class="mt-2"><p class="lead">Текст:</p>
                        <p id="{$frontContent[3]['id']}-text" class="mb-3">{$frontContent[3]['text']}</p>
                    </div>
                    <div><p class="lead">Описание:</p>
                        <p id="{$frontContent[3]['id']}-description"
                           class="mb-3">{$frontContent[3]['description']}</p>
                    </div>
                    <div><p class="lead">Переход: <span id="{$frontContent[3]['id']}-goByLink"
                                                        class="text-muted">{$frontContent[3]['goByLink']}</span>
                        </p>
                    </div>
                </div>
                <div class="col-md-6 mb-3 orange-line">
                    <p class="lead"><span id="{$frontContent[5]['id']}-title"
                                          class="text-muted">{$frontContent[5]['title']}</span>
                    </p>
                    <select name="social" id="{$frontContent[5]['id']}-display" class="form-control">
                        <optgroup label="ВКЛ/ВЫКЛ">
                            <option value='ON'>ON</option>
                            <option value='OFF'>OFF</option>
                        </optgroup>
                        <optgroup label="Карточка:">
                            <option selected
                                    value="{$frontContent[5]['display']}">{$frontContent[5]['display']}</option>
                        </optgroup>
                    </select>

                    <div class="mt-2"><p class="lead">Текст:</p>
                        <p id="{$frontContent[5]['id']}-text" class="mb-3">{$frontContent[5]['text']}</p>
                    </div>
                    <div><p class="lead">Описание:</p>
                        <p id="{$frontContent[5]['id']}-description"
                           class="mb-3">{$frontContent[5]['description']}</p>
                    </div>
                    <div><p class="lead">Переход: <span id="{$frontContent[5]['id']}-goByLink"
                                                        class="text-muted">{$frontContent[5]['goByLink']}</span>
                        </p>
                    </div>
                </div>
            </div>
        </section>
        {*Показатели*}
        <section id="frontParam" class="border-bottom  mt-5">
            <div class="row ml-0">
                <h4 id="{$frontContent[6]['id']}-section">{$frontContent[6]['section']}</h4>
            </div>
            <div class="row">
                {foreach $frontContent as $frontParam}
                    {if $frontParam['description'] === 'param'}
                        <div class="col-lg-3 col-md-6 mt-3">
                            <select name="social" id="{$frontParam['id']}-display" class="form-control">
                                <optgroup label="ВКЛ/ВЫКЛ">
                                    <option value='ON'>ON</option>
                                    <option value='OFF'>OFF</option>
                                </optgroup>
                                <optgroup label="Параметр:">
                                    <option selected
                                            value="{$frontParam}">{$frontParam['display']}</option>
                                </optgroup>
                            </select>
                            <p class="lead"><span id="{$frontParam['id']}-title"
                                                  class="text-muted">{$frontParam['title']}</span>
                            </p>
                            <div class="mt-2">
                                <p id="{$frontParam['id']}-text" class="mb-3 lead">{$frontParam['text']}</p>
                            </div>
                        </div>
                    {/if}
                {/foreach}
            </div>
        </section>
        {*Карусэлъ*}
        <section id="frontParam" class="border-bottom  mt-5">
            <div class="row ml-0">
                <h4 id="{$frontContent[10]['id']}-section">{$frontContent[10]['section']}</h4>
                <p class="ml-2">
                    <select name="social" id="{$frontContent[10]['id']}-display" class="form-control">
                        <optgroup label="ВКЛ/ВЫКЛ">
                            <option value='ON'>ON</option>
                            <option value='OFF'>OFF</option>
                        </optgroup>
                        <optgroup label="Секция:">
                            <option selected
                                    value="{$frontContent[10]['display']}">{$frontContent[10]['display']}</option>
                        </optgroup>
                    </select>
                </p>
            </div>
            <div class="row mb-3">
                {foreach $frontContent as $frontCadr}
                    {if $frontCadr['section'] === 'card'}
                        <div class="col-md-3 mt-3">
                            <div class="card text-center">
                                <img src="/public/images/{$frontCadr['img']}" class="card-img-top"
                                     alt="{$frontCadr['title']} {$frontCadr['description']}">
                                <button type="button" id="{$frontCadr['id']}-btnImg" class="btn btn-secondary btn-sm"
                                        style="position: absolute;">Изменить
                                </button>
                                <div class="card-body">
                                    <h5>{$frontCadr['title']} <br/>
                                        <span>{$frontCadr['description']}</span></h5>
                                    <p class="card-text">{$frontCadr['text']} </p>
                                </div>
                            </div>
                        </div>
                    {/if}
                {/foreach}
            </div>
        </section>


        <div class="alert alert-light mt-5 text-info" role="alert">
            <strong>Примечание: </strong># скрыть ссылку c главной.
        </div>
    </div>
{/block}


{*
для js файла выколупуем id
console.log(id.replace(/[a-z-]/g, ''));
console.log(id.replace(/[0-9-]/g, ''));
*}