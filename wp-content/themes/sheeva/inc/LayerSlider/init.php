    <script type="text/javascript">
    
    jQuery(document).ready(function(){
    	
    	<?php foreach($slides as $key => $val) : ?>
    	jQuery("#layerslider_<?php echo ($key+1) ?>").layerSlider({    		
   			autoStart			: <?php echo $val['properties']['autostart']?>,
   			pauseOnHover		: <?php echo $val['properties']['pauseonhover']?>,
			firstLayer			: <?php echo $val['properties']['firstlayer']?>,
			twoWaySlideshow		: <?php echo $val['properties']['twowayslideshow']?>,
    		keybNav				: <?php echo $val['properties']['keybnav']?>,
    		imgPreload			: <?php echo $val['properties']['imgpreload']?>,
    		navPrevNext			: <?php echo $val['properties']['navprevnext']?>,
    		navStartStop		: <?php echo $val['properties']['navstartstop']?>,
    		navButtons			: <?php echo $val['properties']['navbuttons']?>,
    		skin				: '<?php echo $val['properties']['skin']?>',
    		skinsPath			: '<?php echo YIW_LAYERSLIDER_URL?>/skins/'
    		<?php if(!empty($val['properties']['backgroundcolor']) || !empty($val['properties']['backgroundimage'])) : ?>,<?php endif; ?>
    		<?php if(!empty($val['properties']['backgroundcolor'])) : ?>
    		globalBGColor		: '<?php echo $val['properties']['backgroundcolor']?>'
 			<?php if(!empty($val['properties']['backgroundimage'])) : ?>,<?php endif; ?>
    		<?php endif; ?>
    		<?php if(!empty($val['properties']['backgroundimage'])) : ?>
    		globalBGImage		: '<?php echo $val['properties']['backgroundimage']?>'
    		<?php endif; ?>
    	});
    	<?php endforeach; ?>
    });
    
    </script>
    