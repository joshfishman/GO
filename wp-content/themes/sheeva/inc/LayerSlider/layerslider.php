<?php
/**
 * @package LayerSlider
 * @version 1.6.0
 */
/*

Plugin Name: LayerSlider
Plugin URI: http://codecanyon.net/user/kreatura/
Description: WordPress plugin for LayerSlider
Version: 1.6.0
Author: Kreatura Media
Author URI: http://kreaturamedia.com/
*/

define( 'YIW_LAYERSLIDER_DIR', dirname(__FILE__) );    
define( 'YIW_LAYERSLIDER_URL', get_template_directory_uri() . '/inc/LayerSlider' );       
	
// retrocompatibilità
if(get_option('layerslider-slides') != false) {
   update_option('layerslider_slides', get_option('layerslider-slides'));
   delete_option('layerslider-slides');
}

//update_option('layerslider-slides', 'a:1:{i:0;a:2:{s:10:"properties";a:14:{s:5:"width";s:3:"960";s:6:"height";s:3:"500";s:9:"autostart";s:4:"true";s:12:"pauseonhover";s:4:"true";s:10:"firstlayer";s:1:"1";s:15:"twowayslideshow";s:4:"true";s:7:"keybnav";s:4:"true";s:10:"imgpreload";s:4:"true";s:11:"navprevnext";s:4:"true";s:12:"navstartstop";s:4:"true";s:10:"navbuttons";s:4:"true";s:4:"skin";s:9:"lightskin";s:15:"backgroundcolor";s:5:"white";s:15:"backgroundimage";s:5:"false";}s:6:"layers";a:3:{i:0;a:2:{s:10:"properties";a:10:{s:5:"title";s:8:"Layer #2";s:10:"background";s:62:"http://yourinspirationweb.com/demo/sheeva/files/2012/03/l3.jpg";s:14:"slidedirection";s:5:"right";s:10:"slidedelay";s:4:"4000";s:10:"durationin";s:4:"1500";s:11:"durationout";s:4:"1500";s:8:"easingin";s:14:"easeInOutQuint";s:9:"easingout";s:14:"easeInOutQuint";s:7:"delayin";s:1:"0";s:8:"delayout";s:1:"0";}s:9:"sublayers";a:11:{i:1;a:17:{s:4:"type";s:3:"img";s:3:"top";s:1:"0";s:4:"left";s:1:"0";s:5:"image";s:63:"http://yourinspirationweb.com/demo/sheeva/files/2012/03/l31.png";s:3:"url";s:0:"";s:6:"target";s:5:"_self";s:5:"level";s:1:"1";s:14:"slidedirection";s:5:"right";s:17:"slideoutdirection";s:6:"bottom";s:10:"parallaxin";s:3:".45";s:11:"parallaxout";s:3:".45";s:10:"durationin";s:4:"5800";s:11:"durationout";s:4:"1500";s:8:"easingin";s:11:"easeOutQuad";s:9:"easingout";s:14:"easeInOutQuint";s:7:"delayin";s:1:"0";s:8:"delayout";s:1:"0";}i:2;a:17:{s:4:"type";s:3:"img";s:3:"top";s:1:"0";s:4:"left";s:1:"0";s:5:"image";s:63:"http://yourinspirationweb.com/demo/sheeva/files/2012/03/l32.png";s:3:"url";s:0:"";s:6:"target";s:5:"_self";s:5:"level";s:1:"2";s:14:"slidedirection";s:5:"right";s:17:"slideoutdirection";s:6:"bottom";s:10:"parallaxin";s:3:".45";s:11:"parallaxout";s:3:".45";s:10:"durationin";s:4:"5600";s:11:"durationout";s:4:"1500";s:8:"easingin";s:11:"easeOutQuad";s:9:"easingout";s:14:"easeInOutQuint";s:7:"delayin";s:1:"0";s:8:"delayout";s:1:"0";}i:3;a:17:{s:4:"type";s:3:"img";s:3:"top";s:1:"0";s:4:"left";s:1:"0";s:5:"image";s:63:"http://yourinspirationweb.com/demo/sheeva/files/2012/03/l33.png";s:3:"url";s:0:"";s:6:"target";s:5:"_self";s:5:"level";s:1:"4";s:14:"slidedirection";s:5:"right";s:17:"slideoutdirection";s:6:"bottom";s:10:"parallaxin";s:3:".45";s:11:"parallaxout";s:3:".45";s:10:"durationin";s:4:"1200";s:11:"durationout";s:4:"1500";s:8:"easingin";s:14:"easeInOutQuint";s:9:"easingout";s:14:"easeInOutQuint";s:7:"delayin";s:1:"0";s:8:"delayout";s:1:"0";}i:4;a:17:{s:4:"type";s:3:"img";s:3:"top";s:1:"0";s:4:"left";s:1:"0";s:5:"image";s:63:"http://yourinspirationweb.com/demo/sheeva/files/2012/03/l34.png";s:3:"url";s:0:"";s:6:"target";s:5:"_self";s:5:"level";s:1:"6";s:14:"slidedirection";s:5:"right";s:17:"slideoutdirection";s:6:"bottom";s:10:"parallaxin";s:3:".45";s:11:"parallaxout";s:3:".45";s:10:"durationin";s:4:"1350";s:11:"durationout";s:4:"1500";s:8:"easingin";s:14:"easeInOutQuint";s:9:"easingout";s:14:"easeInOutQuint";s:7:"delayin";s:1:"0";s:8:"delayout";s:1:"0";}i:5;a:17:{s:4:"type";s:3:"img";s:3:"top";s:1:"0";s:4:"left";s:1:"0";s:5:"image";s:63:"http://yourinspirationweb.com/demo/sheeva/files/2012/03/l36.png";s:3:"url";s:0:"";s:6:"target";s:5:"_self";s:5:"level";s:1:"8";s:14:"slidedirection";s:5:"right";s:17:"slideoutdirection";s:6:"bottom";s:10:"parallaxin";s:3:".45";s:11:"parallaxout";s:3:".45";s:10:"durationin";s:4:"4000";s:11:"durationout";s:3:"800";s:8:"easingin";s:11:"easeOutExpo";s:9:"easingout";s:14:"easeInOutQuint";s:7:"delayin";s:1:"0";s:8:"delayout";s:2:"50";}i:6;a:17:{s:4:"type";s:3:"img";s:3:"top";s:1:"0";s:4:"left";s:1:"0";s:5:"image";s:63:"http://yourinspirationweb.com/demo/sheeva/files/2012/03/l35.png";s:3:"url";s:0:"";s:6:"target";s:5:"_self";s:5:"level";s:2:"10";s:14:"slidedirection";s:5:"right";s:17:"slideoutdirection";s:6:"bottom";s:10:"parallaxin";s:3:".45";s:11:"parallaxout";s:3:".45";s:10:"durationin";s:4:"5000";s:11:"durationout";s:3:"800";s:8:"easingin";s:11:"easeOutExpo";s:9:"easingout";s:14:"easeInOutQuint";s:7:"delayin";s:1:"0";s:8:"delayout";s:3:"100";}i:7;a:17:{s:4:"type";s:3:"img";s:3:"top";s:1:"0";s:4:"left";s:1:"0";s:5:"image";s:63:"http://yourinspirationweb.com/demo/sheeva/files/2012/03/l37.png";s:3:"url";s:0:"";s:6:"target";s:5:"_self";s:5:"level";s:2:"12";s:14:"slidedirection";s:5:"right";s:17:"slideoutdirection";s:6:"bottom";s:10:"parallaxin";s:3:".45";s:11:"parallaxout";s:3:".45";s:10:"durationin";s:4:"1500";s:11:"durationout";s:4:"1500";s:8:"easingin";s:14:"easeInOutQuint";s:9:"easingout";s:14:"easeInOutQuint";s:7:"delayin";s:1:"0";s:8:"delayout";s:1:"0";}i:8;a:17:{s:4:"type";s:3:"img";s:3:"top";s:1:"0";s:4:"left";s:1:"0";s:5:"image";s:63:"http://yourinspirationweb.com/demo/sheeva/files/2012/03/l38.png";s:3:"url";s:0:"";s:6:"target";s:5:"_self";s:5:"level";s:2:"14";s:14:"slidedirection";s:5:"right";s:17:"slideoutdirection";s:6:"bottom";s:10:"parallaxin";s:3:".45";s:11:"parallaxout";s:3:".45";s:10:"durationin";s:4:"1500";s:11:"durationout";s:4:"1500";s:8:"easingin";s:14:"easeInOutQuint";s:9:"easingout";s:14:"easeInOutQuint";s:7:"delayin";s:1:"0";s:8:"delayout";s:1:"0";}i:9;a:17:{s:4:"type";s:3:"img";s:3:"top";s:1:"0";s:4:"left";s:1:"0";s:5:"image";s:63:"http://yourinspirationweb.com/demo/sheeva/files/2012/03/l39.png";s:3:"url";s:0:"";s:6:"target";s:5:"_self";s:5:"level";s:2:"16";s:14:"slidedirection";s:5:"right";s:17:"slideoutdirection";s:6:"bottom";s:10:"parallaxin";s:3:".45";s:11:"parallaxout";s:3:".45";s:10:"durationin";s:4:"1500";s:11:"durationout";s:4:"1500";s:8:"easingin";s:14:"easeInOutQuint";s:9:"easingout";s:14:"easeInOutQuint";s:7:"delayin";s:1:"0";s:8:"delayout";s:1:"0";}i:10;a:17:{s:4:"type";s:3:"img";s:3:"top";s:1:"0";s:4:"left";s:1:"0";s:5:"image";s:64:"http://yourinspirationweb.com/demo/sheeva/files/2012/03/l310.png";s:3:"url";s:0:"";s:6:"target";s:5:"_self";s:5:"level";s:2:"18";s:14:"slidedirection";s:5:"right";s:17:"slideoutdirection";s:6:"bottom";s:10:"parallaxin";s:3:".45";s:11:"parallaxout";s:3:".45";s:10:"durationin";s:4:"1500";s:11:"durationout";s:4:"1500";s:8:"easingin";s:14:"easeInOutQuint";s:9:"easingout";s:14:"easeInOutQuint";s:7:"delayin";s:1:"0";s:8:"delayout";s:1:"0";}i:11;a:17:{s:4:"type";s:3:"img";s:3:"top";s:1:"0";s:4:"left";s:1:"0";s:5:"image";s:64:"http://yourinspirationweb.com/demo/sheeva/files/2012/03/l311.png";s:3:"url";s:0:"";s:6:"target";s:5:"_self";s:5:"level";s:2:"20";s:14:"slidedirection";s:5:"right";s:17:"slideoutdirection";s:6:"bottom";s:10:"parallaxin";s:3:".45";s:11:"parallaxout";s:3:".45";s:10:"durationin";s:4:"1500";s:11:"durationout";s:4:"1500";s:8:"easingin";s:14:"easeInOutQuint";s:9:"easingout";s:14:"easeInOutQuint";s:7:"delayin";s:1:"0";s:8:"delayout";s:1:"0";}}}i:1;a:2:{s:10:"properties";a:10:{s:5:"title";s:8:"Layer #1";s:10:"background";s:63:"http://yourinspirationweb.com/demo/sheeva/files/2012/03/l11.jpg";s:14:"slidedirection";s:5:"right";s:10:"slidedelay";s:4:"3000";s:10:"durationin";s:4:"1500";s:11:"durationout";s:4:"1500";s:8:"easingin";s:14:"easeInOutQuint";s:9:"easingout";s:14:"easeInOutQuint";s:7:"delayin";s:1:"0";s:8:"delayout";s:1:"0";}s:9:"sublayers";a:7:{i:1;a:17:{s:4:"type";s:3:"img";s:3:"top";s:1:"0";s:4:"left";s:1:"0";s:5:"image";s:64:"http://yourinspirationweb.com/demo/sheeva/files/2012/03/l111.png";s:3:"url";s:0:"";s:6:"target";s:5:"_self";s:5:"level";s:1:"1";s:14:"slidedirection";s:3:"top";s:17:"slideoutdirection";s:6:"bottom";s:10:"parallaxin";s:3:".45";s:11:"parallaxout";s:3:".45";s:10:"durationin";s:4:"2000";s:11:"durationout";s:4:"1500";s:8:"easingin";s:11:"easeOutExpo";s:9:"easingout";s:14:"easeInOutQuint";s:7:"delayin";s:4:"1000";s:8:"delayout";s:1:"0";}i:2;a:17:{s:4:"type";s:3:"img";s:3:"top";s:1:"0";s:4:"left";s:1:"0";s:5:"image";s:64:"http://yourinspirationweb.com/demo/sheeva/files/2012/03/l121.png";s:3:"url";s:0:"";s:6:"target";s:5:"_self";s:5:"level";s:1:"2";s:14:"slidedirection";s:6:"bottom";s:17:"slideoutdirection";s:6:"bottom";s:10:"parallaxin";s:3:".45";s:11:"parallaxout";s:3:".45";s:10:"durationin";s:4:"2300";s:11:"durationout";s:4:"1500";s:8:"easingin";s:14:"easeOutElastic";s:9:"easingout";s:14:"easeInOutQuint";s:7:"delayin";s:4:"1000";s:8:"delayout";s:1:"0";}i:3;a:17:{s:4:"type";s:3:"img";s:3:"top";s:3:"-88";s:4:"left";s:3:"111";s:5:"image";s:63:"http://yourinspirationweb.com/demo/sheeva/files/2012/03/l13.png";s:3:"url";s:0:"";s:6:"target";s:5:"_self";s:5:"level";s:1:"4";s:14:"slidedirection";s:4:"left";s:17:"slideoutdirection";s:6:"bottom";s:10:"parallaxin";s:3:".45";s:11:"parallaxout";s:3:".45";s:10:"durationin";s:4:"1500";s:11:"durationout";s:4:"1500";s:8:"easingin";s:14:"easeInOutQuint";s:9:"easingout";s:14:"easeInOutQuint";s:7:"delayin";s:1:"0";s:8:"delayout";s:1:"0";}i:4;a:17:{s:4:"type";s:3:"img";s:3:"top";s:1:"0";s:4:"left";s:1:"0";s:5:"image";s:64:"http://yourinspirationweb.com/demo/sheeva/files/2012/03/l151.png";s:3:"url";s:0:"";s:6:"target";s:5:"_self";s:5:"level";s:1:"6";s:14:"slidedirection";s:3:"top";s:17:"slideoutdirection";s:6:"bottom";s:10:"parallaxin";s:3:".45";s:11:"parallaxout";s:3:".45";s:10:"durationin";s:4:"1500";s:11:"durationout";s:4:"1500";s:8:"easingin";s:14:"easeInOutQuint";s:9:"easingout";s:14:"easeInOutQuint";s:7:"delayin";s:1:"0";s:8:"delayout";s:1:"0";}i:5;a:17:{s:4:"type";s:3:"img";s:3:"top";s:1:"0";s:4:"left";s:1:"0";s:5:"image";s:64:"http://yourinspirationweb.com/demo/sheeva/files/2012/03/l141.png";s:3:"url";s:0:"";s:6:"target";s:5:"_self";s:5:"level";s:1:"8";s:14:"slidedirection";s:3:"top";s:17:"slideoutdirection";s:6:"bottom";s:10:"parallaxin";s:3:".45";s:11:"parallaxout";s:3:".45";s:10:"durationin";s:4:"1500";s:11:"durationout";s:4:"1500";s:8:"easingin";s:14:"easeInOutQuint";s:9:"easingout";s:14:"easeInOutQuint";s:7:"delayin";s:1:"0";s:8:"delayout";s:1:"0";}i:6;a:17:{s:4:"type";s:3:"img";s:3:"top";s:3:"241";s:4:"left";s:2:"-7";s:5:"image";s:63:"http://yourinspirationweb.com/demo/sheeva/files/2012/03/l16.png";s:3:"url";s:0:"";s:6:"target";s:5:"_self";s:5:"level";s:2:"10";s:14:"slidedirection";s:6:"bottom";s:17:"slideoutdirection";s:6:"bottom";s:10:"parallaxin";s:3:".45";s:11:"parallaxout";s:3:".45";s:10:"durationin";s:4:"1500";s:11:"durationout";s:4:"1500";s:8:"easingin";s:14:"easeInOutQuint";s:9:"easingout";s:14:"easeInOutQuint";s:7:"delayin";s:1:"0";s:8:"delayout";s:1:"0";}i:7;a:17:{s:4:"type";s:3:"img";s:3:"top";s:4:"-184";s:4:"left";s:3:"614";s:5:"image";s:63:"http://yourinspirationweb.com/demo/sheeva/files/2012/03/l17.png";s:3:"url";s:0:"";s:6:"target";s:5:"_self";s:5:"level";s:2:"12";s:14:"slidedirection";s:3:"top";s:17:"slideoutdirection";s:6:"bottom";s:10:"parallaxin";s:3:".45";s:11:"parallaxout";s:3:".45";s:10:"durationin";s:4:"1500";s:11:"durationout";s:4:"1500";s:8:"easingin";s:14:"easeInOutQuint";s:9:"easingout";s:14:"easeInOutQuint";s:7:"delayin";s:1:"0";s:8:"delayout";s:1:"0";}}}i:2;a:2:{s:10:"properties";a:10:{s:5:"title";s:8:"Layer #3";s:10:"background";s:63:"http://yourinspirationweb.com/demo/sheeva/files/2012/03/l21.jpg";s:14:"slidedirection";s:3:"top";s:10:"slidedelay";s:4:"6000";s:10:"durationin";s:4:"1500";s:11:"durationout";s:4:"1500";s:8:"easingin";s:14:"easeInOutQuint";s:9:"easingout";s:14:"easeInOutQuint";s:7:"delayin";s:1:"0";s:8:"delayout";s:1:"0";}s:9:"sublayers";a:9:{i:1;a:17:{s:4:"type";s:3:"img";s:3:"top";s:1:"0";s:4:"left";s:1:"0";s:5:"image";s:63:"http://yourinspirationweb.com/demo/sheeva/files/2012/03/l21.png";s:3:"url";s:0:"";s:6:"target";s:5:"_self";s:5:"level";s:1:"1";s:14:"slidedirection";s:5:"right";s:17:"slideoutdirection";s:4:"left";s:10:"parallaxin";s:3:".45";s:11:"parallaxout";s:3:".45";s:10:"durationin";s:4:"1500";s:11:"durationout";s:4:"1500";s:8:"easingin";s:14:"easeInOutQuint";s:9:"easingout";s:14:"easeInOutQuint";s:7:"delayin";s:1:"0";s:8:"delayout";s:1:"0";}i:2;a:17:{s:4:"type";s:3:"img";s:3:"top";s:1:"0";s:4:"left";s:1:"0";s:5:"image";s:64:"http://yourinspirationweb.com/demo/sheeva/files/2012/03/l221.png";s:3:"url";s:0:"";s:6:"target";s:5:"_self";s:5:"level";s:1:"2";s:14:"slidedirection";s:5:"right";s:17:"slideoutdirection";s:4:"left";s:10:"parallaxin";s:3:".45";s:11:"parallaxout";s:3:".45";s:10:"durationin";s:4:"1500";s:11:"durationout";s:4:"1500";s:8:"easingin";s:14:"easeInOutQuint";s:9:"easingout";s:14:"easeInOutQuint";s:7:"delayin";s:1:"0";s:8:"delayout";s:1:"0";}i:3;a:17:{s:4:"type";s:3:"img";s:3:"top";s:1:"0";s:4:"left";s:1:"0";s:5:"image";s:64:"http://yourinspirationweb.com/demo/sheeva/files/2012/03/l231.png";s:3:"url";s:0:"";s:6:"target";s:5:"_self";s:5:"level";s:1:"4";s:14:"slidedirection";s:5:"right";s:17:"slideoutdirection";s:4:"left";s:10:"parallaxin";s:3:".45";s:11:"parallaxout";s:3:".45";s:10:"durationin";s:4:"1500";s:11:"durationout";s:4:"1500";s:8:"easingin";s:14:"easeInOutQuint";s:9:"easingout";s:14:"easeInOutQuint";s:7:"delayin";s:1:"0";s:8:"delayout";s:1:"0";}i:4;a:17:{s:4:"type";s:3:"img";s:3:"top";s:1:"0";s:4:"left";s:1:"0";s:5:"image";s:64:"http://yourinspirationweb.com/demo/sheeva/files/2012/03/l241.png";s:3:"url";s:0:"";s:6:"target";s:5:"_self";s:5:"level";s:1:"6";s:14:"slidedirection";s:5:"right";s:17:"slideoutdirection";s:4:"left";s:10:"parallaxin";s:3:".45";s:11:"parallaxout";s:3:".45";s:10:"durationin";s:4:"1500";s:11:"durationout";s:4:"1500";s:8:"easingin";s:14:"easeInOutQuint";s:9:"easingout";s:14:"easeInOutQuint";s:7:"delayin";s:1:"0";s:8:"delayout";s:1:"0";}i:5;a:17:{s:4:"type";s:3:"img";s:3:"top";s:1:"0";s:4:"left";s:1:"0";s:5:"image";s:64:"http://yourinspirationweb.com/demo/sheeva/files/2012/03/l251.png";s:3:"url";s:0:"";s:6:"target";s:5:"_self";s:5:"level";s:1:"8";s:14:"slidedirection";s:5:"right";s:17:"slideoutdirection";s:4:"left";s:10:"parallaxin";s:3:".45";s:11:"parallaxout";s:3:".45";s:10:"durationin";s:4:"1500";s:11:"durationout";s:4:"1500";s:8:"easingin";s:14:"easeInOutQuint";s:9:"easingout";s:14:"easeInOutQuint";s:7:"delayin";s:1:"0";s:8:"delayout";s:1:"0";}i:6;a:17:{s:4:"type";s:3:"img";s:3:"top";s:1:"0";s:4:"left";s:1:"0";s:5:"image";s:63:"http://yourinspirationweb.com/demo/sheeva/files/2012/03/l26.png";s:3:"url";s:0:"";s:6:"target";s:5:"_self";s:5:"level";s:2:"10";s:14:"slidedirection";s:5:"right";s:17:"slideoutdirection";s:4:"left";s:10:"parallaxin";s:3:".45";s:11:"parallaxout";s:3:".45";s:10:"durationin";s:4:"1500";s:11:"durationout";s:4:"1500";s:8:"easingin";s:14:"easeInOutQuint";s:9:"easingout";s:14:"easeInOutQuint";s:7:"delayin";s:1:"0";s:8:"delayout";s:1:"0";}i:7;a:17:{s:4:"type";s:3:"img";s:3:"top";s:1:"0";s:4:"left";s:1:"0";s:5:"image";s:63:"http://yourinspirationweb.com/demo/sheeva/files/2012/03/l27.png";s:3:"url";s:0:"";s:6:"target";s:5:"_self";s:5:"level";s:2:"12";s:14:"slidedirection";s:5:"right";s:17:"slideoutdirection";s:4:"left";s:10:"parallaxin";s:3:".45";s:11:"parallaxout";s:3:".45";s:10:"durationin";s:4:"1500";s:11:"durationout";s:4:"1500";s:8:"easingin";s:14:"easeInOutQuint";s:9:"easingout";s:14:"easeInOutQuint";s:7:"delayin";s:1:"0";s:8:"delayout";s:1:"0";}i:8;a:17:{s:4:"type";s:3:"img";s:3:"top";s:1:"0";s:4:"left";s:1:"0";s:5:"image";s:63:"http://yourinspirationweb.com/demo/sheeva/files/2012/03/l28.png";s:3:"url";s:0:"";s:6:"target";s:5:"_self";s:5:"level";s:2:"14";s:14:"slidedirection";s:5:"right";s:17:"slideoutdirection";s:4:"left";s:10:"parallaxin";s:3:".45";s:11:"parallaxout";s:3:".45";s:10:"durationin";s:4:"1500";s:11:"durationout";s:4:"1500";s:8:"easingin";s:14:"easeInOutQuint";s:9:"easingout";s:14:"easeInOutQuint";s:7:"delayin";s:1:"0";s:8:"delayout";s:1:"0";}i:9;a:17:{s:4:"type";s:3:"img";s:3:"top";s:1:"0";s:4:"left";s:1:"0";s:5:"image";s:63:"http://yourinspirationweb.com/demo/sheeva/files/2012/03/l29.png";s:3:"url";s:0:"";s:6:"target";s:5:"_self";s:5:"level";s:2:"16";s:14:"slidedirection";s:6:"bottom";s:17:"slideoutdirection";s:4:"left";s:10:"parallaxin";s:3:".45";s:11:"parallaxout";s:3:".45";s:10:"durationin";s:4:"1000";s:11:"durationout";s:4:"1500";s:8:"easingin";s:11:"easeOutExpo";s:9:"easingout";s:14:"easeInOutQuint";s:7:"delayin";s:4:"1500";s:8:"delayout";s:2:"50";}}}}}}');

/********************************************************/
/*                        Actions                       */
/********************************************************/
	                            
	// Link content resources
	add_action('wp_enqueue_scripts', 'layerslider_enqueue_content_res');

	// Link admin resources
	add_action('admin_enqueue_scripts', 'layerslider_enqueue_admin_res');

	// Register custom settings menu
	add_action('admin_menu', 'layerslider_settings_menu');
	
	// Widget action
	add_action( 'widgets_init', create_function( '', 'register_widget("LayerSlider_Widget");' ) );
	
	// Init LayerSlider
	add_action('wp_head', 'layerslider_js');
	
	// Add shortcode
	add_shortcode("layerslider","layerslider_init");

/********************************************************/
/*               Enqueue Content Scripts                */
/********************************************************/
	                                                
	function layerslider_enqueue_content_res() {
        if ( yiw_slider_type() != 'layers' )
            return;
        
		wp_enqueue_script('layerslider_js', YIW_LAYERSLIDER_URL . '/js/layerslider.kreaturamedia.jquery-min.js', array('jquery'), '1.0' );
		//wp_enqueue_script('layerslider_easing', YIW_LAYERSLIDER_URL . '/js/jquery-easing-1.3.js', array('jquery'), '1.0' );
		wp_enqueue_style('layerslider_css', YIW_LAYERSLIDER_URL . '/css/layerslider.css', array(), '1.0' );
	}


/********************************************************/
/*                Enqueue Admin Scripts                 */
/********************************************************/

	function layerslider_enqueue_admin_res() {
		
		if(strstr($_SERVER['REQUEST_URI'], 'layerslider')) {

			wp_enqueue_script('thickbox');
			wp_enqueue_style('thickbox');
			
			wp_enqueue_script('jquery-ui-tabs');
			wp_enqueue_script('jquery-ui-sortable');
			wp_enqueue_script('jquery-ui-draggable');

			wp_enqueue_script('layerslider_admin_js', YIW_LAYERSLIDER_URL . '/js/layerslider_admin.js', array('jquery'), '1.0' );
			wp_enqueue_style('layerslider_admin_css', YIW_LAYERSLIDER_URL . '/css/layerslider_admin.css', array(), '1.0' );
		}
	}


/********************************************************/
/*                 Loads settings menu                  */
/********************************************************/
function layerslider_settings_menu() {

	//create new top-level menu
	add_theme_page('LayerSlider', 'LayerSlider', 'edit_theme_options', 'yiw_layerslider', 'layerslider_settings_page');

	//call register settings function
	add_action( 'admin_init', 'layerslider_register_settings' );
}


/********************************************************/
/*                  Register settings                   */
/********************************************************/
function layerslider_register_settings() {

	if(isset($_POST['posted']) && strstr($_SERVER['REQUEST_URI'], 'layerslider')) {
		
		// Add option if it is not extists yet
		if(get_option('layerslider_slides') === false) {
			add_option('layerslider_slides', serialize($_POST['layerslider-slides']));
		
		// Update option
		} else {
			update_option('layerslider_slides', serialize($_POST['layerslider-slides']));
		}               
		
		// Redirect back
		//header('Location: '.$_SERVER['REQUEST_URI'].'');
		die();
	}
}


/********************************************************/
/*                  Settings page HTML                  */
/********************************************************/
function layerslider_settings_page() {

	include(dirname(__FILE__).'/settings.php');

} 


/********************************************************/
/*                  LayerSlider JS                    */
/********************************************************/

function layerslider_js() {      
    if ( yiw_slider_type() != 'layers' )
        return;
	
	$slides = unserialize(get_option('layerslider_slides'));
	$slides = empty($slides) ? array() : $slides;
	
	include(dirname(__FILE__).'/init.php');
}


/********************************************************/
/*                 LayerSlider init                  */
/********************************************************/

function layerslider_init($atts) {
	
	// Get slider ID
	$id = $atts['id'];
	$id = empty($id) ? 1 : $id;

	// Get slider data
	$slides = unserialize(get_option('layerslider_slides'));
	$slides = $slides[($id-1)];
	
	$data = '';
	
	// Include slider file
	include(dirname(__FILE__).'/slider.php');
	
	// Return data
	return $data;
}                          

/********************************************************/
/*                   Widget settings                    */
/********************************************************/

class LayerSlider_Widget extends WP_Widget {

	function LayerSlider_Widget() {
	
		$widget_ops = array( 'classname' => 'layerslider_widget', 'description' => __('LayerSlider Widget', 'layerslider') );
		$control_ops = array( 'id_base' => 'layerslider_widget' );
		$this->WP_Widget( 'layerslider_widget', __('LayerSlider Widget', 'layerslider'), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );


		echo $before_widget;

		if ( $title )
			echo $before_title . $title . $after_title;

		// Call layerslider_init to show the slider
		echo do_shortcode('[layerslider id="'.$instance['id'].'"]');
		
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['id'] = strip_tags( $new_instance['id'] );
		$instance['title'] = strip_tags( $new_instance['title'] );
		return $instance;
	}

	function form( $instance ) {

		$defaults = array( 'title' => __('LayerSlider', 'layerslider'));
		$instance = wp_parse_args( (array) $instance, $defaults );
		$slides = unserialize(get_option('layerslider_slides'));  ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'id' ); ?>">Choose a slider:</label><br>
			<select id="<?php echo $this->get_field_id( 'id' ); ?>" name="<?php echo $this->get_field_name( 'id' ); ?>">
				<?php foreach($slides as $key => $val) : ?>
				<?php if(($key+1) == $instance['id']) { ?>
				<option value="<?php echo ($key+1)?>" selected="selected">LayerSlider #<?php echo ($key+1)?></option>
				<?php } else { ?>
				<option value="<?php echo ($key+1)?>">LayerSlider #<?php echo ($key+1)?></option>
				<?php } ?>
				<?php endforeach; ?>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'hybrid'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
		</p>


	<?php
	}
}

?>