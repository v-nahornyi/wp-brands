<?php
/**
 * Plugin Name: WP Brands
 * Plugin URI: https://github.com/v-nahornyi/wp-brands
 * Author: Vladyslav Nahornyi
 * Author URI: https://github.com/v-nahornyi
 * Version: 1.0.0
 */

namespace Wpb;

defined( 'ABSPATH' ) || exit;

final class WpBrands {

	private static ?WpBrands $instance;

	public function __construct() {
		add_action( 'init', array( $this, 'init' ), -1, 1 );
	}

	public function init(): void {
		$this->define_constants();
		$this->autoload_classes();
		$this->setup_entities();

		/** Enqueue styles and scripts */
		$this->enqueue_assets();
	}

	private function define_constants(): void {
		define( 'WPB_VERSION', get_file_data( __FILE__, array( 'version' => 'Version' ) )['version'] );
		define( 'WPB_PATH', dirname( __FILE__ ) );
		define( 'WPB_URL', plugin_dir_url( __FILE__ ) );
	}

	private function setup_entities(): void {
		WpbEntityManager::init();
	}

	private function autoload_classes(): void {
		require __DIR__ . '/vendor/autoload.php';
	}

	private function enqueue_assets(): void {
		add_action( 'admin_enqueue_scripts', array( $this, 'add_admin_assets' ) );
	}

	public function add_admin_assets(): void {
		$screen = get_current_screen();

		if ( $screen->is_block_editor ) {
			wp_enqueue_style( 'wpb-editor', WPB_URL . 'assets/css/editor.css', [], WPB_VERSION );
		}
	}

	public static function get_instance(): WpBrands {
		if ( empty( self::$instance ) ) {
			self::$instance = new WpBrands();

			return self::$instance;
		}

		return self::$instance;
	}
}

WpBrands::get_instance();