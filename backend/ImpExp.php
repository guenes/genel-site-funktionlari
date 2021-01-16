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
 * Provide Import and Export of the settings of the plugin
 */
class ImpExp extends Base {

	/**
	 * Initialize the class.
	 *
	 * @return void
	 */
	public function initialize() {
		if ( !parent::initialize() ) {
			return;
		}

		// Add the export settings method
		\add_action( 'admin_init', array( $this, 'settings_export' ) );
		// Add the import settings method
		\add_action( 'admin_init', array( $this, 'settings_import' ) );
	}

	/**
	 * Process a settings export from config
	 *
	 * @since 1.1.0
	 * @return void
	 */
	public function settings_export() {
		if ( empty( $_POST[ 'gsf_action' ] ) || 'export_settings' !== \sanitize_text_field( \wp_unslash( $_POST[ 'gsf_action' ] ) ) ) { //phpcs:ignore WordPress.Security.NonceVerification
			return;
		}

		if ( !\wp_verify_nonce( \sanitize_text_field( \wp_unslash( $_POST[ 'gsf_export_nonce' ] ) ), 'gsf_export_nonce' ) ) { //phpcs:ignore WordPress.Security.ValidatedSanitizedInput
			return;
		}

		if ( !\current_user_can( 'manage_options' ) ) {
			return;
		}

		$settings      = array();
		$settings[ 0 ] = \get_option( GSF_TEXTDOMAIN . '-settings' );
		$settings[ 1 ] = \get_option( GSF_TEXTDOMAIN . '-settings-second' );

		\ignore_user_abort( true );

		\nocache_headers();
		\header( 'Content-Type: application/json; charset=utf-8' );
		\header( 'Content-Disposition: attachment; filename=genel_site_funktionlari-settings-export-' . \gmdate( 'm-d-Y' ) . '.json' );
		\header( 'Expires: 0' );

		echo \wp_json_encode( $settings, JSON_PRETTY_PRINT );

		exit;
	}

	/**
	 * Process a settings import from a json file
	 *
	 * @since 1.1.0
	 * @return void
	 */
	public function settings_import() {
		if ( empty( $_POST[ 'gsf_action' ] ) || 'import_settings' !== \sanitize_text_field( \wp_unslash( $_POST[ 'gsf_action' ] ) ) ) { //phpcs:ignore WordPress.Security.NonceVerification
			return;
		}

		if ( !\wp_verify_nonce( \sanitize_text_field( \wp_unslash( $_POST[ 'gsf_import_nonce' ] ) ), 'gsf_import_nonce' ) ) { //phpcs:ignore WordPress.Security.ValidatedSanitizedInput
			return;
		}

		if ( !\current_user_can( 'manage_options' ) ) {
			return;
		}

		$file_name_parts = \explode( '.', $_FILES[ 'gsf_import_file' ][ 'name' ] ); //phpcs:ignore WordPress.Security.ValidatedSanitizedInput
		$extension       = \end( $file_name_parts );

		if ( 'json' !== $extension ) {
			\wp_die( \esc_html__( 'Please upload a valid .json file', GSF_TEXTDOMAIN ) );
		}

		$import_file = $_FILES[ 'gsf_import_file' ][ 'tmp_name' ]; //phpcs:ignore WordPress.Security.ValidatedSanitizedInput

		if ( empty( $import_file ) ) {
			\wp_die( \esc_html__( 'Please upload a file to import', GSF_TEXTDOMAIN ) );
		}

		// Retrieve the settings from the file and convert the json object to an array.
		$settings_file = file_get_contents( $import_file );// phpcs:ignore

		if ( !$settings_file ) {
			$settings = \json_decode( (string) $settings_file );

			\update_option( GSF_TEXTDOMAIN . '-settings', \get_object_vars( $settings[ 0 ] ) );
			\update_option( GSF_TEXTDOMAIN . '-settings-second', \get_object_vars( $settings[ 1 ] ) );

			\wp_safe_redirect( \admin_url( 'options-general.php?page=' . GSF_TEXTDOMAIN ) );
			exit;
		}

		new \WP_Error(
				'genel_site_funktionlari_import_settings_failed',
				\__( 'Failed to import the settings.', GSF_TEXTDOMAIN )
			);

	}

}
