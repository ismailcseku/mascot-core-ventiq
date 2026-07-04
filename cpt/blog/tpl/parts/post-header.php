
	<?php if ( $show_featured_image == 'yes' ) : ?>
	<div class="entry-header">
		<?php ventiq_get_post_thumbnail( $post_format, $featured_image_size ); ?>
	</div>
	<?php endif; ?>