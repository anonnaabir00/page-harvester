<?php

/**
 * Plugin Name:       Page Harvester
 * Plugin URI:        https://codember.com
 * Description:       Fully functional Page Harvester plugin for WordPress. This plugin allows you to create pages automatically based on search query.
 * Version:           3.2
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Asaduzzaman Abir
 * Author URI:        https://iamabir.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       page-harvester
 * Domain Path:       /languages
 */


        if (! class_exists ('Page_Harvester') ) {

            Class Page_Harvester {

                public function __construct(){
                    require_once( plugin_dir_path( __FILE__ ) . 'geo-page.php' );
                    add_action('admin_menu', array( $this,'ph_admin_menu'));
                    add_action( 'admin_enqueue_scripts', array($this,'ph_admin_assets'));
                    add_action( 'rest_api_init', array( $this, 'ph_insert_dumpster_post' ));
                }

                public function ph_admin_assets(){
                    $current_screen = get_current_screen();
                    $admin_screen = 'toplevel_page_page_harvester';

                    if ($admin_screen == $current_screen->base) {
                        wp_enqueue_style( 'app', plugins_url( 'assets/app.css', __FILE__ ) );
                        wp_enqueue_style( 'main', plugins_url( 'assets/admin.css', __FILE__ ) );
                        wp_enqueue_script( 'admin', plugins_url( 'assets/admin.js', __FILE__ ), [], '3.0', true );
                    }
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
                        $slug, __( 'Dumpster Pages', 'page-harvester' ), 
                        __( 'Dumpster Pages', 'page-harvester' ),
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
                    $slug, __( 'Porta Potty Pages', 'page-harvester' ), 
                    __( 'Porta Potty Pages', 'page-harvester' ),
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
      
              }
          
              public function ph_settings_content() {
                  ?>
                  <div id="ph-admin"></div>
                  <?php
              }

            public function ph_insert_dumpster_post(){
                register_rest_route( 'ph/v1', '/dumpster/geo', array(
                    'methods' => 'POST',
                    'callback' => array( $this, 'ph_insert_dumpster_rest_callback' ),
                ));
                
                register_rest_route( 'ph/v1', '/dumpster/ads', array(
                    'methods' => 'POST',
                    'callback' => array( $this, 'ph_insert_dumpster_ads_rest_callback' ),
                ));

                register_rest_route( 'ph/v1', '/porta-potty/ads', array(
                    'methods' => 'POST',
                    'callback' => array( $this, 'ph_insert_portapotty_ads_rest_callback' ),
                ));


                register_rest_route( 'ph/v1', '/porta-potty/geo', array(
                    'methods' => 'POST',
                    'callback' => array( $this, 'ph_insert_portapotty_rest_callback' ),
                ));
            }

            public function ph_insert_dumpster_ads_rest_callback(WP_REST_Request $request){
                $value = json_decode($request->get_body());
                
                // Create post object
                $my_post = array(
                    'post_title'    => wp_strip_all_tags($value->post_title),
                    'post_content'  => $value->post_content,
                    'post_type'     => 'page',
                    'post_status'   => 'publish',
                    'page_template'  => 'elementor_header_footer',
                    'post_author'   => 1,
                );
                
                // Insert the post into the database and get id
                $post_id = wp_insert_post($my_post);

                // Update ACF meta field
                $city = 'city_state';
                $phone = 'phone_number';
                $phone_placeholder = 'phone';
                $adwords_phone = 'adword_code_phone';

                $adwords_code = '<!-- Google tag (gtag.js) -->
                <script async src="https://www.googletagmanager.com/gtag/js?id=AW-10800357225"></script>
                <script>
                  window.dataLayer = window.dataLayer || [];
                  function gtag(){dataLayer.push(arguments);}
                  gtag(\'js\', new Date());
                
                  gtag(\'config\', \'AW-10800357225\');
                </script>';

                update_field($city, $value->city, $post_id);
                update_field($phone, 'tel:'.$value->phone, $post_id);
                update_field($phone_placeholder, $value->placeholder, $post_id);
                update_field($adwords_phone, $value->phoneads, $post_id);
                update_field('adword_code_main', $adwords_code, $post_id);

                // Get Post Permalink
                $post_url = get_permalink($post_id);

                return $post_url;
            }
    
            public function ph_insert_dumpster_rest_callback(WP_REST_Request $request){
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

                // Update ACF meta field
                $location = 'location_name';
                $city_information = 'city_information';

                update_field($location, $value->location, $post_id);
                update_field($city_information, $value->information, $post_id);

                // Get Post Permalink
                $post_url = get_permalink($post_id);

                return $post_url;
            }

            public function ph_insert_portapotty_ads_rest_callback(WP_REST_Request $request){
                $value = json_decode($request->get_body());
                
                // Create post object
                $my_post = array(
                    'post_title'    => wp_strip_all_tags($value->post_title),
                    'post_content'  => $value->post_content,
                    'post_type'     => 'page',
                    'post_status'   => 'publish',
                    'page_template'  => 'elementor_header_footer',
                    'post_author'   => 1,
                );
                
                // Insert the post into the database and get id
                $post_id = wp_insert_post($my_post);

                // Update ACF meta field
                $city = 'city_state';
                $phone = 'phone_number';
                $phone_placeholder = 'phone';
                $adwords_phone = 'adword_code_phone';

                $adwords_code = '<!-- Google tag (gtag.js) -->
                <script async src="https://www.googletagmanager.com/gtag/js?id=AW-10800357225"></script>
                <script>
                  window.dataLayer = window.dataLayer || [];
                  function gtag(){dataLayer.push(arguments);}
                  gtag(\'js\', new Date());
                
                  gtag(\'config\', \'AW-10800357225\');
                </script>';

                update_field($city, $value->city, $post_id);
                update_field($phone, 'tel:'.$value->phone, $post_id);
                update_field($phone_placeholder, $value->placeholder, $post_id);
                update_field($adwords_phone, $value->phoneads, $post_id);
                update_field('adword_code_main', $adwords_code, $post_id);

                // Get Post Permalink
                $post_url = get_permalink($post_id);

                return $post_url;
            }


            public function ph_insert_portapotty_rest_callback(WP_REST_Request $request){
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

                // Update ACF meta field
                $location = 'location_name';
                $city_information = 'city_information';

                update_field($location, $value->location, $post_id);
                update_field($city_information, $value->information, $post_id);

                // Get Post Permalink
                $post_url = get_permalink($post_id);

                return $post_url;
            }

            }

            $page_harvester = new Page_Harvester();
            
        }