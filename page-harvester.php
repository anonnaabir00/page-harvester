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
//   wp_enqueue_script( 'post', plugin_dir_path( __FILE__ ) . 'post.js', array(), '1.0', true );
//   wp_localize_script( 'post', 'phform_post',
//       array( 
//           'ajax_url' => admin_url( 'admin-ajax.php' ),      
//       )
//   );
// }

// add_action( 'wp_enqueue_scripts', 'theme_enqueue_scripts' );







// function single_post_insert() {
//   $post_content = '
//   <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
//   <div class="wp-block-button"><a class="wp-block-button__link">Download Now</a></div>
//   ';

//   $new_post = array(
//   'post_title'    => $_POST['title'],
//   'post_content'  => $post_content,
//   'post_status'   => 'publish',        
//   'post_type'     => 'post'
//   );
//   //insert the the post into database by passing $new_post to wp_insert_post
//   //store our post ID in a variable $pid
//   if(isset($_POST['submit'])){
//     echo 'Hello World';
//     $pid = wp_insert_post($new_post);
// } 
//   // wp_redirect('google.com');
//   // var_dump($pid);
// // echo json_encode(array('flag'=>'1'));
// }
// add_action( 'wp_insert_post', 'single_post_insert' );




function page_harvester_search_form($attributes){
    $form_label = $attributes['form_label'];

    $form_output = '<form method="post">
    <label for="phterm">'.$form_label.'</label><br>
    <input type="text" id="phterm" name="phterm"><br>
    <input id="submit" type="submit" name="submit" value="Submit">
    </form>
  ';


    $post_title = 'Dumpster rental service in '.$_POST['phterm'];
    $post_content = '
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    <div class="wp-block-button"><a class="wp-block-button__link">Download Now</a></div>
    ';
  
    $new_post = array(
    'post_title'    => $post_title,
    'post_content'  => $post_content,
    'post_status'   => 'publish',        
    'post_type'     => 'post'
    );
    //insert the the post into database by passing $new_post to wp_insert_post
    //store our post ID in a variable $pid
    if(isset($_POST['submit'])){
      $pid = wp_insert_post($new_post);
      $form_action= get_permalink($pid);
      ?><script>window.location.replace("<?php echo $form_action;?>");</script> <?php
       // echo $form_action;
      // wp_redirect( 'https://example.com/some/page' );
      // die();
      // wp_redirect($form_action);
  } 

  // $form_action='http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];


print_r($form_action);


// wp_redirect($form_action);


  return $form_output;
}

add_shortcode('phform','page_harvester_search_form');


// function ph_assets(){
//   wp_enqueue_script( 'main', plugins_url( 'main.js', __FILE__ ), array('jquery'), '1.0', true );
//     wp_localize_script( 'main', 'phform_post',
//       array( 
//           'ajax_url' => admin_url( 'admin-ajax.php' ),
//       )
//   );
// }

// add_action( 'wp_enqueue_scripts', 'ph_assets' );