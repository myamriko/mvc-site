//задержка
$(document).ready(function(){
    let counter = 0;
    $(window).scroll(function() {
        var scroll = $(window).scrollTop();//прокрутка экрана
        var offset = $('#viewNumbers').offset().top - window.innerHeight;//позиция элемента - ширина экрана
        if (scroll > offset && counter == 0){
// счетчик
            $({blurRadius: 5}).animate({blurRadius: 0}, {
                duration: 2000,
                easing: 'swing',
                step: function() {
                    $(".lines").css({
                        "-webkit-filter": "blur("+this.blurRadius+"px)",
                        "filter": "blur("+this.blurRadius+"px)"
                    });
                }
            });
            var comma_separator_number_step = $.animateNumber.numberStepFactories.separator(' ');
            $(".lines").each(function() {
                var tcount = $(this).data("count");
                $(this).animateNumber({ number: tcount,
                        easing: 'easeInQuad',
                        numberStep: comma_separator_number_step},
                    2000);
            });

            counter = 1;
        }
    });

});





