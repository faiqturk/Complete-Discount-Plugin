<?php
/**
 * MMP_Userside.
 *
 * @package MM-Plugin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( 'MMP_Userside' ) ) {

	/**
	 * Class MMP_Userside.
	 */
	class MMP_Userside {

		/**
		 *  Constructor.
		 */
		public function __construct() {
			add_action( 'template_redirect', array( $this, 'mmp_show_maintenance_page' ) );
			add_filter( 'template_include', array( $this, 'portfolio_page_template'), 99 );

		}

		/**
		 * Setting for userside & different Roles .
		 */
		public function mmp_show_maintenance_page() {
			$selected_page  = get_option( 'setting_menu' );
			$selected_role  = get_option( 'multiple_menu' );
			$checkbox       = get_option( 'setting_tab_Maintance_checkbox' );
			$myaccount_page = get_option( 'woocommerce_myaccount_page_id' );
			$post           = get_post( $selected_page );
			$link           = get_permalink( $selected_page );
			$login          = get_permalink( $myaccount_page );
			$user           = wp_get_current_user();
			$curent_page_id = get_the_ID();
			if ( 'yes' === $checkbox ) {
				// print_r($curent_page_id);die();
				if ( is_user_logged_in() ) {
					$user_role = $user->roles[0];
					if ( 'administrator' != $user_role ) {
                        if (in_array( $user_role, $selected_role)) {
                            // print_r( $user_role );
                        }
                        elseif ( $selected_page != $curent_page_id && $curent_page_id != $myaccount_page ) {
                            wp_redirect( $link );
							
							die();
                        }
					}
				} 
                elseif ( ! is_user_logged_in() ) {

					if ( $selected_page != $curent_page_id ) {
						wp_redirect( $link );die();
						
						
					}
				}
			}
		}
		/**
		 * For maintenance Content .
		 */
		public function portfolio_page_template( $new_template ) {
			$checkbox       = get_option( 'setting_tab_Maintance_checkbox' );
			$myaccount_page = get_option( 'woocommerce_myaccount_page_id' );
			$curent_page_id = get_the_ID();
			$user           = wp_get_current_user();
			$selected_role  = get_option( 'multiple_menu' );
			if ( 'yes' === $checkbox )  {
				if ( is_user_logged_in() ) {
					$user_role = $user->roles[0];
					if ( 'administrator' != $user_role ) {
						if (!in_array( $user_role, $selected_role)) {
							$new_template = locate_template('maintenace') ;
							echo "
							<h1> Maintenance Mode </h1>";
							echo " <p> Lorem ipsum dolor, sit amet consectetur adipisicing elit. Commodi 
							sunt blanditiis tempora deserunt eius, quas nam adipisci, id harum
							eos dolore ab? Soluta eligendi accusantium possimus repellendus omnis 
							voluptatibus deleniti!</p>";
						}
					}
				}
				elseif( !is_user_logged_in() ){
					if($curent_page_id != $myaccount_page){
					$new_template = locate_template('maintenace') ;
							echo "
							<h1> Maintenance Mode </h1>";
							echo " <p> Lorem ipsum dolor, sit amet consectetur adipisicing elit. Commodi 
							sunt blanditiis tempora deserunt eius, quas nam adipisci, id harum
							eos dolore ab? Soluta eligendi accusantium possimus repellendus omnis 
							voluptatibus deleniti!</p>";
					}
				}
			}
			return $new_template;
		}

	}
}
new MMP_Userside();
