jQuery('#carousel_wpress_add_btn').live('click', function(event) {
	event.preventDefault();
	
	jQuery('#carousel_wpress_add_btn').attr('disabled','disabled');
	
	var name = jQuery('#carousel_name').val();
	
	if(name=='') {
		alert('Please specify your carousel name');
		jQuery('#carousel_wpress_add_btn').removeAttr('disabled');
		exit();
	}
	
	jQuery.ajax({
		type: 'POST',
		url: Carousel_wpress.ajaxurl,
		data: 'action=carousel_wpress_listener&method=save_carousel&name='+name,
		success: function(msg) {
			if(msg!='') {
				window.location = Carousel_wpress.admin_url+'themes.php?page=carousel-wpress&mode=edit-entries&carousel_id='+msg;
			}
			else {
				jQuery('#carousel_wpress_add_btn').removeAttr('disabled');
				alert('An error happened adding your carousel');
			}
		}
	});
});

jQuery('#carousel_wpress_edit_btn').live('click', function(event) {
	event.preventDefault();
	
	jQuery('#carousel_wpress_edit_btn').attr('disabled','disabled');
	
	var name = jQuery('#carousel_name').val();
	var carousel_id = jQuery('#carousel_id').val();
	
	if(name=='') {
		alert('Please specify your carousel name');
		jQuery('#carousel_wpress_edit_btn').removeAttr('disabled');
		exit();
	}
	
	var serialized_data = jQuery("#carousel_form").serialize();
	
	jQuery.ajax({
		type: 'POST',
		url: Carousel_wpress.ajaxurl,
		data: 'action=carousel_wpress_listener&method=edit_carousel&'+serialized_data,
		success: function(msg) {
			window.location.reload();
		}
	});
});

jQuery('.carousel_wpress_delete_entry_btn').live('click', function(event) {
	event.preventDefault();
	
	if (confirm("Are you sure you want to delete this entry?")) {
		var entry_id = jQuery(this).attr('id');
		var carousel_id = jQuery('#carousel_id').val();
		
		jQuery('#carousel_wpress_entry_edit_btn').attr('disabled','disabled');
		
		jQuery.ajax({
			type: 'POST',
			url: Carousel_wpress.ajaxurl,
			data: 'action=carousel_wpress_listener&method=delete_entry&entry_id='+entry_id,
			success: function(msg) {
				window.location = Carousel_wpress.admin_url+'themes.php?page=carousel-wpress&mode=edit-entries&carousel_id='+carousel_id;
			}
		});
	}
});

jQuery('#carousel_wpress_entry_edit_btn').live('click', function(event) {
	event.preventDefault();
	
	var carousel_id = jQuery('#carousel_id').val();
	jQuery('#carousel_wpress_entry_edit_btn').attr('disabled','disabled');
	
	var serialized_data = jQuery("#carousel_wpress_entry_form").serialize();
	
	jQuery.ajax({
		type: 'POST',
		url: Carousel_wpress.ajaxurl,
		data: 'action=carousel_wpress_listener&method=edit_entry&'+serialized_data,
		success: function(msg) {
			//window.location.reload();
			window.location = Carousel_wpress.admin_url+'themes.php?page=carousel-wpress&mode=edit-entries&carousel_id='+carousel_id;
		}
	});
});
	
jQuery('#carousel_wpress_entry_add_btn').live('click', function(event) {
	event.preventDefault();
	
	jQuery('#carousel_wpress_entry_add_btn').attr('disabled','disabled');
	
	var serialized_data = jQuery("#carousel_wpress_entry_form").serialize();
	
	jQuery.ajax({
		type: 'POST',
		url: Carousel_wpress.ajaxurl,
		data: 'action=carousel_wpress_listener&method=add_entry&'+serialized_data,
		success: function(msg) {
			if(msg!='') {
				window.location = Carousel_wpress.admin_url+'themes.php?page=carousel-wpress&mode=edit-entries&carousel_id='+jQuery('#carousel_wpress_id').val();
			}
			else {
				jQuery('#carousel_wpress_entry_add_btn').removeAttr('disabled');
				alert('An error happened adding your entry');
			}
		}
	});
});

jQuery(".carousel_wpress_delete_btn").live('click', function(event) {
	event.preventDefault();
	if (confirm("Are you sure you want to delete this carousel?")) {
		var id = jQuery(this).attr('id');
		jQuery.ajax({
			type: 'POST',
			url: Carousel_wpress.ajaxurl,
			data: 'action=carousel_wpress_listener&method=delete_carousel&id='+id,
			success: function(msg) {
				window.location.reload();
			}
		});
	}
});     

jQuery(document).ready(function(){    
    var uploadInput;
     
    jQuery('#entry_image').live('click', function() {
    	uploadInput = this;
    	tb_show('', 'media-upload.php?post_id=0&type=image&amp;TB_iframe=true&width=650&height=400');
    	return false;
    });          
    
    // Bind an event to image url insert
	window.send_to_editor = function(html) {
		
		var img = jQuery('img',html).attr('src');
		
		jQuery(uploadInput).val( img );
		tb_remove();
	}
});
