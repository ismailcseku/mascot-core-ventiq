<!-- Project Block -->
<div class="project-item projects-current-theme5">
	<div class="inner-box">
		<div class="image-box">
			<?php echo get_the_post_thumbnail( get_the_ID(), $feature_thumb_image_size, array( 'class' => 'img-fullwidth' ) );?>
		</div>
		<div class="content-inner">
			<?php if ( $show_title == 'yes' ) : ?>
				<<?php echo esc_attr( $title_tag );?> class="title"><a href="<?php the_permalink();?>"><?php the_title();?></a></<?php echo esc_attr( $title_tag );?>>
			<?php endif; ?>
			<div class="link-btn">
				<a href="<?php the_permalink();?>" class="link"><i class="lnr-icon-arrow-right1"></i></a>
			</div>
		</div>
	</div>
</div>