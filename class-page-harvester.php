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


        if (! class_exists ('Page_Harvester') ) {

            Class Page_Harvester {

                public function __construct(){
                    require_once plugin_dir_path( __FILE__ ).'csf/codestar-framework.php';
                    require_once plugin_dir_path( __FILE__ ).'admin.php';
                    add_action( 'wp_enqueue_scripts', array($this,'ph_assets'));
                    add_shortcode('phform', array($this,'page_harvester_search_form'));
                    add_shortcode('phform_search_term', array($this,'page_harvester_search_term'));
                    add_filter( 'pre_get_document_title', array($this, 'page_harvester_meta_informations'));
                    add_filter( 'wp_head', array($this, 'page_harvester_meta_description'));
                    // add_filter('the_title', 'wpshout_filter_example');
                }


                public function ph_assets(){
                    $options = get_option( 'page_harvester' ); // unique id of the framework
                    $res = preg_replace('/[^A-Za-z0-9\-, ]/', '', $options['ph-data-list']);
                    $data_list = explode(",",$res);
                    
                    wp_register_style( 'core',    plugins_url( 'core.css',    __FILE__ ), false, '1.0');
                    wp_enqueue_style ( 'core' );
                    wp_register_style( 'jquery_ui',    plugins_url( 'jquery-ui.css',    __FILE__ ), false, '1.0');
                    wp_enqueue_style ( 'jquery_ui' );
                    wp_enqueue_script( 'main', plugins_url( 'main.js', __FILE__ ), array('jquery','jquery-ui-core','jquery-ui-autocomplete'), '1.0', true );
                    wp_localize_script( 'main', 'phform_post',$data_list);
                  }


                  public function page_harvester_search_form($attributes){

                    $options = get_option( 'page_harvester' );
                    
                    if (!empty($options['ph-post-titles'])) {
                      $before_words = array_column($options['ph-post-titles'],'ph-post-titles-text');
                      $before_data = $before_words[rand(0, count($before_words)-1)]; 
                    }
                  
                    if (!empty($options['ph-post-titles_after'])) {
                      $after_words = array_column($options['ph-post-titles_after'],'ph_post_titles_text_after');
                      $after_data = $after_words[rand(0, count($after_words)-1)];
                    }
                  
                  
                      // $form_label = $attributes['form_label'];
                      $button_label = $attributes['button_label'];
                  
                      $form_output = '
                      <form method="post" name="phterm_form">
                      <div class="phterm_wrapper">
                      <input type="text" id="phterm" name="phterm"><br>
                      <input id="ph_submit" type="submit" name="ph_submit" value="'.$button_label.'">
                      </div>
                      </form>
                    ';
                  
                      
                      $post_content = $options['ph-post-content'];
                  
                      $post_title = $before_data.' '.$_POST['phterm'].' '.$after_data;
                    
                      $new_post = array(
                      'post_title'    => $post_title,
                      'post_content'  => $post_content,
                      'post_status'   => 'publish',        
                      'post_type'     => 'post',
                      'tags_input'    => $_POST['phterm']
                      );
                      //insert the the post into database by passing $new_post to wp_insert_post
                      //store our post ID in a variable $pid
                      if(isset($_POST['ph_submit']) && $_POST['phterm'] != "" ){
                        $pid = wp_insert_post($new_post);
                        $form_action= get_permalink($pid);
                        ?><script>
                        window.location.replace("<?php echo $form_action;?>");
                        </script> <?php
                    }
                  
                  
                    return $form_output;

                  }


                  public function page_harvester_search_term($attributes) {
                    $post_tags = get_the_tags();
                    if ( $post_tags ) {
                      $output = $post_tags[0]->name; 
                    }
                    return $output;
                  }


                  public function page_harvester_meta_description() {
                    $options = get_option( 'page_harvester' );

                    $post_tags = get_the_tags();
                    if ($post_tags) {
                      $post_tag = $post_tags[0]->name; 
                    }

                    $meta_description_start = $options['ph_meta_description_start'];
                    $meta_description_end = $options['ph_meta_description_end'];

                    if ( is_single() ) {
                      echo '<meta name="description" content="'.$meta_description_start.' '.$post_tag.' '.$meta_description_end.'" />';
                    }
                }     
                
                public function page_harvester_meta_informations($title) {
                  $options = get_option( 'page_harvester' );
                  $post_tags = get_the_tags();
                    if ($post_tags) {
                      $post_tag = $post_tags[0]->name; 
                    }

                  $meta_title = $options['ph_meta_title_start'].' '.$post_tag.' | '.$options['ph_meta_title_end'];
                  
                  if (is_single()) {
                    return $meta_title;
                  }
                }


            }

            $page_harvester = new Page_Harvester();
            
        }