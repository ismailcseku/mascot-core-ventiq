<!-- Team Block Style1-->
<?php
$team_item['settings'] = $settings;
$team_item['title_tag'] = $title_tag;
$team_item['subtitle_tag'] = $subtitle_tag;
?>

<div class="team-current-theme2">
    <div class="team-image">
        <?php mascot_core_ventiq_get_shortcode_template_part( 'part-thumb', null, 'team-block/tpl', $team_item, false );?>
        <?php mascot_core_ventiq_get_shortcode_template_part( 'part-thumb', null, 'team-block/tpl', $team_item, false );?>
        <div class="arrow-shape">
            <?php mascot_core_ventiq_get_shortcode_template_part( 'part-thumb-two', null, 'team-block/tpl', $team_item, false );?>
        </div>
        <div class="team-content">
            <div class="content">
                <?php mascot_core_ventiq_get_shortcode_template_part( 'part-title', null, 'team-block/tpl', $team_item, false );?>
                <?php mascot_core_ventiq_get_shortcode_template_part( 'part-subtitle', null, 'team-block/tpl', $team_item, false );?>
            </div>
                <?php mascot_core_ventiq_get_shortcode_template_part( 'part-social-links', null, 'team-block/tpl', $team_item, false );?>
            <span class="share-icon fa fa-share-alt"></span>
        </div>
    </div>
</div>