{if $lastArticles}
<aside class="single_sidebar_widget post_category_widget" role="menu">
    <h4 class="widget_title">Останні надходження</h4>
    <ul class="list cat-list">
        {foreach $lastArticles as $lastArticle}
                <li  style="border-bottom: 0px !important; padding-bottom: 0px;">
                    <h5><a href="/blog/article/{$lastArticle['url']}" class="d-flex">{$lastArticle['title']|truncate:60:"...":true}</a></h5>
                </li>
        {/foreach}
    </ul>
</aside>
{/if}