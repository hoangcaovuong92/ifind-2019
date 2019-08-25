<?php
/**
 * WPDANCE FRAMEWORK 2018.
 *
 * @author : Cao Vuong.
 * -Email  : hoangcaovuong92@gmail.com.
 */

if (!class_exists('WD_Slider')) {
	class WD_Slider {
		/**
		 * Refers to a single instance of this class.
		 */
		private static $instance = null;

		// Ensure construct function is called only once
		private static $called = false;

		public static function get_instance() {
			if ( null == self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}


		public function __construct(){
			// Ensure construct function is called only once
			if ( static::$called ) return;
			static::$called = true;
			
			//Slider control HTML
			//echo apply_filters('wd_filter_slider_control', array('custom_class' => '')); //Display slider control HTML
			add_filter( 'wd_filter_slider_control', array($this, 'slider_control' ), 10, 2);

			//$responsive = apply_filters('wd_filter_data_slider_setting', array()); //Get list screen responsive size
            add_filter('wd_filter_data_slider_setting', array($this, 'slider_default_settings'), 10, 2);
		}

		// Slider Control HTML
		public function slider_control($args = array()) {
			$default = array(
				'custom_class' => ''
			);
			extract(wp_parse_args($args, $default));
			ob_start(); ?>
			<div class="wd-slider-control <?php echo esc_html($custom_class); ?>">
				<a class="prev" href="#" data-toggle="tooltip" title="<?php esc_html_e('Previous', 'feellio');?>">
					<?php do_action('wd_hook_display_icon', 'slider-prev'); ?>
				</a>
				<a class="next" href="#" data-toggle="tooltip" title="<?php esc_html_e('Next', 'feellio');?>">
					<?php do_action('wd_hook_display_icon', 'slider-next'); ?>
				</a>
			</div> 
			<?php
			return ob_get_clean();
		}

		public function slider_default_settings($data){
			/**
			 * package: slider
			 * var: column_desktop
			 * var: column_tablet
			 * var: column_mobile
			 * var: autoplay
			 * var: autoplay_hover_pause
			 * var: autoplay_speed
			 * var: autoplay_timeout
			 * var: autoplay_mobile
			 * var: arrows
			 * var: dots
			 * var: infinite
			 * var: responsive_refresh_rate
			 * var: nav_rewind
			 * var: nav_speed
			 * var: margin
			 * var: auto_height
			 * var: mouse_drag
			 * var: touch_drag
			 * var: animate_in
			 * var: animate_out
			 */
			$data = wd_get_data_package( 'slider-default' );
			return $data;
		}
	}
	WD_Slider::get_instance();  // Start an instance of the plugin class 
}