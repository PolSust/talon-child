<?php

/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Talon
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php talon_mobile_menu(); ?>
	<div canvas="container" id="page" class="site">
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'talon'); ?></a>

		<nav id="menu">

			<div id="logoContainer">
				<ul>
					<li id="logo"><?php if (function_exists('the_custom_logo')) the_custom_logo(); ?></li>
					<li>
						<h3><?= get_bloginfo('blogname'); ?></h3>
					</li>
				</ul>
			</div>
			<div id="links">
				<?php
				wp_nav_menu(array(
					"sort_column" => "menu-order",
					"theme_location" => "primary",
				));
				?>
			</div>
			<div id="social">
				<ul>
					<li><a href=""><span class="dashicons dashicons-facebook"></span></a></li>
					|
					<li><a href=""><span class="dashicons dashicons-twitter"></span></a></li>
					|
					<li><a href="">Bë</a></li>
				</ul>
			</div>
		</nav>

		<?php
		slider();
		function slider()
		{
			if (!get_theme_mod("slider_active")) return;
		?>
			<div class="sliderContainer">
				<div id="sliderTitle">
					<h4>a small indie games team</h4>
					<h1>we are <?= get_bloginfo('blogname'); ?></h1>
					<a href="#about-us">
						<button>
							Get Started
							<span class="dashicons dashicons-marker"></span>
							<span class="dashicons dashicons-arrow-down-alt"></span>
						</button>
					</a>
				</div>
				<div class="slider">
					<?php
					for ($i = 0; $i < 10; $i++) {

						if (get_theme_mod("header_images" . $i) != null) {
					?>
							<div class="sliderComponent">

								<img src='<?= get_theme_mod("header_images" . $i) ?>' alt=''>

							</div>
					<?php
						}
					}
					?>
				</div>
			</div>
		<?php
		}
		?>
		<div id="content" class="site-content">
			<div class="container">