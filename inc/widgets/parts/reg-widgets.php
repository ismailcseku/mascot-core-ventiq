<?php
// Block direct requests
if ( !defined('ABSPATH') ) die('-1');


if(!function_exists('mascot_core_ventiq_register_widgets')) {
	/**
	 * Register all widgets
	 */
	function mascot_core_ventiq_register_widgets() {
		$widget_list = array(
			'Mascot_Core_Ventiq_Widget_BlogList',
		);

		//apply filter
		if( has_filter('mascot_core_ventiq_register_widgets_add_widgets') ) {
			$widget_list = apply_filters('mascot_core_ventiq_register_widgets_add_widgets', $widget_list);
		}

		foreach( $widget_list as $each_widget ) {
			register_widget( $each_widget );
		}

	}
	/* Register the widget */
	mascot_core_ventiq_register_widgets();
}
