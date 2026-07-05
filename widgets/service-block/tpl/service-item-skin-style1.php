<!-- Service Block Style1-->
<?php $service_item['settings'] = $settings; ?>
<?php
$service_item['title_tag'] = $title_tag;
$service_item['subtitle_tag'] = $subtitle_tag;
$service_link = $service_item['service_link'];
$target = ( $service_link && $service_link['is_external'] ) ? ' target="_blank"' : '';
$url = ( $service_link && $service_link['url'] ) ? $service_link['url'] : '';
?>

<div class="service-block service-block-style1">
	<div class="inner-block">
		<div class="icon-block">
			<div class="icon">
				<?php mascot_core_ventiq_get_shortcode_template_part( 'icon-type', $service_item['icon_type'], 'service-block/tpl', $service_item, false );?>
			</div>
		</div>
		<?php mascot_core_ventiq_get_shortcode_template_part( 'part-title', null, 'service-block/tpl', $service_item, false );?>
		<?php mascot_core_ventiq_get_shortcode_template_part( 'part-content', null, 'service-block/tpl', $service_item, false );?>
		<?php
			// Sanitize the service list
			$list = wp_kses( $service_item['service_list'], 'post' );

			// Split into array by line breaks
			$items = preg_split('/\r\n|\r|\n/', $list);

			if ( ! empty( $items ) ) {
				echo '<ul class="list-info">';
				foreach ( $items as $item ) {
					$item = trim( $item );
					if ( ! empty( $item ) ) {
						echo '<li>' . esc_html( $item ) . '</li>';
					}
				}
				echo '</ul>';
			}
		?>
		<?php if ( $show_view_details_button == 'yes' ) : ?>
			<a href="<?php echo esc_url( $url );?>" class="btn-more">
				<span class="btn-title"><?php echo esc_html( $settings['view_details_button_text'] ?? '' ); ?></span>
				<span class="btn-icon"><i class="flaticon-common-arrow-right1"></i></span>
			</a>
		<?php endif; ?>
	</div>
</div>