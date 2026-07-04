<!-- Features Block Style1-->
<?php
$working_item['settings'] = $settings;

?>
<div class="working-block-style2 <?php echo esc_html( $working_item['show_reverse_position'] ); ?>">
  <div class="work-item">
    <div class="image">
      <?php mascot_core_ventiq_get_shortcode_template_part( 'part-featured-image', null, 'working-block/tpl', $working_item, false );?>
      <?php mascot_core_ventiq_get_shortcode_template_part( 'part-count', null, 'working-block/tpl', $working_item, false );?>
    </div>
    <div class="content">
      <?php mascot_core_ventiq_get_shortcode_template_part( 'part-title', null, 'working-block/tpl', $working_item, false );?>
      <?php mascot_core_ventiq_get_shortcode_template_part( 'part-content', null, 'working-block/tpl', $working_item, false );?>
    </div>
  </div>
</div>