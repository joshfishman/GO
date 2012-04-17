<?php 
/**
 * @package WordPress
 * @subpackage Sheeva
 * @since 1.0
 */
 ?>

 
 
<!-- START SLIDER -->
<div id="slider" class="slider_sheeva group"> 
    <ul class="slider">
        <?php if( !yiw_is_empty() ): ?>
            <?php while( yiw_have_slide() ) : 
                      $paths = wp_upload_dir();
                          
                      $image_url = yiw_slide_get( 'image_url' );
                      $image_path = str_replace( $paths['baseurl'], $paths['basedir'], $image_url );     
                      $image_path = str_replace( site_url(), ABSPATH, $image_path );                    
                      $background_color = yiw_slide_get( 'background_color' );   
                      $title_color = yiw_slide_get( 'title_color' );
                      $content_color = yiw_slide_get( 'content_color' );
                      
                      if ( empty( $title_color ) )
                        $title_color = yiw_is_bright( $background_color ) ? '#1c1c1c' : '#fff';
                      
                      if ( empty( $content_color ) )
                        $content_color = yiw_is_bright( $background_color ) ? '#1c1c1c' : '#fff';
                      
                      if( file_exists( $image_path ) ):     
                          list($width, $height, $type, $attr) = getimagesize($image_path);
                          if( $width > 960 ): ?>
                              <li>
                                <div class="slide-holder" style="background: <?php echo $background_color ?> url('<?php echo $image_url ?>') no-repeat center center">
                                    <div class="slide-content-holder inner">
                                        <?php if( yiw_slide_get( 'title' ) || yiw_slide_get( 'content' ) ): ?>
                                            <div class="slide-content-holder-content" style="position: absolute; <?php echo yiw_slide_get_style(yiw_slide_get( 'style-text' )) ?>;">
                                                <?php if( yiw_slide_get( 'title' ) ): ?><div class="slide-title"><h2 style="color:<?php echo $title_color ?>"><?php yiw_slide_the( 'title' ) ?></h2></div><?php endif ?>
                                                <?php if( yiw_slide_get( 'content' ) ): ?><div class="slide-content" style="color:<?php echo $content_color ?>"><?php yiw_slide_the( 'content' ) ?></div><?php endif ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                              </li>
                          <?php else: ?>
                              <li>
                                <div class="slide-holder" style="background: <?php echo  ! empty( $background_color ) ? yiw_slide_the( 'background_color' ) : 'transparent' ?>">
                                    <div class="slide-content-holder inner">
                                        <?php if( yiw_slide_get( 'title' ) || yiw_slide_get( 'content' ) ): ?>
                                            <div class="slide-content-holder-content" style="position: absolute; <?php echo yiw_slide_get_style(yiw_slide_get( 'style-text' )) ?>">
                                                <?php if( yiw_slide_get( 'title' ) ): ?><div class="slide-title"><h2 style="color:<?php echo $title_color ?>"><?php yiw_slide_the( 'title' ) ?></h2></div><?php endif ?>
                                                <?php if( yiw_slide_get( 'content' ) ): ?><div class="slide-content" style="color:<?php echo $content_color ?>"><?php yiw_slide_the( 'content' ) ?></div><?php endif ?>
                                            </div>
                                        <?php endif; ?>
                                            
                                        <div style="position: absolute; <?php echo yiw_slide_get_style(yiw_slide_get( 'style-image' )) ?>">
                                            <?php yiw_slide_the( 'featured-content', array( 'container' => false) ) ?>
                                        </div>
                                    </div>
                                </div>
                              </li>
                    <?php endif; ?>
                <?php endif ?>
            <?php endwhile; ?>
        <?php else: ?>
                              <li>
                                <div class="slide-holder" style="background: #CBCACA">
                                    <div class="slide-content-holder inner"></div>
                                </div>
                              </li>
        <?php endif ?>
    </ul>                     

    <?php if( yiw_get_option('slider_sheeva_widget', 1) ): ?>
        <div id="sheeva-widget-area" class="group">
            <div class="sheeva-widget-content inner group">
                <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar( 'Sheeva Widget Area' ) ) ?>
            </div>
        </div>
    <?php endif ?>
</div>
