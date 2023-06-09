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

        // wordpress get post
        $args = array(
            'post_type' => $settings['post_type'],
            'posts_per_page' => 1,
            'orderby' => 'rand',
            'post_status' => 'publish',
            'ignore_sticky_posts' => true,
            'no_found_rows' => true,
            'update_post_meta_cache' => false,
            'update_post_term_cache' => false,
            'cache_results' => false,
        );

        $query = new \WP_Query($args);

        // get the current post id
        $current_post_id = get_the_ID();

        $next_post = get_next_post();
        $prev_post = get_previous_post();

        if ( $settings['link_type'] == 'next_link' ) {
            // check if the next post is the current post
            if ( $next_post->ID == $current_post_id ) {
                // if so, get the previous post
                $title = get_the_title($prev_post->ID);
                $permalink = get_permalink($prev_post->ID);
            } else {
                $title = get_the_title($next_post->ID);
                $permalink = get_permalink($next_post->ID);
            }
        } else {
            $title = get_the_title($prev_post->ID);
            $permalink = get_permalink($prev_post->ID);
        }

        // $title = get_the_title($next_post->ID);
        // $permalink = get_permalink($prev_post->ID);
        ?>
            <div id="ph-leadform"></div>
        <?php
	}
}