(function($) {
    'use strict';

    var WidgetPricingPlanHandler = function ($scope) {
        if($('.pricing-plan-skin-style5').length) {
            var items = $('.pricing-plan-skin-style5');
            items.removeClass('pricing-active');
            items.eq(1).addClass('pricing-active');

            items.on('mouseenter', function() {
                items.removeClass('pricing-active');
                $(this).addClass('pricing-active');
            });

        }
		$('.pricing-plan-skin-style5').on('mouseleave', function() {
		$(this).addClass('pricing-active');
		});
    };

    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/tm-ele-pricing-plan.skin-style5",
            WidgetPricingPlanHandler
        );
    });

})(jQuery);
