<!-- Service Block Six -->
<?php
$service_item['settings'] = $settings;
$service_item['title_tag'] = $title_tag;
$service_item['subtitle_tag'] = $subtitle_tag;
$feature_link = $service_item['feature_link'];
$count = $service_item['count'];
$target = ( $feature_link && $feature_link['is_external'] ) ? ' target="_blank"' : '';
$url = ( $feature_link && $feature_link['url'] ) ? $feature_link['url'] : '';
$featured_image = $service_item['featured_image'];
$featured_image_size = $service_item['featured_image_size'];
$image = wp_get_attachment_image_src( $featured_image['id'], $featured_image_size);
?>

<div class="service-block-style9">
  <div class="inner-box">
    <div class="image-box">
      <?php mascot_core_ventiq_get_shortcode_template_part( 'part-featured-image', null, 'service-block/tpl', $service_item, false );?>
    </div>
    <div class="content-box">
      <?php mascot_core_ventiq_get_shortcode_template_part( 'part-title', null, 'service-block/tpl', $service_item, false );?>
      <?php mascot_core_ventiq_get_shortcode_template_part( 'part-content', null, 'service-block/tpl', $service_item, false );?>
      <?php if ( $show_view_details_button == 'yes' ) : ?>
        <?php mascot_core_ventiq_get_shortcode_template_part( 'button', null, 'service-block/tpl', $service_item, false );?>
      <?php endif; ?>
    </div>
  </div>
</div>