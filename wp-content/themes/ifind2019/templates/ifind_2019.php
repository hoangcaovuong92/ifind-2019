<?php
// Template name: iFind 2019

get_header(); 
$post_ID		= wd_get_post_by_global();

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
				<?php do_action('ifind_hook_display_main_content'); ?>
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