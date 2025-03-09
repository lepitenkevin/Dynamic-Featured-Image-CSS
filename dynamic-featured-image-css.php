<?php
/**
 * Plugin Name: Dynamic Featured Image CSS
 * Plugin URI: https://Kevinlepiten.com
 * Description: Dynamically applies the featured image as a background for elements with the class "dynamic-featured-bg".
 * Version: 1.2
 * Author: Kevin Lepiten
 * Author URI: https://Kevinlepiten.com
 * License: GPL2
 */

 if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Add dynamic CSS for featured image background
function add_dynamic_featured_image_css() {
    if (is_singular() && has_post_thumbnail()) {
        $image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
		echo '<style>
        .dynamic-featured-bg {
            background-image: url('. esc_url($image_url) .');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
			}
		</style>';
    } else {
        $image_url = plugin_dir_url(__FILE__) . 'fallback.png'; // Change to your fallback image path
		echo '<style>
        .dynamic-featured-bg {
            background-image: url('. esc_url($image_url) .');
            background-size: contain;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
			}
		</style>';
    }

    
}
add_action('wp_head', 'add_dynamic_featured_image_css');

// Shortcode to display featured image inside Elementor widgets
function featured_image_shortcode() {
    if (has_post_thumbnail()) {
        return '<img src="'. get_the_post_thumbnail_url(get_the_ID(), 'full') .'" alt="'. get_the_title() .'" class="featured-image-shortcode">';
    }
    return '<img src="'. plugin_dir_url(__FILE__) .'fallback.jpg" alt="Fallback Image">';
}
add_shortcode('featured_image', 'featured_image_shortcode');