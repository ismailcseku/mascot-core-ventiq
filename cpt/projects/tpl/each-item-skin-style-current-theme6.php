<?php
$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
?>

<div class="project-item projects-current-theme6" <?php if(isset($featured_img_url) && !empty($featured_img_url)){ ?>style="background-image: url('<?php echo $featured_img_url; ?>');"<?php } ?>>
	<div class="project-item-inner">
		<div class="ks-project-content-wrap">
			<div class="ks-project-arrow">
				<a href="<?php the_permalink();?>"><i class="flaticon-common-arrow-right1"></i></a>
			</div>
			<div class="ks-project-content">
				<?php if ( $show_cat == 'yes' ) : ?>
					<ul class="cat-list">
						<?php include('term-list-each-post.php'); ?>
					</ul>
				<?php endif; ?>
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
				<div class="ks-project-btn">
					<?php mascot_core_ventiq_get_cpt_shortcode_template_part( 'button', null, 'projects/tpl', $settings, false ); ?>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>