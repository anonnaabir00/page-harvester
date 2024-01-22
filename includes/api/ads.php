<?php

    if (! class_exists ('Ph_Ads_API') ) {

    Class Ph_Ads_API {

        private static $instance = false;

        public static function get_instance() {
                if ( !self::$instance )
                    self::$instance = new self;
                return self::$instance;
        }

        public function __construct(){
            add_action( 'rest_api_init', array( $this, 'ph_ads_api' ));
        }

        public function ph_ads_api() {
            register_rest_route( 'ph/v1', '/dumpster/ads', array(
                'methods' => 'POST',
                'callback' => array( $this, 'ph_insert_ads_page' ),
            ));

            register_rest_route( 'ph/v1', '/porta-potty/ads', array(
                'methods' => 'POST',
                'callback' => array( $this, 'ph_insert_ads_page' ),
            ));
        }

        public function ph_insert_ads_page(WP_REST_Request $request){
            $value = json_decode($request->get_body());

            // Create post object
            $my_post = array(
                'post_title'    => wp_strip_all_tags($value->post_title),
                'post_content'  => $value->post_content,
                'post_type'     => 'page',
                'post_status'   => 'publish',
                'page_template'  => 'elementor_canvas',
                'post_author'   => 1,
            );
            
            // Insert the post into the database and get id
            $post_id = wp_insert_post($my_post);

            $adwords_code = '<!-- Google tag (gtag.js) -->
            <script async src="https://www.googletagmanager.com/gtag/js?id=AW-10800357225"></script>
            <script>
              window.dataLayer = window.dataLayer || [];
              function gtag(){dataLayer.push(arguments);}
              gtag(\'js\', new Date());
            
              gtag(\'config\', \'AW-10800357225\');
            </script>';

            // Update Custom Post Meta
            update_post_meta( $post_id, 'ph_location', $value->location );
            update_post_meta( $post_id, 'ph_state', $value->state, );
            update_post_meta( $post_id, 'ph_phone', $value->phone );
            update_post_meta( $post_id, 'ph_cityinfo', $value->information );
            update_post_meta( $post_id, 'ph_location_data', $value->phonegroup );
            update_post_meta( $post_id, 'ph_adwords_code', isset($value->adwords) ? $value->adwords : $adwords_code );
            update_post_meta( $post_id, 'ph_adwords_phone_code', $value->adwordsphone );
            update_post_meta( $post_id, 'ph_schema_code', $value->schema );

            // Get Post Permalink
            $post_url = get_permalink($post_id);

            return $post_url;
        }
    
    }

    Ph_Ads_API::get_instance();
}