<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.presstigers.com
 * @since      1.0.0
 *
 * @package    universal_clocks
 * @subpackage universal_clocks/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    universal_clocks
 * @subpackage universal_clocks/public
 * @author     PressTigers <support@presstigers.com>
 */
class Universal_Clocks_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		/**
		 * The class responsible for defining all the custom post types in the admin area.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-universal-clocks-post-types-init.php';

		/**
		 * The class responsible for defining all the shortcodes in the front end area.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-universal-clocks-shortcode.php';

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in universal_clocks_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The universal_clocks_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name.'-jClocksGMT', plugin_dir_url( __FILE__ ) . 'css/jClocksGMT.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/universal-clocks-public.css', array(), $this->version, 'all' );




	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in universal_clocks_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The universal_clocks_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		 wp_enqueue_script( $this->plugin_name.'-jq-rotate', plugin_dir_url( __FILE__ ) . 'js/jquery.rotate.js', array( 'jquery' ), $this->version, true );
		 wp_enqueue_script( $this->plugin_name.'-jClocksGMT', plugin_dir_url( __FILE__ ) . 'js/jClocksGMT.js', array( 'jquery' ), $this->version, true );
	}

}
