<?php $settings['settings'] = $settings;?>

<div class="tm-sc-pricing-plan <?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?> pricing-plan-skin-style2">
	<div class="pricing-plan-inner-wrapper">
		<div class="pricing-plan-inner">
				<?php if( in_array('has-label', $classes) ) { ?>
				<div class="popular">
				<?php if( in_array('has-label', $classes) ) { ?>
						<span class="pricing-plan-label"><?php echo esc_html( $label_text ); ?></span>
					<?php } ?>
				</div>
				<?php } ?>
				<div class="inner-box">
						<?php mascot_core_ventiq_get_shortcode_template_part( 'thumb', null, 'pricing-plan/tpl', $settings, false );?>
						<div class="top">
						<?php mascot_core_ventiq_get_shortcode_template_part( 'title', null, 'pricing-plan/tpl', $settings, false );?>
						<?php mascot_core_ventiq_get_shortcode_template_part( 'subtitle', null, 'pricing-plan/tpl', $settings, false );?>
						</div>

						<?php mascot_core_ventiq_get_shortcode_template_part( 'content', null, 'pricing-plan/tpl', $settings, false );?>

						<div class="bottom">
								<?php mascot_core_ventiq_get_shortcode_template_part( 'pricing', null, 'pricing-plan/tpl', $settings, false );?>
								<?php mascot_core_ventiq_get_shortcode_template_part( 'footer-hint-text', null, 'pricing-plan/tpl', $settings, false );?>
						</div>

						<?php if ( $show_view_details_button == 'yes' ) : ?>
							<?php mascot_core_ventiq_get_shortcode_template_part( 'button', null, 'pricing-plan/tpl', $settings, false );?>
						<?php endif; ?>
				</div>
			</div>
		</div>
</div>