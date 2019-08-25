<?php
/**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Wordpress
 * @since wpdance
 */
?><!DOCTYPE html>
<html itemscope <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php 
	/**
	 * wd_header_meta_data hook.
	 *
	 * @hooked wd_accessibility_display_favicon - 5
	 * @hooked wd_accessibility_facebook_comment_setting_meta - 10
	 */
	do_action('wd_header_meta_data'); ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php 
/**
 * wd_after_opening_body_tag hook.
 *
 * @hooked wd_accessibility_facebook_comment_api - 5
 * @hooked wd_accessibility_loading_page_effect - 10
 * @hooked wd_content_pushmenu_mobile - 15
 */ 
do_action('wd_after_opening_body_tag'); ?>
<div class="body-wrapper">
<header id="header" class="header">
	<div class="wd-header-content wd-header-mobile visible-xs visible-sm">
		<?php
		/**
		 * wd_header_mobile hook.
		 *
		 * @hooked wd_content_header_mobile - 5
		 */ 
		do_action('wd_header_mobile'); ?>
	</div>
	<div id="ifind-secret-key" data-secret-key="<?php echo ifind_get_secret_key(); ?>"></div>
</header> <!-- END HEADER  -->