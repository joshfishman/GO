<?php
//if ( !yiw_can_show_slider() )
//    return;
global $post, $wp_query;

$responsive = array( 'unoslider', 'elastic' );
                                    
if ( $wp_query->is_posts_page )
    return;

if( isset($post->ID) && $slider = get_post_meta( get_the_ID(), 'slider_type', true ) ) {
    
    if( is_string($slider) && $slider != 'none' )
        get_template_part( 'slider', $slider ); 


} elseif( is_home() || is_front_page() || is_page_template('home.php') ) {
    if( ($slider = yiw_get_option( 'slider_type', 'none' )) && $slider != 'none')
        get_template_part( 'slider', $slider ); 
} else return;                          
		
    if ( ! in_array( $slider, $responsive ) && yiw_get_option( 'slider_responsive' ) == 'fixed-image' ) : ?>   
        <div class="slider-mobile">
           <?php get_template_part( 'slider', 'fixed-image' ); ?>    
        </div>   
    <?php endif; 
?>