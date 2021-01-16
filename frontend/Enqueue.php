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

namespace Genel_Site_Funktionlari\Frontend;

use Genel_Site_Funktionlari\Engine\Base;

/**
 * Enqueue stuff on the frontend
 */
class Enqueue extends Base {

	/**
	 * Initialize the class.
	 *
	 * @return void
	 */
	public function initialize() {
		parent::initialize();

		// Load public-facing style sheet and JavaScript.
		\add_action( 'wp_enqueue_scripts', array( self::class, 'enqueue_styles' ) );
		\add_action( 'wp_enqueue_scripts', array( self::class, 'enqueue_scripts' ) );
	}


	/**
	 * Register and enqueue public-facing style sheet.
	 *
	 * @since 1.1.0
	 * @return void
	 */
	public static function enqueue_styles() {
		\wp_enqueue_style( GSF_TEXTDOMAIN . '-plugin-styles', \plugins_url( 'assets/css/public.css', GSF_PLUGIN_ABSOLUTE ), array(), GSF_VERSION );
	}


	/**
	 * Register and enqueues public-facing JavaScript files.
	 *
	 * @since 1.1.0
	 * @return void
	 */
	public static function enqueue_scripts() {
		\wp_enqueue_script( GSF_TEXTDOMAIN . '-plugin-script', \plugins_url( 'assets/js/public.js', GSF_PLUGIN_ABSOLUTE ), array( 'jquery' ), GSF_VERSION, false );
	}


}
