<!-- Service Block Twelve -->
<?php
$service_item['settings'] = $settings;
$service_item['title_tag'] = $title_tag;
$title = $service_item['title'];
$service_item['subtitle_tag'] = $subtitle_tag;
$feature_link = $service_item['feature_link'];
$count = $service_item['count'];
$target = ( $feature_link && $feature_link['is_external'] ) ? ' target="_blank"' : '';
$url = ( $feature_link && $feature_link['url'] ) ? $feature_link['url'] : '';
?>
<div class="service-block-style13">
  <div class="head">
    <div class="head-title">
      <?php mascot_core_ventiq_get_shortcode_template_part( 'part-title', null, 'service-block/tpl', $service_item, false );?>
      <?php mascot_core_ventiq_get_shortcode_template_part( 'part-count', null, 'service-block/tpl', $service_item, false );?>
    </div>
  </div>
  <div class="content">
    <div class="wrp">
      <div class="content-wrp">
        <?php mascot_core_ventiq_get_shortcode_template_part( 'part-content', null, 'service-block/tpl', $service_item, false );?>
        <a href="<?php echo esc_url( $url );?>" class="arry-btn"><i class="flaticon-common-right-arrow"></i></a>
      </div>
      <div class="shape">
      </div>
      <div class="image">
        <?php mascot_core_ventiq_get_shortcode_template_part( 'part-featured-image', null, 'service-block/tpl', $service_item, false );?>
      </div>
    </div>
  </div>
</div>