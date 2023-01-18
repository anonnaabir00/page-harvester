<?php

/**
 * Plugin Name:       Page Harvester
 * Plugin URI:        https://codember.com
 * Description:       Fully functional Page Harvester plugin for WordPress. This plugin allows you to create pages automatically based on search query.
 * Version:           2.0
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
                    add_action('admin_menu', array( $this,'ph_admin_menu'));
                    add_action( 'admin_enqueue_scripts', array($this,'ph_admin_assets'));
                    add_action( 'rest_api_init', array( $this, 'ph_insert_dumpster_post' ));
                }

                public function ph_admin_assets(){
                    $current_screen = get_current_screen();
                    $admin_screen = 'toplevel_page_ph_admin';

                    if ($admin_screen == $current_screen->base) {
                        wp_enqueue_style( 'app', plugins_url( 'assets/app.css', __FILE__ ) );
                        wp_enqueue_style( 'main', plugins_url( 'assets/main.css', __FILE__ ) );
                        wp_enqueue_script( 'admin', plugins_url( 'assets/main.js', __FILE__ ), [], '1.0', true );
                    }
                }

                public function ph_admin_menu() {
                  $page_title = 'GEO Page Harvester';
                  $menu_title = 'Geo Page Harvester';
                  $capability = 'manage_options';
                  $slug = 'ph_admin';
                  $icon_url =  'dashicons-admin-site-alt2';
                  
                  add_menu_page(__( $page_title, 'page-harvester' ),$menu_title,$capability,$slug,array( $this,'ph_settings_content'),$icon_url, 99);
      
              }
          
              public function ph_settings_content() {
                  ?>
                  <div id="ph-admin"></div>
                  <?php
              }

            public function ph_insert_dumpster_post(){
                register_rest_route( 'ph/v1', '/geo/dumpster', array(
                    'methods' => 'POST',
                    'callback' => array( $this, 'ph_insert_dumpster_rest_callback' ),
                ));
            }
    
            public function ph_insert_dumpster_rest_callback(WP_REST_Request $request){
                $value = json_decode($request->get_body());
                
                // Create post object
                $my_post = array(
                    'post_title'    => wp_strip_all_tags($value->post_title),
                    'post_content'  => $value->post_content,
                    'post_status'   => 'publish',
                    'post_author'   => 1,
                );
                
                // Insert the post into the database and get id
                $post_id = wp_insert_post($my_post);

                // Update ACF meta field
                $meta_selector = 'location_name';
                $meta_value = $value->location;
                update_field($meta_selector, $meta_value, $post_id);

                // Get Post Permalink
                $post_url = get_permalink($post_id);

                return $post_url;
            }

            }

            $page_harvester = new Page_Harvester();
            
        }