(function($) {
    'use strict';
    var WidgetWorkingStepsBgImg = function ($scope) {
        var $working_block_style4 = $('.working-block-style4');
        if ($working_block_style4.length > 0) {
          $working_block_style4.each(function(index) {
            var current_item = $(this);

            //by default set bg image with the first item
            if (index == 0) {
              let newBackground = current_item.data("bg");
              current_item.parents(".tm-sc-working")
                .attr("data-background", newBackground)
                .css("background-image", "url(" + newBackground + ")");
            }

            //on mouse over change image
            current_item.on("mouseover", function () {
              let newBackground = current_item.data("bg");
              current_item.parents(".tm-sc-working")
                .attr("data-background", newBackground)
                .css("background-image", "url(" + newBackground + ")");
            });
          });
        }
    };

    //elementor front start
    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.elementsHandler.attachHandler( 'tm-ele-working-block', WidgetWorkingStepsBgImg, 'skin-style4' );
    });
})(jQuery);