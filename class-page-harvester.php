<?php

/**
 * Plugin Name:       Page Harvester
 * Plugin URI:        https://primedumpster.com
 * Description:       Fully functional Page Harvester plugin for WordPress. This plugin allows you to create pages automatically based on search query.
 * Version:           8.3
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
                    require_once( plugin_dir_path( __FILE__ ) . 'shortcodes.php' );
                    require_once( plugin_dir_path( __FILE__ ) . 'class-seo-widgets.php' );

                    // Require Assets

                    require_once( plugin_dir_path( __FILE__ ) . 'includes/assets.php' );

                    // Require APIs
                    require_once( plugin_dir_path( __FILE__ ) . 'includes/api/ads.php' );
                    require_once( plugin_dir_path( __FILE__ ) . 'includes/api/geo.php' );
                    require_once( plugin_dir_path( __FILE__ ) . 'includes/api/common.php' );

                    // Additional Functions

                    require_once( plugin_dir_path( __FILE__ ) . 'includes/email.php' );
                    require_once( plugin_dir_path( __FILE__ ) . 'includes/export.php' );
                }
            

            }

        $page_harvester = new Page_Harvester();
            
    }