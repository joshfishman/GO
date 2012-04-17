<?php        
/**
 * @package WordPress
 * @subpackage YIW Themes
 * @since 1.0
 */                        

get_header() ?>                        
        
		<div id="primary" class="layout-<?php echo yiw_layout_page() ?>">    
		    <div class="inner group">
                <?php if( get_post_meta( get_the_ID(), '_slogan_page', true ) ): ?>
                <div id="slogan">
                    <h2><?php echo get_post_meta( get_the_ID(), '_slogan_page', true ); ?></h2>
                    <h3><?php echo get_post_meta( get_the_ID(), '_subslogan_page', true ); ?></h3>
                </div>
                <?php endif ?>
    			
    			<?php get_template_part( 'accordion-slider' ) ?>  
    			
                <!-- START CONTENT -->
                <div id="content" class="group">
                    <?php get_template_part( 'loop', 'page' ) ?> 
                    
                    <?php comments_template() ?>
                </div>
                <!-- END CONTENT -->
                
                <!-- START SIDEBAR -->
                <?php get_sidebar() ?>
                <!-- END SIDEBAR -->    
                                  
                <!-- START EXTRA CONTENT -->
        		<?php get_template_part( 'extra-content' ) ?>      
                <!-- END EXTRA CONTENT -->
            </div>
        </div>       
        
<?php get_footer() ?>
