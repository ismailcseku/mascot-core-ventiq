<!-- Features Block Style1-->
<?php
$working_item['settings'] = $settings;
$working_block_link = $working_item['working_block_link'];
$url = ( $working_block_link && $working_block_link['url'] ) ? $working_block_link['url'] : '';
?>


<div class="working-block-style1 <?php echo esc_html( $working_item['show_reverse_position'] ); ?>">
  <div class="icon">
      <?php mascot_core_ventiq_get_shortcode_template_part( 'icon-type-font-icon', null, 'working-block/tpl', $working_item, false );?>
      <?php mascot_core_ventiq_get_shortcode_template_part( 'part-count', null, 'working-block/tpl', $working_item, false );?>
  </div>
  <div class="content">
      <?php mascot_core_ventiq_get_shortcode_template_part( 'part-title', null, 'working-block/tpl', $working_item, false );?>
      <?php mascot_core_ventiq_get_shortcode_template_part( 'part-content', null, 'working-block/tpl', $working_item, false );?>
  </div>
  <div class="line">
     <?php mascot_core_ventiq_get_shortcode_template_part( 'part-featured-image', null, 'working-block/tpl', $working_item, false );?>
  </div>
</div>