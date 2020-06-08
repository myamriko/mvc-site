{extends file="admin/layout.tpl"}
{block name=title}Контакты - Админ панель{/block}
{block name=body}
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12 mb-5 mt-5"><h3>Не отправленная</h3>
                    <hr>
                </div>
                    {if (!$reports)}
                        <div class="blockquote">Поздравляю, ошибок нет!</div>
                    {/if}
                    {foreach $reports as $report}
                    <div id="{$report['id']}" class="col-sm-6">
                        <div class="card mb-2">
                            <div class="card-body">
                                <div id="holder-{$report['id']}" class="row">
                                    <div class="col-10"><h4 id="err-{$report['id']}" class="card-title mb-4">{$report['subject']}</h4></div>
                                 <span id="resend-{$report['id']}">
                                     {if $report['resend'] === 'NO'}
                                            <div class="col-2 text-warning"><i class="fas fa-exclamation-circle"></i></div>
                                         {else}
                                            <div class="col-2 text-success"><i class="fas fa-share-square"></i></div>
                                     {/if}
                                 </span>
                                </div>
                                <h5 class="card-subtitle mb-2 text-muted">ID: {$report['id']}</h5>
                                <h5 class="card-subtitle mb-2 text-muted">Ошибка: {$report['err']}</h5>
                                <h5 class="card-subtitle mb-2 text-muted">Дата: {$report['date']}</h5>
                                <h5 class="card-subtitle mb-2 text-muted">Отправитель: {$report['name']}</h5>
                                <h5 class="card-subtitle mb-2 text-muted">Е-mail: {$report['mailTo']}</h5>
                                <h5 class="card-subtitle mb-4 text-muted">Телефон: {$report['phone']}</h5>
                                <p class="card-text"> {$report['message']}</p>
                                <button class="btn btn-link text-info" onclick="reSend('{$report['id']}')">
                                    <i class="fas fa-reply"></i>Ответить
                                </button>
                                <button class="btn btn-link text-danger"
                                        onclick="removedStart('{$report['id']}','сообщение от {$report['name']}','contact')">
                                    <i class="far fa-trash-alt"></i> Удалить
                                </button>
                            </div>
                        </div>
                    </div>
                    {/foreach}
            </div>
        </div>
    </section>
    {include file="admin/modal/reply.tpl"}
    <script src="/libs/ckeditor5-classik-full/ckeditor.js"></script>
    <script src="/libs/ckfinder/ckfinder.js"></script>
    <script src="/public/js/ckeditorOptions.js"></script>
    <script src="/public/js/contacts.js"></script>
{/block}