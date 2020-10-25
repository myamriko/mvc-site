<li class="breadcrumb-item"><a href="/">{$links[0][0]['title']}</a></li>
{if $url === 'blog' && !$action}
    <li class="breadcrumb-item active">Cтрічка новин</li>
{elseif $action == 'category'}
    <li class="breadcrumb-item active">{$categoryPage}</li>
{elseif $action == 'article' && $categoryArticle === 'Cтрічка новин'}
    <li class="breadcrumb-item active"><a href="/{$article['category']}">{$categoryArticle}</a>
    </li>
    <li class="breadcrumb-item active">{$categoryPage}</li>
{elseif $action == 'article' && $categoryArticle !== 'Cтрічка новин'}
    <li class="breadcrumb-item active"><a href="/blog/category/{$article['category']}">{$categoryArticle}</a>
    </li>
    <li class="breadcrumb-item active">{$categoryPage}</li>
{else}
    <li class="breadcrumb-item active">{$categoryPage}</li>
{/if}
