<?php
namespace HarvesterWidgets\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class Location extends Widget_Base {

	public function get_name() {
		return 'location';
	}

	public function get_title() {
		return __( 'Location', 'page-harvester' );
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
				'label' => __( 'Content', 'elementor-hello-world' ),
			]
		);

        $this->add_control(
			'before_text',
			[
				'label' => esc_html__( 'Before Text', 'page-harvester' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Location: ', 'page-harvester' ),
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
				'name' => 'location_typography',
				'selector' => '{{WRAPPER}} .ph-location',
			]
		);

        $this->add_control(
			'location_color',
			[
				'label' => esc_html__( 'Color', 'page-harvester' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ph-location' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();
	}


	protected function render() {
		$settings = $this->get_settings_for_display();
        $before_text = $settings['before_text'];
        $location = get_post_meta(get_the_ID(), 'ph_location', true);

        if (strpos($_SERVER['REQUEST_URI'], 'elementor') !== false ) {
            $location = 'California, CA';
        }

        echo '<p class="ph-location">'.$before_text.$location.'</p>';
        
	}
}