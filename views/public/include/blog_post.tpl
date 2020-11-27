<article role="article">
    <div class="blog_left_sidebar">
        <div class="blog_item">
            <div class="blog_item_img">
                {*Отложенная загрузка*}
                <a href="/public/pic/img-art/{$article['file']}" class="progressive replace card-img">
                    <img src="/public/pic/img-art/{$article['file']}" class="preview card-img" alt="{$article['alt']}"/>
                </a>
                <span class="blog_item_date">
                                            <h3>{$article['date']|date_format:"%d"}</h3>
                                    <p>{$article['date']|date_format:"%b"}</p>
                                </span>
            </div>
            <div class="blog_details">
                <a class="d-inline-block" href="/blog/article/{$article['url']}">
                    <h2>{$article['title']}</h2>
                </a>
                <p>{$article['intro']|truncate:160:"...":true}</p>
                <div class="col-12" style="min-height: 20px">
                    <span class=" news_more float-right">
                        <a href="/blog/article/{$article['url']}">Детальніше</a>
                    </span>
                    <div class="row">
                    {foreach $tagsArt as $tag}
                        {foreach $tagsAll as $tage}
                            {if $tage['tag']|strip:'' == $tag|strip:''}
                                <span class="post_cat d-none d-md-block d-lg-block d-xl-block mr-1"><a
                                            href="/blog/tag/{$tage['url']}" rel="ugc nofollow">{$tag}</a></span>
                            {/if}
                        {/foreach}
                    {/foreach}
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>