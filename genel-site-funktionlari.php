<?php

/**
 * @package   Genel_Site_Funktionlari
 * @author    Murtaza Coskun <murtaza.coskun@gmail.com>
 * @copyright 2021 Your Name or Company Name
 * @license   GPL 2.0+
 * @link      http://murtaza-coskun.info
 *
 * Plugin Name:     Genel Site Funktionlari
 * Plugin URI:      @TODO
 * Description:     Genel site müdrüne benzeyecek
 * Version:         1.1.0
 * Author:          Murtaza Coskun
 * Author URI:      http://murtaza-coskun.info
 * Text Domain:     genel-site-funktionlari
 * License:         GPL 2.0+
 * License URI:     http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:     /languages
 * Requires PHP:    7.0
 * WordPress-Plugin-Boilerplate-Powered: v3.2.0
 */

// If this file is called directly, abort.
if ( !defined( 'ABSPATH' ) ) {
	die( 'We\'re sorry, but you can not directly access this file.' );
}

define( 'GSF_VERSION', '1.1.0' );
define( 'GSF_TEXTDOMAIN', 'genel-site-funktionlari' );
define( 'GSF_NAME', 'Genel Site Funktionlari' );
define( 'GSF_PLUGIN_ROOT', plugin_dir_path( __FILE__ ) );
define( 'GSF_PLUGIN_ABSOLUTE', __FILE__ );

if ( version_compare( PHP_VERSION, '7.0.0', '<=' ) ) {
	add_action(
		'admin_init',
		static function() {
			deactivate_plugins( plugin_basename( __FILE__ ) );
		}
	);
	add_action(
		'admin_notices',
		static function() {
			echo wp_kses_post(
			sprintf(
				'<div class="notice notice-error"><p>%s</p></div>',
				__( '"Genel Site Funktionlari" requires PHP 5.6 or newer.', GSF_TEXTDOMAIN )
			)
			);
		}
	);

	// Return early to prevent loading the plugin.
	return;
}

$genel_site_funktionlari_libraries = require_once GSF_PLUGIN_ROOT . 'vendor/autoload.php';

require_once GSF_PLUGIN_ROOT . 'functions/functions.php';

// Add your new plugin on the wiki: https://github.com/WPBP/WordPress-Plugin-Boilerplate-Powered/wiki/Plugin-made-with-this-Boilerplate

$requirements = new \Micropackage\Requirements\Requirements(
	'Plugin Name',
	array(
		'php'            => '7.0',
		'php_extensions' => array( 'mbstring' ),
		'wp'             => '5.3',
	// 'plugins'            => array(
	// array( 'file' => 'hello-dolly/hello.php', 'name' => 'Hello Dolly', 'version' => '1.5' )
	// ),
)
	);

if ( ! $requirements->satisfied() ) {
	$requirements->print_notice();

	return;
}


/**
 * Create a helper function for easy SDK access.
 *
 * @global type $gsf_fs
 * @return object
 */
function gsf_fs() {
	global $gsf_fs;

	if ( !isset( $gsf_fs ) ) {
		require_once GSF_PLUGIN_ROOT . 'vendor/freemius/wordpress-sdk/start.php';
		$gsf_fs = fs_dynamic_init(
			array(
				'id'             => '',
				'slug'           => 'genel-site-funktionlari',
				'public_key'     => '',
				'is_live'        => false,
				'is_premium'     => true,
				'has_addons'     => false,
				'has_paid_plans' => true,
				'menu'           => array(
					'slug' => 'genel-site-funktionlari',
				),
			)
		);

		if ( $gsf_fs->is_premium() ) {
			$gsf_fs->add_filter(
				'support_forum_url',
				static function ( $wp_org_support_forum_url ) { //phpcs:ignore
					return 'https://your-url.test';
				}
			);
		}
	}

	return $gsf_fs;
}

// gsf_fs();


if ( ! wp_installing() ) {
	add_action(
		'plugins_loaded',
		static function () use ( $genel_site_funktionlari_libraries ) {
			new \Genel_Site_Funktionlari\Engine\Initialize( $genel_site_funktionlari_libraries );
		}
	);
}
