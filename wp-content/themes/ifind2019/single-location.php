<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Wordpress
 */

get_header(); 	
$post_ID		= wd_get_post_by_global();

/**
 * wd_before_main_content hook.
 *
 * @hooked wd_content_before_main_content
 */
do_action('wd_before_main_content'); ?>
	<?php 
	$location_meta_data = ifind_get_post_custom_metadata(get_the_ID(), 'location');
	$location_lat = $location_meta_data['location_data']['lat'];
	$location_lng = $location_meta_data['location_data']['lng'];
	$location_address = $location_meta_data['location_data']['address'];
	$location_max_distance = $location_meta_data['max_distance'];
	$location_email = $location_meta_data['email_address'];
	$location_time_zone = ifind_get_nearest_timezone($location_lat, $location_lng);
	?>
	<!-- Header -->
	<div id="ifind-location-position" 
		data-timezone="<?php echo $location_time_zone; ?>" 
		data-location-email="<?php echo $location_email; ?>" 
		data-max-distance="<?php echo $location_max_distance; ?>" 
		data-lat="<?php echo $location_lat; ?>" 
		data-lng="<?php echo $location_lng; ?>" style="display:none;"></div>
	<?php get_template_part( 'sections/popup-slider'); ?>
	<div id="ifind-header-wrap">
		<section class="row ifind-section ifind-header-top">
			
			<div class="col-xs-7 ifind-col ifind-col-left wow bounceInDown" data-wow-delay=".25s"">
				
				<div class="header-title"><?php esc_html_e( 'Welcome to', 'ifind' ); ?></div>
				<h1 class="header-page-name"><?php the_title(); ?></h1>
				<div class="header-slogan"><?php echo $location_meta_data['slogan']; ?></div>
			</div>

			<div class="col-xs-5 ifind-col ifind-col-right wow bounceInDown" data-wow-delay=".25s">
				<?php if ($location_meta_data['office_hours']) { ?>
					<div class="header-title"><?php esc_html_e( 'Office Hours:', 'ifind' ); ?></div>
					<div class="header-page-info"><?php echo $location_meta_data['office_hours']; ?></div>
				<?php } ?>
				<?php if ($location_meta_data['contact_number']) { ?>
					<div class="header-title"><?php esc_html_e( 'Contact Number:', 'ifind' ); ?></div>
				<div class="header-page-info"><?php echo $location_meta_data['contact_number']; ?></div>
				<?php } ?>
			</div>
		</section>

		<section class="row ifind-section ifind-header-main <?php echo ( class_exists('GTranslate') ) ? 'gtranslate-show' : '' ?>">
			<div class="col-xs-7 ifind-col ifind-col-left wow bounceInLeft" data-wow-delay=".5s">
				<?php get_template_part( 'sections/small-slider'); ?>
				<?php if( class_exists('GTranslate') ){ ?>
					<div class="ifind-gtranslate">
						<?php echo do_shortcode( '[GTranslate]' ); ?>
					</div>
				<?php } ?>
			</div>
			<div class="col-xs-5 ifind-col ifind-col-right wow bounceInRight" data-wow-delay=".5s">
				<div class="ifind-weather">
					<?php echo ifind_display_weather_today_info($location_lat, $location_lng);?>
				</div>
				
			</div>
		</section>
	</div>

	<!-- Main content -->
	<section class="row ifind-section ifind-section-flex ifind-content-main">
		<div class="col-xs-5 ifind-col ifind-col-left ifind-map-wrap wow bounceInLeft" data-wow-delay=".75s">
			<div class="top-content">
				<img data-wow-iteration="200" class="wow bounce" data-wow-delay="1s" src="<?php echo WD_THEME_IMAGES.'/marker.png'; ?>" alt=""> 
				<span class="header-title"><?php esc_html_e( 'You are here!', 'ifind' ) ?></span>
			</div>
			<?php get_template_part( 'sections/map'); ?>
		</div>

		<div class="col-xs-7 ifind-col ifind-col-right wow bounceInRight" data-wow-delay=".75s">
	<?php get_template_part( 'sections/business-tab'); ?>
		</div>
	</section>

	<!-- Footer -->
	<section class="row ifind-section ifind-footer-main wow fadeIn" data-wow-delay="1s">
		<?php get_template_part( 'sections/footer-slider'); ?>
	</section>
<?php 
/**
 * wd_after_main_content hook.
 *
 * @hooked wd_content_after_main_content
 */
do_action('wd_after_main_content'); ?>

<?php get_footer(); ?>