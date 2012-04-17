<?php         

global $yiw_skins;       

$yiw_options['general'] = array (      
	 
    /* =================== SKIN =================== */
    'responsive' => array(    
        array( 'name' => __('General Settings', 'yiw'),
        	   'type' => 'title'),
    
        array( 'name' => __('Activate responsive', 'yiw'),
        	   'type' => 'section',
               'effect' => 0),
        array( 'type' => 'open'),                 
         
        array( 'name' => __('Theme skin', 'yiw'),
        	   'desc' => __('Select the skin you want to use in this theme. NB: if you want to change the skin, select it before continue.', 'yiw'),
        	   'yiw-callback-save' => 'yiw_select_skin_option',
        	   'id' => 'select_skin',
        	   'type' => 'select_skin',
        	   'options' => array_merge( array( '' => '' ), $yiw_skins ),
        	   'button' => __( 'Select', 'yiw' ),
               'std' => '' ),                   
         
        array( 'name' => __('Activate responsive', 'yiw'),
        	   'desc' => __('Select if you want to active or not the responsive', 'yiw'),
        	   'id' => 'responsive',
        	   'type' => 'on-off',
        	   'button' => __( 'Save', 'yiw' ),
               'std' => 1 ),     
        	
        array( 'type' => 'close')
    ),        
    /* =================== END SKIN =================== */
     
    /* =================== GENERAL =================== */
    'general' => array(    
        array( 'name' => __('General', 'yiw'),
               'type' => 'section'),
        array( 'type' => 'open'),                   
            
        array( 'name' => __('Custom Favicon', 'yiw'),
               'desc' => __("A favicon is a 16x16 pixel icon that represents your site; paste the URL to a icon image that you want to use as the image. NOTE: it's not allowed the .ico extension", 'yiw'),
               'id' => 'favicon',
               'type' => 'upload',
               'std' => get_template_directory_uri() .'/favicon.ico'),        
            
        array( 'name' => __('Custom Style', 'yiw'),
               'desc' => __('You can write here your custom css, that will replace the default css.', 'yiw'),
               'id' => 'custom_style',
               'type' => 'textarea',
               'std' => ''),
               
            
        array( "name" => __("Date Format", 'yiw'),
               "desc" => __("Set the general date format of theme. Read <a href=\"http://codex.wordpress.org/Formatting_Date_and_Time\">Documentation on date formatting</a>", 'yiw'),
               "id" => "date_format",
               "type" => "text",
               "std" => "F j, Y" ),     
            
        array( 'type' => 'close')
    ),        
    /* =================== END GENERAL =================== */
    
                                                 
    /* =================== HEADER =================== */
    'header' => array(
        array( 'name' => __('Header', 'yiw'),
               'type' => 'section'),
        array( 'type' => 'open'),        
                                    
        array( 'name' => __('Custom Logo', 'yiw'),
               'desc' => __('Want to use a custom image as logo?', 'yiw'),
               'id' => 'use_logo',     
               'type' => 'on-off',
               'std' => 0),
            
        array( 'name' => __('Logo URL', 'yiw'),
               'desc' => __('Enter the URL to your logo image', 'yiw'),
               'id' => 'logo',     
               'type' => 'upload',  
               'deps' => array(
                    'id' => 'use_logo',
                    'value' => 1
               ),
               'std' => ''),
            
        array( 'name' => __('Logo Description', 'yiw'),
               'desc' => __('Specify if you want the description below the logo', 'yiw'),
               'id' => 'logo_use_description',     
               'type' => 'on-off',
               'std' => 1),
/*
        array( 'name' => __('Active Logo Image', 'yiw'),
               'desc' => __('Set if you want to replace the "Title" and "description" options of header, with a logo image.', 'yiw'),
               'id' => 'show_logo', 
               'type' => 'on-off',
               'std' => ''),    */                

        array( 'name' => __('Header Color', 'yiw'),
               'desc' => __('Select the type of header background.', 'yiw'),
               'id' => 'header_bg_color',     
               'type' => 'color-picker',
               'std' => '' ),       
                          
        array( 'name' => __('Header Background', 'yiw'),
               'desc' => __('Select the type of header background.', 'yiw'),
               'id' => 'header_bg_type',     
               'type' => 'select',
               'options' => array(
                    'color-unit' => __( 'Color Unit', 'yiw' ),
                    'bg-image' => __( 'Image', 'yiw' )
               ),
               'std' => 'color-unit' ),      
            
        array( 'name' => __('Header Image Custom', 'yiw'),
               'desc' => __('Upload your background image.', 'yiw'),
               'id' => 'header_bg_image_custom',     
               'type' => 'upload',
               'deps' => array(
                    'id' => 'header_bg_type',
                    'value' => 'bg-image'
               ),
               'std' => '' ),    
            
        array( 'name' => __('Header Image Repeat', 'yiw'),
               'desc' => __('The repeat attribute of header image uploaded above.', 'yiw'),
               'id' => 'header_bg_image_custom_repeat',     
               'type' => 'select',
               'options' => array(
                    'repeat' => __( 'Repeat', 'yiw' ),
                    'repeat-x' => __( 'Repeat Horizontally', 'yiw' ),
                    'repeat-y' => __( 'Repeat Vertically', 'yiw' ),
                    'no-repeat' => __( 'No Repeat', 'yiw' ),
               ),
               'deps' => array(
                    'id' => 'header_bg_type',
                    'value' => 'bg-image'
               ),
               'std' => 'no-repeat' ),  
            
        array( 'name' => __('Header Image Position', 'yiw'),
               'desc' => __('The position attribute of header image uploaded above.', 'yiw'),
               'id' => 'header_bg_image_custom_position',     
               'type' => 'select',
               'options' => array(          
                    'center' => __( 'Center', 'yiw' ),
                    'top left' => __( 'Top left', 'yiw' ),
                    'top center' => __( 'Top center', 'yiw' ),
                    'top right' => __( 'Top right', 'yiw' ),
                    'bottom left' => __( 'Bottom left', 'yiw' ),
                    'bottom center' => __( 'Bottom center', 'yiw' ),
                    'bottom right' => __( 'Bottom right', 'yiw' ),
               ),
               'deps' => array(
                    'id' => 'header_bg_type',
                    'value' => 'bg-image'
               ),
               'std' => 'bottom center' ),  
            
//         array( 'name' => __('Logo Width', 'yiw'),
//                'desc' => __('Enter the width of logo, expressed in pixel. (Leave empty for default)', 'yiw'),
//                'id' => 'logo_width', 
//                'type' => 'text',
//                'std' => ''),
//             
//         array( 'name' => __('Logo Height', 'yiw'),
//                'desc' => __('Enter the height of logo, expressed in pixel. (Leave empty for default)', 'yiw'),
//                'id' => 'logo_height', 
//                'type' => 'text',
//                'std' => ''),
               
        array( 'name' => __('Header Opacity', 'yiw'),
               'desc' => __('Select the opacity of the header', 'yiw'),
               'id' => 'header_opacity',
               'type' => 'slider',
               'min' => 1,
               'max' => 100,
               'type' => 'slider_control',
               'std' => 1),
        
        array( 'type' => 'close')
    ),   
    /* =================== END portfolio =================== */
                                                                  
     
    /* =================== IMAGES =================== */
    'images' => array(    
        array( 'name' => __('Images Sizes', 'yiw'),
               'type' => 'section'),
        array( 'type' => 'open'),                   
            
        array( 'desc' => __("For all of these image sizes settings, if you change these sizes, you need to re-upload again the regardin images, to generate the new sizes.", 'yiw'),
               'type' => 'simple-text'),   
            
        array( 'name' => __('Thumbnails in gallery', 'yiw'),
               'desc' => __("The thumbnails used in the gallery (you can set 0 to calculate the size automatically). Default: 208x168px", 'yiw'),
               'id' => 'thumb_gallery',    
               'data' => 'array',
               'type' => 'size',
               'std' => array( 'width' => 208, 'height' => 168 ) ),           
            
        array( 'desc' => '<strong>' . __("Portfolio", 'yiw') . '</strong>',
               'type' => 'simple-text'),   
            
        array( 'name' => __('Thumbnails portfolio 3 columns', 'yiw'),
               'desc' => __("The thumbnails used in the layout portfolio '3 Columns' (you can set 0 to calculate the size automatically). Default: 280x143px", 'yiw'),
               'id' => 'thumb_portfolio_3cols',    
               'data' => 'array',
               'type' => 'size',
               'std' => array( 'width' => 280, 'height' => 143 ) ), 
            
        array( 'name' => __('Thumbnails portfolio slider', 'yiw'),
               'desc' => __("The thumbnails used in the layout portfolio 'With Slider' (you can set 0 to calculate the size automatically). Default: 205x118px", 'yiw'),
               'id' => 'thumb_portfolio_slider',    
               'data' => 'array',
               'type' => 'size',
               'std' => array( 'width' => 205, 'height' => 118 ) ),     
            
        array( 'name' => __('Thumbnails portfolio big image', 'yiw'),
               'desc' => __("The thumbnails used in the layout portfolio 'Big Image' (you can set 0 to calculate the size automatically). Default: 205x118px", 'yiw'),
               'id' => 'thumb_portfolio_big',    
               'data' => 'array',
               'type' => 'size',
               'std' => array( 'width' => 617, 'height' => 295 ) ),        
            
        array( 'desc' => '<strong>' . __("Blog", 'yiw') . '</strong>',
               'type' => 'simple-text'),         
            
        array( 'name' => __('Thumbnails blog "Big Image"', 'yiw'),
               'desc' => __("The thumbnails used in the layout of blog 'Big Image' (you can set 0 to calculate the size automatically). Default: 540x0px", 'yiw'),
               'id' => 'blog_big',    
               'data' => 'array',
               'type' => 'size',
               'std' => array( 'width' => 540, 'height' => 0 ) ), 
            
        array( 'name' => __('Thumbnails blog "Small Image"', 'yiw'),
               'desc' => __("The thumbnails used in the layout of blog 'Small Image' (you can set 0 to calculate the size automatically). Default: 288x266px", 'yiw'),
               'id' => 'blog_small',    
               'data' => 'array',
               'type' => 'size',
               'std' => array( 'width' => 288, 'height' => 266 ) ),  
            
        array( 'name' => __('Thumbnails blog "Minimal"', 'yiw'),
               'desc' => __("The thumbnails used in the layout of blog 'Minimal' (you can set 0 to calculate the size automatically). Default: 720x0px", 'yiw'),
               'id' => 'blog_big',    
               'data' => 'array',
               'type' => 'size',
               'std' => array( 'width' => 720, 'height' => 0 ) ),     
            
        array( 'type' => 'close')
    ),        
    /* =================== END GENERAL =================== */
                                                 
                                                      
    /* =================== FOOTER =================== */
    'footer' => array(
        array( 'name' => __('Footer', 'yiw'),
               'type' => 'section'),
        array( 'type' => 'open'),   
         
        array( 'name' => __('Footer Type', 'yiw'),
               'desc' => __('Select the footer type for the theme', 'yiw'),
               'id' => 'footer_type',
               'type' => 'select',
               'options' => array(
                    'normal' => __( 'Two Columns Footer', 'yiw' ), 
                    'centered' => __( 'Centered Footer', 'yiw' ),
                    'big-normal' => __('Big Footer + Two Columns', 'yiw' ),
                    'big-centered' => __('Big Footer + Centered', 'yiw' )
                ),
               'std' => 'normal'),  
            
        array( 'name' => __('Big Footer Widget Areas', 'yiw'),
               'desc' => __('Select the number of widget area you\'d like to use.<br /><strong>Note: It will work only if you\'ve chosen one of Big Footer types above</strong>', 'yiw'),
               'id' => 'footer_rows',
               'type' => 'slider',
               'min' => 1,
               'max' => 4,
               'type' => 'slider_control',
               'std' => 1),  

        array( 'name' => __('Number of widgets in each footer Widget Area', 'yiw'),
               'desc' => __('Select the number of widget you\'d like to use in each footer widget area<br /><strong>Note: It will work only if you\'ve chosen one of Big Footer types above</strong>', 'yiw'),
               'id' => 'footer_columns',
               'type' => 'slider',
               'min' => 1,
               'max' => 4,
               'type' => 'slider_control',
               'std' => 4),  

        array( 'name' => __('Footer centered text', 'yiw'),
               'desc' => __('Enter text used in <strong>centered footer</strong>. It can be HTML.', 'yiw'),
               'id' => 'footer_text_centered',
               'type' => 'textarea',
               'std' => '' ),
            
        array( 'name' => __('Footer copyright text Left', 'yiw'),
               'desc' => __('Enter text used in the left side of the footer. It can be HTML. <strong>NB: not figured on "centered footer"</strong>', 'yiw'),
               'id' => 'copyright_text_left',
               'type' => 'textarea',
               'std' => 'Copyright <a href="%site_url%"><strong>%name_site%</strong></a> 2012' ),
            
        array( 'name' => __('Footer copyright text Right', 'yiw'),
               'desc' => __('Enter text used in the right side of the footer. It can be HTML. <strong>NB: not figured on "centered footer"</strong>', 'yiw'),
               'id' => 'copyright_text_right',
               'type' => 'textarea',
               'std' => 'Powered by <a href="http://www.yourinspirationweb.com/en"><strong>Your Inspiration Web</strong></a>'),
            
        array( 'name' => __('Google Analytics Code', 'yiw'),
               'desc' => __('You can paste your Google Analytics or other tracking code in this box. This will be automatically added to the footer.', 'yiw'),
               'id' => 'ga_code',
               'type' => 'textarea',
               'std' => ''),
         
        array( 'type' => 'close')   
    ),           
    /* =================== END FOOTER =================== */  
 
);   
?>