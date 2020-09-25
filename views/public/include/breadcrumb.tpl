<li class="breadcrumb-item"><a href="/">{$links[0][0]['title']}</a></li>
{if $url === 'blog'}
    <li class="breadcrumb-item active">{$links[0][1]['title']}</li>
{elseif $action == 'category'}
    <li class="breadcrumb-item active"><a href="/{$links[0][1]['url']}">{$links[0][1]['title']}</a>
    </li>
    <li class="breadcrumb-item active">{$categoryPage}</li>
{elseif $action == 'article'}
    <li class="breadcrumb-item active"><a href="/{$article['category']}">{$categoryArticle}</a>
    </li>
    <li class="breadcrumb-item active">{$categoryPage}</li>

{else}
    <li class="breadcrumb-item active"><a href="/{$links[0][1]['url']}">{$links[0][1]['title']}</a>
    </li>
    <li class="breadcrumb-item active">{$categoryPage}</li>
{/if}
