<?php 
/**
 * @package WordPress
 * @subpackage Sheeva
 * @since 1.0
 */
 
$slider = yiw_get_option( 'slider_carousel_choose', 1 );
 ?>
 
<!-- START SLIDER -->
<div id="slider" class="layers-slider">
    <?php echo do_shortcode('[carousel_wpress id="'.$slider.'"]'); ?>
</div>
<!-- END SLIDER -->