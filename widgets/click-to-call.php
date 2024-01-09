<?php
namespace HarvesterWidgets\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class ClickToCall extends Widget_Base {

	public function get_name() {
		return 'click-to-call';
	}

	public function get_title() {
		return __( 'Click To Call', 'page-harvester' );
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
			'click_to_call_styles',
			[
				'label' => __( 'Styles', 'page-harvester' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'selector' => '{{WRAPPER}} .ph-callbutton',
			]
		);

		$this->add_control(
			'button_padding',
			[
				'label' => esc_html__( 'Button Padding', 'page-harvester' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .ph-callbutton' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'button_bg_color',
			[
				'label' => esc_html__( 'Button Background Color', 'page-harvester' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'default' => 'red',
				'selectors' => [
					'{{WRAPPER}} .ph-callbutton' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' => esc_html__( 'Button Text Color', 'page-harvester' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'default' => 'white',
				'selectors' => [
					'{{WRAPPER}} .ph-callbutton' => 'color: {{VALUE}}',
				],
			]
		);

		

		

		$this->end_controls_section();
	}


	protected function render() {
		$settings = $this->get_settings_for_display();
        ?>
        <div class="ph-callbutton bg-red-600 w-full">
            <a href="tel:1234" class="text-white text-center">Click To Call</a>
        </div>

        <?php
	}
}