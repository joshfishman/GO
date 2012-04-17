<?php

class Carousel_wpress_admin {	
	
	function Carousel_wpress_admin() {
	
       add_action( 'admin_menu', array(__CLASS__, 'config_page_init') );  
    		
	   if(strstr($_SERVER['REQUEST_URI'], 'carousel-wpress')) {
    		add_action('admin_print_scripts', array(__CLASS__, 'config_page_scripts'));
    		
    		add_action('admin_enqueue_scripts', array(&$this, 'init_scripts'));	
    		add_action('admin_init', array(&$this, 'init_styles'));
    	}
		
	}
	
	function init_styles() {
        wp_enqueue_style( 'carousel_wpress_css', YIW_CAROUSEL_URL.'include/css/carousel.css');
    }
	
	function init_scripts() {                                                                                       
		wp_enqueue_script('carousel_mousewheel_js', YIW_CAROUSEL_URL.'include/js/jquery.mousewheel.min.js', array('jquery')); 
		wp_enqueue_script('carousel_js', YIW_CAROUSEL_URL.'include/js/jquery.carousel-1.1.min.js', array('jquery'));
		wp_enqueue_script('carousel_wpress_js', YIW_CAROUSEL_URL.'include/js/script.js');    
    }
	
	function config_page_scripts() {
		
		echo "
		<script type='text/javascript'> 
		/* <![CDATA[ */
		var Carousel_wpress = { 
		ajaxurl: '".admin_url('admin-ajax.php')."', admin_url: '".admin_url()."'
		};
		/* ]]> */
		</script> 
		";
	}
	
	function config_page_init() {
		add_theme_page( 'Carousel WPress', 'Carousel WPress', 'edit_theme_options', 'carousel-wpress', array(__CLASS__, 'display_admin_page') );
	}
	
	function display_admin_page() {             
	    if ( !( basename($_SERVER['PHP_SELF']) == 'themes.php' && isset( $_GET['page'] ) && $_GET['page'] == 'carousel-wpress' ) )
	       return;
	   
        $mode = isset( $_GET['mode'] ) ? $_GET['mode'] : 'index';
        
        switch ( $mode ) {
            
            case 'index'        : Carousel_wpress_admin::display_carousel_list(); break;
            case 'add'          : Carousel_wpress_admin::carousel_add();          break;
            case 'edit-entries' : Carousel_wpress_admin::carousel_edit_entries(); break;
            case 'edit'         : Carousel_wpress_admin::carousel_edit();         break;
            case 'view'         : Carousel_wpress_admin::carousel_display();      break;
            case 'add-entry'    : Carousel_wpress_admin::carousel_add_entry();    break;
            
        }
    }
	
	//display Carousels list
	function display_carousel_list() {
		?>
		
		<div class="wrap">
		<div class="metabox-holder">
		<br>
		
		<?php
		$db1 = new Carousel_wpress_db();
		$tables = $db1->get_carousel_list();
		
		$entries = $db1->get_nb_entries_per_carousel();
		for($i=0; $i<count($entries); $i++) {
			$entries_tab[$entries[$i]['id']] = $entries[$i]['nb'];
		}
		
		echo '<h1>Carousels list<font size="-1">';
		if(count($tables)>0) echo ' ( <a href="'.admin_url('themes.php?page=carousel-wpress').'&mode=add">Add a Carousel</a> )</font>';
		echo '</h1>';
		echo '<hr style="background:#ddd;color:#ddd;height:1px;border:none;">';
		
		for($i=0; $i<count($tables); $i++) {
			$id = $tables[$i]['id'];
			$name = $tables[$i]['name'];
			
			if(! isset($entries_tab[$id]) || isset($entries_tab[$id]) && $entries_tab[$id]=='') $entries_tab[$id]=0;
			
			echo '<table style="border-bottom: 1px solid #e7e7e7; width:100%;"><tr>';
			
			echo '<td><h2>'.$tables[$i]['name'];
			if($entries_tab[$id]>1) echo ' <font size="-1">('.$entries_tab[$id].' entries)</font>';
			else echo ' <font size="-1">('.$entries_tab[$id].' entry)</font>';
			echo '</h2></td>';
			
			echo '<td align="right">';
			echo '
			<a href="'.admin_url('themes.php?page=carousel-wpress').'&mode=view&id='.$id.'">Preview</a> - 
			<a href="'.admin_url('themes.php?page=carousel-wpress').'&mode=edit&id='.$id.'">Edit Carousel</a> - 
			<a href="'.admin_url('themes.php?page=carousel-wpress').'&mode=edit-entries&carousel_id='.$id.'">Edit entries</a> <small>('.$entries_tab[$id].')</small> - 
			<a href="#" id="'.$id.'" class="carousel_wpress_delete_btn" style="color:red;">Delete</a>';
			echo '</td>';
			
			echo '</tr></table>';
		}
		
		if(count($tables)==0) echo '<br>You don\'t have any Carousel yet: <a href="'.admin_url('themes.php?page=carousel-wpress').'&mode=add">Add a new Carousel</a>';
		
		?>
		</div></div>
		<?php
	}
	
	function carousel_add_entry() {
		?>
		
		<div class="wrap">
		<div class="metabox-holder">
		<br>
		
		<?php
		
		$entry_type_tab = array('1'=>'image', '2'=>'video');
		
		echo '<h1>Add a Carousel entry <font size="-1">( <a href="'.admin_url('themes.php?page=carousel-wpress').'">Back to the list</a> )</font></h1>';
		echo '<hr style="background:#ddd;color:#ddd;height:1px;border:none;">';
		
		echo '<form method="post" id="carousel_wpress_entry_form" name="carousel_wpress_entry_form">';
			
			echo '<input type="hidden" id="carousel_wpress_id" name="carousel_wpress_id" value="'.$_GET['id'].'">';
			
			echo '<p><label><b>Type</b></label></p>';
			echo '<p><select id="entry_type_id" name="entry_type_id" style="width:440px;">';
			foreach($entry_type_tab as $ind=>$value) {
				if($entry_type==$ind) echo '<option selected value="'.$ind.'">'.$value.'</option>';
				else echo '<option value="'.$ind.'">'.$value.'</option>';
			}
			echo '</select></p>';
			
			echo '<p><label><b>Title</b></label></p>';
			echo '<p><input class="widefat" type="text" id="entry_title" name="entry_title" style="width:540px;"></p>';
			
			echo '<p><label><b>Url</b></label></p>';
			echo '<p><input class="widefat" type="text" id="entry_url" name="entry_url" style="width:540px;"></p>';
			
			echo '<p><label><b>Image URL</b></label></p>';
			echo '<p><input class="widefat" type="text" id="entry_image" name="entry_image" style="width:540px;"></p>';
			
			/*
			echo '<p><label><b>Description</b></label></p>';
			echo '<p><textarea class="widefat" id="entry_description" name="entry_description" style="width:540px; height:120px;"></textarea></p>';
			*/
			
			echo '<p class="submit" style="padding-bottom:0px; padding-top:0px;">';
			echo '<input class="button-primary" type="submit" id="carousel_wpress_entry_add_btn" value="Add">';
			echo '</p>';
			
		echo '</form>';
		
		?>
		</div></div>
		<?php
	}
	
	function carousel_edit() {
		?>
		
		<div class="wrap">
		<div class="metabox-holder">
		<br>
		
		<?php
		
		$id = $_GET['id'];
		
		$db1 = new Carousel_wpress_db();
		$item = $db1->get_carousel_list(array('id'=>$id));
		
		$options = $item[0]['options'];
		$options = json_decode($options, true);
		
		//get values
		$carouselWidth = $options['carouselWidth'];
		$carouselHeight = $options['carouselHeight'];
		$frontWidth = $options['frontWidth'];
		$frontHeight = $options['frontHeight'];
		$hAlign = $options['hAlign'];
		$vAlign = $options['vAlign'];
		$speed = $options['speed'];
		$buttonNav = $options['buttonNav'];
		$directionNav = $options['directionNav'];
		$autoplay = $options['autoplay'];
		$autoplayInterval = $options['autoplayInterval'];
		$shadow = $options['shadow'];
		$reflection = $options['reflection'];
		$reflectionHeight = $options['reflectionHeight'];
		$reflectionOpacity = $options['reflectionOpacity'];
		$description = $options['description'];
		
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
		
		$hAlign_tab = array('left', 'right', 'center');
		$vAlign_tab = array('top', 'bottom', 'center');
		$buttonNav_tab = array('numbers', 'bullets', 'none');
		$true_false_tab = array('true', 'false');
		
		echo '<h1>Edit Carousel <font size="-1">( <a href="'.admin_url('themes.php?page=carousel-wpress').'&mode=edit-entries&carousel_id='.$id.'">Edit entries</a>
		- <a href="'.admin_url('themes.php?page=carousel-wpress').'">Back to the list</a> 
		)</font></h1>';
		echo '<hr style="background:#ddd;color:#ddd;height:1px;border:none;">';
		
		if(count($item)>0) {
		
			echo '<form method="post" id="carousel_form" name="carousel_form">';
				
				echo '<input type="hidden" id="carousel_id" name="carousel_id" value="'.$id.'">';
				
				echo '<table><tr>';
				
				echo '<td valign="top" style="padding-right:50px;">';
					
					echo '<h2><b>General settings</b></h2>';
					
					echo '<p><label><b>Name:</b></label></p>';
					echo '<p><input class="widefat" type="text" id="carousel_name" name="carousel_name" style="width:440px;" value="'.$item[0]['name'].'"></p>';
					
					echo '<p><label><b>Carousel width:</b> <small>(default: 1000)</small></label></p>';
					echo '<p><input class="widefat" type="text" id="carouselWidth" name="carouselWidth" style="width:440px;" value="'.$carouselWidth.'"></p>';
					
					echo '<p><label><b>Carousel height:</b> <small>(default: 300)</small></label></p>';
					echo '<p><input class="widefat" type="text" id="carouselHeight" name="carouselHeight" style="width:440px;" value="'.$carouselHeight.'"></p>';
					
					echo '<p><label><b>Front image width:</b> <small>(default: 400)</small></label></p>';
					echo '<p><input class="widefat" type="text" id="frontWidth" name="frontWidth" style="width:440px;" value="'.$frontWidth.'"></p>';
					
					echo '<p><label><b>Front image height:</b> <small>(default: 300)</small></label></p>';
					echo '<p><input class="widefat" type="text" id="frontHeight" name="frontHeight" style="width:440px;" value="'.$frontHeight.'"></p>';
					
					echo '<p><label><b>Horizontal alignement of the front image:</b></label></p>';
					echo '<p><select id="hAlign" name="hAlign">';
					foreach($hAlign_tab as $ind) {
						if($ind==$hAlign) echo '<option selected value="'.$ind.'">'.$ind.'</option>';
						else echo '<option value="'.$ind.'">'.$ind.'</option>';
					}
					echo '</select></p>';
					
					echo '<p><label><b>Vertical alignement of the front image:</b></label></p>';
					echo '<p><select id="vAlign" name="vAlign">';
					foreach($vAlign_tab as $ind) {
						if($ind==$vAlign) echo '<option selected value="'.$ind.'">'.$ind.'</option>';
						else echo '<option value="'.$ind.'">'.$ind.'</option>';
					}
					echo '</select></p>';
					
					/*
					echo '<p><label><b>Description:</b> <small>(default: false)</small></label></p>';
					echo '<p><select id="description" name="description">';
					foreach($true_false_tab as $ind) {
						if($ind==$description) echo '<option selected value="'.$ind.'">'.$ind.'</option>';
						else echo '<option value="'.$ind.'">'.$ind.'</option>';
					}
					echo '</select></p>';
					*/
					
				echo '</td>';
				
				echo '<td valign="top">';
					
					echo '<h2><b>Slider settings</b></h2>';
					
					echo '<p><label><b>Movements speed:</b> <small>(default: 500)</small></label></p>';
					echo '<p><input class="widefat" type="text" id="speed" name="speed" style="width:440px;" value="'.$speed.'"></p>';
					
					echo '<p><label><b>Type of navigation buttons:</b> <small>(default: bullets)</small></label></p>';
					echo '<p><select id="buttonNav" name="buttonNav">';
					foreach($buttonNav_tab as $ind) {
						if($ind==$buttonNav) echo '<option selected value="'.$ind.'">'.$ind.'</option>';
						else echo '<option value="'.$ind.'">'.$ind.'</option>';
					}
					echo '</select></p>';
					
					echo '<p><label><b>Enable or disable the Next and Previous buttons:</b> <small>(default: true)</small></label></p>';
					echo '<p><select id="directionNav" name="directionNav">';
					foreach($true_false_tab as $ind) {
						if($ind==$directionNav) echo '<option selected value="'.$ind.'">'.$ind.'</option>';
						else echo '<option value="'.$ind.'">'.$ind.'</option>';
					}
					echo '</select></p>';
					
					echo '<p><label><b>Autoplay slides:</b> <small>(default: false)</small></label></p>';
					echo '<p><select id="autoplay" name="autoplay">';
					foreach($true_false_tab as $ind) {
						if($ind==$autoplay) echo '<option selected value="'.$ind.'">'.$ind.'</option>';
						else echo '<option value="'.$ind.'">'.$ind.'</option>';
					}
					echo '</select></p>';
					
					echo '<p><label><b>Autoplay interval in milliseconds:</b> <small>(default: 5000)</small></label></p>';
					echo '<p><input class="widefat" type="text" id="autoplayInterval" name="autoplayInterval" style="width:440px;" value="'.$autoplayInterval.'"></p>';
					
					echo '<h2><b>Images effects</b></h2>';
					
					echo '<p><label><b>Shadow:</b> <small>(default: false)</small></label></p>';
					echo '<p><select id="shadow" name="shadow">';
					foreach($true_false_tab as $ind) {
						if($ind==$shadow) echo '<option selected value="'.$ind.'">'.$ind.'</option>';
						else echo '<option value="'.$ind.'">'.$ind.'</option>';
					}
					echo '</select></p>';
					
					echo '<p><label><b>Reflection:</b> <small>(default: false)</small></label></p>';
					echo '<p><select id="reflection" name="reflection">';
					foreach($true_false_tab as $ind) {
						if($ind==$reflection) echo '<option selected value="'.$ind.'">'.$ind.'</option>';
						else echo '<option value="'.$ind.'">'.$ind.'</option>';
					}
					echo '</select></p>';
					
					echo '<p><label><b>Reflection Height:</b> <small>(default: 0.2)</small></label></p>';
					echo '<p><input class="widefat" type="text" id="reflectionHeight" name="reflectionHeight" style="width:440px;" value="'.$reflectionHeight.'"></p>';
					
					echo '<p><label><b>Reflection Opacity:</b> <small>(default: 0.5)</small></label></p>';
					echo '<p><input class="widefat" type="text" id="reflectionOpacity" name="reflectionOpacity" style="width:440px;" value="'.$reflectionOpacity.'"></p>';
				
				echo '</td>';
				echo '</tr></table>';
				
				echo '<p class="submit" style="padding-bottom:0px; padding-top:0px;">';
				echo '<input class="button-primary" type="submit" id="carousel_wpress_edit_btn" value="Save changes"> - <a href="'.admin_url('themes.php?page=carousel-wpress').'">Cancel</a>';
				echo '</p>';
				
			echo '</form>';
		}
		
		?>
		</div></div>
		<?php
	}
	
	function carousel_add() {
		?>
		
		<div class="wrap">
		<div class="metabox-holder">
		<br>
		
		<?php
		
		echo '<h1>Create a Carousel <font size="-1">( <a href="'.admin_url('themes.php?page=carousel-wpress').'">Back to the list</a> )</font></h1>';
		echo '<hr style="background:#ddd;color:#ddd;height:1px;border:none;">';
		
		echo '<form method="post">';
			
			echo '<p><label><b>Name</b></label></p>';
			echo '<p><input class="widefat" type="text" id="carousel_name" style="width:440px;"></p>';
			
			echo '<p class="submit" style="padding-bottom:0px; padding-top:0px;">';
			echo '<input class="button-primary" type="submit" id="carousel_wpress_add_btn" value="Save and Continue"> - <a href="'.admin_url('themes.php?page=carousel-wpress').'">Cancel</a>';
			echo '</p>';
			
		echo '</form>';
		
		?>
		</div></div>
		<?php
	}
	
	function carousel_edit_entries() {
		?>
		
		<div class="wrap">
		<div class="metabox-holder">
		<br>
		
		<?php
		
		$carousel_id = $_GET['carousel_id'];
		$id = isset( $_GET['id'] ) ? $_GET['id'] : 0;
		
		$entry_type_tab = array('1'=>'image', '2'=>'video');
		
		echo '<h1>Edit a Carousel entries <font size="-1">( <a href="'.admin_url('themes.php?page=carousel-wpress').'&mode=add-entry&id='.$carousel_id.'">Add a new entry</a>
		- <a href="'.admin_url('themes.php?page=carousel-wpress').'&mode=edit&id='.$carousel_id.'">Edit Carousel</a>
		- <a href="'.admin_url('themes.php?page=carousel-wpress').'">Back to the list</a> )</font></h1>';
		echo '<hr style="background:#ddd;color:#ddd;height:1px;border:none;">';
		
		$db1 = new Carousel_wpress_db();
		$item = $db1->get_carousel_list(array('id'=>$carousel_id));
		
		if(count($item)>0) {
			
			echo '<h2>Name: '.$item[0]['name'].'</h2><br>';
			
			$entries = $db1->get_carousel_entries(array('carousel_id'=>$carousel_id, 'id'=>$id));
			
			if(count($entries)>0) {
				
				if($id=='') {
					
					echo '<p><b>Please select the entry to edit:</b></p>';
					
					for($i=0; $i<count($entries); $i++) {
						$entry_id = $entries[$i]['id'];
						if($entries[$i]['image']!='') $image = '<img src="'.$entries[$i]['image'].'" style="max-width:120px; max-height:120px; padding-right:10px; border:0px;">';
						else $image = '<span style="padding-right:10px;">Entry without image</span>';
						echo '<a href="'.admin_url('themes.php?page=carousel-wpress').'&mode=edit-entries&carousel_id='.$carousel_id.'&id='.$entry_id.'">'.$image.'</a>';
					}
				}
				
				else {
					
					$image = '<img src="'.$entries[0]['image'].'" style="max-width:120px; max-height:120px; padding-right:10px; border:0px;">';
					
					echo '<form method="post" id="carousel_wpress_entry_form" name="carousel_wpress_entry_form">';
						
						echo '<input type="hidden" id="carousel_id" name="carousel_id" value="'.$carousel_id.'">';
						echo '<input type="hidden" id="entry_id" name="entry_id" value="'.$_GET['id'].'">';
						
						echo $image;
						
						echo '<p><label><b>Type</b></label></p>';
						echo '<p><select id="entry_type_id" name="entry_type_id" style="width:440px;">';
						foreach($entry_type_tab as $ind=>$value) {
							if($entries[0]['type_id']==$ind) echo '<option selected value="'.$ind.'">'.$value.'</option>';
							else echo '<option value="'.$ind.'">'.$value.'</option>';
						}
						echo '</select></p>';
						
						echo '<p><label><b>Title</b></label></p>';
						echo '<p><input class="widefat" type="text" id="entry_title" name="entry_title" value="'.$entries[0]['title'].'" style="width:540px;"></p>';
						
						echo '<p><label><b>Url</b></label></p>';
						echo '<p><input class="widefat" type="text" id="entry_url" name="entry_url" value="'.$entries[0]['url'].'" style="width:540px;"></p>';
						
						echo '<p><label><b>Image URL</b></label></p>';
						echo '<p><input class="widefat" type="text" id="entry_image" name="entry_image" value="'.$entries[0]['image'].'" style="width:540px;"></p>';
						
						/*
						echo '<p><label><b>Description</b></label></p>';
						echo '<p><textarea class="widefat" id="entry_description" name="entry_description" style="width:540px; height:120px;">'.$entries[0]['description'].'</textarea></p>';
						*/
						
						echo '<p class="submit" style="padding-bottom:0px; padding-top:0px;">';
						echo '<input class="button-primary" type="submit" id="carousel_wpress_entry_edit_btn" value="Edit"> 
						- <a href="'.admin_url('themes.php?page=carousel-wpress').'&mode=edit-entries&carousel_id='.$carousel_id.'">Cancel</a>
						- <a href="#" id="'.$entries[0]['id'].'" class="carousel_wpress_delete_entry_btn" style="color:red;">Delete this entry</a>';
						echo '</p>';
						
					echo '</form>';
					
				}
				
			}
			else {
				echo 'No entries found for this Carousel: <a href="'.admin_url('themes.php?page=carousel-wpress').'&mode=add-entry&id='.$carousel_id.'">Add a new entry</a>';
			}
			
		}
		else {
			echo '<p>No Carousel found with the given id.</p>';
			echo '<a href="'.admin_url('themes.php?page=carousel-wpress').'">Back to list</a>';
		}
		
		?>
		</div></div>
		<?php
	}
	
	function carousel_display() {
		
		$carouselWidth     = isset( $_GET['carouselWidth'] )      ? $_GET['carouselWidth']    : null;
		$carouselHeight    = isset( $_GET['carouselHeight'] )     ? $_GET['carouselHeight']   : null;
		$frontWidth        = isset( $_GET['frontWidth'] )         ? $_GET['frontWidth']       : null;
		$frontHeight       = isset( $_GET['frontHeight'] )        ? $_GET['frontHeight']      : null;
		$hAlign            = isset( $_GET['hAlign'] )             ? $_GET['hAlign']           : null;
		$vAlign            = isset( $_GET['vAlign'] )             ? $_GET['vAlign']           : null;
		$speed             = isset( $_GET['speed'] )              ? $_GET['speed']            : null;
		$buttonNav         = isset( $_GET['buttonNav'] )          ? $_GET['buttonNav']        : null;
		$directionNav      = isset( $_GET['directionNav'] )       ? $_GET['directionNav']     : null;
		$autoplay          = isset( $_GET['autoplay'] )           ? $_GET['autoplay']         : null;
		$autoplayInterval  = isset( $_GET['autoplayInterval'] )   ? $_GET['autoplayInterval'] : null;
		$shadow            = isset( $_GET['shadow'] )             ? $_GET['shadow']           : null;
		$reflection        = isset( $_GET['reflection'] )         ? $_GET['reflection']       : null;
		$reflectionHeight  = isset( $_GET['reflectionHeight'] )   ? $_GET['reflectionHeight'] : null;
		$reflectionOpacity = isset( $_GET['reflectionOpacity'] )  ? $_GET['reflectionOpacity']: null;
		$description       = isset( $_GET['description'] )        ? $_GET['description']      : null;
		
		?>
		
		<div class="wrap">
		<div class="metabox-holder">
		<br>
		
		<?php
		
		$id = $_GET['id'];
		
		$db1 = new Carousel_wpress_db();
		$item = $db1->get_carousel_list(array('id'=>$id));
		
		$options = $item[0]['options'];
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
		
		$url_param = '';
		if($carouselWidth!='') $url_param .= ' carousel_width="'.$carouselWidth.'" ';
		if($carouselHeight!='') $url_param .= ' carousel_height="'.$carouselHeight.'" ';
		if($frontWidth!='') $url_param .= ' front_width="'.$frontWidth.'" ';
		if($frontHeight!='') $url_param .= ' front_height="'.$frontHeight.'" ';
		if($hAlign!='') $url_param .= ' h_align="'.$hAlign.'" ';
		if($vAlign!='') $url_param .= ' v_align="'.$vAlign.'" ';
		if($speed!='') $url_param .= ' speed="'.$speed.'" ';
		if($buttonNav!='') $url_param .= ' button_nav="'.$buttonNav.'" ';
		if($directionNav!='') $url_param .= ' direction_nav="'.$directionNav.'" ';
		if($autoplay!='') $url_param .= ' autoplay="'.$autoplay.'" ';
		if($autoplayInterval!='') $url_param .= ' autoplay_interval="'.$autoplayInterval.'" ';
		if($shadow!='') $url_param .= ' shadow="'.$shadow.'" ';
		if($reflection!='') $url_param .= ' reflection="'.$reflection.'" ';
		if($reflectionHeight!='') $url_param .= ' reflection_height="'.$reflectionHeight.'" ';
		if($reflectionOpacity!='') $url_param .= ' reflection_opacity="'.$reflectionOpacity.'" ';
		if($reflectionOpacity!='') $url_param .= ' reflection_opacity="'.$reflectionOpacity.'" ';
		if($description!='') $url_param .= ' description="'.$description.'"';
		
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
		
		echo '<h1>Carousel preview <font size="-1">( <a href="'.admin_url('themes.php?page=carousel-wpress').'&mode=edit&id='.$id.'">Edit Carousel</a>
		- <a href="'.admin_url('themes.php?page=carousel-wpress').'&mode=edit-entries&carousel_id='.$id.'">Edit entries</a>
		- <a href="'.admin_url('themes.php?page=carousel-wpress').'">Back to the list</a>
		)</font></h1>';
		echo '<hr style="background:#ddd;color:#ddd;height:1px;border:none;">';
		
		if(count($item)>0) {
			
			echo '<h2><b>Name:</b> '.$item[0]['name'].'</h2>';
			echo '<h2><b>Shortcode to use:</b></h2><textarea style="width:800px; height:65px; margin-bottom:30px;">[carousel_wpress id="'.$id.'" '.$url_param.']</textarea><br>';
			
			$criteria['id'] = $id;
			$criteria['carouselWidth'] = $carouselWidth;
			$criteria['carouselHeight'] = $carouselHeight;
			$criteria['frontWidth'] = $frontWidth;
			$criteria['frontHeight'] = $frontHeight;
			$criteria['hAlign'] = $hAlign;
			$criteria['vAlign'] = $vAlign;
			$criteria['speed'] = $speed;
			$criteria['buttonNav'] = $buttonNav;
			$criteria['directionNav'] = $directionNav;
			$criteria['autoplay'] = $autoplay;
			$criteria['autoplayInterval'] = $autoplayInterval;
			$criteria['shadow'] = $shadow;
			$criteria['reflection'] = $reflection;
			$criteria['reflectionHeight'] = $reflectionHeight;
			$criteria['reflectionOpacity'] = $reflectionOpacity;
			$criteria['description'] = $description;
			
			$d1 = new Carousel_wpress_display();
			$carousel = $d1->get_carousel($criteria, array('display_js_declaration'=>1));
			
			echo $carousel;
		}
		
		?>
		
		<br><br>
		<h1><b>Test and preview with different settings:</b></h1>
			
			<?php
			
			$hAlign_tab = array('left', 'right', 'center');
			$vAlign_tab = array('top', 'bottom', 'center');
			$buttonNav_tab = array('numbers', 'bullets', 'none');
			$true_false_tab = array('true', 'false');
			
			echo '<form method="get">';
			
			echo '<input type="hidden" name="page" value="carousel-wpress">';
			echo '<input type="hidden" name="mode" value="view">';
			echo '<input type="hidden" name="id" value="'.$_GET['id'].'">';
			
			echo '<table><tr>';
			
			echo '<td valign="top" style="padding-right:50px;">';
				
				echo '<h2><b>General settings</b></h2>';
				
				echo '<p><label><b>Carousel width:</b> <small>(default: 1000)</small></label></p>';
				echo '<p><input class="widefat" type="text" id="carouselWidth" name="carouselWidth" style="width:440px;" value="'.$carouselWidth.'"></p>';
				
				echo '<p><label><b>Carousel height:</b> <small>(default: 300)</small></label></p>';
				echo '<p><input class="widefat" type="text" id="carouselHeight" name="carouselHeight" style="width:440px;" value="'.$carouselHeight.'"></p>';
				
				echo '<p><label><b>Front image width:</b> <small>(default: 400)</small></label></p>';
				echo '<p><input class="widefat" type="text" id="frontWidth" name="frontWidth" style="width:440px;" value="'.$frontWidth.'"></p>';
				
				echo '<p><label><b>Front image height:</b> <small>(default: 300)</small></label></p>';
				echo '<p><input class="widefat" type="text" id="frontHeight" name="frontHeight" style="width:440px;" value="'.$frontHeight.'"></p>';
				
				echo '<p><label><b>Horizontal alignement of the front image:</b></label></p>';
				echo '<p><select id="hAlign" name="hAlign">';
				foreach($hAlign_tab as $ind) {
					if($ind==$hAlign) echo '<option selected value="'.$ind.'">'.$ind.'</option>';
					else echo '<option value="'.$ind.'">'.$ind.'</option>';
				}
				echo '</select></p>';
				
				echo '<p><label><b>Vertical alignement of the front image:</b></label></p>';
				echo '<p><select id="vAlign" name="vAlign">';
				foreach($vAlign_tab as $ind) {
					if($ind==$vAlign) echo '<option selected value="'.$ind.'">'.$ind.'</option>';
					else echo '<option value="'.$ind.'">'.$ind.'</option>';
				}
				echo '</select></p>';
				
				/*
				echo '<p><label><b>Description:</b> <small>(default: false)</small></label></p>';
				echo '<p><select id="description" name="description">';
				foreach($true_false_tab as $ind) {
					if($ind==$description) echo '<option selected value="'.$ind.'">'.$ind.'</option>';
					else echo '<option value="'.$ind.'">'.$ind.'</option>';
				}
				echo '</select></p>';
				*/
				
			echo '</td>';
			
			echo '<td valign="top">';
				
				echo '<h2><b>Slider settings</b></h2>';
				
				echo '<p><label><b>Movements speed:</b> <small>(default: 500)</small></label></p>';
				echo '<p><input class="widefat" type="text" id="speed" name="speed" style="width:440px;" value="'.$speed.'"></p>';
				
				echo '<p><label><b>Type of navigation buttons:</b> <small>(default: bullets)</small></label></p>';
				echo '<p><select id="buttonNav" name="buttonNav">';
				foreach($buttonNav_tab as $ind) {
					if($ind==$buttonNav) echo '<option selected value="'.$ind.'">'.$ind.'</option>';
					else echo '<option value="'.$ind.'">'.$ind.'</option>';
				}
				echo '</select></p>';
				
				echo '<p><label><b>Enable or disable the Next and Previous buttons:</b> <small>(default: true)</small></label></p>';
				echo '<p><select id="directionNav" name="directionNav">';
				foreach($true_false_tab as $ind) {
					if($ind==$directionNav) echo '<option selected value="'.$ind.'">'.$ind.'</option>';
					else echo '<option value="'.$ind.'">'.$ind.'</option>';
				}
				echo '</select></p>';
				
				echo '<p><label><b>Autoplay slides:</b> <small>(default: false)</small></label></p>';
				echo '<p><select id="autoplay" name="autoplay">';
				foreach($true_false_tab as $ind) {
					if($ind==$autoplay) echo '<option selected value="'.$ind.'">'.$ind.'</option>';
					else echo '<option value="'.$ind.'">'.$ind.'</option>';
				}
				echo '</select></p>';
				
				echo '<p><label><b>Autoplay interval in milliseconds:</b> <small>(default: 5000)</small></label></p>';
				echo '<p><input class="widefat" type="text" id="autoplayInterval" name="autoplayInterval" style="width:440px;" value="'.$autoplayInterval.'"></p>';
				
				echo '<h2><b>Images effects</b></h2>';
				
				echo '<p><label><b>Shadow:</b> <small>(default: false)</small></label></p>';
				echo '<p><select id="shadow" name="shadow">';
				foreach($true_false_tab as $ind) {
					if($ind==$shadow) echo '<option selected value="'.$ind.'">'.$ind.'</option>';
					else echo '<option value="'.$ind.'">'.$ind.'</option>';
				}
				echo '</select></p>';
				
				echo '<p><label><b>Reflection:</b> <small>(default: false)</small></label></p>';
				echo '<p><select id="reflection" name="reflection">';
				foreach($true_false_tab as $ind) {
					if($ind==$reflection) echo '<option selected value="'.$ind.'">'.$ind.'</option>';
					else echo '<option value="'.$ind.'">'.$ind.'</option>';
				}
				echo '</select></p>';
				
				echo '<p><label><b>Reflection Height:</b> <small>(default: 0.2)</small></label></p>';
				echo '<p><input class="widefat" type="text" id="reflectionHeight" name="reflectionHeight" style="width:440px;" value="'.$reflectionHeight.'"></p>';
				
				echo '<p><label><b>Reflection Opacity:</b> <small>(default: 0.5)</small></label></p>';
				echo '<p><input class="widefat" type="text" id="reflectionOpacity" name="reflectionOpacity" style="width:440px;" value="'.$reflectionOpacity.'"></p>';
			
			echo '</td>';
			echo '</tr></table>';
			
			echo '<p class="submit" style="padding-bottom:0px; padding-top:0px;">';
			echo '<input class="button-primary" type="submit" value="Preview and generate shortcode">';
			echo '</p>';
			
			echo '</form>';
			
			?>
			
		</div></div>
		<?php
	}
	
}

new Carousel_wpress_admin();

?>