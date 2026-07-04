<?php
	//link url
	$target = ( $btn1_link && $btn1_link['is_external'] ) ? ' target="_blank"' : '';
	$url = ( $btn1_link && $btn1_link['url'] ) ? $btn1_link['url'] : '';
?>

	<?php if( !empty( $title ) ) : ?>
	<<?php echo esc_attr( $title_tag );?> class="showcase-title">
		<?php if( !empty( $url ) ): ?>
		<a
			<?php echo $target;?>
			href="<?php echo esc_url( $url );?>">
			<?php echo $title;?>
		</a>
		<?php else: ?>
			<?php echo $title;?>
		<?php endif ?>
	</<?php echo esc_attr( $title_tag );?>>
	<?php endif; ?>