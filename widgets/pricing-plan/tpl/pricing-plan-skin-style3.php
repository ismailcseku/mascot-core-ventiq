<?php $settings['settings'] = $settings;?>

<div class="tm-sc-pricing-plan <?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?> pricing-plan-skin-style3">
	<div class="blur-shape"></div>
	<div class="pricing-left-ber">
		<div class="pricing-icon">
			<?php mascot_core_ventiq_get_shortcode_template_part( 'thumb', $icon_type, 'pricing-plan/tpl', $settings, false );?>
		</div>
		<div class="pricing-header">
			<?php mascot_core_ventiq_get_shortcode_template_part( 'pricing', null, 'pricing-plan/tpl', $settings, false );?>
		</div>
	</div>
	<div class="pricing-right-ber">
		<?php mascot_core_ventiq_get_shortcode_template_part( 'content', null, 'pricing-plan/tpl', $settings, false );?>

		<?php if ( $show_view_details_button == 'yes' ) : ?>
		<a href="<?php echo esc_url( $button['url'] ); ?>" class="theme-btn btn-style-one">
			<?php echo esc_html( $view_details_button_text  ); ?>
			<span class="icon">
				<svg xmlns="http://www.w3.org/2000/svg" width="22" height="23" viewBox="0 0 22 23" fill="none">
					<path fill-rule="evenodd" clip-rule="evenodd" d="M4.34506 2.73895C4.32098 2.04901 4.86066 1.47027 5.5506
					1.44616L19.6842 0.952646C20.3741 0.928553 20.9529 1.46824 20.9769 2.15819L21.4705 16.2917C21.4946 16.9817
						20.9549 17.5604 20.265 17.5845C19.575 17.6086 18.9963 17.0689 18.9722 16.379L18.5838 5.26141L2.45535
						22.5571C1.98454 23.062 1.19354 23.0896 0.688664 22.6188C0.183786 22.148 0.156152 21.357 0.62697
						20.8521L16.7554 3.55642L5.63792 3.94457C4.94798 3.96867 4.36914 3.42889 4.34506 2.73895Z" fill="black">
						</path>
				</svg>
			</span>
		</a>
		<?php endif; ?>
	</div>
</div>