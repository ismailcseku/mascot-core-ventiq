<!-- Features Block Style1-->
<?php $working_item['settings'] = $settings; ?>
<div class="working-block-style1">
  <div class="inner-box">
    <div class="icon-blur"></div>
    <div class="icon">
      <?php mascot_core_ventiq_get_shortcode_template_part( 'icon-type', $working_item['icon_type'], 'working-block/tpl', $working_item, false );?>
    </div>
      <?php mascot_core_ventiq_get_shortcode_template_part( 'part-count', null, 'working-block/tpl', $working_item, false );?>
    <div class="content">
      <?php mascot_core_ventiq_get_shortcode_template_part( 'part-title', null, 'working-block/tpl', $working_item, false );?>
    </div>
  </div>
</div>