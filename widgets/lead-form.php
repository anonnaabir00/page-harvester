<?php
namespace HarvesterWidgets\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class LeadForm extends Widget_Base {

	public function get_name() {
		return 'leadform';
	}

	public function get_title() {
		return __( 'Lead Form', 'page-harvester' );
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
			'leadform_styles',
			[
				'label' => __( 'Styles', 'page-harvester' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'fields_padding',
			[
				'label' => esc_html__( 'Fields Padding', 'page-harvester' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .phlf-field' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'field_border',
				'selector' => '{{WRAPPER}} .phlf-field',
			]
		);

		$this->add_control(
			'field_text_color',
			[
				'label' => esc_html__( 'Field Text Color', 'page-harvester' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .phlf-field' => 'color: {{VALUE}}',
					'{{WRAPPER}} .phlf-field::placeholder' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_padding',
			[
				'label' => esc_html__( 'Button Padding', 'page-harvester' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .phlf-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'button_bg_color',
			[
				'label' => esc_html__( 'Button Background Color', 'page-harvester' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .phlf-button' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' => esc_html__( 'Button Text Color', 'page-harvester' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .phlf-button' => 'color: {{VALUE}}',
				],
			]
		);

		

		

		$this->end_controls_section();
	}


	protected function render() {
		$settings = $this->get_settings_for_display();
        ?>
            <div id="ph-leadform"></div>
        <?php
	}
}