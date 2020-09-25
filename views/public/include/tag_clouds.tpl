<aside class="single_sidebar_widget tag_cloud_widget  d-none d-md-block d-lg-block d-xl-block" role="menu" >
    <h4 class="widget_title">Хмарка тегів</h4>
    <ul class="list">
        {foreach $tagsAll as $tag}
        <li>
            <a href="/blog/tag/{$tag['url']}" rel="ugc nofollow">{$tag['tag']}</a>
        </li>
        {/foreach}
    </ul>
</aside>