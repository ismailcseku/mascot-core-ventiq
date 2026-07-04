<!-- Testimonial Block Style1-->
<?php
$testimonial_item['settings'] = $settings;
$testimonial_item['name_tag'] = $name_tag;
$testimonial_item['position_tag'] = $position_tag;
$testimonial_item['title_tag'] = $title_tag;
?>
<div class="testimonial-block-style8">
  <div class="icon">
    <?php mascot_core_ventiq_get_shortcode_template_part( 'part-brand-thumb', null, 'testimonial-block/tpl', $testimonial_item, false );?>
  </div>
  <?php mascot_core_ventiq_get_shortcode_template_part( 'part-author-text', null, 'testimonial-block/tpl', $testimonial_item, false ); ?>
  <div class="info">
    <div>
      <?php mascot_core_ventiq_get_shortcode_template_part( 'part-name', null, 'testimonial-block/tpl', $testimonial_item, false );?>
      <?php mascot_core_ventiq_get_shortcode_template_part( 'part-position', null, 'testimonial-block/tpl', $testimonial_item, false );?>
    </div>
    <div class="stars">
      <?php mascot_core_ventiq_get_shortcode_template_part( 'part-star-rating', null, 'testimonial-block/tpl', $testimonial_item, false );?>
    </div>
  </div>
</div>