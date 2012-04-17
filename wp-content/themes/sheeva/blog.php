<?php       
/**
 * @package WordPress
 * @since 1.0
 */
 
/*
Template Name: Blog
*/                     

wp_enqueue_style( 'Oswald', 'http://fonts.googleapis.com/css?family=Oswald&v2' ); 

global $blog_type, $paged;
$blog_type = yiw_get_option( 'blog_type' );

get_header() ?>           
        


        <div id="primary" class="layout-<?php echo yiw_layout_page() ?>">     
		    <div class="inner group">
                <?php get_template_part('slogan') ?>
                
                <?php query_posts('cat=' . yiw_get_exclude_categories() . '&posts_per_page=' . get_option('posts_per_page') . '&paged=' . $paged) ?>
                
                <!-- START CONTENT -->
                <div id="content" class="group">
                    <?php get_template_part('loop', 'index') ?>
                </div>                       
                <!-- END CONTENT -->
                
                <!-- START LATEST NEWS -->
                <?php get_sidebar('blog') ?>
                <!-- END LATEST NEWS -->   
            
            </div>      
        </div>
        
<?php get_footer() ?>
