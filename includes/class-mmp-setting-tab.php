<?php
/**
 * MMP_Setting_Tab.
 *
 * @package MM-Plugin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( 'MMP_Setting_Tab' ) ) {

	/**
	 * Class MMP_Setting_Tab.
	 */
	class MMP_Setting_Tab {
		/**
		 *  Constructor.
		 */
		public function __construct() {
			add_filter( 'woocommerce_settings_tabs_array', array( $this, 'mmp_add_settings_tab' ), 50 );
			add_action( 'woocommerce_settings_tabs_settings_tab_demo', array( $this, 'mmp_settings_tab' ) );
			add_action( 'woocommerce_update_options_settings_tab_demo', array( $this, 'mmp_update_settings' ) );
		}

		/**
		 * Tab Show In Wocommerce Setting.
		 *
		 * @param array $settings_tabs for tab.
		 */
		public function mmp_add_settings_tab( $settings_tabs ) {
			$settings_tabs['settings_tab_demo'] = __( 'Maintance Mode', 'woocommerce-settings-tab' );
			return $settings_tabs;
		}

		/**
		 * For Tab In Wocommerce Setting.
		 */
		public function mmp_settings_tab() {
			woocommerce_admin_fields( $this->mmp_add_dropdowns() );
		}

		/**
		 * For Updating Tab In Wocommerce Setting.
		 */
		public function mmp_update_settings() {
			woocommerce_update_options( $this->mmp_add_dropdowns() );
		}

		/**
		 * For Dropdowns In Wocommerce Setting.
		 */
		public function mmp_add_dropdowns() {
			$settings = array(
				array(
					'name' => __( 'Maintance Mode', 'MM-plugin' ),
					'type' => 'title',
					'desc' => '',
					'id'   => 'setting_tab_section_title',
				),
				array(
					'name' => __( 'Maintance Mode: ', 'MM-plugin' ),
					'type' => 'checkbox',
					'desc' => __( 'If you want to enable your Maintance Mode', 'MM-plugin' ),
					'id'   => 'setting_tab_Maintance_checkbox',
				),
				array(
					'name'    => 'Select Page: ',
					'id'      => 'setting_menu',
					'options' => $this->mmp_single_dropdown(),
					'type'    => 'select',
				),
				array(
					'name'    => 'Select Role: ',
					'id'      => 'multiple_menu',
					'type'    => 'multiselect',
					'options' => $this->mmp_multi_dropdown(),
				),
				array(
					'type' => 'sectionend',
					'id'   => 'setting_tab_section_end',
				),
			);
			return apply_filters( 'wc_settings_tab_demo_settings', $settings );
		}

		/**
		 * Show single dropdown of Pages In Maintenance Tab.
		 */
		public function mmp_single_dropdown() {
			$args      = array(
				'sort_column' => 'post_title',
				'post_type'   => 'page',
				'post_status' => 'publish',
			);
			$mmp_pages = get_pages( $args );
			foreach ( $mmp_pages as $key => $xvalue ) {
				$pages_array[ $xvalue->ID ] = $xvalue->post_title;
			}
			unset( $pages_array['9'] );
			return $pages_array;
		}

		/**
		 * Show Multi dropdown of Roles In Maintenance Tab.
		 */
		public function mmp_multi_dropdown() {
			global $wp_roles;
			if ( ! isset( $wp_roles ) ) {
				$wp_roles = new WP_Roles();
			}
				$abc = $wp_roles->get_names();
				unset( $abc['administrator'] );
				unset( $abc['subscriber'] );
				unset( $abc['contributor'] );
				return $abc;

		}
	}
}
new MMP_Setting_Tab();
