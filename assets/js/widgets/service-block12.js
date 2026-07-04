(function ($) {
  'use strict';


  var WidgetServiceBlock2Handler = function ($scope) {

    if ($('.service-block-style12 .inner-box').length) {
      const $boxes = $('.service-block-style12 .inner-box');
      const $contentBoxes = $('.service-block-style12 .content-box');

      // Step 1: Hide all content boxes
      $contentBoxes.hide().removeClass('active');
      $boxes.removeClass('active');

      // Step 2: Activate the first box on initial load
      const $firstBox = $boxes.first();
      $firstBox.addClass('active');
      $firstBox.find('.content-box').stop(true, true).slideDown(400).addClass('active');

      // Step 3: Click logic
      $boxes.on('click', function () {
        // Only react if the clicked box is not already active
        if (!$(this).hasClass('active')) {
          $boxes.removeClass('active');
          $contentBoxes.stop(true, true).slideUp(400).removeClass('active');

          $(this).addClass('active');
          $(this).find('.content-box').stop(true, true).slideDown(400).addClass('active');
        }
      });
    }

  };

  //elementor front start
  $(window).on("elementor/frontend/init", function () {
      elementorFrontend.hooks.addAction(
          "frontend/element_ready/tm-ele-service-block.skin-style12",
          WidgetServiceBlock2Handler
      );
  });


})(jQuery);