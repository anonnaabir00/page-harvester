<?php

        if (! class_exists ('Page_Harvester') ) {

            Class Page_Harvester {

                public function __construct(){
                    require_once('functions.php');
                    add_action( 'wp_enqueue_scripts', array($this,'ph_assets'));
                    add_shortcode('phform', array($this,'page_harvester_search_form'));
                    add_shortcode('phform_search_term', array($this,'page_harvester_search_term'));
                }


                public function ph_assets(){
                    $options = get_option( 'page_harvester' ); // unique id of the framework
                    $res = preg_replace('/[^A-Za-z0-9\-, ]/', '', $options['ph-data-list']);
                    $data_list = explode(",",$res);
                  
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
                  
                  
                      $form_label = $attributes['form_label'];
                  
                      $form_output = '<form method="post" name="phterm_form">
                      <label for="phterm">'.$form_label.'</label><br>
                      <input type="text" id="phterm" name="phterm"><br>
                      <input id="submit" type="submit" name="submit" value="Submit">
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
                      if(isset($_POST['submit']) && $_POST['phterm'] != "" ){
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


            }

            $page_harvester = new Page_Harvester();
            
        }

        
      