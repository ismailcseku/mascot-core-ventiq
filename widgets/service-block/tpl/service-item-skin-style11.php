<!-- Service Block Style1-->
<?php
$service_item['settings'] = $settings;
$service_item['title_tag'] = $title_tag;
$service_item['subtitle_tag'] = $subtitle_tag;
$title = $service_item['title'];
$feature_link = $service_item['feature_link'];
$target = ( $feature_link && $feature_link['is_external'] ) ? ' target="_blank"' : '';
$url = ( $feature_link && $feature_link['url'] ) ? $feature_link['url'] : '';
?>

<div class="service-block-style11">
  <div class="acc-header">
    <div class="acc-btn">
      <div class="content-box">
        <?php mascot_core_ventiq_get_shortcode_template_part( 'icon-type', $service_item['icon_type'], 'service-block/tpl', $service_item, false );?>
        <?php mascot_core_ventiq_get_shortcode_template_part( 'part-title', null, 'service-block/tpl', $service_item, false );?>
      </div>
      <span class="number"><?php echo $service_item['count']; ?></span>
    </div>
  </div>
  <div class="acc-collapse" style="display: none;">
    <div class="acc-body">
      <?php mascot_core_ventiq_get_shortcode_template_part( 'part-content', null, 'service-block/tpl', $service_item, false );?>
    </div>
  </div>
</div>
