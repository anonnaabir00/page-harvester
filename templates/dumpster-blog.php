<?php
/**
 * Blog Post Main File.
 *
 * @package WESTO
 * @author  Tona Theme
 * @version 1.0
 */

get_header();
$data    = \WESTO\Includes\Classes\Common::instance()->data( 'single' )->get();
$layout = $data->get( 'layout' );
$sidebar = $data->get( 'sidebar' );
if (is_active_sidebar( $sidebar )) {$layout = 'right';} else{$layout = 'full';}
$class = ( !$layout || $layout == 'full' ) ? 'col-xs-12 col-sm-12 col-md-12' : 'col-xl-8 col-md-12 col-sm-12';
$options = westo_WSH()->option();

if ( class_exists( '\Elementor\Plugin' ) && $data->get( 'tpl-type' ) == 'e') {
	
	while(have_posts()) {
	   the_post();
	   the_content();
    }

} else { ?>

<!--Start breadcrumb area paroller-->
<section class="breadcrumb-area">
    <div class="breadcrumb-area-bg" style="background-image: url(<?php echo esc_url( $data->get( 'banner' ) ); ?>);"></div>
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="inner-content">
                    <div class="breadcrumb-menu" data-aos="fade-down" data-aos-easing="linear"
                        data-aos-duration="1500">
                        <ul>
                            <?php echo westo_the_breadcrumb(); ?>
                        </ul>
                    </div>

                    <div class="title" data-aos="fade-up" data-aos-easing="linear" data-aos-duration="1500">
                        <h2><?php if( $data->get( 'title' ) ) echo wp_kses( $data->get( 'title' ), true ); else wp_title( '' ); ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End breadcrumb area-->

<!--Start Blog Page Three-->
<section class="blog-details-page">
    <div class="container">
        <div class="row clearfix">
        	<?php
				if ( $data->get( 'layout' ) == 'left' ) {
					do_action( 'westo_sidebar', $data );
				}
			?>
            <div class="<?php echo esc_attr( $class ); ?>">
            	
				<?php while ( have_posts() ) : the_post();
				$term_list = wp_get_post_terms(get_the_id(), 'category', array("fields" => "names")); ?>
                <div class="thm-unit-test">
                    <div class="blog-details-content">
                    	<div class="single-blog-style1 single-blog-style1--instyle3">
                            <div class="single-blog-style1__inner">
                                <?php if (has_post_thumbnail()){ ?>
                                <div class="img-holder">
                                    <div class="inner">
                                        <?php the_post_thumbnail('westo_1170x420'); ?>
                                    </div>
                                    <div class="date-box">
                                        <h6><?php echo get_the_date('d'); ?><br> <span><?php echo get_the_date('M'); ?></span></h6>
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="text-holder">
                                    <ul class="meta-info">
                                        <li>
                                            <i class="fa fa-user" aria-hidden="true"></i> <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) )); ?>"><?php esc_html_e('by', 'westo'); ?> <?php the_author(); ?></a>
                                        </li>
                                        <li>
                                            <i class="fa fa-comment-o" aria-hidden="true"></i> <a href="<?php echo esc_url(get_permalink(get_the_id()).'#comments'); ?>"><?php comments_number( '0 Comments', '1 Comment', '% Comments' ); ?></a>
                                        </li>
                                    </ul>
                                    <div class="text">
                                    	<?php the_content(); ?>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <?php
                        $args = array(
                            'post_type' => 'dumpster_blog',
                            'posts_per_page' => 1,
                            'orderby' => 'rand',
                            'post_status' => 'publish',
                            'ignore_sticky_posts' => true,
                            'no_found_rows' => true,
                            'update_post_meta_cache' => false,
                            'update_post_term_cache' => false,
                            'cache_results' => false,
                        );
                
                        $query = new \WP_Query($args);
                
                        // get the current post id
                        $current_post_id = get_the_ID();
                
                        $next_post = get_next_post();
                        $prev_post = get_previous_post();
                
                        if ( $settings['link_type'] == 'next_link' ) {
                            // check if the next post is the current post
                            if ( $next_post->ID == $current_post_id ) {
                                // if so, get the previous post
                                $title = get_the_title($prev_post->ID);
                                $permalink = get_permalink($prev_post->ID);
                            } else {
                                $title = get_the_title($next_post->ID);
                                $permalink = get_permalink($next_post->ID);
                            }
                        } else {
                            $title = get_the_title($prev_post->ID);
                            $permalink = get_permalink($prev_post->ID);
                        }
                
                        // $title = get_the_title($next_post->ID);
                        // $permalink = get_permalink($prev_post->ID);
                
                        ?>
                        <p>If you are looking for <?php echo $title;?>,
                        <a href="<?php echo $permalink; ?>">Click Here</a></p>

                        <div class="tag-social-share-box">
                        	<?php if( $options->get( 'single_post_tags' ) ): ?>
                            <div class="tag-box">
                                <div class="title">
                                    <h3><?php esc_html_e('Tags:', 'westo'); ?></h3>
                                </div>
                                <ul class="tag-list">
                                    <?php the_tags( '<li>', '</li><li> ', '</li>' ); ?>
                                </ul>
                            </div>
                            <?php endif; ?>
                            
                            <div class="post-social-share">
                                <div class="post-social-share-links clearfix">
                                    <?php if(function_exists('westo_share_us')):
										echo wp_kses(westo_share_us(get_the_id(), $post->post_name ), true);
									endif; ?>
                                </div>
                            </div>
                        </div>
                        
                        <?php if( $options->get( 'single_post_author_box' ) ) { ?>
                        <div class="blog-details-author">
                            <div class="inner-box">
                                <div class="img-box">
                                    <?php echo get_avatar(get_the_author_meta('ID'), 160); ?>
                                </div>
                                <div class="text">
                                    <h3><?php the_author(); ?></h3>
                                    <p><?php the_author_meta( 'description', get_the_author_meta('ID') ); ?></p>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        
                        <!-- Comments Area -->
                    	<?php comments_template(); ?>
					</div>
                </div>
                <?php endwhile; ?>
                
            </div>
        	<?php
				if ( $data->get( 'layout' ) == 'right' ) {
					do_action( 'westo_sidebar', $data );
				}
			?>
        </div>
    </div>
</section>
<!--End blog area--> 

<?php
}
get_footer();