var map;
var coordinates;
var popupContent;
var markerImage;
var image;
var marker;
var infowindow;
var html = 'Carrer de Sardenya, 321, 08025 Barcelona';
function initMap() {
    /*координаты берем в гуглапс в менд что здесь?*/
    coordinates = {lat: 41.4058, lng: 2.172355},
        popupContent = '<p class="google-map-content">'+html+'</p>',
        image = '/public/pic/res/map.png';
    /*инициализация карты*/
    map = new google.maps.Map(document.getElementById('google-map'), {
        center: coordinates,
        zoom: 17,
        scrollwheel: false,
        disableDefaultUI: true
    });
    /*добавили маркер*/

    marker = new google.maps.Marker({
        map: map,
        icon: image,
        position: coordinates
    });

    infowindow = new google.maps.InfoWindow({
        content: popupContent,

    });

    infowindow.open(map, marker)
    $.getJSON("/public/json/map-style/map-style_main.json", function(data) {
        map.setOptions({styles: data});
    });

}
