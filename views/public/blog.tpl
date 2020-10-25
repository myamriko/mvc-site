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
            <input id="breadcrumb_hidden" type="hidden" value="{$categoryPage}">
            <h1 id="breadcrumb_title" class="breadcrumb_title">{$categoryPage}</h1>
            <div id="breadcrumb-xl" class="breadcrumb_item ul-li 	d-none d-md-block d-lg-block d-xl-block" >
                <ul class="breadcrumb">
                    {include file="public/include/breadcrumb.tpl"}
                </ul>
            </div>
            <div id="breadcrumb-xs" class="breadcrumb_item ul-li d-block d-md-none">
                <ul class="breadcrumb breadcrumb-sm">
                    {include file="public/include/breadcrumb.tpl"}
                </ul>
            </div>
        </div>
    </section>
    <section class="blog_area section-padding">
        <div class="container">
            <div class="row">
                {*Боковая панель xm*}
                <div class="col-lg-4 d-block d-md-none">
                    <div class="blog_right_sidebar">
                        {include file="public/include/menu_search.tpl"}
                    </div>
                </div>
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div id="main-search" style="display: none;"></div>
                    <main id="main" role="main">
                        {foreach $articlesAll as $article}
                            {assign var="tagsArt" value=","|explode:$article['tags']}
                            {include file="public/include/blog_post.tpl"}
                        {/foreach}
                    </main>
                </div>
                {*Боковая панель*}
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <div class="d-none d-md-block d-lg-block d-xl-block">
                            {include file="public/include/menu_search_right.tpl"}
                        </div>
                        {include file="public/include/menu_category.tpl"}
                        {include file="public/include/tag_clouds.tpl"}
                    </div>
                </div>
                <div id="pagination">
                    {$pagination}
                </div>
            </div>
        </div>
    </section>
{/block}