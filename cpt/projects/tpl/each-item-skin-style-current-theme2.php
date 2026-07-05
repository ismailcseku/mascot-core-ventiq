<div class="project-item projects-current-theme2">
	<div class="project-image">
		<?php echo get_the_post_thumbnail( get_the_ID(), $feature_thumb_image_size, array( 'class' => 'img-fullwidth' ) );?>
		<?php echo get_the_post_thumbnail( get_the_ID(), $feature_thumb_image_size, array( 'class' => 'img-fullwidth' ) );?>
		<div class="project-content">
			<?php if ( $show_title == 'yes' ) : ?>
				<<?php echo esc_attr( $title_tag );?> class="title"><a href="<?php the_permalink();?>" ><?php the_title();?></a></<?php echo esc_attr( $title_tag );?>>
			<?php endif; ?>
			<?php if ( $show_excerpt == 'yes' ) : ?>
				<?php if ( empty($excerpt_length) ) { ?>
					<?php $excerpt = get_the_excerpt(); ?>
					<?php if ( !empty($excerpt) ) { ?>
						<div class="excerpt">
							<?php echo esc_html( strip_shortcodes( get_the_excerpt() ) )?>
						</div>
					<?php } ?>
				<?php } else { ?>
					<?php $excerpt = get_the_excerpt(); ?>
					<?php if ( !empty($excerpt) ) { ?>
						<div class="excerpt">
							<?php echo esc_html( ventiq_slice_excerpt_by_length( $excerpt, $excerpt_length ) ); ?>
						</div>
					<?php } ?>
				<?php } ?>
			<?php endif; ?>
			<?php if ( $show_cat == 'yes' ) : ?>
				<ul class="cat-list">
					<?php include('term-list-each-post.php'); ?>
				</ul>
			<?php endif; ?>
		</div>
		<div class="shape-style1">
    	</div>
	</div>
	<?php if ( $show_view_details_button == 'yes' ) : ?>
	<a href="<?php the_permalink();?>" class="theme-btn btn-style-one">
		<?php echo esc_html( $view_details_button_text  ); ?>
		<span class="icon">
			<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50" fill="none">
				<path fill-rule="evenodd" clip-rule="evenodd" d="M19.782 17.0248C19.7611 16.4269 20.2289 15.9253 20.8268 15.9044L33.0759 15.4767C33.6738 15.4558 34.1754 15.9235 34.1963 16.5215L34.624 28.7705C34.6449 29.3685 34.1772 29.8701 33.5792 29.8909C32.9813 29.9118 32.4797 29.4441 32.4588 28.8461L32.1222 19.2109L18.1442 34.2005C17.7362 34.6381 17.0507 34.662 16.6131 34.254C16.1756 33.8459 16.1516 33.1604 16.5596 32.7228L30.5376 17.7333L20.9025 18.0697C20.3045 18.0906 19.8029 17.6227 19.782 17.0248Z" fill="#C8F169"/>
			</svg>
		</span>
	</a>
	<?php endif; ?>
</div>