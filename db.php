<?php

    if (! class_exists ('Ph_Database') ) {

    Class Ph_Database {

        private static $instance = false;

        public static function get_instance() {
                if ( !self::$instance )
                    self::$instance = new self;
                return self::$instance;
        }

        public function __construct(){
            add_action('init', array( $this,'page_harvester_db_table'));
            add_action( 'rest_api_init', array( $this, 'ph_insert_location_data' ));
        }

        public function page_harvester_db_table() {
            global $wpdb;
        
            $table_name = $wpdb->prefix . 'page_harvester';
        
            // Check if the table exists, if not, create it
            if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
                $charset_collate = $wpdb->get_charset_collate();
        
                $sql = "CREATE TABLE $table_name (
                    id mediumint(9) NOT NULL AUTO_INCREMENT,
                    location_name varchar(50) NOT NULL,
                    phone varchar(30) DEFAULT NULL,
                    opening_hours longtext DEFAULT NULL,
                    PRIMARY KEY  (id)
                ) $charset_collate;";
        
                require_once ABSPATH . 'wp-admin/includes/upgrade.php';
                dbDelta($sql);
            }
        }

        public function ph_insert_location_data() {
            register_rest_route( 'ph/v1', '/location/add-data', array(
                'methods' => 'POST',
                'callback' => array( $this, 'ph_insert_location_data_callback' ),
            ) );
        }

        public function ph_insert_location_data_callback( $request ) {
            global $wpdb;
            $value = json_decode($request->get_body());
            
            $location_name = $value->location_name;
            $phone = $value->location_phone;
            $opening_hours = $value->opening_hours;

            $table_name = $wpdb->prefix . 'page_harvester';
            $wpdb->insert(
                $table_name, 
                array( 
                    'location_name' => $location_name,
                    'phone' => $phone,
                    'opening_hours' => $opening_hours,
                    ) 
                );
            return new WP_REST_Response( array( 'message' => 'Location data added successfully.' ), 200 );
        }

        

    }

    Ph_Database::get_instance();
}