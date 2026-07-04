<div class="project-item projects-current-theme3">
	<div class="left-content">
		<div class="shape"></div>
		<div class="icon">
		<?php $icon = ventiq_get_rwmb_group( 'ventiq_' . 'projects_mb_settings', 'project_icon' );?>
		<i class="<?php echo esc_html( $icon )?>"></i>
		</div>
		<div class="content">
			<h4 class="count"></h4>
			<?php if ( $show_title == 'yes' ) : ?>
				<<?php echo esc_attr( $title_tag );?> class="title hover-link-light"><a href="<?php the_permalink();?>" ><?php the_title();?></a></<?php echo esc_attr( $title_tag );?>>
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
			<?php if ( $show_view_details_button == 'yes' ) : ?>
				<a href="<?php the_permalink();?>" class="arry-btn"><i class="icon lnr-icon-arrow-right1"></i></a>
			<?php endif; ?>
		</div>
	</div>
	<div class="image">
		<?php echo get_the_post_thumbnail( get_the_ID(), $feature_thumb_image_size, array( 'class' => 'img-fullwidth' ) );?>
	</div>
</div>