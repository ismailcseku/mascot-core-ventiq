(function($) {
    'use strict';
    var ServiceHorizontalTab = function ($scope) {
        var $service_block_style13 = $('.service-block-style13');
        if ($service_block_style13.length > 0) {
          $service_block_style13.each(function(index) {
            var current_item = $(this);

            //by default set bg image with the first item
            if (index == 0) {
              current_item.addClass("active");
            }

            current_item.on("click", function () {
              if (!current_item.hasClass("active")) {
                $service_block_style13.removeClass("active");
                current_item.addClass("active");
              }
            });
          });
        }
    };

    //elementor front start
    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.elementsHandler.attachHandler( 'tm-ele-service-block', ServiceHorizontalTab, 'skin-style13' );
    });
})(jQuery);