<div class="home_items home_items_gallery group">
    <div class="home_items_title"><h3><?php echo yiw_get_option('gallery_title') ?></h3></div>
    
    
    <?php                                   
    $c = 1;                                               
    $cols = yiw_layout_page() == 'sidebar-no' ? 4 : 3;
    $items = yiw_get_option('gallery_items_home_page') * 1;    
    $rows = ceil( $items % $cols );                   
    $gallery = new WP_Query( array(
        'post_type'      => 'gallery',
        'posts_per_page' => $items
    ) );                         
    
    $class = ( $cols == 3 ) ? 'one-third' : 'one-fourth';
    

    add_filter('excerpt_length', 'yiw_excerpt_length');
    add_filter( 'excerpt_more', 'yiw_excerpt_more' );
    remove_filter( 'the_excerpt', 'wpautop' );
                                            
                                
    while( $gallery->have_posts() ) : $gallery->the_post(); global $more; $more = 0; ?>
        <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ); ?>
        <div class="home_item home_item_gallery item_<?php the_ID() ?> <?php echo $class ?><?php if ( $c % $cols == 0 ) echo ' last' ?><?php if ( $c > $items - $cols ) echo ' last-row' ?>">
            <a href="<?php echo $image[0] ?>" rel="prettyPhoto[gallery]" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'thumb_home_page', array( 'class' => 'picture' ) ) ?></a>
            <h4><?php the_title() ?></h4>
        </div>
    <?php          
        $c++;
        endwhile; 
        wp_reset_query(); 
        //remove_filter('excerpt_length', 'yiw_excerpt_length');
        //remove_filter( 'excerpt_more', 'yiw_excerpt_more' );
        //add_filter( 'the_excerpt', 'wpautop' );
    ?>
</div>
