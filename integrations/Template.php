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

namespace Genel_Site_Funktionlari\Integrations;

use Genel_Site_Funktionlari\Engine\Base;

/**
 * Load custom template files
 */
class Template extends Base {

	/**
	 * Initialize the class.
	 *
	 * @return void
	 */
	public function initialize() {
		parent::initialize();

		// Override the template hierarchy for load /templates/content-demo.php
		\add_filter( 'template_include', array( self::class, 'load_content_demo' ) );
	}

	/**
	 * Example for override the template system on the frontend
	 *
	 * @param string $original_template The original templace HTML.
	 * @since 1.1.0
	 * @return string
	 */
	public static function load_content_demo( string $original_template ) {
		if ( \is_singular( 'demo' ) && \in_the_loop() ) {
			return \wpbp_get_template_part( GSF_TEXTDOMAIN, 'content', 'demo', false );
		}

		return $original_template;
	}

}
