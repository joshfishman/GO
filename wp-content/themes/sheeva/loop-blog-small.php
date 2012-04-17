       				<?php $has_thumbnail = ( ! has_post_thumbnail() || ( ! is_single() && ! yiw_get_option( 'show_featured_blog', 1 ) ) || ( is_single() && ! yiw_get_option( 'show_featured_single', 1 ) ) ) ? false : true; ?>
                       
                    <div id="post-<?php the_ID(); ?>" <?php post_class('hentry-post group blog-' . $GLOBALS['blog_type'] . ( ( ! $has_thumbnail ) ? ' without-thumbnail' : '' ) ); ?>>                
                              
                        <div class="thumbnail">
                            <?php if ( $has_thumbnail ) the_post_thumbnail( 'blog_small' ); ?>
                            
                            <p class="date">
                                <span class="month"><?php echo get_the_time('M') ?></span>
                                <span class="day"><?php echo get_the_time('d') ?></span>
                            </p>
                        </div>      
                            
                        <?php 
                            $link = get_permalink();
                            if ( is_single() )  the_title( "<h1 class=\"post-title\"><a href=\"$link\">", "</a></h1>" ); 
                            else                the_title( "<h2 class=\"post-title\"><a href=\"$link\">", "</a></h2>" ); 
                        ?>
                        
                        <div class="meta-bottom">
                            <div class="meta group">
                                <p class="author"><span><?php _e( 'by', 'yiw' ) ?> <?php the_author_posts_link() ?></span></p>
                                <p class="categories"><span>In: <?php the_category( ', ' ) ?></span></p>
                                <p class="comments"><span><?php comments_popup_link(__('No comments', 'yiw'), __('1 comment', 'yiw'), __('% comments', 'yiw')); ?></span></p>
                            </div>
                        </div>
                        <?php if ( is_single() ) : ?>
                        <div class="the-content"><?php the_content( yiw_get_option('blog_read_more_text') ) ?></div>
                        <?php wp_link_pages(); ?>
                        <?php endif; ?>
                        
						<?php edit_post_link( __( 'Edit', 'yiw' ), '<p class="edit-link">', '</p>' ); ?>
					
						<?php if( is_single() ) the_tags( '<p class="list-tags">Tags: ', ', ', '</p>' ) ?>    
                    
                    </div>         