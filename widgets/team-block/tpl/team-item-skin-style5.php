<!-- Team Block Style5-->
<?php
$team_item['settings'] = $settings;
$team_item['title_tag'] = $title_tag;
$team_item['subtitle_tag'] = $subtitle_tag;
?>
<div class="team-current-theme5">
  <div class="inner-box">
    <div class="team-image">
      <?php mascot_core_ventiq_get_shortcode_template_part( 'part-thumb', null, 'team-block/tpl', $team_item, false );?>
      <?php mascot_core_ventiq_get_shortcode_template_part( 'part-thumb', null, 'team-block/tpl', $team_item, false );?>
    </div>
    <div class="content-box">
      <?php mascot_core_ventiq_get_shortcode_template_part( 'part-title', null, 'team-block/tpl', $team_item, false );?>
      <?php mascot_core_ventiq_get_shortcode_template_part( 'part-subtitle', null, 'team-block/tpl', $team_item, false );?>
      <?php mascot_core_ventiq_get_shortcode_template_part( 'part-social-links', null, 'team-block/tpl', $team_item, false );?>
    </div>
  </div>
</div>
