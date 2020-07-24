<section id="gtco-footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-6" id="contact">

                <h4>Зв'яжіться з нами</h4>
               <input id="nameContactFront" type="text" class="form-control" placeholder="Ім'я">
                <input id="mailContactFront" type="email" class="form-control" placeholder="Електронна адреса">
                <input id="phoneContactFront" type="tel" class="form-control" placeholder="Телефон">
                <textarea id="messageContactFront" class="form-control" placeholder="Повідомлення"></textarea>
                <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                <button id="sendFrontContactBtn" class="submit-button" onclick="sendFrontContact()">Надіслати <i class="fa ico-angle-right" aria-hidden="true"></i></button>

            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div id="google-map" class="google-map">
                    </div>

                </div>

            </div>
        </div>
    </div>
    <script src="/public/js/contactFormFront.js"></script>
    <script>
        var html = '{$sitedata['organization']}';{*адрес*}
        var x =  {$sitedata['x']};{*координаты*}
        var y = {$sitedata['y']};
    </script>

    <script src="/public/them-js/google-map-settings.js" async defer></script>
    <script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB6w8j2weabWNNnmQbh4Vsi2-sd7Sqv5zM&callback=initMap"
            async defer></script>
</section>