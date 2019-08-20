<?php
/**
 * Plugin Name: WP GitHub Widgets
 * Description: Lightweight GitHub widgets plugin for your blog. Includes shortcode for embedding GitHub hosted gists/files and buttons for follow, watch, star, fork and more.
 * Version:     1.0.0
 * Author:      James Barnden
 * Author URI:  https://jamqes.com
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

final class WP_Github_Widgets {
	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 *
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';
  
	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum PHP version required to run the plugin.
	 */
  
	const MINIMUM_PHP_VERSION = '7.2';
	/**
	 * Instance
	 *
	 * @since 1.0.0
	 */
  
	private static $_instance = null;
  
	/**
	 * Instance
	 *
	 * Only a single instance can be active.
	 *
	 * @since 1.0.0
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
  
	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {
		add_action( 'init', [ $this, 'i18n' ] );
		add_action( 'init', [ $this, 'init' ] );
	}
	
	/**
	 * Load Textdomain
	 *
	 * Load plugin localization files.
	 *
	 * Fired by `init` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function i18n() {
		load_plugin_textdomain( 'my-plugin' );
	}
  
	/**
	 * Initialize the plugin
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init() {
		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}
		
		// Import widgets file
		require_once(__DIR__ . '/includes/widgets.php' );
        
		// Register shortcodes
		$this->register_shortcodes();
	}
  
	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {
		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'my-plugin' ),
			'<strong>' . esc_html__( 'My Plugin', 'my-plugin' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'my-plugin' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);
		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}
	
	/**
	 * Register plugin shortcodes.
	 */
	public function register_shortcodes() {
		add_shortcode( 'Github_User_Button', 'wp_github_widgets_follow_button');
		add_shortcode( 'Github_Repo_Button', 'wp_github_widgets_repo_button');
		add_shortcode( 'Github_File', 'wp_github_widgets_display_file' );
	}
}

WP_Github_Widgets::instance();
