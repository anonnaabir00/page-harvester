<?php

    


    // Control core classes for avoid errors
if( class_exists( 'CSF' ) ) {

    //
    // Set a unique slug-like ID
    $prefix = 'page_harvester';
  
    //
    // Create options
    CSF::createOptions( $prefix, array(
      'menu_title' => 'Page Harvester',
      'menu_slug'  => 'page-harvester',
      'framework_title' => 'Page Harvester'
    ) );
  
    //
    // Create a section
    CSF::createSection( $prefix, array(
      'title'  => 'Enter Data',
      'fields' => array(
  
        array(
            'id'      => 'ph-data-list',
            'type'    => 'textarea',
            'title'   => 'Data',
          ),

          array(
            'id'     => 'ph-post-titles',
            'type'   => 'repeater',
            'title'  => 'Text Before Data',
            'fields' => array(
          
              array(
                'id'    => 'ph-post-titles-text',
                'type'  => 'text',
                'title' => 'Before Title'
              ),
          
            ),
          ),


          array(
            'id'     => 'ph-post-titles_after',
            'type'   => 'repeater',
            'title'  => 'Text After Data',
            'fields' => array(
          
              array(
                'id'    => 'ph_post_titles_text_after',
                'type'  => 'text',
                'title' => 'After Title'
              ),
          
            ),
          ),
          
          
  
      )
    ) );
  
  }
  