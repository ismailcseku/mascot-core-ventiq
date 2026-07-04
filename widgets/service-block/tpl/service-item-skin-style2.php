<!-- Service Block Two -->
<?php
$service_item['settings'] = $settings;
$service_item['title_tag'] = $title_tag;
$service_item['subtitle_tag'] = $subtitle_tag;
?>

<div class="service-block-style2">
    <div class="content">
        <?php mascot_core_ventiq_get_shortcode_template_part( 'part-title', null, 'service-block/tpl', $service_item, false );?>
		<?php mascot_core_ventiq_get_shortcode_template_part( 'part-content', null, 'service-block/tpl', $service_item, false );?>
        <div class="icon">
            <?php mascot_core_ventiq_get_shortcode_template_part( 'icon-type', $service_item['icon_type'], 'service-block/tpl', $service_item, false );?>
        </div>
    </div>
    <div class="business-image">
        <?php mascot_core_ventiq_get_shortcode_template_part( 'part-featured-image', null, 'service-block/tpl', $service_item, false );?>
        <div class="business-layer-wrapper">
            <?php mascot_core_ventiq_get_shortcode_template_part( 'part-featured-image-two', null, 'service-block/tpl', $service_item, false );?>
			<?php mascot_core_ventiq_get_shortcode_template_part( 'part-featured-image-two', null, 'service-block/tpl', $service_item, false );?>
			<?php mascot_core_ventiq_get_shortcode_template_part( 'part-featured-image-two', null, 'service-block/tpl', $service_item, false );?>
			<?php mascot_core_ventiq_get_shortcode_template_part( 'part-featured-image-two', null, 'service-block/tpl', $service_item, false );?>
        </div>
    </div>
</div>