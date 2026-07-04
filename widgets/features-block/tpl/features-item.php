<?php $features_item['settings'] = $settings;
$features_item['title_tag'] = $title_tag;
$features_item['subtitle_tag'] = $subtitle_tag;
$features_link = $features_item['features_link'];
$target = ( $features_link && $features_link['is_external'] ) ? ' target="_blank"' : '';
$url = ( $features_link && $features_link['url'] ) ? $features_link['url'] : '';
?>

<div class="features-block-style1">
  <div class="inner-box">
    <?php mascot_core_ventiq_get_shortcode_template_part( 'part-featured-image', null, 'features-block/tpl', $features_item, false );?>
    <div class="icon-box">
      <?php mascot_core_ventiq_get_shortcode_template_part( 'icon-type', $features_item['icon_type'], 'features-block/tpl', $features_item, false );?>
    </div>
    <div class="feature__content">
      <?php mascot_core_ventiq_get_shortcode_template_part( 'part-title', null, 'features-block/tpl', $features_item, false );?>
      <?php mascot_core_ventiq_get_shortcode_template_part( 'part-content', null, 'features-block/tpl', $features_item, false );?>
    </div>
    <a href="<?php echo esc_url( $url );?>" class="arrow-btn"><i class="flaticon-common-right-arrow"></i></a>
  </div>
</div>