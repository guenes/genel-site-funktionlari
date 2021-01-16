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

/**
 * Get the settings of the plugin in a filterable way
 *
 * @since 1.1.0
 * @return array
 */
function gsf_get_settings() {
	return apply_filters( 'gsf_get_settings', get_option( GSF_TEXTDOMAIN . '-settings' ) );
}
