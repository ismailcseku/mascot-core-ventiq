<!-- Service Block Fifteen -->
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
<div class="service-block-style15">
  <div class="icon">
    <?php mascot_core_ventiq_get_shortcode_template_part( 'icon-type', $service_item['icon_type'], 'service-block/tpl', $service_item, false );?>
  </div>
  <div class="content">
    <?php mascot_core_ventiq_get_shortcode_template_part( 'part-title', null, 'service-block/tpl', $service_item, false );?>
    <?php mascot_core_ventiq_get_shortcode_template_part( 'part-content', null, 'service-block/tpl', $service_item, false );?>
    <a href="<?php echo esc_url( $url );?>" class="link-btn"><?php echo esc_html( $settings['view_details_button_text']  ); ?> <i class="icon fas fa-arrow-right"></i>
    </a>
  </div>
</div>