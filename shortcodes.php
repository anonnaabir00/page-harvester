<?php

    if (! class_exists ('Ph_Shortcodes') ) {

    Class Ph_Shortcodes {

        private static $instance = false;

        public static function get_instance() {
                if ( !self::$instance )
                    self::$instance = new self;
                return self::$instance;
        }

        public function __construct(){
            add_shortcode( 'ph_location', array( $this, 'ph_location' ) );
            add_shortcode( 'ph_phone_number', array( $this, 'ph_phone_number' ) );
            add_shortcode( 'ph_state', array( $this, 'ph_state' ) );
        }

        public function ph_location(){
            $location = get_post_meta(get_the_ID(), 'ph_location', true);
            return $location;
        }

        public function ph_state(){
            $state = get_post_meta(get_the_ID(), 'ph_state', true);
            return $state;
        }

        public function ph_phone_number() {
            $phone = get_post_meta(get_the_ID(), 'ph_phone', true);

            if ($phone === null) {
                $phone_number_group = get_post_meta(get_the_ID(), 'ph_location_data', true);
                $phone = $phone_number_group;
            }

		    $tel_number = str_replace(array('-','(',')',' '),'',$phone);

            $shortcode = '<a href="tel:'.$tel_number.'">'.$phone.'</a>';

            return $shortcode;
        }

    }

    Ph_Shortcodes::get_instance();
}