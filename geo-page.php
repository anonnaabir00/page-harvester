<?php

    if (! class_exists ('Geo_Page') ) {

    Class Geo_Page {

        private static $instance = false;

        public static function get_instance() {
                if ( !self::$instance )
                    self::$instance = new self;
                return self::$instance;
        }

        public function __construct(){
            // add custom post type
            add_action( 'init', array( $this, 'ph_porta_potty_post_type' ) );
        }

        public function ph_porta_potty_post_type() {
            // create porta potty custom post type
            register_post_type( 'porta_potty_geo_page',
                array(
                    'labels' => array(
                        'name' => __( 'Porta Potty' ),
                        'singular_name' => __( 'Porta Potty Page' ),
                        'add_new' => __( 'Add New' ),
                        'add_new_item' => __( 'Add New Porta Potty Page' ),
                        'edit' => __( 'Edit' ),
                        'edit_item' => __( 'Edit Porta Potty Page' ),
                        'new_item' => __( 'New Porta Potty Page' ),
                        'view' => __( 'View Porta Potty Page' ),
                        'view_item' => __( 'View Porta Potty Page' ),
                        'search_items' => __( 'Search Porta Potty Page' ),
                        'not_found' => __( 'No Porta Potty Page found' ),
                        'not_found_in_trash' => __( 'No Porta Potty Page found in Trash' ),
                        'parent' => __( 'Parent Porta Potty Page' ),
                    ),
                    'public' => true,
                    'has_archive' => true,
                    'publicly_queryable' => true,
                    'exclude_from_search' => true,
                    'query_var' => true,
                    'capability_type' => 'post',
                    'hierarchical' => false,
                    'rewrite' => array('slug' => 'porta-potty'),
                    'supports' => array( 'title', 'editor', 'elementor'),
                    'show_in_rest' => true,
                    'menu_position' => 5,
                    'menu_icon' => 'dashicons-location',
                    'show_in_menu' => true,
                    'show_in_nav_menus' => true,
                    'show_in_admin_bar' => true,
                    'rest_base' => 'porta-potty',
                    'rest_controller_class' => 'WP_REST_Posts_Controller',
                )
            );
        }

    }

    Geo_Page::get_instance();
}