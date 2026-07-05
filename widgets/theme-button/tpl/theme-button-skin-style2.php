<?php $settings['settings'] = $settings;?>
<a  href="<?php echo esc_url( $button['url'] ); ?>"
		<?php echo $target = $link['is_external'] ? ' target="_blank"' : '';?>
		<?php echo $nofollow = $link['nofollow'] ? ' rel="nofollow"' : '';?>
		class="bg-white btn-style2">

  <span class="theme-btn-arrow-left">
		<i class="fas flaticon-common-right-arrow"></i>
  </span>
  <span class="theme-btn">
		<?php
			if( !empty( $button_text ) ) {
				echo esc_html( $button_text );
			}
		?>
  </span>
  <span class="theme-btn-arrow-right">
		<i class="fas flaticon-common-right-arrow"></i>
  </span>
</a>