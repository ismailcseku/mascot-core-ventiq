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
<div class="service-block-style14">
  <div class="outer-box">
    <?php mascot_core_ventiq_get_shortcode_template_part( 'icon-type', $service_item['icon_type'], 'service-block/tpl', $service_item, false );?>
    <div class="content-box">
      <?php mascot_core_ventiq_get_shortcode_template_part( 'part-title', null, 'service-block/tpl', $service_item, false );?>
      <?php mascot_core_ventiq_get_shortcode_template_part( 'part-content', null, 'service-block/tpl', $service_item, false );?>
    </div>
    <div class="arrow-shape-2 float-bob-x">
      <?php mascot_core_ventiq_get_shortcode_template_part( 'part-featured-image', null, 'service-block/tpl', $service_item, false );?>
    </div>
  </div>
</div>