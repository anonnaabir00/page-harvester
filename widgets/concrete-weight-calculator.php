<?php
namespace HarvesterWidgets\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class ConcreteWeightCalculator extends Widget_Base {

	public function get_name() {
		return 'concrete-weight-calculator';
	}

	public function get_title() {
		return __( 'Concrete Weight Calculator', 'page-harvester' );
	}


	public function get_icon() {
		return 'eicon-form-vertical';
	}


	public function get_categories() {
		return [ 'page_harvester' ];
	}


	public function get_script_depends() {
		return ['ph_main'];
	}


	protected function register_controls() {
        $this->start_controls_section(
            'calculator_header',
            [
                'label' => esc_html__( 'Header ', 'page-harvester' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
			'header_padding',
			[
				'label' => esc_html__( 'Header Padding', 'page-harvester' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .ph-cwcalc-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'header_background',
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .ph-cwcalc-header',
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'header_typography',
				'selector' => '{{WRAPPER}} .ph-cwcalc-header',
			]
		);


        $this->add_control(
			'header_text_color',
			[
				'label' => esc_html__( 'Header Text Color', 'page-harvester' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ph-cwcalc-header' => 'color: {{VALUE}}',
					'{{WRAPPER}} .ph-cwcalc-header::placeholder' => 'color: {{VALUE}}',
				],
			]
		);
        
        $this->end_controls_section();


        $this->start_controls_section(
            'calculator_body',
            [
                'label' => esc_html__( 'Body', 'page-harvester' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
			'body_padding',
			[
				'label' => esc_html__( 'Calculator Padding', 'page-harvester' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .ph-cwcalc-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'body_background',
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .ph-cwcalc-body',
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'body_typography',
				'selector' => '{{WRAPPER}} .ph-cwcalc-body',
			]
		);

        $this->add_control(
			'body_text_color',
			[
				'label' => esc_html__( 'Body Text Color', 'page-harvester' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ph-cwcalc-body' => 'color: {{VALUE}}',
					'{{WRAPPER}} .ph-cwcalc-body::placeholder' => 'color: {{VALUE}}',
				],
			]
		);
        
        $this->end_controls_section();

        $this->start_controls_section(
            'calculator_button',
            [
                'label' => esc_html__( 'Button', 'page-harvester' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
			'button_padding',
			[
				'label' => esc_html__( 'Button Padding', 'page-harvester' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .ph-cwcalc-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
			'button_bg_color',
			[
				'label' => esc_html__( 'Button Background Color', 'page-harvester' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ph-cwcalc-button' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' => esc_html__( 'Button Text Color', 'page-harvester' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ph-cwcalc-button' => 'color: {{VALUE}}',
				],
			]
		);
        
        $this->end_controls_section();
	}


	protected function render() {
		$settings = $this->get_settings_for_display();
        ?>
            <div id="ph-concrete-weight-calculator"></div>
        <?php
	}
}