<?php
/**
 * Plugin Name: Dynamic Featured Image CSS
 * Plugin URI: https://Kevinlepiten.com
 * Description: Dynamically applies the featured image as a background for elements with the class "featured-bg".
 * Version: 1.0
 * Author: Kevin Lepiten
 * Author URI: https://Kevinlepiten.com
 * License: GPL2
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

function add_featured_image_css() {
    if (is_single() || is_page()) { // Ensure it runs only on single posts or pages
        $featured_image_url = get_the_post_thumbnail_url();
        if ($featured_image_url) {
			echo "
			<style>
				.featured-bg {
					background-image: url('$featured_image_url');
					background-size: cover;
					background-position: center;
				}
			</style>
			";
		} else {
			echo "
			<style>
				.featured-bg {
					background-color: #cccccc; /* Fallback color */
				}
			</style>
			";
		}
    }
}
add_action('wp_head', 'add_featured_image_css');
