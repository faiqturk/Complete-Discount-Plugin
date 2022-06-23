<?php
/**
 * Plugin Name: WPD Codup plugin 
 * Description: Made for the customization of theme.
 * Version: 1.1.1.7
 * Author: Codup
 * Author URI: https://codup.co/
 * Text Domain: WPD-plugin
 * WC requires at least: 3.8.0
 * WC tested up to: 5.1.0
 *
 * @package WPD-plugin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'WDP_PLUGIN_DIR' ) ) {
	define( 'WPD_PLUGIN_DIR', __DIR__ );
}

if ( ! defined( 'WDP_PLUGIN_DIR_URL' ) ) {
	define( 'WPD_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );
}

if ( ! defined( 'WDP_ABSPATH' ) ) {
	define( 'WPD_ABSPATH', dirname( __FILE__ ) );
}

require WPD_PLUGIN_DIR . '/includes/class-wdp-loader.php';

?>