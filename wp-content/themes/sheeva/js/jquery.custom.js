jQuery(document).ready(function($){ 

    $('body').removeClass('no_js').addClass('yes_js');   
    
    var show_dropdown = function()
    {        
        var options;
        
        containerWidth = $('#header').width();
        marginRight = $('#nav ul.level-1 > li').css('margin-right');
        submenuWidth = $('#nav ul.sub-menu').width();
        offsetMenuRight = $(this).position().left + submenuWidth;
        leftPos = -18;
        
        if ( offsetMenuRight > containerWidth )
            options = { left:leftPos - ( offsetMenuRight - containerWidth ) };    
        else
            options = {};
        
        $('ul.sub-menu:not(ul.sub-menu li > ul.sub-menu), ul.children:not(ul.children li > ul.children)', this).css(options).stop(true, true).fadeIn(300);    
    }
    
    var hide_dropdown = function()
    {
        $('ul.sub-menu:not(ul.sub-menu li > ul.sub-menu), ul.children:not(ul.children li > ul.children)', this).fadeOut(300);    
    }
        
    $('#nav ul > li').hover( show_dropdown, hide_dropdown );              
    
    $('#nav ul > li').each(function(){
        if( $('ul', this).length > 0 )
            $(this).children('a').append('<span class="sf-sub-indicator"> &raquo;</span>')
    }); 
    
    $('#nav li ul.sub-menu li, #nav li ul.children li').hover(
        function()
        {                  
            var options;
            
            containerWidth = $('#header').width();
            containerOffsetRight = $('#header').offset().left + containerWidth;
            submenuWidth = $('ul.sub-menu, ul.children', this).parent().width();
            offsetMenuRight = $(this).offset().left + submenuWidth * 2;
            leftPos = -10;
            
            if ( offsetMenuRight > containerOffsetRight )
                $(this).addClass('left');
                
            $('ul.sub-menu, ul.children', this).stop(true, true).fadeIn(300);
        },
    
        function()
        {
            $('ul.sub-menu, ul.children', this).fadeOut(300);
        }
    );             
	
	if ( $('body').hasClass('isMobile') && ! $('body').hasClass('iphone') && ! $('body').hasClass('ipad') )
        $('.sf-sub-indicator').parent().click(function(){   
            $(this).paretn().toggle( show_dropdown, function(){ document.location = $(this).children('a').attr('href') } )
        });

    function yiw_lightbox()
    {   
        $('a.thumb.video, a.thumb.img').hover(
                                
            function()
            {
                $('<a class="zoom">zoom</a>').appendTo(this).css({
                    dispay:'block', 
                    opacity:0, 
                    height:$(this).children('img').height(), 
                    width:$(this).children('img').width(),
                    'top':$(this).css('padding-top'),
                    'left':$(this).css('padding-left'),
                    padding:0}).animate({opacity:0.4}, 500);
            },
            
            function()
            {           
                $('.zoom').fadeOut(500, function(){$(this).remove()});
            }
        );
        
        jQuery("a[rel^='prettyPhoto']").prettyPhoto({
            slideshow:5000,
            theme: yiw_prettyphoto_style, 
            autoplay_slideshow:false,
            deeplinking: false,
            show_title:false
        });
    }
    
    yiw_lightbox();
    
    // searchform on header    // autoclean labels
    $elements = $('#header #s, .autoclear');
    
    $elements.each(function(){
        if( $(this).val() != '' )   
            $(this).prev().css('display', 'none');
    }); 
    $elements.focus(function(){
        if( $(this).val() == '' )   
            $(this).prev().css('display', 'none');
    }); 
    $elements.blur(function(){ 
        if( $(this).val() == '' )   
            $(this).prev().css('display', 'block');
    }); 

    $('a.socials, a.socials-small').tipsy({fade:true, gravity:'s'});
    
    $('.toggle-content:not(.opened), .content-tab:not(.opened)').hide(); 
    $('.tab-index a').click(function(){           
        $(this).parent().next().slideToggle(300, 'easeOutExpo');
        $(this).parent().toggleClass('tab-opened tab-closed');
        $(this).attr('title', ($(this).attr('title') == 'Close') ? 'Open' : 'Close');
        return false;
    });   
    
    // gallery hover
    $(".gallery-wrap .internal_page_item .overlay").css({opacity:0});
	$(".gallery-wrap .internal_page_item").live( 'mouseover mouseout', function(event){ 
		if ( event.type == 'mouseover' ) $('.overlay', this).show().stop(true,false).animate({ opacity: 1 }, "fast"); 
		if ( event.type == 'mouseout' )  $('.overlay', this).animate({ opacity: 0 }, "fast", function(){ $(this).hide() }); 
	});
    
	$('.tabs-container').yiw_tabs({
        tabNav  : 'ul.tabs',
        tabDivs : '.border-box'
    });
    
    $('#slideshow images img').show();
    
    // slider
    //if ( $("#slider ul").length > 0 ) {
    if( typeof(yiw_slider_type) != 'undefined' ) {
        if( yiw_slider_type == 'elegant' ) {
            $("#slider ul").cycle({                                                    
                easing  : yiw_slider_elegant_easing,
                fx      : yiw_slider_elegant_fx,
                speed   : yiw_slider_elegant_speed,
                timeout : yiw_slider_elegant_timeout,
                before  : function(currSlideElement, nextSlideElement, options, forwardFlag) {
                    var width = parseInt( $('.slider-caption', currSlideElement).outerWidth() );
                    var height = parseInt( $('.slider-caption', currSlideElement).outerHeight() );
                    
                    $('.caption-top', currSlideElement).animate({top:height*-1}, yiw_slider_elegant_caption_speed);
                    $('.caption-bottom', currSlideElement).animate({bottom:height*-1}, yiw_slider_elegant_caption_speed);
                    $('.caption-left', currSlideElement).animate({left:width*-1}, yiw_slider_elegant_caption_speed);
                    $('.caption-right', currSlideElement).animate({right:width*-1}, yiw_slider_elegant_caption_speed);
                },
                after   : function(currSlideElement, nextSlideElement, options, forwardFlag) {
                    $('.caption-top', nextSlideElement).animate({top:0}, yiw_slider_elegant_caption_speed);
                    $('.caption-bottom', nextSlideElement).animate({bottom:0}, yiw_slider_elegant_caption_speed);
                    $('.caption-left', nextSlideElement).animate({left:0}, yiw_slider_elegant_caption_speed);
                    $('.caption-right', nextSlideElement).animate({right:0}, yiw_slider_elegant_caption_speed);
                }
            });
        } else if( yiw_slider_type == 'cycle') {
            $('#slider .images').cycle({
                fx      : yiw_slider_cycle_fx,
                speed   : yiw_slider_cycle_speed,
                timeout : yiw_slider_cycle_timeout,
                easing  : yiw_slider_cycle_easing,
                pager   : '.pagination',
                cleartype: true
            });                   
        
            $('#slider-pause').show();
                            
            $('#slider-pause').click(function(){
                $('#slider .images').cycle('pause');
                $(this).hide();
                $('#slider-play').show();
                return false;
            });
                            
            $('#slider-play').click(function(){
                $('#slider .images').cycle('resume');
                $(this).hide();
                $('#slider-pause').show();    
                return false;
            });
        } else if( yiw_slider_type == 'unoslider' ) {
            $('#slider ul').unoslider({
                width       : yiw_slider_unoslider_width,
                height      : yiw_slider_unoslider_height,
                responsive  : yiw_slider_unoslider_responsive,
                indicator   : yiw_slider_unoslider_indicator,
                navigation  : yiw_slider_unoslider_navigation,
                slideshow   : yiw_slider_unoslider_slideshow,
                animation   : yiw_slider_unoslider_animation,
                preset      : yiw_slider_unoslider_preset,
                order       : 'random',
                tooltip     : true
            });
        } else if(yiw_slider_type == 'sheeva' ) {
            
            if( $.browser.msie && parseInt($.browser.version.substr(0,1),10) <= '8' ) {
                $('.slider').anythingSlider({
                     expand              : true,
                     startStopped        : false,
                     buildArrows         : yiw_slider_sheeva_directionNav,
                     buildNavigation     : false,
                     buildStartStop      : false,
                     delay               : yiw_slider_sheeva_timeout,
                     animationTime       : yiw_slider_sheeva_speed,
                     easing              : yiw_slider_sheeva_fx,
                     autoPlay            : yiw_slider_sheeva_autoplay ? true : false,
                     pauseOnHover        : true, 
                     toggleArrows        : false,
                     resizeContents      : true
                });
            } else {
                $('.slider').anythingSlider({
                     expand              : true,
                     startStopped        : false,
                     buildArrows         : yiw_slider_sheeva_directionNav,
                     buildNavigation     : false,
                     buildStartStop      : false,
                     delay               : yiw_slider_sheeva_timeout,
                     animationTime       : yiw_slider_sheeva_speed,
                     easing              : yiw_slider_sheeva_fx,
                     autoPlay            : yiw_slider_sheeva_autoplay ? true : false,
                     pauseOnHover        : true, 
                     toggleArrows        : yiw_slider_sheeva_directionNavHide ? true : false,
                     onSlideComplete     : function(slider){},
                     resizeContents      : true,
                     onSlideBegin        : function(slider) {
//                        var div = $(".activePage  .slide-content-holder-content")



//                         $(".slide-content-holder > div")
//                            .fadeTo( 300, 0);
                     },
                     onSlideComplete     : function(slider) {

//                        var div = $(".activePage  .slide-content-holder-content");
//                        div.show("slide", { direction: "left" }, 1000);


//                         var margin = parseInt($(".activePage .slide-content-holder > div").css('margin-left').replace(/[^-\d\.]/g, ''),10);
//                         $(".activePage .slide-content-holder > div").css('margin-left', (margin+1500) + 'px');
//                         $(".activePage .slide-content-holder > div").animate({"left": "-=1500px", "opacity" : "1"}, "slow");
                     }
                });
                
            }
            

             
        } else if ( yiw_slider_type == 'elastic' ) {
    		$('#slider.elastic').eislideshow({
				easing		: 'easeOutExpo',
				titleeasing	: 'easeOutExpo',
				titlespeed	: 1200,
				autoplay	: yiw_slider_elastic_autoplay,
				slideshow_interval : yiw_slider_elastic_timeout,
				speed       : yiw_slider_elastic_speed,
				animation   : yiw_slider_elastic_animation
// 				slidesLoaded: function() {
//                     $('.ei-slider .ei-slider-loading').hide();
//                 }
            });
        }
    }
    
    
    
    $('a img').hover(function(){ 
        if ( $(this).parent().parent().attr('id') == 'logo' || $(this).parent().parent().parent().parent().parent().attr('id') == 'slider' )
            return;
    //$('.home_item_portfolio img').hover(function(){
        $(this).stop().animate({opacity: 0.65}, 700);
    }, function(){
        $(this).stop().animate({opacity: 1});
    });

});             

// tabs plugin
(function($) {
    $.fn.yiw_tabs = function(options) {
        // valori di default
        var config = {
            'tabNav': 'ul.tabs',
            'tabDivs': '.containers',
            'currentClass': 'current'
        };      
 
        if (options) $.extend(config, options);
    	
    	this.each(function() {   
        	var tabNav = $(config.tabNav, this);
        	var tabDivs = $(config.tabDivs, this);
        	var activeTab;
        	var maxHeight = 0;
        	
        	// height of tabs
//         	$('li', tabNav).each(function(){
//                 var tabHeight = $(this).height();
//                 if ( tabHeight > maxHeight )
//                     maxHeight = tabHeight;
//             });
//             $('li h4', tabNav).each(function(){
//                 $(this).height(maxHeight-40);
//             });
        	
            tabDivs.children('div').hide();
    	
    	    if ( $('li.'+config.currentClass+' a', tabNav).length > 0 )
               activeTab = '#' + $('li.'+config.currentClass+' a', tabNav).attr('href').split('#')[1]; 
        	else
        	   activeTab = '#' + $('li:first-child a', tabNav).attr('href').split('#')[1];
                        
        	$(activeTab).show().addClass('showing');
            $('li:first-child a', tabNav).parents('li').addClass(config.currentClass);
        	
        	$('a', tabNav).click(function(){
        		var id = '#' + $(this).attr('href').split('#')[1];
        		var thisLink = $(this);
        		
        		$('li.'+config.currentClass, tabNav).removeClass(config.currentClass);
        		$(this).parents('li').addClass(config.currentClass);
        		
        		$('.showing', tabDivs).fadeOut(200, function(){
        			$(this).removeClass('showing');
        			$(id).fadeIn(200).addClass('showing');
        		});
        		
        		return false;
        	});   
        });
    }
})(jQuery);                   

(function($) {                                     
        
    $.fn.sorted = function(customOptions) {
        var options = {
            reversed: false,
            by: function(a) {
                return a.text();
            }
        };

        $.extend(options, customOptions);

        $data = jQuery(this);
        arr = $data.get();
        arr.sort(function(a, b) {

            var valA = options.by($(a));
            var valB = options.by($(b));
    
            if (options.reversed) {
                return (valA < valB) ? 1 : (valA > valB) ? -1 : 0;              
            } else {        
                return (valA < valB) ? -1 : (valA > valB) ? 1 : 0;  
            }
    
        });

        return $(arr);

    };

})(jQuery);

jQuery(function($) {
    
    //yiw_lightbox();


    var read_button = function(class_names) {
        
        var r = {
            selected: false,
            type: 0
        };
        
        for (var i=0; i < class_names.length; i++) {
            
            if (class_names[i].indexOf('selected-') == 0) {
                r.selected = true;
            }
        
            if (class_names[i].indexOf('segment-') == 0) {
                r.segment = class_names[i].split('-')[1];
            }
        };
        
        return r;
        
    };

    var determine_sort = function($buttons) {
        var $selected = $buttons.parent().filter('[class*="selected-"]');
        return $selected.find('a').attr('data-value');
    };

    var determine_kind = function($buttons) {
        var $selected = $buttons.parent().filter('[class*="selected-"]');
        return $selected.find('a').attr('data-value');
    };

    var $preferences = {
        duration: 500,
        adjustHeight: 'auto'
    }

    var $list = jQuery('.gallery-wrap');
    var $data = $list.clone();

    var $controls = jQuery('.portfolio-categories, .gallery-categories');

    $controls.each(function(i) {

        var $control = jQuery(this);
        var $buttons = $control.find('a');
        var height_list = $list.height();
        
        $('li:first-child', $control).addClass('selected');

        $buttons.bind('click', function(e) {

            var $button = jQuery(this);
            var $button_container = $button.parent();
            var button_properties = read_button($button_container.attr('class').split(' '));      
            var selected = button_properties.selected;
            var button_segment = button_properties.segment;

            if (!selected) {

                $buttons.parent().removeClass();
                $button_container.addClass('selected selected-' + button_segment).parent().children('li:first-child').addClass('first');

                var sorting_type = determine_sort($controls.eq(1).find('a'));
                var sorting_kind = determine_kind($controls.eq(0).find('a'));

                if (sorting_kind == 'all') {
                    var $filtered_data = $data.find('li');
                } else {
                    var $filtered_data = $data.find('li.' + sorting_kind);
                }

                var $sorted_data = $filtered_data.sorted({
                    by: function(v) {
                        return $(v).find('strong').text().toLowerCase();
                    }
                });

                $list.quicksand($sorted_data, $preferences, function () {
                        yiw_lightbox();
                        //Cufon.replace('#portfolio-gallery h6');   
                        
                        var current_height = $list.height();       
                        $('.hentry-post').animate( { 'min-height':$list.height() }, 300 );
                        
                        
                        
                        var postsPerRow = ( $('.layout-sidebar-right').length > 0 || $('.layout-sidebar-left').length > 0 ) ? 3 : 4;
                        
                        $('.gallery-wrap li')
                            .removeClass('group')
                            .each(function(i){
                                $(this).find('div')
                                    //.removeClass('internal_page_item_first') 
                                    .removeClass('internal_page_item_last');
                                
                                if( (i % postsPerRow) == 0 ) {
                                    //$(this).addClass('group');
                                    //$(this).find('div').addClass('internal_page_item_first'); 
                                } else if((i % postsPerRow) == 2) {
                                    $(this).find('div').addClass('internal_page_item_last');
                                }
                            });
                            
                        $('.gallery-wrap:first').css('height',0);
                        
                });
    
            }
    
            e.preventDefault();
            
        });
    
    }); 
    
});