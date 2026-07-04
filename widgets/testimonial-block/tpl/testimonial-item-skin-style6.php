<!-- Testimonial Block Style2-->
<?php
$testimonial_item['settings'] = $settings;
$testimonial_item['name_tag'] = $name_tag;
$testimonial_item['position_tag'] = $position_tag;
$testimonial_item['title_tag'] = $title_tag;
$rating = $testimonial_item['rating'];
$rating_size = $rating['size'];
?>

<div class="testimonial-block testimonial-block-style6">
  <div class="inner-box">
    <figure class="thumb">
      <?php mascot_core_ventiq_get_shortcode_template_part( 'part-thumb', null, 'testimonial-block/tpl', $testimonial_item, false );?>
      <a class="video-play-button video-btn playbtnanim" data-lightbox="iframe" href="https://www.youtube.com/watch?v=hddwAIXbKZo"><i class="fas fa-play"></i></a>
    </figure>
    <div class="content-box">
      <div class="logo">
        <?php mascot_core_ventiq_get_shortcode_template_part( 'part-brand-thumb', null, 'testimonial-block/tpl', $testimonial_item, false );?>
      </div>
      <?php mascot_core_ventiq_get_shortcode_template_part( 'part-author-text', null, 'testimonial-block/tpl', $testimonial_item, false ); ?>
      <div class="info-box">
        <div class="user-info">
          <?php mascot_core_ventiq_get_shortcode_template_part( 'part-name', null, 'testimonial-block/tpl', $testimonial_item, false );?>
          <?php mascot_core_ventiq_get_shortcode_template_part( 'part-position', null, 'testimonial-block/tpl', $testimonial_item, false );?>
        </div>
        <div class="rating-info">
          <div class="rating"><?php echo esc_attr( $rating_size ); ?></div>
          <i class="icon fas fa-star"></i>
        </div>
      </div>
    </div>
  </div>
</div>