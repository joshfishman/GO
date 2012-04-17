<?php
class sheeva_quote extends WP_Widget
{
    function sheeva_quote() 
    {
        $widget_ops = array( 
            'classname' => 'sheeva_quote', 
            'description' => __( 'Simple quote to use in your Sheeva Widget Area', 'yiw' )
        );

        $control_ops = array( 'id_base' => 'sheeva-quote', 'width' => 430 );

        $this->WP_Widget( 'sheeva-quote', __( 'Sheeva Quote', 'yiw' ), $widget_ops, $control_ops );      
        
        wp_enqueue_style( 'thickbox' );
        wp_enqueue_script( 'thickbox' );
        wp_enqueue_script( 'media-upload' );
        //add_action( 'admin_print_footer_scripts', array( &$this, 'add_script_textimage' ), 999 );
    }
    
    function form( $instance )
    {
        global $icons_name;
        
        /* Impostazioni di default del widget */
        $defaults = array( 
            'quote' => '',
            'author' => ''
        );
        
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>
        
        <p>
            <label>
                <strong><?php _e( 'Quote', 'yiw' ) ?>:</strong><br />
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'quote' ); ?>" name="<?php echo $this->get_field_name( 'quote' ); ?>" value="<?php echo $instance['quote']; ?>" />
            </label>
        </p>                  
        
        <p>
            <label>
                <strong><?php _e( 'Author', 'yiw' ) ?>:</strong><br />
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'author' ); ?>" name="<?php echo $this->get_field_name( 'author' ); ?>" value="<?php echo $instance['author']; ?>" />
            </label>
        </p>                  


        <?php
    }
    
    function widget( $args, $instance )
    {
        extract( $args );

        echo $before_widget;                 
        echo '<h2 class="sheeva-quote-quote">' . $instance['quote'] . '</h2>';
        echo '<h3 class="sheeva-quote-author">' . $instance['author'] . '</h3>';
        
        echo $after_widget;
    }                     

    function update( $new_instance, $old_instance ) 
    {
        $instance = $old_instance;
        $instance['author'] = strip_tags( $new_instance['author'] );
        $instance['quote'] = $new_instance['quote'];

        return $instance;
    }
    
}     
?>
