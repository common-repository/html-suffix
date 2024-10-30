<?php

/**
 *
 * @link              https://bdcodemaker.com
 * @since             1.0.0
 * @package           Html_suffix
 *
 * @wordpress-plugin
 * Plugin Name:       html suffix
 * Plugin URI:        https://bdcodemaker.com/demo/plugin/animcat
 * Description:       Change url suffix to .html
 * Version:           1.0.0
 * Author:            Nasirul Islam
 * Author URI:        https://bdcodemaker.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       html_suffix
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


// .html suffix add for post
add_action('init', 'suffix_post_permalink', -1);
function suffix_post_permalink() {
	global $wp_rewrite;
	if ( !strpos($wp_rewrite->get_page_permastruct(), '.html')){
		$wp_rewrite->page_structure = $wp_rewrite->page_structure . '.html';
	}
}

// .html suffix add for post
add_filter('user_trailingslashit', 'suffix_page_permalink',66,2);
function suffix_page_permalink($string, $type){
	global $wp_rewrite;
	if ($wp_rewrite->using_permalinks() && $wp_rewrite->use_trailing_slashes==true && $type == 'page'){
		return untrailingslashit($string);
	}else{
		return $string;
	}
}


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-html_suffix-activator.php
 */
function activate_html_suffix() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-html_suffix-activator.php';
	Html_suffix_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-html_suffix-deactivator.php
 */
function deactivate_html_suffix() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-html_suffix-deactivator.php';
	Html_suffix_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_html_suffix' );
register_deactivation_hook( __FILE__, 'deactivate_html_suffix' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-html_suffix.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_html_suffix() {

	$plugin = new Html_suffix();
	$plugin->run();

}
run_html_suffix();
