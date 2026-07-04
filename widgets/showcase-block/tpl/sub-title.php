	<?php if( !empty( $subtitle ) ) : ?>
	<<?php echo esc_attr( $subtitle_tag );?> class="showcase-subtitle">
		<?php if( !empty( $url ) ): ?>
		<a
			<?php echo $target;?>
			href="<?php echo esc_url( $url );?>">
			<?php echo $subtitle;?>
		</a>
		<?php else: ?>
			<?php echo $subtitle;?>
		<?php endif ?>
	</<?php echo esc_attr( $subtitle_tag );?>>
	<?php endif; ?>

