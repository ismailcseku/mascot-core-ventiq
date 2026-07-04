<!-- Features Block Style5-->
<?php
$working_item['settings'] = $settings;
$featured_image = $working_item['featured_image'];
$featured_image_size = $working_item['featured_image_size'];
$image = wp_get_attachment_image_src( $featured_image['id'], $featured_image_size);
?>
<div class="working-block-style5 <?php echo esc_html( $working_item['show_reverse_position'] ); ?>">
  <div class="inner-box">
    <div class="title-box">
      <?php mascot_core_ventiq_get_shortcode_template_part( 'part-count', null, 'working-block/tpl', $working_item, false );?>
    </div>
    <div class="content-box">
        <?php mascot_core_ventiq_get_shortcode_template_part( 'part-title', null, 'working-block/tpl', $working_item, false );?>
        <?php mascot_core_ventiq_get_shortcode_template_part( 'part-content', null, 'working-block/tpl', $working_item, false );?>
      <div class="hover-lines"></div>
    </div>
  </div>
</div>