<?php
class sheeva_text extends WP_Widget
{
    function sheeva_text() 
    {
        $widget_ops = array( 
            'classname' => 'sheeva-text-image', 
            'description' => __( 'Arbitrary text or HTML, with a simple icon aligned to the title. (The widget is suggested to use within Sheeva Widget Area)', 'yiw' )
        );

        $control_ops = array( 'id_base' => 'sheeva-text-image', 'width' => 430 );

        $this->WP_Widget( 'sheeva-text-image', __( 'Text With Image (Title with icon)', 'yiw' ), $widget_ops, $control_ops );      
        
        wp_enqueue_style( 'thickbox' );
        wp_enqueue_script( 'thickbox' );
        wp_enqueue_script( 'media-upload' );
        add_action( 'admin_print_footer_scripts', array( &$this, 'add_script_textimage' ), 999 );
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
                
//                 var yiw_this_object = null;
//                 
//                 $('.upload-image').click(function(){
//                     yiw_this_object = $(this).prev();
//                     alert(yiw_this_object + ' + ' + $(this).prev());
//                 });
//                     
//                 window.send_to_editor = function(html) {
//                  imgurl = $('img', html).attr('src');
//                  yiw_this_object.val(imgurl);
//                  yiw_this_object = null;
//                  
//                  tb_remove();
//              }          
            });  
        </script> 
        <?php
    }
    
    function form( $instance )
    {
        global $icons_name;
        
        /* Impostazioni di default del widget */
        $defaults = array( 
            'title' => '',
            'image' => '',
            'align' => '',
            'text' => '',
            'autop' => false
        );
        
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>
        
        <p>
            <label>
                <strong><?php _e( 'Title', 'yiw' ) ?>:</strong><br />
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
            </label>
        </p>                  
        
        <p>
            <label><?php _e( 'Image', 'yiw' ) ?>:
                <input type="text" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" value="<?php echo $instance['image']; ?>" />
                <a href="media-upload.php?type=image&TB_iframe=true" class="upload-image button-secondary">Upload</a>
            </label>
        </p>

        <p>
            <label><?php _e( 'Image Position', 'yiw' ) ?>:
                <select id="<?php echo $this->get_field_id( 'align' ); ?>" name="<?php echo $this->get_field_name( 'align' ); ?>">
                    <option value="left"<?php if($instance['align']=='left'): ?>selected="selected"<?php endif ?>>Left</option>
                    <option value="right"<?php if($instance['align']=='right'): ?>selected="selected"<?php endif ?>>Right</option>
                </select>
            </label>
        </p>
 

        <p>
            <label>
                <textarea class="widefat" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>" cols="20" rows="16"><?php echo $instance['text']; ?></textarea>
            </label>
        </p>
        
        <p>
            <label>
                <input type="checkbox" id="<?php echo $this->get_field_id( 'autop' ); ?>" name="<?php echo $this->get_field_name( 'autop' ); ?>" value="1"<?php if( $instance['autop'] ) echo ' checked="checked"' ?> />
                <?php _e( 'Automatically add paragraphs', 'yiw' ) ?>
            </label>
        </p>         
        <?php
    }
    
    function widget( $args, $instance )
    {
        extract( $args );

        $title = apply_filters('widget_title', $instance['title'] );
        
        echo $before_widget;                   

        if( $title || $instance['image'] ) {
            echo $before_title;
            
            
            if( $instance['image'] && $instance['align'] == 'left' ) {
                echo "<img src='{$instance['image']}' alt='{$title}' class='sheeva-text-image-icon-{$instance['align']} sheeva-text-image-icon' />";
                if( $title ) echo $title;
            } else {
                if( $title ) echo $title;
                echo "<img src='{$instance['image']}' alt='{$title}' class='sheeva-text-image-icon-{$instance['align']} sheeva-text-image-icon' />";
            }
            
            echo $after_title;
        }
        
        if( $instance['autop'] )
            $instance['text'] = apply_filters( 'the_content', $instance['text'] );
        
        
/*
        if( isset($instance['url']) && $instance['url'] ) {
            $text = '<div class="text-image" style="text-align:'. $instance['align'] .'"><a href="' . $instance['url'] . '"><img src="' . $instance['image'] . '" alt="' . $instance['title'] . '" /></a></div>' . $instance['text'];
        }
        else {
            $text = '<div class="text-image" style="text-align:'. $instance['align'] .'"><img src="' . $instance['image'] . '" alt="' . $instance['title'] . '" /></div>' . $instance['text'];
        }

*/
    
        echo apply_filters( 'widget_text', $instance['text'] );  
        
        echo $after_widget;
    }                     

    function update( $new_instance, $old_instance ) 
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['image'] = $new_instance['image'];
        $instance['align'] = $new_instance['align'];
        $instance['text'] = $new_instance['text'];
        $instance['autop'] = $new_instance['autop'];

        return $instance;
    }
    
}     
?>
