<!DOCTYPE html>
<html itemscope <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>"/>
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1"/> -->
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="body-wrapper">
<header id="header" class="header">
	<div id="wd-loader-wrapper">
		<div class="wd-loader wd-loader--style-2">
			<div class="wd-loader-content">
				<span class="line line-1"></span>
				<span class="line line-2"></span>
				<span class="line line-3"></span>
				<span class="line line-4"></span>
				<span class="line line-5"></span>
				<span class="line line-6"></span>
				<span class="line line-7"></span>
				<span class="line line-8"></span>
				<span class="line line-9"></span>
				<div><?php esc_html_e("Loading", 'feellio'); ?></div>
			</div>
		</div>
	</div>
	<div id="ifind-secret-key" data-secret-key="<?php echo ifind_get_secret_key(); ?>"></div>
</header> <!-- END HEADER  -->