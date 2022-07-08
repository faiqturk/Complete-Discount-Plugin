<?php
/**
 * Plugin Name: MM Codup plugin
 * Description: Made for the customization of theme.
 * Version: 1.1.1.7
 * Author: Codup
 * Author URI: https://codup.co/
 * Text Domain: MM-plugin
 * WC requires at least: 3.8.0
 * WC tested up to: 5.1.0
 *
 * @package MM-plugin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'MM_PLUGIN_DIR' ) ) {
	define( 'MM_PLUGIN_DIR', __DIR__ );
}

if ( ! defined( 'MM_PLUGIN_DIR_URL' ) ) {
	define( 'MM_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );
}

if ( ! defined( 'WDP_ABSPATH' ) ) {
	define( 'MM_ABSPATH', dirname( __FILE__ ) );
}

require MM_PLUGIN_DIR . '/includes/class-mmp-loader.php';


