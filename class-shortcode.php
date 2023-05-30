<?php

    if (! class_exists ('Ph_Shortcode') ) {

    Class Ph_Shortcode {

        private static $instance = false;

        public static function get_instance() {
                if ( !self::$instance )
                    self::$instance = new self;
                return self::$instance;
        }

        public function __construct(){
            add_shortcode('ph_custom_header',array($this,'custom_header_shortcode'));
            add_action('wp_enqueue_scripts',array($this,'shortcode_assets'));
            add_filter( 'script_loader_tag', array( $this,'add_module_attribute'), 10,3 );
        }

        public function shortcode_assets(){
            wp_enqueue_style('ph_app',plugins_url('assets/app.css',__FILE__));
            wp_enqueue_script('ph_main',plugins_url('assets/main.js',__FILE__),array(),'1.0',true);
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

        public function custom_header_shortcode($atts){
            // check if specific page is about
            if ( !is_page( 'testimonials' ) ) {
                return '<div id="ph-custom-header"></div>';
            }
        }

    }

    Ph_Shortcode::get_instance();
}