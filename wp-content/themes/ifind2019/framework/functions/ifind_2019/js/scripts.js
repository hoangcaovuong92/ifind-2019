//****************************************************************//
/*							IFIND 2019 JS						  */
//****************************************************************//
jQuery(window).ready(function($) {
	"use strict";
	wd_auto_detect_slider(); //Auto Slider
	ifind_2019_script();

	//On window Resize
	window.addEventListener('resize', wd_slider_window_resize);
});

//****************************************************************//
/*							FUNCTIONS							  */
//****************************************************************//
if (typeof ifind_2019_script != 'function') { 
	function ifind_2019_script() {
		jQuery('.ifind-location-item a').on('click', function (e) {
			e.preventDefault();
			var top = jQuery(this).data('top');
			var left = jQuery(this).data('left');
			
			jQuery('#ifind-2019-map-mark').animate({'top':top+'%', 'left': left+'%'});
		});

		jQuery('.ifind-back-to-map').on('click', function (e) {
			e.preventDefault();
			jQuery('.wd-slider-wrap--main').slick('slickGoTo', 0, true);
		});

		jQuery(".ifind-fancybox-image").fancybox({
			openEffect: 'fade',
			closeEffect: 'fade',
			margin: [0, 0, 0, 0],
			padding: 7,
			width: 1080,
			height: 1920,
			fitToView: false,
			autoSize: false,
			closeBtn: true,
			arrows: false,
			type: 'image',
			onComplete: function () {},
			beforeShow: function () {},
			afterClose: function () {},
			afterLoad: function () {
			}
		});

		jQuery('.ifind-fancybox-listing').on('click', function (e) {
			e.preventDefault();
			var target_id = jQuery(this).data('target_id');
			jQuery.fancybox('#ifind-second-page-content-'+target_id, {
				openEffect: 'fade',
				closeEffect: 'fade',
				margin: [10, 10, 10, 10],
				padding: 0,
				width: 1040,
				height: 1880,
				fitToView: true,
				autoSize: false,
				closeBtn: false,
				arrows: false,
				onComplete: function () {},
				beforeShow: function () {
					//jQuery("body").css({'overflow-y':'hidden'});
				},
				afterLoad: function () {
				}
			});
		});

		jQuery('.ifind-product-item-view-album').on('click', function (e) {
			e.preventDefault();
			var top = jQuery(this).data('top');
			var left = jQuery(this).data('left');
			
			jQuery('#ifind-2019-map-mark').animate({'top':top+'%', 'left': left+'%'});
		});

		jQuery('.ifind-product-item-view-content').on('click', function (e) {
			e.preventDefault();
			var id = jQuery(this).data('product_id');
			jQuery.fancybox('#ifind-product-item-popup-content-'+id, {
				openEffect: 'fade',
				closeEffect: 'fade',
				margin: [0, 0, 0, 0],
				padding: 0,
				width: 1080,
				height: 1920,
				fitToView: true,
				autoSize: true,
				closeBtn: false,
				arrows: false,
				helpers: {
					overlay: {
						// css: {
						// 	'background': 'rgba(58, 42, 45, 0.8)'
						// },
					}
				},
				onComplete: function () {},
				beforeShow: function () {
					//jQuery("body").css({'overflow-y':'hidden'});
				},
				afterLoad: function () {
				}
			});
		});
	}
}

//On window Resize
if (typeof wd_slider_window_resize != 'function') { 
	function wd_slider_window_resize() {
	}
}

//slider_type : owl, slick, light
if (typeof wd_slick_slider_call != 'function') {
	function wd_slick_slider_call($sliderWrap, custom_options) {
		var default_options = {
			slider_type : 'owl',
			column_mobile : slider_default_setting.column_mobile,
			column_tablet : slider_default_setting.column_tablet,
			column_desktop : slider_default_setting.column_desktop,
			autoplay : parseInt(slider_default_setting.autoplay) ? true : false,
			autoplayHoverPause : slider_default_setting.autoplay_hover_pause  ? true : false, //owl
			autoplayTimeout : slider_default_setting.autoplay_timeout, //owl
			autoplaySpeed : slider_default_setting.autoplay_speed,
			autoplay_mobile : slider_default_setting.autoplay_mobile  ? true : false,
			arrows : parseInt(slider_default_setting.arrows) ? true : false,
			dots : parseInt(slider_default_setting.dots) ? true : false,
			infinite : parseInt(slider_default_setting.infinite) ? true : false,
			responsiveRefreshRate: slider_default_setting.responsive_refresh_rate,
			navRewind : parseInt(slider_default_setting.nav_rewind) ? true : false,
			navSpeed : slider_default_setting.nav_speed,
			margin : slider_default_setting.margin, //owl
			autoHeight : parseInt(slider_default_setting.auto_height) ? true : false, //owl
			mouseDrag : parseInt(slider_default_setting.mouse_drag) ? true : false, //owl
			touchDrag : parseInt(slider_default_setting.touch_drag) ? true : false, //owl
        	animateIn : slider_default_setting.animate_in, //owl
			animateOut : slider_default_setting.animate_out, //owl
			centerMode : false, //owl + slick
			centerPadding : '60px', //Slick
			vertical : false, //light + slick
			isQuickshop : false, //light (single product)
		}
		custom_options = jQuery.extend(default_options, custom_options);
		if (custom_options.slider_type === 'light') {
			var galleryMarginDesktop = custom_options.vertical ? 50 : 10;
			var galleryMarginDesktop = custom_options.isQuickshop ? 0 : galleryMarginDesktop;
			var galleryMarginMobile = custom_options.isQuickshop ? 0 : 10;
			var thumbMargin = custom_options.isQuickshop ? 0 : 10;
			var vThumbWidth = custom_options.isQuickshop ? 80 : 60;
			var options = {
				gallery 		: true,
				item 			: 1,
				controls 		: custom_options.arrows,
                vertical 		: custom_options.vertical,
                verticalHeight 	: 400,
                vThumbWidth 	: vThumbWidth,
                thumbItem 		: parseInt(custom_options.column_desktop),
				thumbMargin 	: thumbMargin,
				galleryMargin 	: galleryMarginDesktop,
				slideMargin 	: 0,
				loop 			: true,
				adaptiveHeight 	: true,
				currentPagerPosition : 'left',
				speed 			: 600,
				auto 			: false,
				enableTouch 	: false,
				enableDrag 		: false,
				responsive 		: [
					{
						breakpoint: 767,
						settings: {
							galleryMargin : galleryMarginMobile,
						}
					},
				]
			}

			return $sliderWrap.lightSlider(options);
		} else if (custom_options.slider_type === 'slick') {
			if ($sliderWrap.hasClass('slick-initialized')) {
				$sliderWrap.slick('unslick');
			}
	
			var options = {
				centerMode		: custom_options.centerMode,
				centerPadding	: custom_options.centerPadding,
				autoplay 		: custom_options.autoplay,
				autoplaySpeed	: custom_options.autoplaySpeed,
				arrows			: custom_options.arrows,
				dots			: custom_options.dots,
				vertical 		: custom_options.vertical,
				infinite 		: custom_options.infinite,
				slidesToShow	: parseInt(custom_options.column_desktop),
				slidesToScroll	: parseInt(custom_options.column_desktop),
				prevArrow 		: '<button type="button" class="slick-prev slick-arrow"></button>',
				nextArrow 		: '<button type="button" class="slick-next slick-arrow"></button>',
				responsive 		:  [
					{
						breakpoint			: 768,
						settings 			: {
							slidesToShow	: parseInt(custom_options.column_tablet),
							slidesToScroll	: parseInt(custom_options.column_tablet),
						}
					},
					{
						breakpoint			: 480,
						settings			: {
							autoplay 		: custom_options.autoplay_mobile,
							slidesToShow	: parseInt(custom_options.column_mobile),
							slidesToScroll	: parseInt(custom_options.column_mobile),
						}
					},
					{
						breakpoint			: 375,
						settings			: {
							autoplay 		: custom_options.autoplay_mobile,
							slidesToShow	: 1,
							slidesToScroll	: 1,
						}
					}
				]
			}
	
			if (options.vertical !== undefined && options.vertical) {
				options.prevArrow = '<button type="button" class="slick-up slick-arrow"></button>';
				options.nextArrow = '<button type="button" class="slick-down slick-arrow"></button>';
			}
			return $sliderWrap.not('.slick-initialized').slick(options);
		} else {
			var options = {
				loop 				: custom_options.infinite,
				items 				: parseInt(custom_options.column_desktop),
				slideBy				: parseInt(custom_options.column_desktop),
				nav 				: custom_options.arrows,
				margin				: parseInt(custom_options.margin),
				dots 				: custom_options.dots,
				rtl					: jQuery('body').hasClass('rtl'),
				autoplay			: custom_options.autoplay,
				autoplaySpeed 		: parseInt(custom_options.autoplaySpeed),
				autoplayTimeout		: parseInt(custom_options.autoplayTimeout),
				autoplayHoverPause 	: custom_options.autoplayHoverPause,
				center				: custom_options.centerMode,
				animateOut 			: custom_options.animateOut,
				animateIn 			: custom_options.animateIn,
				autoHeight			: custom_options.autoHeight,
				navRewind			: custom_options.navRewind,
				navSpeed 			: parseInt(custom_options.navSpeed),
				mouseDrag			: custom_options.mouseDrag,
				touchDrag			: custom_options.touchDrag,
				responsiveBaseElement : $sliderWrap,
				responsiveRefreshRate : parseInt(custom_options.responsiveRefreshRate),
				responsive:{
					0:{
						autoplay : custom_options.autoplay_mobile,
						items : 1,
						slideBy : 1,
						margin: 0,
						center : false,
					},
					375:{
						autoplay : custom_options.autoplay_mobile,
						items : parseInt(custom_options.column_mobile),
						slideBy : parseInt(custom_options.column_mobile),
						center : false,
						margin: parseInt(custom_options.margin) / 2,
					},
					480:{
						autoplay: custom_options.autoplay,
						items : parseInt(custom_options.column_tablet),
						slideBy : parseInt(custom_options.column_tablet),
						center : custom_options.centerMode,
						margin: parseInt(custom_options.margin) / 2,
					},
					768:{
						autoplay: custom_options.autoplay,
						items : parseInt(custom_options.column_desktop),
						slideBy : parseInt(custom_options.column_desktop),
						center : custom_options.centerMode,
						margin: parseInt(custom_options.margin),
					}
				},
			}

			/* Auto height */
			$sliderWrap.on('initialized.owl.carousel changed.owl.carousel translated.owl.carousel resized.owl.carousel', function( event ){
				wd_set_owl_stage_height(event.target);
				setTimeout(function(){
					wd_set_owl_stage_height(event.target);
				}, 1000);
			});

			/* Mousewheel */
			// $sliderWrap.on('mousewheel', '.owl-stage', function (e) {
			// 	if (e.deltaY>0) {
			// 		$sliderWrap.trigger('next.owl');
			// 	} else {
			// 		$sliderWrap.trigger('prev.owl');
			// 	}
			// 	e.preventDefault();
			// });

			$sliderWrap.addClass('owl-carousel owl-theme');
			return $sliderWrap.owlCarousel(options);
		}
	}
}

if (typeof wd_set_owl_stage_height != 'function') { 
	function wd_set_owl_stage_height(target) {
		var maxHeight = '';
		if(jQuery(target).find('.owl-item.active').length) {
			//Number slider is active
			jQuery(target).find('.owl-item.active').each(function (i, e) { // LOOP THROUGH ACTIVE ITEMS
				var thisHeight = parseInt( jQuery(e).height() );
				maxHeight=(maxHeight>=thisHeight?maxHeight:thisHeight);
			});
			
			//Add column class to slider wrap
			jQuery(target).removeClass('wd-slider-columns-1 wd-slider-columns-2 wd-slider-columns-3 wd-slider-columns-4 wd-slider-columns-5 wd-slider-columns-6 wd-slider-columns-8 wd-slider-columns-12').addClass('wd-slider-columns-' + jQuery(target).find('.owl-item.active').length);
		}
		jQuery(target).find('.owl-carousel').css('height', maxHeight );
		jQuery(target).find('.owl-stage-outer').css('height', maxHeight ); // CORRECT DRAG-AREA SO BUTTONS ARE CLICKABLE
	}
}

// Set class wd-slider-wrap to slider wrapper
// Set data-slider-type="slick" //or owl
// Set data-slider-options='{}' //array of slider options
// default_options = {
// 		"column_mobile" : 1,
// 		"column_tablet" : 2,
// 		"column_desktop" : 4,
// 		"autoplay" : true,
// 		"autoplaySpeed" : 2000,
// 		"arrows" : true,
// 		"dots" : false,
// 		"infinite" : true,
// 		"centerMode" : false,
// 		"centerPadding" : '60px',
// 		"vertical" : false,
// 	}
if (typeof wd_auto_detect_slider != 'function') { 
	function wd_auto_detect_slider(wrap, custom_options){
		wrap = wrap || '.wd-slider-wrap';
		custom_options = custom_options || {};
		if(jQuery(wrap).length > 0 ){
			jQuery(wrap).each(function(i, item){
				$slider_wrap = jQuery(item);
				var options = $slider_wrap.data('slider-options');
				options = jQuery.type(options) !== 'object' ? custom_options : jQuery.extend(options, custom_options);
				wd_slick_slider_call($slider_wrap, options);
			})
		}
	}
}