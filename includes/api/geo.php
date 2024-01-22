<?php

    if (! class_exists ('Ph_GEO_API') ) {

    Class Ph_GEO_API {

        private static $instance = false;

        public static function get_instance() {
                if ( !self::$instance )
                    self::$instance = new self;
                return self::$instance;
        }

        public function __construct(){
            add_action( 'rest_api_init', array( $this, 'ph_geo_api' ));
        }

        public function ph_geo_api() {

            register_rest_route( 'ph/v1', '/dumpster/geo', array(
                'methods' => 'POST',
                'callback' => array( $this, 'ph_insert_dumpster_geo' ),
            ));

            register_rest_route( 'ph/v1', '/porta-potty/geo', array(
                'methods' => 'POST',
                'callback' => array( $this, 'ph_insert_portapotty_geo' ),
            ));
        }

        public function ph_insert_dumpster_geo(WP_REST_Request $request){
            $value = json_decode($request->get_body());
            
            // Create post object
            $my_post = array(
                'post_title'    => wp_strip_all_tags($value->post_title),
                'post_content'  => $value->post_content,
                'post_status'   => 'publish',
                'page_template'  => 'elementor_header_footer',
                'post_author'   => 1,
            );
            
            // Insert the post into the database and get id
            $post_id = wp_insert_post($my_post);

            // Update Custom Post Meta
            update_post_meta( $post_id, 'ph_location', $value->location );
            update_post_meta( $post_id, 'ph_state', $value->state, );
            update_post_meta( $post_id, 'ph_phone', $value->phone );
            update_post_meta( $post_id, 'ph_cityinfo', $value->information );
            update_post_meta( $post_id, 'ph_location_data', $value->phonegroup );
            update_post_meta( $post_id, 'ph_adwords_code', $value->adwords );
            update_post_meta( $post_id, 'ph_adwords_phone_code', $value->adwordsphone );
            update_post_meta( $post_id, 'ph_schema_code', $value->schema );

            // Get Post Permalink
            $post_url = get_permalink($post_id);

            return $post_url;
        }

        public function ph_insert_portapotty_geo(WP_REST_Request $request){
            $value = json_decode($request->get_body());
            
            // Create post object
            $my_post = array(
                'post_title'    => wp_strip_all_tags($value->post_title),
                'post_content'  => $value->post_content,
                'post_status'   => 'publish',
                'post_type'     => 'porta_potty_geo_page',
                'page_template'  => 'elementor_header_footer',
                'post_author'   => 1,
            );
            
            // Insert the post into the database and get id
            $post_id = wp_insert_post($my_post);

            // Update Custom Post Meta
            update_post_meta( $post_id, 'ph_location', $value->location );
            update_post_meta( $post_id, 'ph_state', $value->state, );
            update_post_meta( $post_id, 'ph_phone', $value->phone );
            update_post_meta( $post_id, 'ph_cityinfo', $value->information );
            update_post_meta( $post_id, 'ph_location_data', $value->phonegroup );
            update_post_meta( $post_id, 'ph_adwords_code', $value->adwords );
            update_post_meta( $post_id, 'ph_adwords_phone_code', $value->adwordsphone );
            update_post_meta( $post_id, 'ph_schema_code', $value->schema );

            // Get Post Permalink
            $post_url = get_permalink($post_id);

            return $post_url;
        }
    
    }

    Ph_GEO_API::get_instance();
}