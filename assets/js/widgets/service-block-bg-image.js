(function($) {
    'use strict';
    var WidgetServiceBlockBgImg = function ($scope) {
        var $service_block_style8 = $('.service-block-style8');
        if ($service_block_style8.length > 0) {
          $service_block_style8.each(function(index) {
            var current_item = $(this);

            //by default set bg image with the first item
            if (index == 0) {
              let newBackground = current_item.data("bg");
              current_item.parents(".tm-sc-service")
                .attr("data-background", newBackground)
                .css("background-image", "url(" + newBackground + ")");
            }

            //on mouse over change image
            current_item.on("mouseover", function () {
              let newBackground = current_item.data("bg");
              current_item.parents(".tm-sc-service")
                .attr("data-background", newBackground)
                .css("background-image", "url(" + newBackground + ")");
            });
          });
        }
    };

    //elementor front start
    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.elementsHandler.attachHandler( 'tm-ele-service-block', WidgetServiceBlockBgImg, 'skin-style8' );
    });
})(jQuery);