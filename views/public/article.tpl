{assign var="namepage" value=$links[0][1]['title']}
{extends file="public/layout.tpl"}
{block name=title}{$categoryPage}-{$sitedata['sitename']}{/block}
{block name=body}
    {assign var="tagsArt" value=","|explode:$article['tags']}
    <!-- BLOG -->
    <section role="complementary" class="breadcrumb_section relative-position">
        <div class="background_overlay_blog"></div>
        <div class="breadcrumb_watermark">{$namepage}</div>
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
    <section class="blog_area single-post-area section-padding">
        <div class="container">
            <div class="row">
                {*Боковая панель xm*}
                <div class="col-lg-4 d-block d-md-none">
                    <div class="blog_right_sidebar">
                        {include file="public/include/menu_search.tpl"}
                    </div>
                </div>
                <div class="col-lg-8 posts-list">
                    <main role="main">
                        <article role="article">
                            <div class="single-post">
                                <div class="blog_item_img">
                                    <a href="/public/pic/img-art/{$article['file']}"
                                       class="progressive replace card-img">
                                        <img src="/public/pic/img-art/{$article['file']}"
                                             class="preview card-img" alt="{$article['alt']}"/>
                                    </a>
                                    <div class="blog_details">
                                        <ul class="blog-info-link mt-3 mb-4 d-none d-md-block d-lg-block d-xl-block">
                                            <li><i class="ico ico-tags"></i>
                                                {foreach $tagsArt as $tags}
                                                    {foreach $tagsAll as $tages}
                                                        {if $tages['tag']|strip:'' == $tags|strip:''}
                                                            <a href="/blog/tag/{$tages['url']}"
                                                               rel="ugc nofollow">"{$tags|strip:''}"</a>
                                                        {/if}
                                                    {/foreach}
                                                {/foreach}
                                            </li>
                                            <li class="comment"><i class="ico ico-comments"></i>
                                                Коментарів: {$commentsCount}</li>
                                        </ul>
                                        <p>
                                            {$article['text']}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="comments-area">
                                <div id="add-comment" class="text-left btn btn-reply text-uppercase mb-5"><a id="add-comment-linc" onclick="addComment()">Додати
                                        коментар</a></div>
                                    {include file="public/include/comment_form.tpl"}
                                <div id="comment_container">
                                    {if !$comments}
                                        <p class="comment">Поки що немає жодного коментаря. Додайте коментар першим!</p>
                                    {/if}
                                    {foreach $comments as $comment}
                                        {$comment}
                                    {/foreach}
                                </div>
                            </div>

                        </article>
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
                {$pagination}
            </div>
        </div>
        <script src="/public/js/comments.js"></script>
    </section>
{/block}