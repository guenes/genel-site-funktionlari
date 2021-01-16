<?php
/**
 * Plugin_name
 *
 * @package   Plugin_name
 * @author    Murtaza Coskun <murtaza.coskun@gmail.com>
 * @copyright 2021 Your Name or Company Name
 * @license   GPL 2.0+
 * @link      http://murtaza-coskun.info
 */

namespace Genel_Site_Funktionlari\Frontend\Extras;

use Genel_Site_Funktionlari\Engine\Base;

/**
 * Add custom css class to <body>
 */
class Body_Class extends Base {

	/**
	 * Initialize the class.
	 *
	 * @return void
	 */
	public function initialize() {
		parent::initialize();

		\add_filter( 'body_class', array( self::class, 'add_gsf_class' ), 10, 3 );
	}

	/**
	 * Add class in the body on the frontend
	 *
	 * @param array $classes The array with all the classes of the page.
	 * @since 1.1.0
	 * @return array
	 */
	public static function add_gsf_class( array $classes ) {
		$classes[] = GSF_TEXTDOMAIN;

		return $classes;
	}

}
