<?php
namespace HarvesterWidgets\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class CityLinks extends Widget_Base {

	public function get_name() {
		return 'city-links';
	}

	public function get_title() {
		return __( 'City Links', 'page-harvester' );
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

        // $this->add_control(
		// 	'link_type',
		// 	[
		// 		'label' => esc_html__( 'Link Type', 'page-harvester' ),
		// 		'type' => \Elementor\Controls_Manager::SELECT,
		// 		'default' => 'next_link',
		// 		'options' => [
		// 			'next_link' => esc_html__( 'Next Link', 'page-harvester' ),
		// 			'previous_link' => esc_html__( 'Previous Link', 'page-harvester' ),
		// 		],
		// 	]
		// );

        // $this->add_control(
		// 	'before_text',
		// 	[
		// 		'label' => esc_html__( 'Before Text', 'page-harvester' ),
		// 		'type' => \Elementor\Controls_Manager::TEXTAREA,
		// 		'rows' => 10,
		// 		'default' => esc_html__( 'If you are looking for ', 'page-harvester' ),
		// 		'placeholder' => esc_html__( 'Type your description here', 'page-harvester' ),
		// 	]
		// );

        // $this->add_control(
		// 	'after_text',
		// 	[
		// 		'label' => esc_html__( 'After Text', 'page-harvester' ),
		// 		'type' => \Elementor\Controls_Manager::TEXTAREA,
		// 		'rows' => 10,
		// 		'default' => esc_html__( '', 'page-harvester' ),
		// 		'placeholder' => esc_html__( 'Type your description here', 'page-harvester' ),
		// 	]
		// );

        // $this->add_control(
		// 	'cta_text',
		// 	[
		// 		'label' => esc_html__( 'CTA Text', 'page-harvester' ),
		// 		'type' => \Elementor\Controls_Manager::TEXT,
		// 		'default' => esc_html__( 'Click Here', 'page-harvester' ),
		// 		'placeholder' => esc_html__( 'Type your cta here', 'page-harvester' ),
		// 	]
		// );

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
            'posts_per_page' => -1,
            'orderby' => 'rand',
            'post_status' => 'publish',
            'ignore_sticky_posts' => true,
            'no_found_rows' => true,
            'update_post_meta_cache' => false,
            'update_post_term_cache' => false,
            'cache_results' => false,
        );

        $query = new \WP_Query($args);

		$location_posts = array(); // array to store posts for each location

		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
		
				$title = get_the_title();
				$permalink = get_permalink();
				// get post meta
				$meta = get_post_meta( get_the_ID() );
				// get location name from post meta
				$location_name = $meta['state'][0];
		
				// add the post to the array for the location
				$location_posts[ $location_name ][] = array(
					'title' => $title,
					'permalink' => $permalink
				);
			}
			?>
			<div class="grid grid-cols-3 gap-6">
			<?php
		
			// display the state names and associated posts
			foreach ( $location_posts as $location_name => $posts ) {
				echo '<h4 class="text-lg">' . $location_name . '</h4>';
				foreach ( $posts as $post ) {
					?>
					<div>
						<a href="<?php echo $post['permalink']; ?>">
							<?php echo $post['title']; ?>
						</a>
					</div>
					<?php
				}
			}
			?>
			</div>
			<?php
		} else {
			// no posts found
		}

        wp_reset_postdata();
	}
}