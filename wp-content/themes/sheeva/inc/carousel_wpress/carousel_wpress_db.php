<?php

class Carousel_wpress_db {
	
	var $wpdb;
	var $carousel_table_name;
	var $carousel_entries_table_name;
	
	function Carousel_wpress_db() {
		global $wpdb;
		$this->wpdb = $wpdb;
		$this->carousel_table_name = $wpdb->prefix.'carousel_wpress';
		$this->carousel_entries_table_name = $wpdb->prefix.'carousel_entries_wpress';
	}
	
	//create tables
	function create_carousel_tables() {     
// 	    if ( get_option( 'yiw_carousel_wpress_created' ) )
// 	       return;
		 //die;
		//carousel table
		$sql = "CREATE TABLE IF NOT EXISTS ".$this->carousel_table_name." (
		`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
		`name` VARCHAR( 120 ) NOT NULL,
		`options` TEXT NOT NULL
		) ENGINE = MYISAM ;
		";
		$this->wpdb->query($sql);
		
		//carousel entries tables
		$sql = "CREATE TABLE IF NOT EXISTS ".$this->carousel_entries_table_name." (
		`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
		`carousel_id` INT NOT NULL ,
		`type_id` TINYINT NOT NULL ,
		`title` VARCHAR( 120 ) NOT NULL ,
		`url` VARCHAR( 180 ) NOT NULL ,
		`image` VARCHAR( 180 ) NOT NULL ,
		`description` TEXT NOT NULL,
		`position` INT NOT NULL
		) ENGINE = MYISAM ;
		";
		$this->wpdb->query($sql);
		
		update_option( 'yiw_carousel_wpress_created', true );
	}
	
	function get_carousel_list($criteria=array()) {
// 	    if ( ! isset( $criteria['id'] ) )
// 	       return;
	   
		$id = ( isset( $criteria['id'] ) ) ? $criteria['id'] : '';
		
		$sql = "SELECT *
		FROM $this->carousel_table_name
		WHERE 1";
		
		if($id!='') $sql .= " AND id='$id'";
		
		$sql .= ' ORDER BY id DESC';
		
		//echo $sql;
		$result = $this->wpdb->get_results($sql, 'ARRAY_A');
		return $result;
	}
	
	function get_nb_entries_per_carousel() {
		
		$sql = "SELECT carousel_id id, count(*) nb
		FROM $this->carousel_entries_table_name
		WHERE 1 
		GROUP BY carousel_id";
		
		//echo $sql;
		$result = $this->wpdb->get_results($sql, 'ARRAY_A');
		return $result;
	}
	
	function add_carousel($criteria=array()) {
		$name = $criteria['name'];
		$sql = "INSERT INTO $this->carousel_table_name (name,options) VALUES ('$name','')";
		$result = $this->wpdb->query($this->wpdb->prepare($sql));
		return $this->wpdb->insert_id;
	}
	
	function edit_carousel($criteria=array()) {
		$id = $criteria['id'];
		$name = $criteria['name'];
		$options = $criteria['options'];
		$sql = "UPDATE $this->carousel_table_name 
		SET name='$name', options='$options' WHERE id='$id'";
		$this->wpdb->query($this->wpdb->prepare($sql));
	}
	
	function delete_carousel($id) {
		if($id!='') {
			$sql = "DELETE FROM $this->carousel_table_name WHERE id='$id'";
			$this->wpdb->query($this->wpdb->prepare($sql));
		}
	}
	
	function get_carousel_entries($criteria=array()) {
		$id = isset( $criteria['id'] ) ? $criteria['id'] : '';
		$carousel_id = isset( $criteria['carousel_id'] ) ? $criteria['carousel_id'] : '';
		
		$sql = "SELECT *
		FROM $this->carousel_entries_table_name
		WHERE 1";
		
		if($id!='') $sql .= " AND id='$id'";
		if($carousel_id!='') $sql .= " AND carousel_id='$carousel_id'";
		
		$sql .= ' ORDER BY position DESC';
		
		$result = $this->wpdb->get_results($sql, 'ARRAY_A');
		return $result;
	}
	
	function add_carousel_entry($criteria=array()) {
		$carousel_id = $criteria['carousel_id'];
		$type_id = $criteria['type_id'];
		$title = $criteria['title'];
		$url = $criteria['url'];
		$image = $criteria['image'];
		$description = $criteria['description'];
		
		$sql = "INSERT INTO $this->carousel_entries_table_name 
		(carousel_id, type_id, title, url, image, description, position) 
		VALUES 
		('$carousel_id', '$type_id', '$title', '$url', '$image', '$description', 0)";      
		$result = $this->wpdb->query($this->wpdb->prepare($sql));
		return $this->wpdb->insert_id;
	}
	
	function edit_carousel_entry($criteria=array()) {
		$id = $criteria['id'];
		$type_id = $criteria['type_id'];
		$title = $criteria['title'];
		$url = $criteria['url'];
		$image = $criteria['image'];
		$description = $criteria['description'];
		
		$sql = "UPDATE $this->carousel_entries_table_name 
		SET type_id='$type_id', title='$title', url='$url', image='$image', description='$description' WHERE id='$id'";
		$this->wpdb->query($this->wpdb->prepare($sql));
	}
	
	function delete_carousel_entry($criteria=array()) {
		$id = $criteria['id'];
		
		$sql = "DELETE FROM $this->carousel_entries_table_name WHERE id='$id'";
		$this->wpdb->query($this->wpdb->prepare($sql));
	}
}

new Carousel_wpress_db();

?>