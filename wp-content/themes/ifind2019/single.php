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
	<div class="row">
	</div>

<?php 
/**
 * wd_after_main_content hook.
 *
 * @hooked wd_content_after_main_content
 */
do_action('wd_after_main_content'); ?>

<?php get_footer(); ?>