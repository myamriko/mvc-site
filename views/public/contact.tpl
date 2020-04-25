{extends file="public/layout.tpl"}
{block name=title}{$sitedata['sitename']}{/block}
{block name=body}
    <div class="site-inner">{*внутренний *}
        <section id="contact-page" class="">
            {*google-map*}
            <div class="google-map-container">
                <div id="google-map" class="google-map">
                    {* если используем Апи карта отображается по id google-map *}
                </div>
            </div>

            <div class="container">
                <div class="contactpage_details">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="contact_d_icontext text-center">
                                <div class="con_icon relative-position">
                                    <i class="flaticon-email-1"></i>
                                    {*<span>элемен будет отабражон поверх</span>*}
                                </div>
                                <div class="con_text headline">
                                    <h4>Email Address</h4>
                                    <span>info@webmail.com
								jobs.examplejob@com</span>
                                    <div class="con_bg">
                                        <i class="flaticon-email-1"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="contact_d_icontext text-center">
                                <div class="con_icon relative-position">
                                    <i class="flaticon-telephone-4"></i>
                                </div>
                                <div class="con_text headline">
                                    <h4>Phone Number</h4>
                                    <span>+897 676 5654 65
								+908(097) 564 765 76</span>
                                    <div class="con_bg">
                                        <i class="flaticon-telephone-4"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="contact_d_icontext text-center">
                                <div class="con_icon relative-position">
                                    <i class="flaticon-pie-chart-2"></i>
                                </div>
                                <div class="con_text headline">
                                    <h4>Office Address</h4>
                                    <span>12/A, Romania City Town Hall
								New Joursey, UK</span>
                                    <div class="con_bg">
                                        <i class="flaticon-pie-chart-2"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="estimate" class="estimate_contact_section">
            <div class="container">
                <div class="section_title_area text-center headline pera-content">
                    <h2 class="text-center head red">Contact us</h2>
                    <h3 >
                        We will help you
                    </h3>
                </div>
                <div class="estimate_form">
                    <div id="contact_form">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="contact-info">
                                    <input class="email" id="name" name="name" type="text" placeholder="Enter your full name">
                                    <div class="icon-bg">
                                        <i class="far fa-user"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="contact-info">
                                    <input class="name" id="mail" name="mail" type="email" placeholder="Enter your email">
                                    <div class="icon-bg">
                                        <i class="far fa-envelope"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="contact-info">
                                    <input class="email" id="phone" name="phone" type="text" placeholder="Enter your phone">
                                    <div class="icon-bg">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="contact-info">
                                    <input class="email" id="date" name="date" type="text" placeholder="Enter Date" value="{$smarty.now|date_format:"%Y-%m-%d %H:%M:%S"}">
                                    <div class="icon-bg">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="contact-info">
                                    <input class="email" id="subject" name="subject" type="text" placeholder="Enter Subject">
                                    <div class="icon-bg">
                                        <i class="fas fa-arrow-down"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="contact-info">
                                    <textarea id="message" name="message" placeholder="Enter your message"></textarea>
                                    <div class="icon-bg">
                                        <i class="far fa-edit"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="btn sub-button  text-uppercase">
                                <button type="button" onclick="">Submit Now</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
{/block}