//nav-bar
(function () {
    var expand;
    expand = function () {
        var $input, $search;
        $search = $('.search');
        $input = $('.input');
        if ($search.hasClass('close')) {
            $search.removeClass('close');
            $input.removeClass('square');
        } else {
            $search.addClass('close');
            $input.addClass('square');
        }
        if ($search.hasClass('close')) {
            $input.focus();
        } else {
            $input.blur();
        }
    };
    $(function () {
        var $accordion, $wideScreen;
        $accordion = $('#accordion').children('li');
        $wideScreen = $(window).width() > 767;
        if ($wideScreen) {
            $accordion.on('mouseenter click', function (e) {
                var $this;
                e.stopPropagation();
                $this = $(this);
                if ($this.hasClass('out')) {
                    $this.addClass('out');
                } else {
                    $this.addClass('out');
                    $this.siblings().removeClass('out');
                }
            });
        } else {
            $accordion.on('touchstart touchend', function (e) {
                var $this;
                e.stopPropagation();
                $this = $(this);
                if ($this.hasClass('out')) {
                    $this.addClass('out');
                } else {
                    $this.addClass('out');
                    $this.siblings().removeClass('out');
                }
            });
        }
    });
    $(function () {
        var $container, $menu, $menubtn, $navbar;
        $menubtn = $('#hb');
        $navbar = $('.navbar');
        $menu = $('.navigation');
        $container = $('.site-inner');
        $menubtn.on('click', function (e) {
            if ($menubtn.hasClass('active')) {
                $menubtn.removeClass('active');
                $menu.removeClass('slide-right');
                $container.removeClass('slide-right');
                $navbar.removeClass('slide-right');
            } else {
                $menubtn.addClass('active');
                $menu.addClass('slide-right');
                $container.addClass('slide-right');
                $navbar.addClass('slide-right');
            }
        });
    });
    $(function () {
        var $button, clickOrTouch;
        clickOrTouch = 'click touchstart';
        $button = $('#search-button');
        $button.on(clickOrTouch, expand);
    });
    $(function () {
        var $box;
        $box = $('.sm-box');
        $box.on('click', function (e) {
            e.preventDefault();
            var $this;
            $this = $(this);
            if ($this.hasClass('active')) {
                $this.removeClass('active');
            } else {
                $this.addClass('active');
            }
        });
    });
}.call(this));

$("select").each(function () {
    var $this = $(this),
        $options = $(this).children("option").length;

    $this.addClass("select-hidden");
    $this.wrap("<div class='select'></div>");
    $this.after("<div class='select-styled'></div>");

    var $styledSelect = $this.next("div.select-styled");
    $styledSelect.text($this.children("option").eq(0).text());

    var $list = $("<ul />", {
        "class": "select-options"
    }).insertAfter($styledSelect);

    for (var i = 0; i < $options; i++) {
        $("<li />", {
            text: $this.children("option").eq(i).text(),
            rel: $this.children("option").eq(i).val()
        }).appendTo($list);
    }

    var $listItems = $list.children("li");

    $styledSelect.on("click", function (e) {
        e.stopPropagation();
        $("div.select-styled.active").each(function () {
            $(this).removeClass("active").next("ul.select-options").hide();
        });

        $(this).toggleClass("active").next("ul.select-options").toggle();
    });

    $listItems.on("click", function (e) {
        e.stopPropagation();
        $styledSelect.text($(this).text()).removeClass("active");
        $this.val($(this).attr("rel"));
        $list.hide();
    });

    $(document).on("click", function () {
        $styledSelect.removeClass("active");
        $list.hide();
    });

    $(".select-sibling").next(".select-styled").css({
        "border-top": "0px"
    });
});

(function () {
    var $addItem = $("#add-item");
    var $badge = $(".badge");
    var $count = 1;

    $addItem.on("click", function (e) {
        e.preventDefault();
        $badge.html($count++);
    });
}.call(this));

//preloader


var config = {};
config.window = $(window);
config.wWidth = config.window.width();
config.wHeight = config.window.height();

config.t = 1;
config.t2 = 3;
config.e = Power2.easeOut;
config.e2 = Power2.easeIn;

config.pageTrans = new TimelineMax({repeat: -1, repeatDelay: 0, yoyo: true});

config.pageTrans
    .fromTo('.white', config.t, {x: config.wWidth / 2}, {x: 0, ease: config.e}, "f")
    .fromTo('.grey', config.t, {x: -config.wWidth / 2}, {x: 0, ease: config.e}, "f")
    .fromTo('.black', config.t, {y: -config.wHeight}, {y: 0, ease: config.e}, "f")
    .fromTo('.gold', config.t, {y: config.wHeight}, {y: 0, ease: config.e}, "f")
    .fromTo('.grey', config.t2, {y: 0}, {y: -config.wHeight / 2, ease: config.e2}, "f+=.8")
    .fromTo('.white', config.t2, {y: 0}, {y: config.wHeight / 2, ease: config.e2}, "f+=.8")
    .fromTo('#pagetransition', 2.5, {rotation: 0}, {rotation: 10, ease: config.e}, "f")
    .fromTo('.vic-gb', .8, {rotation: 0, scale: 0}, {rotation: -10, scale: 1, ease: Back.easeOut}, "f+=.6")


$(window).on('load', function () {

    $preloader = $('.loaderArea'),
        $loader = $preloader.find('.loader');
    $loader.fadeOut();
    $preloader.delay(450).fadeOut('slow');
    setTimeout(function () {
        $('#bg').fadeOut().attr('class', '');

    }, 500);

    setTimeout(function () {
        $('#bg').fadeOut().attr('class', '');
        $('#preloader').fadeOut().html(' ');
    }, 3000);


});

//wow эффекты
var wow = new WOW(
    {
        boxClass: 'wow',      // класс, скрывающий элемент до момента отображения на экране (по умолчанию, wow)
        animateClass: 'animated', // класс для анимации элемента (по умолчанию, animated)
        offset: 100,          // расстояние в пикселях от нижнего края браузера до верхней границы элемента, необходимое для начала анимации (по умолчанию, 0)
        mobile: true,       // включение/отключение WOW.js на мобильных устройствах (по умолчанию, включено)
        live: true,       // поддержка асинхронно загруженных элементов (по умолчанию, включена)
        callback: function (box) {
            // функция срабатывает каждый раз при старте анимации
            // аргумент box — элемент, для которого была запущена анимация
        },
        scrollContainer: null // селектор прокручивающегося контейнера (опционально, по умолчанию, window)
    }
);
wow.init();

$('.modal-active').on('shown.bs.modal', function () {
    $("#site").toggleClass("active-modal");
})
$('.modal-active').on('hidden.bs.modal', function () {
    $("#site").toggleClass("active-modal");
})
