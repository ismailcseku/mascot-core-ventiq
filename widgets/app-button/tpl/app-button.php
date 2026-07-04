<a
<?php echo $target = $link['is_external'] ? ' target="_blank"' : '';?>
href="<?php echo esc_url( $url );?>" class="tm-app-btn">
	<span class="title"><?php echo esc_html( $title );?></span>
	<div class="icon">
		<?php if( isset($icon[ 'value' ]) && !empty( $icon[ 'value' ] ) ){ ?>
			<i class="<?php echo esc_attr( $icon[ 'value' ] );  ?>"></i>
		<?php } ?>
	</div>
</a>