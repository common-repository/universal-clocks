<?php if (!defined('ABSPATH'))
{
    exit;
} // Exit if accessed directly

/**
 * universal_clocks_Meta_Boxes_Init Class
 *
 * @link        https://wordpress.org/plugins/universal-clocks
 * @since       1.0.0
 *
 * @package     universal_clocks
 * @subpackage  universal_clocks/admin
 * @author      PressTigers <support@presstigers.com>
 */

class Universal_Clocks_Meta_Boxes_Init
{

    /**
     * Initialize the class and set its properties.
     *
     * @since   1.0.0
     */
    public function __construct()
    {

        /**
         * The class responsible for defining application status meta box options under applicant post type in the admin area.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/meta-boxes/class-universal-clocks-meta-box.php';

        // Action -> Post Type -> universal_clock -> Add Meta Boxes.
        add_action('add_meta_boxes', array(
            $this,
            'add_meta_boxes'
        ), 1);

        // Action -> Post Type -> universal_clock -> Save Meta Boxes.
        add_action('save_post_universal_clocks', array(
            $this,
            'save_meta_boxes'
        ) , 10, 1);

        // Action -> Post Type -> universal_clock -> Save Clock Features Meta Box.
        add_action('universal_clocks_save_meta', array(
            'universal_clocks_Meta_Box',
            'save_universal_clocks_meta'
        ) , 10);
        
    }

    /**
     * Add Clocks meta boxes.
     *
     * @since 1.0.0
     */
    public function add_meta_boxes()
    {

        global $wp_post_types;
        add_meta_box('universal-clocks-custom-fields', esc_html__('Clock Settings', 'universal-clocks') , array(
            'universal_clocks_Meta_Box',
            'universal_clocks_meta_box_output'
        ) , 'universal_clocks', 'advanced', 'high');
        add_meta_box('universal-clocks-shortcode-notice', esc_html__('Clock Shortcode Information', 'universal-clocks') , array(
            'universal_clocks_Meta_Box',
            'universal_clocks_meta_box_shortcode_output'
        ) , 'universal_clocks', 'side');
        
    }
    

    /**
     * Save Meta Boxes.
     *
     * @since 1.0.0
     */
    public function save_meta_boxes($post_id)
    {

        /**
         * We need to verify this came from our screen and with proper authorization,
         * because the save_post action can be triggered at other times.
         */

        // Check if nonce is set.
        if (NULL == filter_input(INPUT_POST, 'universal_clocks_meta_box_nonce'))
        {
            return;
        }

        // Verify that the nonce is valid.
        check_admin_referer('universal_clocks_meta_box', 'universal_clocks_meta_box_nonce');

        // If this is an autosave, our form has not been submitted, so we don't want to do anything.
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        {
            return;
        }

        // Check the user's permissions.
        if (NULL != filter_input(INPUT_POST, 'post_type') && 'page' == filter_input(INPUT_POST, 'post_type'))
        {
            if (!current_user_can('edit_page', $post_id))
            {
                return;
            }
        }
        else
        {
            if (!current_user_can('edit_post', $post_id))
            {
                return;
            }
        }

        /**
         * @hooked universal_clocks_save_meta - 10
         * @hooked universal_clocks_save_meta - 20
         * @hooked universal_clocks_save_meta - 30
         *
         * Save Clocks Meta Box:
         *
         * - Save clock features meta box.
         * - Save clock application meta box.
         * - Save clock data meta box.
         *
         * @since   1.0.0
         *
         * @param   int    $post_id    Post Id
         */
        do_action('universal_clocks_save_meta', $post_id);
    }
}
if (is_admin())
{
    new Universal_Clocks_Meta_Boxes_Init();
}

