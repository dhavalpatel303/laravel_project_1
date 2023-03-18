/** 
 * ProgressBar : Simple animated progress bar
 * Version : 1.0.0
 */
 (function($){

    $.fn.ProgressBar = function(){
        var targetParent = $(this); 
        targetParent.each(function(){

            //required variables
            var target = $(this).children();
            var offsetTop = $(this).offset().top;
            var winHeight = $(window).height(); 
            var data_width = target.attr("data-percent") + "%";
            var data_color = target.attr("data-color"); 

            //animation starts
            if( winHeight > offsetTop ) {
                target.css({
                    backgroundColor: data_color,
                });
                target.animate({
                    width: data_width,
                }, 1000);
            }

            //animation with scroll 
            $(window).on("scroll", function(){
                var scrollBar = $(this).scrollTop(); 
                var animateStart = offsetTop - winHeight; 
                var animateEnd = animateStart + 400;
                if( scrollBar > animateStart && scrollBar < animateEnd ) {
                    target.css({
                        backgroundColor: data_color,
                    });
                    var start_animate = target.animate({
                        width: data_width,
                    }, 1000);

                    if(start_animate) {
                        setTimeout(function(){
                            target.stop();
                        }, 2000); 
                    } else {
                        return false;
                    }
                }
            }); 
        });

        return this; 
    }
})(jQuery)
