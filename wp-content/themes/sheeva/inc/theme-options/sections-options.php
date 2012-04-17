<?php                

$yiw_options['sections'] = array (
     
    /* =================== portfolio =================== */
    'portfolio' => array(

        array( 'name' => __('Sections', 'yiw'),
               'type' => 'title'),
    
        array( 'name' => __('portfolio', 'yiw'),
               'type' => 'section'),
        array( 'type' => 'open'),


        array( 'name' => __('Default layout page', 'yiw'),
               'desc' => __('Define the default layout to use for the portfolio pages, as single pages, categories page, etc..', 'yiw'),
               'id' => 'portfolio_layout_page',
               'type' => 'select',
               'options' => array(
                    'sidebar-left' => __( 'Sidebar Left', 'yiw' ),
                    'sidebar-right' => __( 'Sidebar Right', 'yiw' ),
                    'sidebar-no' => __( 'No Sidebar', 'yiw' ),
               ),
               'std' => 'sidebar-right'),     

        array( 'name' => __('Show filters', 'yiw'),
               'desc' => __('Say if you want to show the filters navigation in the gallery page.', 'yiw'),
               'id' => 'portfolio_show_filters',
               'type' => 'on-off',
               'std' => 1 ),       
               
        array( 'name' => __('Thumbnail click', 'yiw'),
               'desc' => __('Select what you want to do when you click in the item thumbnail (not valid for the portfolio filterable).', 'yiw'),
               'id' => 'portfolio_thumbnail_click',
               'type' => 'select',
               'options' => array(
                    'lightbox' => __( 'Open full image in a lightbox', 'yiw' ),
                    'item-page' => __( 'Go to item single page', 'yiw' ),
                    'nothing' => __( "Don't do nothing", 'yiw' ),
               ),
               'std' => 'lightbox'),  
               
        array( 'name' => __('Link to single page in Portfolio Filterable', 'yiw'),
               'desc' => __('Select if you want to show the icon to go to the item single page, when you pass over the thumbnail in the portfolio filterable.', 'yiw'),
               'id' => 'portfolio_details_icon',
               'type' => 'on-off',
               'std' => 1),               
         
        array( 'desc' => '<strong>' . __('Home Page', 'yiw') . '</strong>',
        	   'type' => 'simple-text'),    


        array( 'name' => __('Section title', 'yiw'),
               'desc' => __('Define the title showed.', 'yiw'),
               'id' => 'portfolio_title',
               'type' => 'text',
               'std' => __( 'Recent Projects', 'yiw' ) ),  

//        array( 'name' => __('Section subtitle', 'yiw'),
//               'desc' => __('Define the subtitle showed.', 'yiw'),
//               'id' => 'portfolio_subtitle',
//               'type' => 'text',
//               'std' => __( 'this is a selection of my great works', 'yiw' ) ),  
               
        array( 'name' => __('Show in home page', 'yiw'),
               'desc' => __('Select if you want to show the section in home page template.', 'yiw'),
               'id' => 'portfolio_show_home_page',
               'type' => 'on-off',
               'std' => __( 1, 'yiw' ) ),
               
        array( 'name' => __('Portfolio (home page)', 'yiw'),
               'desc' => __('Select the post type of portfolio for the posts to show in home.', 'yiw'),
               'id' => 'portfolio_post type_home_page',
               'type' => 'select',
               'options' => array_merge( array( '' => __( 'All portfolios', 'yiw' ) ), yiw_get_portfolios() ),
               'std' => ''),          
               
        array( 'name' => __('Items (home page)', 'yiw'),
               'desc' => __('Select how many items you want to show in home page template.', 'yiw'),
               'id' => 'portfolio_items_home_page',
               'min' => 2,
               'max' => 12,
               'type' => 'slider_control',
               'std' => 3),          
            
//         array( 'name' => __('More text', 'yiw'),
//                'desc' => __('Define what show for more link.', 'yiw'),
//                'id' => 'portfolio_more_text',
//                'type' => 'text',
//                'std' => __( 'read more &raquo;', 'yiw' ) ),   
               
//        array( 'name' => __('Date Format', 'yiw'),
//               'desc' => __('Define the date format for portfolio works (where enabled)', 'yiw'),
//               'id' => 'portfolio_date_format',
//               'type' => 'text',
//               'std' => __( 'F j, Y', 'yiw' ) ),   
            
        array( 'name' => __('Lightbox Skin', 'yiw'),
               'desc' => __('Specific what skin you want for videos and images lightbox.', 'yiw'),
               'id' => 'portfolio_skin_lightbox',
               'type' => 'select',
               'options' => array(
                    'pp_default' => 'Default', 
                    'facebook' => 'Facebook', 
                    'light_rounded' => 'Light rounded', 
                    'dark_rounded' => 'Dark rounded semi-transparent',
                    'light_square' => 'Light square',
                    'dark_square' => 'Dark square semi-transparent'
                ),
               'std' => 'pp_default'),   
        
        array( 'type' => 'close')
    ),   
    /* =================== END portfolio =================== */

    
    /* =================== services =================== */
    'services' => array(
    
        array( 'name' => __('Services', 'yiw'),
               'type' => 'section'),
        array( 'type' => 'open'),  

        array( 'name' => __('Section title', 'yiw'),
               'desc' => __('Define the title showed.', 'yiw'),
               'id' => 'services_title',
               'type' => 'text',
               'std' => __( 'What we do', 'yiw' ) ),  

//        array( 'name' => __('Section subtitle', 'yiw'),
//               'desc' => __('Define the subtitle showed.', 'yiw'),
//               'id' => 'services_subtitle',
//               'type' => 'text',
//               'std' => __( 'what we can do for you', 'yiw' ) ),  
               
        array( 'name' => __('Show in home page', 'yiw'),
               'desc' => __('Select if you want to show the section in home page template.', 'yiw'),
               'id' => 'services_show_home_page',
               'type' => 'on-off',
               'std' => __( 1, 'yiw' ) ),
               
        array( 'name' => __('Items (home page)', 'yiw'),
               'desc' => __('Select how many items you want to show in home page template.', 'yiw'),
               'id' => 'services_items_home_page',
               'min' => 2,
               'max' => 12,
               'type' => 'slider_control',
               'std' => 3),  
               
        array( 'name' => __('Show excerpt (home page)', 'yiw'),
               'desc' => __('Select if you want to show the excerpt below the service.', 'yiw'),
               'id' => 'services_show_excerpt',
               'type' => 'on-off',
               'std' => __( 1, 'yiw' ) ),
               
        array( 'name' => __('Show read more button', 'yiw'),
               'desc' => __('Select if you want to show the read more button below the service.', 'yiw'),
               'id' => 'services_show_read_more',
               'type' => 'on-off',
               'std' => __( 1, 'yiw' ) ),

         
        array( 'name' => __('Read More text', 'yiw'),
               'desc' => __('Write what you want to show on more link, if you have selected "YES" on option above.', 'yiw'),
               'id' => 'services_read_more_text',
               'type' => 'text',
               'std' => __( 'Read more...', 'yiw' ) ),
               
        array( 'type' => 'close')
    ),   
    /* =================== END services =================== */

    /* =================== gallery =================== */
    'gallery' => array(
    
        array( 'name' => __('Gallery', 'yiw'),
               'type' => 'section'),
        array( 'type' => 'open'),  

        array( 'name' => __('Show filters', 'yiw'),
               'desc' => __('Say if you want to show the filters navigation in the gallery page.', 'yiw'),
               'id' => 'gallery_show_filters',
               'type' => 'on-off',
               'std' => 1 ),   
         
        array( 'desc' => '<strong>' . __('Home Page', 'yiw') . '</strong>',
        	   'type' => 'simple-text'),     


        array( 'name' => __('Section title', 'yiw'),
               'desc' => __('Define the title showed.', 'yiw'),
               'id' => 'gallery_title',
               'type' => 'text',
               'std' => __( 'Latest Images', 'yiw' ) ),  

//        array( 'name' => __('Section subtitle', 'yiw'),
//               'desc' => __('Define the subtitle showed.', 'yiw'),
//               'id' => 'gallery_subtitle',
//               'type' => 'text',
//               'std' => __( 'last images inserted', 'yiw' ) ),  
               
        array( 'name' => __('Show in home page', 'yiw'),
               'desc' => __('Select if you want to show the section in home page template.', 'yiw'),
               'id' => 'gallery_show_home_page',
               'type' => 'on-off',
               'std' => __( 1, 'yiw' ) ),
               
        array( 'name' => __('Items (home page)', 'yiw'),
               'desc' => __('Select how many items you want to show in home page template.', 'yiw'),
               'id' => 'gallery_items_home_page',
               'min' => 2,
               'max' => 12,
               'type' => 'slider_control',
               'std' => 3),  
               
        array( 'name' => __('Link to item single page', 'yiw'),
               'desc' => __('Select if you want to show the icon to go to the item single page, when you pass over the thumbnail.', 'yiw'),
               'id' => 'gallery_details_icon',
               'type' => 'on-off',
               'std' => 1),   
            
        array( 'name' => __('Lightbox Skin', 'yiw'),
               'desc' => __('Specific what skin you want for videos and images lightbox.', 'yiw'),
               'id' => 'portfolio_skin_lightbox',
               'type' => 'select',
               'options' => array(
                    'pp_default' => 'Default', 
                    'facebook' => 'Facebook', 
                    'light_rounded' => 'Light rounded', 
                    'dark_rounded' => 'Dark rounded semi-transparent',
                    'light_square' => 'Light square',
                    'dark_square' => 'Dark square semi-transparent'
                ),
               'std' => 'pp_default'),     
        
        array( 'type' => 'close')
    ),   
    /* =================== END services =================== */


                                                 
    /* =================== BLOG =================== */
    'blog' => array(
        array( 'name' => __('Blog Settings', 'yiw'),
               'type' => 'section'),
        array( 'type' => 'open'),         

        array( 'name' => __('Section title', 'yiw'),
               'desc' => __('Define the title showed.', 'yiw'),
               'id' => 'blog_title',
               'type' => 'text',
               'std' => __( 'Latest Articles', 'yiw' ) ),  

//        array( 'name' => __('Section subtitle', 'yiw'),
//               'desc' => __('Define the subtitle showed.', 'yiw'),
//               'id' => 'blog_subtitle',
//               'type' => 'text',
//               'std' => __( 'stay updated with our last news', 'yiw' ) ),  

        array( 'name' => __('Show thumbnail in home page', 'yiw'),
               'desc' => __('Select if you want to show the thumbnail in  the section of home page template.', 'yiw'),
               'id' => 'blog_show_thumbnail_homepage',
               'type' => 'on-off',
               'std' => __( 1, 'yiw' ) ),

        array( 'name' => __('Show in home page', 'yiw'),
               'desc' => __('Select if you want to show the section in home page template.', 'yiw'),
               'id' => 'blog_show_home_page',
               'type' => 'on-off',
               'std' => __( 1, 'yiw' ) ),
               
        array( 'name' => __('Items (home page)', 'yiw'),
               'desc' => __('Select how many items you want to show in home page template.', 'yiw'),
               'id' => 'blog_items_home_page',
               'min' => 2,
               'max' => 12,
               'type' => 'slider_control',
               'std' => 3),  
               
        array( 'name' => __('Blog Type', 'yiw'),
               'desc' => __('Say the layout for your blog page.', 'yiw'),
               'id' => 'blog_type',
               'type' => 'select',
               'options' => array( 'big' => __('Big Thumbnail', 'yiw'), 'small' => __('Small Thumbnail', 'yiw'), 'minimal' => __('Minimal', 'yiw') ),
               'std' => 'big'),
/*
        array( 'name' => __('Items', 'yiw'),
               'desc' => __('Select how many items you want to show on Blog Page', 'yiw'),
               'id' => 'posts_per_page',
               'min' => 1,
               'max' => 50,
               'type' => 'slider_control',
               'std' => 10),          
*/
        array( 'name' => __('Exclude categories', 'yiw'),
               'desc' => __('Select witch categories you want exlude from blog.', 'yiw'),
               'id' => 'blog_cats_exclude',
               'type' => 'cat',
               'cols' => 2,          // number of columns for multickecks
               'heads' => array(__('Blog Page', 'yiw'), __('List cat. sidebar', 'yiw')),  // in case of multi columns, specific the head for each column
               'std' => ''),          
/*
        array( 'name' => __('Show post date', 'yiw'),
               'desc' => __('Select if you want to show the date in your posts.', 'yiw'),
               'id' => 'blog_show_date',
               'type' => 'on-off',
               'std' => 1 ),
*/

        array( 'name' => __('Show read more button', 'yiw'),
               'desc' => __('Select if you want to show the read more button below the post.', 'yiw'),
               'id' => 'blog_show_read_more',
               'type' => 'on-off',
               'std' => __( 1, 'yiw' ) ),

        array( 'name' => __('Read more text', 'yiw'),
               'desc' => __('Write what you want to show on more link', 'yiw'),
               'id' => 'blog_read_more_text',
               'type' => 'text',
               'std' => 'Read more' ),
               
/*
        array( 'name' => __('Featured Images Alignment', 'yiw'),
               'desc' => __('Specific the featured images alignment', 'yiw'),
               'id' => 'blog_image_align',
               'type' => 'select',
               'options' => array(
                    'alignleft' => 'Left', 
                    'alignright' => 'Right', 
                    'aligncenter' => 'Center'
                ),
               'std' => 'aligncenter'),
            
        array( 'name' => __('Featured Images Size', 'yiw'),
               'desc' => __('Specific the featured images size', 'yiw'),
               'id' => 'blog_image_size',
               'type' => 'select',
               'options' => array(
                    'post-thumbnail' => 'Standard', 
                    'thumbnail' => 'Thumbnail', 
                    'medium' => 'Medium',
                    'large' => 'Large',
                    'custom' => 'Custom'
                ),
               'std' => 'post-thumbnail'),
            
        array( 'name' => __('Featured Images Width', 'yiw'),
               'desc' => __('Specific the featured images width, <strong>if you have selected custom size on option above.</strong>', 'yiw'),
               'id' => 'blog_image_width',
               'type' => 'text',
               'std' => ''),
            
        array( 'name' => __('Featured Images Height', 'yiw'),
               'desc' => __('Specific the featured images height, <strong>if you have selected custom size on option above.</strong>', 'yiw'),
               'id' => 'blog_image_height',
               'type' => 'text',
               'std' => ''),
*/
        array( 'type' => 'close')   
    ),
    /* =================== END BLOG =================== */    
    
 
);   
