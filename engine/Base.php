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

namespace Genel_Site_Funktionlari\Engine;

/**
 * Base skeleton of the plugin
 */
class Base {

	/**
	 * @var array The settings of the plugin.
	 */
	public $settings = array();

	/** Initialize the class and get the plugin settings */
	public function initialize() {
		$this->settings = \gsf_get_settings();
	}

}
