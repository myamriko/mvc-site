var map;
var coordinates = {lat: x, lng: y};
var popupContent;
var image;
var marker;
var infowindow;

function initMap() {
    /*координаты берем в гуглапс в меню что здесь?*/
    popupContent = '<p class="google-map-content">' + html + '</p>',
        image = 'public/images/map1.png';
    /*инициализация карты*/
    map = new google.maps.Map(document.getElementById('google-map'), {
        center: coordinates,
        zoom: 17,
        scrollwheel: false,
        disableDefaultUI: true
    });
    /*маркер*/
    marker = new google.maps.Marker({
        map: map,
        icon: image,
        position: coordinates
    });

    /*подпись маркера*/
    infowindow = new google.maps.InfoWindow({
        content: popupContent,
    });
    /*стиль карты*/
    infowindow.open(map, marker)
    $.getJSON("/public/json/map-style/map-style_blue.json", function(data) {
        map.setOptions({styles: data});
    });

}
