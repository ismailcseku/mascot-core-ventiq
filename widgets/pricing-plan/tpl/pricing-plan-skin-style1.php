<!-- Pricing Block Style1-->
<?php
$settings['settings'] = $settings;
$link = $settings['link'];
$target = ( $link && $link['is_external'] ) ? ' target="_blank"' : '';
$url = ( $link && $link['url'] ) ? $link['url'] : '';
?>
<div class="tm-sc-pricing-plan <?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?> pricing-plan-skin-style1">
  <div class="pricing-plan-inner-wrapper">
    <div class="pricing-plan-inner">
      <div class="inner-box">
          <div class="head">
              <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' , 'class' => 'icon' ] ); ?>
							<?php mascot_core_ventiq_get_shortcode_template_part( 'pricing', null, 'pricing-plan/tpl', $settings, false );?>
              <?php mascot_core_ventiq_get_shortcode_template_part( 'title', null, 'pricing-plan/tpl', $settings, false );?>
              <?php mascot_core_ventiq_get_shortcode_template_part( 'subtitle', null, 'pricing-plan/tpl', $settings, false );?>
          </div>
          <?php mascot_core_ventiq_get_shortcode_template_part( 'content', null, 'pricing-plan/tpl', $settings, false );?>
          <?php if ( $show_view_details_button == 'yes' ) : ?>
            <?php mascot_core_ventiq_get_shortcode_template_part( 'button', null, 'pricing-plan/tpl', $settings, false );?>
          <?php endif; ?>
          <?php if( in_array('has-label', $classes) ) { ?>
            <span class="pricing-plan-label"><?php echo esc_html( $label_text ); ?></span>
          <?php } ?>
      </div>
    </div>
  </div>
</div>


