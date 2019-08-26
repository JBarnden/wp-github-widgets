<?php
/**
 * Plugin Name: 		GitHub Widget Shortcodes
 * Plugin URI:        	https://jamqes.com/uni/wp-github-widgets
 * Description: 		Lightweight GitHub widgets plugin for your blog. Includes shortcode for embedding GitHub hosted gists/files and buttons for follow, watch, star, fork and more.
 * Version:     		1.0.0
 * Tested up to: 		5.2.2
 * Author:      		James Barnden
 * Author URI:  		https://jamqes.com
 * Text Domain: 		wp-github-widgets
 * License:           	GPL v2 or later
 * License URI:       	https://www.gnu.org/licenses/gpl-2.0.html
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
		load_plugin_textdomain( 'wp-github-widgets' );
	}
  
	/**
	 * Initialize the plugin
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init() {
		// Import widgets file
		require_once(__DIR__ . '/includes/widgets.php' );
        
		// Register shortcodes
		$this->register_shortcodes();
	}
	
	/**
	 * Register plugin shortcodes.
	 */
	public function register_shortcodes() {
		add_shortcode( 'Github_User_Button', 'wp_github_widgets_follow_button');
		add_shortcode( 'Github_Repo_Button', 'wp_github_widgets_repo_button');
		add_shortcode( 'Gist', 'wp_github_widgets_display_gist' );
	}
}

WP_Github_Widgets::instance();
