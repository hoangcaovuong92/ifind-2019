<?php 
/**
 * TVLGIAO WPDANCE FRAMEWORK 2017.
 *
 * @author : Cao Vuong.
 * -Email  : hoangcaovuong92@gmail.com.
 */
 
if(!function_exists ('wd_get_data_package')){
	function wd_get_data_package( $template ) {
		/* DATA SETTING */ 
    	$wd_default_data    = wd_get_theme_option_default_data();
		$data 	= array();
		$pre 	= 'ifind_';
		switch ($template) {
			case 'google_map':
				$data['api_key']	  		= wd_get_theme_option($pre.'google_map_api_key', $wd_default_data['google_map']['default']['api_key']);  
				$data['zoom']	  			= wd_get_theme_option($pre.'google_map_zoom', $wd_default_data['google_map']['default']['zoom']);  
				$data['time_set_map']	  			= wd_get_theme_option($pre.'slider_timerShowPopup', $wd_default_data['slider']['default']['timerShowPopup']);  
				break;

			case 'weather':
				$data['api_key']	  		= wd_get_theme_option($pre.'weather_api_key', $wd_default_data['weather']['default']['api_key']);  
				$data['update_time']	  	= wd_get_theme_option($pre.'weather_update_time', $wd_default_data['weather']['default']['update_time']);  
				break;

			case 'slider':
				$data['timerShowPopup']	  		= wd_get_theme_option($pre.'slider_timerShowPopup', $wd_default_data['slider']['default']['timerShowPopup']);  
				$data['timerShowPopupViewingInfo']	= wd_get_theme_option($pre.'slider_timerShowPopupViewingInfo', $wd_default_data['slider']['default']['timerShowPopupViewingInfo']);  
				$data['timerDelayPopup']	  	= wd_get_theme_option($pre.'slider_timerDelayPopup', $wd_default_data['slider']['default']['timerDelayPopup']);  
				$data['bigAutoplaySpeed']	  	= wd_get_theme_option($pre.'slider_bigAutoplaySpeed', $wd_default_data['slider']['default']['bigAutoplaySpeed']);  
				$data['smallAutoplaySpeed']	  	= wd_get_theme_option($pre.'slider_smallAutoplaySpeed', $wd_default_data['slider']['default']['smallAutoplaySpeed']);  
				$data['numSliderBreak']	  		= wd_get_theme_option($pre.'slider_numSliderBreak', $wd_default_data['slider']['default']['numSliderBreak']);  
				$data['numFooterSliderItems']	= wd_get_theme_option($pre.'slider_numFooterSliderItems', $wd_default_data['slider']['default']['numFooterSliderItems']);  
				break;
			case 'slider-default':
				$data['column_desktop']				= wd_get_theme_option('slider_column_desktop', $wd_default_data['slider']['default']['column_desktop']);
				$data['column_tablet']					= wd_get_theme_option('slider_column_tablet', $wd_default_data['slider']['default']['column_tablet']);
				$data['column_mobile']					= wd_get_theme_option('slider_column_mobile', $wd_default_data['slider']['default']['column_mobile']);
				$data['autoplay']						= wd_get_theme_option('slider_autoplay', $wd_default_data['slider']['default']['autoplay']);
				$data['autoplay_hover_pause']			= wd_get_theme_option('slider_autoplay_hover_pause', $wd_default_data['slider']['default']['autoplayHoverPause']);
				$data['autoplay_speed']				= wd_get_theme_option('slider_autoplay_speed', $wd_default_data['slider']['default']['autoplaySpeed']);
				$data['autoplay_timeout']				= wd_get_theme_option('slider_autoplay_timeout', $wd_default_data['slider']['default']['autoplayTimeout']);
				$data['autoplay_mobile']				= wd_get_theme_option('slider_autoplay_mobile', $wd_default_data['slider']['default']['autoplay_mobile']);
				$data['arrows']						= wd_get_theme_option('slider_arrows', $wd_default_data['slider']['default']['arrows']);
				$data['dots']							= wd_get_theme_option('slider_dots', $wd_default_data['slider']['default']['dots']);
				$data['infinite']						= wd_get_theme_option('slider_infinite', $wd_default_data['slider']['default']['infinite']);
				$data['responsive_refresh_rate'] 		= wd_get_theme_option('slider_responsive_refresh_rate', $wd_default_data['slider']['default']['responsiveRefreshRate']);
				$data['nav_rewind']					= wd_get_theme_option('slider_nav_rewind', $wd_default_data['slider']['default']['navRewind']);
				$data['nav_speed']						= wd_get_theme_option('slider_nav_speed', $wd_default_data['slider']['default']['navSpeed']);
				$data['margin']						= wd_get_theme_option('slider_margin', $wd_default_data['slider']['default']['margin']);
				$data['auto_height']					= wd_get_theme_option('slider_auto_height', $wd_default_data['slider']['default']['autoHeight']);
				$data['mouse_drag']					= wd_get_theme_option('slider_mouse_drag', $wd_default_data['slider']['default']['mouseDrag']);
				$data['touch_drag']					= wd_get_theme_option('slider_touch_drag', $wd_default_data['slider']['default']['touchDrag']);
				$data['animate_in']					= wd_get_theme_option('slider_animate_in', $wd_default_data['slider']['default']['animateIn']);
				$data['animate_out']					= wd_get_theme_option('slider_animate_out', $wd_default_data['slider']['default']['animateOut']);
				break;
		}
		
		return $data;
	}
}


if(!function_exists ('wd_get_theme_option')){
	function wd_get_theme_option( $keyname, $default_value = '', $type = 'normal' ) {
		global $wd_theme_options;
		$data = '';
		if (isset($wd_theme_options[$keyname])) {
			if ($type == 'image') {
				$data = $wd_theme_options[$keyname]['url'];
			}elseif ($type == 'font') {
				$data = $wd_theme_options[$keyname]['font-family'];
			}elseif ($type == 'height') {
				$data = $wd_theme_options[$keyname]['height'];
			}elseif ($type == 'width') {
				$data = $wd_theme_options[$keyname]['width'];
			}else{
				$data = $wd_theme_options[$keyname];
			}
		}else{
			$data = $default_value;
		}
		return $data;
	}
}
