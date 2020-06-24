{extends file="public/layout.tpl"}
{block name=title}Відновлення паролю - {$sitedata['sitename']}{/block}
{block name=body}
    <div class="col-12 mt-5 pri-column">
        <div class="container  text-center">
            <div class="col-12"><h1 class="text-center">Відновлення паролю</h1></div>
            <div id="restoreHolder" class="mt-5 ml-md-2">
                <input id="restoreEmail" class="col-md-4 form-control" placeholder="Введіть адресу електронної пошти">
                <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                <button type="button" id="restoreBtn" class="submit-button"
                   onclick="restorePass()">Відновити <i class="fa ico-angle-right" aria-hidden="true"></i></button>
            </div>
        </div>
    </div>
    <script src="/public/js/restore.js"></script>
{/block}