<?php

/**
 * Plugin Name:       Page Harvester
 * Plugin URI:        https://codember.com
 * Description:       Fully functional Page Harvester plugin for WordPress. This plugin allows you to create pages automatically based on search query.
 * Version:           1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Asaduzzaman Abir
 * Author URI:        https://iamabir.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       page-harvester
 * Domain Path:       /languages
 */

// function theme_enqueue_scripts() {
//   /**
//    * frontend ajax requests.
//    */
//   wp_enqueue_script( 'main', plugin_dir_path( __FILE__ ) . 'main.js', array('jquery'), '1.0', true );
//   // wp_localize_script( 'post', 'phform_post',
//   //     array( 
//   //         'ajax_url' => admin_url( 'admin-ajax.php' ),      
//   //     )
//   // );
// }

// add_action( 'wp_enqueue_scripts', 'theme_enqueue_scripts' );
// require_once('functions.php');
require_once('class-page-harvester.php');

