<?php if ( $settings['show_paragraph'] == 'yes' ) { ?>
<div class="features-details"><?php echo wp_kses( $content, 'post' ); ?></div>
<?php } ?>