<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.presstigers.com
 * @since      1.0.0
 *
 * @package    universal_clocks
 * @subpackage universal_clocks/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    universal_clocks
 * @subpackage universal_clocks/admin
 * @author     PressTigers <support@presstigers.com>
 */
class Universal_Clocks_Admin
{

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
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;


        /**
         * The class responsible for defining all the meta options under custom post type in the admin area.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-universal-clocks-admin-meta-boxes-init.php';
        add_action( 'admin_notices', array($this,'show_admin_notices') );
        add_action( 'admin_menu', array( $this, 'register_options_page' ) );
        add_action( 'admin_init', array( $this, 'process_settings' ) );
    }

    public function register_options_page() {
      add_menu_page(
        'Clocks',
        'Clocks',
        'manage_options',
        'pt-universal-clocks',
        array( $this, 'render_custom_page' ),
        'dashicons-calendar'
      );

      add_submenu_page(
        'pt-universal-clocks',
        'Clocks Settings',
        'Settings',
        'manage_options',
        'universal-clocks-settings',
        array( $this, 'render_custom_page' ),
      );
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

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

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/universal-clocks-admin.css', array() , $this->version, 'all');

        // enqueue css for color picker
        wp_enqueue_style('wp-color-picker');

    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

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
        wp_enqueue_script($this->plugin_name . 'admin', plugin_dir_url(__FILE__) . 'js/universal-clocks-admin.js', array(
            'jquery',
            'wp-color-picker'
        ) , $this->version, true);

    }

    public function show_admin_notices() {
      if(!function_exists('curl_version') || !extension_loaded('curl')){
        printf( '<div class="notice notice-warning is-dismissible"><p>Warning: Curl is required to include google fonts</p></div>' );
      }

    }

    public function render_custom_page() {
      $file= null;
      $pt_uc_google_apikey =   get_option( 'pt_uc_google_apikey');
        if($pt_uc_google_apikey ==''){
          $msg = __('Goolge API is key required to include google fonts for digital clcoks.');
          printf( '<div class="notice notice-warning is-dismissible"><p>Warning: %s</p></div>', $msg );
      }else{
        $src = 'https://www.googleapis.com/webfonts/v1/webfonts?key='.$pt_uc_google_apikey;
        // make request
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, $src);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          $output = curl_exec($ch);

          // convert response
          $file = json_decode($output);

          // handle error; error output
          if(curl_getinfo($ch, CURLINFO_HTTP_CODE) !== 200) {
            //var_dump($output->error);
            if( $file->error ){
              $msg = __('Google Fonts ').$file->error->message;
              printf( '<div class="notice notice-warning is-dismissible"><p>Warning: %s</p></div>', $msg );
            }
          }

          curl_close($ch);
      }

      ?>
    <div class="wrap">
      <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
      <form method="post" action="admin.php?page=universal-clocks-settings">
        <div id="universal-message-container">
    			<h2>Google API Key Settings</h2>
    			<div class="options">
    				<p>

    					<label>Google API Key: </label><input type="text" name="pt_uc_google_apikey" value="<?php echo $pt_uc_google_apikey; ?>" />
              <br />
              <span>Enter google API key to load google fonts.</span>

    				</p>
    		</div><!-- #universal-message-container -->
        <?php submit_button( 'Save Changes' ); ?>
      </form>
    </div>
    <?php
    }

    public function process_settings() {

      if ( isset( $_POST['pt_uc_google_apikey'] ) ) {
        update_option( 'pt_uc_google_apikey', sanitize_text_field( $_POST['pt_uc_google_apikey'] ) );
      }
    }


}
