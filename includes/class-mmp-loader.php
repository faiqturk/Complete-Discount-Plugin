<?php
/**
 * Main Loader.
 *
 * @package MM-Plugin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MMP_Loader' ) ) {

	/**
	 * Class MMP_Loader.
	 */
	class MMP_Loader {

		/**
		 *  Constructor.
		 */
		public function __construct() {
			$this->includes();
			add_action( 'admin_enqueue_scripts', array( $this, 'mmp_admin_enqueue_scripts' ) );
		}

		/**
		 * Include Files depend on platform.
		 */
		public function includes() {
			include_once 'class-mmp-setting-tab.php';
			include_once 'class-mmp-userside.php';
			// include_once 'archive-maintenance.php';
		}

		/**
		 * Enqueue File For Admin.
		 */
		public function mmp_admin_enqueue_scripts() {
			wp_enqueue_script( 'mmp_admin_script', plugin_dir_url( __DIR__ ) . 'assets/js/script.js', array( 'jquery' ), wp_rand() );
		}
	}
}

new MMP_Loader();
