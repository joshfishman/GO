﻿/*
Item Name: jQuery Carousel Evolution
Author: Mapalla
Author URI: http://codecanyon.net/user/Mapalla
Version: 1.0
*/

var CarouselSlider;

(function($){

    //object
    CarouselSlider = function(element, options){
        var settings = $.extend({}, $.fn.carousel.defaults, options),
            self = this,
            element = $(element),
            carousel = element.children('.slides');
            
        carousel.children('div').addClass('slideItem');
        var slideItems = carousel.children('.slideItem'),
            slideImage = slideItems.find('img'),
            currentSlide = 0,
            targetSlide = 0,
            numberSlides = slideItems.length,
            isAnimationRunning = false, 
            pause = true ;
            videos = {
                youtube: {
                    reg: /youtube\.com\/watch/i, 
                    split: '=', 
                    index: 1, 
                    url:'http://www.youtube.com/embed/%id%?autoplay=1&amp;fs=1&amp;rel=0'},
                vimeo: {
                    reg: /vimeo\.com/i, 
                    split: '/', 
                    index: 3, 
                    url: 'http://player.vimeo.com/video/%id%?portrait=0&amp;autoplay=1'}
            };
            
        this.current = currentSlide;
        this.length = numberSlides;
            
        /* _________________________________ */
    
        /* SETUP IMAGE SIZE */
        /* _________________________________ */
           
        var setImageSize = function(pos){
            var option = settings,
                w, h, imageSize;
            
            if (option.hAlign == 'center') {
                if (pos == 0){
                    w = option.frontWidth;
                    h = option.frontHeight;
                }
                else if (pos > 0 && pos <= Math.ceil((numberSlides-1)/2)){
                    var bImageSize = setImageSize(pos-1);
                    w = option.backZoom * bImageSize.width ;
                    h = option.backZoom * bImageSize.height ;
                }
                else {
                    w = setImageSize(numberSlides -pos).width;
                    h = setImageSize(numberSlides -pos).height;
                }
            }    
            else {
                //left & right
                if (pos == 0){
                    w = option.frontWidth;
                    h = option.frontHeight;
                }
                else if (pos == (numberSlides -1)){
                    w = option.frontWidth / option.backZoom;
                    h = option.frontHeight / option.backZoom;
                }
                else{
                    var bImageSize = setImageSize(pos-1);
                    w = option.backZoom * bImageSize.width ;
                    h = option.backZoom * bImageSize.height ;
                }
            }           
            
            return imageSize = {width:w, height:h};
        };
        
        /* _______________________________ */
        
        /* SETUP SLIDE SIZE */
        /* _______________________________ */
        
        var setSlideSize = function(pos){
            var option = settings,
                w, h,
                slideSize;
            
            if (option.hAlign == 'center'){
                if (pos == 0){
                    w = option.frontWidth;
                    h = option.frontHeight + reflectionHeight(pos) + shadowHeight(pos);
                }
                else if (pos > 0 && pos <= Math.ceil((numberSlides-1)/2)){
                    var imageSize = setImageSize(pos-1);
                    w = option.backZoom * imageSize.width ;
                    h = (option.backZoom * imageSize.height) + reflectionHeight(pos) + shadowHeight(pos);
                }
                else {
                    var size = setSlideSize(numberSlides -pos);
                    w = size.width;
                    h = size.height;
                }
            }    
            else {
                //left & right
                if (pos == 0){
                    w = option.frontWidth;
                    h = option.frontHeight + reflectionHeight(pos) + shadowHeight(pos);
                }
                else if (pos == (numberSlides -1)){
                    w = option.frontWidth / option.backZoom;
                    h = (option.frontHeight/option.backZoom) + reflectionHeight(pos) + shadowHeight(pos);
                }
                else{
                    var imageSize = setImageSize(pos-1);
                    w = option.backZoom * imageSize.width ;
                    h = (option.backZoom * imageSize.height) + reflectionHeight(pos) + shadowHeight(pos);
                }
            }            
            
            return slideSize = {width:w, height:h};
        };       
                        
        /* _______________________________ */
        
        /* SETUP SLIDE POSITION */       
        /* _______________________________ */
        
        var verticalHorizontalMargin = function(pos){
            var option = settings,
                vh, 
                imageSize = setImageSize(pos),
                vm = imageSize.height * option.vMargin,
                hm = imageSize.width * option.hMargin;            
            return vh = {vertical:vm, horizontal:hm};
        };
                
        var centerPos = function(pos){
            var option = settings,
                c = topPos(pos-1) + (setImageSize(pos-1).height - setImageSize(pos).height)/2;
            
            if (option.hAlign == 'left' || option.hAlign == 'right'){
                if (pos == (numberSlides -1)){
                    c = option.top - ((setImageSize(pos).height - setImageSize(0).height)/2);
                }
            }
            return c;            
        };
        
        var topPos = function(pos){
            var option = settings,
                t,
                vm = verticalHorizontalMargin(pos).vertical ; 
                
            if (option.hAlign == 'left' || option.hAlign == 'right'){
                if (pos == 0){
                    t = option.top;
                    if (option.vAlign == 'bottom'){
                        t = option.bottom;
                    }
                }
                else if (pos == (numberSlides -1)){
                    if (option.vAlign == 'center'){
                        t = centerPos(pos);
                    }
                    else {
                        t = centerPos(pos) - vm;
                    }                           
                }
                else{
                    if (option.vAlign == 'center'){
                        t = centerPos(pos);
                    }
                    else {
                        t = centerPos(pos) + vm ;
                    }                   
                }
            }
            else {
                //center
                if (pos == 0){
                    t = option.top;
                    if (option.vAlign == 'bottom'){
                        t = option.bottom;
                    }
                }
                else if (pos > 0 && pos <= Math.ceil((numberSlides-1)/2)){
                    if (option.vAlign == 'center'){
                        t = centerPos(pos);
                    }
                    else {
                        t = centerPos(pos) + vm;
                    }         
                }
                else{
                    t = topPos(numberSlides -pos);
                }                       
            }
                
            return t;        
        };
        
        var horizonPos = function(pos){
            var option = settings,
                hPos,
                mod = numberSlides % 2,
                endSlide = numberSlides / 2,
                hm = verticalHorizontalMargin(pos).horizontal;     
                       
            if (option.hAlign == 'center'){
                if (pos == 0){
                    hPos = (option.carouselWidth - option.frontWidth)/2;  
                }
                else if (pos > 0 && pos <= Math.ceil((numberSlides-1)/2)){
                    hPos = horizonPos(pos-1) - hm;
                    
                    if (mod == 0){
                        if (pos == endSlide){
                            hPos = (option.carouselWidth - setSlideSize(pos).width)/2 ;
                        }
                    }                
                }
                else{
                    hPos = (option.carouselWidth) - (horizonPos(numberSlides-pos)) - setSlideSize(pos).width;
                }                   
            }
            else {
                if (pos == 0){
                    hPos = option.left ;
                    if (option.hAlign == 'right'){
                        hPos = option.right;
                    }
                }
                else if (pos == (numberSlides -1)){
                    hPos = horizonPos(0) - setSlideSize(pos).width + setSlideSize(0).width - hm;
                }
                else{
                    hPos = (horizonPos(pos-1) + setSlideSize(pos-1).width) - setSlideSize(pos).width + hm;
                }
            }
                
            return hPos;           
        };
        
        var setOpacity = function(pos){
            var option = settings,
                op = 1;
                
            var hiddenSlide = numberSlides - option.slidesPerScroll; 
            if (hiddenSlide < 2){
                hiddenSlide = 2;
            }
            
            if (option.hAlign == 'center'){
                var lastSlide1 = (((numberSlides-1)/2)+1) - (hiddenSlide/2);
                var lastSlide2 = ((numberSlides-1)/2) + (hiddenSlide/2);
                if (pos >= lastSlide1 && pos <= lastSlide2){ 
                    op = 0;//0
                }
                else {
                    op = 1;
                }                              
            }
            else {
                if (pos < (numberSlides - hiddenSlide)){
                    op = 1 ;
                }
                else {
                    op = 0;//0
                }
            }
            
            return op;            
        };
        
        var setSlidePosition = function(pos) {
            var positions = new Array(),
                option = settings ;
                        
            for (var i = 0; i < numberSlides; i++){
                var slideSize = setSlideSize(i);
                if (option.hAlign == 'left'){
                    positions[i] = {width:slideSize.width, height:slideSize.height, top:topPos(i), left:horizonPos(i), opacity:setOpacity(i)};
                    if (option.vAlign == 'bottom'){
                        positions[i] = {width:slideSize.width, height:slideSize.height, bottom:topPos(i), left:horizonPos(i), opacity:setOpacity(i)} ;
                    }
                }
                else {
                    positions[i] = {width:slideSize.width, height:slideSize.height, top:topPos(i), right:horizonPos(i), opacity:setOpacity(i)} ;
                    if (option.vAlign == 'bottom'){
                        positions[i] = {width:slideSize.width, height:slideSize.height, bottom:topPos(i), right:horizonPos(i), opacity:setOpacity(i)} ;
                    }
                }
            }                                            
            return positions[pos];  
        };
        
        // returns the slide # at location i of the ith image
        var slidePos = function(i) {
            if (i < currentSlide){
                var pos = (i - currentSlide) + (numberSlides) ;
                return pos; 
            }
            else {
                pos = i - currentSlide ;
                return pos;
            }     
        };
        
        //returns z-index
        var zIndex = function(i){
            var z,
                hAlign = settings.hAlign;
                
            if (hAlign == 'left' || hAlign == 'right'){
                if (i == (numberSlides - 1)){
                    z = numberSlides - 1;
                }
                else {
                    z = numberSlides - (2+i);
                }
            }
            else if (hAlign == 'center'){
                if (i >= 0 && i <= ((numberSlides - 1)/2)){
                    z = (numberSlides - 1) - i;
                }
                else {
                    z = i - 1 ;
                }
            }                                
            return z;
        };
        
        /* ________________________________ */
        
        /* REFLECTION */
        /* ________________________________ */
        
        var reflectionHeight = function(pos){
            var refHeight = 0;
            if (settings.reflection == true){
                refHeight =  settings.reflectionHeight * setImageSize(pos).height;
            }
            return refHeight ;
        };
    
       var createReflectionContainer = function(){
            var slides = slideItems,
                x = numberSlides ;
            for (var i=0; i < x; i++){
                $('<div class="reflection"></div>')
                    .css({'position':'absolute', 'margin':'0', 'padding':'0', 'border':'none', 'overflow':'hidden', 'left':'0', 
                        'top':setImageSize(i).height+'px', 'width':'100%', 'height':reflectionHeight(i)})
                    .appendTo(slides.eq(i));
            }
        };
    
        var createImageReflection = function(){
            var reflection = slideItems.children('.reflection'),
                images = slideImage;
            
            for (var i=0; i<numberSlides; i++){
                var imgSrc = images.eq(i).attr('src'),
                    imageSize = setImageSize(i);
                $('<img src="'+ imgSrc +'" />')
                    .css({'width':imageSize.width+'px', 'height':imageSize.height+'px', 'left':'0','margin':'0', 'padding':'0', 'border':'none', '-moz-transform':'rotate(180deg) scale(-1,1)', 
                        '-webkit-transform':'rotate(180deg) scale(-1,1)', '-o-transform':'rotate(180deg) scale(-1,1)', 
                        'transform':'rotate(180deg) scale(-1,1)', 'filter': 'progid:DXImageTransform.Microsoft.BasicImage(rotation=2, mirror=1)', 
                        '-ms-filter': 'progid:DXImageTransform.Microsoft.BasicImage(rotation=2, mirror=1)'})
                    .appendTo(reflection.eq(i));
            }            
        };
    
        var createReflectGradient = function(){
            var slides = slideItems, 
                option = settings,
                reflectOpacity = option.reflectionOpacity,
                startColor = 'rgba('+option.reflectionColor+','+ reflectOpacity +')',
                endColor = 'rgba('+option.reflectionColor+',1)';
            
            var gradientStyle = '<style type="text/css">';
                gradientStyle += '.slideItem .gradient {';
                gradientStyle += 'position:absolute; left:0; top:0; margin:0; padding:0; border:none; width:100%; height:100%; ';
                gradientStyle += 'background: -moz-linear-gradient('+startColor+','+endColor+'); ';
                gradientStyle += 'background: -o-linear-gradient('+startColor+','+endColor+'); ';
                gradientStyle += 'background: -webkit-linear-gradient('+startColor+','+endColor+'); ';
                gradientStyle += 'background: -webkit-gradient(linear, 0% 0%, 0% 100%, from('+startColor+'), to('+endColor+')); ';
                gradientStyle += 'background: linear-gradient('+startColor+','+endColor+'); ';
                gradientStyle += '} ';
                gradientStyle += '.slideItem .reflection {';
                gradientStyle += 'filter: progid:DXImageTransform.Microsoft.Alpha(style=1,opacity='+(reflectOpacity*100)+',finishOpacity=0,startX=0,finishX=0,startY=0,finishY=100)';
                gradientStyle += '-ms-filter: progid:DXImageTransform.Microsoft.Alpha(style=1,opacity='+(reflectOpacity*100)+',finishOpacity=0,startX=0,finishX=0,startY=0,finishY=100)';
                gradientStyle += '}';
                gradientStyle += '</style>';
            
            $(gradientStyle).appendTo('head');
                               
            for (var i=0; i<numberSlides; i++){
                $('<div class="gradient"></div>').appendTo(slides.eq(i).children('.reflection'));
            }          
        };
        
        var animateReflection = function(option, item, i){
            var reflection = item.children('.reflection'),
                speed = option.speed,
                imageSize = setImageSize(slidePos(i));
            reflection.animate({'top':imageSize.height+'px', 'height':reflectionHeight(slidePos(i))}, speed, 'linear');
            reflection.children('img').animate(imageSize, speed, 'linear');        
        };
        
        /* ________________________________ */
        
        /* SHADOW */
        /* ________________________________ */
        
        var shadowHeight = function(pos){
            var sh = 0;
            if (settings.shadow == true){
                sh =  0.1 * setImageSize(pos).height;
            }
            return sh ;
        };
        
        var shadowMiddleWidth = function(pos){
            var w,
                shadow = slideItems.eq(pos).find('.shadow'),
                shadowLeft = shadow.children('.shadowLeft'),
                shadowRight = shadow.children('.shadowRight'),
                shadowMiddle = shadow.children('.shadowMiddle');
            return w = setImageSize(pos).width - (shadowLeft.width() + shadowRight.width());
        };
        
        var buildShadow = function(){
            var slides = slideItems, 
                x = numberSlides,
                shadowWidth = setImageSize(0).width,
                shadowInner = '<div class="shadowLeft"></div><div class="shadowMiddle"></div><div class="shadowRight"></div>';
                
            if (settings.hAlign == 'left' || settings.hAlign == 'right'){
                shadowWidth = setImageSize(numberSlides-1).width;
            }
                                       
            for (var i = 0; i < x; i++){
                var slide = slides.eq(i);
                $('<div class="shadow"></div>')
                    .css({'z-index':'-1', 'position':'absolute', 'margin':'0', 'padding':'0', 'border':'none', 'overflow':'hidden', 
                        'left':'0', 'bottom':'0'})
                    .append(shadowInner)
                    .width(shadowWidth)
                    .appendTo(slide);
                
                var shadow = slide.find('.shadow');
                shadow.children('div').css({'position':'relative', 'float':'left'});    
                var shadowMiddle = shadow.find('.shadowMiddle');
                shadowMiddle.width(shadowMiddleWidth(i));         
            }        
        };
        
        var animateShadow = function(option, item, i){
            var shadow = item.find('.shadow'),
                shadowMiddle = shadow.children('.shadowMiddle');
            
            shadowMiddle.animate({'width':shadowMiddleWidth(slidePos(i))+'px'}, option.speed, 'linear');
        };
        
        /* ________________________________ */
        
        /* DIRECTION BUTTONS */
        /* ________________________________ */
        
        var createPrevNextButtons = function(){
            var el = element ;
            el.append('<div class="nextButton"></div><div class="prevButton"></div>');
            el.children('.nextButton').bind('click', nextClick);
            el.children('.prevButton').bind('click', prevClick);        
        };
        
        var nextClick = function(event){
            goTo(currentSlide+1, true, false);
        };  
        
        var prevClick = function(event){
            goTo(currentSlide-1, true, false);
        };
        
        /* ________________________________ */
        
        /* BUTTON NAV */
        /* ________________________________ */   
        
        var createButtonNav = function(buttonName, activeClass){
            var el = element ;
            el.append('<div class="buttonNav"></div>');
            var buttonNav = el.children('.buttonNav') ;
                
            for (var i = 0; i < numberSlides; i++){
                var number = '';
                if (buttonName == 'numbers'){ number = i+1 ; }
            
                $('<div class="'+buttonName+'">'+number+'</div>')
                    .css({'text-align':'center'})
                    .bind('click', buttonNavClick)
                    .appendTo(buttonNav);                                   
            }
            
            var buttons = buttonNav.children('.'+buttonName);
            buttons.eq(0).addClass(activeClass)                    
            buttonNav.css({'width':numberSlides * buttons.outerWidth(true), 'height':buttons.outerHeight(true)});
        };
        
        var buttonNavState = function(){
            var option = settings,
                buttonNav = element.children('.buttonNav');
            if (option.buttonNav == 'numbers'){    
                //numbers
                var numberButtons = buttonNav.children('.numbers') ;
                numberButtons.removeClass('numberActive');
                numberButtons.eq(currentSlide).addClass('numberActive');
            }
            else if (option.buttonNav == 'bullets'){    
                //bullets
                var bulletButtons = buttonNav.children('.bullet') ;
                bulletButtons.removeClass('bulletActive');
                bulletButtons.eq(currentSlide).addClass('bulletActive');            
            }
        };
        
        var buttonNavClick = function(event){
            goTo($(this).index(), true, false);   
        };
        
        /* ________________________________ */
        
        /* DESCRIPTION */
        /* ________________________________ */
        
        var buildDescription = function(){
            var descContainer = $(settings.descriptionContainer),
                w = descContainer.width(), 
                h = descContainer.height(),
                descItems = descContainer.children('div'),
                descItemNumber = descItems.length;
                
                for (var i = 0; i < descItemNumber; i++){
                    descItems.eq(i)
                        .hide()
                        .css({'position':'absolute', 'top':'0', 'left':'0','width':w+'px', 'height':h+'px'});
                }
                
                descItems.eq(0).show();
        };
        
        var hideDescription = function(index){
            var option = settings ;
            if (option.description == true){
                var descContainer = $(option.descriptionContainer),
                    descItems = descContainer.children('div'),
                    description = descItems ;
                description.eq(index).hide();
            }
        };
        
        var showDescription = function(index){
            var option = settings ;
            if (option.description == true){
                var descContainer = $(option.descriptionContainer),
                    descItems = descContainer.children('div'),
                    description = descItems ;
                description.eq(index).show();
            } 
        };
        
        /* ___________________________________ */
        
        /* VIDEO */
        /* ___________________________________ */
        
        var buildSpinner = function(){
            var size = setImageSize(0);
            $('<div class="spinner"></div>')
                .hide()
                .css(setSlidePosition(0))
                .css({'width':size.width+'px', 'height':size.height+'px', 'z-index':numberSlides+3, 'position':'absolute', 
                    'cursor':'pointer', 'overflow':'hidden', 'padding':'0', 'margin':'0', 'border':'none'})            
                .appendTo(carousel);
        };
        
        var buildVideoOverlay = function(){
            var size = setImageSize(0);
            $('<div class="videoOverlay"></div>')
                .hide()
                .css(setSlidePosition(0))
                .css({'width':size.width+'px', 'height':size.height+'px', 'z-index':numberSlides+2, 'position':'absolute', 
                    'cursor':'pointer', 'overflow':'hidden', 'padding':'0', 'margin':'0', 'border':'none'})            
                .bind('click', videoOverlayClick)
                .appendTo(carousel);
        };
              
        var showVideoOverlay = function(index){
            if (slideItems.eq(index).children('a').hasClass('video')){
                carousel.children('.videoOverlay').show();
            } 
        };
    
        var hideVideoOverlay = function(){
            var car = carousel;
            car.children('.videoOverlay')
                .hide()
                .children().remove();
            car.children('.spinner').hide();
        };
    
        var getVideo = function(url){
            var videoTypes = videos,
                videoUrl;
 
            $.each(videoTypes, function(i, e){
                if (url.match(e.reg)){
                    var videoid = url.split(e.split)[e.index].split('?')[0].split('&')[0];
                    videoUrl = e.url.replace("%id%", videoid);
                }
            });
            return videoUrl ;
        };
    
        var addVideoContent = function(){
            var vc = carousel.children('.videoOverlay'),
                videoUrl = slideItems.eq(currentSlide).children('a').attr('href'),
                url = getVideo(videoUrl);
            
            $('<iframe></iframe>')
                .attr({'width':vc.width()+'px', 'height':vc.height()+'px', 'src':url, 'frameborder':'0'})
                .bind('load', videoLoad)
                .appendTo(vc);
        };
        
        var videoOverlayClick = function(event){
            addVideoContent();
            carousel.children('.spinner').show();
            $(this).hide();
            if (settings.autoplay == true){ 
                stopAutoplay();
                pause = false ;
            }
        };
        
        var videoLoad = function(event){
            var car = carousel;
            car.children('.videoOverlay').show();
            car.children('.spinner').hide();
        };        
                
        /* ________________________________ */
     
        /* AUTOPLAY */
        /* ________________________________ */
        
        var runAutoplay = function(){
            var option = settings ;
            intervalProcess = setInterval(function(){
                goTo(currentSlide+1, false, true);
            }, option.autoplayInterval);        
            
        };       
    
        var stopAutoplay = function(){
            if (settings.autoplay == true){
                clearInterval(intervalProcess);
                return ;
            }
        };                
        
        /* _________________________________ */
        
        /* ANIMATION */
        /* _________________________________ */
        
        var goTo = function(index, isStopAutoplay, isPause){
            if (isAnimationRunning == true){return;}
            var option = settings,
                x = numberSlides ;
            if (isStopAutoplay == true){ 
                stopAutoplay(); 
            }
            targetSlide = index;
            if (targetSlide == x){ targetSlide = 0; }
            if (targetSlide == -1){ targetSlide = x - 1; }
            option.before(self);
            rollSlide();  
            pause = isPause ;
        };
   
        //rolls to target index
        var rollSlide = function(){
            var option = settings;
            
            if (isAnimationRunning == true ){ return ; }
            
            if (currentSlide == targetSlide){
                isAnimationRunning = false ;
                return ;
            }
        
            isAnimationRunning = true ;
            
            hideDescription(currentSlide);       
        
            // direction
            if (currentSlide > targetSlide) {
                var stepForward = numberSlides - currentSlide + targetSlide,
                    stepBackward = currentSlide - targetSlide;
            } 
            else {
                var stepForward = targetSlide - currentSlide,
                    stepBackward = currentSlide + numberSlides - targetSlide ;
            }
            
            if (stepForward > stepBackward) {
                dir = -1;
            } 
            else {
                dir = 1;
            }
            
            currentSlide += dir;
            if (currentSlide == numberSlides) { currentSlide = 0; }
            if (currentSlide == -1) { currentSlide = numberSlides - 1; }
            
            var slideItem = slideItems ;
            
            hideVideoOverlay();
            buttonNavState();
            showDescription(currentSlide);
                    
            //animation    
            for (var i = 0; i < numberSlides; i++){
                animateImage(i);                    
            }        
        };
    
        var hideItem = function(slide){
            var op = slide.css('opacity');
            if (op == 0){ slide.hide();}    
        };
            
        var animateImage = function(i){
            var option = settings ;
            var item = slideItems.eq(i);
            item.show();
            item.animate(setSlidePosition(slidePos(i)), option.speed, 'linear', function(){
                hideItem($(this));            
                if (i == numberSlides - 1){
                    isAnimationRunning = false ;
                    if (currentSlide != targetSlide){ 
                        rollSlide();
                    }
                    else {
                        self.current = currentSlide ;
                        showVideoOverlay(currentSlide);
                        option.after(self);                  
                    }                                                                               
                }
            });
                
            item.css({'z-index':zIndex(slidePos(i))});
            slideImage.eq(i).animate(setImageSize(slidePos(i)), option.speed, 'linear');
            
            if (option.reflection == true){
                animateReflection(option, item, i);
            }
            
            if (option.shadow == true){
                animateShadow(option, item, i);
            }   
        };
        
        /* _________________________________ */
    
        /* LOAD CAROUSEL */
        /* _________________________________ */    
        
        var buildCarousel = function(){
            carousel.css({'width':settings.carouselWidth+'px', 'height':settings.carouselHeight+'px'});
    
            for (var i = 0; i < numberSlides; i++){
                var item = slideItems.eq(i);
                item.css(setSlidePosition(slidePos(i)));
                slideItems.eq(slidePos(i)).css({'z-index':zIndex(i)});
                slideImage.eq(i).css(setImageSize(slidePos(i)));
                    
                var op = item.css('opacity');
                if (op == 0){
                    item.hide();
                }
                else {
                    item.show();
                }                                   
            }            
        };
        
        var slideClick = function(event){
            var $this = $(this);
            if ($this.index() != currentSlide){
                goTo($this.index(), true, false);
                return false;
            }                          
        };
        
        var carouselMouseOver = function(event){
            var option = settings ;
            if (option.autoplay == true && option.pauseOnHover == true){
                stopAutoplay();
            }
        };
        
        var carouselMouseOut = function(event){
            var option = settings ;
            if (option.autoplay == true && option.pauseOnHover == true){
                if (pause == true){
                    runAutoplay();
                }
            }
        };       
        
        /* __________________________________ */
        
        /* INIT */
        /* __________________________________ */
        
        var initialize = function(){
            var option = settings ;
            buildCarousel();
            
            if (option.directionNav == true){
                createPrevNextButtons();
            }
            
            //create navigation button                
            if (option.buttonNav == 'numbers'){
                createButtonNav('numbers', 'numberActive');
            }
            else if (option.buttonNav == 'bullets') {
                createButtonNav('bullet', 'bulletActive');
            }
            
            if (option.reflection == true){
                createReflectionContainer();
                createImageReflection();
                createReflectGradient();
            }
            
            if (option.shadow == true){
                buildShadow();
            }
            
            if (option.description == true){
                buildDescription();
            }
            
            if (option.autoplay == true){
                runAutoplay();
            }
            
            buildSpinner();
            buildVideoOverlay();
            showVideoOverlay(currentSlide);
            
            //bind event
            slideItems.bind('click', option, slideClick);
            carousel
                .bind('mouseover', carouselMouseOver)
                .bind('mouseout', carouselMouseOut);
                
            // mouse wheel navigation
            if (settings.mouse == true){
                carousel.mousewheel(function(event, delta){
                    if (delta > 0){
                        prevClick();
                        return false ;
                    }
                    else if (delta < 0){
                        nextClick();
                        return false ;
                    }
                });
            }      
              
        };
        
        //public api
        this.prev = function(){
            prevClick();
        };
        
        this.next = function(){
            nextClick();
        };
        
        this.goTo = function(index){
            goTo(index, true, false);
        };
        
        this.pause = function(){
            stopAutoplay();
            pause = false ;
        };       
        
        this.resume = function(){
            if (settings.autoplay == true){
                runAutoplay();
            }
        }; 
        
        initialize();
        
       
    };//end object

//plugin
$.fn.carousel = function(options){
    
    var defaults = {hAlign:'center', vAlign:'center', hMargin:0.4, vMargin:0.2, 
                    frontWidth:400, frontHeight:300, carouselWidth:1000, carouselHeight:360, left:0, right:0, top:0, bottom:0,
                    backZoom:0.8, slidesPerScroll:5, speed:500, buttonNav:'none', directionNav:false,
                    autoplay:true, autoplayInterval:5000, pauseOnHover:true, mouse:true, shadow:false,
                    reflection:false, reflectionHeight:0.2, reflectionOpacity:0.5, reflectionColor:'255,255,255',
                    description:false, descriptionContainer:'.description', 
                    before: function(carousel){}, after: function(carousel){}};
    
    var options = $.extend(defaults, options);
    
    var returnArr = [];
    for(var i=0; i < this.length; i++){
        if(!this[i].carousel){
            this[i].carousel = new CarouselSlider(this[i], options);
        }
        returnArr.push(this[i].carousel);
    }
    return returnArr.length > 1 ? returnArr : returnArr[0];        
     

};//end plugin

})(jQuery);