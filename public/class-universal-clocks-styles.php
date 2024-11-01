<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.presstigers.com
 * @since             1.0.0
 * @package           Universal_Clocks
 *
 * @wordpress-plugin
 */

// If this file is called directly, abort.
if (!defined('WPINC'))
{
    die;
}
/**
 * Class For Enqueuing Style For Shortcode
 */
class Universal_Clocks_Shortcode_Style
{

    function __construct()
    {
        /* Hook the function in wp_head */
        add_action('wp_head', array(
            'Universal_Clocks_Shortcode_Style',
            'un_shortcode_enqueue'
        ) , 10);
    }
    public static function un_shortcode_enqueue()
    {
        $args = array(
            'post_status' => 'publish',
            'post_type' => 'universal_clocks',
            'posts_per_page' => - 1,

        );
        // Clock Query
        $wpc_query = new WP_Query($args);

        if ($wpc_query->have_posts()):

            while ($wpc_query->have_posts()):
                $wpc_query->the_post();
                global $post;
                /*getting all data of clock*/
                $post_id = $post->ID;
                $slug = $post->post_name;
                $color = str_replace("##", "#", get_post_meta($post_id, 'time_color', true));
                $font_family = get_post_meta($post_id, 'time_font_family', true);
                $font_size = get_post_meta($post_id, 'time_font_size', true);
                $clock_type = get_post_meta($post_id, 'clock_type', true);
                $font_weight = get_post_meta($post_id, 'time_font_weight', true);
                $analog_color = get_post_meta($post_id, 'analog_time_color', true);
                $analog_clock_color_radius = get_post_meta($post_id, 'analog_clock_color_radius', true);
                $analog_clock_border = get_post_meta($post_id, 'analog_clock_border_width', true);
                $analog_clock_border_style = get_post_meta($post_id, 'analog_clock_border_style', true);
                $analog_clock_border_color = get_post_meta($post_id, 'analog_clock_border_color', true);
                $hide_tittle = get_post_meta($post_id, 'hide_tittle_option', true);
    			// Set the clock dial for admin
                  $tmplates_data = array(
                        "template_1" => array(
                            "template_id" => "1",
                            "template_name" =>"circle-1.png",
                        ),
                        "template_2" => array(
                            "template_id" => "2",
                            "template_name" =>"circle-2.png",
                        ),
                        "template_3" => array(
                            "template_id" => "3",
                            "template_name" =>"circle-3.png",
                        ),
                        "template_4" => array(
                            "template_id" => "4",
                            "template_name" =>"circle-4.png",
                        ),
                         "template_5" => array(
                            "template_id" => "5",
                            "template_name" =>"circle-5.png",
                        ),
                         "template_6" => array(
                            "template_id" => "6",
                            "template_name" =>"circle-6.png",
                        ),
                        "template_7" => array(
                            "template_id" => "7",
                            "template_name" =>"circle-7.png",
                        ),
                        "template_8" => array(
                            "template_id" => "8",
                            "template_name" =>"rectangle-8.png",
                        ),
                        "template_9" => array(
                            "template_id" => "9",
                            "template_name" =>"circle-9.png",
                        ),
                         "template_10" => array(
                            "template_id" => "10",
                            "template_name" =>"rectangle-10.png",
                        ),
                         "template_11" => array(
                            "template_id" => "11",
                            "template_name" =>"rectangle-11.png",
                        ),
                         "template_12" => array(
                            "template_id" => "12",
                            "template_name" =>"rectangle-12.png",
                        ),
                         "template_13" => array(
                            "template_id" => "13",
                            "template_name" =>"rectangle-13.png",
                        ),
                        "template_14" => array(
                            "template_id" => "14",
                            "template_name" =>"rectangle-14.png",
                        ),
                        "template_15" => array(
                            "template_id" => "15",
                            "template_name" =>"rectangle-15.png",
                        ),
               );

                $saved_template_id = get_post_meta($post->ID, 'template_id', true);
               $dial_type;
                 foreach ($tmplates_data as $key => $val) {
               if ($val['template_id'] === $saved_template_id) {
                  $dial_type =  $val['template_name'];
               }

             }

                         if (strpos($dial_type, 'circle') !== false) {
                $dial_type = 'true';
            } else{
                $dial_type = 'fasle';
            }


                /*Set the default values*/

                if($font_family== "[ Select Font Family ]")
                {
                    $font_family = "inherit";
                }
                if ($hide_tittle == "no")
                {
                    $hide_tittle = "inherit";
                }
                else
                {
                    $hide_tittle = "none";
                }
                if (!$analog_clock_color_radius)
                {
                    $analog_clock_color_radius = 50;
                }
                if (!$font_size)
                {
                    $font_size = 15;
                }
    			 
                /*Check CLock Type*/
                if ($clock_type != 'digital')
                    { ?>
                     <style>
                      #<?php echo esc_attr($slug); ?> .jcgmt-lbl ,  #<?php echo esc_attr($slug); ?>  .jcgmt-digital{
                       display: <?php echo esc_attr($hide_tittle) . ';'; ?>
                   }
                   #c-<?php echo esc_attr($slug); ?>.universal-clocks-wrapper {
                       border: <?php echo esc_attr($analog_clock_border) . 'px ' . esc_attr($analog_clock_border_style) . ' ' . esc_attr($analog_clock_border_color) . ' ;'; ?>
                   }
                   #<?php echo esc_attr($slug); ?> .jcgmt-clockHolder {
                       background: <?php echo esc_attr($analog_color) . ' ;'; ?>
                       border-radius: <?php if($dial_type=='true'){
                        echo '50% ;';
                       } else {
                        echo '10% ;';
                       }  ?>
                   }
               </style>

               <?php
           }
           elseif ($clock_type == 'digital')
           {
            /*If clock is digital*/
            ?>
            <style>
              <?php if ( $font_family != "[ Select Font Family ]")
              { ?>	@import url('https://fonts.googleapis.com/css2?family=<?php echo esc_attr($font_family); ?>:wght@300;400;500;700;900&display=swap');<?php
          } ?>

          #<?php echo esc_attr($slug); ?> .jcgmt-lbl{
          display:  <?php echo esc_attr($hide_tittle) . ' ; '; ?>
      }
      #c-<?php echo esc_attr($slug); ?>.universal-clocks-wrapper {
      border: <?php echo esc_attr($analog_clock_border) . 'px ' . esc_attr($analog_clock_border_style) . ' ' . esc_attr($analog_clock_border_color) . ' ;'; ?>
  }
  #<?php echo esc_attr($slug); ?> .jcgmt-digital{
  color: <?php echo esc_attr($color) . ';'; ?>
  font-family:<?php if ($font_family)
  {
    echo esc_attr($font_family) . ', sans-serif ;';
	}
	else
	{
    echo  'inherit ;';
	} ?>
font-size:<?php echo esc_attr($font_size) . 'px;'; ?>
font-weight: <?php echo esc_attr($font_weight); ?>
}
</style>
<?php
}
/*End of Clock Type*/
endwhile;
endif;
}
}
new  Universal_Clocks_Shortcode_Style();
