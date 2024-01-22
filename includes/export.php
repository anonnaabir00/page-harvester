<?php

    if (! class_exists ('Ph_Export') ) {

    Class Ph_Export {

        private static $instance = false;

        public static function get_instance() {
                if ( !self::$instance )
                    self::$instance = new self;
                return self::$instance;
        }

        public function __construct(){
            add_action( 'rest_api_init', array( $this, 'ph_export_api' ));
        }

        public function ph_export_api() {
            register_rest_route( 'ph/v1', '/dumpster/geo/export', array(
                'methods' => 'GET',
                'callback' => array( $this, 'ph_export_dumpster_callback' ),
            ));

            register_rest_route( 'ph/v1', '/porta-potty/geo/export', array(
                'methods' => 'GET',
                'callback' => array( $this, 'ph_export_portapotty_callback' ),
            ));
        }

        public function ph_export_dumpster_callback(WP_REST_Request $request){
            // get all posts  link from dumpster page
            $args = array(
                'post_type' => 'post',
                'post_status' => 'publish',
                'posts_per_page' => -1,
            );
            $posts = get_posts($args);
            $data = array();
            foreach($posts as $post){
                $data[] = get_permalink($post->ID);
            }

            
            return $data;
        }


        public function ph_export_portapotty_callback(WP_REST_Request $request){
            // get all posts  link from dumpster page
            $args = array(
                'post_type' => 'porta_potty_geo_page',
                'post_status' => 'publish',
                'posts_per_page' => -1,
            );
            $posts = get_posts($args);
            $data = array();
            foreach($posts as $post){
                $data[] = get_permalink($post->ID);
            }

            
            return $data;
        }
    
    }

    Ph_Export::get_instance();
}