(function($) {
    'use strict';


    var WidgetFeatureBlock3Handler = function ($scope) {
        $(".features-block-style3").hover(function () {
            $(".features-block-style3").removeClass("active");
            $(this).addClass("active");
        });
    };

    //elementor front start
    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/tm-ele-features-block.skin-style3",
            WidgetFeatureBlock3Handler
        );
    });


})(jQuery);