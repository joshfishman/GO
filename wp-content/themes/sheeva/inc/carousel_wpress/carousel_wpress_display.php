<?php

class Carousel_wpress_display {
	
	static $js_flag;
	static $js_declaration;
	
	function Carousel_wpress_display() {
		add_action('wp_footer', array(__CLASS__, 'add_scripts'));
		add_action("wp_print_styles",array(__CLASS__, 'add_css'));
		
		/*
		add_action("wp_print_styles",array('Youtube_wpress', 'add_css_scripts'));
		add_action("wp_print_scripts",array('Youtube_wpress', 'add_js_scripts'));
		*/
	}
	
	function add_scripts() {
		
		if(self::$js_flag) {
			
			wp_register_script('carousel_mousewheel_js', YIW_CAROUSEL_URL.'/include/js/jquery.mousewheel.min.js', array('jquery'));
			wp_print_scripts('carousel_mousewheel_js');
			
			wp_register_script('carousel_js', YIW_CAROUSEL_URL.'/include/js/jquery.carousel-1.1.min.js', array('jquery'));
			wp_print_scripts('carousel_js');
			
			echo self::$js_declaration;
			
			echo "
			<script type='text/javascript'> 
			/* <![CDATA[ */
			var carousel_wpress = { ajaxurl: '".admin_url('admin-ajax.php')."', plugin_url: '".YIW_CAROUSEL_URL."'
			};
			/* ]]> */
			</script> 
			";
		}
	}
	
	function add_css() {
		wp_enqueue_style( 'carousel_wpress_css', YIW_CAROUSEL_URL.'include/css/carousel.css');
	}
	
	function get_carousel($criteria=array(), $options=array()) {
		$id = $criteria['id'];
		$carouselWidth = $criteria['carouselWidth'];
		$carouselHeight = $criteria['carouselHeight'];
		$frontWidth = $criteria['frontWidth'];
		$frontHeight = $criteria['frontHeight'];
		$hAlign = $criteria['hAlign'];
		$vAlign = $criteria['vAlign'];
		$speed = $criteria['speed'];
		$buttonNav = $criteria['buttonNav'];
		$directionNav = $criteria['directionNav'];
		$autoplay = $criteria['autoplay'];
		$autoplayInterval = $criteria['autoplayInterval'];
		$shadow = $criteria['shadow'];
		$reflection = $criteria['reflection'];
		$reflectionHeight = $criteria['reflectionHeight'];
		$reflectionOpacity = $criteria['reflectionOpacity'];
		$description = $criteria['description'];
		
		$display_js_declaration = isset( $options['display_js_declaration'] ) ? $options['display_js_declaration'] : true; //if 1 display...
		
		self::$js_flag = true;
		
		$d1 = new Carousel_wpress_db();
		$carousel = $d1->get_carousel_list(array('id'=>$id));
		$options = $carousel[0]['options'];
		$options = json_decode($options, true);
		
		//get values
		if($carouselWidth=='') $carouselWidth = $options['carouselWidth'];
		if($carouselHeight=='') $carouselHeight = $options['carouselHeight'];
		if($frontWidth=='') $frontWidth = $options['frontWidth'];
		if($frontHeight=='') $frontHeight = $options['frontHeight'];
		if($hAlign=='') $hAlign = $options['hAlign'];
		if($vAlign=='') $vAlign = $options['vAlign'];
		if($speed=='') $speed = $options['speed'];
		if($buttonNav=='') $buttonNav = $options['buttonNav'];
		if($directionNav=='') $directionNav = $options['directionNav'];
		if($autoplay=='') $autoplay = $options['autoplay'];
		if($autoplayInterval=='') $autoplayInterval = $options['autoplayInterval'];
		if($shadow=='') $shadow = $options['shadow'];
		if($reflection=='') $reflection = $options['reflection'];
		if($reflectionHeight=='') $reflectionHeight = $options['reflectionHeight'];
		if($reflectionOpacity=='') $reflectionOpacity = $options['reflectionOpacity'];
		if($description=='') $description = $options['description'];
		
		//set default values
		if($carouselWidth=='') $carouselWidth='1000';
		if($carouselHeight=='') $carouselHeight='300';
		if($frontWidth=='') $frontWidth='400';
		if($frontHeight=='') $frontHeight='300';
		if($hAlign=='') $hAlign='center';
		if($vAlign=='') $vAlign='center';
		if($speed=='') $speed='500';
		if($buttonNav=='') $buttonNav='bullets';
		if($directionNav=='') $directionNav='true';
		if($autoplay=='') $autoplay='false';
		if($autoplayInterval=='') $autoplayInterval='5000';
		if($shadow=='') $shadow='false';
		if($reflection=='') $reflection='false';
		if($reflectionHeight=='') $reflectionHeight='0.2';
		if($reflectionOpacity=='') $reflectionOpacity='0.5';
		if($description=='') $description='false';
		
		//$frontWidth='';
		//$frontHeight='';
		//$display = "<script type='text/javascript' src='http://yougapi.com/products/wp/wp-includes/js/jquery/jquery.js?ver=1.6.1'></script>";
		
		$display = '';
		
		self::$js_declaration = "
	    <script type='text/javascript'> 
	        jQuery(document).ready(function(){
	            jQuery('.carousel').carousel({
	            directionNav:".$directionNav.", buttonNav:'".$buttonNav."', speed:".$speed.", 
	            carouselWidth:".$carouselWidth.", carouselHeight:".$carouselHeight.",
	            frontWidth:".$frontWidth.", frontHeight:".$frontHeight.",
	            hAlign:'".$hAlign."', vAlign:'".$vAlign."',
	            autoplay:".$autoplay.", autoplayInterval:".$autoplayInterval.", shadow:".$shadow.",
	            reflection:".$reflection.", reflectionHeight:".$reflectionHeight.", reflectionOpacity:".$reflectionOpacity.",
	            description:".$description.", descriptionContainer:'.carousel_description'
	            });
	        });
	    </script>
	    ";
		
		if($display_js_declaration==1) echo self::$js_declaration;
		
		$d1 = new Carousel_wpress_db();
		$list = $d1->get_carousel_entries(array('carousel_id'=>$id));
		
		$display .= '<div style="width:'.($carouselWidth+20).'px;">';
		
			$display .= '<div class="carousel">';
			    
				/*
				if($description=='true') {
				    $display .= '<div class="carousel_description">';
				    	for($i=0; $i<count($list); $i++) {
					        $display .= '<div>';
					            $display .= '<h2>Description 1</h2>';
					            $display .= '<p>test test test</p>';
					        $display .= '</div>';
				    	}
					$display .= '</div>';
				}
				*/
				
			    $display .= '<div class="slides" style="padding:5px;">';
			 	
			    	$entry_type_tab = array('1'=>'image', '2'=>'video');
			    	
			    	for($i=0; $i<count($list); $i++) {
			    		
			    		if($list[$i]['type_id']==2) $class = 'class="video"';
			    		else $class = '';
			    		
				        $display .= '<div>'."\n";
				            if($list[$i]['url']!='') $display .= '<a '.$class.' href="'.$list[$i]['url'].'" title="'.$list[$i]['title'].'">'."\n";
				                $display .= '<img src="'.$list[$i]['image'].'" alt="'.$list[$i]['title'].'" />'."\n";
				            if($list[$i]['url']!='') $display .= '</a>'."\n";     
				        $display .= '</div>'."\n";
			    	}
			                       
			    $display .= '</div>';
			       
			$display .= '</div>';
		
		$display .= '</div>';
		
		return $display;
	}
	
}

new Carousel_wpress_display();

?>