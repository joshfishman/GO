<?php

/**
 * Custom types name
 */
add_action( 'init', 'yiw_register_portoflios', 0  );
add_action( 'admin_init', 'yiw_portfolio_metaboxes' );     
add_action( 'manage_posts_custom_column',  'yiw_new_portfolio_custom_columns');
add_filter( 'manage_edit-create-portfolio_columns', 'yiw_new_portfolio_edit_columns'); 

if ( is_admin() && ! get_option( 'default_portfolios_created' ) ) {
    $id = wp_insert_post( array(     
        'post_title' => __( 'Portfolio', 'yiw' ),
        'post_status' => 'publish',
        'post_author' => 1,
        'post_type' => 'create-portfolio'
    ) );      
    add_post_meta( $id, '_portfolio_type', '3cols' );
    add_post_meta( $id, '_portfolio_item', '' ); 
    add_post_meta( $id, '_portfolio_read_more', __( 'View Project', 'yiw' ) ); 
    add_post_meta( $id, '_portfolio_rewrite', 'work' ); 
    add_post_meta( $id, '_portfolio_label_sin', __( 'Work', 'yiw' ) ); 
    add_post_meta( $id, '_portfolio_label_plu', __( 'Works', 'yiw' ) ); 
    add_post_meta( $id, '_portfolio_tax', __( 'Category project', 'yiw' ) );
    add_post_meta( $id, '_portfolio_tax_rewrite', __( 'category-project', 'yiw' ) );
    
    update_option( 'default_portfolios_created', 1 );
}

/**
 * Register post types for the theme
 *
 * @return void
 */
function yiw_register_portoflios(){
  
	register_post_type(         
        'create-portfolio',
        array(
		  'description' => __('Create Portfolio', 'yiw'),
		  'exclude_from_search' => true,
		  'show_ui' => true,
		  'labels' => yiw_label(__('Portfolio', 'yiw'), __('Portfolios', 'yiw'), __('New Portfolio', 'yiw')),
		  'supports' => array( 'title', 'thumbnail' ),
		  'public' => false,
		  'menu_position' => 64
        )
    );  
    
    $portofolios = get_posts( array( 
        'post_type' => 'create-portfolio',
        'numberposts' => -1 
    ) );
    foreach ( $portofolios as $post ) :   
        
        // post types
        $rewrite    = get_post_meta( $post->ID, '_portfolio_rewrite', true );
        $read_more  = get_post_meta( $post->ID, '_portfolio_read_more', true );
        $label_sin  = get_post_meta( $post->ID, '_portfolio_label_sin', true );
        $label_plu  = get_post_meta( $post->ID, '_portfolio_label_plu', true );
        
        if ( empty( $label_sin ) )
            $label_sin = $post->post_title;
        
        if ( empty( $label_plu ) )
            $label_plu = $post->post_title;
        
        if ( empty( $rewrite ) )
            $rewrite = sanitize_title( $post->post_title );
        
        // icon
        $thumbnail_id = get_post_thumbnail_id( $post->ID );
        if ( ! empty( $thumbnail_id ) )
            $icon = wp_get_attachment_image_src( $thumbnail_id );
        else
            $icon = null;
        
        register_post_type(         
            sanitize_title( $post->post_title ),
            array(
    		  'description' => apply_filters( 'the_title' , $post->post_title ),
    		  'exclude_from_search' => false,
    		  'show_ui' => true,
    		  'labels' => yiw_label( $label_sin, $label_plu, apply_filters( 'the_title' , $post->post_title ) ),
    		  'supports' => array( 'title', 'editor', 'thumbnail' ),
    		  'public' => true,
    		  'capability_type' => 'page',
        	  'publicly_queryable' => true,
    		  'rewrite' => array( 'slug' => $rewrite, 'with_front' => true ),
    		  'menu_icon' => $icon
            )
        );     
        
        add_action( 'manage_posts_custom_column',  'yiw_portfolio_custom_columns');
		add_filter( 'manage_edit-'.sanitize_title( $post->post_title ).'_columns', 'yiw_portfolio_edit_columns');
                              
        // taxonomies 
        $portfolio_tax          = get_post_meta( $post->ID, '_portfolio_tax', true );
        $portfolio_tax_rewrite  = get_post_meta( $post->ID, '_portfolio_tax_rewrite', true );
        
        if ( ! empty( $portfolio_tax ) )
            register_taxonomy( sanitize_title( $portfolio_tax ), array( sanitize_title( $post->post_title ) ), array(
        		'hierarchical' => true,
        		'labels' => yiw_label_tax( __('Category', 'yiw'), __('Categories', 'yiw')),
        		'show_ui' => true,
        		'query_var' => true,
        		'rewrite' => array( 'slug' => $portfolio_tax_rewrite, 'with_front' => false )
        	));
    endforeach;
       	
	//flush_rewrite_rules();
    
}

function yiw_portfolio_metaboxes() {
    global $yiw_portfolio_type;
    
    $options_args = array(
		10 => array(  
			'type' => 'paragraph',
			'text' => __( 'Set here the features of this portfolio. On right side, you can also choose an icon to show in the admin menu, by upload it in "Featured Image"', 'yiw' )
		),  
		15 => array( 
			'id' => 'portfolio_type',
			'name' => __( 'Layout', 'yiw' ), 
			'type' => 'select',
			'options' => $yiw_portfolio_type,
			'desc' => __( 'Set the layout for this portfolio, that will be used in the page with the portfolio template.', 'yiw' ),
			'std' => ''
		), 
		16 => array( 
			'id' => 'portfolio_items',
			'name' => __( 'Items', 'yiw' ), 
			'type' => 'text',
			'desc' => __( 'The number of items to show in this portfolio, when selected in the page. Leave empty to show all items.', 'yiw' ),
			'std' => ''
		),    
		17 => array( 
			'id' => 'portfolio_read_more',
			'name' => __( 'Read More', 'yiw' ), 
			'type' => 'text',
			'desc' => __( 'The text of button to read the entire post.', 'yiw' ),
			'std' => __( 'View Project', 'yiw' )
		),            
		19 => array( 
			'type' => 'sep'
		),    
		20 => array( 
			'id' => 'portfolio_rewrite',
			'name' => __( 'Rewrite', 'yiw' ), 
			'type' => 'text',
			'desc' => __( 'Set the rewrite role for the posts of this portfolio (es. %s/). Leave empty to generate it automatically.', 'yiw' ),
			'std' => ''
		),       
		30 => array( 
			'id' => 'portfolio_label_sin',
			'name' => __( 'Label Singular', 'yiw' ), 
			'type' => 'text',
			'desc' => __( 'The label that will be shown when you create the post of this portfolio.', 'yiw' ),
			'std' => ''
		),     
		40 => array( 
			'id' => 'portfolio_label_plu',
			'name' => __( 'Label Plural', 'yiw' ), 
			'desc' => __( 'The label that will be shown when you create the post of this portfolio.', 'yiw' ),
			'type' => 'text',
			'std' => ''
		),     
		50 => array( 
			'type' => 'sep'
		),    
		60 => array( 
			'id' => 'portfolio_tax',
			'name' => __( 'Taxonomy', 'yiw' ),  
			'desc' => __( "Set the taxonomy for this portfolio. Leave empty, if you don't want a taxonomy.", 'yiw' ),
			'type' => 'text',
			'std' => ''
		),    
		70 => array( 
			'id' => 'portfolio_tax_rewrite',
			'name' => __( 'Taxonomy rewrite', 'yiw' ),  
			'desc' => __( 'Set the rewrite role for the posts of this portfolio. Leave empty to generate it automatically.', 'yiw' ),
			'type' => 'text',
			'std' => ''
		),     
	); 
	yiw_register_metabox( 'yiw_portfolio_options', __( 'Portfolio options', 'yiw' ), 'create-portfolio', $options_args, 'normal' );      
}


         

/**
 * Create a custom fields for custom types
 */   
 
 
/**
 * bl_portfolio
 */
function yiw_new_portfolio_edit_columns($columns){
	$columns = array(
	    'cb' => '<input type="checkbox" />',
	    'title' => __( 'Name', 'yiw' ),
	    'portfolio-type' => __( 'Layout Type', 'yiw' ),
	    'portfolio-items' => __( 'Items', 'yiw' ),       
	    'portfolio-labels' => __( 'Labels', 'yiw' ),    
	    'portfolio-tax' => __( 'Tax', 'yiw' ),  
	);
	
	return $columns;
}

function yiw_new_portfolio_custom_columns($column){
	global $post;
	                                      
	switch ($column) {
	    case "portfolio-type":
	      echo get_post_meta( get_the_ID(), '_portfolio_type', true );
	      break;
	    case "portfolio-items":
	      echo get_post_meta( get_the_ID(), '_portfolio_items', true );
	      break;
	    case "portfolio-labels":
	      echo get_post_meta( get_the_ID(), '_portfolio_label_sin', true ) . ' / ' . get_post_meta( get_the_ID(), '_portfolio_label_plu', true );
	      break;
	    case "portfolio-tax":
	      echo get_post_meta( get_the_ID(), '_portfolio_tax', true );
	      break;
	}   
}	   
 
 
/**
 * bl_portfolio
 */
function yiw_portfolio_edit_columns($columns){
	$columns = array(
	    'cb' => '<input type="checkbox" />',
	    'title' => __( 'Portfolio Title', 'yiw' ),
	    'description-portfolio' => __( 'Description', 'yiw' ),
	    //'year' => __( 'Year Completed', 'yiw' ),
	    'category-project' => __( 'Category Project', 'yiw' ),
	);

	
	return $columns;
}

function yiw_portfolio_custom_columns($column){
	global $post;
	                                      
	switch ($column) {
	    case "description-portfolio":
	      the_excerpt();
	      break;
	    case "year":
	      $custom = get_post_custom();
	      echo $custom["year_completed"][0];
	      break;
	    case "category-project":
	      $portfolio = yiw_portfolio();
	      if ( ! empty( $portfolio['tax'] ) )
	          echo get_the_term_list($post->ID, $portfolio['tax'], '', ', ','');
	      break;
	}                            

}	 

function yiw_portfolios() {
    $r = array();
    
    $portfolios = wp_cache_get( 'yiw_portfolios' );    
    if ( false === $portfolios ) {
        $portfolios = get_posts( array( 
            'post_type' => 'create-portfolio',
            'numberposts' => -1 
        ) );                           
        wp_cache_set( 'yiw_portfolios', $portfolios );
    }
    
    foreach ( $portfolios as $post ) {
        $read_more = get_post_meta( $post->ID, '_portfolio_read_more', true );
        $r[ sanitize_title( $post->post_title ) ] = array(
            'ID' => $post->ID,
            'title' => $post->post_title,
            'tax' => sanitize_title( get_post_meta( $post->ID, '_portfolio_tax', true ) ),
            'items' => get_post_meta( $post->ID, '_portfolio_items', true ),
            'layout' => get_post_meta( $post->ID, '_portfolio_type', true ),
            'read_more' => ! empty( $read_more ) ? $read_more : __( 'View Project', 'yiw' )
        );
    }
    
    return $r;
}             

function yiw_get_portfolios() {
    $r = array();
    
    $portofolios = yiw_portfolios();
    foreach ( $portofolios as $pt => $post )
        $r[ $pt ] = $post['title'];
    
    return $r;
} 

function yiw_portfolio( $pt = false ) {
    if ( ! $pt )
        $pt = get_post_type();
    
    $portfolios = yiw_portfolios();
    return $portfolios[ $pt ];
}

function remove_quick_edit( $actions ) {
    unset($actions['inline hide-if-no-js']);
    return $actions;
}
//add_filter('post_row_actions','remove_quick_edit',10,1);

function yiw_is_portfolio_tax( $tax ) {   
    $portfolios = yiw_portfolios();
    
    $post_types = array_keys($portfolios);
    foreach( $post_types as $pt )     
        if( sanitize_title( $portfolios[$pt]['tax'] ) == $tax )
            return true;    
    
    return false;
}

function yiw_is_portfolio_post_type( $pt = false ) {   
    $portfolios = yiw_portfolios();
    
    if ( ! $pt )
        $pt = get_post_type();
    
    if ( isset( $portfolios[$pt] ) )
        return true;
    
    return false;
}

function yiw_get_portfolio_post_type() {
    global $yiw_portfolio;
        
    $post_type = get_post_meta( get_the_ID(), '_portfolio_post_type', true );
    
    if ( empty( $post_type ) && is_tax() ) {
        $tax = get_query_var('taxonomy');   
        
        $post_types = array_keys($yiw_portfolio); 
        foreach( $post_types as $pt )
            if( sanitize_title( $yiw_portfolio[$pt]['tax'] ) == $tax )
                return $pt;
    }
    
    return $post_type;
}