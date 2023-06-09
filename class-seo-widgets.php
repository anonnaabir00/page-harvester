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

	public function page_harvester_styles() {
		wp_register_style( 'page_harvester', plugins_url( 'assets/app.css', __FILE__ ) );
		wp_enqueue_style( 'page_harvester' );
	}

	public function page_harvester_scripts() {
		wp_register_script( 'ph_main', plugins_url( 'assets/main.js', __FILE__ ) );
	}

	public function add_module_attribute($tag, $handle, $src) {
		// if not your script, do nothing and return original $tag
		if ( 'ph_main' !== $handle ) {
			return $tag;
		}
		// change the script tag by adding type="module" and return it.
		$tag = '<script type="module" src="' . esc_url( $src ) . '"></script>';
		return $tag;
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
		require_once( __DIR__ . '/widgets/city-links.php' );
		require_once( __DIR__ . '/widgets/lead-form.php' );


		// Register Widgets
		$widgets_manager->register( new Widgets\InterLink() );
		$widgets_manager->register( new Widgets\CityLinks() );
		$widgets_manager->register( new Widgets\LeadForm() );
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
		add_action( 'elementor/frontend/before_enqueue_styles', [ $this, 'page_harvester_styles' ]);
		// add_action( 'elementor/frontend/before_register_scripts', [ $this, 'page_harvester_scripts' ]);
		// add_action( 'elementor/frontend/before_enqueue_scripts', [ $this, 'page_harvester_scripts' ]);
		// add_action( 'elementor/preview/enqueue_scripts', [ $this, 'page_harvester_scripts' ]);
		// add_action( 'elementor/preview/enqueue_scripts', [ $this, 'page_harvester_scripts' ]);
		add_action( 'elementor/preview/enqueue_styles', [ $this, 'page_harvester_styles' ]);

		add_action( 'wp_enqueue_scripts', [ $this, 'page_harvester_styles' ]);
		add_action( 'wp_enqueue_scripts', [ $this, 'page_harvester_scripts' ]);

		add_filter( 'script_loader_tag', array( $this,'add_module_attribute'), 10,3 );

		// Register widgets
		add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );

		// Create Widget Category
		add_action( 'elementor/elements/categories_registered', [ $this, 'widget_category' ] );
		
	}
}

// Instantiate Plugin Class
Harvester_SEO_Widgets::instance();