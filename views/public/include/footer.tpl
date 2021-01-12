<footer role="contentinfo" class="footer-footer">
    <div class="container-fluid">
        <div class="col-12">
            <p class="pt-4">
                <img data-src="/public/images/miamr.png" class="lazyload" alt="Мямр&Ko" style="width=32px; height=32px;"> &copy; {$smarty.now|date_format:"%Y"} Мямр&Ko</p>
        </div>
    </div>
    {literal}
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute({/literal}'{$sitedata['sitekey']}'{literal}, {action: 'homepage'})
                .then(function(token) {
                    //console.log(token);
                    document.getElementById('g-recaptcha-response').value=token;
                });
        });
    </script>
    {/literal}
</footer>