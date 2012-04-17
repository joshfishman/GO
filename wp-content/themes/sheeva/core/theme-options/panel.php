<?php 
/**
 * <short description>
 *
 * <long description>
 *
 * @package 
 * @subpackage 
 * @since 
 */

function yiw_admin( $vars ) 
{
    global $yiw_options, $yiw_theme_options_items;
    
    if ( empty( $vars ) )
        return;
    
    $i = $show_form = 0;
    $deps = array();  // tutte quelle opzioni che devon omostrarsi solo ad un determinato valore di un altra opzione
    $class_dep = $fade_color_dep = '';   
            
    $actual_section = isset( $_GET['section_opened'] ) ? $_GET['section_opened'] : '';
    
    yiw_message();      
    
    $current_tab = yiw_get_current_tab();
    
    foreach( $vars as $section => $values ) 
    {
        foreach($values as $value)
        {
            if( !isset( $value['std'] ) )
                $value['std'] = '';
                
            // deps                   
            if ( isset( $value['deps'] ) ) {
            	$value['deps']['id_input'] = yiw_option_id( $value['deps']['id'], false );
            	$deps[ $value['id'] ] = $value['deps'];
            	$class_dep = ' yiw-deps';
            	$fade_color_dep = '<div class="fade_color"></div>';
            }
            
            $is_section = ( $actual_section == $section ) ? true : false;
            
            switch ( $value['type'] ) 
            {
            
                // ================== OPEN =====================
                case "open":
                ?>
                
                <?php break;     
                
                
                // ================== SECTION =====================
                case "section":
                
                $i++;
                
                if( isset( $value['effect'] ) AND !$value['effect'] )
                {
                	$class_effect = '';         
                	$class_img = 'noeffect';   
                }
                else
                {
                	$class_effect = ' section_effect';
                	$class_img = 'inactive';
                }
                
                if ( $is_section )
                    $class_img = 'active';
                
                $img = '<img src="' . yiw_panel_url() . '/include/images/trans.png" class="'.$class_img.'" alt="">';
                
                if( isset( $value['valueButton'] ) )
                	$valueButton = __($value['valueButton'], 'yiw');
                else
                	$valueButton = __('Save changes', 'yiw');	
                
                ?>
                
                    <div class="rm_section<?php echo $class_effect ?>" id="<?php echo $section ?>-section">
                    <div class="rm_title">
						<h3<?php if ( $is_section ) echo ' class="active"' ?>><?php echo $img . $value['name']; ?></h3>
						
						<?php if ( ! isset( $value['show-submit'] ) OR ( isset( $value['show-submit'] ) AND $value['show-submit'] ) ) : ?>
						<span class="submit">
							<input type="submit" value="<?php echo $valueButton ?>" />  
                    	</span>
                    	<?php endif ?>
						
						<div class="clearfix"></div>
					</div>
                    <div class="rm_options<?php if ( $is_section) echo ' opened' ?>"<?php if ( $is_section) echo ' style="display:block;"' ?>>
                
                
                <?php break;   
                
                
                // ================== CLOSE =====================
                case "close":
                ?>
                                         
                        </div>                                    
                        <?php if ( $is_section ) echo '<input type="hidden" name="section-opened" value="'.$section.'-section" />' ?>
                    </div>
                    <br />
                
                
                <?php break;
                
                
                // ================== TITLE =====================
                case "title":
                ?>
                    <!--<p><?php _e('To easily use the options of the theme, you can use the menu below.', 'yiw') ?></p>--> 
    
                    <div class="wrap rm_wrap">   
                    
                    <div id="icon-options-general" class="icon32"><br></div>
                    <h2><?php echo $value['name']; ?></h2>  
                    <br />                                                       
    
                    <div class="rm_tabmenu">
                    
                        <ul id="sidemenu">
                            <?php foreach( $yiw_theme_options_items as $tab => $tab_value ) : $current = ( $current_tab == $tab ) ? ' class="current"' : ''; ?>
                            <li><a href="?page=<?php echo $_GET['page'] ?>&tab=<?php echo $tab ?>"<?php echo $current ?>><?php echo $tab_value ?></a></li>
                            <?php endforeach ?>
                        </ul>
                    
                    </div>
                    
                    <div class="clear"></div>
                    
                    <div class="rm_opts">
                    
                    <?php if ( !isset( $value['showform'] ) OR $value['showform'] ) $show_form = true; ?>
                    
                    <?php if( $show_form ) : ?>
                    <form method="post" action="?page=<?php echo $_GET['page'] ?>&tab=<?php echo $current_tab ?>">  
                    <?php endif; ?>                                       
                
                
                <?php break;
                
                
                // ================== ECHO TEXT =====================
                case 'show-text':       
                	
                	if ( isset( $value['id'] ) )
                		$id_container = 'id="' . $value['id'] . '-option" ';
                	
                	// if button copy
                	$before_text = $after_text = $button = '';
					if( isset( $value['copy-button'] ) AND $value['copy-button'] )
					{
						$before_text = '<div class="copy-text">';
						$after_text = '</div>';
						$button = '<a href="#" class="button-secondary copy-to-clipboard">' . __( 'Copy to clipboard', 'yiw' ) . '</a>';
					}
                ?>
                
                    <div <?php echo $id_container ?>class="rm_option rm_input rm_text">
                        <label><?php echo $value['name']; ?></label>
                        <textarea type="text" style="width:340px;height:28px;" class="copy-text"><?php echo $value['text'] ?></textarea> <?php echo $button ?>
						
						<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
                                                   
                    	<?php echo $fade_color_dep ?>
                    </div>
                <?php
                    break;
                
                
                // ================== ECHO TEXT =====================
                case 'simple-text':  
                ?>
                
                    <div class="rm_option rm_input rm_text" style="text-align:center;">
                        <p><?php echo $value['desc']; ?></p>
						
						<div class="clearfix"></div>
                    
                    	<?php echo $fade_color_dep ?>
                    </div>
                <?php
                    break;
                
                
                // ================== TEXT =====================
                case 'text':
                	
                	if ( isset( $value['id'] ) )
                		$id_container = 'id="' . $value['id'] . '-option" ';
                	
                ?>
                
                    <div <?php echo $id_container ?>class="rm_option rm_input rm_text<?php echo $class_dep ?>">
                        <label for="<?php yiw_option_id( $value['id'] ); ?>"><?php echo $value['name']; ?></label>
                        <input name="<?php yiw_option_name( $value['id'] ); ?>" 
							   id="<?php yiw_option_id( $value['id'] ); ?>" 
							   type="<?php echo $value['type']; ?>" 
							   <?php if( ! isset( $value['show_value'] ) OR $value['show_value'] ) : ?>
							   value="<?php echo stripslashes_deep( yiw_get_option( $value['id'], $value['std'] ) ); ?>"
							   <?php endif ?>
							   <?php if( isset( $value['button'] ) ) : ?>style="width:240px;" <?php endif ?>/>
                        
						<?php if( isset( $value['button'] ) ) : ?>
						<input type="submit" value="<?php echo $value['button']; ?>" class="button" name="button_save" id="<?php yiw_option_id( $value['id'] ); ?>_save">
						<?php endif ?>
                        
						<?php if( isset( $value['action'] ) ) : ?>
						<input type="hidden" name="secondary-action" value="<?php echo $value['action']; ?>" />
						<?php endif ?>
						
						<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
                    
                    	<?php echo $fade_color_dep ?>
                    </div>
                     
                <?php
                    break;
                
                
                // ================== TEXTAREA =====================
                case 'textarea':                      
                	
                	if ( isset( $value['id'] ) )
                		$id_container = 'id="' . $value['id'] . '-option" ';
                ?>
                
                    <div <?php echo $id_container ?>class="rm_option rm_input rm_textarea<?php echo $class_dep ?>">
                        <label for="<?php yiw_option_id( $value['id'] ); ?>"><?php echo $value['name']; ?></label>
                        <textarea name="<?php yiw_option_name( $value['id'] ); ?>" type="<?php echo $value['type']; ?>" cols="" rows="" class="listdata form-input-tip"><?php echo stripslashes_deep( yiw_get_option( $value['id'], $value['std'] ) ); ?></textarea>
                        <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
                    
                    	<?php echo $fade_color_dep ?>
                    </div>                  
                     
                                            
                <?php
                    break;
                
                
                // ================== SELECT =====================
                case 'select':                  
                	
                	if ( isset( $value['id'] ) )
                		$id_container = 'id="' . $value['id'] . '-option" ';
                ?>
                
                    <div <?php echo $id_container ?>class="rm_option rm_input rm_select<?php echo $class_dep ?>">
                        <label for="<?php yiw_option_id( $value['id'] ); ?>"><?php echo $value['name']; ?></label>
                        
                        <select name="<?php yiw_option_name( $value['id'] ); ?>" id="<?php yiw_option_id( $value['id'] ); ?>" <?php if( isset( $value['button'] ) ) : ?>style="width:240px;" <?php endif ?>>
                            <?php foreach ($value['options'] as $val => $option) { ?>
                                <option value="<?php echo $val ?>" <?php selected( yiw_get_option( $value['id'], $value['std'] ), $val ) ?>><?php echo $option; ?></option>
                            <?php } ?>
                        </select>                          
                        
						<?php if( isset( $value['button'] ) ) : ?>
						<input type="submit" value="<?php echo $value['button']; ?>" class="button" name="<?php yiw_option_id( $value['id'] ); ?>_save" id="<?php yiw_option_id( $value['id'] ); ?>_save">
						<?php endif ?>          
                        
						<?php if( isset( $value['action'] ) ) : ?>
						<input type="hidden" name="secondary-action" value="<?php echo $value['action']; ?>" />
						<?php endif ?>
                        
                        <small><?php echo $value['desc']; ?></small>
                        <div class="clearfix"></div>
                    	<?php echo $fade_color_dep ?>
                    </div>  
                     
                <?php
                    break;
                
                
                // ================== MULTISELECT =====================
                case 'multiselect':                  
                	
                	if ( isset( $value['id'] ) )
                		$id_container = 'id="' . $value['id'] . '-option" ';               
            
			        $selected = explode( ',', yiw_get_option( $value['id'], '' ) );      
			        if ( ! is_array( $selected ) )
			            $selected = array( $selected );
                ?>
                
                    <div <?php echo $id_container ?>class="rm_option rm_input rm_select<?php echo $class_dep ?>">
                        <label for="<?php yiw_option_id( $value['id'] ); ?>"><?php echo $value['name']; ?></label>
                        
                        <select multiple size="15" name="<?php yiw_option_name( $value['id'] ); ?>[]" id="<?php yiw_option_id( $value['id'] ); ?>" <?php if( isset( $value['button'] ) ) : ?>style="width:240px;" <?php endif ?>>
                            <?php foreach ($value['options'] as $val => $option) { ?>
                                <option value="<?php echo $val ?>" <?php selected( in_array( $val, $selected ) ) ?>><?php echo $option; ?></option>
                            <?php } ?>
                        </select>                          
                        
						<?php if( isset( $value['button'] ) ) : ?>
						<input type="submit" value="<?php echo $value['button']; ?>" class="button" name="<?php yiw_option_id( $value['id'] ); ?>_save" id="<?php yiw_option_id( $value['id'] ); ?>_save">
						<?php endif ?>          
                        
						<?php if( isset( $value['action'] ) ) : ?>
						<input type="hidden" name="secondary-action" value="<?php echo $value['action']; ?>" />
						<?php endif ?>
                        
                        <small><?php echo $value['desc']; ?></small>
                        <div class="clearfix"></div>
                    	<?php echo $fade_color_dep ?>
                    </div>  
                     
                <?php
                    break;
                
                
                // ================== RADIO=====================
                case 'radio':                    
                	
                	if ( isset( $value['id'] ) )
                		$id_container = 'id="' . $value['id'] . '-option" ';
                ?>
                
                    <div <?php echo $id_container ?>class="rm_option rm_input<?php echo $class_dep ?>">
                        <label for="<?php yiw_option_id( $value['id'] ); ?>"><?php echo $value['name']; ?></label>
                        
                        <div class="rm_radio">
                        <?php foreach ($value['options'] as $val => $option) { ?>
                        	<label class="radio-inline">
                            	<input type="radio" name="<?php yiw_option_name( $value['id'] ); ?>" id="<?php yiw_option_id( $value['id'] ); ?>" value="<?php echo $val ?>" <?php checked( yiw_get_option( $value['id'], $value['std'] ), $val ) ?> /> <?php echo $option ?>
                        	</label>
						<?php } ?>    
						</div>  
                        
                        <small><?php echo $value['desc']; ?></small>
                        <div class="clearfix"></div>
                    	<?php echo $fade_color_dep ?>
                    </div>        
                     
                <?php
                    break;
                
                
                // ================== CHECKBOX =====================
                case "checkbox":                    
                	
                	if ( isset( $value['id'] ) )
                		$id_container = 'id="' . $value['id'] . '-option" ';
                ?>
                
                    <div <?php echo $id_container ?>class="rm_option rm_input rm_checkbox<?php echo $class_dep ?>">
                        <label for="<?php yiw_option_id( $value['id'] ); ?>"><?php echo $value['name']; ?></label>
                        
                        <input type="checkbox" name="<?php yiw_option_name( $value['id'] ); ?>" id="<?php yiw_option_id( $value['id'] ); ?>" value="true" <?php checked( yiw_get_option( $value['id'], $value['std'] ), true ); ?> />
                        
                        
                        <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
                    	<?php echo $fade_color_dep ?>
                    </div>          
                     
                <?php break;      
                
                
                // ================== BUTTON =====================
                case 'button':                
                	
                	if ( isset( $value['id'] ) )
                		$id_container = 'id="' . $value['id'] . '-option" ';
                ?>
                
                    <div <?php echo $id_container ?>class="rm_option rm_input rm_text<?php echo $class_dep ?>">
                        <label><?php echo $value['name']; ?></label>
                        
						<input type="submit" value="<?php echo $value['label']; ?>" class="button" />
						<input type="hidden" name="secondary-action" value="<?php echo $value['action']; ?>" />
						
						<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
                    
                    	<?php echo $fade_color_dep ?>
                    </div>        
                     
                <?php
                    break;
                
                
                // ================== ON / OFF =====================
                case "on-off":                  
                	
                	if ( isset( $value['id'] ) )
                		$id_container = 'id="' . $value['id'] . '-option" ';
                ?>
                
                    <div <?php echo $id_container ?>class="rm_option rm_input rm_on_off<?php echo $class_dep ?>">
                        <label for="<?php yiw_option_id( $value['id'] ); ?>"><?php echo $value['name']; ?></label>
                        
                        <div class="iphone-check"><input type="checkbox" name="<?php yiw_option_name( $value['id'] ); ?>" id="<?php yiw_option_id( $value['id'] ); ?>" value="1" <?php checked( yiw_get_option( $value['id'] ), true ); ?> class="on_off" /></div>
                        
                        
                        <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
                    	<?php echo $fade_color_dep ?>
                    </div>       
                     
                <?php break; 
                
                
                // ================== SLIDER CONTROL =====================
                case "slider_control":      
                	
                	if ( isset( $value['id'] ) )
                		$id_container = 'id="' . $value['id'] . '-option" ';
                ?>
                
                    <div <?php echo $id_container ?>class="rm_option rm_input slider_control<?php echo $class_dep ?>">
                        <label for="<?php yiw_option_id( $value['id'] ); ?>"><?php echo $value['name']; ?></label>
                        
                        <?php $labels = ( isset( $value['label'] ) ) ? ' ' . $value['label'] : '' ?>
                        
                        <div class="ui-slider">
                            <span class="minCaption"><?php echo $value['min'] . $labels ?></span>
                            <span class="maxCaption"><?php echo $value['max'] . $labels ?></span>
                            <span id="<?php yiw_option_id( $value['id'] ); ?>-feedback" class="feedback"><strong><?php echo yiw_get_option( $value['id'], $value['std'] ) . $labels ?></strong></span>
                            <div id="<?php yiw_option_id( $value['id'] ); ?>" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
                                <input type="hidden" name="<?php yiw_option_name( $value['id'] ); ?>" value="<?php echo yiw_get_option( $value['id'], $value['std'] ); ?>" />
                            </div> 
                        </div> 
                        
                        <script type="text/javascript">
                            jQuery(document).ready(function($){
                                $('#<?php yiw_option_id( $value['id'] ); ?>').each(function(e){
                                    var val = <?php echo yiw_get_option( $value['id'], $value['std'] ); ?>; 
                                    var minValue = <?php echo $value['min'] ?>; 
                                    var maxValue = <?php echo $value['max'] ?>; 
                                    $(this).slider({
                                        value: val,
                                        min: minValue,
                                        max: maxValue,
                                        range: 'min',
                                        <?php if ( isset( $value['step'] ) ) : ?>
                                        step: <?php echo $value['step'] ?>,
                                        <?php endif ?>
                                        slide: function( event, ui ) {
                                			$( 'input[name="<?php yiw_option_name( $value['id'] ); ?>"]' ).val( ui.value );
                                			$( '#<?php yiw_option_id( $value['id'] ); ?>-feedback strong' ).text( ui.value + '<?php echo $labels ?>' );
                                		}
                                    });
                                });
                            });
                        </script>
                        
                        <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
                    	<?php echo $fade_color_dep ?>
                    </div>     
                     
                <?php break;             
                
                
                // ================== SIZE =====================
                case 'size':
                	
                	if ( isset( $value['id'] ) )
                		$id_container = 'id="' . $value['id'] . '-option" ';
                	
                	$size = maybe_unserialize( yiw_get_option( $value['id'], serialize( $value['std'] ) ) );
                	$label = ! isset( $value['label'] ) ? 'px' : $value['label'];
                	
                ?>
                
                    <div <?php echo $id_container ?>class="rm_option rm_input rm_text<?php echo $class_dep ?>">
                        <label for="<?php yiw_option_id( $value['id'] ); ?>"><?php echo $value['name']; ?></label>
                        <input name="<?php yiw_option_name( $value['id'] ); ?>[width]" 
							   id="<?php yiw_option_id( $value['id'] ); ?>_width" 
							   type="text" 
							   <?php if( ! isset( $value['show_value'] ) OR $value['show_value'] ) : ?>
							   value="<?php echo $size['width']; ?>"
							   <?php endif ?>
                               style="width:50px;" />
                               
                        &nbsp;x&nbsp;          
                               
                        <input name="<?php yiw_option_name( $value['id'] ); ?>[height]" 
							   id="<?php yiw_option_id( $value['id'] ); ?>_height" 
							   type="text" 
							   <?php if( ! isset( $value['show_value'] ) OR $value['show_value'] ) : ?>
							   value="<?php echo $size['height']; ?>"
							   <?php endif ?>
                               style="width:50px;" />
                               
                        <?php echo $label ?>
                        
						<?php if( isset( $value['button'] ) ) : ?>
						<input type="submit" value="<?php echo $value['button']; ?>" class="button" name="button_save" id="<?php yiw_option_id( $value['id'] ); ?>_save">
						<?php endif ?>
                        
						<?php if( isset( $value['action'] ) ) : ?>
						<input type="hidden" name="secondary-action" value="<?php echo $value['action']; ?>" />
						<?php endif ?>
						
						<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
                    
                    	<?php echo $fade_color_dep ?>
                    </div>
                     
                <?php
                    break;
                 
                 
                 // ================ CHECKBOX ARRAY ============
                case "check-array":            
                	
                	if ( isset( $value['id'] ) )
                		$id_container = 'id="' . $value['id'] . '-option" ';
                
                ?>
                
    			<div <?php echo $id_container ?>class="rm_option rm_input rm_multi_checkbox<?php echo $class_dep ?>">
                                                                              
        	        <label for="<?php yiw_option_id( $value['id'] ); ?>"><?php echo $value['name']; ?></label>
                                            
                    <ul id="<?php yiw_option_id( $value['id'] ); ?>" class="list-sortable<?php echo $class ?>">  
    				
                    <?php		                                
            
			        $selected = explode( ',', yiw_get_option( $value['id'], '' ) );      
			        if ( ! is_array( $selected ) )
			            $selected = array( $selected );
                    
                    //if($heads) echo '<li class="head">'.$value['heads'][$i-1].'</li>';
                    
    				foreach ( $value['options'] as $check_id => $check_val ) { ?>
                    
                    	<li>
                            <input type="checkbox" name="<?php yiw_option_name( $value['id'] ); ?>[]" value="<?php echo $check_id; ?>" <?php checked( in_array( $check_id, $selected ) ); ?> id="<?php yiw_option_id( $value['id'] ); ?>-<?php echo $check_id ?>" style="float:left;margin-right:5px;" />&nbsp;
                            <label for="<?php yiw_option_id( $value['id'] ); ?>-<?php echo $check_id ?>" class="label-check"><?php echo $check_val; ?></label>
                        </li>
                    <?php }  ?>
                    </ul>
                        
                	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
                	<?php echo $fade_color_dep ?>
                </div>       
                     
                 
                <?php break;
                 
                 
                 // ================ EXCLUDE CATEGORIES ============
                case "cat":            
                	
                	if ( isset( $value['id'] ) )
                		$id_container = 'id="' . $value['id'] . '-option" ';
                
                ?>
                
    			<div <?php echo $id_container ?>class="rm_option rm_input rm_multi_checkbox<?php echo $class_dep ?>">
                    <?php
    				
                    $cats = get_categories('orderby=name&use_desc_for_title=1&hierarchical=1&style=0&hide_empty=0');
    						             
                    $class = $descr = $ext = '';
                    $cols = 1;      
    				if ( isset( $value['cols'] ) && $value['cols'] )	
                    {
                        $heads = FALSE;
                        if ( isset( $value['heads'] ) )
                        {
                            $heads = TRUE;    
                        }
                        $cols = $value['cols'];
                        $class = ' small';
                        if($cols > 1) $descr = "<small>$value[desc]</small>";
                    }	?>
                                                                                                          
        	        <label for="<?php yiw_option_id( $value['id'] . $ext ); ?>"><?php echo $value['name'] . $descr; ?></label>
                    
                    <?php for($i=1;$i<=$cols;$i++) : $ext = ($cols > 1) ? "_$i" : '' ?>                           
                        <ul id="<?php yiw_option_id( $value['id'] . $ext ); ?>" class="list-sortable<?php echo $class ?>">  
        				
                        <?php		                                
                
    			        $selected_cats = explode(",", yiw_get_option($value['id'] . $ext));
                        
                        if($heads) echo '<li class="head">'.$value['heads'][$i-1].'</li>';
                        
                        $c = 0;
        				foreach($cats as $cat) { ?>
                        
                        	<li>
                                <input type="checkbox" name="<?php yiw_option_name( $value['id'] . $ext ); ?>[]" value="<?php echo $cat->cat_ID; ?>" <?php checked( in_array( $cat->cat_ID, $selected_cats ), true ); ?> id="<?php yiw_option_id( $value['id'] ); ?>-<?php echo $c . $ext ?>" />&nbsp;
                                <label for="<?php yiw_option_id( $value['id'] ); ?>-<?php echo $c . $ext ?>" class="label-check"><?php echo $cat->cat_name; ?></label>
                            </li>
                        <?php $c++;	}  ?>
                        </ul>
                    <?php endfor ?>
                	<?php if($cols <= 1) : ?><small><?php echo $value['desc']; ?></small><?php endif ?><div class="clearfix"></div>
                	<?php echo $fade_color_dep ?>
                </div>       
                     
                 
                <?php break;
                 
                 
                 // ================ EXCLUDE PAGES ============
                case "pag":         
                	
                	if ( isset( $value['id'] ) )
                		$id_container = 'id="' . $value['id'] . '-option" ';
                
                $pags = get_pages('orderby=name&use_desc_for_title=1&hierarchical=1&style=0&hide_empty=0');
                
                $selected_pags = explode(",", yiw_get_option($value['id']));
                ?>
    			<div <?php echo $id_container ?>class="rm_option rm_input rm_multi_checkbox<?php echo $class_dep ?>">
    	            <label for="<?php yiw_option_id( $value['id'] ); ?>"><?php echo $value['name']; ?></label>
                    <ul>
                    <?php $c = 0 ?>
    	            <?php foreach($pags as $pag) { ?>
                
    	                <li><input type="checkbox" name="<?php yiw_option_name( $value['id'] ); ?>[]" value="<?php echo $pag->ID; ?>" <?php checked( in_array( $pag->ID, $selected_pag ), true ); ?> id="<?php yiw_option_id( $value['id'] ); ?>-<?php echo $c ?>" />&nbsp;
                        <label for="<?php yiw_option_id( $value['id'] ); ?>-<?php echo $c ?>" class="label-check"><?php echo $pag->post_title; ?></label></li>
    	            <?php $c++; } ?>		
                    </ul>
                	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
                	<?php echo $fade_color_dep ?>
                </div>      
                     
                             
                <?php break;
                
                
                // ================== UPLOAD =====================
                case 'upload':        
                	
                	if ( isset( $value['id'] ) )
                		$id_container = 'id="' . $value['id'] . '-option" ';
				    
                	$url_image = yiw_get_option( $value['id'] );
                ?>
                
                    <div <?php echo $id_container ?>class="rm_option rm_input rm_text rm_upload<?php echo $class_dep ?>">
                        <label for="<?php yiw_option_id( $value['id'] ); ?>"><?php echo $value['name']; ?></label>
                        <div style="float:left; width:280px">    
                            <input type="text" name="<?php yiw_option_name( $value['id'] ); ?>" id="<?php yiw_option_id( $value['id'] ); ?>" value="<?php echo $url_image ?>" />     
							<input type="button" value="<?php _e('Upload Image', 'yiw') ?>" id="<?php yiw_option_id( $value['id'] ); ?>-button" />
                        </div>
                        <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
                    
                    	<?php echo $fade_color_dep ?>
                	</div>      
                     
                <?php
                    break;
                
                
                // ================== COLOR-PICKER =====================
                case 'color-picker':  
                	
                	if ( isset( $value['id'] ) )
                		$id_container = 'id="' . $value['id'] . '-option" ';
                ?>
                
                    <div <?php echo $id_container ?>class="rm_option rm_input rm_color<?php echo $class_dep ?>">                                                   
                        <div class="double">    
                            <label for="<?php yiw_option_id( $value['id'] ); ?>"><?php echo $value['name']; ?></label>
                            <input name="<?php yiw_option_name( $value['id'] ); ?>" id="<?php yiw_option_id( $value['id'] ); ?>" type="text" value="<?php echo trim( stripslashes_deep( yiw_get_option( $value['id'], $value['std'] ) ) ); ?>" />
                            &nbsp;<img src="<?php echo yiw_panel_url() ?>/include/images/color_picker.png" alt="Color Picker" class="colorpicker-icon" /><br/>          
                            <div class="clearfix"></div>
                        </div>                                      
                        <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
                        <div class="colorpicker"></div>
                        <div class="clearfix"></div>
                    	<?php echo $fade_color_dep ?>
                	</div>     
                     
                <?php
                    break;
                
                
                // ================== TABLE SIDEBAR =====================
                case 'sidebar-table':
                	$i = 0;           
                	
                	if ( isset( $value['id'] ) )
                		$id_container = 'id="' . $value['id'] . '-option" ';
                ?>
                
                    <div <?php echo $id_container ?>class="rm_option rm_input rm_sidebar<?php echo $class_dep ?>"> 
                        <label><?php echo $value['name']; ?></label>
                        
                        <?php 
                        	$sidebars = yiw_get_option( $value['values'] );
                        	
                        	if( !is_array( $sidebars ) )
								$sidebars = unserialize( $sidebars );
						?>
                        
						<table class="cc-options">
    						<tbody>                       
                                                                                 
                        	<?php if( is_array( $sidebars ) AND !empty( $sidebars ) ) : ?>
                        		
								<?php foreach( $sidebars as $id => $sidebar ) : ?>
								<tr>
						            <td>                                          
							            <div class="delete-btn"><a href="?page=<?php echo $_GET['page'] ?>&tab=<?php echo $current_tab ?>&action=delete&<?php echo $value['values'] ?>=<?php echo $id ?>&key=values" title="<?php _e( 'Delete', 'yiw' ) ?>"><img src="<?php echo yiw_panel_url() ?>/include/images/close_16.png" alt="<?php _e( 'Delete', 'yiw' ) ?>" /></a></div>
							            <div class="name"><?php echo $sidebar ?></div>
							            <div class="loading-icon"><img alt="" src="<?php bloginfo('siteurl') ?>/wp-admin/images/wpspin_light.gif" style="display: none;" class="waiting"></div>
						            </td>
						        </tr>                                  
						        <?php endforeach ?> 
						
							<?php else : ?>
								
								<tr><td><?php _e( sprintf( 'No %s created!', strtolower( $value['label'][1] ) ) ) ?></td></tr>
						
							<?php endif ?>
					                                              
					        </tbody>
						</table>
						          
                        <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
                    	<?php echo $fade_color_dep ?>
                	</div>       
                     
                <?php
                    break;    
                
                
                // ================== TABLE-SLIDES =====================
                case 'slides-table':  
                	
                	if ( isset( $value['id'] ) )
                		$id_container = 'id="' . $value['id'] . '-option" ';
                		
                	$value_array = yiw_get_option($value['id']); 
                	
                	if( $value_array AND !is_array( $value_array ) )
						$value_array = yiw_subval_sort( unserialize( $value_array ), 'order' );
					if( !$value_array )
						$value_array = array();
					
					//echo '<pre>';
					//print_r( yiw_cleanArray($value_array) );
					//echo '</pre>';
					
					array_push( $value_array, array() );        
					
					$configs = explode( ',', str_replace(" ", "", $value['config']) );
                ?>
                
                    <div <?php echo $id_container ?>class="rm_option rm_input rm_slides<?php echo $class_dep ?>">        
						<ul id="SlideShow">
							
							<?php foreach( $value_array as $id => $field ) : ?>
							<li class="isSortable slide-item noNesting">
								<div class="sortItem">              
									<table width="100%" cellspacing="0" cellpadding="3">
										<tbody>
											<tr>
												<td class="handle">
													<br/>
													&nbsp;<strong><?php _e( 'Order', 'yiw' ) ?>:</strong>
													<input type="text" name="<?php yiw_option_name( $value['id'] ); ?>[<?php echo $id ?>][order]" class="item_order_value" value="<?php echo $id ?>" />
													<div></div>
												</td>
												<td>  
													<?php if( isset( $field['content_type'] ) AND in_array('video', $configs) AND $field['content_type'] == 'video' ) : ?>                                                      
													<div class="ss-ImageSample"><img src="<?php echo get_template_directory_uri(); ?>/core/theme-options/include/images/video-preview.png" /></div>
													<?php else: ?>                      
													<img class="ss-ImageSample" src="<?php echo isset( $field['image_url'] ) ? $field['image_url'] : '' ?>">
													<?php endif ?>
													<table width="100%" cellspacing="5" cellpadding="0">
														<tbody>
															<?php foreach( $configs as $config ) : switch( trim( $config ) ) {
                                                                case 'title' : ?>
															<tr>
																<td colspan="4">&nbsp;<strong><?php _e('Slide Title', 'yiw') ?>:</strong><br> 
																	<input type="text" value="<?php echo isset( $field['slide_title'] ) ? stripslashes( $field['slide_title'] ) : '' ?>" alt="<?php _e('Slide Title', 'yiw') ?>" class="ss-ImageTitle" name="<?php yiw_option_name( $value['id'] ); ?>[<?php echo $id ?>][slide_title]">
																</td>
															</tr>
															<?php break; 
                                                                case 'caption' : ?>
															<tr>
																<td colspan="4">&nbsp;<strong><?php _e('Tooltip Content', 'yiw') ?></strong> <em class="small">(<?php _e('HTML Tags allowed', 'yiw') ?>)</em><br>
																	<textarea alt="<?php _e('Tooltip Content', 'yiw') ?>" class="ss-ImageDesc" name="<?php yiw_option_name( $value['id'] ); ?>[<?php echo $id ?>][tooltip_content]" type="text"><?php echo isset( $field['tooltip_content'] ) ? stripslashes( $field['tooltip_content'] ) : '' ?></textarea>
																</td>
															</tr>                                   
															<?php break; 
                                                                case 'image-position' : ?>
                                                            <tr>
                                                                <td colspan="4">&nbsp;<strong><?php _e('Image position', 'yiw') ?></strong> <em class="small">(<?php _e('Values must be expressed in pixels', 'yiw') ?>)</em><br />
                                                                    <div class="positions">
                                                                        <div class="position-top position"><label><strong><?php _e('Top', 'yiw') ?></strong><br /><input type="text" name="<?php yiw_option_name( $value['id'] ); ?>[<?php echo $id ?>][slide_image_position_top]" value="<?php echo isset( $field['slide_image_position_top'] ) ? $field['slide_image_position_top'] : '' ?>" /></label></div>
                                                                        <div class="position-left position"><label><strong><?php _e('Left', 'yiw') ?></strong><br /><input type="text" name="<?php yiw_option_name( $value['id'] ); ?>[<?php echo $id ?>][slide_image_position_left]" value="<?php echo isset( $field['slide_image_position_left'] ) ? $field['slide_image_position_left'] : '' ?>" /></label></div>
                                                                        <div class="position-right position"><label><strong><?php _e('Right', 'yiw') ?></strong><br /><input type="text" name="<?php yiw_option_name( $value['id'] ); ?>[<?php echo $id ?>][slide_image_position_right]" value="<?php echo isset( $field['slide_image_position_right'] ) ? $field['slide_image_position_right'] : '' ?>" /></label></div>
                                                                        <div class="position-bottom position"><label><strong><?php _e('Bottom', 'yiw') ?></strong><br /><input type="text" name="<?php yiw_option_name( $value['id'] ); ?>[<?php echo $id ?>][slide_image_position_bottom]" value="<?php echo isset( $field['slide_image_position_bottom'] ) ? $field['slide_image_position_bottom'] : '' ?>" /></label></div>
                                                                    </div>
                                                                </td>
                                                            </tr>                                   
                                                            <?php break; 
                                                                case 'text-position' : ?>
                                                            <tr>
                                                                <td colspan="4">&nbsp;<strong><?php _e('Text position', 'yiw') ?></strong> <em class="small">(<?php _e('Values must be expressed in pixels', 'yiw') ?>)</em><br />
                                                                    <div class="positions">
                                                                        <div class="position-top position"><label><strong><?php _e('Top', 'yiw') ?></strong><br /><input type="text" name="<?php yiw_option_name( $value['id'] ); ?>[<?php echo $id ?>][slide_text_position_top]" value="<?php echo isset( $field['slide_text_position_top'] ) ? $field['slide_text_position_top'] : '' ?>" /></label></div>
                                                                        <div class="position-left position"><label><strong><?php _e('Left', 'yiw') ?></strong><br /><input type="text" name="<?php yiw_option_name( $value['id'] ); ?>[<?php echo $id ?>][slide_text_position_left]" value="<?php echo isset( $field['slide_text_position_left'] ) ? $field['slide_text_position_left'] : '' ?>" /></label></div>
                                                                        <div class="position-right position"><label><strong><?php _e('Right', 'yiw') ?></strong><br /><input type="text" name="<?php yiw_option_name( $value['id'] ); ?>[<?php echo $id ?>][slide_text_position_right]" value="<?php echo isset( $field['slide_text_position_right'] ) ? $field['slide_text_position_right'] : '' ?>" /></label></div>
                                                                        <div class="position-bottom position"><label><strong><?php _e('Bottom', 'yiw') ?></strong><br /><input type="text" name="<?php yiw_option_name( $value['id'] ); ?>[<?php echo $id ?>][slide_text_position_bottom]" value="<?php echo isset( $field['slide_text_position_bottom'] ) ? $field['slide_text_position_bottom'] : '' ?>" /></label></div>
                                                                    </div>
                                                                </td>
                                                            </tr>                                   
                                                            <?php break; 
                                                                case 'color-picker' : ?>
                                                            <tr>
                                                                <td colspan="4">
                                                                    <div class="rm_option rm_input rm_color">
                                                                        <div class="double">
                                                                            <label for="<?php yiw_option_name( $value['id'] ); ?>[<?php echo $id ?>][background_color]"><strong>Background color</strong></label>
                                                                            <input name="<?php yiw_option_name( $value['id'] ); ?>[<?php echo $id ?>][background_color]" id="<?php yiw_option_name( $value['id'] ); ?>[<?php echo $id ?>][background_color]" type="text" value="<?php if ( isset( $field['background_color'] ) ) echo trim( stripslashes_deep( $field['background_color'] ) ); ?>" />
                                                                            &nbsp;<img src="<?php echo yiw_panel_url() ?>/include/images/color_picker.png" alt="Color Picker" class="colorpicker-icon" /><br/>
                                                                            <div class="clearfix"></div>
                                                                        </div>
                                                                        <small>This background color should be used when the image uploaded is smaller than 1920px</small><div class="clearfix"></div>
                                                                        <div class="colorpicker"></div>
                                                                        <div class="clearfix"></div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <?php break; 
                                                                case 'image' : ?>
															<tr>
																<td align="left" colspan="3" class="rm_upload">
																	<label style="color:#333;float:none;display:inline;line-height:1em;">  
																		&nbsp;<input type="radio" name="<?php yiw_option_name( $value['id'] ); ?>[<?php echo $id ?>][content_type]" id="<?php yiw_option_id( $value['id'] ); ?>-contentimage-<?php echo $id ?>" value="image"<?php if( !isset( $field['content_type'] ) OR ( $field['content_type'] == '' OR $field['content_type'] == 'image' ) ) : ?> checked=""<?php endif ?> /> 
																		<strong><?php _e('Image URL', 'yiw') ?>:</strong>
																	</label><br>
																	<input type="text" alt="<?php _e('Image URL', 'yiw') ?>" class="ss-Image" name="<?php yiw_option_name( $value['id'] ); ?>[<?php echo $id ?>][image_url]" value="<?php echo isset( $field['image_url'] ) ? $field['image_url'] : '' ?>" rel="<?php yiw_option_id( $value['id'] ); ?>-contentimage-<?php echo $id ?>" />
																	<input type="button" class="button-secondary" value="<?php _e('Upload Image', 'yiw') ?>" id="<?php yiw_option_id( $value['id'] ); ?>-upload" />
																	<input type="hidden" name="<?php yiw_option_name( $value['id'] ); ?>[<?php echo $id ?>][image_id]" value="<?php echo isset( $field['image_id'] ) ? $field['image_id'] : '' ?>" class="idattachment" />
																</td>
															</tr>              
															<?php break; 
                                                                case 'video' : ?>
															<tr>
																<td align="left" colspan="3">
																	<label style="color:#333;float:none;display:inline;line-height:1em;">  
																		&nbsp;<input type="radio" name="<?php yiw_option_name( $value['id'] ); ?>[<?php echo $id ?>][content_type]" id="<?php yiw_option_id( $value['id'] ); ?>-contentvideo-<?php echo $id ?>" value="video"<?php if( isset( $field['content_type'] ) && $field['content_type'] == 'video' ) : ?> checked=""<?php endif ?> /> 
																		<strong><?php _e('URL Video', 'yiw') ?>:</strong>
																	</label>
																	<em class="small">(<?php _e( 'url by Youtube or Vimeo', 'yiw' ) ?>)</em><br>
																	<input type="text" alt="<?php _e('URL Video', 'yiw') ?>" name="<?php yiw_option_name( $value['id'] ); ?>[<?php echo $id ?>][url_video]" value="<?php if( isset( $field['url_video'] ) ) echo stripslashes_deep( $field['url_video'] ) ?>" rel="<?php yiw_option_id( $value['id'] ); ?>-contentvideo-<?php echo $id ?>" />
																</td>
															</tr>              
															<?php break; 
                                                                default :
                                                                    do_action( 'yiw_slider_config_' . $config, $value, $id, $field );
                                                            } endforeach; ?>                
															<tr>
																<td colspan="2" align="left" style="white-space: nowrap;">  
																	<?php if( in_array('link', $configs) ) : ?>
																	<br/>
																	<label style="color:#333">&nbsp;<strong><?php _e('Slide Link', 'yiw') ?>:</strong></label>
																	
																	<?php $types = array(	'page' => __('page', 'yiw'), 
																							'category' => __('category', 'yiw'), 
																							//'post' => __('post', 'yiw'),
																							'url' => __('url', 'yiw'),
																							'none' => __('none', 'yiw') ) ?>
																	
																	<?php 
																		$check = FALSE;
																		foreach($types as $type => $title_type) :  
																			if( ( ( isset( $field['link_type'] ) AND $field['link_type'] == $type ) OR $type == 'none' ) AND !$check ) 
																			{
																				$checked_class = 'checked ';
																				$checked = 'checked ';
																				$check = TRUE;
																			} 
																			else
																			{
																				$checked_class = '';
																				$checked = '';
																			}
																	?>
																	<label class="<?php echo $checked_class ?>radioLink">
																		<input type="radio" value="<?php echo $type ?>" id="<?php yiw_option_id( $value['id'] . '-' . $id . '-' . $type ); ?>" name="<?php yiw_option_name( $value['id'] ); ?>[<?php echo $id ?>][link_type]" <?php echo $checked ?>/>&nbsp;<?php echo ucfirst($title_type) ?>
																	</label>
																	<?php endforeach ?>
																	
																	<?php foreach($types as $type => $title_type) : 
																			if( isset( $field['link_type'] ) AND $field['link_type'] == $type ) 
																			{
																				$checked = 'style="display: block;" ';
																			} 
																			else
																			{
																				$checked = '';
																			} 
																			
																			switch($type) {
																	
																	case 'page' : ?>		
																	<?php $pags = get_pages('orderby=name&use_desc_for_title=1&hierarchical=1&style=0&hide_empty=0'); ?>					
																	<select <?php echo $checked ?>name="<?php yiw_option_name( $value['id'] ); ?>[<?php echo $id ?>][link_page]" class="ss-Link <?php echo $type ?>">
																		<option value=""><?php _e('Choose a page...', 'yiw') ?></option>
																		<?php foreach( $pags as $page ) : if ( ! isset( $field['link_page']  )) $field['link_page'] = false; ?>
																		<option value="<?php echo $page->ID ?>"<?php selected( $page->ID, $field['link_page'] ) ?>><?php echo $page->post_title ?></option>
																		<?php endforeach ?>
																	</select>
																	<?php break; ?>
																	
																	<?php case 'category' : ?>
																	<select <?php echo $checked ?>name="<?php yiw_option_name( $value['id'] ); ?>[<?php echo $id ?>][link_category]" class="ss-Link <?php echo $type ?>">
																		<?php foreach( $GLOBALS['wp_cats'] as $slug => $cat ) : if ( ! isset( $field['link_category'] ) ) $field['link_category'] = false; ?>
																		<option value="<?php echo $slug ?>"<?php selected( $slug, $field['link_category'] ) ?>><?php echo $cat ?></option>
																		<?php endforeach ?>
																	</select>			
																	<?php break; ?>
																	
																	<?php case 'url' : ?>											
																	<input type="text" <?php echo $checked ?>class="ss-Link <?php echo $type ?>" value="<?php echo isset( $field['link_url'] ) ? $field['link_url'] : '' ?>" name="<?php yiw_option_name( $value['id'] ); ?>[<?php echo $id ?>][link_url]" />
																	<?php break; ?>
																	
																	<?php } endforeach; ?>  
																<?php endif ?>     
                                                                <?php if( in_array('tooltip', $configs) ) : ?>
        														<tr>
        															<td colspan="4">&nbsp;<strong><?php _e('Extra Tooltip', 'yiw') ?></strong> <br/><em class="small">(<?php _e('The tooltip that you can add inside the image. Leave empty the content to not use', 'yiw') ?>)</em><br>
        																<textarea alt="<?php _e('Extra Tooltip', 'yiw') ?>" class="ss-ImageDesc" name="<?php yiw_option_name( $value['id'] ); ?>[<?php echo $id ?>][extra_tooltip_content]" type="text"><?php echo isset( $field['extra_tooltip_content'] ) ? stripslashes( $field['extra_tooltip_content'] ) : '' ?></textarea>
        															    <br/><strong>Image</strong>: <input type="text" name="<?php yiw_option_name( $value['id'] ); ?>[<?php echo $id ?>][extra_tooltip_image]" value="<?php echo isset( $field['extra_tooltip_image'] ) ? stripslashes( $field['extra_tooltip_image'] ) : '' ?>" style="width:194px;">
        															    <input type="button" class="upload-button button-secondary" value="Upload Image" />
                                                                        <br/><strong>URL</strong>: <input type="text" name="<?php yiw_option_name( $value['id'] ); ?>[<?php echo $id ?>][extra_tooltip_url]" value="<?php echo isset( $field['extra_tooltip_url'] ) ? stripslashes( $field['extra_tooltip_url'] ) : '' ?>" style="width:306px;">
        															    <strong>Coords</strong>: x <input type="text" name="<?php yiw_option_name( $value['id'] ); ?>[<?php echo $id ?>][extra_tooltip_x_pos]" value="<?php echo isset( $field['extra_tooltip_x_pos'] ) ? stripslashes( $field['extra_tooltip_x_pos'] ) : '' ?>" style="width:40px;">
        															    y <input type="text" name="<?php yiw_option_name( $value['id'] ); ?>[<?php echo $id ?>][extra_tooltip_y_pos]" value="<?php echo isset( $field['extra_tooltip_y_pos'] ) ? stripslashes( $field['extra_tooltip_y_pos'] ) : '' ?>" style="width:40px;">
                                                                    </td>
        														</tr>                                   
        														<?php endif ?>    
																</td>
																<td width="90" align="center" class="delete-button">
																	<div class="button-secondary delete-item"><a href="?page=<?php echo $_GET['page'] ?>&tab=<?php echo $current_tab ?>&action=delete&<?php echo $value['id'] ?>=<?php echo $id ?>&key=id"><?php _e('Delete', 'yiw') ?></a></div>
																</td>
															</tr>
														</tbody>
													</table>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</li>           
							<?php endforeach ?>
										
						</ul>            
						<p>
							<input class="button-secondary add-slide-button hide-if-no-js" type="button" value="<?php _e( 'Add Slide', 'yiw' ) ?>" />
							<input class="button-secondary hide-if-js" type="submit" value="<?php _e( 'Add/Edit Slide', 'yiw' ) ?>" />
							<a href="?page=<?php echo $_GET['page'] ?>&tab=<?php echo $current_tab ?>&action=delete&id=<?php echo $value['id'] ?>" class="button-secondary"><?php _e( 'Delete all slides', 'yiw' ) ?></a>
						</p>
                    	<?php echo $fade_color_dep ?>
                	</div>     
                	
                	<script type="text/javascript">
                		jQuery(document).ready(function($){
							
							$('#<?php echo $value['id'] ?>-option .add-slide-button').click(function(){   
								var empty_slide = $('#SlideShow li:last-child').clone(); 
								var last_index = parseInt( $('#SlideShow li:last-child input[name*="[order]"]').val() );
								//alert(last_index);
								
								// empty all inputs
								$('input:not(input[name*="[order]"], input[type="button"], input[type="checkbox"], input[type="radio"]), textarea', empty_slide).val('');
								// change the id of the inputs name
								var pattern_inputs = /\[(\d+)\]/;
								$('input[name*="<?php yiw_option_name( $value['id'] ); ?>"], textarea[name*="<?php yiw_option_name( $value['id'] ); ?>"], select[name*="<?php yiw_option_name( $value['id'] ); ?>"]', empty_slide).each(function(){
									var name = $(this).attr('name');
									var name_match = name.match( pattern_inputs );
									var new_name = name.replace(pattern_inputs, "["+(parseInt(name_match[1])+1)+"]");
									$(this).attr('name', new_name);
								});
								// delete preview image
								$('.ss-ImageSample', empty_slide).attr('src', '');
								
								empty_slide.appendTo('#SlideShow');
								$('#SlideShow li:last-child input[name*="[order]"]').val(last_index+1);
								
								return false;
							});	
						});
                	</script>
                     
                <?php
                    break;          
                
                
                // ================== TABLE CONTACT =====================
                case 'contact-table':       
                	
                	if ( isset( $value['id'] ) )
                		$id_container = 'id="' . $value['id'] . '-option" ';
                	
                	$contact_form = yiw_get_option( 'contact_form_choosen' );
                	
                	$fields = maybe_unserialize( yiw_get_option( $value['id'] ) );  
					
					//echo '<pre>', print_r($fields), '</pre>';
                ?>
                
                    <div <?php echo $id_container ?>class="rm_option rm_input rm_contact<?php echo $class_dep ?>">
					
						<p>
							<a href="<?php echo yiw_panel_url() ?>/include/contact_add.php?id=<?php echo $value['id'] ?>&action=new-field&page=<?php echo $_GET['page'] ?>&tab=<?php echo $current_tab ?>&TB_iframe=true" class="button-primary thickbox">Add field</a>
						</p> 
                    
					    <table class="wp-list-table widefat fixed posts" cellpadding="0">
					    	<thead>
					    		<tr>                                                     
					    			<th scope="col" class="name-field"><?php _e( 'Field Title', 'yiw' ) ?></th>
					    			<th scope="col" class="info-field"><?php _e( 'Data Name', 'yiw' ) ?></th>
					    			<th scope="col" class="info-field"><?php _e( 'Required', 'yiw' ) ?></th>
					    			<th scope="col"><?php _e( 'Type', 'yiw' ) ?></th>      
					    			<th scope="col" class="controls-field">&nbsp;</th>
								</tr>	
					    	</thead>
					    	<tbody>
					    	
							<?php if( !empty( $fields ) ) : ?>	
					    		<?php foreach( $fields as $id => $field ) : ?>
								<tr<?php if( $id % 2 ) echo ' class="alternate"'; ?> valign="top">             
					    			<th class="name-field" scope="row"><?php echo stripslashes_deep( $field['title'] ) ?></th>
					    			<td class="info-field"><?php echo stripslashes_deep( $field['data_name'] ) ?></td>
					    			<td class="info-field"><?php echo ( isset( $field['required'] ) AND $field['required'] == 'yes' ) ? __( 'Yes', 'yiw' ) : __( 'No', 'yiw' ) ?></td>
					    			<td><?php echo $field['type'] ?></td>
					    			<td class="controls-field">      
										<span class="items-ord">                          
											<?php if( $id != 0 ) : ?>
											<a href="?page=<?php echo $_GET['page'] ?>&tab=<?php echo $current_tab ?>&action=array-ord&id=<?php echo $value['id'] ?>&dir=up&from=<?php echo $id ?>" class="item-move-up"><abbr title="<?php _e( 'Move up', 'yiw' ) ?>">&#8593;</abbr></a>   
											<?php else: ?>
											&nbsp;
											<?php endif; ?> 
											|                                     
											<?php if( $id != count( $fields ) - 1 ) : ?>
											<a href="?page=<?php echo $_GET['page'] ?>&tab=<?php echo $current_tab ?>&action=array-ord&id=<?php echo $value['id'] ?>&dir=down&from=<?php echo $id ?>" class="item-move-down"><abbr title="<?php _e( 'Move down', 'yiw' ) ?>">&#8595;</abbr></a>   
											<?php else: ?>
											&nbsp;
											<?php endif; ?>                                                                 
										</span>
										<a href="<?php echo yiw_panel_url() ?>/include/contact_add.php?page=<?php echo $_GET['page'] ?>&tab=<?php echo $current_tab ?>&id=<?php echo $value['id'] ?>&c=<?php echo $id ?>&action=edit-field&TB_iframe=true" title="<?php _e( 'Edit', 'yiw' ) ?>" class="button-primary thickbox"><?php _e( 'Edit', 'yiw' ) ?></a>
										<a href="?page=<?php echo $_GET['page'] ?>&tab=<?php echo $current_tab ?>&action=delete&key=id&<?php echo $value['id'] ?>=<?php echo $id ?>&TB_iframe=true" title="<?php _e( 'Delete', 'yiw' ) ?>" class="button-secondary"><?php _e( 'Delete', 'yiw' ) ?></a>
									</td>
					    		</tr>
					    		<?php endforeach ?>
					    	<?php else : ?>
					    		<tr>
					    			<td colspan="4"><?php _e( 'No fields created yet.', 'yiw' ) ?></td>
					    		</tr>
					    	<?php endif ?>
					    		
					    	</tbody>
						</table>              
						    
                    	<?php echo $fade_color_dep ?>
                	</div>    
                     
                <?php
                    break;    
                
                
                // ================== FONTS SELECT =====================
                case 'font-select':                  
                	
                	if ( isset( $value['id'] ) )
                		$id_container = 'id="' . $value['id'] . '-option" ';
                		
                    $types = array(
    			   	 	'cufon' => 'Cufon',
    					'google-font' => 'Google Fonts',
    					'web-fonts' => 'Web Fonts Family'	
                    );
                    
                    $font_option = maybe_unserialize( yiw_get_option( $value['id'], serialize( $value['std'] ) ) );
                    $font_type_selected = $font_option['type'];
                    $font_selected = $font_option[$font_type_selected];
                	
                	$type_allowed = explode( ',', $value['font-types'] );
                ?>
                
                    <div <?php echo $id_container ?>class="rm_option rm_input rm_select<?php echo $class_dep ?>">
                        <label for="<?php yiw_option_id( $value['id'] ); ?>_type"><?php echo $value['name']; ?></label>
                        
                        <div style="float:left; width:280px">
                            <select class="font-type-select" name="<?php yiw_option_name( $value['id'] ); ?>[type]" id="<?php yiw_option_id( $value['id'] ); ?>_type">
                                <?php foreach ( $type_allowed as $id_type ) { ?>
                                    <option value="<?php echo $id_type ?>" <?php selected( $font_type_selected, $id_type ) ?>><?php echo $types[$id_type]; ?></option>
                                <?php } ?>
                            </select>  
                            
                            <br/>
                            
                            <select name="<?php yiw_option_name( $value['id'] ); ?>[cufon]" class="font cufon">
                                <?php foreach (yiw_list_cufon_fonts() as $val => $option) { ?>
                                    <option value="<?php echo $val ?>" <?php selected( $font_selected, $val ) ?>><?php echo $option; ?></option>
                                <?php } ?>
                            </select> 
                            
                            <select name="<?php yiw_option_name( $value['id'] ); ?>[google-font]" class="font google-font">
                                <?php foreach (yiw_list_google_fonts() as $val => $option) { ?>
                                    <option value="<?php echo $val ?>" <?php selected( $font_selected, $val ) ?>><?php echo $option; ?></option>
                                <?php } ?>
                            </select>    
                            
                            <select name="<?php yiw_option_name( $value['id'] ); ?>[web-fonts]" class="font web-fonts">
                                <?php foreach (yiw_list_standard_fonts() as $val => $option) { ?>
                                    <option value="<?php echo $val ?>" <?php selected( stripslashes($font_selected), stripslashes($val) ) ?>><?php echo $option; ?></option>
                                <?php } ?>
                            </select>     
                        </div>    
                        
                        <small><?php echo $value['desc']; ?></small>
                        <div class="clearfix"></div>
                    	<?php echo $fade_color_dep ?>
                    	
                    	<script type="text/javascript">
                    	   jQuery(document).ready(function($){
                                var this_option = $('#<?php echo $value['id']; ?>-option'); 
                                
                                $('.font', this_option).hide();
                                $('.' + $('.font-type-select', this_option).val(), this_option).show();
                                
                                $('.font-type-select', this_option).change(function(){
                                    var value = $(this).val();              
                                    $('.font', this_option).hide();
                                    $('.'+value, this_option).show();
                                });        
                           });
                    	</script>
                    </div>  
                     
                <?php
                    break;       
                
                
                // ================== TABLE CONTACT =====================
                case 'composer':       
                	
                	if ( isset( $value['id'] ) )
                		$id_container = 'id="' . $value['id'] . '-option" ';
                	
                	$elements = maybe_unserialize( yiw_get_option( $value['id'], array() ) );  
                	
                	if ( empty( $elements ) )
                	   $elements = $value['std'];
                	
                	//yiw_debug($elements);
					
					//echo '<pre>', print_r($fields), '</pre>';
                ?>
                
                    <div <?php echo $id_container ?>class="rm_option rm_input rm_contact<?php echo $class_dep ?>">
					
						<p>
							<?php _e( 'Use this table to compose your home page.', 'yiw' ) ?>
						</p> 
                    
					    <table class="wp-list-table widefat fixed posts" cellpadding="0">
					    	<thead>
					    		<tr>                                                     
					    			<th scope="col" class="name-field"><?php _e( 'Element', 'yiw' ) ?></th>
					    			<th scope="col" class="info-field"><?php _e( 'Visibile', 'yiw' ) ?></th>
					    			<th scope="col" class="controls-field">&nbsp;</th>
								</tr>	
					    	</thead>
					    	<tbody>
					    	
							<?php if( !empty( $elements ) ) : ?>	
					    		<?php foreach( $elements as $id => $element ) : ?>
								<tr<?php if( $id % 2 ) echo ' class="alternate"'; ?> valign="top">             
					    			<th class="name-field" scope="row">
                                        <?php echo $element['name'] ?>
                                        <input type="hidden" name="<?php yiw_option_name( $value['id'] ); ?>[<?php echo $id ?>][name]" value="<?php echo $element['name'] ?>" />
                                        <input type="hidden" name="<?php yiw_option_name( $value['id'] ); ?>[<?php echo $id ?>][slug]" value="<?php echo $element['slug'] ?>" />
                                    </th>
					    			<td class="info-field">  
                                        <select name="<?php yiw_option_name( $value['id'] ); ?>[<?php echo $id ?>][visible]" style="width:auto;">
                                            <option value="yes"<?php selected( $element['visible'], 'yes' ) ?> style="padding-right:10px;"><?php _e( 'Yes', 'yiw' ) ?></option>
                                            <option value="no"<?php selected( $element['visible'], 'no' ) ?> style="padding-right:10px;"><?php _e( 'No', 'yiw' ) ?></option>
                                        </select>
                                    </td>
					    			<td class="controls-field">      
										<span class="items-ord">                          
											<?php if( $id != 0 ) : ?>
											<a href="?page=<?php echo $_GET['page'] ?>&tab=<?php echo $current_tab ?>&action=array-ord&id=<?php echo $value['id'] ?>&dir=up&from=<?php echo $id ?>" class="item-move-up"><abbr title="<?php _e( 'Move up', 'yiw' ) ?>">&#8593;</abbr></a>   
											<?php else: ?>
											&nbsp;
											<?php endif; ?> 
											|                                     
											<?php if( $id != count( $elements ) - 1 ) : ?>
											<a href="?page=<?php echo $_GET['page'] ?>&tab=<?php echo $current_tab ?>&action=array-ord&id=<?php echo $value['id'] ?>&dir=down&from=<?php echo $id ?>" class="item-move-down"><abbr title="<?php _e( 'Move down', 'yiw' ) ?>">&#8595;</abbr></a>   
											<?php else: ?>
											&nbsp;
											<?php endif; ?>                                                                 
										</span>
									</td>
					    		</tr>
					    		<?php endforeach ?>
					    	<?php else : ?>
					    		<tr>
					    			<td colspan="4"><?php _e( 'No elements available.', 'yiw' ) ?></td>
					    		</tr>
					    	<?php endif ?>
					    		
					    	</tbody>
						</table>              
						    
                    	<?php echo $fade_color_dep ?>
                	</div>    
                     
                <?php
                    break;    
                
                
                // ================== INCLUDE =====================
                case 'include':
                	
                	if ( file_exists( $value['file'] ) )
                	   include $value['file'];
                	   
                    break; 
                
                
                
                default :
                	
					do_action( 'yiw_panel_type_' . $value['type'], $value );	
                                           
                }
            }
        }
    ?>
    
    <?php if ( $show_form ) : ?>                                                                                                             
        <input type="hidden" name="action" value="save" />
        <input type="submit" value="<?php _e( 'Save changes', 'yiw' ) ?>" class="button-primary" style="float:left;" />
    </form>
    
    <form method="post">
        <div class="submit">
        	<?php $warning = __( 'If you continue with this action, you will reset all options are in this page.', 'yiw' ) ?>
            <input name="reset" type="submit" value="<?php _e("Reset", 'yiw') ?>" title="<?php echo $warning ?>" onclick="return confirm('<?php echo $warning . '\n' . __( 'Are you sure of it?', 'yiw' ) ?>');" />
            <input type="hidden" name="action" value="reset" />
        </div>
    </form>
    <?php endif; ?>
    
    <div class="clear"></div>
    
    <div style="font-size:9px; margin-bottom:10px;">
        Icons: <a href="http://www.woothemes.com/2009/09/woofunction/">WooFunction</a></div>
    </div> 
    
    <?php if ( ! empty( $deps ) ) : // all deps script ?>
    <script type="text/javascript">
    	var deps_options = new Array(); 
    	<?php 
			foreach( $deps as $id => $dep ) {
				echo "deps_options[\"$id-option\"] = new Array();\n";
				foreach( $dep as $arg => $value )
					echo "deps_options[\"$id-option\"][\"$arg\"] = \"$value\";\n";  
			}
		?>
    </script>
    <?php endif; ?>
    

<?php
}

?>