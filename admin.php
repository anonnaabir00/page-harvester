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
      'title'  => 'Data Settings',
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


          array(
            'id'    => 'ph-post-content',
            'type'  => 'wp_editor',
            'title' => 'Post Content',
          ),
  
      )
    ) );

        CSF::createSection( $prefix, array(
          'title'  => 'Style Settings',
          'fields' => array(

            array(
              'type'    => 'subheading',
              'content' => 'Search Field Settings',
            ),

            array(
              'id'      => 'ph_field_border',
              'type'    => 'border',
              'title'   => 'Border',
              'default' => array(
                'top'    => '2',
                'right'  => '2',
                'bottom' => '2',
                'left'   => '2',
                'style'  => 'solid',
                'color'  => '#000000',
                'unit'   => 'px',
              ),
              'output'      => '#phterm',
            ),


            array(
              'id'       => 'ph_field_border_radius',
              'type'     => 'spacing',
              'title'    => 'Border Radius',
              'default'  => array(
                'top'    => ' 0',
                'right'  => ' 0',
                'bottom' => ' 0',
                'left'   => ' 0',
                'unit'   => 'px',
              ),
              'output'      => '#phterm',
              'output_mode' => 'border-radius'
            ),


            array(
              'id'       => 'ph_field_margin',
              'type'     => 'spacing',
              'title'    => 'Margin',
              'default'  => array(
                'top'    => ' 0',
                'right'  => ' 0',
                'bottom' => ' 0',
                'left'   => ' 0',
                'unit'   => 'px',
              ),
              'output'      => '#phterm',
              'output_mode' => 'margin'
            ),


            array(
              'id'       => 'ph_field_padding',
              'type'     => 'spacing',
              'title'    => 'Padding',
              'default'  => array(
                'top'    => ' 0',
                'right'  => ' 0',
                'bottom' => ' 0',
                'left'   => ' 0',
                'unit'   => 'px',
              ),
              'output'      => '#phterm',
              'output_mode' => 'padding'
            ),


            array(
              'id'      => 'ph_field_typography',
              'type'    => 'typography',
              'title'   => 'Typography',
              'output'      => '#phterm',
              'default' => array(
                'color'       => '#000000',
                'font-family' => 'Open Sans',
                'font-size'   => '14',
                'line-height' => '20',
                'unit'        => 'px',
                'type'        => 'google',
              ),
            ),


            array(
              'type'    => 'subheading',
              'content' => 'Search Suggestion Settings',
            ),

            array(
              'id'      => 'ph_search_suggestion_typography',
              'type'    => 'typography',
              'title'   => 'Typography',
              'output'  => '.ui-menu-item-wrapper',
              'default' => array(
                'color'       => '#000000',
                'font-family' => 'Open Sans',
                'font-size'   => '14',
                'line-height' => '20',
                'unit'        => 'px',
                'type'        => 'google',
              ),
            ),
            
            
            

          array(
            'type'    => 'subheading',
            'content' => 'Button Settings',
          ),

      
            array(
              'id'      => 'ph_button_color',
              'type'    => 'color',
              'title'   => 'Background Color',
              'default' => '#ffbc00',
              'output'      => '#ph_submit',
              'output_mode' => 'background-color'
            ),

            array(
              'id'      => 'ph_button_typography',
              'type'    => 'typography',
              'title'   => 'Typography',
              'output'  => '#ph_submit',
              'default' => array(
                'color'       => '#000000',
                'font-family' => 'Open Sans',
                'font-size'   => '14',
                'line-height' => '20',
                'unit'        => 'px',
                'type'        => 'google',
              ),
            ),

            array(
              'id'       => 'ph_button_padding',
              'type'     => 'spacing',
              'title'    => 'Padding',
              'default'  => array(
                'top'    => ' 10',
                'right'  => ' 10',
                'bottom' => ' 10',
                'left'   => ' 10',
                'unit'   => 'px',
              ),
              'output'      => '#ph_submit',
              'output_mode' => 'padding'
            ),


            array(
              'id'      => 'ph_button_border',
              'type'    => 'border',
              'title'   => 'Border',
              'default' => array(
                'top'    => ' 0',
                'right'  => ' 0',
                'bottom' => ' 0',
                'left'   => ' 0',
                'style'  => 'solid',
                'color'  => '#000000',
                'unit'   => 'px',
              ),
              'output'      => '#ph_submit',
            ),


            array(
              'id'       => 'ph_button_border_radius',
              'type'     => 'spacing',
              'title'    => 'Border Radius',
              'default'  => array(
                'top'    => ' 0',
                'right'  => ' 0',
                'bottom' => ' 0',
                'left'   => ' 0',
                'unit'   => 'px',
              ),
              'output'      => '#ph_submit',
              'output_mode' => 'border-radius'
            ),
      
          )
        ) );


        CSF::createSection( $prefix, array(
          'title'  => 'SEO',
          'fields' => array(

            // array(
            //   'id'            => 'ph_meta_title',
            //   'type'          => 'wp_editor',
            //   'title'         => 'Meta Title',
            //   'tinymce'       => true,
            //   'quicktags'     => true,
            //   'media_buttons' => false,
            //   'height'        => '30px',
            // ),

            array(
              'type'    => 'subheading',
              'content' => 'Meta Title',
            ),

            array(
              'id'      => 'ph_meta_title_start',
              'type'    => 'text',
              'title'   => 'Title Start',
            ),

            array(
              'id'      => 'ph_meta_title_end',
              'type'    => 'text',
              'title'   => 'Title End',
            ),


            array(
              'type'    => 'subheading',
              'content' => 'Meta Description',
            ),



            array(
              'id'      => 'ph_meta_description_start',
              'type'    => 'textarea',
              'title'   => 'Meta Description Start',
            ),

            array(
              'id'      => 'ph_meta_description_end',
              'type'    => 'textarea',
              'title'   => 'Meta Description End',
            ),
            
      
          )
        ) );
  
  }
  