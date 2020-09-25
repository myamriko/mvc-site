{extends file="public/layout.tpl"}
{block name=title}Контактні дані - {$sitedata['sitename']}{/block}
{block name=body}
    <address id="contact-page-gmap">
        {*google-map*}
        <div class="google-map-container">
            <div class="background_overlay"></div>
            <div id="google-map" class="google-map">
                {* если используем Апи карта отображается по id google-map *}
            </div>
        </div>
        <div class="container">
            <div class="contactpage_details">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="contact_d_icontext text-center" style="margin-left: 15px;">
                                <div class="con_icon relative-position">
                                    <i class="ico-email"></i>
                                    {*<span>элемен будет отабражон поверх</span>*}
                                </div>
                                <div class="con_text headline">
                                    <h4>Електронна адреса</h4>
                                    <span>{$sitedata['sitemail']}
                                        {$sitedata['adminmail']}</span>
                                    <div class="con_bg">
                                        <i class="ico-email"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="contact_d_icontext text-center">
                                <div class="con_icon relative-position">
                                    <i class="ico-telephone"></i>
                                </div>
                                <div class="con_text headline">
                                    <h4>Телефон</h4>
                                    <span>{if ({$sitedata['tel1'] !== 'off'})} {$sitedata['tel1']}<br>{/if}
                                        {if ({$sitedata['tel2']} !== 'off')} {$sitedata['tel2']} {/if}</span>
                                    <div class="con_bg">
                                        <i class="ico-telephone"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="contact_d_icontext text-center" style="margin-left: -20px;">
                                <div class="con_icon relative-position">
                                    <i class="ico-pie-chart"></i>
                                </div>
                                <div class="con_text headline">
                                    <h4>Адреса</h4>
                                    <span>{$sitedata['adress']}</span>
                                    <div class="con_bg">
                                        <i class="ico-pie-chart"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

            </div>
        </div>
    </address>
    <section  role="form"  id="contact-page-form" class="contact_section">
        <div class="container">
            <div class="text-center">
                <h1>Зв'яжіться з нами</h1>
                <h3>
                    і ми надамо необхідну допомогу
                </h3>
            </div>
            <div class="estimate_form">
                <div id="contact_form">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="contact-info">
                                <input id="name" name="name" type="text" placeholder="Ім'я">
                                <div class="icon-bg">
                                    <i class="far ico-user"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="contact-info">
                                <input id="mail" name="mail" type="email" placeholder="Електронна пошта">
                                <div class="icon-bg">
                                    <i class="far ico-envelope"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="contact-info">
                                <input id="phone" name="phone" type="tel" placeholder="Номер телефону">
                                <div class="icon-bg">
                                    <i class="fas ico-phone"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="contact-info">
                                <input id="date" name="date" type="text" placeholder="Дата"
                                       value="{$smarty.now|date_format:"%Y-%m-%d"}">
                                <div class="icon-bg">
                                    <i class="fas ico-calendar"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="contact-info">
                                <input id="subject" name="subject" type="text" placeholder="Тема повідомлення">
                                <div class="icon-bg">
                                    <i class="fas ico-arrow"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="contact-info">
                                <textarea id="text" class="textarea-height-min"
                                          placeholder="Текст повідомлення"></textarea>
                                <div class="icon-bg">
                                    <i class="far ico-edit"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                    <div id="btn" class="text-center">
                        <div class="btn sub-button  text-uppercase">
                            <a id="sendFrontContactBtn" class="submit-button mt-5" onclick="send()">Надіслати <i
                                        class="fa ico-angle-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="/public/js/contactPaginaContact.js"></script>
    <script>
        var html = '{$sitedata['organization']}';{*адрес*}
        var x =  {$sitedata['x']};{*координаты*}
        var y = {$sitedata['y']};
    </script>
    <script src="/public/them-js/google-map-settings.js" async defer></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB6w8j2weabWNNnmQbh4Vsi2-sd7Sqv5zM&callback=initMap"
            async defer></script>
    </section>
{/block}