jQuery(document).ready(function($){
	"use strict";
	
	
	/* ---------------------------------------------------------------------- */
	/*	Search Script
	/* ---------------------------------------------------------------------- */
	$(".search-fld").on('click',function(){
		if($(this).hasClass('minus')){        
			$(this).toggleClass("plus minus");
			$('.search-wrapper-area').fadeOut();
		}else{
			$('.search-wrapper-area').fadeIn();
			$(this).toggleClass("minus plus");
		}
	});
	
	$(".kode_advance_search").on('click',function(){
		if($(this).hasClass('minus')){        
			$(this).toggleClass("plus minus");
			$('.kode_search_conainter_header_4').slideUp('slow');
		}else{
			$('.kode_search_conainter_header_4').slideDown('slow');
			$(this).toggleClass("minus plus");
		}
	});
	
	
	if($('.custom-form').length){
		$('.custom-form select').chosen();
	}
	
	if($('.chosen-select').length){
		$('.chosen-select').chosen();
	}
	
	if($('.kf_advacnce_search_form').length){
		$('.kf_advacnce_search_form select').chosen();
	}
	
	$(window).scroll(function(){
		if ($(this).scrollTop() > 100) {
			$('.kode-back-top').css('opacity','1');
		} else {
			$('.kode-back-top').css('opacity','0');
		}
	});
	
	//Click event to scroll to top
	$('.kode-back-top').on('click',function(){
		$('html, body').animate({scrollTop : 0},800);
		return false;
	});
	
	// runs countdown function
	$.fn.kodeproperty_countdown = function(){
		if(typeof($.fn.countdown) == 'function'){
			$(this).each(function(){
				var austDay = new Date();
				var data_year;
				var data_month;
				var data_day;
				var data_time;
				var current_day;
				
				// data-year duration
				if( $(this).attr('data-year') ){
					data_year = parseInt($(this).attr('data-year'));
				}
				//Month
				if( $(this).attr('data-month') ){
					data_month = parseInt($(this).attr('data-month'));
				}
				//day
				if( $(this).attr('data-day') ){
					data_day = parseInt($(this).attr('data-day'));
				}
				//time
				if( $(this).attr('data-time') ){
					data_time = parseInt($(this).attr('data-time'));
				}
						
				current_day = new Date(data_year, data_month-1, data_day,data_time);
				$(this).countdown({until: current_day});	
				jQuery('#year').text(current_day.getFullYear());
			});	
		}
	}
	
	//Tooltip Script bootstrap
	if($('[data-toggle="tooltip"]').length){
		$('[data-toggle="tooltip"]').tooltip();
	}
	
	// runs countdown function
	$.fn.kodeproperty_countdown_timmer = function(){
		if(typeof($.fn.downCount) == 'function'){
			$(this).each(function(){
				var austDay = new Date();
				var data_year;
				var data_month;
				var data_day;
				var data_time;
				var current_day;
				
				// data-year duration
				if( $(this).attr('data-year') ){
					data_year = parseInt($(this).attr('data-year'));
				}
				//Month
				if( $(this).attr('data-month') ){
					data_month = parseInt($(this).attr('data-month'));
				}
				//day
				if( $(this).attr('data-day') ){
					data_day = parseInt($(this).attr('data-day'));
				}
				//time
				if( $(this).attr('data-time') ){
					data_time = parseInt($(this).attr('data-time'));
				}
				
				var current_day = new Date(data_year, data_month-1, data_day,data_time);
				//$(this).downCount({ date: "'"+data_month+'/'+data_day+'/'+data_year+' '+data_time+"'", offset: +1 });
				$(this).downCount({ date: current_day, offset: +1 });
				
			});	
		}
	}
	

	$('.cart-option .widget_shopping_cart_content').hide();
	 //Header Search Area Function
    $('.cart-option a').on('click',function () {
        if ($(this).attr('id') == 'active-btn-shopping') {
            $(this).attr('id', 'no-active-btn-shopping');
            $(this).siblings('.widget_shopping_cart_content').slideUp();
        } else {
            $(this).attr('id', 'active-btn-shopping');
			$(this).siblings('.widget_shopping_cart_content').slideDown();
        }
    });
	
	
	// if($(".range").length){
		// $(".range").slider();
		// $(".range").on("slide", function(slideEvt) {
			// $(".range-slider").text(slideEvt.value);
		// });
	// }
	
	/*
	  =======================================================================
		  		Range Slider Script Script
	  =======================================================================
	*/
	if($('.slider-range').length){
		$( ".slider-range" ).slider({
			range: true,
			min: 0,
			max: 25000,
			values: [ 0, 25000 ],
		  slide: function( event, ui ) {
			$( ".amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
		  }
		});
		$( ".amount" ).val( "$" + $( ".slider-range" ).slider( "values", 0 ) +
		  " - $" + $( ".slider-range" ).slider( "values", 1 ) );
	}

	
	if($('.kode-navigation-sticky').length){
		// grab the initial top offset of the navigation 		
		var stickyNavTop = $('.kode-navigation-sticky').offset().top;
		// our function that decides weather the navigation bar should have "fixed" css position or not.
		var stickyNav = function(){
			var scrollTop = $(window).scrollTop(); // our current vertical position from the top
			// if we've scrolled more than the navigation, change its position to fixed to stick to top,
			// otherwise change it back to relative
			if (scrollTop > stickyNavTop) { 
				$('.kode-navigation-sticky').addClass('kf_sticky');
			} else {
				$('.kode-navigation-sticky').removeClass('kf_sticky'); 
			}
		};
		stickyNav();
		// and run it again every time you scroll
		$(window).scroll(function() {
			stickyNav();
		});
	
	}
	
	if($('.nav_one_page').length){
		$('.navigation .menu').singlePageNav({
			offset: 60,
			filter: ':not(li.external a)',
			updateHash: true,
			beforeStart: function() {
				console.log('begin scrolling');
			},
			onComplete: function() {
				console.log('done scrolling');
			}
		});
	}
	
	
	
	// runs bx slider function
	$.fn.kodeproperty_bxslider = function(){
		if(typeof($.fn.bxSlider) == 'function'){
			$(this).each(function(){
				var bx_attr = {
					mode: 'slide',
					auto: true,
					speed: 500,
					slideMargin:20,
					infiniteLoop: true,
					pager: false,
					controls: true,
					// prevText: '<i class="icon-angle-left" ></i>', 
					// nextText: '<i class="icon-angle-right" ></i>',
					// useCSS: false
				};
				
				// slide duration
				if( $(this).attr('data-pausetime') ){
					bx_attr.pause = parseInt($(this).attr('data-pausetime'));
				}
				if( $(this).attr('data-slidespeed') ){
					bx_attr.speed = parseInt($(this).attr('data-slidespeed'));
				}
				if( $(this).attr('data-mode') ){
					bx_attr.mode = $(this).attr('data-mode');
				}
				if( $(this).attr('data-min') ){
					bx_attr.minSlides = $(this).attr('data-min');
				}
				if( $(this).attr('data-width') ){
					bx_attr.slideWidth = $(this).attr('data-width');
				}
				if( $(this).attr('data-max') ){
					bx_attr.maxSlides = $(this).attr('data-max');
				}
				if( $(this).attr('data-margin') ){
					bx_attr.slideMargin = $(this).attr('data-margin');
				}
				if( $(this).attr('data-move') ){
					bx_attr.moveSlides = $(this).attr('data-move');
				}
				if( $(this).attr('data-auto') ){
					bx_attr.auto = $(this).attr('data-auto');
				}
				if( $(this).attr('data-ticker') ){
					bx_attr.ticker = false;
				}
				if( $(this).attr('data-tickerHover') ){
					bx_attr.tickerHover = $(this).attr('data-tickerHover');
				}
				$(this).bxSlider(bx_attr);	
			});				
			
			$(".bx-controls-direction .bx-prev").empty();
			$(".bx-controls-direction .bx-next").empty();
			$(".bx-controls-direction .bx-next").append('<i class="fa fa-angle-right"></i>');
			$(".bx-controls-direction .bx-prev").append('<i class="fa fa-angle-left"></i>');
			
		}
	}
	
	
	// runs bx slider function
	$.fn.kodeproperty_bxslider_pager = function(){
		if(typeof($.fn.bxSlider) == 'function'){
			$(this).each(function(){
				var bx_attr = {
					mode: 'slide',
					auto: true,
					speed: 500,
					slideMargin:20,
					infiniteLoop: true,
					pager: true,
					controls: true,
					// prevText: '<i class="icon-angle-left" ></i>', 
					// nextText: '<i class="icon-angle-right" ></i>',
					// useCSS: false
					 pagerCustom: '#property_detail_pager',
				};
				
				$(this).bxSlider({pagerCustom: '#property_detail_pager'});	
			});				
			
			
			
		}
	}
	
	
	
	
	
	// runs bx slider function
	$.fn.kodeproperty_bxslider_no_awesome = function(){
		if(typeof($.fn.bxSlider) == 'function'){
			$(this).each(function(){
				var bx_attr = {
					mode: 'slide',
					auto: true,
					speed: 500,
					slideMargin:20,
					infiniteLoop: true,
					pager: false,
					controls: true,
					// prevText: '<i class="icon-angle-left" ></i>', 
					// nextText: '<i class="icon-angle-right" ></i>',
					// useCSS: false
				};
				
				// slide duration
				if( $(this).attr('data-pausetime') ){
					bx_attr.pause = parseInt($(this).attr('data-pausetime'));
				}
				if( $(this).attr('data-slidespeed') ){
					bx_attr.speed = parseInt($(this).attr('data-slidespeed'));
				}
				if( $(this).attr('data-mode') ){
					bx_attr.mode = $(this).attr('data-mode');
				}
				if( $(this).attr('data-min') ){
					bx_attr.minSlides = $(this).attr('data-min');
				}
				if( $(this).attr('data-width') ){
					bx_attr.slideWidth = $(this).attr('data-width');
				}
				if( $(this).attr('data-max') ){
					bx_attr.maxSlides = $(this).attr('data-max');
				}
				if( $(this).attr('data-margin') ){
					bx_attr.slideMargin = $(this).attr('data-margin');
				}
				if( $(this).attr('data-move') ){
					bx_attr.moveSlides = $(this).attr('data-move');
				}
				if( $(this).attr('data-auto') ){
					bx_attr.auto = $(this).attr('data-auto');
				}
				if( $(this).attr('data-ticker') ){
					bx_attr.ticker = false;
				}
				if( $(this).attr('data-tickerHover') ){
					bx_attr.tickerHover = $(this).attr('data-tickerHover');
				}
				$(this).bxSlider(bx_attr);	
			});				
			
			$(".bx-controls-direction .bx-prev").empty();
			$(".bx-controls-direction .bx-next").empty();
			
		}
	}
	
	if( navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || 
		navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || 
		navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i) || 
		navigator.userAgent.match(/Windows Phone/i) ){ 
		var kodeproperty_touch_device = true; 
	}else{ 
		var kodeproperty_touch_device = false; 
	}
	
	// retrieve GET variable from url
	$.extend({
	  getUrlVars: function(){
		var vars = [], hash;
		var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
		for(var i = 0; i < hashes.length; i++)
		{
		  hash = hashes[i].split('=');
		  vars.push(hash[0]);
		  vars[hash[0]] = hash[1];
		}
		return vars;
	  },
	  getUrlVar: function(name){
		return $.getUrlVars()[name];
	  }
	});	
	
	// blog - port nav
	function kodeproperty_set_item_outer_nav(){
		$('.blog-item-wrapper > .kode-nav-container').each(function(){
			var container = $(this).siblings('.blog-item-holder');
			var child = $(this).children();
			child.css({ 'top':container.position().top, 'bottom':'auto', height: container.height() - 50 });
		});
		$('.portfolio-item-wrapper > .kode-nav-container').each(function(){
			var container = $(this).siblings('.portfolio-item-holder');
			var child = $(this).children();
			child.css({ 'top':container.position().top, 'bottom':'auto', height: container.height() - 40 });
		});		
	}

	
	/* ---------------------------------------------------------------------- */
	/*	Carousel
	/* ---------------------------------------------------------------------- */
	
	$.fn.kodeproperty_owl_carousel = function(){
		if(typeof($.fn.owlCarousel) == 'function'){
			$(this).each(function(){
				var option;
				var data_small;
				var data_margin
				if($(this).attr('data-slide')){
					option = $(this).attr('data-slide');
				}
				if($(this).attr('data-small-slide')){
					data_small = $(this).attr('data-small-slide');
				}
				if($(this).attr('data-margin')){
					data_margin = $(this).attr('data-margin');
				}
				var owl_attr = {
					autoPlay: 3000, //Set AutoPlay to 3 seconds
					margin:25,
					
					responsive:{
						0:{
							items:1
						},
						600:{
							items:data_small
						},
						1000:{
							items:option
						}
					}
				};
				
				$(this).owlCarousel(owl_attr);	
			});	
		}
	}
	
	/* ---------------------------------------------------------------------- */
	/*	Carousel
	/* ---------------------------------------------------------------------- */
	$.fn.kodeproperty_owl_carousel_no_space = function(){
		if(typeof($.fn.owlCarousel) == 'function'){
			$(this).each(function(){
				var option;
				var data_small;
				var data_margin;
				if($(this).attr('data-slide')){
					option = $(this).attr('data-slide');
				}
				if($(this).attr('data-small-slide')){
					data_small = $(this).attr('data-small-slide');
				}
				if($(this).attr('data-margin')){
					data_margin = $(this).attr('data-margin');
				}
				var nice_attr = {
					autoPlay: 3000, //Set AutoPlay to 3 seconds
					responsive:{
						0:{
							items:1
						},
						600:{
							items:data_small
						},
						1000:{
							items:option
						}
					}
				};				
				$(this).owlCarousel(nice_attr);	
			});	
		}
	}
	
	
	/* ---------------------------------------------------------------------- */
	/*	Carousel
	/* ---------------------------------------------------------------------- */
	$.fn.kodeproperty_owl_carousel_prop = function(){
		if(typeof($.fn.owlCarousel) == 'function'){
			$(this).each(function(){
				var option;
				var data_small;
				var data_margin;
				if($(this).attr('data-slide')){
					option = $(this).attr('data-slide');
				}
				if($(this).attr('data-small-slide')){
					data_small = $(this).attr('data-small-slide');
				}
				if($(this).attr('data-margin')){
					data_margin = $(this).attr('data-margin');
				}
				var nice_attr = {
					autoPlay: 3000, //Set AutoPlay to 3 seconds
					responsive:{
						0:{
							items:1
						},
						600:{
							items:4							
						},
						1000:{
							items:4
						}
					}
				};				
				$(this).owlCarousel(nice_attr);	
			});	
		}
	}
	
	/* ---------------------------------------------------------------------- */
	/*	Nice Scroll
	/* ---------------------------------------------------------------------- */
	$.fn.kodeproperty_nicescroll = function(){
		if(typeof($.fn.niceScroll) == 'function'){
			$(this).each(function(){					
				var nice_attr = {
					cursorwidth:'12px',	
					cursorcolor:'red',
					cursoropacitymax:0.7,
					boxzoom:true,
					touchbehavior:false,
					cursorborder :'1px solid #195D10',
					zindex :999999
				};
				// Nice Scroll Color
				if($('.body-wrapper').attr('data-color')){
					nice_attr.cursorcolor = $('.body-wrapper').attr('data-color');
				}
				// Nice Scroll Color
				if($('.body-wrapper').attr('data-color')){
					nice_attr.cursorborderradius = $('.body-wrapper').attr('data-radius');
				}
				
				// Nice Scroll Color
				if($('.body-wrapper').attr('data-touch')){
					nice_attr.touchbehavior = $('.body-wrapper').attr('data-touch');
				}
				// Nice Scroll Color
				if($('.body-wrapper').attr('data-width')){
					nice_attr.cursorwidth = $('.body-wrapper').attr('data-width');
				}
				$('.nicescroll').niceScroll(nice_attr);	
			});	
		}
	}
	
	
	// runs flex slider function
	$.fn.kodeproperty_flexslider = function(){
		if(typeof($.fn.flexslider) == 'function'){
			$(this).each(function(){
				var flex_attr = {
					animation: 'fade',
					animationLoop: true,
					prevText: '<i class="fa fa-angle-left" ></i>', 
					nextText: '<i class="fa fa-angle-right" ></i>',
					useCSS: false
				};
				
				// slide duration
				if( $(this).attr('data-pausetime') ){
					flex_attr.slideshowSpeed = parseInt($(this).attr('data-pausetime'));
				}
				if( $(this).attr('data-slidespeed') ){
					flex_attr.animationSpeed = parseInt($(this).attr('data-slidespeed'));
				}

				// set the attribute for carousel type
				if( $(this).attr('data-type') == 'carousel' ){
					flex_attr.move = 1;
					flex_attr.animation = 'slide';
					
					if( $(this).closest('.kode-item-no-space').length > 0 ){
						flex_attr.itemWidth = $(this).width() / parseInt($(this).attr('data-columns'));
						flex_attr.itemMargin = 0;							
					}else{
						flex_attr.itemWidth = (($(this).width() + 30) / parseInt($(this).attr('data-columns'))) - 30;
						flex_attr.itemMargin = 30;	
					}		
					
					// if( $(this).attr('data-columns') == "1" ){ flex_attr.smoothHeight = true; }
				}else{
					if( $(this).attr('data-effect') ){
						flex_attr.animation = $(this).attr('data-effect');
					}
				}
				if( $(this).attr('data-columns') ){
					flex_attr.minItems = parseInt($(this).attr('data-columns'));
					flex_attr.maxItems = parseInt($(this).attr('data-columns'));	
				}				
				
				// set the navigation to different area
				if( $(this).attr('data-nav-container') ){
					var flex_parent = $(this).parents('.' + $(this).attr('data-nav-container')).prev('.kode-nav-container');
					
					if( flex_parent.find('.kode-flex-prev').length > 0 || flex_parent.find('.kode-flex-next').length > 0 ){
						flex_attr.controlNav = false;
						flex_attr.directionNav = false;
						flex_attr.start = function(slider){
							flex_parent.find('.kode-flex-next').click(function(){
								slider.flexAnimate(slider.getTarget("next"), true);
							});
							flex_parent.find('.kode-flex-prev').click(function(){
								slider.flexAnimate(slider.getTarget("prev"), true);
							});
							
							kodeproperty_set_item_outer_nav();
							$(window).resize(function(){ kodeproperty_set_item_outer_nav(); });
						}
					}else{
						flex_attr.controlNav = false;
						flex_attr.controlsContainer = flex_parent.find('.nav-container');	
					}
					
				}

				$(this).flexslider(flex_attr);	
			});	
		}
	}
	
	// runs nivo slider function
	$.fn.kodeproperty_nivoslider = function(){
		if(typeof($.fn.nivoSlider) == 'function'){
			$(this).each(function(){
				var nivo_attr = {};
				
				if( $(this).attr('data-pausetime') ){
					nivo_attr.pauseTime = parseInt($(this).attr('data-pausetime'));
				}
				if( $(this).attr('data-slidespeed') ){
					nivo_attr.animSpeed = parseInt($(this).attr('data-slidespeed'));
				}
				if( $(this).attr('data-effect') ){
					nivo_attr.effect = $(this).attr('data-effect');
				}

				$(this).nivoSlider(nivo_attr);	
			});	
		}
	}	
	
	
	$(document).ready(function(){
	
		
	
		// top woocommerce button
		$('.kode-top-woocommerce-wrapper').hover(function(){
			$(this).children('.kode-top-woocommerce').fadeIn(200);
		}, function(){
			$(this).children('.kode-top-woocommerce').fadeOut(200);
		});
	
		
		// script for parallax background
		$('.kode-parallax-wrapper').each(function(){
			if( $(this).hasClass('kode-background-image') ){
				var parallax_section = $(this);
				var parallax_speed = parseFloat(parallax_section.attr('data-bgspeed'));
				if( parallax_speed == 0 || kodeproperty_touch_device ) return;
				if( parallax_speed == -1 ){
					parallax_section.css('background-attachment', 'fixed');
					parallax_section.css('background-position', 'center center');
					return;
				}
					
				$(window).scroll(function(){
					// if in area of interest
					if( ( $(window).scrollTop() + $(window).height() > parallax_section.offset().top ) &&
						( $(window).scrollTop() < parallax_section.offset().top + parallax_section.outerHeight() ) ){
						
						var scroll_pos = 0;
						if( $(window).height() > parallax_section.offset().top ){
							scroll_pos = $(window).scrollTop();
						}else{
							scroll_pos = $(window).scrollTop() + $(window).height() - parallax_section.offset().top;
						}
						parallax_section.css('background-position', 'center ' + (-scroll_pos * parallax_speed) + 'px');
					}
				});			
			}else if( $(this).hasClass('kode-background-video') ){
				if(typeof($.fn.mb_YTPlayer) == 'function'){
					$(this).children('.kode-bg-player').mb_YTPlayer();
				}
			}else{
				return;
			}
		});
		
		
		// responsive menu
		if(typeof($.fn.dlmenu) == 'function'){
			$('#kode-responsive-navigation').each(function(){
				$(this).find('.dl-submenu').each(function(){
					if( $(this).siblings('a').attr('href') && $(this).siblings('a').attr('href') != '#' ){
						var parent_nav = $('<li class="menu-item kode-parent-menu"></li>');
						parent_nav.append($(this).siblings('a').clone());
						
						$(this).prepend(parent_nav);
					}
				});
				$(this).dlmenu();
			});
		}	
		
		// gallery thumbnail type
		$('.kode-gallery-thumbnail').each(function(){
			var thumbnail_container = $(this).children('.kode-gallery-thumbnail-container');
		
			$(this).find('.gallery-item').click(function(){
				var selected_slide = thumbnail_container.children('[data-id="' + $(this).attr('data-id') + '"]');
				if(selected_slide.css('display') == 'block') return false;
			
				// check the gallery height
				var image_width = selected_slide.children('img').attr('width');
				var image_ratio = selected_slide.children('img').attr('height') / image_width;
				var temp_height = image_ratio * Math.min(thumbnail_container.width(), image_width);
				
				thumbnail_container.animate({'height': temp_height});
				selected_slide.fadeIn().siblings().hide();
				return false;
			});		

			$(window).resize(function(){ thumbnail_container.css('height', 'auto') });
		});

		
		// image shortcode 
		$('.kode-image-link-shortcode').hover(function(){
			$(this).find('.kode-image-link-overlay').animate({opacity: 0.8}, 150);
			$(this).find('.kode-image-link-icon').animate({opacity: 1}, 150);
		}, function(){
			$(this).find('.kode-image-link-overlay').animate({opacity: 0}, 150);
			$(this).find('.kode-image-link-icon').animate({opacity: 0}, 150);
		});	
		
		
		// animate ux
		if( !kodeproperty_touch_device && ( !$.browser.msie || (parseInt($.browser.version) > 8)) ){
		
			// image ux
			// $('.content-wrapper img').each(function(){
				// if( $(this).closest('.kode-ux, .ls-wp-container, .product, .flexslider, .nivoSlider').length ) return;
				
				// var ux_item = $(this);
				// if( ux_item.offset().top > $(window).scrollTop() + $(window).height() ){
					// ux_item.css({ 'opacity':0 });
				// }else{ return; }
				
				// $(window).scroll(function(){
					// if( $(window).scrollTop() + $(window).height() > ux_item.offset().top + 100 ){
						// ux_item.animate({ 'opacity':1 }, 1200); 
					// }
				// });					
			// });
		
			// item ux
			// $('.kode-ux').each(function(){
				// var ux_item = $(this);
				// if( ux_item.offset().top > $(window).scrollTop() + $(window).height() ){
					// ux_item.css({ 'opacity':0, 'padding-top':20, 'margin-bottom':-20 });
				// }else{ return; }	

				// $(window).scroll(function(){
					// if( $(window).scrollTop() + $(window).height() > ux_item.offset().top + 100 ){
						// ux_item.animate({ 'opacity':1, 'padding-top':0, 'margin-bottom':0 }, 1200);						
					// }
				// });					
			// });
			
		// do not animate on scroll in mobile
		}else{		
			// skill bar
			$('.kode-skill-bar-progress').each(function(){
				if($(this).attr('data-percent')){
					$(this).animate({width: $(this).attr('data-percent') + '%'}, 1200, 'easeOutQuart');
				}
			});			
		}		

		// runs nivoslider when available
		$('.nivoSlider').kodeproperty_nivoslider();		
		
		// runs flexslider when available
		$('.flexslider').kodeproperty_flexslider();
		
		// runs bxslider when available
		$('.bxslider').kodeproperty_bxslider();
		
		$('.bxslider_no').kodeproperty_bxslider_no_awesome();
		
		
		/*  Carousel */
		$('.owl-carousel').kodeproperty_owl_carousel();
		
		$('.owl-no-space').kodeproperty_owl_carousel_no_space();
		
		$('.kf_property_detail_img_row').kodeproperty_owl_carousel_prop();
		
		
		
		// runs CountDown when available
		$('.countdown').kodeproperty_countdown();
		
		$('.downcount').kodeproperty_countdown_timmer();
		
		$('.event_countdown').kodeproperty_countdown_timmer();
		
		// runs niceScroll when available
		$('.nicescroll').kodeproperty_nicescroll();
		
		$('.kode-bxslider-pager').kodeproperty_bxslider_pager();
		// $('.property_pager_item').kodeproperty_bxslider_pager();
		
	});
	
	$(window).load(function(){

		
	});
	
	
	/* ---------------------------------------------------------------------- */
	/*	Search Function
	/* ---------------------------------------------------------------------- */
	jQuery('.searchform').hide();
	jQuery("a.search-btn").click(function(){
		jQuery('.searchform').hide();
		jQuery(".searchform").fadeToggle();
	});
	jQuery('html').click(function() {
		jQuery(".searchform").fadeOut();
	});
	jQuery('.kd-search').click(function(event){
		event.stopPropagation();
	});
	
	/* ---------------------------------------------------------------------- */
	/*	Scroll to Top
	/* ---------------------------------------------------------------------- */
	jQuery(window).scroll(function(){
		if (jQuery(this).scrollTop() > 100) {
			jQuery('.back-to-top').fadeIn();
		} else {
			jQuery('.back-to-top').fadeOut();
		}
	});
	
	/* ---------------------------------------------------------------------- */
	/*	Click to Trigger an Event
	/* ---------------------------------------------------------------------- */
	jQuery('.back-to-top a').click(function(){
		jQuery('html, body').animate({scrollTop : 0},1200);
		return false;
	});
	
	// paypal form
	jQuery('#user-profile-submit').each(function(){
		var user_kodehotel_form = jQuery(this);
		
		// jQuery(this).on('change', '#js-output]', function(){
			// var total_price = kodehotel_form.find('#js-output');
			// var price = parseFloat(total_price.val()) * parseInt(jQuery(this).val());
			// total_price.val(price);
		// });
		
		jQuery(this).find('#submit-form').click(function(){
		
			var valid = true; 
			var paypal_redirect = false;
			var stripe_redirect = false;
			var paymill_redirect = false;
			var auth_redirect = false;
			var current = jQuery(this);
			
			// jQuery('.checkbox input[type="radio"]:checked').each(function(){
				// var action = $(this).attr('data-value');
				// var action_url = $(this).attr('value');
				// current.parents('form').attr('action', action_url);
				// current.siblings('.action').attr('value', action);
				// current.siblings('.action').attr('data-url', action_url);
			// });
			
			// var current_class = jQuery(this).siblings('.action').attr('value');
			// var current_val = jQuery(this).siblings('.action').attr('data-url');
			paypal_redirect = true;
			jQuery(this).siblings('.action').attr('value', 'kode_submit_action');
			
			
			// check require fields
			user_kodehotel_form.find('.kode-require').each(function(){
				if( valid && jQuery(this).val() == '' ){
					user_kodehotel_form.children().children('.kode-notice.require-field').slideDown(200)
						.siblings('.kode-notice').slideUp(200);
					valid = false;
				}
			});
			
			// check email
			user_kodehotel_form.find('.kode-email').each(function(){
				var re = /\S+@\S+/;
				if( valid && !re.test(jQuery(this).val()) ){
					user_kodehotel_form.children().children('.kode-notice.email-invalid').slideDown(200)
						.siblings('.kode-notice').slideUp(200);
					valid = false;
				}
			});	

			if( valid ){
				user_kodehotel_form.children().find('.kode-notice').slideUp(200);
				user_kodehotel_form.children().find('.kode-profile-loader').slideDown(200);
				
				var ajax_url = user_kodehotel_form.attr('data-ajax');
				jQuery.ajax({
					type: 'POST',
					url: ajax_url,
					data: user_kodehotel_form.serialize(),
					
					dataType: 'json',
					error: function(a, b, c){
						console.log(a, b, c);
					},
					success: function(data){
						user_kodehotel_form.children().find('.kode-notice.alert-message')
							.html(data.message).slideDown(200).addClass('kode-' + data.status);
						user_kodehotel_form.children().find('.kode-profile-loader').slideUp(200);
						
						if( data.status == 'success' && paypal_redirect ){
							// user_kodehotel_form.children('[name="invoice"]').val(data.invoice);
							user_kodehotel_form.children().children('[name="user"]').val(data.user);
							// user_kodehotel_form[0].submit();
							location.reload();
						}else{
							if( data.log ){
								console.log(data.log);
							}
						}
					}
				});					
			}
		});
	});
	
	// paypal form
	jQuery('#user-payment-submit').each(function(){
		var kodehotel_form = jQuery(this);
		
		// jQuery(this).on('change', '#js-output]', function(){
			// var total_price = kodehotel_form.find('#js-output');
			// var price = parseFloat(total_price.val()) * parseInt(jQuery(this).val());
			// total_price.val(price);
		// });
		
		jQuery(this).find('#user-submit-form').click(function(){
		
			var valid = true; 
			var paypal_redirect = false;
			var stripe_redirect = false;
			var paymill_redirect = false;
			var auth_redirect = false;
			var current = jQuery(this);
			
			jQuery('.kode-radio-label-wrap  input[type="radio"]:checked').each(function(){
				var action = $(this).parent().find('.radio_item').attr('data-value');
				// var action_url = $(this).attr('value');
				
				// current.parents('form').attr('action', action_url);
				current.siblings('.action').attr('value', action);
				// current.parent().siblings('.action').attr('data-url', action_url);
			});
			
			// var current_class = jQuery(this).siblings('.action').attr('value');
			// var current_val = jQuery(this).siblings('.action').attr('data-url');
			paypal_redirect = true;
			// jQuery(this).siblings('.action').attr('value', 'kode_submit_action');
			
			
			// check require fields
			kodehotel_form.find('.kode-require').each(function(){
				if( valid && jQuery(this).val() == '' ){
					kodehotel_form.children().children('.kode-notice.require-field').slideDown(200)
						.siblings('.kode-notice').slideUp(200);
					valid = false;
				}
			});
			
			// check email
			kodehotel_form.find('.kode-email').each(function(){
				var re = /\S+@\S+/;
				if( valid && !re.test(jQuery(this).val()) ){
					kodehotel_form.children().children('.kode-notice.email-invalid').slideDown(200)
						.siblings('.kode-notice').slideUp(200);
					valid = false;
				}
			});	

			if( valid ){
				kodehotel_form.children().find('.kode-notice').slideUp(200);
				kodehotel_form.children().find('.kode-profile-loader').slideDown(200);
				
				var ajax_url = kodehotel_form.attr('data-ajax');
				jQuery.ajax({
					type: 'POST',
					url: ajax_url,
					data: kodehotel_form.serialize(),
					dataType: 'json',
					error: function(a, b, c){
						console.log(a, b, c);
					},
					success: function(data){
						kodehotel_form.children().find('.kode-notice.alert-message')
							.html(data.message).slideDown(200).addClass('kode-' + data.status);
						kodehotel_form.children().find('.kode-profile-loader').slideUp(200);
						
						if( data.status == 'success' && paypal_redirect ){
							// kodehotel_form.children('[name="invoice"]').val(data.invoice);
							kodehotel_form.children().children('[name="user"]').val(data.user);
							kodehotel_form[0].submit();
							// location.reload();
						}else{
							if( data.log ){
								console.log(data.log);
							}
						}
					}
				});					
			}
		});
	});
	
	// paypal form
	jQuery('.kode-custom-pay-form').each(function(){
		var kodehotel_form = jQuery(this);
		
		// jQuery(this).on('change', '#js-output]', function(){
			// var total_price = kodehotel_form.find('#js-output');
			// var price = parseFloat(total_price.val()) * parseInt(jQuery(this).val());
			// total_price.val(price);
		// });
		$('.kode-custom-pay-form').trigger("reset");
		jQuery(this).find('.user-custom-pay-form').click(function(){
			
			var valid = true; 
			var paypal_redirect = false;
			var stripe_redirect = false;
			var paymill_redirect = false;
			var auth_redirect = false;
			var current = jQuery(this);
			
			jQuery('.kode-radio-label-wrap input[type="radio"]:checked').each(function(){
				var action = $(this).parent().find('.radio_item').attr('data-value');
				var action_url = $(this).parent().find('.radio_item').attr('data-url');
				// var action_url = $(this).attr('value');
				
				current.parents('form').attr('action', action_url);
				current.siblings('.action').attr('value', action);				
			});
			
			var invoice = jQuery(this).siblings('.invoice').attr('value');
			var user = jQuery(this).siblings('.user').attr('value');
			// var current_val = jQuery(this).siblings('.action').attr('data-url');
			paypal_redirect = true;
			// jQuery(this).siblings('.action').attr('value', 'kode_submit_action');
			
			
			// check require fields
			kodehotel_form.find('.kode-require').each(function(){
				if( valid && jQuery(this).val() == '' ){
					kodehotel_form.children('.kode-notice.require-field').slideDown(200)
						.siblings('.kode-notice').slideUp(200);
					valid = false;
				}
			});
			
			// check email
			kodehotel_form.find('.kode-email').each(function(){
				var re = /\S+@\S+/;
				if( valid && !re.test(jQuery(this).val()) ){
					kodehotel_form.children('.kode-notice.email-invalid').slideDown(200)
						.siblings('.kode-notice').slideUp(200);
					valid = false;
				}
			});	

			if( valid ){
				kodehotel_form.find('.kode-notice').slideUp(200);
				kodehotel_form.find('.kode-profile-loader').slideDown(200);
				
				var ajax_url = kodehotel_form.attr('data-ajax');
				jQuery.ajax({
					type: 'POST',
					url: ajax_url,
					data: kodehotel_form.serialize(),
					dataType: 'json',
					error: function(a, b, c){
						console.log(a, b, c);
					},
					success: function(data){
						kodehotel_form.find('.kode-notice.alert-message')
							.html(data.message).slideDown(200).addClass('kode-' + data.status);
						kodehotel_form.find('.kode-profile-loader').slideUp(200);
						
						if( data.status == 'success' && paypal_redirect ){
							// kodehotel_form.find('[name="invoice"]').val(data.invoice);
							// kodehotel_form.find('[name="user"]').val('abc');
							// kodehotel_form[0].submit();
							kodehotel_form[0].submit();
							// location.reload();
						}else{
							if( data.log ){
								console.log(data.log);
							}
						}
					}
				});					
			}
		});
	});
	
	
	
	
	// paypal form
	jQuery('#agent-contact').each(function(){
		var kodehotel_form_review = jQuery(this);
		
		jQuery(this).find('#agent-contact-sub').click(function(){
		
			var valid = true; 
			var paypal_redirect = false;
			var stripe_redirect = false;
			var paymill_redirect = false;
			var auth_redirect = false;
			var current = jQuery(this);

			paypal_redirect = true;
			// jQuery(this).find('.action').attr('value', 'kode_submit_action');
			
			// var dd = jQuery(this).parent().html();
			// alert(dd);
			
			// check require fields
			kodehotel_form_review.find('.kode-require').each(function(){
				if( valid && jQuery(this).val() == '' ){
					kodehotel_form_review.children('.kode-notice.require-field').slideDown(200)
						.siblings('.kode-notice').slideUp(200);
					valid = false;
				}
			});
			
			// check email
			kodehotel_form_review.find('.kode-email').each(function(){
				var re = /\S+@\S+/;
				if( valid && !re.test(jQuery(this).val()) ){
					kodehotel_form_review.children('.kode-notice.email-invalid').slideDown(200)
						.siblings('.kode-notice').slideUp(200);
					valid = false;
				}
			});	

			if( valid ){				
				kodehotel_form_review.children('.kode-notice').slideUp(200);
				kodehotel_form_review.children('.kode-profile-loader').slideDown(200);
				
				var ajax_url = kodehotel_form_review.attr('data-ajax');
				jQuery.ajax({
					type: 'POST',
					url: ajax_url,
					data: kodehotel_form_review.serialize(),
					dataType: 'json',
					error: function(a, b, c){
						console.log(a, b, c);
					},
					success: function(data){
						kodehotel_form_review.children('.kode-notice.alert-message')
							.html(data.message).slideDown(200).addClass('kode-' + data.status);
						kodehotel_form_review.children('.kode-profile-loader').slideUp(200);
						
						if( data.status == 'success' && paypal_redirect ){
							// kodehotel_form_review.children('[name="invoice"]').val(data.invoice);
							kodehotel_form_review.children('[name="user"]').val(data.user);
							// kodehotel_form_review[0].submit();
							// location.reload();
						}else{
							if( data.log ){
								console.log(data.log);
							}
						}
					}
				});					
			}
		});
	});
	
	// paypal form
	jQuery('#kode-review-submit').each(function(){
		var kodehotel_form_review = jQuery(this);
		
		jQuery(this).find('#submit-review').click(function(){
		
			var valid = true; 
			var paypal_redirect = false;
			var stripe_redirect = false;
			var paymill_redirect = false;
			var auth_redirect = false;
			var current = jQuery(this);

			paypal_redirect = true;
			// jQuery(this).find('.action').attr('value', 'kode_submit_action');
			
			// var dd = jQuery(this).parent().html();
			// alert(dd);
			
			// check require fields
			kodehotel_form_review.find('.kode-require').each(function(){
				if( valid && jQuery(this).val() == '' ){
					kodehotel_form_review.children().children().children('.kode-notice.require-field').slideDown(200)
						.siblings('.kode-notice').slideUp(200);
					valid = false;
				}
			});
			
			// check email
			kodehotel_form_review.find('.kode-email').each(function(){
				var re = /\S+@\S+/;
				if( valid && !re.test(jQuery(this).val()) ){
					kodehotel_form_review.children().children().children('.kode-notice.email-invalid').slideDown(200)
						.siblings('.kode-notice').slideUp(200);
					valid = false;
				}
			});	

			if( valid ){				
				kodehotel_form_review.children().children().children('.kode-notice').slideUp(200);
				kodehotel_form_review.children().children().children('.kode-review-loader').slideDown(200);
				
				var ajax_url = kodehotel_form_review.attr('data-ajax');
				jQuery.ajax({
					type: 'POST',
					url: ajax_url,
					data: kodehotel_form_review.serialize(),
					dataType: 'json',
					error: function(a, b, c){
						console.log(a, b, c);
					},
					success: function(data){
						kodehotel_form_review.children().children().children('.kode-notice.alert-message')
							.html(data.message).slideDown(200).addClass('kode-' + data.status);
						kodehotel_form_review.children().children().children('.kode-review-loader').slideUp(200);
						
						if( data.status == 'success' && paypal_redirect ){
							// kodehotel_form_review.children('[name="invoice"]').val(data.invoice);
							kodehotel_form_review.children().children().children('[name="user"]').val(data.user);
							// kodehotel_form_review[0].submit();
							location.reload();
						}else{
							if( data.log ){
								console.log(data.log);
							}
						}
					}
				});					
			}
		});
	});
	
	
	// paypal form
	jQuery('#search-property').each(function(){
		var kodehotel_form_review = jQuery(this);
		
		jQuery(this).find('#search-property-btn').click(function(){
		
			var valid = true; 
			var paypal_redirect = false;
			var stripe_redirect = false;
			var paymill_redirect = false;
			var auth_redirect = false;
			var current = jQuery(this);

			paypal_redirect = true;
			// jQuery(this).find('.action').attr('value', 'kode_submit_action');
			
			// var dd = jQuery(this).parent().html();
			// alert(dd);
			
			// check require fields
			kodehotel_form_review.find('.kode-require').each(function(){
				if( valid && jQuery(this).val() == '' ){
					kodehotel_form_review.children().children().children('.kode-notice.require-field').slideDown(200)
						.siblings('.kode-notice').slideUp(200);
					valid = false;
				}
			});
			
			// check email
			kodehotel_form_review.find('.kode-email').each(function(){
				var re = /\S+@\S+/;
				if( valid && !re.test(jQuery(this).val()) ){
					kodehotel_form_review.children().children().children('.kode-notice.email-invalid').slideDown(200)
						.siblings('.kode-notice').slideUp(200);
					valid = false;
				}
			});	

			if( valid ){				
				kodehotel_form_review.children().children().children('.kode-notice').slideUp(200);
				kodehotel_form_review.children().children().children('.kode-search-loader').slideDown(200);
				
				var ajax_url = kodehotel_form_review.attr('data-ajax');
				jQuery.ajax({
					type: 'GET',
					url: ajax_url,
					data: kodehotel_form_review.serialize(),
					dataType: 'json',
					error: function(a, b, c){
						console.log(a, b, c);
					},
					success: function(data){
						kodehotel_form_review.children().children().children('.kode-notice.alert-message')
							.html(data.message).slideDown(200).addClass('kode-' + data.status);
						kodehotel_form_review.children().children().children('.kode-search-loader').slideUp(200);
						
						if( data.status == 'success' && paypal_redirect ){
							// kodehotel_form_review.children('[name="invoice"]').val(data.invoice);
							kodehotel_form_review.children().children().children('[name="user"]').val(data.user);
							kodehotel_form_review[0].submit();
							location.reload();
						}else{
							if( data.log ){
								console.log(data.log);
							}
						}
					}
				});					
			}
		});
	});
	
	
	
	// radio-image-script
	$('.kode-radio-label-wrap input[type="radio"]').change(function(){
		
		$(this).parent().siblings('label').children('input').attr('checked', false); 
		$(this).parent().addClass('active').siblings('label').removeClass('active');
	});
	
	$('.choose-one input[type="radio"]').change(function(){
		$(this).parent().parent().siblings('label').children('input').attr('checked', false);
		// $(this).parent().parent().siblings('label').children('input[type="hidden"]').attr('value', ' ');
		// var min_price = $(this).parent().children('input[name="min-price"]').attr('data-value');
		// var max_price = $(this).parent().children('input[name="max-price"]').attr('data-value');
		// $(this).parent().children('input[name="min-price"]').attr('value',min_price);
		// $(this).parent().children('input[name="max-price"]').attr('value',max_price);
		// var min_space = $(this).parent().children('input[name="min-space"]').attr('data-value');
		// var max_space = $(this).parent().children('input[name="max-space"]').attr('data-value');
		// $(this).parent().children('input[name="min-space"]').attr('value',min_space);
		// $(this).parent().children('input[name="max-space"]').attr('value',max_space);
		
		// $(this).parent().parent().siblings('label').children().children('input[name="min-price"]').attr('value', '');
		// $(this).parent().parent().siblings('label').children().children('input[name="max-price"]').attr('value', ' ');
		// $(this).parent().parent().siblings('label').children().children('input[name="min-space"]').attr('value', ' ');
		// $(this).parent().parent().siblings('label').children().children('input[name="max-space"]').attr('value', ' ');
		
		$(this).parent().parent().addClass('active').siblings('label').removeClass('active');
	});
	
	// $('.kode-cheaked-boxs input[type="checkbox"]').change(function(){
		// $(this).parent().parent().children('label').children('input').attr('checked', true);
		// $(this).parent().parent().addClass('active').siblings('label').removeClass('active');
	// });
	
		
		
	$('.kode-cheaked-boxs input[type="checkbox"]').click(function(){
		if( $(this).hasClass('enable') ){
			$(this).removeClass('enable');
			$(this).parent().parent().removeClass('select-checkbox');
		}else{
			$(this).addClass('enable');
			$(this).parent().parent().addClass('selected-checkbox');
		}
	});	
	

});