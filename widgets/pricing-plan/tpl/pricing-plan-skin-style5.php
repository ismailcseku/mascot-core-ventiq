<!-- Pricing Block Style5-->
<?php $settings['settings'] = $settings;?>
<div class="tm-sc-pricing-plan <?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?> pricing-plan-skin-style5">
	<div class="pricing-plan-inner-wrapper">
		<?php mascot_core_ventiq_get_shortcode_template_part( 'thumb', $icon_type, 'pricing-plan/tpl', $settings, false );?>
		<div class="pricing-plan-inner">
			<?php mascot_core_ventiq_get_shortcode_template_part( 'pricing', null, 'pricing-plan/tpl', $settings, false );?>
			<div class="title-box">
				<?php mascot_core_ventiq_get_shortcode_template_part( 'title', null, 'pricing-plan/tpl', $settings, false );?>
				<?php if ( $sub_title ) { ?>
					<?php mascot_core_ventiq_get_shortcode_template_part( 'subtitle', null, 'pricing-plan/tpl', $settings, false );?>
				<?php } ?>
			</div>
			<?php mascot_core_ventiq_get_shortcode_template_part( 'content', null, 'pricing-plan/tpl', $settings, false );?>
			<?php if( in_array('has-label', $classes) ) { ?>
					<span class="pricing-plan-label"><?php echo esc_html( $label_text ); ?></span>
				<?php } ?>
			<?php if ( $show_view_details_button == 'yes' ) : ?>
				<a href="<?php echo esc_url( $button['url'] ); ?>" class="btn btn-gradient-theme-colored1 btn-round"><?php echo esc_html( $view_details_button_text  ); ?></a>
			<?php endif; ?>
		</div>
	</div>
</div>
