<?php if(is_array($slides)) {
$data = '<div id="layerslider_'.$id.'" style="width: '.$slides['properties']['width'].'px; height: '.$slides['properties']['height'].'px;">';
	if(is_array($slides['layers'])) {
		foreach($slides['layers'] as $layerkey => $layer) {
		$data .= '<div class="ls-layer" style="slidedirection: '.$layer['properties']['slidedirection'].'; slidedelay: '.$layer['properties']['slidedelay'].'; durationin: '.$layer['properties']['durationin'].'; durationout: '.$layer['properties']['durationout'].'; easingin: '.$layer['properties']['easingin'].'; easingout: '.$layer['properties']['easingout'].'; delayin: '.$layer['properties']['delayin'].'; delayout: '.$layer['properties']['delayout'].';">';
		
			if(!empty($layer['properties']['background'])) { 
			$data .= '<img class="ls-bg" src="'.$layer['properties']['background'].'" alt="layer">';
			}
	
			if(is_array($layer['sublayers'])) {
				foreach($layer['sublayers'] as $sublayer) {
					if(!empty($sublayer['url'])) {
						$data .= '<a href="'.$sublayer['url'].'" target="'.$sublayer['target'].'" class="ls-s'.$sublayer['level'].'" style="position: absolute; top: '.$sublayer['top'].'px; left:'.$sublayer['left'].'px; slidedirection : '.$sublayer['slidedirection'].'; slideoutdirection : '.$sublayer['slideoutdirection'].'; parallaxin : '.$sublayer['parallaxin'].'; parallaxout : '.$sublayer['parallaxout'].'; durationin : '.$sublayer['durationin'].'; durationout : '.$sublayer['durationout'].'; easingin : '.$sublayer['easingin'].'; easingout : '.$sublayer['easingout'].'; delayin : '.$sublayer['delayin'].'; delayout : '.$sublayer['delayout'].';">';
							
							if(empty($sublayer['type']) || $sublayer['type'] == 'img') { 
								if(!empty($sublayer['image'])) {
									$data .= '<img src="'.$sublayer['image'].'" alt="sublayer">';
								}
							} else {
								$data .= '<'.$sublayer['type'].' class="ls-s'.$sublayer['level'].'" style="'.$sublayer['style'].'"> '.stripslashes($sublayer['html']).' </'.$sublayer['type'].'>';
							}
						$data .= '</a>';
					} else {
						if(empty($sublayer['type']) || $sublayer['type'] == 'img') {
							if(!empty($sublayer['image'])) {
								$data .= '<img class="ls-s'.$sublayer['level'].'" src="'.$sublayer['image'].'" alt="sublayer" style="position: absolute; top: '.$sublayer['top'].'px; left: '.$sublayer['left'].'px; slidedirection : '.$sublayer['slidedirection'].'; slideoutdirection : '.$sublayer['slideoutdirection'].'; parallaxin : '.$sublayer['parallaxin'].'; parallaxout : '.$sublayer['parallaxout'].'; durationin : '.$sublayer['durationin'].'; durationout : '.$sublayer['durationout'].'; easingin : '.$sublayer['easingin'].'; easingout : '.$sublayer['easingout'].'; delayin : '.$sublayer['delayin'].'; delayout : '.$sublayer['delayout'].';">';
							}
						} else {
							$data .= '<'.$sublayer['type'].' class="ls-s'.$sublayer['level'].'" style="position: absolute; top:'.$sublayer['top'].'px; left: '.$sublayer['left'].'px; slidedirection : '.$sublayer['slidedirection'].'; slideoutdirection : '.$sublayer['slideoutdirection'].'; parallaxin : '.$sublayer['parallaxin'].'; parallaxout : '.$sublayer['parallaxout'].'; durationin : '.$sublayer['durationin'].'; durationout : '.$sublayer['durationout'].'; easingin : '.$sublayer['easingin'].'; easingout : '.$sublayer['easingout'].'; delayin : '.$sublayer['delayin'].'; delayout : '.$sublayer['delayout'].'; '.$sublayer['style'].'"> '.stripslashes($sublayer['html']).' </'.$sublayer['type'].'>';
						}
					}
				}
			}
		$data .= '</div>';
		}
	}
$data .= '</div>';
}
?>