<?php    
                         
$yiw_options['accordions'] = array (         
	    
    /* =================== SIDEBARS =================== */
    "add-accordion-slider" => array(    
        array( "name" => __('Accordion Sliders manager', 'yiw'),
        	   "type" => "title"),
    
        array( "name" => __("Create Accordion Slider", 'yiw'),
        	   "type" => "section",
			   "effect" => 0),
        array( "type" => "open"),  
         
        array( "name" => __("Slider name", 'yiw'),
        	   "desc" => __("Add new accordion slider. Creating this slider, you create new custom post type automatically, where you can create the contents for this slider.", 'yiw'),
        	   "id" => "accordion_sliders",
        	   "type" => "text",        
               'button' => __( 'Add slider', 'yiw' ),
        	   "data" => "array",
        	   "mode" => "merge",
        	   "control" => isset( $wp_post_types ) ? $wp_post_types : array(),
        	   "show_value" => false,
			   "std" => ''),	
        	
        array( "type" => "close")
    ),
	        
    "table-accordion-sliders" => array(    
        array( "name" => __("Accordion sliders created", 'yiw'),
        	   "type" => "section",
			   "effect" => 0,
			   "show-submit" => false),
        array( "type" => "open"),  
         
        array( "name" => __("List sliders created", 'yiw'),
        	   "desc" => __("Table with sliders that you have created.", 'yiw'),
        	   "values" => "accordion_sliders",            
        	   "label" => array( 'Accordion slider', 'Accordion Sliders' ),
        	   "type" => "sidebar-table"),	
        	
        array( "type" => "close")
    )        
    /* =================== END SIDEBARS =================== */
 
);         
?>