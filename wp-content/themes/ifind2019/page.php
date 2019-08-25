<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other 'pages' on your WordPress site will use a different template.
 *
 * @package Wordpress
 * @since wpdance
 *
 **/

get_header(); 
$post_ID		= wd_get_post_by_global();
/*PAGE CONFIG*/
$_page_config 	= wd_get_custom_layout($post_ID);

/**
 * wd_before_main_content hook.
 *
 * @hooked wd_content_before_main_content
 */
do_action('wd_before_main_content'); ?>
	<div class="row">
		<!-- Content Index -->
		<?php if ( have_posts() ) : ?>
			<!-- Start the Loop --> 
			<?php while ( have_posts() ) : the_post(); ?>
			áđâsd
				<?php the_content(); ?>
			<?php endwhile; ?>
		<?php endif; // End If Have Post ?>
	</div>

<?php 
/**
 * wd_after_main_content hook.
 *
 * @hooked wd_content_after_main_content
 */
do_action('wd_after_main_content'); ?>

<?php get_footer(); ?>