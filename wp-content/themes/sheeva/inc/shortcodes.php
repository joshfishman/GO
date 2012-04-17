<?php
/**
 * Additional shortcodes for the theme.
 *
 * To create new shortcode, get for example the shortcode [sample] already written.
 * Replace it with your code for shortcode and for other shortcodes, duplicate the first
 * and continue following.
 *
 * CONVENTIONS:
 * - The name of function MUST be: yiw_sc_SHORTCODENAME_func.
 * - All html output of shortcode, must be passed by an hook: apply_filters( 'yiw_sc_SHORTCODENAME_html', $html ).
 * NB: SHORTCODENAME is the name of shortcode and must be written in lowercase.
 *
 * For example, we'll add new shortcode [sample], so:
 * - the function must be: yiw_sc_sample_func().
 * - the hooks to use will be: apply_filters( 'yiw_sc_sample_html', $html ).
 *
 * @package WordPress
 * @subpackage YIW Themes
 * @since 1.0
 */

/**
 * SAMPLE
 *
 * @description
 *    description of sample shortcode
 *
 * @example
 *   [sample title="" incipit="" phone="" [class=""]]
 *
 * @attr
 *   class (optional) - class of container of box call to action (optional) @default: 'call-to-action'
 *   href  - url of button
 *   title  - the title of call to action
 *   incipit - the text below title
**/
function yiw_sc_sample_func($atts, $content = null)
{
    extract(shortcode_atts(array(
        'class' => 'call-to-action',
        'title' => null,
        'incipit' => null,
        'phone' => null
    ), $atts));

    $html = ''; // this is the var to use for the html output of shortcode

    return apply_filters( 'yiw_sc_sample_html', $html );   // this must be written for each shortcode
}
add_shortcode('sample', 'yiw_sc_sample_func');



/**
 * testimonials
 *
 * @description
 *    Show all post on testimonials post types
 *
 * @example
 *   [testimonials items=""]
 *
 * @params
 *      items - number of item to show
 *
**/
function yiw_sc_testimonials_func($atts, $content = null) {
    extract(shortcode_atts(array(
        "items" => null
    ), $atts));

    wp_reset_query();

    $args = array(
        'post_type' => 'bl_testimonials'
    );

    $args['posts_per_page'] = ( !is_null( $items ) ) ? $items : -1;

    $tests = new WP_Query( $args );

    $html = '';
    if( !$tests->have_posts() ) return $html;

    //loop
    $html = '';
    $c = 0;
    while( $tests->have_posts() ) : $tests->the_post();
        $website = get_post_meta( get_the_ID(), '_testimonial_website', true );
        $label = get_post_meta( get_the_ID(), '_testimonial_label', true ) ? get_post_meta( get_the_ID(), '_testimonial_label', true ) : str_replace('http://', '', $website);
        if ( ! empty( $website ) )
            $website = "<a class=\"website\" href=\"" . esc_url( $website ) . "\">". $label  ."</a>"; ?>
    
        <div class="testimonial two-fourth<?php if ( $c % 2 != 0 ) echo ' last' ?>">
            
            <div class="thumbnail">
                <?php the_post_thumbnail('thumb_testimonial') ?>
            </div>
            
            <div class="testimonial-text">
                <?php echo yiw_content( 38 ); ?>
            </div>
            
            <div class="testimonial-name">
                <a class="name" href="<?php the_permalink() ?>"><?php the_title() ?></a>
                <?php echo $website ?>
            </div>
            
        </div>

    <?php $c++; endwhile;

    return apply_filters( 'yiw_sc_testimonials_html', $html );
}
add_shortcode("testimonials", "yiw_sc_testimonials_func");



/**
 * testimonials slider
 *
 * @description
 *    Show all post on testimonials post types
 *
 * @example
 *   [testimonials_slider items=""]
 *
 * @params
 *      items - number of item to show
 *
**/
function yiw_sc_testimonials_slider_func($atts, $content = null) {
    extract(shortcode_atts(array(
        "items" => -1,
        'speed' => 500,
        'timeout' => 7000,
        'excerpt' => 12
    ), $atts));         

    $args = array(
        'post_type' => 'bl_testimonials',
        'posts_per_page' => $items
    );

    $tests = new WP_Query( $args );  
    $count_posts = wp_count_posts('bl_testimonials');                        

    if ( $count_posts->publish == 1 )  
        $is_slider = false;
    else
        $is_slider = true;

    $html = '';
    if( !$tests->have_posts() ) return $html;
    
    ob_start(); ?>
   	    
   	    <div class="testimonials-slider">
       	    <ul class="testimonials group">
       	    
    <?php 
    //loop
    $c = 0;
    while( $tests->have_posts() ) : $tests->the_post(); 
                 
        $length = create_function( '', "return $excerpt;" );
        add_filter('excerpt_length', $length );
        add_filter('excerpt_length', $length );
        $website = get_post_meta( get_the_ID(), '_testimonial_website', true ); ?>
            
        <li>
            <blockquote><p class="special-font"><a href="<?php the_permalink() ?>">&rdquo;<?php echo get_the_excerpt() ?>&rdquo;</a></p></blockquote>
            <p class="meta"><a href="<?php the_permalink() ?>"><?php the_title( '<strong>', '</strong>' ) ?></a> - <a href="<?php echo esc_url( $website ) ?>"><?php echo $website ?></a></p>
        </li>

    <?php $c++; endwhile; ?>         
            
            </ul> 
            <?php if ( $is_slider ) : ?>
            <div class="prev"></div>
            <div class="next"></div>       
            <?php endif; ?>
        </div> <?php      
    
    if ( $is_slider ) : ?>                    
    <script type="text/javascript">
        jQuery(function($){
            $('.testimonials-slider ul').cycle({
                fx : 'scrollHorz',
                speed: <?php echo $speed ?>,
                timeout: <?php echo $timeout ?>,
                next: '.testimonials-slider .next',
                prev: '.testimonials-slider .prev'
            });
        });
    </script>	      
    <?php endif;
    
    $html = ob_get_clean();

    return apply_filters( 'yiw_sc_testimonials_slider_html', $html );
}
add_shortcode("testimonials_slider", "yiw_sc_testimonials_slider_func");


/**
 * News
 *
 * @description
 *    Show all post of news post types
 *
 * @example
 *   [news_post items="" length=""]
 *
 * @params
 *      items - number of item to show
 *
**/
function news_post_func($atts, $content = null) {
    extract(shortcode_atts(array(
        "items" => -1,
        "length" => 25
    ), $atts));

    wp_reset_query();

    $args = array(
        'post_type' => 'bl_news',
        'posts_per_page' => $items
    );

    $tests = new WP_Query( $args );

    $html = '';
    if ( !$tests->have_posts() )
        return $html;

    //loop
    $html = '';
    while ( $tests->have_posts() ) : $tests->the_post();

        $html .= '<div class="news-list group">';

        $html .= '  <div class="thumb-news group">';
        $html .= '      ' . get_the_post_thumbnail( null, 'thumb_news' );
        $html .= '  </div>';

        $html .= '  <div class="the-post group">';
        $html .= '      <h3>'. get_the_title() .'</h3>';
        $html .= '      <p class="news-date">'. get_the_date() .'</p>';
        $html .= '      ' . yiw_content( $length, ' ' . __( 'Read more', 'yiw' ) );
        $html .= '  </div>';
        $html .= '</div>';

    endwhile;

    return $html;
}
add_shortcode("news_post", "news_post_func");


/**
 * Image
 *
 * @example
 *   [image size="small" lightbox="true"]http://url.to/image.jpg[/image]
 *
 * @params
 *   size (“small”, “medium”, “large” or “fullwidth”, medium by default)
 *   link (image link – optional)
 *   target (“_blank”, “_parent”, “_self”, or “_top” – optional)
 *   lightbox (“true” or “false”, “true” by default
 *   title (lightbox caption – optional)
 *   align (“left” or “right” – optional)
 *   group (group name to make lighbox gallery)
 *   width (image width – optional)
 *   height (image height – optional)
 *   autoheight (“true” or “false” for auto height the image, false by default – optional)
 *
**/
function yiw_sc_image_func($atts, $content = null) {
    extract(shortcode_atts(array(
        'size' => 'medium',
        'link' => '',
        'target' => '',
        'lightbox' => 'true',
        'title' => '',
        'align' => 'left',
        'group' => '',
        'width' => '',
        'height' => '',
        'autoheight' => 'false'
    ), $atts));
    
    if ( $size == 'small' ) $size = 'thumbnail';
    
    $a_attrs = $img_attrs = $div_attrs = array();
    
    $div_attrs['class'][] = "img_frame img_size_$size";
    
    if ( $lightbox == 'true' || $lightbox == 'false' && ! empty( $link ) )
        $is_link = true;
    else
        $is_link = false;
    
    if ( ! empty( $link ) )
        $a_attrs['href'] = $link;
    else {
        $image_id = yiw_get_attachment_id($content);        
        if ( $image_id != 0 ) {
            list( $image_url, $image_width, $image_height ) = wp_get_attachment_image_src( $image_id, $size );      
            if ( empty( $width ) )  $width = $image_width;
            if ( empty( $height ) ) $height = $image_height;
            $img_attrs['src'] = $image_url;
            $a_attrs['href'] = $content;
        } else {                                   
            $img_attrs['src'] = $a_attrs['href'] = $content;
        }
    }
    
    if ( ! empty( $target ) )
        $a_attrs['target'] = $target;
    
    if ( ! empty( $lightbox ) && $lightbox == 'true' ) {
        $a_attrs['class'][] = 'thumb img';
        $a_attrs['rel'] = 'prettyphoto';
        if ( ! empty( $group ) )
            $a_attrs['rel'] .= "[$group]";   
    }
    
    if ( ! empty( $title ) )
        $img_attrs['title'] = $a_attrs['title'] = $title;
    
    if ( ! empty( $align ) )
        $div_attrs['class'][] = "align$align";
        
    if ( ! empty( $width ) ) {
        $div_attrs['style'][] = "width:{$width}px;";
        $img_attrs['width'] = $width;
    }
        
    if ( ! empty( $height ) && $autoheight == 'false' ) {
        $div_attrs['style'][] = "height:{$height}px;";
        $img_attrs['height'] = $height;
    } else if ( $autoheight == 'true' ) {
        $div_attrs['style'] = "height:auto;";
    }
              
    $attrs = array();
    foreach ( $div_attrs as $attr => $value ) {
        if ( is_array( $value ) )    
            $attrs[] = "$attr=\"" . implode( ' ', $value ) . "\"";
        else
            $attrs[] = "$attr=\"$value\"";
    }
    $div_attrs = implode( ' ', $attrs );
              
    $attrs = array();
    foreach ( $img_attrs as $attr => $value ) {
        if ( is_array( $value ) )    
            $attrs[] = "$attr=\"" . implode( ' ', $value ) . "\"";
        else
            $attrs[] = "$attr=\"$value\"";
    }
    $img_attrs = implode( ' ', $attrs );
              
    $attrs = array();
    foreach ( $a_attrs as $attr => $value ) {
        if ( is_array( $value ) )    
            $attrs[] = "$attr=\"" . implode( ' ', $value ) . "\"";
        else
            $attrs[] = "$attr=\"$value\"";
    }
    $a_attrs = implode( ' ', $attrs );

    ob_start(); ?>
    
    <div class="image-styled">
        <div <?php echo $div_attrs ?>>
            <?php if ( $is_link ) : ?><a <?php echo $a_attrs ?>><?php endif ?>
                <img <?php echo $img_attrs ?> />
            <?php if ( $is_link ) : ?></a><?php endif ?>
        </div>
    </div>
    
    <?php $html = ob_get_clean();

    return apply_filters( 'yiw_sc_image_html', $html );
}
add_shortcode("image", "yiw_sc_image_func");



?>