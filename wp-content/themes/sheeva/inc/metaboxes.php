<?php
/**
 * Register theme metaboxes.     
 * 
 * @package WordPress
 * @subpackage YIW Themes
 * @since 1.0
 */
 
// subtitle slogan
$options_args = array(
    11 => array( 
        'id' => 'subslogan_page',
        'name' => __( 'Slogan Subtitle', 'yiw' ), 
        'type' => 'text',
        'desc' => __( 'Insert the subtitle of slogan showed below the main title of this slogan.', 'yiw' ),
        'desc_location' => 'newline'
    ),
); 
yiw_add_options_to_metabox( 'yiw_slogan_page', $options_args );




//testimonial url
$options_args = array(
    10 => array(
        'id' => 'testimonial_label',
        'name' => __( 'Web Site Label', 'yiw' ), 
        'type' => 'text',
        'desc' => __( 'Insert the label used for Testimonial Website Url', 'yiw' ),
        'desc_location' => 'newline'
    ),
    20 => array(
        'id' => 'testimonial_website',
        'name' => __( 'Web Site URL', 'yiw' ), 
        'type' => 'text',
        'desc' => __( 'Insert the url referred to Testimonial', 'yiw' ),
        'desc_location' => 'newline'
    )
);
yiw_register_metabox( 'yiw_url_testimonial', __( 'Website Testimonial', 'yiw' ), 'bl_testimonials', $options_args, 'normal', 'high' );




//show breadcrumbs
global $yiw_sliders;
$options_args = array(
    21 => array( 
        'id' => 'show_breadcrumbs_page',
        'name' => __( 'Show Breadcrumbs below the title', 'yiw' ), 
        'type' => 'radio',
        'options' => array(
            'yes' => __( 'Yes', 'yiw' ),
            'no' => __( 'No', 'yiw' ),  
        ),
        'std' => 'yes'
    ),
    
    72 => array( 
        'id' => 'slider_accordion',
        'name' => __( 'Accordion slider', 'yiw' ), 
        'type' => 'select',
        'options' => yiw_accordion_sliders( array( 'no' => __( 'No accordion', 'yiw' ) ) ),
        'std' => 'yes',
        'std' => 0
    ),
    
    80 => array( 
        'id' => 'slider_type',
        'name' => __( 'Select a slider for this page', 'yiw' ), 
        'type' => 'select',
        'hidden' => false,
        'options' => $yiw_sliders,
        'std' => 'none'
    ),
	99 => array( 
		'id' => 'portfolio_post_type',
		'name' => __( 'Portfolio', 'yiw' ), 
		'desc' => __( 'NB: valid only for the portfolio template', 'yiw' ),
		'type' => 'select',
		'options' => yiw_get_portfolios(),
		//'hidden' => false,
		//'desc' => __( 'Insert the subtitle of slogan showed below the main title of this slogan.', 'yiw' ),
		//'desc_location' => 'newline'
	),

); 
yiw_add_options_to_metabox( 'yiw_options_page', $options_args );

//portfolio video url
$options_args = array(
    10 => array(
        'id' => 'portfolio_video',
        'name' => __( 'Video URL:', 'yiw' ), 
        'type' => 'text',
        'desc' => __( 'Here, you can add an Youtube or Vimeo url video, to show on thumb of this portfolio element.', 'yiw' ),
        'desc_location' => 'newline'
    )
);
foreach( yiw_get_portfolios() as $post_type => $post_type_title )
    yiw_register_metabox( 'yiw_url_portfolio_' . $post_type, __( 'Video URL', 'yiw' ), $post_type, $options_args, 'normal', 'high' );

// portfolio
$options_args = array(
    10 => array( 
        'id' => 'portfolio_skills_label',
        'name' => __( 'Skills Label', 'yiw' ), 
        'type' => 'text',
        'desc' => __( 'Insert the label used in skills field', 'yiw' ),
        'desc_location' => 'newline'
    ),
    20 => array( 
        'id' => 'portfolio_skills',
        'name' => __( 'Skills', 'yiw' ), 
        'type' => 'text',
        'desc' => __( 'Insert the skills', 'yiw' ),
        'desc_location' => 'newline'
    ),
   30 => array( 
        'id' => 'portfolio_date_label',
        'name' => __( 'Date label', 'yiw' ), 
        'type' => 'text',
        'desc' => __( 'Insert the label used in date field', 'yiw' ),
        'desc_location' => 'newline'
    ),
   40 => array( 
        'id' => 'portfolio_date',
        'name' => __( 'Date', 'yiw' ), 
        'type' => 'text',
        'desc' => __( 'Insert the date', 'yiw' ),
        'desc_location' => 'newline'
    )
); 
foreach( yiw_get_portfolios() as $post_type => $post_type_title )
    yiw_register_metabox( 'yiw_portfolio_skillsdate_' . $post_type, __( 'Skills and Date', 'yiw' ), $post_type, $options_args, 'normal', 'high' );



//team roles
$options_args = array(
    10 => array(
        'id' => 'team_role',
        'name' => __( 'Role:', 'yiw' ), 
        'type' => 'text',
        'desc' => __( 'The role of the collaborator.', 'yiw' ),
        'desc_location' => 'newline'
    )
);
yiw_register_metabox( 'yiw_role_team', __( 'Role', 'yiw' ), 'bl_team', $options_args, 'normal', 'high' );

// accordion
$options_args = array(
    10 => array( 
        'id' => 'slider_accordion_subtitle',
        'name' => __( '', 'yiw' ), 
        'type' => 'text',
        'desc' => __( 'Insert the subtitle.', 'yiw' ),
        'desc_location' => 'newline'
    )
); 
foreach( yiw_accordion_sliders() as $post_type => $post_type_title )
    yiw_register_metabox( 'yiw_accordion_subtitle_' . $post_type, __( 'Subtitle Slide', 'yiw' ), $post_type, $options_args, 'side', 'high' );

?>