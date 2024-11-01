<?php if (!defined('ABSPATH'))
{
    exit;
} // Exit if accessed directly

/**
 * universal_clocks_Post_Types_Init Class
 *
 * Custom Post Types Initialization. It includes all files of the custom post types for Universal Cocks
 *
 * @link        https://wordpress.org/plugins/universal-clocks
 * @since       1.0.0
 *
 * @package     universal_clocks
 * @subpackage  universal_clocks/includes
 * @author     PressTigers <support@presstigers.com>
 */

class Universal_Clocks_Post_Types_Init
{

    /**
     * Initialize the class and set its properties.
     *
     * @since   1.0.0
     */
    public function __construct()
    {

        //Clocks Custom Post Type
        require_once plugin_dir_path(__FILE__) . 'posttypes/class-universal-clocks-post-type-clocks.php';

        // Check if Clocks Class Exists
        if (class_exists('universal_clocks_Post_Type_Clocks'))
        {

            // Initialize Clocks Class
            new Universal_Clocks_Post_Type_Clocks();
        }
    }

}
if (is_admin())
{
    new Universal_Clocks_Post_Types_Init();
}

