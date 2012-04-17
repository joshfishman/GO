       				<?php $has_thumbnail = ( ! has_post_thumbnail() || ( ! is_single() && ! yiw_get_option( 'show_featured_blog', 1 ) ) || ( is_single() && ! yiw_get_option( 'show_featured_single', 1 ) ) ) ? false : true; ?>
                       
                    <div id="post-<?php the_ID(); ?>" <?php post_class('hentry-post group blog-' . $GLOBALS['blog_type'] ); ?>>  
                        
                        <div class="the-content">     
                        
                            <?php  
                            // title       
                            $link = get_permalink();
                            if ( is_single() )  the_title( "<h1 class=\"post-title\"><a href=\"$link\">", "</a></h1>" ); 
                            else                the_title( "<h2 class=\"post-title\"><a href=\"$link\">", "</a></h2>" ); 
                            ?>
                        
                            <div class="meta group">
                                <p class="date"><?php echo the_time( str_replace( 'F', 'M', get_option('date_format') ) ); ?></p>
                                <p class="author"><span><?php _e( 'by', 'yiw' ) ?> <?php the_author_posts_link() ?></span></p>
                                <p class="categories"><span>In: <?php the_category( ', ' ) ?></span></p>
                                <p class="list-tags"><?php the_tags( '', ', ' ) ?></p>
                            </div>
                            
                            <?php                            
                            // thumbnail
                            if ( $has_thumbnail ) the_post_thumbnail( 'blog_minimal' );
                            
                            // content
                            add_filter( 'excerpt_more', create_function( '$more', 'return "<br /><br /><a class=\"more-link\" href=\"'. get_permalink( get_the_ID() ) . '\">' . yiw_get_option('blog_read_more_text') . '</a>";' ) );
                            if ( is_category() || is_archive() || is_search() )
                                the_excerpt();
                            else
                                the_content( yiw_get_option('blog_read_more_text') ); 
                            
                            wp_link_pages();
                            
                            edit_post_link( __( 'Edit', 'yiw' ), '<p class="edit-link">', '</p>' );
                        ?></div>
                    
                    </div>         