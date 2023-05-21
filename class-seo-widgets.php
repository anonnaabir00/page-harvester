<?php
namespace HarvesterWidgets;


class Harvester_SEO_Widgets {

	private static $_instance = null;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function widget_scripts() {
		wp_register_script( 'elementor-hello-world', plugins_url( '/assets/js/hello-world.js', __FILE__ ), [ 'jquery' ], false, true );
	}


	public function editor_scripts() {
		add_filter( 'script_loader_tag', [ $this, 'editor_scripts_as_a_module' ], 10, 2 );

		wp_enqueue_script(
			'elementor-hello-world-editor',
			plugins_url( '/assets/js/editor/editor.js', __FILE__ ),
			[
				'elementor-editor',
			],
			'1.2.1',
			true
		);
	}


	public function editor_scripts_as_a_module( $tag, $handle ) {
		if ( 'elementor-hello-world-editor' === $handle ) {
			$tag = str_replace( '<script', '<script type="module"', $tag );
		}

		return $tag;
	}


	public function register_widgets( $widgets_manager ) {
		// Its is now safe to include Widgets files
		require_once( __DIR__ . '/widgets/interlink.php' );

		// Register Widgets
		$widgets_manager->register( new Widgets\InterLink() );
	}

	public function widget_category($elements_manager){
		$elements_manager->add_category(
			'page_harvester',
			[
				'title' => esc_html__( 'Page Harvester', 'page-harvester' ),
				'icon' => 'fa fa-plug',
			]
		);
	}


	public function __construct() {
		// Register widget scripts
		// add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );

		// Register widgets
		add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );

		// Create Widget Category
		add_action( 'elementor/elements/categories_registered', [ $this, 'widget_category' ] );

		// Register editor scripts
		// add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'editor_scripts' ] );
	}
}

// Instantiate Plugin Class
Harvester_SEO_Widgets::instance();