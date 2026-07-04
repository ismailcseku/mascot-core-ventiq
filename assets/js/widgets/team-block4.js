(function ($) {
  'use strict';


  var WidgetServiceBlock2Handler = function ($scope) {

    if ($('.team-current-theme4').length) {
		var $team_block = $('.team-current-theme4 .inner-box');
		$($team_block).on('mouseenter', function (e) {
			$(this).find('.content-box .social-links').stop().slideDown(300);
			return false;
		});
		$($team_block).on('mouseleave', function (e) {
			$(this).find('.content-box .social-links').stop().slideUp(300);
			return false;
		});
	}

  };

  //elementor front start
  $(window).on("elementor/frontend/init", function () {
      elementorFrontend.hooks.addAction(
          "frontend/element_ready/tm-ele-team-block.skin-style4",
          WidgetServiceBlock2Handler
      );
  });


})(jQuery);