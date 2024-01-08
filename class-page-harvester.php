<?php

/**
 * Plugin Name:       Page Harvester
 * Plugin URI:        https://primedumpster.com
 * Description:       Fully functional Page Harvester plugin for WordPress. This plugin allows you to create pages automatically based on search query.
 * Version:           7.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Asaduzzaman Abir
 * Author URI:        https://nervythemes.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       page-harvester
 * Domain Path:       /languages
 */


        if (! class_exists ('Page_Harvester') ) {

            Class Page_Harvester {

                public function __construct(){
                    require_once( plugin_dir_path( __FILE__ ) . 'db.php' );
                    require_once( plugin_dir_path( __FILE__ ) . 'geo-page.php' );
                    require_once( plugin_dir_path( __FILE__ ) . 'blog.php' );
                    require_once( plugin_dir_path( __FILE__ ) . 'class-seo-widgets.php' );
                    
                    add_action('admin_menu', array( $this,'ph_admin_menu'));
                    add_action( 'admin_enqueue_scripts', array($this,'ph_admin_assets'));
                    add_action( 'rest_api_init', array( $this, 'ph_insert_dumpster_post' ));
                    add_action( 'rest_api_init', array( $this, 'ph_send_email' ));
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
                        'location' => get_field('ph_location', $post_id),
                        'state' => get_field('ph_state', $post_id),
                        'phone' => get_field('ph_phone', $post_id),
                        'city_information' => get_field('ph_cityinfo', $post_id),
                        'location_data' => get_field('ph_location_data', $post_id),
                    ];

                    $location_data = $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);


                    if ($admin_screen == $current_screen->base OR $post->post_type == 'post' OR $post->post_type == 'porta_potty_geo_page') {
                        wp_enqueue_style( 'app', plugins_url( 'assets/app.css', __FILE__ ) );
                        wp_enqueue_style( 'main', plugins_url( 'assets/admin.css', __FILE__ ) );
                        wp_enqueue_script( 'admin', plugins_url( 'assets/admin.js', __FILE__ ), [], '8.0', true );
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
                
                public function ph_404_template( $template ) {
                    if ( is_404() ) {
                        $template = plugin_dir_path( __FILE__ ) . '404.php';
                    }
                    return $template;
                }

                public function ph_handle_404(){
                    wp_redirect( home_url( '/porta-potty/' ) );
                    exit;
                    // return FALSE;
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

                // Porta Potty Rest API

                register_rest_route( 'ph/v1', '/porta-potty/geo', array(
                    'methods' => 'POST',
                    'callback' => array( $this, 'ph_insert_portapotty_rest_callback' ),
                ));

                register_rest_route( 'ph/v1', '/porta-potty/geo/update-meta/(?P<post_id>\d+)', array(
                    'methods' => 'POST',
                    'callback' => array( $this, 'ph_portapotty_update_meta' ),
                ));


                register_rest_route( 'ph/v1', '/dumpster/geo/export', array(
                    'methods' => 'GET',
                    'callback' => array( $this, 'ph_export_dumpster_callback' ),
                ));

                register_rest_route( 'ph/v1', '/porta-potty/geo/export', array(
                    'methods' => 'GET',
                    'callback' => array( $this, 'ph_export_portapotty_callback' ),
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
                    'page_template'  => 'elementor_canvas',
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
                $state = 'state';
                $phone = 'phone_number';
                $phone_placeholder = 'phone_number_placeholder';
                $city_information = 'city_information';
                $schema_code = 'schema_code';

                update_field($location, $value->location, $post_id);
                update_field($state, $value->state, $post_id);
                update_field($phone, 'tel:'.$value->phone, $post_id);
                update_field($phone_placeholder, $value->placeholder, $post_id);
                update_field($city_information, $value->information, $post_id);
                update_field($schema_code, $value->schema, $post_id);

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
                    'page_template'  => 'elementor_canvas',
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
                    'post_type'     => 'porta_potty_geo_page',
                    'page_template'  => 'elementor_header_footer',
                    'post_author'   => 1,
                );
                
                // Insert the post into the database and get id
                $post_id = wp_insert_post($my_post);

                // Update ACF meta field
                $location = 'location_name';
                $state = 'state';
                $phone = 'phone_number';
                $phone_placeholder = 'phone_number_placeholder';
                $city_information = 'city_information';
                $schema_code = 'schema_code';

                update_field($location, $value->location, $post_id);
                update_field($state, $value->state, $post_id);
                update_field($phone, 'tel:'.$value->phone, $post_id);
                update_field($phone_placeholder, $value->placeholder, $post_id);
                update_field($city_information, $value->information, $post_id);
                update_field($schema_code, $value->schema, $post_id);

                // Get Post Permalink
                $post_url = get_permalink($post_id);

                return $post_url;
            }

            public function ph_portapotty_update_meta(WP_REST_Request $request){
                $value = json_decode($request->get_body());

                $post_id = $request->get_param('post_id');

                // Get ACF Meta
                $acf_location = get_field('location_name', $post_id);
                $acf_state = get_field('state', $post_id);
                $acf_cityinfo = get_field('city_information', $post_id);

                // Custom Post Meta Values
                // $location = $value->location ? $acf_location : '';
                // $state = $value->state ? $acf_state : '';
                // $cityinfo = $value->cityinfo ? $acf_cityinfo : '';

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
            
                // Get Post Permalink
                $post_url = get_permalink($post_id);
            
                return $post_url;
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

            $page_harvester = new Page_Harvester();
            
        }