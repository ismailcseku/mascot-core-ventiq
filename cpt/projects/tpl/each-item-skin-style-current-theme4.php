<div class="project-item projects-current-theme4">
	<div class="image">
		<?php echo get_the_post_thumbnail( get_the_ID(), $feature_thumb_image_size, array( 'class' => 'img-fullwidth' ) );?>
	</div>
	<a class="icon" href="<?php the_permalink();?>"><i class="fas fa-arrow-right"></i></a>
	<div class="content">
		<?php if ( $show_title == 'yes' ) : ?>
			<<?php echo esc_attr( $title_tag );?> class="title hover-link-light"><a href="<?php the_permalink();?>" ><?php the_title();?></a></<?php echo esc_attr( $title_tag );?>>
		<?php endif; ?>
		<?php if ( $show_cat == 'yes' ) : ?>
			<ul class="cat-list">
				<?php include('term-list-each-post.php'); ?>
			</ul>
		<?php endif; ?>
	</div>
</div>