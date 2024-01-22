<?php

    if (! class_exists ('Ph_Email') ) {

    Class Ph_Email {

        private static $instance = false;

        public static function get_instance() {
                if ( !self::$instance )
                    self::$instance = new self;
                return self::$instance;
        }

        public function __construct(){
            add_action( 'rest_api_init', array( $this, 'ph_send_email' ));
        }

        public function ph_send_email() {
            register_rest_route( 'ph/v1', '/email', array(
                'methods' => 'POST',
                'callback' => array( $this, 'ph_send_email_callback' ),
            ));
        }
    
        public function ph_send_email_callback(WP_REST_Request $request){
            $value = json_decode($request->get_body());
            // wordpress mail function
            $to = get_option( 'admin_email' );
            $subject = 'New Request from ' . $value->name . ' via Page Harvester';
            $message = '  Name: ' . $value->name . '  Email: ' . $value->email . '  Phone: ' . $value->phone . '  ZIP: ' . $value->zip . '  Project Type: ' . $value->projecttype;
            $headers = array('Content-Type: text/html; charset=UTF-8');
            wp_mail( $to, $subject, $message, $headers );
    
            return $value;
        }

    }

    Ph_Email::get_instance();
}