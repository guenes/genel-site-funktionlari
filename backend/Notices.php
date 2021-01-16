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

namespace Genel_Site_Funktionlari\Backend;

use Genel_Site_Funktionlari\Engine\Base;
use Yoast_I18n_WordPressOrg_v3;

/**
 * Everything that involves notification on the WordPress dashboard
 */
class Notices extends Base {

	/**
	 * Initialize the class
	 *
	 * @return void
	 */
	public function initialize() {
		if ( !parent::initialize() ) {
			return;
		}

		\wpdesk_wp_notice( \__( 'Updated Messages', GSF_TEXTDOMAIN ), 'updated' );
		\wpdesk_wp_notice( \__( 'This is my dismissible notice', GSF_TEXTDOMAIN ), 'error', true );

		/*
		 * Alert after few days to suggest to contribute to the localization if it is incomplete
		 * on translate.wordpress.org, the filter enables to remove globally.
		 */
	}

}
