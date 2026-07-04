<?php
namespace MascotCoreVentiq\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TM_Elementor_Pie_Chart extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);

		wp_register_script( 'jquery-easypiechart', MASCOT_CORE_VENTIQ_ASSETS_URI . '/js/plugins/jquery.easypiechart.min.js', array('jquery'), false, true );

		$direction_suffix = is_rtl() ? '.rtl' : '';

		wp_register_style( 'tm-pie-chart-style', MASCOT_CORE_VENTIQ_ASSETS_URI . '/css/widgets-core/pie-chart' . $direction_suffix . '.css' );
		wp_register_script( 'tm-pie-chart', MASCOT_CORE_VENTIQ_ASSETS_URI . '/js/widgets/pie-chart.js', array('jquery', 'jquery-easypiechart'), false, true );
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
		return 'tm-ele-pie-chart';
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
		return esc_html__( 'Pie Chart', 'mascot-core-ventiq' );
	}

	/**
	 * Retrieve the widget percent.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget percent.
	 */
	public function get_percent() {
		return 'tm-elementor-widget-percent';
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
		return [ 'mascot-core-hellojs', 'jquery-easypiechart', 'tm-pie-chart' ];
	}

	public function get_style_depends() {
		return [ 'tm-pie-chart-style' ];
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
		$this->add_responsive_control(
			'chart_flex_alignment',
			[
				'label' => esc_html__( "Chart Alignment(Flex)", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_ventiq_disply_flex_horizontal_align_elementor(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}' => 'display:flex; justify-content: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'percent',
			[
				'label' => esc_html__( "Percentage Value", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( "Add a Percentage Value. Maximum 100. Default: 85", 'mascot-core-ventiq' ),
				'separator' => 'before',
				'default' => '85'
			]
		);
		$this->add_control(
			'barcolor',
			[
				'label' => esc_html__( "Bar Color", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'description' => esc_html__( "The color of the curcular bar. Leave empty for default value", 'mascot-core-ventiq' ),
				'default' => '#ef1e25'
			]
		);
		$this->add_control(
			'trackcolor',
			[
				'label' => esc_html__( "Track Color", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'description' => esc_html__( "The color of the track, or false to disable rendering. Leave empty for default value", 'mascot-core-ventiq' ),
				'default' => '#f2f2f2'
			]
		);
		$this->add_control(
			'linewidth',
			[
				'label' => esc_html__( "Line Width", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( "Width of the chart line in px. Default: 3", 'mascot-core-ventiq' ),
				'default' => '3'
			]
		);
		$this->add_control(
			'linecap',
			[
				'label' => esc_html__( "Line Cap", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
				'square' => esc_html__( 'Square', 'mascot-core-ventiq' ),
				'butt' => esc_html__( 'Butt', 'mascot-core-ventiq' ),
				'round' => esc_html__( 'Round', 'mascot-core-ventiq' ),
				],
				'default' => 'square'
			]
		);
		$this->add_control(
			'size',
			[
				'label' => esc_html__( "Size", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( "Size of the pie chart in px. It will always be a square. Default: 110", 'mascot-core-ventiq' ),
				'default' => '110'
			]
		);
		$this->add_control(
			'scalecolor',
			[
				'label' => esc_html__( "Scale  Color", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'description' => esc_html__( "The color of the scale lines, false to disable rendering. Leave empty for default value", 'mascot-core-ventiq' ),
				'default' => '#dfe0e0'
			]
		);
		$this->add_control(
			'scalelength',
			[
				'label' => esc_html__( "Scale Length", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( "Length of the scale lines (reduces the radius of the chart). Default: 5", 'mascot-core-ventiq' ),
				'default' => '5'
			]
		);

		$this->end_controls_section();






		$this->start_controls_section(
			'percent_options',
			[
				'label' => esc_html__( 'Percent Value Options', 'mascot-core-ventiq' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'percent_color',
			[
				'label' => esc_html__( "Percent Value Color", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .percent' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'percent_color_hover',
			[
				'label' => esc_html__( "Percent Value Color (Hover)", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .percent' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'percent_theme_colored',
			[
				'label' => esc_html__( "Percent Value Theme Colored", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_ventiq_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .percent' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'percent_theme_colored_hover',
			[
				'label' => esc_html__( "Percent Value Theme Colored (Hover)", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_ventiq_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .percent' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'percent_bg_color',
			[
				'label' => esc_html__( "Percent Bg Color", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .percent' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'percent_bg_theme_colored',
			[
				'label' => esc_html__( "Percent BG Theme Colored", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_ventiq_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .percent' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'percent_theme_bg_colored_hover',
			[
				'label' => esc_html__( "Percent BG Theme Colored (Hover)", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_ventiq_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .percent' => 'background: var(--theme-color{{VALUE}});'
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'percent_typography',
				'label' => esc_html__( 'Typography', 'mascot-core-ventiq' ),
				'selector' => '{{WRAPPER}} .percent',
			]
		);
		$this->add_control(
			'percent_theme_dimension_options',
			[
				'label' => esc_html__( 'Dimension Options', 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'percent_theme_width',
			[
				'label' => esc_html__( "Width", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .percent' => 'width: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->add_control(
			'percent_theme_width_auto',
			[
				'label' => esc_html__( "Make Icon Width to Auto?", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .percent' => 'width: auto;',
				]
			]
		);
		$this->add_responsive_control(
			'percent_theme_height',
			[
				'label' => esc_html__( "Height", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .percent' => 'height: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->add_control(
			'percent_theme_height_auto',
			[
				'label' => esc_html__( "Make Icon Height to Auto?", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .percent' => 'height: auto;',
				]
			]
		);
		$this->add_responsive_control(
			'percent-line-height',
			[
				'label' => esc_html__( "Icon Line Height", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .percent' => 'line-height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .percent i' => 'line-height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .percent svg' => 'line-height: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->add_control(
			'percent_theme_border_options',
			[
				'label' => esc_html__( 'Border Options', 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'percent_theme_border',
				'label' => esc_html__( 'Border', 'mascot-core-ventiq' ),
				'selector' => '{{WRAPPER}} .percent',
			]
		);
		$this->add_responsive_control(
			'percent_theme_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .percent' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'percent_theme_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'mascot-core-ventiq' ),
				'selector' => '{{WRAPPER}} .percent',
			]
		);

		// Switcher to enable/disable gradient
		$this->add_control(
			'enable_percent_area_gradient',
			[
				'label'        => esc_html__( 'Enable Background Gradient', 'mascot-core-ventiq' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'mascot-core-ventiq' ),
				'label_off'    => esc_html__( 'Off', 'mascot-core-ventiq' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		// Gradient dropdown shown only if switch is ON
		$this->add_responsive_control(
			'percent_area_gradient',
			[
				'label'     => esc_html__( "Background Gradient", 'mascot-core-ventiq' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => [
					'linear-gradient(99deg, var(--theme-color1) 0%, var(--theme-color2) 93.92%)' => esc_html__('Gradient One', 'mascot-core-ventiq'),
					'linear-gradient(99deg, var(--theme-color2) 0%, var(--theme-color3) 93.92%)' => esc_html__('Gradient Two', 'mascot-core-ventiq'),
					'linear-gradient(99deg, var(--theme-color3) 0%, var(--theme-color4) 93.92%)' => esc_html__('Gradient Three', 'mascot-core-ventiq'),
				],
				'default'   => 'linear-gradient(99deg, var(--theme-color1) 0%, var(--theme-color2) 93.92%)',
				'selectors' => [
					'{{WRAPPER}} .percent' => 'background: {{VALUE}};',
				],
				'condition' => [
					'enable_percent_area_gradient' => 'yes',
				],
			]
		);







		$this->end_controls_section();






		$this->start_controls_section(
			'title_options',
			[
				'label' => esc_html__( 'Title Options', 'mascot-core-ventiq' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'show_title',
			[
				'label' => esc_html__( "Show Title?", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
			]
		);
		$this->add_control(
			'title',
			[
				'label' => esc_html__( "Title", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				"description" => esc_html__( "Add your Progress/Skill Title Text. Default: WordPress", 'mascot-core-ventiq' ),
			]
		);
		$this->add_control(
			'title_tag',
			[
				'label' => esc_html__( "Title Tag", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_ventiq_heading_tag_list(),
				'default' => 'h3'
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Typography', 'mascot-core-ventiq' ),
				'selector' => '{{WRAPPER}} .tm-sc-pie-chart .title',
			]
		);
		$this->add_control(
			'title_text_color',
			[
				'label' => esc_html__( "Title Text Color", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-pie-chart .title' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'title_text_color_hover',
			[
				'label' => esc_html__( "Title Text Color (Hover)", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .tm-sc-pie-chart .title' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'title_theme_colored',
			[
				'label' => esc_html__( "Title Theme Colored", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_ventiq_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-pie-chart .title' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'title_theme_colored_hover',
			[
				'label' => esc_html__( "Title Theme Colored (Hover)", 'mascot-core-ventiq' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_ventiq_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .tm-sc-pie-chart .title' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__( 'Title Margin', 'mascot-core-ventiq' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-pie-chart .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		$settings = $this->get_settings_for_display();

		//classes
		$classes = array();
		$settings['classes'] = $classes;

		wp_register_script( 'jquery-easypiechart', MASCOT_CORE_VENTIQ_ASSETS_URI . '/js/plugins/jquery.easypiechart.min.js', array('jquery'), false, true );
		wp_enqueue_script( 'jquery-easypiechart' );

		$settings['box_inline_css'] = mascot_core_ventiq_get_inline_css( mascot_core_ventiq_sc_pie_chart_box_css( $settings ) );

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = mascot_core_ventiq_get_widgetcore_template_part( 'pie-chart', null, 'pie-chart/tpl', $settings, true );

		echo $html;
	}
}
if(!function_exists('mascot_core_ventiq_sc_pie_chart_box_css')) {
	/**
	 * Get Parent Box Styles
	 */
	function mascot_core_ventiq_sc_pie_chart_box_css( $settings ) {
		$css_array = array();

		if( $settings['size'] != '' ) {
			$css_array[] = 'width: '.mascot_core_ventiq_if_numeric_add_suffix($settings['size'], 'px');
			$css_array[] = 'height: '.mascot_core_ventiq_if_numeric_add_suffix($settings['size'], 'px');
			$css_array[] = 'line-height: '.mascot_core_ventiq_if_numeric_add_suffix($settings['size'], 'px');
		}
		return implode( '; ', $css_array );
	}
}