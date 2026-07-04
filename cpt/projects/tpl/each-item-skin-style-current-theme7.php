<?php
$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
?>
<div class="project-item projects-current-theme7">
	<div class="inner-box" <?php if(isset($featured_img_url) && !empty($featured_img_url)){ ?>style="background-image: url('<?php echo $featured_img_url; ?>');"<?php } ?>>
		<?php if ( $show_title == 'yes' ) : ?>
			<<?php echo esc_attr( $title_tag );?> class="title hover-link-light"><a href="<?php the_permalink();?>" ><?php the_title();?></a></<?php echo esc_attr( $title_tag );?>>
		<?php endif; ?>
		<div class="content">
			<h4 class="count"></h4>
			<a href="<?php the_permalink();?>" class="icon"><i class="flaticon-common-arrow-right1"></i></a>
		</div>
	</div>
</div>