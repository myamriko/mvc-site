{assign var="namepage" value=$links[0][1]['title']}
{extends file="public/layout.tpl"}
{block name=title}{$namepage}-{$categoryPage}-{$sitedata['sitename']}{/block}
{block name=body}
    <!-- BLOG -->
    <section role="complementary" class="breadcrumb_section relative-position">
        <div class="background_overlay_blog"></div>
        {if $action == 'tag'}
            <div class="breadcrumb_watermark">#Тег</div>
        {else}
            <div class="breadcrumb_watermark">{$namepage}</div>
        {/if}
        <div class="container">
            <h1 class="breadcrumb_title">{$categoryPage}</h1>
            <div class="breadcrumb_item ul-li 	d-none d-md-block d-lg-block d-xl-block">
                <ul class="breadcrumb">
                    {include file="public/include/breadcrumb.tpl"}
                </ul>
            </div>
            <div class="breadcrumb_item ul-li d-block d-md-none">
                <ul class="breadcrumb breadcrumb-sm">
                    {include file="public/include/breadcrumb.tpl"}
                </ul>
            </div>
        </div>
    </section>
    <section class="blog_area contact_section section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <form action="" method="get">
                        <div class="contact-info">
                            <input id="searchMain" type="search" name="searchMain" class="form-control"
                                   placeholder="Введіть критерії пошуку" autocomplete="off"/>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input position-static" type="checkbox" id="searchText"
                                   name="searchText" value="text" aria-label="Шукати в тексті" checked="checked">
                            <label class="text-black-50" for="searchText">Шукати в тексті</label>
                        </div>

                        <div id="btnSearch" class="text-right blanco">
                            <div class="btn submit-button btn-search text-uppercase" style="background: #dddddd; cursor: wait;">
                                <input type="submit" id="sendSearchMain" class="" value="Пошук" style="color: #999999; cursor: wait;" disabled><i
                                        class="fa ico-angle-right" aria-hidden="true" style="color: #999999;"></i>
                            </div>
                        </div>
                    </form>
                    <main role="main" class="mt-5">
                        {$searchAlert}
                        {include file="public/include/search_post.tpl"}
                    </main>
                </div>
                {*Боковая панель*}
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        {include file="public/include/menu_last_article.tpl"}
                    </div>
                </div>
                {$pagination}
            </div>
        </div>
    </section>
    <script>
        $('#searchMain').on('keyup', function () {
            var text = $('#searchMain').val().trim().replace(/<[^>]+>/g, '');
            if (text.length >= 3){
                $('#btnSearch').html('<div class="btn submit-button btn-search text-uppercase">\n' +
                    '                                <input type="submit" id="sendSearchMain" class="" value="Пошук"><i\n' +
                    '                                        class="fa ico-angle-right" aria-hidden="true"></i>\n' +
                    '                            </div>')
            }else{
                $('#btnSearch').html('<div class="btn submit-button btn-search text-uppercase" style="background: #dddddd; cursor: wait;">\n' +
                    '                                <input type="submit" id="sendSearchMain" class="" value="Пошук" style="color: #999999; cursor: wait;" disabled><i\n' +
                    '                                        class="fa ico-angle-right" aria-hidden="true" style="color: #999999;"></i>\n' +
                    '                            </div>');
            }
        });
    </script>
{/block}