<!-- Service Block Six -->
<?php
$service_item['settings'] = $settings;
$service_item['title_tag'] = $title_tag;
$service_item['subtitle_tag'] = $subtitle_tag;
$feature_link = $service_item['feature_link'];
$target = ( $feature_link && $feature_link['is_external'] ) ? ' target="_blank"' : '';
$url = ( $feature_link && $feature_link['url'] ) ? $feature_link['url'] : '';
?>
<div class="service-block-style6">
  <div class="inner-box">
    <div class="row align-items-center">
      <div class="top-box col-lg-5">
        <?php mascot_core_ventiq_get_shortcode_template_part( 'part-title', null, 'service-block/tpl', $service_item, false );?>
      </div>

      <div class="center-box col-lg-5 text-lg-center">
        <?php mascot_core_ventiq_get_shortcode_template_part( 'part-content', null, 'service-block/tpl', $service_item, false );?>
        <div class="image">
          <?php mascot_core_ventiq_get_shortcode_template_part( 'part-featured-image', null, 'service-block/tpl', $service_item, false );?>
        </div>
      </div>
      <div class="bottom-box col-lg-2">
				<span class="year"><?php echo esc_html( $service_item['year'] );?></span>
      </div>
    </div>
  </div>
</div>