<?php

if ( ! class_exists( 'MascotCoreVentiqScriptsHandler' ) ) {
	/**
	 * Main theme class with configuration
	 */
	class MascotCoreVentiqScriptsHandler {
		private static $instance;

		public function __construct() {

			// Include theme's script and localize theme's main js script
			add_action( 'wp_enqueue_scripts', array( $this, 'include_js_scripts' ) );

			// Include theme's 3rd party plugins styles
			add_action( 'mascot_core_ventiq_action_before_main_css', array( $this, 'include_plugins_styles' ) );

			// Include theme's 3rd party plugins scripts
			add_action( 'mascot_core_ventiq_action_before_main_js', array( $this, 'include_plugins_scripts' ) );

		}

		public static function get_instance() {
			if ( ! ( self::$instance instanceof self ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		function include_js_scripts() {
			// JS dependency variable
			$main_js_dependency  = apply_filters( 'mascot_core_ventiq_filter_main_js_dependency', array( 'jquery' ) );

			// Hook to include additional scripts before theme's main script
			do_action( 'mascot_core_ventiq_action_before_main_js', $main_js_dependency );

			if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
				// Enqueue theme's main script
				wp_enqueue_script( 'mascot-core-custom-elementor', MASCOT_CORE_VENTIQ_ASSETS_URI . '/js/custom-elementor.js', $main_js_dependency, false, true );
			}

			// Hook to include additional scripts after theme's main script
			do_action( 'mascot_core_ventiq_action_after_main_js' );
		}

		function include_plugins_styles() {
		}

		function include_plugins_scripts() {

			// JS dependency variables
			$js_3rd_party_dependency = apply_filters( 'mascot_core_ventiq_filter_js_3rd_party_dependency', 'jquery' );




			$direction_suffix = is_rtl() ? '.rtl' : '';

			// Enqueue 3rd party plugins script
			wp_register_script( 'swiper', MASCOT_CORE_VENTIQ_ASSETS_URI . '/js/plugins/swiper/swiper.min.js', $js_3rd_party_dependency, false, true );
			wp_register_style( 'swiper', MASCOT_CORE_VENTIQ_ASSETS_URI . '/js/plugins/swiper/assets/swiper.min.css' );




			//external plugins js & css:
			//used when needed:

			wp_register_script( 'lightgallery', MASCOT_CORE_VENTIQ_ASSETS_URI . '/js/plugins/lightgallery/js/lightgallery.min.js', array('jquery'), false, true );
			wp_register_style( 'lightgallery', MASCOT_CORE_VENTIQ_ASSETS_URI . '/js/plugins/lightgallery/css/lightgallery.min.css' );
			wp_register_script( 'jquery-mousewheel', MASCOT_CORE_VENTIQ_ASSETS_URI . '/js/plugins/jquery.mousewheel.min.js', array('jquery'), false, true );
			wp_register_script( 'mediko-custom-lightgallery', MASCOT_CORE_VENTIQ_ASSETS_URI . '/js/custom-lightgallery.js', array('jquery'), false, true );





			wp_register_script( 'jquery-parallax-scroll', MASCOT_CORE_VENTIQ_ASSETS_URI . '/js/plugins/jquery.parallax-scroll.js', array('jquery'), false, true );


			wp_register_script( 'sticky-sidebar', MASCOT_CORE_VENTIQ_ASSETS_URI . '/js/plugins/sticky-sidebar.min.js', null, false, true );
			wp_register_script( 'sticky-kit', MASCOT_CORE_VENTIQ_ASSETS_URI . '/js/plugins/sticky-kit.min.js', array('jquery'), false, true );
			wp_enqueue_script( 'jquery-tilt', MASCOT_CORE_VENTIQ_ASSETS_URI . '/js/plugins/jquery.tilt.min.js', array('jquery'), false, true );



			wp_register_script( 'matchHeight', MASCOT_CORE_VENTIQ_ASSETS_URI . '/js/plugins/jquery.matchHeight-min.js', array('jquery'), false, true );

		}
	}

	MascotCoreVentiqScriptsHandler::get_instance();
}