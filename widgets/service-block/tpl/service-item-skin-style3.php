<!-- Service Block Style1-->
<?php
$service_item['settings'] = $settings;
$service_item['title_tag'] = $title_tag;
$service_item['subtitle_tag'] = $subtitle_tag;
$feature_link = $service_item['feature_link'];
$count = $service_item['count'];
$target = ( $feature_link && $feature_link['is_external'] ) ? ' target="_blank"' : '';
$url = ( $feature_link && $feature_link['url'] ) ? $feature_link['url'] : '';
?>

<div class="service-block-style3">
	<div class="project-image">
		<?php mascot_core_ventiq_get_shortcode_template_part( 'part-featured-image', null, 'service-block/tpl', $service_item, false );?>
		<div class="project-layer-wrapper">
			<?php mascot_core_ventiq_get_shortcode_template_part( 'part-featured-image-two', null, 'service-block/tpl', $service_item, false );?>
			<?php mascot_core_ventiq_get_shortcode_template_part( 'part-featured-image-two', null, 'service-block/tpl', $service_item, false );?>
			<?php mascot_core_ventiq_get_shortcode_template_part( 'part-featured-image-two', null, 'service-block/tpl', $service_item, false );?>
			<?php mascot_core_ventiq_get_shortcode_template_part( 'part-featured-image-two', null, 'service-block/tpl', $service_item, false );?>
		</div>
		<?php mascot_core_ventiq_get_shortcode_template_part( 'part-count', null, 'service-block/tpl', $service_item, false );?>
	</div>
	<div class="project-content">
		<div class="content">
			<?php mascot_core_ventiq_get_shortcode_template_part( 'part-title', null, 'service-block/tpl', $service_item, false );?>
			<?php mascot_core_ventiq_get_shortcode_template_part( 'part-content', null, 'service-block/tpl', $service_item, false );?>
		</div>
		<?php if ( $show_view_details_button == 'yes' ) : ?>
			<a href="<?php echo esc_url( $url );?>" class="icon"><i class="fa fa-long-arrow-right"></i></a>
		<?php endif; ?>
	</div>
</div>