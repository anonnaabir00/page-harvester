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
			'section_content',
			[
				'label' => __( 'Content', 'elementor-hello-world' ),
			]
		);

		$this->add_control(
			'post_type',
			[
				'label' => esc_html__( 'Post Type', 'page-harvester' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'post',
				'options' => [
					'post' => esc_html__( 'Dumpster Geo Pages', 'page-harvester' ),
					'porta_potty_geo_page' => esc_html__( 'Porta Potty Geo Pages', 'page-harvester' ),
				],
			]
		);

        $this->add_control(
			'link_type',
			[
				'label' => esc_html__( 'Link Type', 'page-harvester' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'next_link',
				'options' => [
					'next_link' => esc_html__( 'Next Link', 'page-harvester' ),
					'previous_link' => esc_html__( 'Previous Link', 'page-harvester' ),
				],
			]
		);

        $this->add_control(
			'before_text',
			[
				'label' => esc_html__( 'Before Text', 'page-harvester' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => esc_html__( 'If you are looking for ', 'page-harvester' ),
				'placeholder' => esc_html__( 'Type your description here', 'page-harvester' ),
			]
		);

        $this->add_control(
			'after_text',
			[
				'label' => esc_html__( 'After Text', 'page-harvester' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => esc_html__( '', 'page-harvester' ),
				'placeholder' => esc_html__( 'Type your description here', 'page-harvester' ),
			]
		);

        $this->add_control(
			'cta_text',
			[
				'label' => esc_html__( 'CTA Text', 'page-harvester' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Click Here', 'page-harvester' ),
				'placeholder' => esc_html__( 'Type your cta here', 'page-harvester' ),
			]
		);

		$this->end_controls_section();

		// $this->start_controls_section(
		// 	'section_style',
		// 	[
		// 		'label' => __( 'Style', 'elementor-hello-world' ),
		// 		'tab' => Controls_Manager::TAB_STYLE,
		// 	]
		// );

		// $this->add_control(
		// 	'text_transform',
		// 	[
		// 		'label' => __( 'Text Transform', 'elementor-hello-world' ),
		// 		'type' => Controls_Manager::SELECT,
		// 		'default' => '',
		// 		'options' => [
		// 			'' => __( 'None', 'elementor-hello-world' ),
		// 			'uppercase' => __( 'UPPERCASE', 'elementor-hello-world' ),
		// 			'lowercase' => __( 'lowercase', 'elementor-hello-world' ),
		// 			'capitalize' => __( 'Capitalize', 'elementor-hello-world' ),
		// 		],
		// 		'selectors' => [
		// 			'{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
		// 		],
		// 	]
		// );

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