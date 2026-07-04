(function($) {
    'use strict';


    var WidgetServiceBlock2Handler = function ($scope) {
        //Service Block Hover
        if ($(".acc-btn").length) {
            // Default: open the first item
            var $firstItem = $(".service-block-style11").first();
            $firstItem.addClass("active");
            $firstItem.find(".acc-collapse").addClass("show").slideDown(0);

            $(".acc-btn").on("click", function () {
                var $clickedItem = $(this).closest(".service-block-style11");

                if ($clickedItem.hasClass("active")) {
                    $clickedItem
                        .removeClass("active")
                        .find(".acc-collapse")
                        .slideUp()
                        .removeClass("show");
                } else {
                    $(".service-block-style11")
                        .removeClass("active")
                        .find(".acc-collapse")
                        .slideUp()
                        .removeClass("show");
                    $clickedItem
                        .addClass("active")
                        .find(".acc-collapse")
                        .slideDown()
                        .addClass("show");
                }
            });
        }

    };

    //elementor front start
    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/tm-ele-service-block.skin-style11",
            WidgetServiceBlock2Handler
        );
    });


})(jQuery);