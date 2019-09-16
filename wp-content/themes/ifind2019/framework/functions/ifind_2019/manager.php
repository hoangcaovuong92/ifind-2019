<?php
/**
 * @author : Cao Vuong.
 * -Email  : hoangcaovuong92@gmail.com.
 * 
 */

if (!class_exists('iFind2019_Content')) {
	class iFind2019_Content {
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

		private $template_file = 'templates/ifind_2019.php';

		public function __construct(){
			// Ensure construct function is called only once
			if ( static::$called ) return;
            static::$called = true;
            
            $this->include_libraries();

			//Adding classes to body element
			add_filter('body_class', array($this, 'body_classes'));
			
			add_action('wp_enqueue_scripts', array($this,'enqueue_scripts'));
			
			//do_action('ifind_hook_display_main_content');
            add_action('ifind_hook_display_main_content', array($this, 'main_content'));
			
			add_action( 'admin_init', array($this, 'hide_editor') );
		}

		public function include_libraries() {
			// if(file_exists(dirname(__FILE__) . '/api.php')){
            //     require_once ( dirname(__FILE__) . '/api.php' );
            // }
		}
		
		public function hide_editor() {
			$post_id = isset($_GET['post']) ? $_GET['post'] : false ;
			if( !isset( $post_id ) ) return;
		
			$template_file = get_post_meta($post_id, '_wp_page_template', true);
			
			if($template_file == $this->template_file){ // edit the template name
				remove_post_type_support('page', 'editor');
				remove_post_type_support('page', 'thumbnail');
			}
		}

        public function body_classes( $classes ) {
			if (is_page_template( $this->template_file )) {
				$classes[] = 'ifind-2019-page';
			}
			return $classes;
		}

		public function reorder_sections() {
			return array(
				'section_map',
				'section_ads',
			);
		}
		
        //Display landing page content
        public function main_content(){
			$settings = $this->get_settings();
			ob_start(); ?>
				<div class="ifind-2019-wrapper">
					<?php
					if (!empty($this->reorder_sections())) {
						$slider_options = json_encode(array(
							'slider_type' => 'slick',
						)); ?>
						<div class="wd-slider-wrap wd-slider-wrap--main" data-slider-options='<?php echo $slider_options; ?>'> 
							<?php
							foreach ($this->reorder_sections() as $section_id) {
								$section_id = trim($section_id);
								$setting = $settings[$section_id];
								if (!$setting['status']) continue;

								ob_start();
								switch ($section_id) {
									case 'section_map': ?>
										<div class="ifind-2019-section ifind-2019-section--map">
											<div class="ifind-2019-section-container">
												<h2><?php echo $setting['title']; ?></h2>
												<div class="ifind-2019-map-image wow bounceInRight">
													<img class="ifind-2019-map-main-image" src="<?php echo esc_url($setting['image']); ?>" alt="<?php echo esc_html($setting['title']); ?>">
													<img id="ifind-2019-map-mark" style="top: <?php echo $setting['current_location']['top']; ?>%; left: <?php echo $setting['current_location']['left']; ?>%;" data-toggle="tooltip" title="<?php esc_html_e( 'You are here!', 'ifind' ) ?>" data-wow-iteration="200" class="wow bounce" data-wow-delay="1s" src="<?php echo WD_THEME_IMAGES.'/marker.png'; ?>" alt=""> 
												</div>
												<?php if (!empty($setting['location'])) { ?>
													<div class="ifind-location-list wow bounceInRight">
														<?php foreach ($setting['location'] as $item) { ?>
														<div class="ifind-location-item">
															<a data-toggle="tooltip" title="<?php echo !empty($item['tool_tip_text']) ? $item['tool_tip_text'] : $item['name']; ?>" data-top="<?php echo $item['top']; ?>" data-left="<?php echo $item['left']; ?>" href="">
																<i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $item['name']; ?>
															</a>
														</div>
														<?php } ?>
													</div>
												<?php } ?>
											</div>
										</div>
										<?php
										break;
									case 'section_ads': ?>
										<?php if (!empty($setting['images'])) { 
											foreach ($setting['images'] as $key => $ads) {
												$second_page_type = $ads['second_page_type'];
												$fancybox_link = '';
												if ($second_page_type == 'image') {
													$fancybox_link = $ads['second_image'];
												}elseif ($second_page_type == 'html'){
													$fancybox_link = $ads['second_html'];
												} ?>
												<div class="ifind-2019-section ifind-2019-section--ads wow bounceInRight">
													<a href="#" class="button ifind-back-to-map">Back To Map</a>
													<a class="fancybox fancybox.iframe ifind-fancybox-<?php echo $second_page_type; ?>" 
														data-target_id="<?php echo $key; ?>" 
														href="<?php echo $fancybox_link; ?>" content="<p>">
														<img src="<?php echo esc_url($ads['image']); ?>">
													</a>
													<?php if ($second_page_type == 'listing') { ?>
														<div id="ifind-second-page-content-<?php echo $key; ?>" style="display: none;">
															<?php 
															$posts = $this->get_news(-1, $ads['second_listing']);
															if (!empty($posts)) { ?>
																<div class="ifind-product-list">
																	<?php foreach ($posts as $id => $post) { ?>
																	<div class="ifind-product-item">
																		<a data-product_id="<?php echo $id; ?>" class="ifind-product-item-view-album" data-toggle="tooltip" title="<?php esc_html_e( 'View Albums', 'ifind' ) ?>" href=""><i class="fa fa-picture-o" aria-hidden="true"></i></a>
																		<div class="ifind-product-item-time-open"><?php echo $post['time_open']; ?></div>
																		<div class="ifind-product-item-thumbnail">
																			<img src="<?php echo esc_url($post['image']); ?>" alt="<?php echo esc_html($post['title']); ?>">
																		</div>
																		<div class="ifind-product-item-content">
																			<div class="ifind-product-item-type"><?php echo $post['type']; ?></div>
																			<div class="ifind-product-item-owner"><?php echo $post['owner']; ?></div>
																			<div class="ifind-product-item-title"><?php echo $post['title']; ?></div>
																			<div class="ifind-product-item-short-description"><?php echo $post['short_description']; ?></div>
																			<div class="ifind-product-item-price"><?php echo $post['price']; ?></div>
																			<a data-product_id="<?php echo $id; ?>" class="ifind-product-item-view-content" data-toggle="tooltip" title="<?php esc_html_e( 'Read Detail', 'ifind' ) ?>" href=""><i class="fa fa-long-arrow-right" aria-hidden="true"></i> <?php esc_html_e( 'Read Detail', 'ifind' ) ?></a>
																		</div>
																		<div id="ifind-product-item-popup-content-<?php echo $id; ?>" style="display: none;">
																			<?php echo $post['content']; ?>
																		</div>
																	</div>
																	<?php } ?>
																</div>
															<?php } ?>
														</div>
													<?php } ?>
												</div>
										<?php }
										}
										break;
								}
							} ?>
						</div>
					<?php } ?>
				</div>
			<?php
			echo ob_get_clean();
			//var_dump($this->get_settings());
		} 
		
        public function get_settings(){
			$settings = array(
				'section_map' => array(
					'status' => get_field('map_status'),
					'title' => get_field('map_title'),
					'image' => get_field('map_image'),
					'current_location' => get_field('map_current_location'),
					'location' => get_field('map_location'),
				),
				'section_ads' => array(
					'status' => true,
					'images' => get_field('ads_images'),
				),
			);
			
			return $settings;
		} 
		
		public function get_news($ppp = '-1', $include = '') {
			$args = array(
				'post_type'      => 'listing',
				'posts_per_page' => $ppp,
				'orderby'        => 'date',
				'order'          => 'ASC',
			);
			if ($include) {
				$args['tax_query'][] = array(
					'taxonomy' 		=> 'listing-group',
					'terms' 		=> explode(",", $include),
					'field' 		=> 'term_id',
					'operator' 		=> 'IN'
				);
			}
			$posts = new WP_Query($args);
			$result = array();
			wp_reset_query();
			if ( $posts->have_posts() ) {
				while( $posts->have_posts() ) { 
					$posts->the_post();	global $post;
					$result[get_the_ID()]['title'] = get_the_title();
					$result[get_the_ID()]['content'] = get_the_content();
					$result[get_the_ID()]['image'] = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'post-thumb') : WD_THEME_URI . 'framework/functions/ifind_2019/img/post_thumbnail_default.png';
					$result[get_the_ID()]['time'] = get_the_date( 'd/m/Y H:i' );
					$result[get_the_ID()]['url'] = get_the_permalink();
					$result[get_the_ID()]['time_open'] = get_field('single_listing_time_open');
					$result[get_the_ID()]['type'] = get_field('single_listing_type');
					$result[get_the_ID()]['owner'] = get_field('single_listing_owner');
					$result[get_the_ID()]['short_description'] = get_field('single_listing_short_description');
					$result[get_the_ID()]['price'] = get_field('single_listing_price');
					$result[get_the_ID()]['albums'] = get_field('single_listing_albums');
				}
			} 
			wp_reset_query();
			return $result;
		}

		public function run_video_shortcode($args = array()) {
			$default = array(
				'video_url' => '',
				'video_desc' => '',
			);
			extract(wp_parse_args($args, $default));
			if (empty($video_url)) return;

			if (strpos($video_url, 'youtube') > 0 || strpos($video_url, 'youtu.be') > 0 || strpos($video_url, 'vimeo') > 0) {
				global $wp_embed;
				echo $wp_embed->run_shortcode( '[embed]'.$video_url.'[/embed]' );
			} 
			echo '<div class="yt-video-desc">'.esc_html($video_desc).'</div>';
		}

        //Enqueue Style And Script
		public function enqueue_scripts(){
            if (is_page_template( $this->template_file )) {
                global $wp_query;
                $ajax_object_vars = array(
                    'ajax_url' 		=> admin_url( 'admin-ajax.php' ),
                    'query_vars'	=> json_encode( $wp_query->query ),
                    'ajax_nonce'	=> wp_create_nonce( 'ajax-request-$p3c!@l-t0k3n-v2' )
                );
				$slider_default_setting = apply_filters('wd_filter_data_slider_setting', array());

                wp_enqueue_script('yt-ifind-2019-js',  WD_THEME_URI . '/framework/functions/ifind_2019/js/scripts.js', array(), '1.3.3.10', true);
				wp_localize_script('yt-ifind-2019-js', 	'ajax_object', $ajax_object_vars);
				wp_localize_script('yt-ifind-2019-js', 	'slider_default_setting', $slider_default_setting);
			}
			wp_enqueue_style('yt-ifind-2019-style', WD_THEME_URI . '/framework/functions/ifind_2019/css/style.css', array(), '1.3.3.10', 'all');
		}
	}
	iFind2019_Content::get_instance();  // Start an instance of the plugin class 
}