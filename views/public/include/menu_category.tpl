<aside class="single_sidebar_widget post_category_widget" role="menu">
    <h4 class="widget_title">Категорії</h4>
    <ul class="list cat-list">
        {foreach $categories as $category}
            {if $category['enabled'] == 'ON'}
                <li>
                    {if $category['url'] == 'blog'}
                    <a href="/{$category['url']}" class="d-flex">
                        {else}
                        <a href="/blog/category/{$category['url']}" class="d-flex">
                            {/if}
                            {$category['name']}
                        </a>
                </li>
            {/if}
        {/foreach}
    </ul>
</aside>