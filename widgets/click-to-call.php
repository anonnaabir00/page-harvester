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

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'selector' => '{{WRAPPER}} .ph-callbutton',
			]
		);

		$this->add_control(
			'button_text_align',
			[
				'label' => esc_html__( 'Text Align', 'page-harvester' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'page-harvester' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'page-harvester' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'page-harvester' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .ph-callbutton' => 'text-align: {{VALUE}};',
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
		$phone_number = get_field( "phone_number" );
		$phone_number_placeholder = get_field( "phone" );
        ?>
        <div class="ph-callbutton bg-red-600 w-full">
            <a href="tel:<?php echo $phone_number;?>" class="text-white text-center">
			<div class="grid grid-cols-1">
				<div>Click To Call</div>
				<div><?php echo $phone_number_placeholder; ?></div>
			</div>
		</a>
        </div>

        <?php
	}
}