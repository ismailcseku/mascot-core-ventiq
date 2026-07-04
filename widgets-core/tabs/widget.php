<?php
namespace MascotCoreVentiq\Widgets\Tabs;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Icons_Manager;
use Elementor\Control_Media;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TM_Elementor_Tabs extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		$direction_suffix = is_rtl() ? '.rtl' : '';

		wp_register_style( 'tm-tabs-style', MASCOT_CORE_VENTIQ_ASSETS_URI . '/css/widgets-core/tabs' . $direction_suffix . '.css' );
	}

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'tm-ele-tabs';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'TM Tabs', 'mascot-core-ventiq' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'tm-elementor-widget-icon';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'tm' ];
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'mascot-core-hellojs' ];
	}

	public function get_style_depends() {
		return [ 'tm-tabs-style' ];
	}

	/**
	 * Skins
	 */
	protected function register_skins() {
		$this->add_skin( new Skins\Skin_Left_Nav( $this ) );
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'tm_general',
			[
				'label' => esc_html__( 'General', 'mascot-core-ventiq' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'custom_css_class',
			[
				'label' => esc_html__( "Custom CSS class", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);



		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'title',
			[
				'label' => esc_html__( "Title", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		$repeater->add_control(
			'expand',
			[
				'label' => esc_html__( "Make It Active/Expand?", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no'
			]
		);
		$repeater->add_control(
			'tabs_tab_icon_type',
			[
				'label' => esc_html__( 'Add Icon/Image', 'mascot-core-ventiq' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'' => [
						'title' => esc_html__( 'None', 'mascot-core-ventiq' ),
						'icon' => 'fa fa-ban',
					],
					'font' => [
						'title' => esc_html__( 'Icon', 'mascot-core-ventiq' ),
						'icon' => 'far fa-smile',
					],
					'image' => [
						'title' => esc_html__( 'Image', 'mascot-core-ventiq' ),
						'icon' => 'fa fa-image',
					]
				],
				'default' => '',
			]
		);
		$repeater->add_control(
			'tabs_tab_icon_fontawesome',
			[
				'label' => esc_html__('Icon', 'mascot-core-ventiq'),
				'type' => Controls_Manager::ICONS,
				'label_block' => true,
				'condition' => [
					'tabs_tab_icon_type' => 'font',
				],
				'description' => esc_html__('Select icon from Fontawesome library.', 'mascot-core-ventiq'),
			]
		);
		$repeater->add_control(
			'tabs_tab_icon_thumbnail',
			[
				'label' => esc_html__('Image', 'mascot-core-ventiq'),
				'type' => Controls_Manager::MEDIA,
				'label_block' => true,
				'condition' => [
					'tabs_tab_icon_type' => 'image',
				],
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$repeater->add_control(
			'tabs_content_type',
			[
				'label' => esc_html__('Content Type', 'mascot-core-ventiq'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'content' => esc_html__('Content', 'mascot-core-ventiq'),
					'template' => esc_html__('Elementor Templates', 'mascot-core-ventiq'),
				],
				'default' => 'content',
			]
		);
		$repeater->add_control(
			'tabs_content_templates',
			[
				'label' => esc_html__('Choose Elementor Template', 'mascot-core-ventiq'),
				'type' => Controls_Manager::SELECT,
				'options' => mascot_core_ventiq_get_elementor_templates(),
				'condition' => [
					'tabs_content_type' => 'template',
				],
			]
		);
		$repeater->add_control(
			'tabs_content',
			[
				'label' => esc_html__('Tab Content', 'mascot-core-ventiq'),
				'type' => Controls_Manager::WYSIWYG,
				'default' => esc_html__( "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.", 'mascot-core-ventiq' ),
				'dynamic' => [ 'active' => true ],
				'condition' => [
					'tabs_content_type' => 'content',
				],
			]
		);
		$this->add_control(
			'tabs_items',
			[
				'label' => esc_html__( "Item", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'title_field' => '{{{ title }}}',
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => __( 'Title 1', 'mascot-core-ventiq' ),
						'expand' => 'yes',
					],
					[
						'title' => __( 'Title 2', 'mascot-core-ventiq' ),
					],
					[
						'title' => __( 'Title 3', 'mascot-core-ventiq' ),
					],
				],
			]
		);
		$this->end_controls_section();






		$this->start_controls_section(
			'title_vertical_flex_settings',
			[
				'label' => esc_html__( 'Tab Block - Width/Alignment', 'mascot-core-ventiq' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'_skin' => '',
				],
			]
		);
		$this->add_control(
			'tabs_link_z_index',
			[
				'label' => esc_html__( "Z Index", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'selectors' => [
					'{{WRAPPER}} .nav-tabs > li' => 'z-index: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
			'title_wrapper_flex_horizontal',
			[
				'label' => esc_html__( "Horizontal Alignment", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_ventiq_disply_flex_horizontal_align_elementor(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .nav-tabs' => 'display:flex; justify-content: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_wrapper_title_block_each_width',
			[
				'label' => esc_html__( "Each Tab Block Width", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'unit' => '%',
				],
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 500,
						'step' => 1,
					],
					'%' => [
						'min' => 5,
						'max' => 100,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .nav-tabs .nav-item' => 'width: {{SIZE}}{{UNIT}};'
				]
			]
		);
		$this->add_responsive_control(
			'title_wrapper_margin',
			[
				'label' => esc_html__( 'Margin', 'mascot-core-ventiq' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .nav-tabs' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_wrapper_padding',
			[
				'label' => esc_html__( 'Block Padding', 'mascot-core-ventiq' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .nav-tabs' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'title_block_boxshadow',
				'label' => esc_html__( 'Box Shadow', 'mascot-core-ventiq' ),
				'selector' => '{{WRAPPER}} .nav-tabs ',
			]
		);
		$this->add_control(
			'title_wrapper_bg_color_options',
			[
				'label' => esc_html__( 'Background Color Options', 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'title_wrapper_custom_bg_color',
			[
				'label' => esc_html__( "Custom Background Color", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .nav-tabs' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'title_wrapper_bg_theme_colored',
			[
				'label' => esc_html__( "Background Theme Colored", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_ventiq_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .nav-tabs ' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'title_wrapper_border_color_options',
			[
				'label' => esc_html__( 'Border Options', 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'title_wrapper_border',
				'label' => esc_html__( 'Border', 'mascot-core-ventiq' ),
				'selector' => '{{WRAPPER}} .nav-tabs ',
			]
		);
		$this->add_responsive_control(
			'title_wrapper_border_theme_colored_normal', [
				'label' => esc_html__( "Border Theme Colored", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_ventiq_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .nav-tabs ' => 'border-color: var(--theme-color{{VALUE}}) !important;'
				],
			]
		);
		$this->add_responsive_control(
			'title_wrapper_border_radius',
			[
				'label' => esc_html__( "Block Border Radius", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .nav-tabs ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_control(
			'title_icon_vertical_flex_options',
			[
				'label' => esc_html__( 'Each Title + Icon/Image Alignment', 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'tabs_icon_position',
			[
				'label' => esc_html__('Icon/Image & Title Position', 'mascot-core-ventiq'),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'column' => [
						'title' => esc_html__( 'Top', 'mascot-core-ventiq' ),
						'icon' => 'eicon-v-align-top',
					],
					'row-reverse' => [
						'title' => esc_html__( 'Right', 'mascot-core-ventiq' ),
						'icon' => 'eicon-h-align-right',
					],
					'column-reverse' => [
						'title' => esc_html__( 'Bottom', 'mascot-core-ventiq' ),
						'icon' => 'eicon-v-align-bottom',
					],
					'row' => [
						'title' => esc_html__( 'Left', 'mascot-core-ventiq' ),
						'icon' => 'eicon-h-align-left',
					]
				],
				'selectors' => [
					'{{WRAPPER}} .nav-tabs .nav-link' => 'display:flex; flex-direction: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_block_alignment',
			[
				'label' => esc_html__( "Text Alignment", 'mascot-core-ventiq' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => mascot_core_ventiq_text_align_choose(),
				'selectors' => [
					'{{WRAPPER}} .nav-tabs .nav-link' => 'text-align: {{VALUE}};'
				],
				'default' => 'center',
			]
		);
		$this->add_responsive_control(
			'title_flex_vertical',
			[
				'label' => esc_html__( "Title + Icon Vertical Alignment", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_ventiq_disply_flex_vertical_align_elementor(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .nav-tabs .nav-link' => 'display:flex; align-items: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_flex_horizontal',
			[
				'label' => esc_html__( "Title + Icon Horizontal Alignment", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_ventiq_disply_flex_horizontal_align_elementor(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .nav-tabs .nav-link' => 'display:flex; justify-content: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();











		$this->start_controls_section(
			'title_block_section_styling',
			[
				'label' => esc_html__( 'Tab Block - Styling', 'mascot-core-ventiq' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'_skin' => '',
				],
			]
		);
		$this->start_controls_tabs('tabs_title_block_style');
		$this->start_controls_tab(
			'title_block_style_normal',
			[
				'label' => esc_html__('Idle', 'mascot-core-ventiq'),
			]
		);
		$this->add_control(
			'title_block_bg_color_options',
			[
				'label' => esc_html__( 'Background Color Options', 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'title_block_custom_bg_color',
			[
				'label' => esc_html__( "Custom Background Color", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .nav-tabs .nav-link' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'title_block_bg_theme_colored',
			[
				'label' => esc_html__( "Background Theme Colored", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_ventiq_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .nav-tabs .nav-link' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);


		// 1. ON/OFF Switch to Enable Gradient Background
		$this->add_control(
			'enable_title_block_bg_gradient',
			[
				'label'        => esc_html__( 'Enable Background Gradient', 'mascot-core-ventiq' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'mascot-core-ventiq' ),
				'label_off'    => esc_html__( 'Off', 'mascot-core-ventiq' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		// 2. Gradient Selector (Only Visible When Switch is ON)
		$this->add_responsive_control(
			'title_block_bg_gradient',
			[
				'label'   => esc_html__( "Background Gradient", 'mascot-core-ventiq' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'linear-gradient(99deg, var(--theme-color1) 0%, var(--theme-color2) 93.92%)' => esc_html__('Gradient One', 'mascot-core-ventiq'),
					'linear-gradient(99deg, var(--theme-color2) 0%, var(--theme-color3) 93.92%)' => esc_html__('Gradient Two', 'mascot-core-ventiq'),
					'linear-gradient(99deg, var(--theme-color3) 0%, var(--theme-color4) 93.92%)' => esc_html__('Gradient Three', 'mascot-core-ventiq'),
				],
				'default'   => 'linear-gradient(99deg, var(--theme-color1) 0%, var(--theme-color2) 93.92%)',
				'selectors' => [
					'{{WRAPPER}} .nav-tabs .nav-link' => 'background: {{VALUE}};',
				],
				'condition' => [
					'enable_title_block_bg_gradient' => 'yes',
				],
			]
		);



// 1. Enable switch
$this->add_control(
	'enable_title_block_background',
	[
		'label'        => esc_html__( 'Enable Title Block Background', 'mascot-core-ventiq' ),
		'type'         => \Elementor\Controls_Manager::SWITCHER,
		'label_on'     => esc_html__( 'On', 'mascot-core-ventiq' ),
		'label_off'    => esc_html__( 'Off', 'mascot-core-ventiq' ),
		'return_value' => 'yes',
		'default'      => '',
	]
);

// 2. Type selector (Solid / Gradient)
$this->add_control(
	'title_block_bg_type',
	[
		'label'     => esc_html__( 'Title Block Background Type', 'mascot-core-ventiq' ),
		'type'      => \Elementor\Controls_Manager::SELECT,
		'default'   => 'solid',
		'options'   => [
			'solid'    => esc_html__( 'Solid', 'mascot-core-ventiq' ),
			'gradient' => esc_html__( 'Gradient', 'mascot-core-ventiq' ),
		],
		'condition' => [
			'enable_title_block_background' => 'yes',
		],
	]
);

// 3. Solid background color (only if solid selected)
$this->add_control(
	'title_block_bg_color',
	[
		'label'     => esc_html__( 'Title Block BG Color', 'mascot-core-ventiq' ),
		'type'      => \Elementor\Controls_Manager::COLOR,
		'selectors' => [
			'{{WRAPPER}} .nav-tabs .nav-link' => 'background-color: {{VALUE}};',
		],
		'condition' => [
			'enable_title_block_background' => 'yes',
			'title_block_bg_type'           => 'solid',
		],
	]
);

// 4. Gradient background (only if gradient selected)
$this->add_group_control(
	\Elementor\Group_Control_Background::get_type(),
	[
		'name'     => 'title_block_bg_gradient',
		'label'    => esc_html__( 'Title Block Gradient Background', 'mascot-core-ventiq' ),
		'types'    => [ 'gradient' ],
		'selector' => '{{WRAPPER}} .nav-tabs .nav-link',
		'condition' => [
			'enable_title_block_background' => 'yes',
			'title_block_bg_type'           => 'gradient',
		],
	]
);






		$this->add_responsive_control(
			'title_block_margin',
			[
				'label' => esc_html__( 'Block Margin', 'mascot-core-ventiq' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .nav-tabs .nav-link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'title_block_padding',
			[
				'label' => esc_html__( 'Block Padding', 'mascot-core-ventiq' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .nav-tabs .nav-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_block_border_radius',
			[
				'label' => esc_html__( "Block Border Radius", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .nav-tabs .nav-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'title_block_boxshadow',
				'label' => esc_html__( 'Box Shadow', 'mascot-core-ventiq' ),
				'selector' => '{{WRAPPER}} .nav-tabs .nav-link',
			]
		);
		$this->add_control(
			'title_block_border_color_options',
			[
				'label' => esc_html__( 'Border Options', 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'title_block_border',
				'label' => esc_html__( 'Border', 'mascot-core-ventiq' ),
				'selector' => '{{WRAPPER}} .nav-tabs .nav-link',
			]
		);
		$this->add_responsive_control(
			'title_block_border_color_normal', [
				'label' => esc_html__( "Border Color", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .nav-tabs .nav-link' => 'border-color: {{VALUE}} !important;'
				]
			]
		);
		$this->add_responsive_control(
			'title_block_border_theme_colored_normal', [
				'label' => esc_html__( "Border Theme Colored", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_ventiq_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .nav-tabs .nav-link' => 'border-color: var(--theme-color{{VALUE}}) !important;'
				],
			]
		);
		$this->add_control(
			'title_block_falling_shutter_height',
			[
				'label' => esc_html__( "Falling Shutter Height", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'default' => [
					'unit' => '%',
				],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .nav-tabs .nav-link:not(.active):not(:hover):before' => 'height: {{SIZE}}{{UNIT}};'
				]
			]
		);
		$this->add_responsive_control(
			'title_block_width',
			[
				'label' => esc_html__('Button Width', 'mascot-core-ventiq'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 26,
					'unit' => 'px',
				],
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .nav-tabs .nav-link' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_block_height',
			[
				'label' => esc_html__('Button Height', 'mascot-core-ventiq'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 38,
					'unit' => 'px',
				],
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .nav-tabs .nav-link' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_block_line_height',
			[
				'label' => esc_html__('Button Line Height', 'mascot-core-ventiq'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 38,
					'unit' => 'px',
				],
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .nav-tabs .nav-link' => 'line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_before_show',
			[
				'label' => esc_html__( 'Show/Hide Bg Before', 'mascot-core-ventiq' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Hide', 'mascot-core-ventiq' ),
				'label_off' => __( 'Show', 'mascot-core-ventiq' ),
				'selectors' => [
					'{{WRAPPER}} .nav-tabs .nav-link:before' => 'display: none;',
				],
			]
		);
		$this->end_controls_tab();


		$this->start_controls_tab(
			'title_block_style_active',
			[
				'label' => esc_html__('Active', 'mascot-core-ventiq'),
			]
		);
		$this->add_control(
			'title_block_bg_color_options_active',
			[
				'label' => esc_html__( 'Background Color Options', 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'title_block_custom_bg_color_active',
			[
				'label' => esc_html__( "Custom Background Color", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .nav-tabs .nav-link.active:before' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'title_block_bg_theme_colored_active',
			[
				'label' => esc_html__( "Background Theme Colored", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_ventiq_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .nav-tabs .nav-link.active:before' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'title_block_boxshadow_active',
				'label' => esc_html__( 'Box Shadow', 'mascot-core-ventiq' ),
				'selector' => '{{WRAPPER}} .nav-tabs .nav-link.active',
			]
		);
		$this->add_control(
			'title_block_border_color_options_active',
			[
				'label' => esc_html__( 'Border Color Options', 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'title_block_border_color_active', [
				'label' => esc_html__( "Border Color", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .nav-tabs .nav-link.active' => 'border-color: {{VALUE}} !important;'
				]
			]
		);
		$this->add_responsive_control(
			'title_block_border_theme_colored_active', [
				'label' => esc_html__( "Border Theme Colored", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_ventiq_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .nav-tabs .nav-link.active' => 'border-color: var(--theme-color{{VALUE}}) !important;'
				],
			]
		);
		$this->add_control(
			'title_block_falling_shutter_height_active',
			[
				'label' => esc_html__( "Falling Shutter Height", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'default' => [
					'unit' => '%',
				],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .nav-tabs .nav-link.active:before' => 'height: {{SIZE}}{{UNIT}};'
				]
			]
		);

		// On/Off switch to enable gradient
		$this->add_control(
			'enable_title_block_custom_bg_gradient_active',
			[
				'label'        => esc_html__( 'Enable Gradient Background', 'mascot-core-ventiq' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'mascot-core-ventiq' ),
				'label_off'    => esc_html__( 'Off', 'mascot-core-ventiq' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		// Solid color option (when gradient is off)
		$this->add_responsive_control(
			'title_block_custom_bg_color_active',
			[
				'label' => esc_html__( "Custom Background Color", 'mascot-core-ventiq' ),
				'type'  => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .nav-tabs .nav-link.active:before' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'enable_title_block_custom_bg_gradient_active' => '',
				],
			]
		);

		// Gradient dropdown (when switch is on)
		$this->add_responsive_control(
			'title_block_custom_bg_gradient_active',
			[
				'label'   => esc_html__( "Custom Gradient Background", 'mascot-core-ventiq' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'' => esc_html__('Default', 'mascot-core-ventiq'),
					'linear-gradient(99deg, var(--theme-color1) 0%, var(--theme-color2) 93.92%)' => esc_html__('Gradient One', 'mascot-core-ventiq'),
					'linear-gradient(99deg, var(--theme-color2) 0%, var(--theme-color3) 93.92%)' => esc_html__('Gradient Two', 'mascot-core-ventiq'),
					'linear-gradient(99deg, var(--theme-color3) 0%, var(--theme-color4) 93.92%)' => esc_html__('Gradient Three', 'mascot-core-ventiq'),
				],
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .nav-tabs .nav-link.active:before' => 'background: {{VALUE}};',
				],
				'condition' => [
					'enable_title_block_custom_bg_gradient_active' => 'yes',
				],
			]
		);



		$this->add_control(
			'enable_title_block_active',
			[
				'label'        => esc_html__( 'Enable Active Title Background', 'mascot-core-ventiq' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'mascot-core-ventiq' ),
				'label_off'    => esc_html__( 'Off', 'mascot-core-ventiq' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);
		$this->add_control(
			'title_block_bg_type_active',
			[
				'label'     => esc_html__( 'Active Title Background Type', 'mascot-core-ventiq' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'solid',
				'options'   => [
					'solid'    => esc_html__( 'Solid', 'mascot-core-ventiq' ),
					'gradient' => esc_html__( 'Gradient', 'mascot-core-ventiq' ),
				],
				'condition' => [
					'enable_title_block_active' => 'yes',
				],
			]
		);
		$this->add_control(
			'title_block_custom_bg_color_active',
			[
				'label'     => esc_html__( 'Active Title BG Custom Color', 'mascot-core-ventiq' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .nav-tabs .nav-link.active:before' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'enable_title_block_active' => 'yes',
					'title_block_bg_type_active' => 'solid',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'title_block_gradient_bg_active',
				'label'    => esc_html__( 'Active Title Gradient Background', 'mascot-core-ventiq' ),
				'types'    => [ 'gradient' ],
				'selector' => '{{WRAPPER}} .nav-tabs .nav-link.active:before',
				'condition' => [
					'enable_title_block_active' => 'yes',
					'title_block_bg_type_active' => 'gradient',
				],
			]
		);





		$this->end_controls_tab();




		$this->start_controls_tab(
			'title_block_style_hover',
			[
				'label' => esc_html__('Hover', 'mascot-core-ventiq'),
			]
		);
		$this->add_control(
			'title_block_bg_color_options_hover',
			[
				'label' => esc_html__( 'Background Color Options', 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'title_block_custom_bg_color_hover',
			[
				'label' => esc_html__( "Custom Background Color", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .nav-tabs .nav-link:hover:before' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'title_block_bg_theme_colored_hover',
			[
				'label' => esc_html__( "Background Theme Colored", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_ventiq_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .nav-tabs .nav-link:hover:before' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'title_block_boxshadow_hover',
				'label' => esc_html__( 'Box Shadow', 'mascot-core-ventiq' ),
				'selector' => '{{WRAPPER}} .nav-tabs .nav-link:hover',
			]
		);
		$this->add_control(
			'title_block_border_color_options_hover',
			[
				'label' => esc_html__( 'Border Color Options', 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'title_block_border_color_hover', [
				'label' => esc_html__( "Border Color", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .nav-tabs .nav-link:hover' => 'border-color: {{VALUE}} !important;'
				]
			]
		);
		$this->add_responsive_control(
			'title_block_border_theme_colored_hover', [
				'label' => esc_html__( "Border Theme Colored", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_ventiq_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .nav-tabs .nav-link:hover' => 'border-color: var(--theme-color{{VALUE}}) !important;'
				],
			]
		);
		$this->add_control(
			'title_block_falling_shutter_height_hover',
			[
				'label' => esc_html__( "Falling Shutter Height", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'default' => [
					'unit' => '%',
				],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .nav-tabs .nav-link:hover:before' => 'height: {{SIZE}}{{UNIT}};'
				]
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();











		$this->start_controls_section(
			'title_styling',
			[
				'label' => esc_html__( 'Title (Tab)', 'mascot-core-ventiq' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'_skin' => '',
				],
			]
		);

		$this->start_controls_tabs('tabs_title_style');
		$this->start_controls_tab(
			'title_style_normal',
			[
				'label' => esc_html__('Idle', 'mascot-core-ventiq'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Typography', 'mascot-core-ventiq' ),
				'selector' => '{{WRAPPER}} .nav-tabs .nav-link .tabs-title',
			]
		);
		$this->add_control(
			'title_text_color_options',
			[
				'label' => esc_html__( 'Text Color Options', 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'title_text_color',
			[
				'label' => esc_html__( "Text Color", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .nav-tabs .nav-link .tabs-title' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'title_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_ventiq_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .nav-tabs .nav-link .tabs-title' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_responsive_control(
			'tabs_title_margin',
			[
				'label' => esc_html__('Margin', 'mascot-core-ventiq'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .nav-tabs .nav-link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();


		$this->start_controls_tab(
			'title_style_active',
			[
				'label' => esc_html__('Active', 'mascot-core-ventiq'),
			]
		);
		$this->add_control(
			'title_text_color_options_active',
			[
				'label' => esc_html__( 'Text Color Options', 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'title_text_color_active',
			[
				'label' => esc_html__( "Text Color", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .nav-tabs .nav-link.active .tabs-title' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'title_theme_colored_active',
			[
				'label' => esc_html__( "Text Theme Colored", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_ventiq_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .nav-tabs .nav-link.active .tabs-title' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->end_controls_tab();




		$this->start_controls_tab(
			'title_style_hover',
			[
				'label' => esc_html__('Hover', 'mascot-core-ventiq'),
			]
		);
		$this->add_control(
			'title_text_color_options_hover',
			[
				'label' => esc_html__( 'Text Color Options', 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'title_text_color_hover',
			[
				'label' => esc_html__( "Text Color", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .nav-tabs .nav-link:hover .tabs-title' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'title_theme_colored_hover',
			[
				'label' => esc_html__( "Text Theme Colored", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_ventiq_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .nav-tabs .nav-link:hover .tabs-title' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();


















		/**
		 * STYLE -> ICON
		 */

		$this->start_controls_section(
			'section_style_icon',
			[
				'label' => esc_html__('Icon (Tab)', 'mascot-core-ventiq'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'_skin' => '',
				],
			]
		);
		$this->add_responsive_control(
			'tabs_icon_size',
			[
				'label' => esc_html__('Icon Font Size', 'mascot-core-ventiq'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 26,
					'unit' => 'px',
				],
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tabs-icon:not(.tabs-icon-image)' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'tabs_icon_line_height',
			[
				'label' => esc_html__('Icon Line Height', 'mascot-core-ventiq'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 38,
					'unit' => 'px',
				],
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tabs-icon:not(.tabs-icon-image)' => 'line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'tabs_icon_image_width',
			[
				'label' => esc_html__('Icon Image Width', 'mascot-core-ventiq'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 26,
					'unit' => 'px',
				],
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tabs-icon.tabs-icon-image img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'tabs_icon_margin',
			[
				'label' => esc_html__('Margin', 'mascot-core-ventiq'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .tabs-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_icon_tabs' );
		$this->start_controls_tab(
			'tabs_icon_idle',
			[ 'label' => esc_html__('Idle', 'mascot-core-ventiq') ]
		);
		$this->add_control(
			'tabs_icon_color',
			[
				'label' => esc_html__('Icon Color', 'mascot-core-ventiq'),
				'type' => Controls_Manager::COLOR,
				'dynamic' => ['active' => true],
				'selectors' => [
					'{{WRAPPER}} .tabs-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tabs-icon svg' => 'fill: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'tabs_icon_theme_colored',
			[
				'label' => esc_html__( "Icon Theme Colored", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_ventiq_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tabs-icon' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .tabs-icon svg' => 'fill: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_icon_active',
			[ 'label' => esc_html__('Active', 'mascot-core-ventiq') ]
		);
		$this->add_control(
			'tabs_icon_color_active',
			[
				'label' => esc_html__('Icon Color', 'mascot-core-ventiq'),
				'type' => Controls_Manager::COLOR,
				'dynamic' => ['active' => true],
				'selectors' => [
					'{{WRAPPER}} .nav-link.active .tabs-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .nav-link.active .tabs-icon svg' => 'fill: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'tabs_icon_theme_colored_active',
			[
				'label' => esc_html__( "Icon Theme Colored", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_ventiq_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .nav-link.active .tabs-icon' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .nav-link.active .tabs-icon svg' => 'fill: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_icon_hover',
			[ 'label' => esc_html__('Hover', 'mascot-core-ventiq') ]
		);
		$this->add_control(
			'tabs_icon_color_hover',
			[
				'label' => esc_html__('Icon Color', 'mascot-core-ventiq'),
				'type' => Controls_Manager::COLOR,
				'dynamic' => ['active' => true],
				'selectors' => [
					'{{WRAPPER}} .nav-link:hover .tabs-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .nav-link:hover .tabs-icon svg' => 'fill: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'tabs_icon_theme_colored_hover',
			[
				'label' => esc_html__( "Icon Theme Colored", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_ventiq_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .nav-link:hover .tabs-icon' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .nav-link:hover .tabs-icon svg' => 'fill: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();


		/**
		 * STYLE -> CONTENT
		 */
		$this->start_controls_section(
			'section_style_content',
			[
				'label' => esc_html__('Tab Content', 'mascot-core-ventiq'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'_skin' => '',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'tabs_content_typo',
				'selector' => '{{WRAPPER}} .tab-content .tab-pane',
			]
		);
		$this->add_responsive_control(
			'content_padding',
			[
				'label' => esc_html__('Padding', 'mascot-core-ventiq'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '32',
					'right' => '0',
					'bottom' => '5',
					'left' => '0',
					'unit' => 'px',
					'isLinked' => false
				],
				'selectors' => [
					'{{WRAPPER}} .tab-content .tab-pane' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'tabs_content_margin',
			[
				'label' => esc_html__('Margin', 'mascot-core-ventiq'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .tab-content .tab-pane' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'tabs_content_bg_color',
			[
				'label' => esc_html__('Content Background Color', 'mascot-core-ventiq'),
				'type' => Controls_Manager::COLOR,
				'dynamic' => [ 'active' => true ],
				'selectors' => [
					'{{WRAPPER}} .tab-content .tab-pane' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'tabs_content_bg_theme_colored_hover',
			[
				'label' => esc_html__( "Background Theme Colored", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_ventiq_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tab-content .tab-pane' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'tabs_content_border_radius',
			[
				'label' => esc_html__('Border Radius', 'mascot-core-ventiq'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .tab-content .tab-pane' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'tabs_content_border',
				'selector' => '{{WRAPPER}} .tab-content .tab-pane',
			]
		);
		$this->add_responsive_control(
			'tabs_content_border_theme_colored_hover', [
				'label' => esc_html__( "Border Theme Colored", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_ventiq_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tab-content .tab-pane' => 'border-color: var(--theme-color{{VALUE}}) !important;'
				],
			]
		);
		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$html = '';
		$settings = $this->get_settings_for_display();

		//classes
		$classes = array();
		$classes[] = 'tm-tabs';
		$classes[] = 'tm-tabs-horizontal-nav';
		$classes[] = $settings['custom_css_class'];

		$settings['classes'] = $classes;

		$settings['holder_id'] = mascot_core_ventiq_get_isotope_holder_ID('tabs');
		$settings['rand'] = rand(10,100);
	?>
		<div id="<?php echo esc_attr( $settings['holder_id'] ) ?>" class="<?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>">
		<?php
			if ( $settings['tabs_items'] ) {
				$tab_id_list = array();
				$i=1;
		?>
			<ul class="nav nav-tabs list-unstyled" id="myTab-<?php echo esc_attr($settings['holder_id']); ?>" role="tablist">
			<?php
				foreach (  $settings['tabs_items'] as $item ) {
					$tab_id_list[$i] = 'tab-'.$settings['holder_id'].'-'.$i;
					$settings['title'] = $item['title'];
					$settings['expand'] = $item['expand'];
					$settings['i'] = $i;
					$settings['tab_id_list'] = $tab_id_list;


					$icon_html_code = '';


					// Tab Icon/image
					if ( $item['tabs_tab_icon_type'] != '' ) {
						if ( $item['tabs_tab_icon_type'] == 'font' && ( ! empty( $item['tabs_tab_icon_fontawesome'] ) ) ) {

							$icon_font = $item['tabs_tab_icon_fontawesome'];
							$icon_out = '';
							// add icon migration
							$migrated = isset( $item['__fa4_migrated'][ $item['tabs_tab_icon_fontawesome'] ] );
							$is_new = Icons_Manager::is_migration_allowed();
							if ( $is_new || $migrated ) {
								ob_start();
								Icons_Manager::render_icon( $item['tabs_tab_icon_fontawesome'], [ 'aria-hidden' => 'true' ] );
								$icon_out .= ob_get_clean();
							} else {
								$icon_out .= '<i class="icon ' . esc_attr( $icon_font ) . '"></i>';
							}
							$icon_html_code = '<span class="tabs-icon">' . $icon_out . '</span>';
						}
						if ( $item['tabs_tab_icon_type'] == 'image' && ! empty( $item['tabs_tab_icon_thumbnail'] ) ) {
							if ( ! empty( $item['tabs_tab_icon_thumbnail']['url'] ) ) {
								$this->add_render_attribute( 'thumbnail', 'src', $item['tabs_tab_icon_thumbnail']['url'] );
								$this->add_render_attribute( 'thumbnail', 'alt', Control_Media::get_image_alt( $item['tabs_tab_icon_thumbnail'] ) );
								$this->add_render_attribute( 'thumbnail', 'title', Control_Media::get_image_title( $item['tabs_tab_icon_thumbnail'] ) );
								$icon_out = Group_Control_Image_Size::get_attachment_image_html( $item, 'thumbnail', 'tabs_tab_icon_thumbnail' );
								$icon_html_code = '<span class="tabs-icon tabs-icon-image">' . $icon_out . '</span>';
							}
						}
					}
					// End Tab Icon/image
					$settings['icon_html_code'] = $icon_html_code;


					//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
					$html .= mascot_core_ventiq_get_widgetcore_template_part( 'tab-title', null, 'tabs/tpl', $settings, false );
					$i++;
				}
			?>
			</ul>
		<?php
			}
		?>


		<?php
			if ( $settings['tabs_items'] ) {
				$tab_id_list2 = array();
				$i=1;
		?>
			<div class="tab-content" id="myTabContent-<?php echo esc_attr($settings['holder_id']); ?>">
			<?php
				foreach (  $settings['tabs_items'] as $item ) {
					$tab_id_list2[$i] = 'tab-'.$settings['holder_id'].'-'.$i;
					$settings['expand'] = $item['expand'];
					$settings['i'] = $i;
					$settings['tabs_content_type'] = $item['tabs_content_type'];
					$settings['tabs_content_templates'] = $item['tabs_content_templates'];
					$settings['tabs_content'] = $item['tabs_content'];
					$settings['tab_id_list2'] = $tab_id_list2;


					//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
					$html .= mascot_core_ventiq_get_widgetcore_template_part( 'tab-content', null, 'tabs/tpl', $settings, false );
					$i++;
				}
			?>
			</div>
		<?php
			}
		?>
		</div>
	<?php
	}
}