jQuery(function($){
    $("#vieline").viewportChecker({
        callbackFunction:function(){

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
        }
    });
});