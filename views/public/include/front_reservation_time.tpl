<section id="gtco-footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-6" id="contact">
                <h4>Призначтe зустріч</h4>
               <input id="nameTimeReservation" type="text" class="form-control" placeholder="Ім'я">
                <input id="phoneTimeReservation" type="tel" class="form-control" placeholder="Телефон, за бажанням">
                <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                <input id="datedye" type="text" placeholder="Оберіть день">
                <a id="sendTimeReservation" class="submit-button" onclick="timeReserv()">призначити<i class="fa ico-angle-right" aria-hidden="true"></i></a>
            </div>
            <div class="col-lg-6">
                <div class="google-map-container">
                    <div id="google-map" class="google-map">
                    </div>
                </div>
            </div>
            <p class="mt-lg-5 pt-lg-5 mb-4">Або зв'яжіться з нами за допомогою <a href="/contacts"><span class="text-success">контактної форми</span></a></p>
        </div>
    </div>
    <script>
        var html = '{$sitedata['organization']}';{*адрес*}
        var x =  {$sitedata['x']};{*координаты*}
        var y = {$sitedata['y']};
    </script>

    <script src="/public/them-js/google-map-settings.js" async defer></script>
    <script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB6w8j2weabWNNnmQbh4Vsi2-sd7Sqv5zM&callback=initMap"
            async defer></script>
    <script>
        var minDate = {$minDate};
        var disabledWeekDays = [{$disabledWeekDays}];
        var disabledDates = [{$disabledDates}];
        var allowTimes = [{$allowTimes}]
        var minTime = {$minTime};
        var maxTime = {$maxTime};
        var step = {$step};
    </script>
</section>