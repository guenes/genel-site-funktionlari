<?php

/**
 * Genel_Site_Funktionlari
 *
 * @package   Genel_Site_Funktionlari
 * @author    Murtaza Coskun <murtaza.coskun@gmail.com>
 * @copyright 2021 Your Name or Company Name
 * @license   GPL 2.0+
 * @link      http://murtaza-coskun.info
 */

namespace Genel_Site_Funktionlari\Backend;

use Genel_Site_Funktionlari\Engine\Base;

/**
 * This class contain the Enqueue stuff for the backend
 */
class Enqueue extends Base {

	/**
	 * Initialize the class.
	 *
	 * @return void
	 */
	public function initialize() {
		if ( !parent::initialize() ) {
			return;
		}

		// Load admin style sheet and JavaScript.
		\add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
		\add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );
	}


	/**
	 * Register and enqueue admin-specific style sheet.
	 *
	 * @since 1.1.0
	 */
	public function enqueue_admin_styles() {
		$admin_page = \get_current_screen();

		if ( !\is_null( $admin_page ) && 'toplevel_page_genel-site-funktionlari' === $admin_page->id ) {
			\wp_enqueue_style( GSF_TEXTDOMAIN . '-settings-styles', \plugins_url( 'assets/css/settings.css', GSF_PLUGIN_ABSOLUTE ), array( 'dashicons' ), GSF_VERSION );
		}

		\wp_enqueue_style( GSF_TEXTDOMAIN . '-admin-styles', \plugins_url( 'assets/css/admin.css', GSF_PLUGIN_ABSOLUTE ), array( 'dashicons' ), GSF_VERSION );
	}

	/**
	 * Register and enqueue admin-specific JavaScript.
	 *
	 * @since 1.1.0
	 */
	public function enqueue_admin_scripts() {
		$admin_page = \get_current_screen();

		if ( !\is_null( $admin_page ) && 'toplevel_page_genel-site-funktionlari' === $admin_page->id ) {
			\wp_enqueue_script( GSF_TEXTDOMAIN . '-settings-script', \plugins_url( 'assets/js/settings.js', GSF_PLUGIN_ABSOLUTE ), array( 'jquery', 'jquery-ui-tabs' ), GSF_VERSION, false );
		}

		\wp_enqueue_script( GSF_TEXTDOMAIN . '-admin-script', \plugins_url( 'assets/js/admin.js', GSF_PLUGIN_ABSOLUTE ), array( 'jquery' ), GSF_VERSION, false );
	}


}
