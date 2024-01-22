<?php

    if (! class_exists ('Ph_Assets') ) {

    Class Ph_Assets {

        private static $instance = false;

        public static function get_instance() {
                if ( !self::$instance )
                    self::$instance = new self;
                return self::$instance;
        }

        public function __construct(){
            add_action('admin_menu', array( $this,'ph_admin_menu'));
            add_action( 'admin_enqueue_scripts', array($this,'ph_admin_assets'));
            add_filter( 'script_loader_tag', array( $this,'add_module_attribute'), 10,3 );
        }

        public function ph_admin_assets(){
            global $post;
            global $wpdb;

            $current_screen = get_current_screen();
            $admin_screen = 'toplevel_page_page_harvester';

            $post_id = get_the_ID(  );
            $post = get_post($post_id);
            $table_name = $wpdb->prefix . 'page_harvester';

            $output = [
                'id' => $post_id,
                'title' => $post->post_title,
                'content' => $post->post_content,
                'location' => get_post_meta( $post_id, 'ph_location', true),
                'state' => get_post_meta( $post_id, 'ph_state', true),
                'phone' => get_post_meta( $post_id, 'ph_phone', true),
                'city_information' => get_post_meta( $post_id, 'ph_cityinfo', true),
                'location_data' => get_post_meta( $post_id, 'ph_location_data', true),
                'adwords_code' => get_post_meta( $post_id, 'ph_adwords_code', true),
                'adwords_phone_code' => get_post_meta( $post_id, 'ph_adwords_phone_code', true),
                'schema_code' => get_post_meta( $post_id, 'ph_schema_code', true),
            ];

            $location_data = $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);


            if ($admin_screen == $current_screen->base OR $post->post_type == 'post' OR $post->post_type == 'page' OR $post->post_type == 'porta_potty_geo_page') {
                wp_enqueue_style( 'app', plugin_dir_url( dirname( __FILE__ ) ) . 'assets/app.css' );
                wp_enqueue_style( 'main', plugin_dir_url( dirname( __FILE__ ) ) . 'assets/admin.css' );
                wp_enqueue_script( 'admin', plugin_dir_url( dirname( __FILE__ ) ) . 'assets/admin.js', [], '8.0', true );
                wp_localize_script( 'admin', 'ph_postmeta',
                    array( 
                        'ajaxurl' => admin_url( 'admin-ajax.php' ),
                        'data' => $output,
                        'location_data' => $location_data
                    )
                );
            }
        }

        public function add_module_attribute($tag, $handle, $src) {
            // if not your script, do nothing and return original $tag
            if ( 'admin' !== $handle ) {
                return $tag;
            }
            // change the script tag by adding type="module" and return it.
            $tag = '<script type="module" src="' . esc_url( $src ) . '"></script>';
            return $tag;
        }

        public function ph_admin_menu() {
            $page_title = 'GEO Page Harvester';
            $menu_title = 'Geo Page Harvester';
            $capability = 'manage_options';
            $slug = 'page_harvester';
            $icon_url =  'dashicons-admin-site-alt2';
            
            add_menu_page(
              __( $page_title, 'page-harvester' ),
              $menu_title,
              $capability,
              $slug,
              array( $this,'ph_settings_content'),$icon_url, 99);

              add_submenu_page( 
                  $slug, __( 'Dumpster Adwords', 'page-harvester' ), 
                  __( 'Dumpster Adwords', 'page-harvester' ),
                  $capability,
                  $slug,
                  array( $this,'ph_settings_content' ) );

              add_submenu_page( 
                      $slug, __( 'Dumpster GEO', 'page-harvester' ), 
                      __( 'Dumpster GEO', 'page-harvester' ),
                      $capability,
                      'page_harvester#/dumpster-geo',
                      array( $this,'ph_settings_content' ) );

            add_submenu_page( 
              $slug, __( 'Porta Potty Adwords', 'page-harvester' ), 
              __( 'Porta Potty Adwords', 'page-harvester' ),
              $capability,
              'page_harvester#/porta-potty',
              array( $this,'ph_settings_content' ) );

              add_submenu_page( 
                  $slug, __( 'Porta Potty GEO', 'page-harvester' ), 
                  __( 'Porta Potty GEO', 'page-harvester' ),
                  $capability,
                  'page_harvester#/porta-potty-geo',
                  array( $this,'ph_settings_content' ) 
              );

              add_submenu_page( 
                  $slug, __( 'Location Data', 'page-harvester' ), 
                  __( 'Location Data', 'page-harvester' ),
                  $capability,
                  'page_harvester#/location-data',
                  array( $this,'ph_settings_content' ) 
              );

              add_submenu_page( 
                  $slug, __( 'GEO Pages Export', 'page-harvester' ), 
                  __( 'GEO Pages Export', 'page-harvester' ),
                  $capability,
                  'page_harvester#/export',
                  array( $this,'ph_settings_content' ) 
              );

        }
    
        public function ph_settings_content() {
            ?>
            <div id="ph-admin"></div>
            <?php
        }

    }

    Ph_Assets::get_instance();
}