<?php
if (!class_exists('ifindThemeSetting')) {
	class ifindThemeSetting{
		/**
		 * Refers to a single instance of this class.
		 */
		private static $instance = null;

		public static function get_instance() {
			if ( null == self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		//Variable
		protected $theme_name		= 'ifind';
		protected $theme_slug		= 'ifind';

		protected $arr_functions 	= array();

		//Constructor
		public function __construct(){
			$this->constant();
			$this->init_arr_functions();
			$this->after_setup_theme();
			$this->init_functions();

			$this->init_metabox();
			$this->init_theme_options();

			//Send email with HTML
			add_filter( 'wp_mail_content_type', array($this, 'send_mail_set_content_type') );

			//Notice alert
			add_action('admin_notices', array($this,'show_msg'));
		}

		// Function Setup Theme
		public function after_setup_theme(){
			//After setup theme
			add_action( 'after_setup_theme', array($this,'setup_theme_func'));
		}

		// Constant
		protected function constant(){			
			// Default
			define('WD_DS'						, DIRECTORY_SEPARATOR);	
			define('WD_THEME_NAME'				, $this->theme_name );
			define('WD_THEME_SLUG'				, $this->theme_slug.'_');
			define('WD_THEME_DIR'				, get_template_directory());
			define('WD_THEME_URI'				, get_template_directory_uri());
			define('WD_THEME_ASSET_URI'			, WD_THEME_URI 			. '/assets');
			// Style-Script-Image
			define('WD_THEME_IMAGES'			, WD_THEME_ASSET_URI 		. '/images');
			define('WD_THEME_CSS'				, WD_THEME_ASSET_URI 		. '/css');
			define('WD_THEME_JS'				, WD_THEME_ASSET_URI 		. '/js');
			define('WD_THEME_FONT'				, WD_THEME_ASSET_URI 		. '/fonts');
			define('WD_THEME_EXTEND_LIBS'		, WD_THEME_ASSET_URI 		. '/libs');
			//Framework Theme
			define('WD_THEME_FRAMEWORK'			, WD_THEME_DIR 			. '/framework');
			define('WD_THEME_FRAMEWORK_URI'		, WD_THEME_URI 			. '/framework');
			//Folder in Framework
			define('WD_THEME_FUNCTIONS'			, WD_THEME_FRAMEWORK 		. '/functions');	
			define('WD_THEME_PLUGIN'			, WD_THEME_FRAMEWORK 		. '/plugins');
			define('WD_THEME_SHORTCODES'		, WD_THEME_FRAMEWORK 		. '/shortcodes');
			define('WD_THEME_METABOX'			, WD_THEME_FRAMEWORK 		. '/metabox');
			define('WD_THEME_METABOX_URI'		, WD_THEME_FRAMEWORK_URI 	. '/metabox');
			//Folder WPDANCE
			define('WD_THEME_WPDANCE'			, WD_THEME_FRAMEWORK 		. '/wpdance');
			define('WD_THEME_WPDANCE_URI'		, WD_THEME_FRAMEWORK_URI 	. '/wpdance');
			define('WD_THEME_SUPPORT'			, WD_THEME_WPDANCE 		. '/supports');
			define('WD_THEME_SUPPORT_URI'		, WD_THEME_WPDANCE_URI 	. '/supports');
			define('WD_THEME_CUSTOMIZE'			, WD_THEME_SUPPORT 		. '/theme_customize');
			define('WD_THEME_CUSTOMIZE_URI'		, WD_THEME_SUPPORT_URI 	. '/theme_customize');
			define('WD_THEME_GUIDE'				, WD_THEME_SUPPORT 		. '/theme_guide');
			define('WD_THEME_GUIDE_URI'			, WD_THEME_SUPPORT_URI 	. '/theme_guide');
			define('WD_THEME_OPTIONS'			, WD_THEME_SUPPORT 		. '/theme_option');

		}

		//Setup Theme
		public function setup_theme_func(){
		    global $content_width;
		    if ( !isset($content_width) ) {
		        $content_width = 1080;
		    }
			//Make theme available for translation
			//Translations can be filed in the /languages/ directory
   			load_theme_textdomain('ifind', get_template_directory() . '/languages');
   			
   			//Import Theme Support
   			$this->theme_support();
   			//Import Script / Style
   			add_action('wp_enqueue_scripts',array($this,'enqueue_scripts'));
			add_action('admin_enqueue_scripts',array($this,'admin_enqueue_scripts'));
			
			//Remove admin bar front end
			show_admin_bar(false);
		}

		//Theme Support
		public function theme_support(){
			// Enable support for Post Formats.
			add_theme_support('post-thumbnails');
			add_theme_support('title-tag');
			
			//Add Image Size
			//set_post_thumbnail_size( 640, 440, true );
			add_image_size('map_logo', 40, 40, false);
			add_image_size('small_banner', 1080, 360, true);
			add_image_size('tab_banner_image', 750, 300, true);
			add_image_size('tab_avatar_image', 150, 150, true);
		}

		public function send_mail_set_content_type(){
			return "text/html";
		}

		public function show_msg(){
			$list_msg 	= array();
			$list_msg['refresh_window']['class'] 	= 'notice notice-success is-dismissible';
			$list_msg['refresh_window']['header'] 	= '';
			$list_msg['refresh_window']['message'] = '<span class="dashicons dashicons-image-rotate"></span> <a href="#" class="ifind-reload-browser">'.__( 'Click here to reload all browser!', 'ifind' ).'</a>';


			foreach ($list_msg as $key => $mess) {
				printf( '<div class="%1$s"><strong>%2$s<p>%3$s</p></strong></div>', esc_attr( $mess['class'] ),$mess['header'], $mess['message'] );
			}
		}	

		//Include Function
		protected function init_arr_functions(){
			$this->arr_functions = array(
				'class/class-tgm-plugin-activation',
				'class/qrcode',
				'class/dompdf/autoload.inc',
				'wd_main',
				'wd_set_default',
				'wd_get_customize_data',
				'wd_ajax_function',
				'wd_register_tgmpa_plugin',
				'wd_statistics'
			);
		}
		
		//Include Customize
		protected function init_arr_customize(){
			$this->arr_customize = array(
				'libs/add-control-custom-radio-image',
				'libs/wd-add-control-custom-font',
				'libs/wd_customize_sanitize_callback',
				'wd_customize',
			);
		}
		// Load File
		protected function init_functions(){
			foreach($this->arr_functions as $function){
				if(file_exists(WD_THEME_FUNCTIONS."/{$function}.php")){
					require_once WD_THEME_FUNCTIONS."/{$function}.php";
				}	
			}
		}
		protected function init_theme_options(){
			if ( ! class_exists( 'ReduxFramework' ) ) return;
			if(file_exists(WD_THEME_OPTIONS. "/wd_theme_options.php")){
				require_once WD_THEME_OPTIONS. "/wd_theme_options.php";
			}
		}
		protected function init_metabox(){
			if(file_exists(WD_THEME_METABOX.'/wd_metaboxes.php')){
				require_once WD_THEME_METABOX.'/wd_metaboxes.php';
			}
		}
		
		//Enqueue Style And Script
		public function enqueue_scripts(){
			global $wp_query, $tvlgiao_wpdance_theme_options;
			$ajax_object_vars = array(
				'ajax_url' 			=> admin_url( 'admin-ajax.php' ),
				'query_vars'		=> json_encode( $wp_query->query )
			);
			/*----------------- Style ---------------------*/
			//Google font
			$font_family = array(
				'Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic', 
				'Pacifico:400', 
				'Roboto:300,400,500,700', 
				'Fredoka+One',
			);
			wp_enqueue_style( "ifind-google-font", "//fonts.googleapis.com/css?family=".implode('|', $font_family) );

			// LIB
			wp_enqueue_style('bootstrap-core', 			'//stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
			wp_enqueue_style('font-awesome-css', 		'//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
			wp_enqueue_style('flexslider-css', 			'//cdnjs.cloudflare.com/ajax/libs/flexslider/2.5.0/flexslider.min.css');
			wp_enqueue_style('fancybox-css', 			'//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.7/css/jquery.fancybox.min.css');
			wp_enqueue_style('slick-core', 				WD_THEME_EXTEND_LIBS.'/slick/slick.css');
			wp_enqueue_style('slick-theme-css', 		WD_THEME_EXTEND_LIBS.'/slick/slick-theme.css');
			wp_enqueue_style('wowjs-css', 				WD_THEME_EXTEND_LIBS.'/wowjs/css/animate.css');
			wp_enqueue_style('softkey-css', 			WD_THEME_EXTEND_LIBS.'/softkey/softkeys-0.0.1.css');
			wp_enqueue_style('jquery.steps-css', 		WD_THEME_EXTEND_LIBS.'/jquery.steps/jquery.steps.css');
			
			// CSS OF THEME
			wp_enqueue_style('wd-theme-desc-css', 		WD_THEME_URI.'/style.css');
			wp_enqueue_style('wd-theme-main-css', 		WD_THEME_CSS.'/style.css');

			/*----------------- Script ---------------------*/
			// Wordpress Libs
			wp_enqueue_script('jquery');
			// LIB
			wp_enqueue_script('bootstrap-core', 		'//stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array('jquery'), false, true);
			wp_enqueue_script('fancybox-js', 			'//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.7/js/jquery.fancybox.min.js' ,array('jquery'),false,true);
			wp_enqueue_script('googmap-geometry-js', 	'//cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js' ,array('jquery'),false,true);
			wp_enqueue_script('swal-js', 				'//unpkg.com/sweetalert/dist/sweetalert.min.js"' ,array('jquery'),false,true);
			wp_enqueue_script('slick-core', 			WD_THEME_EXTEND_LIBS.'/slick/slick.min.js',array('jquery'),false,true);
			wp_enqueue_script('wowjs-js', 				WD_THEME_EXTEND_LIBS.'/wowjs/js/wow.min.js',array('jquery'),false,true);
			wp_enqueue_script('softkey-js', 			WD_THEME_EXTEND_LIBS.'/softkey/softkeys-0.0.1.js',array('jquery'),false,true);
			wp_enqueue_script('jquery.steps-js', 		WD_THEME_EXTEND_LIBS.'/jquery.steps/jquery.steps.min.js',array('jquery'),false,true);

			
			wp_enqueue_script('wd-main-js', 			WD_THEME_JS.'/wd_main.js', array('jquery'), false, true);
			wp_localize_script('wd-main-js', 			'ajax_object', $ajax_object_vars);
			wp_localize_script('wd-main-js', 			'option_object', $tvlgiao_wpdance_theme_options);
			wp_localize_script('wd-main-js', 			'list_business_video', ifind_include_list_video_id_to_header());

			wp_enqueue_script('wd-slider-js', 			WD_THEME_JS.'/wd_slider.js', array('jquery'), false, true);
			wp_localize_script('wd-slider-js', 			'option_object', $tvlgiao_wpdance_theme_options);
		}

		//Enqueue Style And Script
		public function admin_enqueue_scripts(){
			global $tvlgiao_wpdance_theme_options;
			$ajax_object_vars = array(
				'ajax_url' 			=> admin_url( 'admin-ajax.php' ),
				'query_vars'		=> json_encode( $wp_query->query )
			);
			wp_enqueue_media();
			wp_enqueue_style('font-awesome-css', 		'//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
			wp_enqueue_style('morris-css', 				'//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css');
			wp_enqueue_style('statistics-css', 			WD_THEME_CSS.'/statistics.css');

			// Load the datepicker script (pre-registered in WordPress).
			wp_enqueue_script( 'jquery-ui-datepicker' );
			// You need styling for the datepicker. For simplicity I've linked to Google's hosted jQuery UI CSS.
			wp_register_style( 'jquery-ui', 			'http://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css' );
			wp_enqueue_style( 'jquery-ui' );  

			wp_enqueue_script('swal-js', 				'//unpkg.com/sweetalert/dist/sweetalert.min.js"' ,array('jquery'),false,true);
			wp_enqueue_script('raphael-js', 			'//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"' ,array('jquery'),false,true);
			wp_enqueue_script('morris-js', 				'//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"' ,array('jquery'),false,true);
			wp_enqueue_script('wd-admin-js', 			WD_THEME_JS.'/wd_admin.js', array('jquery'), false, true);
			wp_localize_script('wd-admin-js', 			'option_object', $tvlgiao_wpdance_theme_options);
			wp_localize_script('wd-admin-js', 			'ajax_object', $ajax_object_vars);
		}
	}
	ifindThemeSetting::get_instance();
} ?>