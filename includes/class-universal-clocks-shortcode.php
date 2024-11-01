<?php
if (!defined('ABSPATH'))
{
    exit;
} // Exit if accessed directly

/**
 * universal_clocks_Shortcode Class
 *
 * This class lists the Clocks on frontend for [universal-clocks] shortcode.
 *
 * @link        https://wordpress.org/plugins/universal-clocks
 * @since       1.0.0
 *
 * @package     Universal_Clocks
 * Text Domain:       universal-clocks
 */

class Universal_Clocks_Shortcode
{

    /**
     * Constructor
     */
    public function __construct()
    {

        // Hook -> Add Clocks Listing ShortCode
        add_shortcode('universal-clocks', array(
            $this,
            'clocks_shortcode'
        ), 99);
    }

    /**
     * List all Clock.
     *
     * @since   1.0.0
     *
     * @param   array   $atts    Shortcode attribute
     * @return  HTML    $html    Clock Listing HTML Structure.
     */
    public function clocks_shortcode($atts)
    {

        /**
         * Enqueue Frontend Scripts.
         *
         * @since   1.0.0
         */
        do_action('universal_clocks_enqueue_scripts');

        //ob_start();
        // Shortcode Default Array
        $shortcode_args = array(
            'slugs' => '',
            'order' => 'ASC'
        );
        $atts = is_array($atts) ? apply_filters('universal_clocks_shortcode_atts', array_map('sanitize_text_field', $atts)) : '';
        // Combine User Defined Shortcode Attributes with Known Attributes
        $shortcode_args = shortcode_atts(apply_filters('universal_clocks_output_defaults', $shortcode_args, $atts) , $atts);

        $slugs = $shortcode_args['slugs'];
        $slugs = str_replace(' ', '', $slugs);
        $slugs_arr = explode(',', $slugs);
        // WP Query Default Arguments
        $args = apply_filters('universal_clocks_output_args', array(
            'post_status' => 'publish',
            'post_name__in' => $slugs_arr,
            'post_type' => 'universal_clocks',
            'posts_per_page' => - 1,
            'order' => $shortcode_args['order'],
        ) , $atts);
        // Clock Query
        $wpc_query = new WP_Query($args);

        /**
         * Fires before listing Clokss on clock listing page.
         *
         * @since   1.0.0
         */

        $html = '';
        if ($wpc_query->have_posts()):

            while ($wpc_query->have_posts()):
                $wpc_query->the_post();
                global $post;
                $post_id = $post->ID;
                $title = $post->post_title;
                $slug = $post->post_name;
                $timezone_offset = get_post_meta($post_id, 'timezone_offset', true);
                $timezone_offset_arr = explode('_', $timezone_offset);
                $timezone_offset_info = '<h2>' . $title . '</h2><h3>' . str_replace('_', ' ', $timezone_offset) . '</h3>';
                $gmt_offset = $timezone_offset_arr[1];
                $template_id = get_post_meta($post_id, 'template_id', true);
                if (empty($template_id)) {
                    $template_id = 1;
                }
                $img_path = plugin_dir_url(dirname(__FILE__)) . 'public/clock-templates/size-200/';
                $is_analog = true;
                $is_digital = false;
                $clock_type_dst = get_post_meta($post->ID, 'clock_type_dst', true);
                if (empty($clock_type_dst)) {
                        $clock_type_dst = 'false';
                }
                $clock_type = get_post_meta($post_id, 'clock_type', true);
                $html .= "<div id='c-$slug' class='universal-clocks-wrapper'><div id='$slug' class='single-clock medium-clock'></div></div>";
                if ($clock_type != 'digital')
                {
                    $html .= "<script>
                  jQuery(document).ready(function(){
                      jQuery('#$slug').jClocksGMT(
                      {
                          skin:     '$template_id',
                          title:    '$timezone_offset_info',
                          offset:   '$gmt_offset',
                          imgpath:  '$img_path',
                          dst:      '$clock_type_dst'
                      });
                  });
              </script>
              ";
                }
                elseif ($clock_type == 'digital')
                {
                    $html .= "<script>
                  jQuery(document).ready(function(){
                      jQuery('#$slug').jClocksGMT(
                      {
                          title:        '$timezone_offset_info',
                          digital:      true,
                          analog:       false,
                          offset:       '$gmt_offset',
                          timeformat:   'hh:mm:ss A',
                          dst:          '$clock_type_dst'
                      });
                  });
              </script>
              ";
                }
            endwhile;
        endif;

        wp_reset_postdata();

        //$html = ob_get_clean();

        /**
         * Filter -> Modify the Clock Listing Shortcode
         *
         * @since   1.0.0
         *
         * @param   HTML    $html    Clock Listing HTML Structure.
         */

        return '<div class="universal-clock-main-wrapper">' . apply_filters('universal_clocks_listing_shortcode', $html, $atts) . '</div>';
    }

}
    new Universal_Clocks_Shortcode();


