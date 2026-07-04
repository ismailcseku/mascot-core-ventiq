<?php $features_item['settings'] = $settings; ?>
<?php
$features_item['title_tag'] = $title_tag;
$features_item['subtitle_tag'] = $subtitle_tag;

$features_link = $features_item['features_link'];
$target = ( $features_link && $features_link['is_external'] ) ? ' target="_blank"' : '';
$url = ( $features_link && $features_link['url'] ) ? $features_link['url'] : '';
?>
<div class="features-block-style10">
  <div class="inner-box">
    <div class="feature-icon">
      <?php mascot_core_ventiq_get_shortcode_template_part( 'icon-type', $features_item['icon_type'], 'features-block/tpl', $features_item, false );?>
    </div>
    <div class="content-box">
      <?php mascot_core_ventiq_get_shortcode_template_part( 'part-title', null, 'features-block/tpl', $features_item, false );?>
      <?php mascot_core_ventiq_get_shortcode_template_part( 'part-content', null, 'features-block/tpl', $features_item, false );?>
    </div>
  </div>
</div>