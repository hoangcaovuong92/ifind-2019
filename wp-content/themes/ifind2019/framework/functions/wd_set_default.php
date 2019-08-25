<?php 
/**
 * TVLGIAO WPDANCE FRAMEWORK 2017.
 *
 * @author : Cao Vuong.
 * -Email  : hoangcaovuong92@gmail.com.
 */
 
if(!function_exists ('wd_get_theme_option_default_data')){
	function wd_get_theme_option_default_data(){
		return array(
		    'google_map'       => array(
		        'default'       => array(
		            'api_key'     	=> 'AIzaSyAwJR7kylDCymhx59VKffi40Ez1qaU6aSo',
		            'zoom'    		=> 17,
		        ),
			),
			'weather'       => array(
		        'default'       => array(
					'api_key'     	=> 'b3e451be6f631c7934a9dccec4a6ab7d',
					'update_time'	=> 60000
		        ),
			),
			'slider'       => array(
		        'default'       => array(
					'timerShowPopup'    => 15000,
					'timerShowPopupViewingInfo'    => 60000,
					'timerDelayPopup'	=> 15000,
					'bigAutoplaySpeed'	=> 10000,
					'smallAutoplaySpeed' => 10000,
					'numSliderBreak' 	=> 3,
					'numFooterSliderItems'=> 1,
					'column_mobile' => 1,
					'column_tablet' => 1,
					'column_desktop' => 1,
					'autoplay' => 1,
					'autoplay_mobile' => 0,
					'autoplayHoverPause' => 1, //owl
					'autoplaySpeed' => 20000, 
					'autoplayTimeout' => 5000, //owl
					'arrows' => 1,
					'dots' => 0,
					'infinite' => 1,
					'responsiveRefreshRate' => 200,
					'navRewind' => 0,
					'navSpeed' => 1000,
					'margin' => 30, //owl
					'autoHeight' => 1, //owl
					'mouseDrag' => 1, //owl
					'touchDrag' => 1, //owl
					'animateIn' => 0, //owl
					'animateOut' => 0, //owl
		        ),
			),
			'columns'  => array(
				'choose'        	=>  array(
					'desktop' => array(
						'1' => esc_html__( '1 Column', 'feellio' ),
						'2' => esc_html__( '2 Columns', 'feellio' ),
						'3' => esc_html__( '3 Columns', 'feellio' ),
						'4' => esc_html__( '4 Columns', 'feellio' ),
						'6' => esc_html__( '6 Columns', 'feellio' ),
					),
					'tablet' => array(
						'1' => esc_html__( '1 Column', 'feellio' ),
						'2' => esc_html__( '2 Columns', 'feellio' ),
						'3' => esc_html__( '3 Columns', 'feellio' ),
					),
					'mobile' => array(
						'1' => esc_html__( '1 Column', 'feellio' ),
						'2' => esc_html__( '2 Columns', 'feellio' ),
					),
				),
		        'default'       => array(
		        )
			),
			
		);
	}
}