<!-- Features Block Style1-->
<?php
$working_item['settings'] = $settings;
$featured_image = $working_item['featured_image'];
$featured_image_size = $working_item['featured_image_size'];
$image = wp_get_attachment_image_src( $featured_image['id'], $featured_image_size);
?>
<div class="working-block-style4" data-bg="<?php if( isset($image[0]) && !empty($image[0]) ) echo esc_url( $image[0] )?>">
  <div class="working-content">
    <?php mascot_core_ventiq_get_shortcode_template_part( 'part-count', null, 'working-block/tpl', $working_item, false );?>
    <?php mascot_core_ventiq_get_shortcode_template_part( 'part-title', null, 'working-block/tpl', $working_item, false );?>
    <?php mascot_core_ventiq_get_shortcode_template_part( 'part-content', null, 'working-block/tpl', $working_item, false );?>
  </div>
</div>