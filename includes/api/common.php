<?php

    if (! class_exists ('Ph_Common_API') ) {

    Class Ph_Common_API {

        private static $instance = false;

        public static function get_instance() {
                if ( !self::$instance )
                    self::$instance = new self;
                return self::$instance;
        }

        public function __construct(){
            add_action( 'rest_api_init', array( $this, 'ph_common_api' ));
        }

        public function ph_common_api() {

            register_rest_route( 'ph/v1', '/update-meta/(?P<post_id>\d+)', array(
                'methods' => 'POST',
                'callback' => array( $this, 'ph_update_post_meta' ),
            ));

            register_rest_route( 'ph/v1', '/save-settings', array(
                'methods' => 'POST',
                'callback' => array( $this, 'ph_save_settings' ),
            ));
        }

        public function ph_update_post_meta(WP_REST_Request $request){
            $value = json_decode($request->get_body());

            $post_id = $request->get_param('post_id');

            $location = sanitize_text_field($value->location);
            $state = sanitize_text_field($value->state);
            $phone = sanitize_text_field($value->phone);
            $cityinfo = sanitize_text_field($value->cityinfo);
            $location_data = sanitize_text_field($value->locationdata);
            
            // Update Post Meta
            update_post_meta($post_id, 'ph_location',$location);
            update_post_meta($post_id, 'ph_state',$state);
            update_post_meta($post_id, 'ph_phone',$phone);
            update_post_meta($post_id, 'ph_cityinfo',$cityinfo);
            update_post_meta($post_id, 'ph_location_data',$location_data);
            update_post_meta( $post_id, 'ph_adwords_code', $value->adwords );
            update_post_meta( $post_id, 'ph_adwords_phone_code', $value->adwordsphone );
            update_post_meta( $post_id, 'ph_schema_code', $value->schema );
        
            // Get Post Permalink
            $post_url = get_permalink($post_id);
        
            return $post_url;
        }

        public function ph_save_settings(WP_REST_Request $request){
            $value = json_decode($request->get_body());

            $enable_yoast = $value->enableyoast;
            
            // Update Option Meta
            update_option('ph_enable_yoast', $enable_yoast);
        
            return true;
        }
    
    }

    Ph_Common_API::get_instance();
}