<?php
/**
 * All hooks for the theme.
 *
 * @package WordPress
 * @subpackage YIW Themes
 * @since 1.0
 */          


//
add_filter( 'yiw_slide_title', 'yiw_slide_convert_title' );
function yiw_slide_convert_title( $args = false ) {
    if( is_array($args) ) {
        $color = $args[1] != '' ? 'style="color:' . $args[1]. '"' : '';
        return str_replace('[', "<span {$color}>", str_replace(']', '</span>', str_replace('|', '<br />', $args[0])));
    } elseif( is_string($args) ) {
        return str_replace('[', '<span>', str_replace(']', '</span>', str_replace('|', '<br />', $args)));
    }
}


?>