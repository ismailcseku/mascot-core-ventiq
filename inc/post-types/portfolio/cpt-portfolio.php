<?php
namespace MascotCoreVentiq\CPT\Portfolio;

use MascotCoreVentiq\Lib;

/**
 * Singleton class
 * class CPT_Portfolio
 * @package MascotCoreVentiq\CPT\Portfolio;
 */
final class CPT_Portfolio implements Lib\Mascot_Core_Ventiq_Interface_PostType {

	/**
	 * @var string
	 */
	public 	$ptKey;
	public 	$ptKeyRewriteBase;
	public  $ptTaxKey;
	public  $ptTaxKeyRewriteBase;
	public  $ptTagTaxKey;
	public  $ptTagTaxKeyRewriteBase;
	private $ptMenuIcon;
	private $ptSingularName;
	private $ptPluralName;
	private $masonry_mode_image_size;

	/**
	 * Call this method to get singleton
	 *
	 * @return CPT_Portfolio
	 */
	public static function Instance() {
		static $inst = null;
		if ($inst === null) {
			$inst = new CPT_Portfolio();
		}
		return $inst;
	}

	/**
	 * Private ctor so nobody else can instance it
	 *
	 */
	private function __construct() {
		$this->ptSingularName = esc_html__( 'Portfolio Item', 'mascot-core-ventiq' );
		$this->ptPluralName = esc_html__( 'Portfolio', 'mascot-core-ventiq' );
		$this->ptKey = 'portfolio-items';
		$this->ptKeyRewriteBase = $this->ptKey;
		$this->ptTaxKey = 'portfolio_category';
		$this->ptTaxKeyRewriteBase = str_replace( '_', '-', $this->ptTaxKey );
		$this->ptTagTaxKey = 'portfolio_tag';
		$this->ptTagTaxKeyRewriteBase = str_replace( '_', '-', $this->ptTagTaxKey );
		$this->ptMenuIcon = 'dashicons-screenoptions';


		$this->masonry_mode_image_size = mascot_core_ventiq_masonry_image_sizes();

		add_filter( 'manage_edit-'.$this->ptKey.'_columns', array($this, 'customColumnsSettings') ) ;
		add_filter( 'manage_'.$this->ptKey.'_posts_custom_column', array($this, 'customColumnsContent') ) ;
		add_filter( 'rwmb_meta_boxes', array($this, 'regMetaBoxes') ) ;
	}

	/**
	 * @return string
	 */
	public function getPTKey() {
		return $this->ptKey;
	}

	/**
	 * @return string
	 */
	public function getPTTaxKey() {
		return $this->ptTaxKey;
	}

	/**
	 * registers custom post type & Tax
	 */
	public function register() {
		if ( class_exists( 'ReduxFramework' ) ) {
			if( ! mascot_core_ventiq_get_redux_option( 'cpt-settings-portfolio-enable', true ) ) {
				return;
			}
		}

		$this->ptPluralName = mascot_core_ventiq_get_redux_option( 'cpt-settings-portfolio-label', esc_html__( 'Portfolio', 'mascot-core-ventiq' ) );
		$this->ptMenuIcon = mascot_core_ventiq_get_redux_option( 'cpt-settings-portfolio-admin-dashicon', $this->ptMenuIcon );
		$this->ptKeyRewriteBase = mascot_core_ventiq_get_redux_option( 'cpt-settings-portfolio-slug', $this->ptKeyRewriteBase );

		$this->registerCustomPostType();
		$this->registerCustomTax();
		$this->registerCustomTaxTag();
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
			'supports'			  		=> array( 'title', 'thumbnail', 'editor', 'excerpt', 'comments', 'page-attributes' ),
			'taxonomies'				=> array( $this->ptTaxKey ),
			'hierarchical'				=> false,
			'public'					=> true,
			'show_ui'					=> true,
			'show_in_menu'				=> true,
			'menu_position'				=> 31,
			'menu_icon'					=> $this->ptMenuIcon,
			'show_in_admin_bar'			=> true,
			'show_in_nav_menus'			=> true,
			'can_export'				=> true,
			'has_archive'				=> true,
			'exclude_from_search'		=> false,
			'publicly_queryable'		=> true,
			'capability_type'			=> 'page',
			'rewrite'					=> array( 'slug' => $this->ptKeyRewriteBase, 'with_front' => false ),
		);
		register_post_type( $this->ptKey, $args );

	}

	/**
	 * Regsiters custom Taxonomy
	 */
	private function registerCustomTax() {

		$labels = array(
			'name'						=> _x( 'Portfolio Items Categories', 'Taxonomy General Name', 'mascot-core-ventiq' ),
			'singular_name'				=> _x( 'Portfolio Item Category', 'Taxonomy Singular Name', 'mascot-core-ventiq' ),
			'menu_name'					=> $this->ptPluralName . esc_html__( ' Categories', 'mascot-core-ventiq' ),
			'all_items'					=> esc_html__( 'All ', 'mascot-core-ventiq' ) . $this->ptSingularName . esc_html__( ' Categories', 'mascot-core-ventiq' ),
			'parent_item'				=> esc_html__( 'Parent Item', 'mascot-core-ventiq' ),
			'parent_item_colon'			=> esc_html__( 'Parent Item:', 'mascot-core-ventiq' ),
			'new_item_name'				=> esc_html__( 'New ', 'mascot-core-ventiq' ) . $this->ptSingularName . esc_html__( ' Category', 'mascot-core-ventiq' ),
			'add_new_item'				=> esc_html__( 'Add ', 'mascot-core-ventiq' ) . $this->ptSingularName . esc_html__( ' Category', 'mascot-core-ventiq' ),
			'edit_item'					=> esc_html__( 'Edit ', 'mascot-core-ventiq' ) . $this->ptSingularName . esc_html__( ' Category', 'mascot-core-ventiq' ),
			'update_item'				=> esc_html__( 'Update ', 'mascot-core-ventiq' ) . $this->ptSingularName . esc_html__( ' Category', 'mascot-core-ventiq' ),
			'view_item'					=> esc_html__( 'View ', 'mascot-core-ventiq' ) . $this->ptSingularName . esc_html__( ' Category', 'mascot-core-ventiq' ),
			'separate_items_with_commas'=> esc_html__( 'Separate items with commas', 'mascot-core-ventiq' ),
			'add_or_remove_items'		=> esc_html__( 'Add or remove items', 'mascot-core-ventiq' ),
			'choose_from_most_used'		=> esc_html__( 'Choose from the most used', 'mascot-core-ventiq' ),
			'popular_items'				=> esc_html__( 'Popular Items', 'mascot-core-ventiq' ),
			'search_items'				=> esc_html__( 'Search Items', 'mascot-core-ventiq' ),
			'not_found'					=> esc_html__( 'Not Found', 'mascot-core-ventiq' ),
			'no_terms'					=> esc_html__( 'No items', 'mascot-core-ventiq' ),
			'items_list'				=> esc_html__( 'Items list', 'mascot-core-ventiq' ),
			'items_list_navigation'		=> esc_html__( 'Items list navigation', 'mascot-core-ventiq' ),
		);
		$args = array(
			'labels'					=> $labels,
			'hierarchical'				=> true,
			'public'					=> true,
			'show_ui'					=> true,
			'show_admin_column'			=> true,
			'show_in_nav_menus'			=> true,
			'show_tagcloud'				=> true,
			'rewrite'					=> array( 'slug' => $this->ptTaxKeyRewriteBase, 'with_front' => false ),
		);
		register_taxonomy( $this->ptTaxKey, array( $this->ptKey ), $args );
	}

	/**
	 * Regsiters custom Tag Taxonomy
	 */
	private function registerCustomTaxTag() {

		$labels = array(
			'name'						=> _x( 'Portfolio Items Tags', 'Taxonomy General Name', 'mascot-core-ventiq' ),
			'singular_name'				=> _x( 'Portfolio Item Tag', 'Taxonomy Singular Name', 'mascot-core-ventiq' ),
			'menu_name'					=> $this->ptPluralName . esc_html__( ' Tags', 'mascot-core-ventiq' ),
			'all_items'					=> esc_html__( 'All ', 'mascot-core-ventiq' ) . $this->ptPluralName . esc_html__( 'Tags', 'mascot-core-ventiq' ),
			'parent_item'				=> esc_html__( 'Parent Item', 'mascot-core-ventiq' ),
			'parent_item_colon'			=> esc_html__( 'Parent Item:', 'mascot-core-ventiq' ),
			'new_item_name'				=> esc_html__( 'New ', 'mascot-core-ventiq' ) . $this->ptSingularName . ' ' . esc_html__( 'Tag', 'mascot-core-ventiq' ),
			'add_new_item'				=> esc_html__( 'Add ', 'mascot-core-ventiq' ) . $this->ptSingularName . ' ' . esc_html__( 'Tag', 'mascot-core-ventiq' ),
			'edit_item'					=> esc_html__( 'Edit ', 'mascot-core-ventiq' ) . $this->ptSingularName . ' ' . esc_html__( 'Tag', 'mascot-core-ventiq' ),
			'update_item'				=> esc_html__( 'Update ', 'mascot-core-ventiq' ) . $this->ptSingularName . ' ' . esc_html__( 'Tag', 'mascot-core-ventiq' ),
			'view_item'					=> esc_html__( 'View ', 'mascot-core-ventiq' ) . $this->ptSingularName . ' ' . esc_html__( 'Tag', 'mascot-core-ventiq' ),
			'separate_items_with_commas'=> esc_html__( 'Separate items with commas', 'mascot-core-ventiq' ),
			'add_or_remove_items'		=> esc_html__( 'Add or remove items', 'mascot-core-ventiq' ),
			'choose_from_most_used'		=> esc_html__( 'Choose from the most used', 'mascot-core-ventiq' ),
			'popular_items'				=> esc_html__( 'Popular Items', 'mascot-core-ventiq' ),
			'search_items'				=> esc_html__( 'Search Items', 'mascot-core-ventiq' ),
			'not_found'					=> esc_html__( 'Not Found', 'mascot-core-ventiq' ),
			'no_terms'					=> esc_html__( 'No items', 'mascot-core-ventiq' ),
			'items_list'				=> esc_html__( 'Items list', 'mascot-core-ventiq' ),
			'items_list_navigation'		=> esc_html__( 'Items list navigation', 'mascot-core-ventiq' ),
		);
		$args = array(
			'labels'					=> $labels,
			'hierarchical'				=> true,
			'public'					=> true,
			'show_ui'					=> true,
			'show_admin_column'			=> true,
			'show_in_nav_menus'			=> true,
			'show_tagcloud'				=> true,
			'rewrite'					=> array( 'slug' => $this->ptTagTaxKeyRewriteBase, 'with_front' => false ),
		);
		register_taxonomy( $this->ptTagTaxKey, array( $this->ptKey ), $args );
	}

	/**
	 * Custom Columns Settings
	 */
	public function customColumnsSettings( $columns ) {

		$columns = array(
			'cb'			=> '<input type="checkbox" />',
			'title'			=> esc_html__( 'Title', 'mascot-core-ventiq' ),
			'thumbnail'		=> esc_html__( 'Thumbnail', 'mascot-core-ventiq' ),
			'img_size'		=> esc_html__( 'Masonry Mode Image Size', 'mascot-core-ventiq' ),
			'category'		=> esc_html__( 'Category', 'mascot-core-ventiq' ),
			'tag'			=> esc_html__( 'Tags', 'mascot-core-ventiq' ),
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
			case 'category' :
				$taxonomy = $this->ptTaxKey;
				$post_type = get_post_type( $post->ID );
				$terms = get_the_terms( $post->ID, $taxonomy );

				if ( ! empty( $terms ) ) {
					foreach ( $terms as $term ) {
						$post_terms[] = "<a href='edit.php?post_type={$post_type}&{$taxonomy}={$term->slug}'> " . esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, $taxonomy, 'edit' ) ) . "</a>";
					}
					echo join( ', ', $post_terms );
				}
				else echo '<i>No categories.</i>';
			break;

			case 'tag' :
				$taxonomy = $this->ptTagTaxKey;
				$post_type = get_post_type( $post->ID );
				$terms = get_the_terms( $post->ID, $taxonomy );

				if ( ! empty( $terms ) ) {
					foreach ( $terms as $term ) {
						$post_terms[] = "<a href='edit.php?post_type={$post_type}&{$taxonomy}={$term->slug}'> " . esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, $taxonomy, 'edit' ) ) . "</a>";
					}
					echo join( ', ', $post_terms );
				}
				else echo '<i>No tags.</i>';
			break;

			case 'thumbnail' :
				echo get_the_post_thumbnail( $post->ID, array( 64, 64 ) );
			break;

			case 'img_size' :
				if( mascot_core_ventiq_theme_installed() ) {
					$image_size = ventiq_get_rwmb_group( 'ventiq_' . 'portfolio_mb_gallery_images_settings', 'masonry_tiles_featured_image_size', $post->ID );
					echo $this->masonry_mode_image_size[ $image_size ];
				}
			break;

			default :
			break;
		}
	}

	/**
	 * Registers Meta Boxes
	 */
	public function regMetaBoxes( $meta_boxes ) {
		// Meta Box Settings for this Page
		$meta_boxes[] = array(
			'title'		=> esc_html__( 'Portfolio Settings', 'mascot-core-ventiq' ),
			'post_types' => $this->ptKey,
			'priority'   => 'high',

			// List of tabs, in one of the following formats:
			// 1) key => label
			// 2) key => array( 'label' => Tab label, 'icon' => Tab icon )
			'tabs'		=> array(
				'gallery_images' => array(
					'label' => esc_html__( 'Gallery Images', 'mascot-core-ventiq' ),
					'icon'  => 'dashicons-screenoptions', // Dashicon
				),
				'layout' => array(
					'label' => esc_html__( 'Layout', 'mascot-core-ventiq' ),
					'icon'  => 'dashicons-screenoptions', // Dashicon
				),
				'checklist' => array(
					'label' => esc_html__( 'Checklist', 'mascot-core-ventiq' ),
					'icon'  => 'dashicons-screenoptions', // Dashicon
				),
				'project_link' => array(
					'label' => esc_html__( 'Project Link', 'mascot-core-ventiq' ),
					'icon'  => 'dashicons-screenoptions', // Dashicon
				),
				'other' => array(
					'label' => esc_html__( 'Other Settings', 'mascot-core-ventiq' ),
					'icon'  => 'dashicons-screenoptions', // Dashicon
				),
			),

			// Tab style: 'default', 'box' or 'left'. Optional
			'tab_style' => 'left',

			// Show meta box wrapper around tabs? true (default) or false. Optional
			'tab_wrapper' => true,

			'fields'	=> array(
				array(
					'id'     => 'ventiq_' . 'portfolio_mb_gallery_images_settings',
					// Group field
					'type'   => 'group',
					// Clone whole group?
					'clone'  => false,
					// Drag and drop clones to reorder them?
					'sort_clone' => false,
					// tab
					'tab'  => 'gallery_images',
					// Sub-fields
					'fields' => array(
						//gallery_images tab starts
						array(
							'type' => 'heading',
							'name' => esc_html__( 'Portfolio Gallery Images', 'mascot-core-ventiq' ),
							'desc' => esc_html__( 'Changes of the following settings will be effective only for this page.', 'mascot-core-ventiq' ),
							'tab'  => 'gallery_images',
						),
						array(
							'name'		=> esc_html__( 'Featured Image Size in Masonry Tiles Mode', 'mascot-core-ventiq' ),
							'id'		=> 'masonry_tiles_featured_image_size',
							'type'		=> 'select',
							'options'   => $this->masonry_mode_image_size,
							'tab'		=> 'gallery_images',
						),
						array(
							'id'   => 'gallery_images',
							'name' => esc_html__( 'Portfolio Gallery Images', 'mascot-core-ventiq' ),
							'desc' => esc_html__( 'Choose your portfolio images.', 'mascot-core-ventiq' ),
							'type' => 'image_advanced',
							'tab'  => 'gallery_images',
						),
						//gallery_images tab ends
					),
				),
				array(
					'id'     => 'ventiq_' . 'portfolio_mb_layout_settings',
					// Group field
					'type'   => 'group',
					// Clone whole group?
					'clone'  => false,
					// Drag and drop clones to reorder them?
					'sort_clone' => false,
					// tab
					'tab'  => 'layout',
					// Sub-fields
					'fields' => array(
						//layout tab starts
						array(
							'type' => 'heading',
							'name' => esc_html__( 'Portfolio Layout Type', 'mascot-core-ventiq' ),
							'desc' => esc_html__( 'Changes of the following settings will be effective only for this page.', 'mascot-core-ventiq' ),
							'tab'  => 'layout',
						),
						array(
							'name'		=> esc_html__( 'Fullwidth?', 'mascot-core-ventiq' ),
							'id'		=> 'fullwidth',
							'type'		=> 'select',
							'desc'		=> esc_html__( 'Make the page fullwidth or not..', 'mascot-core-ventiq' ),
							'options'   => array(
								'inherit'   => esc_html__( 'Inherit from Theme Options', 'mascot-core-ventiq' ),
								'1'		=> esc_html__( 'Yes', 'mascot-core-ventiq' ),
								'0'		=> esc_html__( 'No', 'mascot-core-ventiq' ),
							),
							'tab'		=> 'layout',
						),
						array(
							'name'	=> esc_html__( 'Portfolio Details Type', 'mascot-core-ventiq' ),
							'id'		=> 'portfolio_details_type',
							'type'	=> 'image_select',
							'options' => array(
								'inherit'				=> MASCOT_ADMIN_ASSETS_URI . '/images/portfolio-single/type/inherit.png',
								'small-image'			=> MASCOT_ADMIN_ASSETS_URI . '/images/portfolio-single/type/small-image.png',
								'small-image-slider'	=> MASCOT_ADMIN_ASSETS_URI . '/images/portfolio-single/type/small-image-slider.png',
								'small-image-gallery'   => MASCOT_ADMIN_ASSETS_URI . '/images/portfolio-single/type/small-image-gallery.png',
								'big-image'			=> MASCOT_ADMIN_ASSETS_URI . '/images/portfolio-single/type/big-image.png',
								'big-image-slider'		=> MASCOT_ADMIN_ASSETS_URI . '/images/portfolio-single/type/big-image-slider.png',
								'big-image-gallery'	 => MASCOT_ADMIN_ASSETS_URI . '/images/portfolio-single/type/big-image-gallery.png',
							),
							'std'	 => 'inherit',
							'tab'	 => 'layout',
						),
						//layout tab ends
					),
				),
				array(
					'id'     => 'ventiq_' . 'portfolio_mb_checklist_settings',
					// Group field
					'type'   => 'group',
					// Clone whole group?
					'clone'  => false,
					// Drag and drop clones to reorder them?
					'sort_clone' => false,
					// tab
					'tab'  => 'checklist',
					// Sub-fields
					'fields' => array(
						//checklist tab starts
						array(
							'type' => 'heading',
							'name' => esc_html__( 'Portfolio Checklist', 'mascot-core-ventiq' ),
							'desc' => esc_html__( 'Changes of the following settings will be effective only for this page.', 'mascot-core-ventiq' ),
							'tab'  => 'checklist',
						),
						array(
							'id'	 => 'checklist',
							// Group field
							'type'   => 'group',
							// Clone whole group?
							'clone'  => true,
							// Drag and drop clones to reorder them?
							'sort_clone' => true,
							// Sub-fields
							'fields' => array(
								array(
									'name' => esc_html__( 'Checklist Title', 'mascot-core-ventiq' ),
									'id'   => 'checklist_title',
									'type' => 'text',
									'desc' => esc_html__( 'Title to describe the checklist items. Example: Skills.', 'mascot-core-ventiq' ),
								),
								array(
									'name' => esc_html__( 'Checklist Details', 'mascot-core-ventiq' ),
									'id'   => 'checklist_details',
									'type' => 'textarea',
									'desc' => esc_html__( 'Details of the checklist. Example: HTML, CSS & WordPress.', 'mascot-core-ventiq' ),
								),
							),
							'tab'  => 'checklist',
						),
						//checklist tab ends
					),
				),
				array(
					'id'     => 'ventiq_' . 'portfolio_mb_project_link_settings',
					// Group field
					'type'   => 'group',
					// Clone whole group?
					'clone'  => false,
					// Drag and drop clones to reorder them?
					'sort_clone' => false,
					// tab
					'tab'  => 'project_link',
					// Sub-fields
					'fields' => array(
						//project_link tab starts
						array(
							'type' => 'heading',
							'name' => esc_html__( 'Project Link', 'mascot-core-ventiq' ),
							'desc' => esc_html__( 'Changes of the following settings will be effective only for this page.', 'mascot-core-ventiq' ),
							'tab'  => 'project_link',
						),
						array(
							'name'		=> esc_html__( 'Project Link Title', 'mascot-core-ventiq' ),
							'id'		=> 'project_link_title',
							'desc'		=> esc_html__( 'The custom project text that will link.', 'mascot-core-ventiq' ),
							'type'		=> 'text',
							'tab'		=> 'project_link',
						),
						array(
							'name'		=> esc_html__( 'Project URL', 'mascot-core-ventiq' ),
							'id'		=> 'project_link_url',
							'desc'		=> esc_html__( 'The URL the project text links to.', 'mascot-core-ventiq' ),
							'type'		=> 'text',
							'tab'		=> 'project_link',
						),
						array(
							'name'		=> esc_html__( 'Project Link Target', 'mascot-core-ventiq' ),
							'id'		=> 'project_link_target',
							'desc'		=> esc_html__( 'Open in new window.', 'mascot-core-ventiq' ),
							'type'		=> 'checkbox',
							'tab'		=> 'project_link',
						),
						//project_link tab ends
					),
				),
				array(
					'id'     => 'ventiq_' . 'portfolio_mb_other_settings',
					// Group field
					'type'   => 'group',
					// Clone whole group?
					'clone'  => false,
					// Drag and drop clones to reorder them?
					'sort_clone' => false,
					// tab
					'tab'  => 'other',
					// Sub-fields
					'fields' => array(
						//other tab starts
						array(
							'type' => 'heading',
							'name' => esc_html__( 'Portfolio Meta', 'mascot-core-ventiq' ),
							'desc' => esc_html__( 'Changes of the following settings will be effective only for this page.', 'mascot-core-ventiq' ),
							'tab'  => 'other',
						),
						array(
							'name'		=> esc_html__( 'Portfolio Meta', 'mascot-core-ventiq' ),
							'id'		=> 'portfolio_meta',
							'type'		=> 'select',
							'desc'		=> esc_html__( 'Enable/Disabling this option will show/hide each Portfolio Meta on your Portfolio Details Page', 'mascot-core-ventiq' ),
							'options'   => array(
								'inherit'				=> esc_html__( 'Inherit from Theme Options', 'mascot-core-ventiq' ),
								'show-post-by-author'	=> esc_html__( 'Show By Author', 'mascot-core-ventiq' ),
								'show-post-date'		=> esc_html__( 'Show Date', 'mascot-core-ventiq' ),
								'show-post-date-split'	=> esc_html__( 'Show Date Split', 'mascot-core-ventiq' ),
								'show-post-category'	=> esc_html__( 'Show Category', 'mascot-core-ventiq' ),
								'show-post-tag'			=> esc_html__( 'Show Tag', 'mascot-core-ventiq' ),
								'show-post-checklist-custom-fields'	 => esc_html__( 'Show Checklist Custom Fields', 'mascot-core-ventiq' ),
							),
							'multiple'  => true,
							'std'		=> array(
								'inherit'
							),
							'tab'		=> 'other',
						),
						array(
							'name'		=> esc_html__( 'Show Share?', 'mascot-core-ventiq' ),
							'id'		=> 'show_share',
							'type'		=> 'select',
							'desc'		=> esc_html__( 'Enable/Disabling this option will show/hide share options on your page.', 'mascot-core-ventiq' ),
							'options'   => array(
								'inherit'   => esc_html__( 'Inherit from Theme Options', 'mascot-core-ventiq' ),
								'1'		=> esc_html__( 'Yes', 'mascot-core-ventiq' ),
								'0'		=> esc_html__( 'No', 'mascot-core-ventiq' ),
							),
							'tab'		=> 'other',
						),
						array(
							'name'		=> esc_html__( 'Show Next/Previous Single Post Navigation Link', 'mascot-core-ventiq' ),
							'id'		=> 'show_next_pre_post_link',
							'type'		=> 'select',
							'desc'		=> esc_html__( 'Enable/Disabling this option will show/hide link for Next & Previous Posts.', 'mascot-core-ventiq' ),
							'options'   => array(
								'inherit'   => esc_html__( 'Inherit from Theme Options', 'mascot-core-ventiq' ),
								'1'		=> esc_html__( 'Yes', 'mascot-core-ventiq' ),
								'0'		=> esc_html__( 'No', 'mascot-core-ventiq' ),
							),
							'tab'		=> 'other',
						),
						array(
							'name'		=> esc_html__( 'Show Related Portfolio Items', 'mascot-core-ventiq' ),
							'id'		=> 'show_related_posts',
							'type'		=> 'select',
							'desc'		=> esc_html__( 'Enable/Disabling this option will show/hide Related Posts List/Carousel on your page.', 'mascot-core-ventiq' ),
							'options'   => array(
								'inherit'   => esc_html__( 'Inherit from Theme Options', 'mascot-core-ventiq' ),
								'1'		=> esc_html__( 'Yes', 'mascot-core-ventiq' ),
								'0'		=> esc_html__( 'No', 'mascot-core-ventiq' ),
							),
							'tab'		=> 'other',
						),
						array(
							'name'		=> esc_html__( 'Show Comments', 'mascot-core-ventiq' ),
							'id'		=> 'show_comments',
							'type'		=> 'select',
							'desc'		=> esc_html__( 'Enable/Disabling this option will show/hide Comments on your page.', 'mascot-core-ventiq' ),
							'options'   => array(
								'inherit'   => esc_html__( 'Inherit from Theme Options', 'mascot-core-ventiq' ),
								'1'		=> esc_html__( 'Yes', 'mascot-core-ventiq' ),
								'0'		=> esc_html__( 'No', 'mascot-core-ventiq' ),
							),
							'tab'		=> 'other',
						),
						//other tab ends
					),
				),
			),
		);

		return $meta_boxes;
	}

}