<div class="blog-item-current-style3">
  <div class="inner-box">
      <div class="image-box">
          <div class="thumb">
              <?php ventiq_get_post_thumbnail( $post_format, $featured_image_size ); ?>
              <?php ventiq_get_post_thumbnail( $post_format, $featured_image_size ); ?>
          </div>
      </div>
      <div class="content-box">
          <div class="content">
              <?php if ( $show_post_meta == 'yes' ) : ?>
                <?php
                  $post_meta_options_array = explode(',', $post_meta_options);
                  if ( in_array( $show_post_meta_over_featured_image, $post_meta_options_array ) ) {
                    ?>
                    <div class="post-single-meta">
                      <?php ventiq_post_shortcode_single_meta( $show_post_meta_over_featured_image ); ?>
                    </div>
                    <?php
                  }
                ?>
              <?php endif; ?>
              <?php if ( $show_title == 'yes' ) : ?>
                <?php the_title( '<'.esc_attr( $title_tag ).' class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></'.esc_attr( $title_tag ).'>' ); ?>
              <?php endif; ?>
          </div>
          <?php if ( $show_post_meta == 'yes' ) : ?>
            <?php ventiq_post_shortcode_meta( $post_meta_options, array( $show_post_meta_over_featured_image ) ); ?>
          <?php endif; ?>
      </div>
  </div>
</div>