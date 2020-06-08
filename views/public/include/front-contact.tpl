<section id="gtco-footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-6" id="contact">
                <h4> Contact Us </h4>
                <input type="text" class="form-control" placeholder="Full Name">
                <input type="email" class="form-control" placeholder="Email Address">
                <textarea class="form-control" placeholder="Message"></textarea>
                <a href="#" class="submit-button">READ MORE <i class="fa fa-angle-right" aria-hidden="true"></i></a>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div id="google-map" class="google-map">
                    </div>

                </div>

            </div>
        </div>
    </div>
    <script>
        var html = '{$sitedata['organization']}';{*адрес*}
        var x =  {$sitedata['x']};{*координаты*}
        var y = {$sitedata['y']};
    </script>

    <script src="/public/them-js/google-map-settings.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB6w8j2weabWNNnmQbh4Vsi2-sd7Sqv5zM&callback=initMap"
            async defer></script>
</section>