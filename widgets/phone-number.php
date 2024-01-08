<?php
namespace HarvesterWidgets\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class PhoneNumber extends Widget_Base {

	public function get_name() {
		return 'phone-number';
	}

	public function get_title() {
		return __( 'Phone Number', 'page-harvester' );
	}


	public function get_icon() {
		return 'eicon-sitemap';
	}


	public function get_categories() {
		return [ 'page_harvester' ];
	}

	public function get_style_depends() {
		return ['page_harvester'];
	}


	public function get_script_depends() {
		return [];
	}


	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'page-harvester' ),
			]
		);

        $this->add_control(
			'before_text',
			[
				'label' => esc_html__( 'Before Text', 'page-harvester' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Phone: ', 'page-harvester' ),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Style', 'page-harvester' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'state_typography',
				'selector' => '{{WRAPPER}} .ph-phone',
			]
		);

        $this->add_control(
			'state_color',
			[
				'label' => esc_html__( 'Color', 'page-harvester' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ph-phone' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();
	}


	protected function render() {
		$settings = $this->get_settings_for_display();
        $before_text = $settings['before_text'];

        $phone = get_post_meta(get_the_ID(), 'ph_phone', true);

        if ($phone == null) {
            $location_data = json_decode(get_post_meta(get_the_ID(), 'ph_location_data', true),true);
            $phone = $location_data['phone'];
        }

        if (strpos($_SERVER['REQUEST_URI'], 'elementor') !== false ) {
            $phone = '123-123-1234';
        }

        echo '<p class="ph-phone">'.$before_text.$phone.'</p>';
        
	}
}