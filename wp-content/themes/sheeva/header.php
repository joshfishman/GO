<?php
/**
 * The Header for our theme.
 *
 * @package WordPress
 * @subpackage YIW Themes
 * @since 1.0
 */             
 global $yiw_mobile;
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<?php if ( ! $yiw_mobile->isIpad() ) : ?>
<meta name="viewport" content="width=device-width" />
<?php endif ?>
<title><?php
    /*
     * Print the <title> tag based on what is being viewed.
     */
    global $page, $paged;

    wp_title( '|', true, 'right' );

    // Add the blog name.
    bloginfo( 'name' );
    
    // Add description, if is home
    if ( is_home() || is_front_page() )
        echo ' | ' . get_bloginfo( 'description' );

    // Add a page number if necessary:
    if ( $paged >= 2 || $page >= 2 )
        echo ' | ' . sprintf( __( 'Page %s', 'yiw' ), max( $paged, $page ) );

    ?></title>          
    
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />                              
	
	<?php if ( yiw_get_option( 'responsive', 1 ) ) : ?>
	<link rel="stylesheet" type="text/css" media="screen and (max-width: 960px)" href="<?php echo get_template_directory_uri(); ?>/css/lessthen960.css" />
	<link rel="stylesheet" type="text/css" media="screen and (max-width: 600px)" href="<?php echo get_template_directory_uri(); ?>/css/lessthen600.css" />
	<link rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" href="<?php echo get_template_directory_uri(); ?>/css/lessthen480.css" />
	<?php endif; ?>
    
    <?php
        // styles 
        wp_enqueue_style( 'prettyPhoto',        get_template_directory_uri()."/css/prettyPhoto.css" );  
        wp_enqueue_style( 'tipsy',        get_template_directory_uri()."/core/includes/css/tipsy.css" );  

        // scripts    
        wp_enqueue_script( 'jquery-easing',                 get_template_directory_uri()."/js/jquery.easing.1.3.js", array('jquery'), "1.3");
        wp_enqueue_script( 'jquery-prettyPhoto',            get_template_directory_uri()."/js/jquery.prettyPhoto.js", array('jquery'), "3.0");
        wp_enqueue_script( 'jquery-tipsy',                  get_template_directory_uri()."/js/jquery.tipsy.js", array('jquery'));  
        wp_enqueue_script( 'jquery-tweetable',              get_template_directory_uri()."/js/jquery.tweetable.js", array('jquery'));           
        wp_enqueue_script( 'jquery-nivo',                   get_template_directory_uri()."/js/jquery.nivo.slider.pack.js", array('jquery') ); 
        wp_enqueue_script( 'jquery-cycle',                  get_template_directory_uri()."/js/jquery.cycle.min.js", array('jquery'));       
        
        $slider_type = yiw_slider_type();    

        if( !in_array( $slider_type, array('none','fixed-image')) ) {

                if( !in_array( $slider_type, array('layers','carousel')) )
                    wp_enqueue_style( 'slider-' . $slider_type,        get_template_directory_uri()."/css/slider-". $slider_type .".css" );  
            
                // cycle
                if ( $slider_type == 'cycle' ) {
                    wp_enqueue_script('swfobject');
                    
                } 
                
                //sheeva
                elseif( $slider_type == 'sheeva' ) { 
                    wp_enqueue_script( 'jquery-ui-effects', get_template_directory_uri()."/js/jquery.effects.core.js", array('jquery', 'jquery-ui-core'));
                    wp_enqueue_script( 'jquery-anythingslider', get_template_directory_uri()."/js/jquery.anythingslider.js", array('jquery'));
                    
                    wp_enqueue_script('cufon');
                    wp_enqueue_script('cufon-bebas', get_template_directory_uri()."/fonts/bebas.font.js");   
                    
                } 
                
                //unoslider
                elseif( $slider_type == 'unoslider' ) {    
                    $slider_theme = yiw_get_option( 'slider_' . $slider_type . '_theme' );                                
                    wp_enqueue_style( 'slider-' . $slider_type . '-', get_template_directory_uri()."/css/unoslider-themes/$slider_theme/theme.css" );  
                    wp_enqueue_script( 'unoslider', get_template_directory_uri()."/js/unoslider.js" );
                }   
	    
				// elastic
				elseif ( $slider_type == 'elastic' ) {                                                                                       
                    wp_enqueue_style( 'Playfair', 'http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Playfair+Display:400italic' ); 
                    wp_enqueue_script( 'jquery-elastic', get_template_directory_uri()."/js/jquery.eislideshow.js", array('jquery'), '1.0' );   
                }
                    
        }                             
		
		$accordion_slider = get_post_meta( $post->ID, '_slider_accordion', true );     
		if( ! empty( $accordion_slider ) && $accordion_slider != 'no' )
		    wp_enqueue_script( 'jquery-hrzAccordion', get_template_directory_uri()."/js/jquery.hrzAccordion.js" );


        // custom
        wp_enqueue_script( 'jquery-custom',      get_template_directory_uri()."/js/jquery.custom.js", array('jquery'), '1.0', true); 
                                                                                
        if( yiw_get_option( 'font_type' ) == 'cufon' )
        {                      
            wp_enqueue_script('cufon');
            //wp_enqueue_script('cufon-' . $actual_font, get_template_directory_uri()."/fonts/{$actual_font}.font.js");   
        }    
                           
        /* We add some JavaScript to pages with the comment form
         * to support sites with threaded comments (when in use).
         */
        if ( is_singular() && get_option( 'thread_comments' ) )
            wp_enqueue_script( 'comment-reply' );        
                                                                
        $body_class = '';
        if ( ( yiw_get_option( 'responsive', 1 ) && ! $GLOBALS['is_IE'] ) || ( yiw_get_option( 'responsive', 1 ) && yiw_ieversion() >= 9 ) )   
            $body_class = ' responsive';  
            
    ?>


    <!-- [favicon] begin -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php yiw_favicon(); ?>" />
    <link rel="icon" type="image/x-icon" href="<?php yiw_favicon(); ?>" />
    <!-- [favicon] end -->  
    
    <?php wp_head() ?>
    <!--[if lte IE 8]><link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri() ?>/css/slider-sheeva-ie.css" /><![endif]-->
</head>

<body <?php body_class( "no_js" . $body_class ) ?>>   
                             
    <!-- START WRAPPER -->
    <div class="wrapper group">          
        
        <!-- START HEADER -->
        <div id="header" class="group">
            <div class="group inner">
                <!-- START LOGO -->
                <div id="logo" class="group">
                    <?php if( yiw_get_option( 'use_logo' ) ): ?>
                        <a href="<?php echo home_url() ?>" title="<?php bloginfo('name') ?>"> 
                            <?php $logo = yiw_get_option( 'logo' ) ? yiw_get_option( 'logo' ) : get_template_directory_uri() . '/images/logo.png'; ?>
                            <img src="<?php echo $logo  ?>" alt="Logo <?php bloginfo('name') ?>" <?php if(yiw_get_option('logo_width')): ?>width="<?php echo yiw_get_option('logo_width') ?>"<?php endif ?> <?php if(yiw_get_option('logo_height')): ?>height="<?php echo yiw_get_option('logo_height') ?>"<?php endif ?> />
                        </a>
                    <?php else: ?>
                        <h1><a href="<?php echo home_url() ?>" title="<?php bloginfo('name') ?>"><?php bloginfo('name') ?></a></h1>
                    <?php endif ?>
                    <?php if ( yiw_get_option('logo_use_description') ) : ?><p><?php bloginfo('description') ?></p><?php endif ?>
                </div>
                <!-- END LOGO -->  
            
                <!-- START NAV -->
                <div id="nav" class="group">
                    <?php  
                        $nav_args = array(
                            'theme_location' => 'nav',
                            'container' => 'none',
                            'menu_class' => 'level-1',
                            'depth' => 3,   
                            //'fallback_fb' => false,
                            //'walker' => new description_walker()
                        );
                        
                        wp_nav_menu( $nav_args ); 
                    ?>    
                </div>
                <!-- END NAV -->     
            </div>
        </div>   
        <!-- END HEADER -->
        
        <!-- SLIDER -->
        <?php get_template_part( 'slider' ); ?>
        <!-- /SLIDER -->
