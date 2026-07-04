<!-- Pricing Block Style1-->
<?php $settings['settings'] = $settings;?>
<div class="tm-sc-pricing-plan <?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?> pricing-plan-skin-style1">
	<div class="pricing-plan-inner">
		<div class="content-box">
			<?php if ( $sub_title ) { ?>
				<?php mascot_core_ventiq_get_shortcode_template_part( 'subtitle', null, 'pricing-plan/tpl', $settings, false );?>
			<?php } ?>
			<?php mascot_core_ventiq_get_shortcode_template_part( 'pricing', null, 'pricing-plan/tpl', $settings, false );?>
			<?php if ( $show_view_details_button == 'yes' ) : ?>
				<?php mascot_core_ventiq_get_shortcode_template_part( 'button', null, 'pricing-plan/tpl', $settings, false );?>
			<?php endif; ?>
		</div>
		<?php mascot_core_ventiq_get_shortcode_template_part( 'content', null, 'pricing-plan/tpl', $settings, false );?>
	</div>
</div>
