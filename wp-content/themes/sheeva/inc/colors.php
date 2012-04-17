<?php          
/**
 * Configuration of all colors customizable. Follow the default scheme already written.
 * Replace all string uppercased.
 * 
 * This add automatically the options on Theme Options and generate the custom css
 * with all colors set by user, including it on theme.    
 * 
 * @package WordPress
 * @subpackage Kassyopea
 * @since 1.0 
 */   

//array of all colors customizable by user
$yiw_colors = array(
    'logo' => array(    // replace ID-SECTION with the id of the section (don't use space, only "-" for the space)
        'name-section' => __( 'Logo', 'yiw' ),   // replace TITLE OF SECTION with the title of the section
        'options' => array(
    
            'logo-color' => array(    // replace ID-OPTION with the id of this option (don't use space, only "-" for the space) 
                'default'     => '#1e1e1e',   // the default color, selected if the user doesn't set any color
                'css_role'    => '#logo h1 a',       // the roles of this color option, used when generating the css style
                'css_attr'    => 'color',   // the attribute used for the role
                'panel_title' => __( "Logo color", 'yiw' ),   // the title of option for Theme Options
                'panel_desc'  => __( "Select the color of the logo. (default #1e1e1e)", 'yiw' )  // the description of option for Theme Options
            ),

            'logo-description-color' => array(
                'default' => '#545252',
                'css_role' => '#logo p',
                'css_attr' => 'color',
                'panel_title' => __( "Logo description", 'yiw' ),
                'panel_desc' => __( "Select the color of the description below the logo. (default #545252)", 'yiw' )
            ),          
        
        ),
    ),
    
    'nav' => array(    // replace ID-SECTION with the id of the section (don't use space, only "-" for the space)
        'name-section' => __( 'Main Menu', 'yiw' ),   // replace TITLE OF SECTION with the title of the section
        'options' => array(
    
            'nav-color' => array(    // replace ID-OPTION with the id of this option (don't use space, only "-" for the space) 
                'default'     => '#010101',   // the default color, selected if the user doesn't set any color
                'css_role'    => '#nav a',       // the roles of this color option, used when generating the css style
                'css_attr'    => 'color',   // the attribute used for the role
                'panel_title' => __( "List Items color", 'yiw' ),   // the title of option for Theme Options
                'panel_desc'  => __( "Select the color of each item in main menu. (default #010101)", 'yiw' )  // the description of option for Theme Options
            ),

            'nav-color-hover' => array(
                'default' => '#da7906',
                'css_role' => '#nav a:hover, #nav ul.sub-menu li a:hover, #nav ul.children a:hover',
                'css_attr' => 'color',
                'panel_title' => __( "List Items color (hover effect)", 'yiw' ),
                'panel_desc' => __( "Select the color of each item in main menu when the hover event is triggered. (default #da7906)", 'yiw' )
            ),     

            'nav-color-active' => array(
                'default' => '#da7906',
                'css_role' => '#nav .current-menu-item a',
                'css_attr' => 'color',
                'panel_title' => __( "List Items color (active effect)", 'yiw' ),
                'panel_desc' => __( "Select the color of each item in main menu when the item is active. (default #da7906)", 'yiw' )
            ),          
        
        ),
    ),
    
    'headings' => array(
        'name-section' => __( 'Headings', 'yiw' ),  
        'options' => array(
    
            'h1' => array( 
                'default'     => '#030303', 
                'css_role'    => 'h1', 
                'css_attr'    => 'color', 
                'panel_title' => __( "Heading 1", 'yiw' ), 
                'panel_desc'  => __( "Select the color for Heading 1 items. (default #030303)", 'yiw' ) 
            ),         

            'h2' => array( 
                'default'     => '#030303', 
                'css_role'    => 'h2, .post_title h2', 
                'css_attr'    => 'color', 
                'panel_title' => __( "Heading 2", 'yiw' ), 
                'panel_desc'  => __( "Select the color for Heading 2 items. (default #030303)", 'yiw' ) 
            ),         

            'h3' => array( 
                'default'     => '#030303', 
                'css_role'    => 'h3, .home_item h4 a, .home_item h4', 
                'css_attr'    => 'color', 
                'panel_title' => __( "Heading 3", 'yiw' ), 
                'panel_desc'  => __( "Select the color for Heading 3 items. (default #030303)", 'yiw' ) 
            ),         

            'h4' => array( 
                'default'     => '#030303', 
                'css_role'    => 'h4', 
                'css_attr'    => 'color', 
                'panel_title' => __( "Heading 4", 'yiw' ), 
                'panel_desc'  => __( "Select the color for Heading 4 items. (default #030303)", 'yiw' ) 
            ),         

            'h5' => array( 
                'default'     => '#030303', 
                'css_role'    => 'h5', 
                'css_attr'    => 'color', 
                'panel_title' => __( "Heading 5", 'yiw' ), 
                'panel_desc'  => __( "Select the color for Heading 5 items. (default #030303)", 'yiw' ) 
            ),         

            'h6' => array( 
                'default'     => '#030303', 
                'css_role'    => 'h6', 
                'css_attr'    => 'color', 
                'panel_title' => __( "Heading 6", 'yiw' ), 
                'panel_desc'  => __( "Select the color for Heading 6 items. (default #030303)", 'yiw' ) 
            ),
            
            'h-highlightes' => array( 
                'default'     => '#A05F02', 
                'css_role'    => 'h1 span, h2 span, h3 span, h4 span, h5 span, h6 span', 
                'css_attr'    => 'color', 
                'panel_title' => __( "Heading highlightes", 'yiw' ), 
                'panel_desc'  => __( "Select the color for titles highlightes. (default #A05F02)", 'yiw' ) 
            ),
            
            'sidebar-footer-titles' => array( 
                'default'     => '#030303', 
                'css_role'    => '#sidebar .widget h2, #sidebar .widget h3, #footer .widget h2, #footer .widget h3, #wp-calendar caption', 
                'css_attr'    => 'color', 
                'panel_title' => __( "Sidebar & Footer titles", 'yiw' ), 
                'panel_desc'  => __( "Select the color for titles in sidebar and footer sections. (default #030303)", 'yiw' ) 
            ),
        ),
    ),
    
    
    'slogan' => array(
        'name-section' => __( 'Slogan', 'yiw' ),  
        'options' => array(
    
            'slogan' => array( 
                'default'     => '#030303', 
                'css_role'    => '#slogan h2', 
                'css_attr'    => 'color', 
                'panel_title' => __( "Slogan", 'yiw' ), 
                'panel_desc'  => __( "Select the color for slogan. (default #030303)", 'yiw' ) 
            ),         

            'subslogan' => array( 
                'default'     => '#c86f06', 
                'css_role'    => '#slogan h3', 
                'css_attr'    => 'color', 
                'panel_title' => __( "Subslogan", 'yiw' ), 
                'panel_desc'  => __( "Select the color for title below the main slogan. (default #c86f06)", 'yiw' ) 
            ),
        ),
    ),


    'paragraphs' => array(
        'name-section' => __( 'Paragraphs and links', 'yiw' ),  
        'options' => array(
    
            'p' => array( 
                'default'     => '#545252', 
                'css_role'    => 'body, p, li, address, dd, blockquote, #content .contact-form label, #content .contact-form input, #content .contact-form textarea, .gallery-filters ul.filters li a', 
                'css_attr'    => 'color', 
                'panel_title' => __( "Paragraphs", 'yiw' ), 
                'panel_desc'  => __( "Select the color for paragraphs. (default #545252)", 'yiw' ) 
            ),         

            'a' => array( 
                'default'     => '#AB5705', 
                'css_role'    => 'a, #footer a, #footer .widget a, #copyright a, .testimonial-widget a.url-testimonial, .testimonial-widget a.name-testimonial:hover, #sidebar .recent-post a.title, #sidebar .recent-comments a.title, #sidebar .recent-comments a.goto, #sidebar .recent-comments .author a, .gallery-filters ul.filters li a:hover, .gallery-filters ul.filters li.selected a', 
                'css_attr'    => 'color', 
                'panel_title' => __( "Links", 'yiw' ), 
                'panel_desc'  => __( "Select the color for links. (default #AB5705)", 'yiw' ) 
            ),         

            'a_hover' => array( 
                'default'     => '#1f1f1f',
                'css_role'    => 'a:hover, #footer a:hover, #footer .widget a:hover, #copyright a:hover, .testimonial-widget a.name-testimonial, .testimonial-widget a.url-testimonial:hover, .sheeva-widget-content .sheeva-lastpost h3, #sidebar .recent-post a.title:hover, #sidebar .recent-comments a.title:hover, #sidebar .recent-comments a.goto:hover, #sidebar .recent-comments .author a:hover', 
                'css_attr'    => 'color', 
                'panel_title' => __( "Links (hover effect)", 'yiw' ), 
                'panel_desc'  => __( "Select the color for links (hover effect). (default #1f1f1f)", 'yiw' ) 
            ),     

            'sidebar_a' => array( 
                'default'     => '#1f1f1f', 
                'css_role'    => '#sidebar a', 
                'css_attr'    => 'color', 
                'panel_title' => __( "Links", 'yiw' ), 
                'panel_desc'  => __( "Select the color for links in the sidebar. (default #1f1f1f)", 'yiw' ) 
            ),         

            'sidebar_a_hover' => array( 
                'default'     => '#AB5705',
                'css_role'    => '#sidebar a:hover', 
                'css_attr'    => 'color', 
                'panel_title' => __( "Links (hover effect)", 'yiw' ), 
                'panel_desc'  => __( "Select the color for links in the sidebar (hover effect). (default #AB5705)", 'yiw' ) 
            ),
        ),
    ),   
    
    
    'blog' => array(
        'name-section' => __( 'Blog', 'yiw' ),  
        'options' => array(
    
            'blog-title' => array( 
                'default'     => '#2B2828', 
                'css_role'    => '.hentry h1 a, .hentry h2 a, .blog-big .meta a, .blog-small .meta a', 
                'css_attr'    => 'color', 
                'panel_title' => __( "Blog title", 'yiw' ), 
                'panel_desc'  => __( "Select the color for blog titles. (default #2B2828)", 'yiw' ) 
            ),      
    
            'blog-title-hover' => array( 
                'default'     => '#000000', 
                'css_role'    => '.hentry h1 a:hover, .hentry h2 a:hover, .blog-big .meta a:hover, .blog-small .meta a:hover', 
                'css_attr'    => 'color', 
                'panel_title' => __( "Blog title (hover effect)", 'yiw' ), 
                'panel_desc'  => __( "Select the color for blog titles, on the mouse over. (default #000000)", 'yiw' ) 
            ),         
        ),
    ),
    
    'sheeva' => array(    // replace ID-SECTION with the id of the section (don't use space, only "-" for the space)
        'name-section' => __( 'Sheeva Slider Widget Area', 'yiw' ),   // replace TITLE OF SECTION with the title of the section
        'options' => array(
    
            'sheeva-background' => array(    // replace ID-OPTION with the id of this option (don't use space, only "-" for the space) 
                'default'     => '#fff',   // the default color, selected if the user doesn't set any color
                'css_role'    => '.sheeva-widget-content',       // the roles of this color option, used when generating the css style
                'css_attr'    => 'background-color',   // the attribute used for the role
                'panel_title' => __( "Widget area background color", 'yiw' ),   // the title of option for Theme Options
                'panel_desc'  => __( "Select the background color for widget area. (default #fff)", 'yiw' )  // the description of option for Theme Options
            ),
            
            'sheeva-quote-quote' => array(    // replace ID-OPTION with the id of this option (don't use space, only "-" for the space) 
                'default'     => '#030303',   // the default color, selected if the user doesn't set any color
                'css_role'    => '.sheeva-widget-content .sheeva_quote h2',       // the roles of this color option, used when generating the css style
                'css_attr'    => 'color',   // the attribute used for the role
                'panel_title' => __( "Sheeva Quote Widget: quote color", 'yiw' ),   // the title of option for Theme Options
                'panel_desc'  => __( "Select the color for the quote in Sheeva Quote Widget. (default #030303)", 'yiw' )  // the description of option for Theme Options
            ),

            'sheeva-quote-author' => array(    // replace ID-OPTION with the id of this option (don't use space, only "-" for the space) 
                'default'     => '#c07203',   // the default color, selected if the user doesn't set any color
                'css_role'    => '.sheeva-widget-content .sheeva_quote h3',       // the roles of this color option, used when generating the css style
                'css_attr'    => 'color',   // the attribute used for the role
                'panel_title' => __( "Sheeva Quote Widget: author color", 'yiw' ),   // the title of option for Theme Options
                'panel_desc'  => __( "Select the color for the author in Sheeva Quote Widget. (default #c07203)", 'yiw' )  // the description of option for Theme Options
            ),

        ),
    ),

);    
    
$default_images = array(
    'gradient-home-section' => "bg/gradient-home-section.png",
    'home-section-bg'       => "bg/home-section-bg.png",     
    'pag-slider'            => "bg/pag-slider.png",
    'logo'                  => "logo.png"
);

?>