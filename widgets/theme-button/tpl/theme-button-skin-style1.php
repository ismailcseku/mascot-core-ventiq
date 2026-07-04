<?php $settings['settings'] = $settings;?>
<a  href="<?php echo esc_url( $button['url'] ); ?>"
	<?php echo $target = $link['is_external'] ? ' target="_blank"' : '';?>
	<?php echo $nofollow = $link['nofollow'] ? ' rel="nofollow"' : '';?>
	class="btn-style1">
	<?php
		if( !empty( $button_text ) ) {
			echo esc_html( $button_text );
		}
	?>
  <span class="icon">
		<?php if( ! empty( $button_icon['value'] ) ) { ?>
			<?php \Elementor\Icons_Manager::render_icon( $button_icon ); ?>
		<?php }?>
  </span>
</a>