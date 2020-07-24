{extends file="admin/layout.tpl"}
{block name=hint}{$hint}{/block}
{block name=title}Бронирование времени - Админ панель{/block}
{block name=body}
    <section
            oncontextmenu="return false;">{*oncontextmenu="return false;" отключает контекстное меню принажатии правой кнопки*}
        <div class="container-fluid  mb-lg-4">
            <div class="row">
                <div class="col-12 mb-3 mt-5"><h3>Встречи</h3>
                    <hr>
                </div>
                <div class="col-12 mt-3">
                    <div class="row">
                        <div class="col-3 mb-2"><a href="/timeres-adm/index/{$prevMount}/{$prevYear}"><i
                                        class="ico far fa-arrow-alt-circle-left"></i></a></div>
                        <div class="col-6 text-center mb-2">
                            <h3>{$mount} {$year}</h3>
                        </div>

                        <div class="col-3 text-right mb-2"><a href="/timeres-adm/index/{$nextMount}/{$nextYear}"><i
                                        class="ico far fa-arrow-alt-circle-right"></i></a></div>
                    </div>
                    {$calendar}
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12 mb-5">
                    <!--Accordion wrapper-->
                    <div class="accordion md-accordion accordion-blocks" id="accordionEx78" role="tablist"
                         aria-multiselectable="true">
                        <!-- Accordion card -->
                        <div class="card">

                            <!-- Card header -->
                            <div class="card-header" role="tab" id="heading">
                                <!--Options-->
                                <div class="dropdown float-left">
                                    <button class="btn btn-info btn-sm m-0 mr-3 p-2" type="button"
                                            data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false"><i class="fas fa-pencil-alt"></i>
                                    </button>

                                </div>
                                <!-- Heading -->
                                <a data-toggle="collapse" data-parent="#accordionEx78" href="#collapse81"
                                   aria-expanded="true"
                                   aria-controls="collapse81">
                                    <h5 class="mt-1 mb-0">
                                        <span>Настройки</span>
                                        <i class="fas fa-angle-down rotate-icon"></i>
                                    </h5>
                                </a>
                            </div>

                            <!-- Card body -->
                            <div id="collapse81" class="collapse" role="tabpanel" aria-labelledby="heading"
                                 data-parent="#accordionEx78">
                                <div class="card-body">
                                    <div class="col-12">
                                        <div class="form-group row">
                                            <label for="min-time" class=" mt-1 mr-1">Рабочий день: c </label>
                                            <input id="min-time" class="form-control"
                                                   type="text" value="{$timeSettings['min-time']}"
                                                   placeholder="ЧЧ:MM" style="width: 75px;">
                                            <label for="max-time" class="ml-1 mr-1 mt-1">до</label>
                                            <input id="max-time" class="form-control" type="text"
                                                   value="{$timeSettings['max-time']}" placeholder="ЧЧ:MM"
                                                   style="width: 75px;">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group row">
                                            <label for="lunch-start" class=" mt-1 mr-1">Перерыв: c </label>
                                            <input id="lunch-start" class="form-control"
                                                   type="text" value="{$timeSettings['lunch-start']}"
                                                   placeholder="ЧЧ:MM" style="width: 75px;">
                                            <label for="lunch-finish" class="ml-1 mr-1 mt-1">до</label>
                                            <input id="lunch-finish" class="form-control"
                                                   type="text" value="{$timeSettings['lunch-finish']}"
                                                   placeholder="ЧЧ:MM" style="width: 75px;">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group row">
                                            <label for="step" class=" mt-1 mr-1">Интервал: </label>
                                            <input id="step" class="form-control"
                                                   type="text" value="{$timeSettings['step']}" placeholder="ММ" style="width: 55px;">
                                            <span class="mt-1 ml-1">мин.</span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        {assign var=desabledWeekDays value=","|explode:$timeSettings['desabled-week-days']}{*строку в массив*}
                                        {assign var=week value=['Вс','Пн','Вт','Ср','Чт','Пт','Сб']} {*массив дней недели*}
                                        <label for="desabled-week-days" class="mr-2 ml-3">Выходные:</label>
                                        <div id="desabled-week-days" class="col-lg-8">
                                            {for $foo=0 to 6}
                                                <input id="week-{$foo}" type="checkbox" value="{$foo}"
                                                        {foreach $desabledWeekDays as $desabledWeekDay}
                                                    {if $desabledWeekDay == $foo} checked {/if}
                                                        {/foreach}>
                                                <label class="form-check-label mr-1" for="{$foo}">{$week[$foo]}</label>
                                            {/for}
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group row">
                                            <label for="disabled-dates">Праздничные и исключенны дни:</label>
                                            <textarea class="form-control" id="disabled-dates"
                                                       placeholder="в формате ДД.ММ.ГГГГ, ДД.ММ.ГГГГ">{$timeSettings['disabled-dates']}</textarea>
                                        </div>
                                    </div>

                                    <p>Исключенные из расписания часы:</p>

                                    <div class="row">
                                        <div class="col-lg-2"><label for="day-1">Понедельник:</label></div>
                                        <div class="col-lg-10 mb-2"><input id="day-1" class="form-control"
                                                                           type="text"
                                                                           value="{$timeSettings['day-1']}"
                                                                           placeholder="в формате ЧЧ:MM,ЧЧ:MM">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-2"><label for="day-2">Вторник:</label></div>
                                        <div class="col-lg-10 mb-2"><input id="day-2" class="form-control"
                                                                           type="text"
                                                                           value="{$timeSettings['day-2']}"
                                                                           placeholder="в формате ЧЧ:MM,ЧЧ:MM">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-2"><label for="day-3">Среда:</label></div>
                                        <div class="col-lg-10 mb-2"><input id="day-3" class="form-control"
                                                                           type="text"
                                                                           value="{$timeSettings['day-3']}"
                                                                           placeholder="в формате ЧЧ:MM,ЧЧ:MM">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-2"><label for="day-4">Четверг:</label></div>
                                        <div class="col-lg-10 mb-2"><input id="day-4" class="form-control"
                                                                           type="text"
                                                                           value="{$timeSettings['day-4']}"
                                                                           placeholder="в формате ЧЧ:MM,ЧЧ:MM">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-2"><label for="day-5">Пятница:</label></div>
                                        <div class="col-lg-10 mb-2"><input id="day-5" class="form-control"
                                                                           type="text"
                                                                           value="{$timeSettings['day-5']}"
                                                                           placeholder="в формате ЧЧ:MM,ЧЧ:MM">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-2"><label for="day-6">Суббота:</label></div>
                                        <div class="col-lg-10 mb-2"><input id="day-6" class="form-control"
                                                                           type="text"
                                                                           value="{$timeSettings['day-6']}"
                                                                           placeholder="в формате ЧЧ:MM,ЧЧ:MM">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-2"><label for="day-7">Воскресенье:</label></div>
                                        <div class="col-lg-10 mb-2"><input id="day-7" class="form-control"
                                                                           type="text"
                                                                           value="{$timeSettings['day-7']}"
                                                                           placeholder="в формате ЧЧ:MM,ЧЧ:MM">
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button class="btn btn-outline-primary mt-3 mb-1" onclick="editTimeSet()">
                                            Сохранить изменения
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- Accordion card -->
                    </div>
                    <!--/.Accordion wrapper-->
                </div>
            </div>
        </div>
    </section>
    <script src="/public/js/timeResSettings.js"></script>
{/block}