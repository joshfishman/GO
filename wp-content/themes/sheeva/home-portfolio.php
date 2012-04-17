<div class="home_items home_items_portfolio group">
    <div class="home_items_title"><h3><?php echo yiw_get_option('portfolio_title') ?></h3></div> 
    
    
    <?php
    $post_types = yiw_get_option('portfolio_post_type_home_page');   
    
    if ( empty( $post_types ) )
        $post_types = yiw_get_portfolios();          
                                                     
    $c = 1;                                    
    $cols = yiw_layout_page() == 'sidebar-no' ? 4 : 3;
    $items = yiw_get_option('portfolio_items_home_page') * 1;      
    $rows = ceil( $items % $cols );                   
    $services = new WP_Query( array(
        'post_type'      => $post_types,
        'posts_per_page' => $items
    ) );              
    
    $class = ( $cols == 3 ) ? 'one-third' : 'one-fourth';
    

    add_filter('excerpt_length', 'yiw_excerpt_length');
    add_filter( 'excerpt_more', 'yiw_excerpt_more' );
    remove_filter( 'the_excerpt', 'wpautop' );

                                                         
    while( $services->have_posts() ) : $services->the_post(); global $more; $more = 0; ?>
        <div class="home_item home_item_portfolio item_<?php the_ID() ?> <?php echo $class ?><?php if ( $c % $cols == 0 ) echo ' last' ?><?php if ( $c > $items - $cols ) echo ' last-row' ?>">
            <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'thumb_home_page', array( 'class' => 'picture' ) ) ?></a>
            <h4><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title() ?></a></h4>
            <?php the_terms( get_the_ID(), 'category-project', '<p class="categories">', ', ', '</p>' ); ?>
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
