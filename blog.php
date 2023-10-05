<?php

    if (! class_exists ('PH_Blog')) {

        class PH_Blog {

            private static $instance = false;

            public static function get_instance() {
                    if ( !self::$instance )
                        self::$instance = new self;
                    return self::$instance;
            }

            public function __construct(){
                // add custom post type
                add_action( 'init', array( $this, 'ph_news' ) );
                add_action( 'init', array( $this, 'ph_dumpster_blog' ) );
                add_action( 'init', array( $this, 'ph_porta_potty_blog' ) );
            }

            public function ph_news() {
                // create Dumpster custom post type
                register_post_type( 'news',
                    array(
                        'labels' => array(
                            'name' => __( 'News' ),
                            'singular_name' => __( 'News' ),
                            'add_new' => __( 'Add News' ),
                            'add_new_item' => __( 'Add News' ),
                            'edit' => __( 'Edit' ),
                            'edit_item' => __( 'Edit News' ),
                            'new_item' => __( 'New News' ),
                            'view' => __( 'View News' ),
                            'view_item' => __( 'View News' ),
                            'search_items' => __( 'Search News' ),
                            'not_found' => __( 'No News found' ),
                            'not_found_in_trash' => __( 'No News found in Trash' ),
                            'parent' => __( 'Parent News' ),
                        ),
                        'public' => true,
                        'has_archive' => true,
                        'publicly_queryable' => true,
                        'exclude_from_search' => true,
                        'query_var' => true,
                        'capability_type' => 'post',
                        'hierarchical' => false,
                        'rewrite' => array('slug' => 'news'),
                        'supports' => array( 'title', 'editor', 'thumbnail','page-attributes'),
                        'show_in_rest' => true,
                        'menu_position' => 5,
                        'menu_icon' => 'dashicons-text-page',
                        'show_in_menu' => true,
                        'show_in_nav_menus' => true,
                        'show_in_admin_bar' => true,
                        'rest_base' => 'news',
                        'rest_controller_class' => 'WP_REST_Posts_Controller',
                    )
                );
            }

            public function ph_dumpster_blog() {
                // create Dumpster custom post type
                register_post_type( 'dumpster_blog',
                    array(
                        'labels' => array(
                            'name' => __( 'Dumpster Blog' ),
                            'singular_name' => __( 'Dumpster Post' ),
                            'add_new' => __( 'Add New' ),
                            'add_new_item' => __( 'Add New Dumpster Post' ),
                            'edit' => __( 'Edit' ),
                            'edit_item' => __( 'Edit Dumpster Post' ),
                            'new_item' => __( 'New Dumpster Post' ),
                            'view' => __( 'View Dumpster Post' ),
                            'view_item' => __( 'View Dumpster Post' ),
                            'search_items' => __( 'Search Dumpster Post' ),
                            'not_found' => __( 'No Dumpster Post found' ),
                            'not_found_in_trash' => __( 'No Dumpster Post found in Trash' ),
                            'parent' => __( 'Parent Dumpster Post' ),
                        ),
                        'public' => true,
                        'has_archive' => true,
                        'publicly_queryable' => true,
                        'exclude_from_search' => true,
                        'query_var' => true,
                        'capability_type' => 'post',
                        'hierarchical' => false,
                        'rewrite' => array('slug' => 'dumpsters'),
                        'supports' => array( 'title', 'editor', 'thumbnail','page-attributes'),
                        'show_in_rest' => true,
                        'menu_position' => 6,
                        'menu_icon' => 'dashicons-text-page',
                        'show_in_menu' => true,
                        'show_in_nav_menus' => true,
                        'show_in_admin_bar' => true,
                        'rest_base' => 'dumpster-blog',
                        'rest_controller_class' => 'WP_REST_Posts_Controller',
                    )
                );
            }

            public function ph_porta_potty_blog() {
                // create Porta Potty custom post type
                register_post_type( 'porta_potty_blog',
                    array(
                        'labels' => array(
                            'name' => __( 'Porta Potty Blog' ),
                            'singular_name' => __( 'Porta Potty Post' ),
                            'add_new' => __( 'Add New' ),
                            'add_new_item' => __( 'Add New Porta Potty Post' ),
                            'edit' => __( 'Edit' ),
                            'edit_item' => __( 'Edit Porta Potty Post' ),
                            'new_item' => __( 'New Porta Potty Post' ),
                            'view' => __( 'View Porta Potty Post' ),
                            'view_item' => __( 'View Porta Potty Post' ),
                            'search_items' => __( 'Search Porta Potty Post' ),
                            'not_found' => __( 'No Porta Potty Post found' ),
                            'not_found_in_trash' => __( 'No Porta Potty Post found in Trash' ),
                            'parent' => __( 'Parent Porta Potty Post' ),
                        ),
                        'public' => true,
                        'has_archive' => true,
                        'publicly_queryable' => true,
                        'exclude_from_search' => true,
                        'query_var' => true,
                        'capability_type' => 'post',
                        'hierarchical' => false,
                        'rewrite' => array('slug' => 'porta-potties'),
                        'supports' => array( 'title', 'editor', 'thumbnail','page-attributes'),
                        'show_in_rest' => true,
                        'menu_position' => 7,
                        'menu_icon' => 'dashicons-text-page',
                        'show_in_menu' => true,
                        'show_in_nav_menus' => true,
                        'show_in_admin_bar' => true,
                        'rest_base' => 'Porta Potty-blog',
                        'rest_controller_class' => 'WP_REST_Posts_Controller',
                    )
                );
            }


            
        }

        PH_Blog::get_instance();

    }