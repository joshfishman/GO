<?php

/**
 * Define the content type of email
 */
define( 'CONTENT_TYPE', 'text/html' );


// NO NEED EDIT
function yiw_send_email()
{
	$messages = $attachments = array();
	$qstr = '';                          
	
	if ( isset( $_POST['yiw_bot'] ) && ! empty( $_POST['yiw_bot'] ) )
	   return;

	if ( isset( $_POST['yiw_action'] ) AND ( $_POST['yiw_action'] == 'sendemail' OR $_POST['yiw_action'] == 'sendemail-ajax' ) )
	{
		$form = str_replace( '_', '-', $_POST['id_form'] );

		$fields = unserialize( yiw_get_option( 'contact_fields_' . $form ) );

		// body
		$body = nl2br( yiw_get_option( 'contact_form_body_' . $form, "%message%<br /><br /><small><i>This email is been sent by %name% (email. %email%).</i></small>" ) );

	    $yiw_referer = $_POST['yiw_referer'];

	    $union_qstr = ( $qstr == '' ) ? '?' : '';

	    $reply_to = '';                  

		// to
		$to = yiw_get_option( 'contact_form_to_' . $form, get_option( 'admin_email' ) );

		// from
		$from_email = yiw_get_option( 'contact_form_from_email_' . $form, get_option( 'admin_email' ) );
		$from_name  = yiw_get_option( 'contact_form_from_name_' . $form, 'Admin ' . get_bloginfo( 'name' ) );   

        // subject
	    $subject = stripslashes( yiw_get_option( 'contact_form_subject_' . $form, __( sprintf( 'Email without subject from site %s.', get_bloginfo('name') ), 'yiw' ) ) );

	    $post_data = array_map( 'stripslashes_deep', $_POST['yiw_contact'] ); 
	    foreach( $fields as $c => $field )
	    {
	        $id = $field['data_name'];
	        $var = $post_data[$id];
            
	    	// validate, adding message error, set up on admin panel, if var is not valid.
	    	if ( ( isset( $field['required'] ) AND $var == '' ) OR ( isset( $field['email_validate'] ) AND !is_email( $var ) ) )
				$messages[$form][$id] = stripslashes( $field['msg_error'] );

			// if reply to
			if ( isset( $field['reply_to'] ) AND $field['reply_to'] == 'yes' )
				$reply_to = $var;

	    	// convert \n to <br>
	    	if ( isset( $field['type'] ) AND $field['type'] == 'textarea' )
				$var = nl2br( $var );

			${$id} = $var;

			// replace tags of body config
			$body       = str_replace( "%$id%", $var, $body );
			$to         = str_replace( "%$id%", $var, $to );
			$from_email = str_replace( "%$id%", $var, $from_email );
			$from_name  = str_replace( "%$id%", $var, $from_name );    
			$subject    = str_replace( "%$id%", $var, $subject );       

			// add link to email, if it is ad email, for body email.
			if ( is_email( $var ) )
				$var = '<a href="mailto:' . $var . '">' . $var . '</a>';
		}

		// if there are attachments
		if( isset( $_FILES['yiw_contact']['tmp_name'] ) )
		{
			foreach( $_FILES['yiw_contact']['tmp_name'] as $id => $a_file )
			{
				$new_path = WP_CONTENT_DIR . '/uploads/' . basename( $_FILES['yiw_contact']['name'][$id] );
				move_uploaded_file( $a_file, $new_path );
				$attachments[] = $new_path;
			}
		}

		// set content type
		add_filter( 'wp_mail_content_type', 'yiw_set_contenttype' );      
		add_filter( 'wp_mail_from', create_function( '$from', "return '$from_email';" ) );
		add_filter( 'wp_mail_from_name', create_function( '$from', "return '$from_name';" ) );

		// if there ware some errors, return messages.
		if( !empty( $messages ) )
			return $messages;

		// all header, that will be print with implode.
		$headers = array();

		if( $reply_to != FALSE )
			$headers[] = 'Reply-To: ' . $reply_to;

		if ( wp_mail( $to, $subject, $body, implode( $headers, "\r\n" ), $attachments ) ) {
			$messages[$form]['general'] = '<p class="success">' . yiw_get_option( 'contact_form_success_sending_' . $form, __( 'Email sent correctly!', 'yiw' ) ) . '</p>';
	        do_action( 'yiw-sendmail-success' );
        } else
			$messages[$form]['general'] = '<p class="error">' . yiw_get_option( 'contact_form_error_sending_' . $form, __( 'An error has been encountered. Please try again.', 'yiw' ) ) . '</p>';

		return $messages;
	}
}

$message = yiw_send_email();
if ( isset( $_POST['type-send'] ) AND $_POST['type-send'] == 'ajax' )
{
	yiw_module_general_message_of( $_POST['id_form'] );
	die;
}

function yiw_module( $form, $echo = true )
{
	$fields = unserialize( yiw_get_option( 'contact_fields_' . $form ) );

	if( !is_array( $fields ) OR empty( $fields ) )
		return null;

	global $message;

	//echo '<pre>', print_r($fields), '</pre>';

	$html = '<form id="contact-form-' . $form . '" class="contact-form" method="post" action="' . yiw_curPageURL() . '" enctype="multipart/form-data">' . "\n\n";

	// div message feedback
	$html .= "\t<div class=\"usermessagea\">" . yiw_module_general_message_of( $form, false ) . "</div>\n";

	$html .= "\t<fieldset>\n\n";
	$html .= "\t\t<ul>\n\n";

	// array with all messages for js validate
	$js_messages = array();

	foreach( $fields as $id => $field )
	{
		// classes
		$input_class = array();   // array for print input's classes
		$li_class = array( $field['type'] . '-field' );    // array for print li's classes

		// errors
		$error_msg = '';
		$error = false;
		$js_messages[ $field['data_name'] ] = $field['msg_error'];

		if( isset( $message[$form][ $field['data_name'] ] ) )
		{
			$error = TRUE;
			$error_msg = $message[$form][ $field['data_name'] ];
		}

		// li class
		if( $field['class'] != '' )
			$li_class[] = " $field[class]";

		if( $error )
			array_push( $input_class, 'icon', 'error' );

		$html .= "\t\t\t<li class=\"" . implode( $li_class, ' ' ) . "\">\n";

		$html .= "\t\t\t\t<label for=\"$field[data_name]-$form\">\n";

		$html .= yiw_string_( "\t\t\t\t\t" . '<span class="label">', yiw_get_convertTags( stripslashes_deep( $field['title'] ), 'highlight-text' ), '</span>' . "\n", false );
		$html .= yiw_string_( "<br />\t\t\t\t\t" . '<span class="sublabel">', stripslashes_deep( $field['description'] ), '</span><br />' . "\n", false );

		$html .= "\t\t\t\t</label>\n";

		// if required
		if( isset( $field['required'] ) AND $field['required'] == 'yes' )
			$input_class[] = 'required';

		if( isset( $field['email_validate'] ) AND $field['email_validate'] == 'yes' )
			$input_class[] = 'email-validate';

		// retrive value
		if( isset( $field['data_name'] ) && $error )
		    $value = yiw_get_value( $field['data_name'] );
		else
		    $value = '';

		// only for clean code
		$html .= "\t\t\t\t";

		// print type of input
		switch( $field['type'] )
		{
			// text
			case 'text':
				$html .= "<input type=\"text\" name=\"yiw_contact[" . $field['data_name'] . "]\" id=\"" . $field['data_name'] . "-$form\" class=\"" . implode( $input_class, ' ' ) . "\" value=\"$value\" />";
			break;

			// checkbox
			case 'checkbox':
				$checked = '';

				if( $value != '' AND $value )
					$checked = ' checked="checked"';
				else if( $field['already_checked'] == 'yes' )
					$checked = ' checked="checked"';

				$html .= "<input type=\"checkbox\" name=\"yiw_contact[" . $field['data_name'] . "]\" id=\"" . $field['data_name'] . "-$form\" value=\"1\" class=\"" . implode( $input_class, ' ' ) . "\"{$checked} />";
				$html .= ' ' . $field['label_checkbox'];
			break;

			// select
			case 'select':
				$html .= "<select name=\"yiw_contact[" . $field['data_name'] . "]\" id=\"" . $field['data_name'] . "-$form\">\n";

				// options
				foreach( $field['option'] as $id => $option )
				{
					$selected = '';
					if( $field['option_selected'] == $id )
						$selected = ' selected="selected"';

					$html .= "\t\t\t\t\t\t<option value=\"$option\"$selected>$option</option>\n";
				}

				$html .= "\t\t\t\t\t</select>";
			break;

			// textarea
			case 'textarea':
				$html .= "<textarea name=\"yiw_contact[" . $field['data_name'] . "]\" id=\"" . $field['data_name'] . "-$form\" rows=\"8\" cols=\"30\" class=\"" . implode( $input_class, ' ' ) . "\">$value</textarea>";
			break;

			// radio
			case 'radio':
				// options
				foreach( $field['option'] as $i => $option )
				{
					$selected = '';
					if( $field['option_selected'] == $i )
						$selected = ' checked=""';

					$html .= "\t\t\t\t\t\t<input type=\"radio\" name=\"yiw_contact[{$field[data_name]}]\" id=\"{$field[data_name]}-$form-$i\" value=\"$option\"$selected /> $option<br />\n";
				}
			break;

			// password
			case 'password':
				$html .= "<input type=\"password\" name=\"yiw_contact[{$field[data_name]}]\" id=\"{$field[data_name]}-$form\" class=\"" . implode( $input_class, ' ' ) . "\" value=\"$value\" />";
			break;

			// file
			case 'file':
				$html .= "<input type=\"file\" name=\"yiw_contact[{$field[data_name]}]\" id=\"{$field[data_name]}-$form\" class=\"" . implode( $input_class, ' ' ) . "\" />";
			break;
		}

		// only for clean code
		$html .= "\n";

		$html .= "\t\t\t\t<div class=\"msg-error\">" . $error_msg . "</div>\n";

		$html .= "\t\t\t</li>\n";
	}

	$html .= "\t\t\t<li class=\"submit-button\">\n";
	$html .= "\t\t\t\t<input type=\"text\" name=\"yiw_bot\" id=\"yiw_bot\" />\n";
	$html .= "\t\t\t\t<input type=\"hidden\" name=\"yiw_action\" value=\"sendemail\" id=\"yiw_action\" />\n";
	$html .= "\t\t\t\t<input type=\"hidden\" name=\"yiw_referer\" value=\"" . yiw_curPageURL() . "\" />\n";
	$html .= "\t\t\t\t<input type=\"hidden\" name=\"id_form\" value=\"" . str_replace( '-', '_', $form ) . "\" />\n";
	$html .= "\t\t\t\t<input type=\"submit\" name=\"yiw_sendemail\" value=\"" . yiw_get_option( 'contact_form_submit_label_' . $form, __( 'send message', 'yiw' ) ) . "\" class=\"sendmail " . yiw_get_option( 'contact_form_submit_alignment_' . $form, __( 'alignright', 'yiw' ) ) . "\" />";
	$html .= "\t\t\t</li>\n";

	$html .= "\t\t</ul>\n\n";
	$html .= "\t</fieldset>\n";
	$html .= "</form>\n\n";

	// messages for javascript validation
	$html .= "<script type=\"text/javascript\">\n";
	$html .= "\tvar messages_form_" . str_replace( '-', '_', $form ) . " = {\n";

	foreach( $js_messages as $id => $msg )
		$html .= "\t\t$id: \"$msg\",\n";

	// remove last comma
	$html = str_replace( "\t\t$id: \"$msg\",\n", "\t\t$id: \"$msg\"\n", $html );

	$html .= "\t};\n";
	$html .= "</script>";

	if( $echo )
		echo $html;

	return $html;
}

function yiw_get_value( $id )
{
	return ( isset( $_POST['yiw_contact'][$id] ) ) ? $_POST['yiw_contact'][$id] : '';
}

function yiw_set_contenttype( $content_type ){
	return CONTENT_TYPE;
}

function yiw_add_contact_scripts(){
    wp_enqueue_script( 'yiw-contact-form', get_template_directory_uri() . '/js/contact.js', array( 'jquery' ), '1.0', true );

    wp_localize_script( 'yiw-contact-form', 'objectL10n', array(
		'wait' => __( 'wait...', 'yiw' )
	) );
}
add_action( 'wp_enqueue_scripts', 'yiw_add_contact_scripts' );


function yiw_module_general_message_of( $form, $echo = true )
{
    global $message;

    $return = '';
    if ( isset( $message[$form]['general'] ) )
        $return = $message[$form]['general'];

    if ( $echo )
        echo $return;

    return $return;
}


/**
 * CONTACT FORM
 *
 * @description
 *    Show a contact form, configured on Theme Options Panel
 *
 * @example
 *   [contact_form id="" ]
 *
 * @params
 * 	 id - the id of form, created on Theme Options Panel
**/
function yiw_contact_form_func($atts, $content = null) {
   	extract(shortcode_atts(array(
      	"id" => null
   	), $atts));

   	if( is_null( $id ) )
   	    $id = 'default';

    if( function_exists( 'yiw_module' ) )
   		return yiw_module( $id, false );
   	else
   		return '';
}
add_shortcode("contact_form", "yiw_contact_form_func");

?>
