<?php
/**
 * COnfiguration of the theme 
 * 
 * @package WordPress
 * @subpackage YIW Themes
 * @since 1.0 
 */ 
 
/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640;   

define( 'YIW_THEME_NAME', 'Sheeva' ); // The theme name
define( 'YIW_THEME_FOLDER_NAME', 'Sheeva' ); // The theme folder name
define( 'NOTIFIER_XML_FILE', 'http://www.niubbys.altervista.org/sheeva.xml' ); // The remote notifier XML file containing the latest version of the theme and changelog

// minimum version compatible with the theme
define( 'YIW_MINIMUM_WP_VERSION', '3.0' );

// default layout page
define( 'YIW_DEFAULT_LAYOUT_PAGE', 'sidebar-right' );

$yiw_skins = array(
    'BlackWhite' => 'BlackWhite',
    'Corporate' => 'Corporate',
    'Dark' => 'Dark',
    'Minimal' => 'Minimal',
    'Sketch' => 'Sketch',
    'Vintage' => 'Vintage'
);    


/**
 * The items of Theme Options. The ID of each item, must be the same with the name of own file options (except -options.php), 
 * into the "inc/options" folder.
 */ 
$yiw_theme_options_items = array( 
    'general' => __( 'General', 'yiw' ), 
    'sections' => __( 'Sections', 'yiw' ), 
	'colors' => __( 'Colors', 'yiw' ),           
	'typography' => __( 'Typography', 'yiw' ),  
	'accordions' => __( 'Accordions', 'yiw' ),   
	'sliders' => __( 'Sliders', 'yiw' ), 
	'sidebars' => __( 'Sidebars', 'yiw' ), 
	'contact' => __( 'Contact Forms', 'yiw' )
);        

$yiw_sliders = array(
    'none'        => __( 'None', 'yiw' ),
    'fixed-image' => __( 'Fixed Image', 'yiw' ),    
    'layers'      => __( 'Layers Slider' , 'yiw' ), 
    'carousel'    => __( 'Carousel Slider' , 'yiw' ), 
    'unoslider'   => __( 'UnoSlider' , 'yiw' ),
    'sheeva'      => __( 'Sheeva Slider' , 'yiw' ),
    'elegant'     => __( 'Elegant Slider', 'yiw' ),
    'cycle'       => __( 'Cycle Slider' , 'yiw' ),
    'elastic'     => __( 'Elastic Slider' , 'yiw' ),
    //'nivo'        => __( 'Slider Nivo' , 'yiw' ),
    //'carousel'    => __( 'Slider Carousel' , 'yiw' )
    //'flash'       => __( 'Slider Flash', 'yiw' ),
    //'rotating'    => __( 'Slider Rotating', 'yiw' )
);             

$yiw_portfolio_type = array(
    '3cols'      => __('3 Columns', 'yiw'), 
    'slider'     => __('With Slider', 'yiw'),
    'big_image'  => __('Big Image', 'yiw'), 
    'full_desc'  => __('Full Description', 'yiw'), 
    'filterable' => __('Filterable', 'yiw'), 
);

$yiw_unoslider_animations = array(
    'chess' => 'chess',
    'flash' => 'flash',
    'spiral_reversed' => 'spiral_reversed',
    'spiral' => 'spiral',
    'sq_appear' => 'sq_appear',
    'sq_flyoff' => 'sq_flyoff',
    'sq_drop' => 'sq_drop',
    'sq_squeeze' => 'sq_squeeze',
    'sq_random' => 'sq_random',
    'sq_diagonal_rev' => 'sq_diagonal_rev',
    'sq_diagonal' => 'sq_diagonal',
    'sq_fade_random' => 'sq_fade_random',
    'sq_fade_diagonal_rev' => 'sq_fade_diagonal_rev',
    'sq_fade_diagonal' => 'sq_fade_diagonal',
    'explode' => 'explode',
    'implode' => 'implode',
    'fountain' => 'fountain',
    'blind_bottom' => 'blind_bottom',
    'blind_top' => 'blind_top',
    'blind_right' => 'blind_right',
    'blind_left' => 'blind_left',
    'shot_right' => 'shot_right',
    'shot_left' => 'shot_left',
    'alternate_vertical' => 'alternate_vertical',
    'alternate_horizontal' => 'alternate_horizontal',
    'zipper_right' => 'zipper_right',
    'zipper_left' => 'zipper_left',
    'bar_slide_random' => 'bar_slide_random',
    'bar_slide_bottomright' => 'bar_slide_bottomright',
    'bar_slide_bottomright' => 'bar_slide_bottomright',
    'bar_slide_topright' => 'bar_slide_topright',
    'bar_slide_topleft' => 'bar_slide_topleft',
    'bar_fade_bottom' => 'bar_fade_bottom',
    'bar_fade_top' => 'bar_fade_top',
    'bar_fade_right' => 'bar_fade_right',
    'bar_fade_left' => 'bar_fade_left',
    'bar_fade_random' => 'bar_fade_random',
    'v_slide_top' => 'v_slide_top',
    'h_slide_right' => 'h_slide_right',
    'v_slide_bottom' => 'v_slide_bottom',
    'h_slide_left' => 'h_slide_left',
    'stretch' => 'stretch',
    'squeez' => 'squeez',
    'fade' => 'fade'
);

// default contact form
$yiw_default_contact_form = array(
	array (
        'title' => 'Name',
        'data_name' => 'name',
        'description' => '',
        'type' => 'text',
        'label_checkbox' => '',
        'msg_error' => 'Enter the name',
        'required' => 'yes',
        'class' => '',
    ),

    array (
        'title' => 'Email',
        'data_name' => 'email',
        'description' => '',
        'type' => 'text',
        'label_checkbox' => '',
        'msg_error' => 'Enter a valid email',
        'required' => 'yes',
        'email_validate' => 'yes',
        'reply_to' => 'yes',
        'class' => '',
    ),

    array (
        'title' => 'Phone',
        'data_name' => 'phone',
        'description' => '',
        'type' => 'text',
        'label_checkbox' => '',
        'msg_error' => '', 
        'class' => '',
    ),

    array (
        'title' => 'Web site',
        'data_name' => 'website',
        'description' => '',
        'type' => 'text',
        'label_checkbox' => '',
        'msg_error' => '',
        'class' => '',
    ),

    array (
        'title' => 'Message',
        'data_name' => 'message',
        'description' => '',
        'type' => 'textarea',
        'label_checkbox' => '',
        'msg_error' => 'Enter a message',
        'required' => 'yes',
        'class' => '',
    )
);

define( 'YIW_DEFAULT_CONTACT_FORM', serialize( $yiw_default_contact_form ) );


// define the links to rss url for dashboard
define( 'YIW_RSS_FORUM_URL', 'http://www.yourinspirationweb.com/tf/support/forum/feed.php?fid=3' );
define( 'YIW_RSS_URL', 'http://feeds.feedburner.com/yourinspirationweb/HuJt' );
?>