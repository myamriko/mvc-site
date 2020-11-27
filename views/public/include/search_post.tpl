{if $article}
    {foreach $article as $field}
        <article role="article">
            <div class="blog_left_sidebar mt-3">
                <div class="blog_item">
                    <div class="row">
                        <div class="col-md-12 mb-1">
                            <a class="d-inline-block" href="/blog/article/{$field['url']}">
                                <h2>{$field['title']}</h2>
                            </a>
                        </div>
                            <div>
                                <p>{$field['intro']}</p>
                                <div class="col-12" style="min-height: 20px">
                    <span class=" news_more float-right">
                        <a target="_blank" href="/blog/article/{$field['url']}">Детальніше</a>
                    </span>
                                </div>
                            </div>

                    </div>
                </div>
            </div>
        </article>
    {/foreach}
{/if}