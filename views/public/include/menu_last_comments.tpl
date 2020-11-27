{if $lastComments}
    <aside class="single_sidebar_widget post_category_widget" role="menu">
        <h4 class="widget_title">Останні коментарі</h4>
        {foreach $lastComments as $lastComment}
        <ul class="list cat-list">
            <li style="border-bottom: 0px !important; padding-bottom: 0px;">
                <p>{$lastComment['username']}: <a href="/blog/article/{$lastComment['url']}"
                                                  class="d-flex"
                                                  style=" font-size: 17px !important;">{$lastComment['mess']|truncate:75:"...":true}</a>
                </p>
            </li>
            {/foreach}
        </ul>
    </aside>
{/if}