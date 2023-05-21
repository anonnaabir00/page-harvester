<?php
namespace HarvesterWidgets\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class InterLink extends Widget_Base {

	public function get_name() {
		return 'interlink';
	}

	public function get_title() {
		return __( 'Internal Link', 'page-harvester' );
	}


	public function get_icon() {
		return 'eicon-link';
	}


	public function get_categories() {
		return [ 'page_harvester' ];
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
				'default' => 'solid',
				'options' => [
					'post' => esc_html__( 'Dumpster Geo Pages', 'page-harvester' ),
					'porta_potty_geo_page' => esc_html__( 'Porta Potty Geo Pages', 'page-harvester' ),
				],
			]
		);

        $this->add_control(
			'before_text',
			[
				'label' => esc_html__( 'Before Text', 'page-harvester' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => esc_html__( 'Default description', 'page-harvester' ),
				'placeholder' => esc_html__( 'Type your description here', 'page-harvester' ),
			]
		);

        $this->add_control(
			'after_text',
			[
				'label' => esc_html__( 'After Text', 'page-harvester' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => esc_html__( 'Default description', 'page-harvester' ),
				'placeholder' => esc_html__( 'Type your description here', 'page-harvester' ),
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

        // get the previous post id from the current post id
        $prev_post = get_previous_post();

        // echo $previous_post_id post title
        // get post permalink
        $permalink = get_permalink($prev_post->ID);

        ?>
        <p><?php echo $settings['before_text']; ?>
        <a href="<?php echo $permalink; ?>">
            <?php echo get_the_title($prev_post->ID); ?>
        </a>
        <?php echo $settings['after_text']; ?>
        </p>
        <?php
	}


	protected function content_template() {
		?>
		<div class="title">
			{{{ settings.title }}}
		</div>
		<?php
	}
}