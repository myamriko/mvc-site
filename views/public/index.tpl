{extends file="public/layout.tpl"}
{block name=title}{$sitedata['sitename']}{/block}
{block name=body}
    <main role="main">
        <div class="gtco-banner-area  pri-column">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        {assign var = 'name' value=' '|explode:$siteData['sender']}
                        <h1 class="wow fadeInLeft font-weight-bolder">{$name[0]}</h1>
                        <h3 class="wow fadeInLeft font-weight-bolder" data-wow-delay='0.5s'>{$name[1]} {$name[2]}</h3>
                        <p class="wow fadeInLeft" data-wow-delay='1s'>{$siteData['propaganda']}</p>
                        <p class="wow fadeInLeft" data-wow-delay='1.5s'>
                            <a href="tel:0956112060">{$siteData['tel1']}</a>
                            <br>
                            <a href="tel:0963165710">{$siteData['tel2']}</a>
                            <br>
                            <a href="/contacts">{$siteData['sitemail']}</a>
                        </p>
                        <ul class="nav follow-us-nav">
                            <li class="nav-item"><a rel="nofollow" class="nav-link pl-0"
                                                    href="https://www.facebook.com/{$siteData['facebook']}"
                                                    target="_blank"><i class="ico ico-facebook"></i></a>
                            </li>
                        </ul>
                    </div>
                    <!---->
                    <div id="gtco-main" class="col-md-6 d-none d-md-block d-lg-block">
                        <div class="card ">
                            <img data-src="/public/images/banner-img.png" class="lazyload card-img-top img-fluid"
                                 alt="Послуги адвоката Київ">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {*Про Мну*}
        {if $frontContent[0]['display'] === 'ON'}
            <section class="gtco-feature" id="about">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-lg-7">
                            <div class="cover">
                                <div class="card">
                                    <svg class="back-bg"
                                         width="100%"
                                         viewBox="0 0 900 700"
                                         style="position:absolute; z-index: -1">
                                        <defs>
                                            <linearGradient id="PSgrad_01" x1="64.279%" x2="0%" y1="76.604%" y2="0%">
                                                <stop offset="0%" stop-color="rgb(1,230,248)" stop-opacity="1"/>
                                                <stop offset="100%" stop-color="rgb(29,62,222)" stop-opacity="1"/>
                                            </linearGradient>
                                        </defs>
                                        <path fill-rule="evenodd" opacity="0.102" fill="url(#PSgrad_01)"
                                              d="M616.656,2.494 L89.351,98.948 C19.867,111.658 -16.508,176.639 7.408,240.130 L122.755,546.348 C141.761,596.806 203.597,623.407 259.843,609.597 L697.535,502.126 C748.221,489.680 783.967,441.432 777.751,392.742 L739.837,95.775 C732.096,35.145 677.715,-8.675 616.656,2.494 Z"/>
                                    </svg>
                                    <!-- *************-->

                                    <svg id="bg-services-foto" width="100%"
                                         viewBox="0 0 700 500">
                                        <clipPath id="clip-path">
                                            <path d="M89.479,0.180 L512.635,25.932 C568.395,29.326 603.115,76.927 590.357,129.078 L528.827,380.603 C518.688,422.048 472.661,448.814 427.190,443.300 L73.350,400.391 C32.374,395.422 -0.267,360.907 -0.002,322.064 L1.609,85.154 C1.938,36.786 40.481,-2.801 89.479,0.180 Z"></path>
                                        </clipPath>
                                        <!-- xlink:href for modern browsers, src for IE8- -->
                                        <image clip-path="url(#clip-path)"
                                               xlink:href="/public/images/{$frontContent[0]['img']}"
                                               width="100%"
                                               height="465" class="svg__image"></image>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-5 wow fadeIn">
                            <blockquote class="blockquote mt-3">
                                <p class="mb-0">{$frontContent[0]['text']}</p>
                                <footer class="blockquote-footer">З повагою до Вас,
                                    <p class="text-right">
                                        <cite title="Source Title">{$siteData[0]['sender']}</cite>
                                    </p>
                                </footer>
                            </blockquote>
                            {if $frontContent[5]['goByLink'] !== '#'}
                                <a href="{$frontContent[0]['goByLink']}">ЧИТАТИ ДАЛІ <i class="fa ico-angle-right"
                                                                                        aria-hidden="true"></i></a>
                            {/if}
                        </div>
                    </div>
                </div>
            </section>
        {/if}
        {*Услуги*}
        {if $frontContent[1]['display'] === 'ON'}
            <section class="gtco-features" id="services">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-12">
                            <div class="wow fadeIn" data-wow-delay='0.5s'>
                                <h2 class="text-center">{$frontContent[1]['title']}</h2>
                                <p class="text-justify">{$frontContent[1]['text']}</p>
                                {if $frontContent[5]['goByLink'] !== '#'}
                                    <a href="{$frontContent[1]['goByLink']}">всі послуги <i class="fa ico-angle-right"
                                                                                            aria-hidden="true"></i></a>
                                {/if}
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <svg id="bg-services"
                                 width="100%"
                                 viewBox="0 0 1000 800">
                                <defs>
                                    <linearGradient id="PSgrad_02" x1="64.279%" x2="0%" y1="76.604%" y2="0%">
                                        <stop offset="0%" stop-color="rgb(1,230,248)" stop-opacity="1"/>
                                        <stop offset="100%" stop-color="rgb(29,62,222)" stop-opacity="1"/>
                                    </linearGradient>
                                </defs>
                                <path fill-rule="evenodd" opacity="0.102" fill="url(#PSgrad_02)"
                                      d="M801.878,3.146 L116.381,128.537 C26.052,145.060 -21.235,229.535 9.856,312.073 L159.806,710.157 C184.515,775.753 264.901,810.334 338.020,792.380 L907.021,652.668 C972.912,636.489 1019.383,573.766 1011.301,510.470 L962.013,124.412 C951.950,45.594 881.254,-11.373 801.878,3.146 Z"/>
                            </svg>
                            <div class="row">
                                <div class="col">
                                    {if $frontContent[2]['display'] === 'ON'}
                                        <div class="card card-service text-center wow fadeInLeftBig">
                                            <div class="front">
                                                <div class="card-body">
                                                    <div class="oval">
                                                        <div class="circle"><i class="ico ico-courthouse"></i></div>
                                                    </div>
                                                    <h3 class="card-title">{$frontContent[2]['title']}</h3>
                                                    <p class="card-text">{$frontContent[2]['text']}</p>
                                                </div>
                                            </div>
                                            <div class="back">
                                                <p class="card-text ml-1 mr-1">{$frontContent[2]['description']}
                                                    {if $frontContent[2]['goByLink'] !== '#'}
                                                        <span class="news_more"><a
                                                                    href="{$frontContent[2]['goByLink']}">Детальніше</a></span>
                                                    {/if}
                                                </p>
                                            </div>
                                        </div>
                                    {/if}
                                    {if $frontContent[4]['display'] === 'ON'}
                                        <div class="card card-service text-center wow fadeInLeftBig">
                                            <div class="front">
                                                <div class="card-body">
                                                    <div class="oval">
                                                        <div class="circle"><i class="ico ico-auction"></i></div>
                                                    </div>
                                                    <h3 class="card-title">{$frontContent[4]['title']}</h3>
                                                    <p class="card-text">{$frontContent[4]['text']}</p>
                                                </div>
                                            </div>
                                            <div class="back"><p
                                                        class="card-text ml-1 mr-1">{$frontContent[4]['description']}
                                                    {if $frontContent[4]['goByLink'] !== '#'}
                                                        <span class="news_more"><a
                                                                    href="{$frontContent[4]['goByLink']}">Детальніше</a></span>
                                                    {/if}
                                                </p>
                                            </div>
                                        </div>
                                    {/if}
                                </div>
                                <div class="col">
                                    {if $frontContent[3]['display'] === 'ON'}
                                        <div class="card card-service text-center wow fadeInRightBig">
                                            <div class="front">
                                                <div class="card-body">
                                                    <div class="oval">
                                                        <div class="circle"><i class="ico ico-libra"></i></div>
                                                    </div>
                                                    <h3 class="card-title">{$frontContent[3]['title']}</h3>
                                                    <p class="card-text">{$frontContent[3]['text']}</p>
                                                </div>
                                            </div>
                                            <div class="back"><p
                                                        class="card-text ml-1 mr-1">{$frontContent[3]['description']}
                                                    {if $frontContent[3]['goByLink'] !== '#'}
                                                        <span class="news_more"><a
                                                                    href="{$frontContent[3]['goByLink']}">Детальніше</a></span>
                                                    {/if}
                                                </p>
                                            </div>
                                        </div>
                                    {/if}
                                    {if $frontContent[5]['display'] === 'ON'}
                                        <div class="card card-service text-center wow fadeInRightBig">
                                            <div class="front">
                                                <div class="card-body">
                                                    <div class="oval">
                                                        <div class="circle"><i class="ico ico-handcuffs"></i></div>
                                                    </div>
                                                    <h3 class="card-title">{$frontContent[5]['title']}</h3>
                                                    <p class="card-text">{$frontContent[5]['text']}</p>
                                                </div>
                                            </div>
                                            <div class="back"><p
                                                        class="card-text ml-1 mr-1">{$frontContent[5]['description']}
                                                    {if $frontContent[5]['goByLink'] !== '#'}
                                                        <span class="news_more"><a
                                                                    href="{$frontContent[5]['goByLink']}">Детальніше</a></span>
                                                    {/if}
                                                </p>
                                            </div>
                                        </div>
                                    {/if}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        {/if}
        {*праметры*}
        {if $frontContent[6]['display'] === 'ON' || $frontContent[7]['display'] === 'ON'|| $frontContent[8]['display'] === 'ON' || $frontContent[9]['display'] === 'ON'}
            <section class="gtco-numbers-block d-none d-md-block d-lg-block" id="viewNumbers">
                <div class="container">
                    <svg width="100%" viewBox="0 0 1600 400">
                        <defs>
                            <linearGradient id="PSgrad_03" x1="80.279%" x2="0%" y2="0%">
                                <stop offset="0%" stop-color="rgb(1,230,248)" stop-opacity="1"/>
                                <stop offset="100%" stop-color="rgb(29,62,222)" stop-opacity="1"/>

                            </linearGradient>

                        </defs>
                        <!-- <clipPath id="clip-path3">

                                                  </clipPath> -->

                        <path fill-rule="evenodd" fill="url(#PSgrad_03)"
                              d="M98.891,386.002 L1527.942,380.805 C1581.806,380.610 1599.093,335.367 1570.005,284.353 L1480.254,126.948 C1458.704,89.153 1408.314,59.820 1366.025,57.550 L298.504,0.261 C238.784,-2.944 166.619,25.419 138.312,70.265 L16.944,262.546 C-24.214,327.750 12.103,386.317 98.891,386.002 Z"></path>

                        <clipPath id="ctm" fill="none">
                            <path
                                    d="M98.891,386.002 L1527.942,380.805 C1581.806,380.610 1599.093,335.367 1570.005,284.353 L1480.254,126.948 C1458.704,89.153 1408.314,59.820 1366.025,57.550 L298.504,0.261 C238.784,-2.944 166.619,25.419 138.312,70.265 L16.944,262.546 C-24.214,327.750 12.103,386.317 98.891,386.002 Z"></path>
                        </clipPath>

                        <!-- xlink:href for modern browsers, src for IE8- -->
                        <image clip-path="url(#ctm)" xlink:href="/public/images/word-map.png" height="800px"
                               width="100%"
                               class="svg__image">
                        </image>
                    </svg>

                    <div class="row d-flex justify-content-center">
                        {foreach $frontContent as $frontParam}
                            {if $frontParam['display'] === 'ON'}
                                {if $frontParam['description'] === 'param'}
                                    <div class="col-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title lines text-center"
                                                    data-count="{$frontParam['text']}"></h5>
                                                <p class="card-text text-center">{$frontParam['title']}</p>
                                            </div>
                                        </div>
                                    </div>
                                {/if}
                            {/if}
                        {/foreach}
                    </div>
                </div>
            </section>
        {/if}
        {if $frontContent[10]['display'] === 'ON'}
            <section class="gtco-testimonials wow fadeIn" data-wow-offset='200'>
                <div class="container">
                    <h2>What our customers say about us.</h2>
                    <div class="owl-carousel owl-carousel1 owl-theme">
                        {foreach $frontContent as $frontCadr}
                            {if $frontCadr['section'] === 'card'}
                                <div class="card text-center">
                                    <img data-src="/public/images/{$frontCadr['img']}" class="lazyload card-img-top"
                                         alt="{$frontCadr['title']} {$frontCadr['description']}">
                                    <div class="card-body">
                                        <h5>{$frontCadr['title']}<br/>
                                            <span>{$frontCadr['description']}</span></h5>
                                        <p class="card-text">“ {$frontCadr['text']} ” </p>
                                    </div>
                                </div>
                            {/if}
                        {/foreach}
                    </div>
                </div>
            </section>
        {/if}
        <section class="gtco-features-list">
            <div class="container">
                <div class="row">
                    {foreach $frontContent as $frontOrder}
                        {if $frontOrder['section'] === 'order'}
                            {if $frontOrder['display'] === 'ON'}
                                <div class="media col-md-6 col-lg-4 wow fadeIn">
                                    <div class="oval mr-4"><img class="align-self-start"
                                                                src="/public/images/{$frontOrder['img']}"
                                                                alt="{$frontOrder['title']}"></div>
                                    <div class="media-body">
                                        <h5 class="mb-0">{$frontOrder['title']}</h5>
                                        {$frontOrder['text']}
                                    </div>
                                </div>
                            {/if}
                        {/if}
                    {/foreach}
                </div>
            </div>
        </section>
        <section class="gtco-news wow fadeIn" id="news" data-wow-delay='0.3s'>
            <div class="container">
                <h2>Останні Новини та Статті</h2>
                <div class="owl-news row">

                    {foreach $lastArticles as $lastArticle}
                        <div class="col-md-12 col-lg-4">
                            <div class="card text-center">
                                <img data-src="/public/pic/img-art/{$lastArticle['file']}" class="lazyload card-img-top"
                                     alt="{$lastArticle['title']}">
                                <div class="card-body text-left pr-0 pl-0">
                                    <h5>{$lastArticle['title']|truncate:60:"...":true}</h5>
                                    <p class="card-text">{$lastArticle['intro']|truncate:160:"...":true}</p>
                                    <a href="/blog/article/{$lastArticle['url']}">ЧИТАТИ ДАЛІ <i
                                                class="fa ico-angle-right" aria-hidden="true"></i></a></div>
                            </div>
                        </div>
                    {/foreach}

                </div>
            </div>
        </section>
    </main>
    {*Contact*}
    {include file="public/include/front_reservation_time.tpl"}
    <script src="/public/them-js/lazysizes.min.js" async></script>
{/block}