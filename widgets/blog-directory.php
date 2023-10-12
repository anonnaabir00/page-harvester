<?php
namespace HarvesterWidgets\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class BlogDirectory extends Widget_Base {

	public function get_name() {
		return 'blog-directory';
	}

	public function get_title() {
		return __( 'Blog Directory', 'page-harvester' );
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
					'news' => esc_html__( 'News', 'page-harvester' ),
					'dumpster_blog' => esc_html__( 'Dumpster Blog', 'page-harvester' ),
                    'porta_potty_blog' => esc_html__( 'Porta Potty Blog', 'page-harvester' ),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Style', 'elementor-hello-world' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);


        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .blog-directory',
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->end_controls_section();
	}


    protected function render() {
        $settings = $this->get_settings_for_display();
    
        // wordpress get post
        $args = array(
            'post_type' => $settings['post_type'],
            'posts_per_page' => -1,
            'orderby' => 'date',
            'post_status' => 'publish',
            'ignore_sticky_posts' => true,
            'no_found_rows' => true,
            'cache_results' => false,
        );
    
        $query = new \WP_Query($args);
    
        if ($query->have_posts()) {
            ?>
            <div class="grid sm:grid-cols-2 md:grid-cols-4 md:gap-10 sm:gap-3">
            <?php
    
            while ($query->have_posts()) {
                $query->the_post();
    
                $title = get_the_title();
                $permalink = get_permalink();
                $date = get_the_date();
                $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'); // Adjust the image size as needed
    
                if (empty($thumbnail)) {
                    continue; // Skip posts without thumbnails
                }
                ?>
                <a href="<?php echo $permalink; ?>"">
                    
                        <div class="blog-directory sm:grid md:grid">
                            <img src="<?php echo $thumbnail; ?>" class="sm:w-full md:w-full" alt="">
                            <div class="mt-3">
                            <?php echo $title; ?>
                            </div>
                        
                    </div>
                </a>
                <?php
            }
            echo '</div>';
        } else {
            // no posts found
        }
    
        wp_reset_postdata();
    }
}