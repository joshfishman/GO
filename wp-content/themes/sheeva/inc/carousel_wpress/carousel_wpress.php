<?php
/*
Plugin Name: Carousel Evolution for WordPress
Plugin URI: http://yougapi.com/products/wp/jquery-carousel-evolution/
Description: Integrate an Awesome Carousel into your WordPress pages
Version: 1.1
Author: Yougapi Technology LLC
Author URI: http://yougapi.com
*/

define( 'YIW_CAROUSEL_URL', get_template_directory_uri() . '/inc/carousel_wpress/' );

require_once dirname( __FILE__ ).'/carousel_wpress_db.php';          
require_once dirname( __FILE__ ).'/carousel_wpress_display.php';                 

class Carousel_wpress {
	
	function Carousel_wpress() {
        $this->on_plugin_activation();
            
		if(is_admin()) {
			require_once dirname( __FILE__ ).'/carousel_wpress_admin.php';
			//AJAX
			add_action( 'wp_ajax_nopriv_carousel_wpress_listener', array(__CLASS__, 'carousel_wpress_listener') );
			add_action( 'wp_ajax_carousel_wpress_listener', array(__CLASS__, 'carousel_wpress_listener') );
		}
		
		add_filter('the_posts', array(__CLASS__, 'add_css'));
		
		//shortcodes
		add_shortcode( 'carousel_wpress', array(__CLASS__, 'display_carousel') );
	}
	
	function add_css($posts){
		if (empty($posts)) return $posts;
		return $posts;
	}
	
	//display through a shortcode
	function display_carousel($atts, $content = null, $code) {
		extract(shortcode_atts(array(
		'id' => '',
		'carousel_width' => '',
		'carousel_height' => '',
		'front_width' => '',
		'front_height' => '',
		'h_align' => '',
		'v_align' => '',
		'speed' => '',
		'button_nav' => '',
		'direction_nav' => '',
		'autoplay' => '',
		'autoplay_interval' => '',
		'shadow' => '',
		'reflection' => '',
		'reflection_height' => '',
		'reflection_opacity' => '',
		'description' => ''
		), $atts));
		
		$criteria['id'] = $id;
		$criteria['carouselWidth'] = $carousel_width;
		$criteria['carouselHeight'] = $carousel_height;
		$criteria['frontWidth'] = $front_width;
		$criteria['frontHeight'] = $front_height;
		$criteria['hAlign'] = $h_align;
		$criteria['vAlign'] = $v_align;
		$criteria['speed'] = $speed;
		$criteria['buttonNav'] = $button_nav;
		$criteria['directionNav'] = $direction_nav;
		$criteria['autoplay'] = $autoplay;
		$criteria['autoplayInterval'] = $autoplay_interval;
		$criteria['shadow'] = $shadow;
		$criteria['reflection'] = $reflection;
		$criteria['reflectionHeight'] = $reflection_height;
		$criteria['reflectionOpacity'] = $reflection_opacity;
		$criteria['description'] = $description;
		
		$d1 = new Carousel_wpress_display();
		$carousel = $d1->get_carousel($criteria);
		
		return '<p>'.$carousel.'</p>';
	}
	
	//AJAX calls
	function carousel_wpress_listener() {
		
		$method = $_POST['method'];
		
		if($method=='save_carousel') {
			$name = $_POST['name'];
			$db1 = new Carousel_wpress_db();
			$id = $db1->add_carousel(array('name'=>$name));
			echo $id;
		}
		
		else if($method=='edit_carousel') {
			$id = $_POST['carousel_id'];
			$name = $_POST['carousel_name'];
			
			$options['carouselWidth'] = $_POST['carouselWidth'];
			$options['carouselHeight'] = $_POST['carouselHeight'];
			$options['frontWidth'] = $_POST['frontWidth'];
			$options['frontHeight'] = $_POST['frontHeight'];
			$options['hAlign'] = $_POST['hAlign'];
			$options['vAlign'] = $_POST['vAlign'];
			$options['speed'] = $_POST['speed'];
			$options['buttonNav'] = $_POST['buttonNav'];
			$options['directionNav'] = $_POST['directionNav'];
			$options['autoplay'] = $_POST['autoplay'];
			$options['autoplayInterval'] = $_POST['autoplayInterval'];
			$options['shadow'] = $_POST['shadow'];
			$options['reflection'] = $_POST['reflection'];
			$options['reflectionHeight'] = $_POST['reflectionHeight'];
			$options['reflectionOpacity'] = $_POST['reflectionOpacity'];
			$options['description'] = $_POST['description'];
			
			$options = json_encode($options);
			
			$db1 = new Carousel_wpress_db();
			$db1->edit_carousel(array('id'=>$id, 'name'=>$name, 'options'=>$options));
		}
		
		else if($method=='delete_carousel') {
			$id = $_POST['id'];
			$db1 = new Carousel_wpress_db();
			$db1->delete_carousel($id);
		}
		
		else if($method=='add_entry') {
			$carousel_id = $_POST['carousel_wpress_id'];
			$type_id = $_POST['entry_type_id'];
			$title = $_POST['entry_title'];
			$url = $_POST['entry_url'];
			$image = $_POST['entry_image'];
			$description = $_POST['entry_description'];
			
			$db1 = new Carousel_wpress_db();
			$id = $db1->add_carousel_entry(array('carousel_id'=>$carousel_id, 'type_id'=>$type_id, 'title'=>$title, 'url'=>$url, 'image'=>$image, 'description'=>$description));
			echo $id;
		}
		
		else if($method=='edit_entry') {
			$id = $_POST['entry_id'];
			$type_id = $_POST['entry_type_id'];
			$title = $_POST['entry_title'];
			$url = $_POST['entry_url'];
			$image = $_POST['entry_image'];
			$description = $_POST['entry_description'];
			
			$db1 = new Carousel_wpress_db();
			$db1->edit_carousel_entry(array('id'=>$id, 'type_id'=>$type_id, 'title'=>$title, 'url'=>$url, 'image'=>$image, 'description'=>$description));
		}
		
		else if($method=='delete_entry') {
			$id = $_POST['entry_id'];
			
			$db1 = new Carousel_wpress_db();
			$db1->delete_carousel_entry(array('id'=>$id));
		}
		
		exit;
	}
	
	function on_plugin_activation() {
	    if ( get_option( 'yiw_carousel_tables_created' ) )
	       return false;
		$db1 = new Carousel_wpress_db();
		$db1->create_carousel_tables(); 
		add_option( 'yiw_carousel_tables_created', true );
		return true;
	}
	
}

new Carousel_wpress();   

?>