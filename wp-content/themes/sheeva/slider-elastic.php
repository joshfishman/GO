<?php 
/**
 * @package WordPress
 * @subpackage Diverso
 * @since 1.0
 */    
 
if ( yiw_is_empty() )
    return;

$thumbs = '';
?>
 
 		<!-- BEGIN #slider -->
        <div id="slider" class="ei-slider elastic<?php if ( yiw_get_option( 'slider_responsive' ) != 'leave' ) : ?> not-for-mobile<?php endif; ?>">
            <div class="ei-slider-loading">Loading</div>
            <ul class="ei-slider-large">
            
                <?php while( yiw_have_slide() ) : 
                    global $_wp_additional_image_sizes;
				    $w = $_wp_additional_image_sizes['thumb-slider-elastic']['width'];
				    $h = $_wp_additional_image_sizes['thumb-slider-elastic']['height'];
                        
			        $thumbnail = explode( '.', basename( yiw_slide_get('image_url') ) );
			        $thumbnail = str_replace( basename( yiw_slide_get('image_url') ), $thumbnail[0] . "-{$w}x{$h}." . $thumbnail[1], yiw_slide_get('image_url') ); 
                    
                    $thumbs .= "<li><a href=\"#\">".yiw_slide_get( 'slide_title' )." - ".strip_tags(yiw_slide_get( 'clean-content' ))."</a><img src=\"$thumbnail\" alt=\"".yiw_slide_get( 'slide_title' )." - ".strip_tags(yiw_slide_get( 'clean-content' ))."\" /></li>\n"; ?>
                    
                <li<?php yiw_slide_class( 'slide align-' . yiw_slide_get( 'layout_slide' ) ) ?>>
                    <?php yiw_slide_the( 'featured-content', array(
                         'container' => false
                      ) ) ?> 
                    <div class="ei-title">
                        <?php yiw_string_( '<h2>', yiw_slide_get( 'title' ), '</h2>' ) ?>   
                        <?php yiw_string_( '<h3>', yiw_slide_get( 'clean-content' ), '</h3>' ) ?>
                    </div>
                </li>
                <?php endwhile; ?> 
            </ul><!-- ei-slider-large -->
            <ul class="ei-slider-thumbs">
                <li class="ei-slider-element">Current</li>
                <?php echo $thumbs ?>
            </ul><!-- ei-slider-thumbs -->    
            
            <div class="shadow"></div>
        </div><!-- ei-slider -->    
 		<!-- END #slider -->