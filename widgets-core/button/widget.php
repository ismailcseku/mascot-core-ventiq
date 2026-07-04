<?php
namespace MascotCoreVentiq\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TM_Elementor_Button extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		$direction_suffix = is_rtl() ? '.rtl' : '';
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
		return 'tm-ele-button';
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
		return esc_html__( 'Button', 'mascot-core-ventiq' );
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
		$this->add_control(
			'button_text',
			[
				'label' => esc_html__( "Text", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "Read More", 'mascot-core-ventiq' ),
			]
		);
		$this->add_control(
			'link',
			[
				'label' => esc_html__( "Link URL", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::URL,
				'show_external' => true,
				'default' => [
					'url' => '',
				],
			]
		);
		$this->end_controls_section();



		//add button controns
		mascot_core_ventiq_get_button_control($this);



		$this->start_controls_section(
			'icon_options', [
				'label' => esc_html__( 'Icon Options', 'mascot-core-ventiq' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'add_icon',
			[
				'label' => esc_html__( "Show/Hide Icon?", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
			]
		);
		$this->add_control(
			'button_icon_left',
			[
				'label' => esc_html__( 'Icon Left', 'mascot-core-ventiq' ),
				'type' => Controls_Manager::ICONS,
				'separator' => 'before',
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-chevron-right',
					'library' => 'fa-solid',
				],
				'recommended' => [
					'fa-solid' => [
						'chevron-right',
						'angle-right',
						'angle-double-right',
						'caret-right',
						'caret-square-right',
					],
					'fa-regular' => [
						'caret-square-right',
					],
				],
				'label_block' => false,
				'skin' => 'inline',
			]
		);
		$this->add_control(
			'button_icon_right',
			[
				'label' => esc_html__( 'Icon Right', 'mascot-core-ventiq' ),
				'type' => Controls_Manager::ICONS,
				'separator' => 'before',
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-chevron-right',
					'library' => 'fa-solid',
				],
				'recommended' => [
					'fa-solid' => [
						'chevron-right',
						'angle-right',
						'angle-double-right',
						'caret-right',
						'caret-square-right',
					],
					'fa-regular' => [
						'caret-square-right',
					],
				],
				'label_block' => false,
				'skin' => 'inline',
			]
		);
		$this->add_control(
			'button_icon_border_options',
			[
				'label' => esc_html__( 'Border Options', 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'button_icon_border',
				'label' => esc_html__( 'Border', 'mascot-core-ventiq' ),
				'selector' => '{{WRAPPER}} .btn .btn-icon',
			]
		);
		$this->add_responsive_control(
			'button_icon_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .btn .btn-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_responsive_control(
			'button_icon_margin',
			[
				'label' => esc_html__( 'Icon Margin', 'mascot-core-ventiq' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .btn .btn-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'button_icon_padding',
			[
				'label' => esc_html__( 'Icon Padding', 'mascot-core-ventiq' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .btn .btn-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'button_icon_bg_options',
			[
				'label' => esc_html__( 'Background Options', 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'button_icon_bg_theme_colored',
			[
				'label' => esc_html__( "Icon BG Theme Colored", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_ventiq_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .btn .btn-icon' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'button_icon_bg_theme_colored_hover',
			[
				'label' => esc_html__( "Icon BG (Hover)", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_ventiq_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .btn:hover .btn-icon' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'button_icon_custom_bg_color',
			[
				'label' => esc_html__( "Icon BG Custom Color", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .btn .btn-icon' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'button_icon_bg_colored_hover',
			[
				'label' => esc_html__( "Icon Bg Color (Hover)", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .btn:hover .btn-icon' => 'background-color: var(--theme-color{{VALUE}});'
				]
			]
		);
		$this->add_control(
			'btn_icon_color_options',
			[
				'label' => esc_html__( 'Icon Color Options', 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'btn_icon_theme_colored',
			[
				'label' => esc_html__( "Icon Theme Colored", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_ventiq_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .btn .btn-icon' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .btn .btn-icon svg path path' => 'fill: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'btn_icon_theme_colored_hover',
			[
				'label' => esc_html__( "Theme Icon (Hover)", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_ventiq_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .btn:hover .btn-icon' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .btn:hover .btn-icon svg path' => 'fill: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'btn_icon_color',
			[
				'label' => esc_html__( "Icon Color", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .btn .btn-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .btn .btn-icon svg path' => 'fill: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'btn_icon_color_hover',
			[
				'label' => esc_html__( "Icon Color (Hover)", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .btn:hover .btn-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .btn:hover .btn-icon svg path' => 'fill: {{VALUE}};',
				]
			]
		);
		$this->add_responsive_control(
			'btn_icon_rotate',
			[
				'label' => esc_html__( 'Icon Rotate', 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'deg' ],
				'range' => [
					'deg' => [
						'min' => 0,
						'max' => 360,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'deg',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .btn .btn-icon i ' => 'transform: rotate({{SIZE}}{{UNIT}});',
					'{{WRAPPER}} .btn .btn-icon svg path' => 'transform: rotate({{SIZE}}{{UNIT}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'btn_icon_typography',
				'label' => esc_html__( 'Button Icon Typography', 'mascot-core-ventiq' ),
				'selector' => '{{WRAPPER}} .btn .btn-icon i',
			]
		);
		$this->add_responsive_control(
			'btn_icon_display_visibility',
			[
				'label' => esc_html__( "Visibility (Show/Hide)", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'separator' => 'before',
				'options' => [
					'inline' =>  esc_html__( 'Show', 'mascot-core-ventiq' ),
					'none'  =>  esc_html__( 'Hide', 'mascot-core-ventiq' ),
				],
				'selectors' => [
					'{{WRAPPER}} .btn .btn-icon' => 'display: {{VALUE}};'
				]
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
		$settings = $this->get_settings_for_display();

		//link url
		$settings['button']['target'] = ( $settings['link'] && $settings['link']['is_external'] ) ? ' target="_blank"' : '';
		$settings['button']['url'] = ( $settings['link'] && $settings['link']['url'] ) ? $settings['link']['url'] : '';


		//classes
		$classes = array();

		//css animation
		$classes[] = $settings['custom_css_class'];
		$settings['classes'] = $classes;

		//button classes
		$settings['btn_classes'] = mascot_core_ventiq_prepare_button_classes_from_params( $settings );


		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = mascot_core_ventiq_get_widgetcore_template_part( 'button', null, 'button/tpl', $settings, true );

		echo $html;
	}
}