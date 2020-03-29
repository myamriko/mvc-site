<div class="footer">
    <footer class="footer-inner">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h3 class="h3">About us</h3>
                    <ul class="footer-list">
                        <li><a href="#">Our story</a></li>
                        <li><a href="#">Venue</a></li>
                        <li><a href="#">Other</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h3 class="h3">Partners</h3>
                    <ul class="footer-list">
                        <li><a href="#">IKEA</a></li>
                        <li><a href="#">MIO</a></li>
                        <li><a href="#">BAUHAUS</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h3 class="h3">Customer support</h3>
                    <ul class="footer-list">
                        <li><a href="#">Chat with us</a></li>
                        <li><a href="#">+46(0)2453 352</a></li>
                        <li><a href="#">E-mail us</a></li>
                    </ul>
                </div>
                {if ({$sitedata['social']}==='ON')}
                <div class="col-md-3">
                    <h3 class="h3">Socials</h3>
                    <ul class="footer-list footer-list-inline">
                        {if ({$sitedata['facebook']})}
                            <li><a href="https://www.facebook.com/{$sitedata['facebook']}"><i
                                            class="fab fa-facebook-f"></i></a></li>
                        {/if}
                        {if ({$sitedata['instagram']})}
                        <li><a href="https://www.instagram.com/{$sitedata['instagram']}"><i
                                        class="fab fa-instagram"></i></a></li>
                        {/if}
                        {if ({$sitedata['twitter']})}
                        <li><a href="https://twitter.com/{$sitedata['twitter']}"><i class="fab fa-twitter"></i></a></li>
                        {/if}
                    </ul>
                </div>
                {/if}
            </div>
        </div>
    </footer>
</div>