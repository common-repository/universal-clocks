<?php
if (!defined('ABSPATH'))
{
    exit;
} // Exit if accessed directly

/**
 * Universal_Clock_Post_Type_Clocks Class
 *
 * This class is used to define the "universal_clocks" custom post type.
 *
 * @link        https://wordpress.org/plugins/universal-clocks
 * @since       1.0.0
 *
 * @package    Universal_Clock
 * @subpackage  Universal_Clock/includes/posttypes
 * @author      PressTigers <support@presstigers.com>
 *  Text Domain:       universal-clocks
 */
if (!class_exists('universal_clocks_Post_Type_Clocks'))
{

    class Universal_Clocks_Post_Type_Clocks
    {

        /**
         * Initialize the class and set its properties.
         *
         * @since   1.0.0
         */
        public function __construct()
        {

            // Add Hook into the 'init()' action
            add_action('init', array(
                $this,
                'universal_clocks_init'
            ));

            // Add Hook into the 'admin_init()' action
            add_action('admin_init', array(
                $this,
                'universal_clocks_admin_init'
            ));
        }

        /**
         * A function hook that the WordPress core launches at 'init' points
         *
         * @since   1.0.0
         */
        public function universal_clocks_init()
        {

            $this->createPostType();
        }

        /**
         * A function hook that the WordPress core launches at 'admin_init' points
         *
         * @since   1.0.0
         */
        public function universal_clocks_admin_init()
        {

            // Hook - Delete Uploads on Applicant Deletion
            // Hook - Post Type -> Clocks ->  Add New Column
            add_filter('manage_universal_clocks_posts_columns', array(
                $this,
                'universal_clocks_skin_list_columns'
            ));

            // Hook - Post Type -> Clocks ->  Add Value to New Column
            add_filter('manage_universal_clocks_posts_custom_column', array(
                $this,
                'universal_clocks_skin_list_columns_value'
            ) , 10, 2);

        }

        /**
         * Create Clocks Post Type.
         *
         * @since   1.0.0
         */
        public function createPostType()
        {
            if (post_type_exists("universal_clocks")) return;

            /**
             * Post Type -> Clocks
             */
            $plural = esc_html__('Clocks', 'universal-clocks');
            $singular = esc_html__('Clock', 'universal-clocks');

            $labels_clocks = array(
                'name' => $plural,
                'singular_name' => $singular,
                'menu_name' => esc_html__('Clocks', 'universal-clocks') ,
                'all_items' => sprintf(esc_html__('All %s', 'universal-clocks') , $plural) ,
                'add_new' => esc_html__('Add New', 'universal-clocks') ,
                'add_new_item' => sprintf(esc_html__('Add %s', 'universal-clocks') , $singular) ,
                'edit_item' => sprintf(esc_html__('Edit %s', 'universal-clocks') , $singular) ,
                'new_item' => sprintf(esc_html__('New %s', 'universal-clocks') , $singular) ,
                'view_item' => sprintf(esc_html__('View %s', 'universal-clocks') , $singular) ,
                'search_items' => sprintf(esc_html__('Search %s', 'universal-clocks') , $plural) ,
                'not_found' => sprintf(esc_html__('No %s found', 'universal-clocks') , $plural) ,
                'not_found_in_trash' => sprintf(esc_html__('No %s found in trash', 'universal-clocks') , $plural) ,
                'parent' => sprintf(esc_html__('Parent %s', 'universal-clocks') , $singular) ,
            );

            $args_clocks = array(
                'labels' => $labels_clocks,
                'hierarchical' => false,
                'description' => sprintf(esc_html__('This is where you can create and manage %s.', 'universal-clocks') , $plural) ,
                'public' => true,
                'exclude_from_search' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'show_in_nav_menus' => false,
                'menu_icon' => 'dashicons-calendar',
                'has_archive' => false,
                'show_in_rest' => false,
                'supports' => array(
                    'title',
                    'slug',
                    'page-attributes',
                ),
                'show_in_menu' => 'pt-universal-clocks',
            );

            // Register Applicant Post Type.
            register_post_type("universal_clocks", apply_filters("register_post_type_universal_clocks", $args_clocks));
        }

        /**
         * Clocks -> Add New Column.
         *
         * @since   1.0.0
         *
         * @param   array   $columns    Applicant's listing Columns.
         * @return  array   $columns    Applicant's listing Columns.
         */
        public function universal_clocks_skin_list_columns($columns)
        {
            $columns['clock_type'] = __('Clock Type', 'universal-clocks');
            $columns['time_zone'] = __('Timezone', 'universal-clocks');
            $columns['shortcode_col'] = __('Shortcode', 'universal-clocks');
            unset( $columns['date'] );
            $columns['date'] = __('Date', 'universal-clocks');
            return $columns;
        }

        /**
         * Clocks ->  Add Value to New Column.
         *
         * @since   1.0.0
         *
         * @param   array   $column
         * @param   int     $post_id
         * @return  void
         */
        public function universal_clocks_skin_list_columns_value($column, $post_id)
        {

            switch ($column)
            {
                case 'shortcode_col':
                    if (!strstr($_SERVER['REQUEST_URI'], 'wp-admin/post-new.php') && is_admin() && get_post_status($post_id) != 'draft')
                    {
                        echo '[universal-clocks slugs=' . basename(get_permalink()) . ']';
                    }
                    else
                    {
                        echo "[universal-clocks slugs=Insert here slug-of-clock-post]";
                    }
                break;
                case 'time_zone':
                    echo str_replace('_', ' ', get_post_meta($post_id, 'timezone_offset', true));
                break;
                case 'clock_type':
                    echo ucwords(str_replace('_', ' ', get_post_meta($post_id, 'clock_type', true)));
                break;
            }
        }

    }

}
