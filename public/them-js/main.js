//wow эффекты
var wow = new WOW(
    {
        boxClass:     'wow',      // класс, скрывающий элемент до момента отображения на экране (по умолчанию, wow)
        animateClass: 'animated', // класс для анимации элемента (по умолчанию, animated)
        offset:       100,          // расстояние в пикселях от нижнего края браузера до верхней границы элемента, необходимое для начала анимации (по умолчанию, 0)
        mobile:       false,       // включение/отключение WOW.js на мобильных устройствах (по умолчанию, включено)
        live:         true,       // поддержка асинхронно загруженных элементов (по умолчанию, включена)
        callback:     function(box) {
            // функция срабатывает каждый раз при старте анимации
            // аргумент box — элемент, для которого была запущена анимация
        },
        scrollContainer: null // селектор прокручивающегося контейнера (опционально, по умолчанию, window)
    }
);
wow.init();

(function () {

    'use strict';

    var carousels = function() {
        $(".owl-carousel1").owlCarousel(
            {
                loop:true,
                center: true,
                margin:0,
                startPosition: 1,
                responsiveClass:true,
                nav:false,
                responsive:{
                    0:{
                        items:1,
                        nav:false
                    },
                    600:{
                        items:1,
                        nav:false
                    },
                    1000:{
                        items:3,
                        nav:true,
                        loop:false
                    }
                }
            }
        );

        $(".owl-carousel2").owlCarousel(
            {
                loop:true,
                center: false,
                margin:0,
                responsiveClass:true,
                nav:true,
                responsive:{
                    0:{
                        items:1,
                        nav:false
                    },
                    600:{
                        items:2,
                        nav:false
                    },
                    1000:{
                        items:3,
                        nav:true,
                        loop:true
                    }
                }
            }
        );
    }


    // svg responsive in mobile mode
    var checkPosition = function() {
        if ($(window).width() < 767) {
            $("#bg-services").attr("viewBox", "0 0 1050 800");
            $("#bg-services-foto").attr("viewBox", "0 0 695 500");
            $("#bg-services-foto").attr("width", "109%");
        }else{
            $("#bg-services-foto").attr("width", "100%");
        }

    };

    (function($) {
        carousels();
        checkPosition();
    })(jQuery);


}());

// menu toggle button
function myFunction(x) {
    x.classList.toggle("change");
   // $('.navbar-collapse ').toggle("show");
}

// scroll
var scrollWindow = function() {
    $(window).scroll(function(){
        var $w = $(this),
            st = $w.scrollTop(),
            navbar = $('.ftco_navbar');
            sd = $('.js-scroll-wrap');

        if (st > 150) {
            if ( !navbar.hasClass('scrolled') ) {
                navbar.addClass('scrolled');
                $('.gtco-banner-area').addClass('pri-column-scrol');
            }
        }
        if (st < 150) {
            if ( navbar.hasClass('scrolled') ) {
                navbar.removeClass('scrolled sleep');
                $('.gtco-banner-area').removeClass('pri-column-scrol');
            }
        }
        if ( st > 350 ) {
            if ( !navbar.hasClass('awake') ) {
                navbar.addClass('awake');
            }

            if(sd.length > 0) {
                sd.addClass('sleep');
            }
        }
        if ( st < 350 ) {
            if ( navbar.hasClass('awake') ) {
                navbar.removeClass('awake');
                navbar.addClass('sleep');
            }
            if(sd.length > 0) {
                sd.removeClass('sleep');
            }
        }
    });
};
scrollWindow();

//прилоадер
$(window).on('load', function () {
    $preloader = $('.loaderArea'),
        $loader = $preloader.find('.loader');
    $loader.fadeOut();
    $preloader.delay(50).fadeOut('slow');
});

//размытие и анимация модаля
$('.modal-active').on('show.bs.modal', function () {
    $("#site").addClass("active-modal");
    $('.modal .modal-dialog').attr('class', 'modal-dialog  slideInDown animated');// модаль низ

});
$('.modal-active').on('hide.bs.modal', function () {
    $('.modal .modal-dialog').attr('class', 'modal-dialog  slideOutUp animated');// модаль верх
    $("#site").removeClass("active-modal");
});

