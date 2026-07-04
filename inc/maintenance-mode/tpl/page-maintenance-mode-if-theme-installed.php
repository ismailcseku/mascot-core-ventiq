<?php
/**
 * The template for displaying Maintenance Mode Page
 *
 * This is the template that displays Maintenance Mode0 page by default.
 *
 */
add_filter( 'ventiq_filter_show_header', 'ventiq_return_false' );
add_filter( 'ventiq_filter_show_footer', 'ventiq_return_false' );

//change the page title
if( ventiq_get_redux_option( 'maintenance-mode-settings-title' ) != '' ) {
	add_filter('pre_get_document_title', 'ventiq_change_the_title');
	function ventiq_change_the_title() {
		return ventiq_get_redux_option( 'maintenance-mode-settings-title' );
	}
}

get_header();
?>

<?php
if ( mascot_core_ventiq_plugin_installed() ) {
	mascot_core_ventiq_get_maintenance_mode_parts();
}
?>

<?php get_footer();
