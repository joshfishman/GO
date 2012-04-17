<?php

class sheeva_lastpost extends WP_Widget 
{
    function sheeva_lastpost() 
    {
        $widget_ops = array( 
            'classname' => 'sheeva-lastpost', 
            'description' => __('The last post, with a small icon.', 'yiw') 
        );

        $control_ops = array( 'id_base' => 'sheeva-lastpost' );

        $this->WP_Widget( 'sheeva-lastpost', 'Sheeva Last Post', $widget_ops, $control_ops );

        wp_enqueue_style( 'thickbox' );
        wp_enqueue_script( 'thickbox' );
        wp_enqueue_script( 'media-upload' );
        add_action( 'admin_print_footer_scripts', array( &$this, 'add_script_textimage' ), 999 );        
    }
    
    function widget( $args, $instance ) 
    {
        extract( $args );
       
        echo $before_widget;
        
        $title = apply_filters('widget_title', $instance['title'] );

        echo $before_title;
        if( $instance['image'] ) {
            echo "<img src='{$instance['image']}' alt='{$title}' class='sheeva-text-image-icon-left sheeva-text-image-icon' />";
            
        }
        if( $title ) echo $title;
        echo $after_title;

       
       
        $post = new WP_Query( array( 'posts_per_page' => 1, 'orderby' => 'date', 'order' => 'DESC' ) );
        if( $post->have_posts() ) : while( $post->have_posts() ) : $post->the_post();  
            echo '<p>'. get_the_title() . '<a href="'. get_permalink() .'"> <span class="more">' . $instance['more_text'] .'</span></a></p>';
        
        endwhile; endif;

        echo $after_widget;
    }

    function update( $new_instance, $old_instance ) 
    {
        $instance = $old_instance;

        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['more_text'] = $new_instance['more_text'];
        $instance['image'] = $new_instance['image'];

        return $instance;
    }

    function form( $instance ) 
    {
        global $icons_name, $yiw_fxs, $yiw_easings;
        
        
        /* Impostazioni di default del widget */
        $defaults = array( 
            'title' => 'Blog News',
            'image' => '',
            'more_text' => ' | ' . __( 'more &rarr;', 'yiw' ),
        );
        
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'yiw' ) ?>:
                 <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
            </label>
        </p>

        <p>
            <label><?php _e( 'Image', 'yiw' ) ?>:
                <input type="text" style="width:100px;" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" value="<?php echo $instance['image']; ?>" />
                <a href="media-upload.php?type=image&TB_iframe=true" class="upload-image button-secondary">Upload</a>
            </label>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'more_text' ); ?>"><?php _e( 'More Text', 'yiw' ) ?>:
                 <input type="text" id="<?php echo $this->get_field_id( 'more_text' ); ?>" name="<?php echo $this->get_field_name( 'more_text' ); ?>" value="<?php echo $instance['more_text']; ?>" class="widefat" />
            </label>
        </p>

    
    <?php
    }

    function add_script_textimage()
    {
        ?>   
        <script type="text/javascript">                 

            jQuery(document).ready(function($){
                             
                 $('.upload-image').live('click', function(){
                    var yiw_this_object = $(this).prev();
                    
                    tb_show('', 'media-upload.php?post_id=0&type=image&TB_iframe=true');    
                
                    window.send_to_editor = function(html) {
                        imgurl = $('img', html).attr('src');
                        yiw_this_object.val(imgurl);
                        
                        tb_remove();
                    }          
                    
                    return false;
                });
                   
            });  
        </script> 
        <?php
    }
}

?>
