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

namespace Genel_Site_Funktionlari\Internals;

use Genel_Site_Funktionlari\Engine\Base;

/**
 * Shortcodes of this plugin
 */
class Shortcode extends Base {

	/**
	 * Initialize the class.
	 *
	 * @return void
	 */
	public function initialize() {
		parent::initialize();

		\add_shortcode( 'foobar', array( $this, 'foobar_func' ) );
	}

	/**
	 * Shortcode example
	 *
	 * @param array $atts Parameters.
	 * @since 1.1.0
	 * @return string
	 */
	public static function foobar_func( array $atts ) {
		\shortcode_atts(
			array(
				'foo' => 'something',
				'bar' => 'something else',
			),
			$atts
		);

		return '<span class="foo">foo = ' . $atts[ 'foo' ] . '</span>' .
			'<span class="bar">foo = ' . $atts[ 'bar' ] . '</span>';
	}

}
