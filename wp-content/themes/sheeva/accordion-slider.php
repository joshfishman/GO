			<?php
				global $post, $wp_query;
				
				$tmp_query = $wp_query;
				
				$accordion_slider = get_post_meta( $post->ID, '_slider_accordion', true );     
				
				if( ! empty( $accordion_slider ) && $accordion_slider != 'no' ) :
				
				$args = array( 'post_type' => strtolower( $accordion_slider ), 'posts_per_page' => -1 );
				$bl_teams = new WP_Query( $args );
				$first = TRUE;
				
				if( $bl_teams->have_posts() ) :
			?> 
    
		    <!-- START ACCORDION SLIDER -->
		    <ul class="accordion-slider">
		    
		    	<?php while( $bl_teams->have_posts() ) : $bl_teams->the_post(); ?>     
				
					<?php $width = intval( 960 - ( 154.4 * $bl_teams->post_count ) ); ?>
				
				<li class="step ListItem" id="bl_team-<?php the_ID() ?>" style="max-width:<?php echo $width + 154 ?>px">
					<div class="photo-preview title handle">
						<?php the_post_thumbnail('img-accordion-slider') ?>
						<h3><?php the_title() ?></h3>
						<h4 class="profile"><?php echo get_post_meta( $post->ID, '_slider_accordion_subtitle', true ); ?></h4>
					</div>
					<?php the_content() ?>
				</li>
				<?php $first = FALSE; endwhile ?>
				
			</ul>   
		    <!-- END ACCORDION SLIDER -->
		    
	        <script type="text/javascript">         
        		jQuery(document).ready(function($) {                                               
        			$(".accordion-slider").hrzAccordion({
        				<?php do_action( 'yiw_add_accordion_team_option' ) ?>
        				openOnLoad		   : 1,
        				handlePosition     : "left",
        				eventAction     : function(i) {
        				    alert('cufon refresh');
                            Cufon.refresh();
                        }
                    });
        		});
            </script>  
		    
			<?php 
				endif; endif;
				
				$wp_query = $tmp_query; 
				
				wp_reset_postdata();
			?>        