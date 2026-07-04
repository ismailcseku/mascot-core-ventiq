<?php
namespace MascotCoreVentiq\CPT\HeaderTop;

use MascotCoreVentiq\Lib;

/**
 * Singleton class
 * class CPT_HeaderTop
 * @package MascotCoreVentiq\CPT\HeaderTop;
 */
final class CPT_HeaderTop implements Lib\Mascot_Core_Ventiq_Interface_PostType {

	/**
	 * @var string
	 */
	public 	$ptKey;
	public 	$ptKeyRewriteBase;
	private $ptMenuIcon;
	private $ptSingularName;
	private $ptPluralName;

	/**
	 * Call this method to get singleton
	 *
	 * @return CPT_HeaderTop
	 */
	public static function Instance() {
		static $inst = null;
		if ($inst === null) {
			$inst = new CPT_HeaderTop();
		}
		return $inst;
	}

	/**
	 * Private ctor so nobody else can instance it
	 *
	 */
	private function __construct() {
		$this->ptSingularName = esc_html__( 'Parts - Header Top', 'mascot-core-ventiq' );
		$this->ptPluralName = esc_html__( 'Parts - Header Top', 'mascot-core-ventiq' );
		$this->ptKey = 'header-top';
		$this->ptKeyRewriteBase = $this->ptKey;
		$this->ptMenuIcon = 'dashicons-mascot';
		add_filter( 'manage_edit-'.$this->ptKey.'_columns', array($this, 'customColumnsSettings') ) ;
		add_filter( 'manage_'.$this->ptKey.'_posts_custom_column', array($this, 'customColumnsContent') ) ;
	}

	/**
	 * @return string
	 */
	public function getPTKey() {
		return $this->ptKey;
	}

	/**
	 * registers custom post type & Tax
	 */
	public function register() {
		$this->registerCustomPostType();
	}

	/**
	 * Regsiters custom post type
	 */
	private function registerCustomPostType() {

		$labels = array(
			'name'					=> $this->ptPluralName,
			'singular_name'			=> $this->ptPluralName . ' ' . esc_html__( 'Item', 'mascot-core-ventiq' ),
			'menu_name'				=> $this->ptPluralName,
			'name_admin_bar'		=> $this->ptPluralName,
			'archives'				=> esc_html__( 'Item Archives', 'mascot-core-ventiq' ),
			'attributes'			=> esc_html__( 'Item Attributes', 'mascot-core-ventiq' ),
			'parent_item_colon'		=> esc_html__( 'Parent Item:', 'mascot-core-ventiq' ),
			'all_items'				=> esc_html__( 'All Items', 'mascot-core-ventiq' ),
			'add_new_item'			=> esc_html__( 'Add New Item', 'mascot-core-ventiq' ),
			'add_new'				=> esc_html__( 'Add New', 'mascot-core-ventiq' ),
			'new_item'				=> esc_html__( 'New Item', 'mascot-core-ventiq' ),
			'edit_item'				=> esc_html__( 'Edit Item', 'mascot-core-ventiq' ),
			'update_item'			=> esc_html__( 'Update Item', 'mascot-core-ventiq' ),
			'view_item'				=> esc_html__( 'View Item', 'mascot-core-ventiq' ),
			'view_items'			=> esc_html__( 'View Items', 'mascot-core-ventiq' ),
			'search_items'			=> esc_html__( 'Search Item', 'mascot-core-ventiq' ),
			'not_found'				=> esc_html__( 'Not found', 'mascot-core-ventiq' ),
			'not_found_in_trash'	=> esc_html__( 'Not found in Trash', 'mascot-core-ventiq' ),
			'featured_image'		=> esc_html__( 'Featured Image', 'mascot-core-ventiq' ),
			'set_featured_image'	=> esc_html__( 'Set featured image', 'mascot-core-ventiq' ),
			'remove_featured_image'	=> esc_html__( 'Remove featured image', 'mascot-core-ventiq' ),
			'use_featured_image'	=> esc_html__( 'Use as featured image', 'mascot-core-ventiq' ),
			'insert_into_item'		=> esc_html__( 'Insert into item', 'mascot-core-ventiq' ),
			'uploaded_to_this_item'	=> esc_html__( 'Uploaded to this item', 'mascot-core-ventiq' ),
			'items_list'			=> esc_html__( 'Items list', 'mascot-core-ventiq' ),
			'items_list_navigation'	=> esc_html__( 'Items list navigation', 'mascot-core-ventiq' ),
			'filter_items_list'		=> esc_html__( 'Filter items list', 'mascot-core-ventiq' ),
		);

		$args = array(
			'label'						=> $this->ptSingularName,
			'description'				=> esc_html__( 'Post Type Description', 'mascot-core-ventiq' ),
			'labels'					=> $labels,
			'supports'					=> array( 'title', 'editor', ),
			'hierarchical'				=> false,
			'public'					=> true,
			'show_ui'					=> true,
			'show_in_menu'				=> true,
			'menu_position'				=> 31,
			'menu_icon'					=> $this->ptMenuIcon,
			'show_in_admin_bar'			=> true,
			'show_in_nav_menus'			=> true,
			'can_export'				=> true,
			'has_archive'				=> false,
			'exclude_from_search'		=> true,
			'publicly_queryable'		=> true,
			'capability_type'			=> 'page',
			'rewrite'					=> array( 'slug' => $this->ptKeyRewriteBase, 'with_front' => false ),
		);
		register_post_type( $this->ptKey, $args );

	}

	/**
	 * Custom Columns Settings
	 */
	public function customColumnsSettings( $columns ) {

		$columns = array(
			'cb'			=> '<input type="checkbox" />',
			'title'			=> esc_html__( 'Title', 'mascot-core-ventiq' ),
			'active-headertop'	=> esc_html__( 'Currently Active Header Top', 'mascot-core-ventiq' ),
			'date'			=> esc_html__( 'Date', 'mascot-core-ventiq' ),
		);
		return $columns;
	}

	/**
	 * Custom Columns Content
	 */
	public function customColumnsContent( $columns ) {
		global $post;
		switch( $columns ) {
			case 'active-headertop' :
				if( mascot_core_ventiq_theme_installed() ) {
					//default
					$active_headertop_id = ventiq_get_redux_option( 'header-settings-choose-header-top-cpt-elementor', 'default' );
					if( $post->ID == $active_headertop_id ) {
						echo '<a class="tm-btn tm-btn-danger tm-btn-sm disabled">Active Header</a>';
					}

					//transparent
					$active_headertop_id = ventiq_get_redux_option( 'header-settings-choose-header-top-cpt-elementor-transparent', 'default' );
					if( $post->ID == $active_headertop_id ) {
						echo '<a class="tm-btn tm-btn-danger tm-btn-sm disabled">Active Header Transparent</a>';
					}

					//transparent
					$active_headertop_id = ventiq_get_redux_option( 'header-settings-choose-header-top-cpt-elementor-sticky', 'default' );
					if( $post->ID == $active_headertop_id ) {
						echo '<a class="tm-btn tm-btn-danger tm-btn-sm disabled">Active Header Sticky</a>';
					}

					//transparent
					$active_headertop_id = ventiq_get_redux_option( 'header-settings-choose-header-top-cpt-elementor-mobile', 'default' );
					if( $post->ID == $active_headertop_id ) {
						echo '<a class="tm-btn tm-btn-danger tm-btn-sm disabled">Active Header Mobile</a>';
					}
				}
			break;

			default :
			break;
		}
	}

}