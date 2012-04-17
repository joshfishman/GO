<?php                

$yiw_options['typography'] = array (
     
    /* =================== GENERAL =================== */
    "typography" => array(    
        array( "name" => __('Typography', 'yiw'),
               "type" => "title"),
    
        array( "name" => __("Typography", 'yiw'),
               "type" => "section"),
        array( "type" => "open"),
        
        array( "name" => __("Logo font", 'yiw'),
               "desc" => __("Select the type to use for the logo font.", 'yiw'),
               "id" => "font_logo",
               "type" => "font-select",
               "data" => "array",
               "font-types" => 'cufon,google-font,web-fonts',
               "std" => array( 'type' => 'google-font', 'google-font' => 'Rokkitt' ) ), 
            
        array( "name" => __("Logo description font", 'yiw'),
               "desc" => __("Select the type to use for the description below the logo (default Droid Sans).", 'yiw'),
               "id" => "font_description",
               "type" => "font-select",
               "data" => "array",
               "font-types" => 'google-font,web-fonts',
               "std" => array( 'type' => 'google-font', 'google-font' => 'Droid Sans' ) ),   
            
        array( "name" => __("Navigation font", 'yiw'),
               "desc" => __("Select the type to use for the navigation font.", 'yiw'),
               "id" => "font_navigation",
               "type" => "font-select",
               "data" => "array",
               "font-types" => 'cufon,google-font,web-fonts',
               "std" => array( 'type' => 'google-font', 'google-font' => 'Rokkitt' ) ),  
            
        array( "name" => __("Paragraphs font", 'yiw'),
               "desc" => __("Select the type to use for the paragraphs (default Droid Sans).", 'yiw'),
               "id" => "font_p",
               "type" => "font-select",
               "data" => "array",
               "font-types" => 'google-font,web-fonts',
               "std" => array( 'type' => 'google-font', 'google-font' => 'Droid Sans' ) ),  
            
        array( "name" => __("Heading 1 font", 'yiw'),
               "desc" => __("Select the type to use for Heading 1 items (default Rokkitt).", 'yiw'),
               "id" => "font_h1",
               "type" => "font-select",
               "data" => "array",
               "font-types" => 'cufon,google-font,web-fonts',
               "std" => array( 'type' => 'google-font', 'google-font' => 'Rokkitt' ) ),  
            
        array( "name" => __("Heading 2 font", 'yiw'),
               "desc" => __("Select the type to use for Heading 2 items (default Rokkitt).", 'yiw'),
               "id" => "font_h2",
               "type" => "font-select",
               "data" => "array",
               "font-types" => 'cufon,google-font,web-fonts',
               "std" => array( 'type' => 'google-font', 'google-font' => 'Rokkitt' ) ),  
            
        array( "name" => __("Heading 3 font", 'yiw'),
               "desc" => __("Select the type to use for Heading 3 items (default Rokkitt).", 'yiw'),
               "id" => "font_h3",
               "type" => "font-select",
               "data" => "array",
               "font-types" => 'cufon,google-font,web-fonts',
               "std" => array( 'type' => 'google-font', 'google-font' => 'Rokkitt' ) ),  
            
        array( "name" => __("Heading 4 font", 'yiw'),
               "desc" => __("Select the type to use for Heading 4 items (default Rokkitt).", 'yiw'),
               "id" => "font_h4",
               "type" => "font-select",
               "data" => "array",
               "font-types" => 'cufon,google-font,web-fonts',
               "std" => array( 'type' => 'google-font', 'google-font' => 'Rokkitt' ) ),  
               
        array( "name" => __("Heading 5 font", 'yiw'),
               "desc" => __("Select the type to use for Heading 5 items (default Rokkitt).", 'yiw'),
               "id" => "font_h5",
               "type" => "font-select",
               "data" => "array",
               "font-types" => 'cufon,google-font,web-fonts',
               "std" => array( 'type' => 'google-font', 'google-font' => 'Droid Sans' ) ),  
            
        array( "name" => __("Heading 6 font", 'yiw'),
               "desc" => __("Select the type to use for Heading 6 items (default Droid Sans).", 'yiw'),
               "id" => "font_h6",
               "type" => "font-select",
               "data" => "array",
               "font-types" => 'cufon,google-font,web-fonts',
               "std" => array( 'type' => 'google-font', 'google-font' => 'Droid Sans' ) ),  
            
        array( "name" => __("Slider Sheeva: Title font", 'yiw'),
               "desc" => __("Select the type to use for Slider Sheeva title (default Bebas).", 'yiw'),
               "id" => "font_sheeva_title",
               "type" => "font-select",
               "data" => "array",
               "font-types" => 'cufon,google-font,web-fonts',
               "std" => array( 'type' => 'cufon', 'cufon' => 'Bebas' ) ),  
               
        array( "name" => __("Slider Sheeva: Content font", 'yiw'),
               "desc" => __("Select the type to use for Slider Sheeva content (default Droid Sans).", 'yiw'),
               "id" => "font_sheeva_content",
               "type" => "font-select",
               "data" => "array",
               "font-types" => 'cufon,google-font,web-fonts',
               "std" => array( 'type' => 'google-font', 'google-font' => 'Droid Sans' ) ),  

        array( "name" => __("Slogan font", 'yiw'),
               "desc" => __("Select the type to use for Slogan (default Rokkitt).", 'yiw'),
               "id" => "font_slogan",
               "type" => "font-select",
               "data" => "array",
               "font-types" => 'cufon,google-font,web-fonts',
               "std" => array( 'type' => 'google-font', 'google-font' => 'Rokkitt' ) ),  
            
        array( "name" => __("Sub Slogan font", 'yiw'),
               "desc" => __("Select the type to use for Sub Slogan (default Rokkitt).", 'yiw'),
               "id" => "font_subslogan",
               "type" => "font-select",
               "data" => "array",
               "font-types" => 'cufon,google-font,web-fonts',
               "std" => array( 'type' => 'google-font', 'google-font' => 'Rokkitt' ) ),  

        array( "name" => __("Sidebar & Footer titles", 'yiw'),
               "desc" => __("Select the type to use for titles in sidebar and footer. (default Rokkitt)", 'yiw'),
               "id" => "font_sidebarfooter",
               "type" => "font-select",
               "data" => "array",
               "font-types" => 'cufon,google-font,web-fonts',
               "std" => array( 'type' => 'google-font', 'google-font' => 'Rokkitt' ) ),  

        array( "name" => __("Testimonial name", 'yiw'),
               "desc" => __("Select the type to use for name of testimonial, in the [testimonials] shortcode. (default Shadows Into Light)", 'yiw'),
               "id" => "font_name_testimonial",
               "type" => "font-select",
               "data" => "array",
               "font-types" => 'cufon,google-font,web-fonts',
               "std" => array( 'type' => 'google-font', 'google-font' => 'Shadows Into Light' ) ),  

        array( "name" => __("Special Font", 'yiw'),
               "desc" => __("Select the type to use for the text inside the shortcode [special_font]. (default Shadows Into Light)", 'yiw'),
               "id" => "font_special_font",
               "type" => "font-select",
               "data" => "array",
               "font-types" => 'cufon,google-font,web-fonts',
               "std" => array( 'type' => 'google-font', 'google-font' => 'Shadows Into Light' ) ),  
            


        array( "type" => "close")
    ),     
 
);                      

yiw_retrieve_font_options( $yiw_options['typography'] );
?>