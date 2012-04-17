<?php
/**
 * All cufon replaces. Add here all fonts replaces
 * 
 * @package WordPress
 * @subpackage YIW Themes
 * @since 1.0 
 */       
 
// the roles to apply the special font choosen
define( 'YIW_ROLES_FONT', 'h1, h2, h3, h4, h5, h6, .special-font' );

// all fonts type
$yiw_fonts = array(
    array(
        'id_option' => 'font_logo',
        'css_role' => '#logo h1',
    ),
    array(
        'id_option' => 'font_description',
        'css_role' => '#logo p',
    ),
    array(
        'id_option' => 'font_navigation',
        'css_role' => '#nav',
    ),
    array(
        'id_option' => 'font_p',
        'css_role' => 'p',
    ),    
    array(
        'id_option' => 'font_h1',
        'css_role' => 'h1',
    ),       
    array(
        'id_option' => 'font_h2',
        'css_role' => 'h2',
    ),       
    array(
        'id_option' => 'font_h3',
        'css_role' => 'h3',
    ),       
    array(
        'id_option' => 'font_h4',
        'css_role' => 'h4',
    ),       
    array(
        'id_option' => 'font_h5',
        'css_role' => 'h5', 
    ),       
    array(
        'id_option' => 'font_h6',
        'css_role' => 'h6',
    ),       
    array(
        'id_option' => 'font_sheeva_title',
        'css_role' => '.slider_sheeva .slide-title h2',
    ),       
    array(
        'id_option' => 'font_sheeva_content',
        'css_role' => '.slider_sheeva .slide-content',
    ),
    array(
        'id_option' => 'font_slogan',
        'css_role' => '#slogan h2',
    ),       
    array(
        'id_option' => 'font_subslogan',
        'css_role' => '#slogan h3',
    ),
    array(
        'id_option' => 'font_sidebarfooter',
        'css_role' => '#sidebar .widget h2, #sidebar .widget h3, #footer .widget h2, #footer .widget h3',
    ),       
    array(
        'id_option' => 'font_name_testimonial',
        'css_role' => '.testimonial .testimonial-name a.name',
    ),       
    array(
        'id_option' => 'font_special_font',
        'css_role' => '.special-font',
        'important' => true
    ),       
);

// array of all fonts size customizable by user
$yiw_sizes = array(
    'general' => array(    
        'name-section' => __( 'Font-sizes', 'yiw' ),  
        'options' => array(
    
            'nav-size' => array(    
                'default' => 15,     
                'css_role' => '#nav li',    
                'css_attr' => 'font-size',
                'panel_title' => __( "Navigation text", 'yiw' ),   
                'panel_desc' => __( "Size of the navigation items.", 'yiw' ) 
            ),
    
            'text-size' => array(    
                'default' => 12,     
                'css_role' => 'p, .home_items, li, address, dd, blockquote',   
                'css_attr' => 'font-size',
                'panel_title' => __( "General text", 'yiw' ),   
                'panel_desc' => __( "Size of the general text paragraphs.", 'yiw' ) 
            ),
    
            'h1-size' => array(    
                'default' => 26,     
                'css_role' => 'h1',   
                'css_attr' => 'font-size',
                'panel_title' => __( "H1 headline", 'yiw' ),   
                'panel_desc' => __( "Size of the H1 elements.", 'yiw' ) 
            ),
    
            'h2-size' => array(    
                'default' => 20,     
                'css_role' => 'h2',   
                'css_attr' => 'font-size',
                'panel_title' => __( "H2 headline", 'yiw' ),   
                'panel_desc' => __( "Size of the H2 elements.", 'yiw' ) 
            ),   
    
            'h3-size' => array(    
                'default' => 20,     
                'css_role' => 'h3',   
                'css_attr' => 'font-size',
                'panel_title' => __( "H3 headline", 'yiw' ),   
                'panel_desc' => __( "Size of the H3 elements.", 'yiw' ) 
            ),    
    
            'h4-size' => array(    
                'default' => 18,     
                'css_role' => 'h4',   
                'css_attr' => 'font-size',
                'panel_title' => __( "H4 headline", 'yiw' ),   
                'panel_desc' => __( "Size of the H4 elements.", 'yiw' ) 
            ),    
    
            'h5-size' => array(    
                'default' => 12,     
                'css_role' => 'h5',   
                'css_attr' => 'font-size',
                'panel_title' => __( "H5 headline", 'yiw' ),   
                'panel_desc' => __( "Size of the H5 elements.", 'yiw' ) 
            ),     
    
            'h6-size' => array(    
                'default' => 12,     
                'css_role' => 'h6',   
                'css_attr' => 'font-size',
                'panel_title' => __( "H6 headline", 'yiw' ),   
                'panel_desc' => __( "Size of the H6 elements.", 'yiw' ) 
            ),
        
            'sheeva-logo-text' => array(    
                'default' => 42,     
                'css_role' => '#logo h1',   
                'css_attr' => 'font-size',
                'panel_title' => __( "Logo text", 'yiw' ),   
                'panel_desc' => __( "Size of the Logo when it is a text.", 'yiw' ) 
            ),
        
            'sheeva-logo-description' => array(    
                'default' => 12,     
                'css_role' => '#logo p',   
                'css_attr' => 'font-size',
                'panel_title' => __( "Logo description", 'yiw' ),   
                'panel_desc' => __( "Size of the description below the logo.", 'yiw' ) 
            ),
        
            'sheeva-title-size' => array(    
                'default' => 48,     
                'css_role' => '.slider_sheeva .slide-title h2',   
                'css_attr' => 'font-size',
                'panel_title' => __( "Sheeva slider title", 'yiw' ),   
                'panel_desc' => __( "Size of the Sheeva slider title.", 'yiw' ) 
            ),
        
            'sheeva-content-size' => array(    
                'default' => 14,     
                'css_role' => '.slider_sheeva .slide-content p',   
                'css_attr' => 'font-size',
                'panel_title' => __( "Sheeva slider content text", 'yiw' ),   
                'panel_desc' => __( "Size of the Sheeva slider text.", 'yiw' ) 
            ),
        
            'sheeva-widget-h2' => array(    
                'default' => 28,     
                'css_role' => '.sheeva-widget-content h2',   
                'css_attr' => 'font-size',
                'panel_title' => __( "Sheeva Widget Area H2 headline", 'yiw' ),   
                'panel_desc' => __( "Size of the Sheeva Widgets H2 elements.", 'yiw' ) 
            ),
        
            'sheeva-widget-h3' => array(    
                'default' => 20,     
                'css_role' => '.sheeva-widget-content h3',   
                'css_attr' => 'font-size',
                'panel_title' => __( "Sheeva Widget Area H3 headline", 'yiw' ),   
                'panel_desc' => __( "Size of the Sheeva Widgets H3 elements.", 'yiw' ) 
            ),
            'slogan-size' => array(    
                'default' => 28,     
                'css_role' => '#slogan h2',   
                'css_attr' => 'font-size',
                'panel_title' => __( "Slogan", 'yiw' ),   
                'panel_desc' => __( "Size of the Slogan elements.", 'yiw' ) 
            ),
        
            'subslogan-size' => array(    
                'default' => 26,     
                'css_role' => '#slogan h3',   
                'css_attr' => 'font-size',
                'panel_title' => __( "Sub Slogan", 'yiw' ),   
                'panel_desc' => __( "Size of the Sub Slogan elements.", 'yiw' ) 
            ),
            
            'sidebar-footer-titles' => array(    
                'default' => 20,     
                'css_role' => '#sidebar .widget h2, #sidebar .widget h3, #footer .widget h2, #footer .widget h3',   
                'css_attr' => 'font-size',
                'panel_title' => __( "Sheeva Widget Area H3 headline", 'yiw' ),   
                'panel_desc' => __( "Size of the Sheeva Widgets H3 elements.", 'yiw' ) 
            ),
            
            'blog-title' => array(    
                'default' => 22,     
                'css_role' => '.hentry h1.post-title, .hentry h2.post-title',   
                'css_attr' => 'font-size',
                'panel_title' => __( "Blog title", 'yiw' ),   
                'panel_desc' => __( "Size of the blog title.", 'yiw' ) 
            ),
        
        ),
        
    ),
); 
?>