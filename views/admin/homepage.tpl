{extends file="admin/layout.tpl"}
{block name=title}Настройка Главной страницы{/block}
{block name=body}
<div class="container">
    <section id="homepageAbout" class="border-bottom mt-5" >
        <div class="text-center">
            <h2>{$front['title']}</h2>
        </div>
        <div class="row">
        <div class="col-md-6 mt-1 mb-1">
            <img class="mt-3 img-fluid" id="homepageImg" src="/public/images/{$front['img']}" style="width: 400px">
        </div>
        <div class="col-md-6 mt-1 mb-1">
            <blockquote class="blockquote mt-3">
                <p id="HomepageIntro" class="mb-0">{$front['intro']}</p>
            </blockquote>
        </div>
        </div>
    </section>
</div>
{/block}


