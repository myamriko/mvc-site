{extends file="admin/layout.tpl"}
{block name=title}Админ панель{/block}
{block name=body}
    <section oncontextmenu="return false;">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-5 mt-5"><h1>Основные настройки</h1>
                    <hr>
                </div>
                <div class="col-lg-6">
                    <div class="col-12">
                        <div class="form-group row">
                            <h4 class="mt-2">Иконка:</h4>
                            <div id="ico" class="col-lg-6 col-md-6 col-sm-6 col-11 edit">
                                <img src="/public/pic/res/{$sitedata['ico']}" style="width: 40px; height: auto">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="form-group row">
                            <h4 class="mt-2">Логотип:</h4>
                            <div id="logo" class="col-lg-6 col-md-6 col-sm-6 col-11 edit">
                                <img src="/public/pic/res/{$sitedata['logo']}" style="width: 40px; height: auto">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group row">
                            <h4>Имя сайта:</h4>
                            <div id="sitename" class="col-lg-6 col-md-6 col-sm-6 col-11 edit">
                                <span class="lead">{$sitedata['sitename']}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group row">
                            <h4>Девиз:</h4>
                            <div id="propaganda" class="col-lg-6 col-md-6 col-sm-6 col-11 edit">
                                <span class="lead">{$sitedata['propaganda']}</span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <hr>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="form-group row">
                            <h4>Кол-во статей на стр:</h4>
                            <div id="pagelimit" class="col-lg-6 col-md-6 col-sm-6 col-11 edit">
                                <span class="lead">{$sitedata['pagelimit']}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="form-group row">
                            <h4>Кеш в секундах:</h4>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-11">
                                <select name="cache" id="cechetime" class="form-control ">
                                    <optgroup label="Установите кеш:">
                                        <option value='3800'>1 ч</option>
                                        <option value='10800'>3 ч</option>
                                        <option value='21600'>6 ч</option>
                                        <option value='43200'>12 ч</option>
                                        <option value='86400'>1 д</option>
                                        <option value='172800'>2 д</option>
                                        <option value='259200'>3 д</option>
                                        <option value='345600'>4 д</option>
                                    </optgroup>
                                    <optgroup label="Установлено в сек:">
                                        <option selected
                                                value="{$sitedata['cechetime']}">{$sitedata['cechetime']}
                                        </option>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="alert alert-info mt-1" role="alert"><strong>Время жизни кеша по умолчанию 1
                                    день (86400 сек).</strong></div>
                        </div>
                    </div>
                    <div>
                        <hr>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="form-group row">
                            <h3>Социальные сети</h3>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-11">
                                <select name="social" id="social" class="form-control">
                                    <optgroup label="ВКЛ/ВЫКЛ">
                                        <option value='ON'>ON</option>
                                        <option value='OFF'>OFF</option>
                                    </optgroup>
                                    <optgroup label="Вкладка соцсети:">
                                        <option selected value="{$sitedata['social']}">{$sitedata['social']}</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="form-group row">
                            <h4>ID pixel FB:</h4>
                            <div id="fbpixel" class="col-lg-6 col-md-6 col-sm-6 col-11 edit">
                                <span class="lead">{$sitedata['fbpixel']}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group row">
                            <h4>Facebook:</h4>
                            <div id="facebook" class="col-lg-6 col-md-6 col-sm-6 col-11 edit">
                                <span class="lead">
                                    <i class="fab fa-facebook-f"></i> {$sitedata['facebook']}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="form-group row">
                            <h4>Instagram:</h4>
                            <div id="instagram" class="col-lg-6 col-md-6 col-sm-6 col-11 edit">
                                <span class="lead">
                                    <i class="fab fa-instagram"></i> {$sitedata['instagram']}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="form-group row">
                            <h4>Twitter:</h4>
                            <div id="twitter" class="col-lg-6 col-md-6 col-sm-6 col-11 edit">
                                <span class="lead">
                                    <i class="fab fa-twitter"></i> {$sitedata['twitter']}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <hr>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="form-group row">
                            <h3>Ботяра на телеге</h3>
                            <div class="col-12 mt-3">
                                <div class="form-group row">
                                    <h4>Токен:</h4>
                                    <div id="token" class="col-lg-6 col-md-6 col-sm-6 col-11 edit">
                                <span class="lead">
                                    {$sitedata['token']}
                                </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="form-group row">
                                    <h4>ID чата:</h4>
                                    <div id="id_chat" class="col-lg-6 col-md-6 col-sm-6 col-11 edit">
                                <span class="lead">
                                    {$sitedata['id_chat']}
                                </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="col-12">
                        <div class="form-group row">
                            <h4>Почта сайта:</h4>
                            <div id="sitemail" class="col-lg-6 col-md-6 col-sm-6 col-11 edit">
                                <span class="lead">{$sitedata['sitemail']}</span>
                            </div>
                        </div>
                    </div><div class="col-12">
                        <div class="form-group row">
                            <h4>Контактное лицо:</h4>
                            <div id="sender" class="col-lg-6 col-md-6 col-sm-6 col-11 edit">
                                <span class="lead">{$sitedata['sender']}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="form-group row">
                            <h4>Телефон 1:</h4>
                            <div id="tel1" class="col-lg-6 col-md-6 col-sm-6 col-11 edit">
                                <span class="lead">{$sitedata['tel1']}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="form-group row">
                            <h4>Телефон 2:</h4>
                            <div id="tel2" class="col-lg-6 col-md-6 col-sm-6 col-11 edit">
                                <span class="lead">{$sitedata['tel2']}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="form-group row">
                            <h4>Название организации:</h4>
                            <div id="organization" class="col-lg-6 col-md-6 col-sm-6 col-11 edit">
                                <span class="lead">{$sitedata['organization']}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="form-group row">
                            <h4>Адрес:</h4>
                            <div id="adress" class="col-lg-6 col-md-6 col-sm-6 col-11 edit">
                                <span class="lead">{$sitedata['adress']}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="form-group row">
                            <h4>Google map X:</h4>
                            <div id="x" class="col-lg-6 col-md-6 col-sm-6 col-11 edit">
                                <span class="lead">{$sitedata['x']}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="form-group row">
                            <h4>Google map Y:</h4>
                            <div id="y" class="col-lg-6 col-md-6 col-sm-6 col-11 edit">
                                <span class="lead">{$sitedata['y']}</span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <hr>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="form-group row">
                            <h4>Тех. почта:</h4>
                            <div id="adminmail" class="col-lg-6 col-md-6 col-sm-6 col-11 edit">
                                <span class="lead">{$sitedata['adminmail']}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="form-group row">
                            <h4>Пароль тех. почты:</h4>
                            <div id="pss_admin" class="col-lg-6 col-md-6 col-sm-6 col-11 edit">
                                <span class="lead">**********</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="form-group row">
                            <h4>SMTP Host:</h4>
                            <div id="smtp_host" class="col-lg-6 col-md-6 col-sm-6 col-11 edit">
                                <span class="lead">{$sitedata['smtp_host']}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="form-group row">
                            <h4>Mail port:</h4>
                            <div id="mail_port" class="col-lg-6 col-md-6 col-sm-6 col-11 edit">
                                <span class="lead">{$sitedata['mail_port']}</span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <hr>
                    </div>
                    <div class="col-12 mt-3">

                        <div class="form-group row">
                            <h3>reCAPTCHA v3</h3>
                        </div>
                        <div class="form-group row">
                            <h4>Ключ сайта:</h4>
                            <div id="sitekey" class="col-lg-6 col-md-6 col-sm-6 col-11 edit kay-captcha">
                                <span class="lead">{$sitedata['sitekey']}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="form-group row">
                            <h4>Секретный ключ:</h4>
                            <div id="sekretkey" class="col-lg-6 col-md-6 col-sm-6 col-11 edit kay-captcha">
                                <span class="lead">{$sitedata['sekretkey']}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="/public/js/info.js"></script>
{/block}


