<div class="project-item projects-skin-current-theme1">
	<div class="project-image">
		<?php echo get_the_post_thumbnail( get_the_ID(), $feature_thumb_image_size, array( 'class' => 'img-fullwidth' ) );?>
		<?php echo get_the_post_thumbnail( get_the_ID(), $feature_thumb_image_size, array( 'class' => 'img-fullwidth' ) );?>
		<span class="number"></span>
	</div>
	<div class="project-content">
		<div class="arrow-shape"></div>
		<div class="content">
			<?php if ( $show_title == 'yes' ) : ?>
				<<?php echo esc_attr( $title_tag );?> class="title"><a href="<?php the_permalink();?>" ><?php the_title();?></a></<?php echo esc_attr( $title_tag );?>>
			<?php endif; ?>
			<?php if ( $show_cat == 'yes' ) : ?>
				<ul class="cat-list">
					<?php include('term-list-each-post.php'); ?>
				</ul>
			<?php endif; ?>
		</div>

		<?php if ( $show_view_details_button == 'yes' ) : ?>
		<a href="<?php the_permalink();?>" class="icon">
			<svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
			<defs>
				<linearGradient id="paint0_linear_1_17562" x1="21.213" y1="0.34721" x2="1.32146" y2="21.6783" gradientUnits="userSpaceOnUse">
				<stop offset="0" stop-color="#C8F169"/>
				<stop offset="1" stop-color="#60BFAA"/>
				</linearGradient>
			</defs>
			<path d="M4.97787 1.79852C4.95379 1.10859 5.49347 0.529841 6.18341 0.505735L20.317 0.012217C21.0069 0 21.5857 0.527811 21.6098 1.21776L22.1033 15.3513C22.1274 16.0412 21.5877 16.62 20.8978 16.6441C20.2078 16.6682 19.6291 16.1285 19.605 15.4385L19.2166 4.32098L3.08817 21.6166C2.61735 22.1215 1.82635 22.1491 1.32148 21.6783C0.816598 21.2075 0.788964 20.4165 1.25978 19.9116L17.3882 2.61599L6.27073 3.00414C5.58079 3.02824 5.00195 2.48846 4.97787 1.79852Z"
					fill="url(#paint0_linear_1_1756)" />
			</svg>
		</a>
		<?php endif; ?>
	</div>
</div>