(function($) {
    'use strict';


    var WidgetServiceBlock3Handler = function ($scope) {

        $(".service-block-style3").hover(function () {
            $(".service-block-style3").removeClass("active");
            $(this).addClass("active");
        });
    };

    //elementor front start
    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/tm-ele-service-block.skin-style3",
            WidgetServiceBlock3Handler
        );
    });


})(jQuery);

(function($) {
    'use strict';
    var ServiceHorizontalTab = function ($scope) {
        var $service_block_style3 = $('.service-block-style3');
        if ($service_block_style3.length > 0) {
          $service_block_style3.each(function(index) {
            var current_item = $(this);

            //by default set bg image with the first item
            if (index == 1) {
              current_item.addClass("active");
            }

            current_item.on("click", function () {
              if (!current_item.hasClass("active")) {
                $service_block_style7.removeClass("active");
                current_item.addClass("active");
              }
            });
          });
        }
    };

    //elementor front start
    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.elementsHandler.attachHandler( 'tm-ele-service-block', ServiceHorizontalTab, 'skin-style3' );
    });
})(jQuery);