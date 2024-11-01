<?php
if (!defined('ABSPATH'))
{
    exit;
} // Exit if accessed directly

/**
 * universal_clocks_Meta_Box_Application_Status Class
 *
 * This meta box is designed for storing application's status.
 *
 * @link        https://wordpress.org/plugins/universal-clocks
 * @since       1.0.0
 *
 * @package     universal_clocks
 * @author      PressTigers <support@presstigers.com>
 * Text Domain:       universal-clocks
 */
class Universal_Clocks_Meta_Box
{

    /**
     * Add Clock data meta box options.
     *
     * @since   1.0.0
     */
    public static function universal_clocks_meta_box_output()
    {
        global $post;
        global $error;
        // Add a nonce field so we can check for it later.
        wp_nonce_field('universal_clocks_meta_box', 'universal_clocks_meta_box_nonce');

        // Getting all the data of clocks
        $color = get_post_meta($post->ID, 'time_color', true);
        $font_family = get_post_meta($post->ID, 'time_font_family', true);
        $font_size = get_post_meta($post->ID, 'time_font_size', true);
        $clock_type = get_post_meta($post->ID, 'clock_type', true);
        $font_weight = get_post_meta($post->ID, 'time_font_weight', true);
        $analog_color = get_post_meta($post->ID, 'analog_time_color', true);
        $analog_clock_color_radius = get_post_meta($post->ID, 'analog_clock_color_radius', true);
        $crt_timezone = get_post_meta($post->ID, 'timezone_offset', true);
        $analog_clock_border = get_post_meta($post->ID, 'analog_clock_border_width', true);
        $analog_clock_border_style = get_post_meta($post->ID, 'analog_clock_border_style', true);
        $analog_clock_border_color = get_post_meta($post->ID, 'analog_clock_border_color', true);
        $hide_tittle = get_post_meta($post->ID, 'hide_tittle_option', true);
        $clock_type_dst = get_post_meta($post->ID, 'clock_type_dst', true);



        /* get all the time zones */
        $timezones_g = array(
            '' => '[ Select TimeZone ]',
            'GMT_-11:00_Niue_Time' => '(GMT-11:00) Niue Time',
            'GMT_-11:00_Samoa_Standard_Time' => '(GMT-11:00) Samoa Standard Time',
            'GMT_-10:00_Cook_Islands_Standard_Time' => '(GMT-10:00) Cook Islands Standard Time',
            'GMT_-10:00_Hawaii_-Aleutian_Standard_Time' => '(GMT-10:00) Hawaii-Aleutian Standard Time',
            'GMT_-10:00_Hawaii_-Aleutian_Time' => '(GMT-10:00) Hawaii-Aleutian Time',
            'GMT_-10:00_Tahiti_Time' => '(GMT-10:00) Tahiti Time',
            'GMT_-09:30_Marquesas_Time' => '(GMT-09:30) Marquesas Time',
            'GMT_-09:00_Alaska_Time_-_Anchorage' => '(GMT-09:00) Alaska Time - Anchorage',
            'GMT_-09:00_Alaska_Time_-_Juneau' => '(GMT-09:00) Alaska Time - Juneau',
            'GMT_-09:00_Alaska_Time_-_Metlakatla' => '(GMT-09:00) Alaska Time - Metlakatla',
            'GMT_-09:00_Alaska_Time_-_Nome' => '(GMT-09:00) Alaska Time - Nome',
            'GMT_-09:00_Alaska_Time_-_Sitka' => '(GMT-09:00) Alaska Time - Sitka',
            'GMT_-09:00_Alaska_Time_-_Yakutat' => '(GMT-09:00) Alaska Time - Yakutat',
            'GMT_-09:00_Gambier_Time' => '(GMT-09:00) Gambier Time',
            'GMT_-08:00_Pacific_Time_-_Los_Angeles' => '(GMT-08:00) Pacific Time - Los Angeles',
            'GMT_-08:00_Pacific_Time_-_Tijuana' => '(GMT-08:00) Pacific Time - Tijuana',
            'GMT_-08:00_Pacific_Time_-_Vancouver' => '(GMT-08:00) Pacific Time - Vancouver',
            'GMT_-08:00_Pitcairn_Time' => '(GMT-08:00) Pitcairn Time',
            'GMT_-07:00_Mexican_Pacific_Standard_Time' => '(GMT-07:00) Mexican Pacific Standard Time',
            'GMT_-07:00_Mexican_Pacific_Time_-_Chihuahua' => '(GMT-07:00) Mexican Pacific Time - Chihuahua',
            'GMT_-07:00_Mexican_Pacific_Time_-_Mazatlan' => '(GMT-07:00) Mexican Pacific Time - Mazatlan',
            'GMT_-07:00_Mountain_Standard_Time_-_Creston' => '(GMT-07:00) Mountain Standard Time - Creston',
            'GMT_-07:00_Mountain_Standard_Time_-_Dawson_Creek' => '(GMT-07:00) Mountain Standard Time - Dawson Creek',
            'GMT_-07:00_Mountain_Standard_Time_-_Fort_Nelson' => '(GMT-07:00) Mountain Standard Time - Fort Nelson',
            'GMT_-07:00_Mountain_Standard_Time_-_Phoenix' => '(GMT-07:00) Mountain Standard Time - Phoenix',
            'GMT_-07:00_Mountain_Time_-_Boise' => '(GMT-07:00) Mountain Time - Boise',
            'GMT_-07:00_Mountain_Time_-_Cambridge_Bay' => '(GMT-07:00) Mountain Time - Cambridge Bay',
            'GMT_-07:00_Mountain_Time_-_Dawson' => '(GMT-07:00) Mountain Time - Dawson',
            'GMT_-07:00_Mountain_Time_-_Denver' => '(GMT-07:00) Mountain Time - Denver',
            'GMT_-07:00_Mountain_Time_-_Edmonton' => '(GMT-07:00) Mountain Time - Edmonton',
            'GMT_-07:00_Mountain_Time_-_Inuvik' => '(GMT-07:00) Mountain Time - Inuvik',
            'GMT_-07:00_Mountain_Time_-_Ojinaga' => '(GMT-07:00) Mountain Time - Ojinaga',
            'GMT_-07:00_Mountain_Time_-_Whitehorse' => '(GMT-07:00) Mountain Time - Whitehorse',
            'GMT_-07:00_Mountain_Time_-_Yellowknife' => '(GMT-07:00) Mountain Time - Yellowknife',
            'GMT_-06:00_Central_Standard_Time_-_Belize' => '(GMT-06:00) Central Standard Time - Belize',
            'GMT_-06:00_Central_Standard_Time_-_Costa_Rica' => '(GMT-06:00) Central Standard Time - Costa Rica',
            'GMT_-06:00_Central_Standard_Time_-_El_Salvador' => '(GMT-06:00) Central Standard Time - El Salvador',
            'GMT_-06:00_Central_Standard_Time_-_Guatemala' => '(GMT-06:00) Central Standard Time - Guatemala',
            'GMT_-06:00_Central_Standard_Time_-_Managua' => '(GMT-06:00) Central Standard Time - Managua',
            'GMT_-06:00_Central_Standard_Time_-_Regina' => '(GMT-06:00) Central Standard Time - Regina',
            'GMT_-06:00_Central_Standard_Time_-_Swift_Current' => '(GMT-06:00) Central Standard Time - Swift Current',
            'GMT_-06:00_Central_Standard_Time_-_Tegucigalpa' => '(GMT-06:00) Central Standard Time - Tegucigalpa',
            'GMT_-06:00_Central_Time_-_Bahia_Banderas' => '(GMT-06:00) Central Time - Bahia Banderas',
            'GMT_-06:00_Central_Time_-_Beulah,_North_Dakota' => '(GMT-06:00) Central Time - Beulah, North Dakota',
            'GMT_-06:00_Central_Time_-_Center,_North_Dakota' => '(GMT-06:00) Central Time - Center, North Dakota',
            'GMT_-06:00_Central_Time_-_Chicago' => '(GMT-06:00) Central Time - Chicago',
            'GMT_-06:00_Central_Time_-_Knox,_Indiana' => '(GMT-06:00) Central Time - Knox, Indiana',
            'GMT_-06:00_Central_Time_-_Matamoros' => '(GMT-06:00) Central Time - Matamoros',
            'GMT_-06:00_Central_Time_-_Menominee' => '(GMT-06:00) Central Time - Menominee',
            'GMT_-06:00_Central_Time_-_Merida' => '(GMT-06:00) Central Time - Merida',
            'GMT_-06:00_Central_Time_-_Mexico_City' => '(GMT-06:00) Central Time - Mexico City',
            'GMT_-06:00_Central_Time_-_Monterrey' => '(GMT-06:00) Central Time - Monterrey',
            'GMT_-06:00_Central_Time_-_New_Salem,_North_Dakota' => '(GMT-06:00) Central Time - New Salem, North Dakota',
            'GMT_-06:00_Central_Time_-_Rainy_River' => '(GMT-06:00) Central Time - Rainy River',
            'GMT_-06:00_Central_Time_-_Rankin_Inlet' => '(GMT-06:00) Central Time - Rankin Inlet',
            'GMT_-06:00_Central_Time_-_Resolute' => '(GMT-06:00) Central Time - Resolute',
            'GMT_-06:00_Central_Time_-_Tell_City,_Indiana' => '(GMT-06:00) Central Time - Tell City, Indiana',
            'GMT_-06:00_Central_Time_-_Winnipeg' => '(GMT-06:00) Central Time - Winnipeg',
            'GMT_-06:00_Galapagos_Time' => '(GMT-06:00) Galapagos Time',
            'GMT_-05:00_Acre_Standard_Time_-_Eirunepe' => '(GMT-05:00) Acre Standard Time - Eirunepe',
            'GMT_-05:00_Acre_Standard_Time_-_Rio_Branco' => '(GMT-05:00) Acre Standard Time - Rio Branco',
            'GMT_-05:00_Colombia_Standard_Time' => '(GMT-05:00) Colombia Standard Time',
            'GMT_-05:00_Cuba_Time' => '(GMT-05:00) Cuba Time',
            'GMT_-05:00_Easter_Island_Time' => '(GMT-05:00) Easter Island Time',
            'GMT_-05:00_Eastern_Standard_Time_-_Atikokan' => '(GMT-05:00) Eastern Standard Time - Atikokan',
            'GMT_-05:00_Eastern_Standard_Time_-_Cancun' => '(GMT-05:00) Eastern Standard Time - Cancun',
            'GMT_-05:00_Eastern_Standard_Time_-_Jamaica' => '(GMT-05:00) Eastern Standard Time - Jamaica',
            'GMT_-05:00_Eastern_Standard_Time_-_Panama' => '(GMT-05:00) Eastern Standard Time - Panama',
            'GMT_-05:00_Eastern_Time_-_Detroit' => '(GMT-05:00) Eastern Time - Detroit',
            'GMT_-05:00_Eastern_Time_-_Grand_Turk' => '(GMT-05:00) Eastern Time - Grand Turk',
            'GMT_-05:00_Eastern_Time_-_Indianapolis' => '(GMT-05:00) Eastern Time - Indianapolis',
            'GMT_-05:00_Eastern_Time_-_Iqaluit' => '(GMT-05:00) Eastern Time - Iqaluit',
            'GMT_-05:00_Eastern_Time_-_Louisville' => '(GMT-05:00) Eastern Time - Louisville',
            'GMT_-05:00_Eastern_Time_-_Marengo,_Indiana' => '(GMT-05:00) Eastern Time - Marengo, Indiana',
            'GMT_-05:00_Eastern_Time_-_Monticello,_Kentucky' => '(GMT-05:00) Eastern Time - Monticello, Kentucky',
            'GMT_-05:00_Eastern_Time_-_Nassau' => '(GMT-05:00) Eastern Time - Nassau',
            'GMT_-05:00_Eastern_Time_-_New_York' => '(GMT-05:00) Eastern Time - New York',
            'GMT_-05:00_Eastern_Time_-_Nipigon' => '(GMT-05:00) Eastern Time - Nipigon',
            'GMT_-05:00_Eastern_Time_-_Pangnirtung' => '(GMT-05:00) Eastern Time - Pangnirtung',
            'GMT_-05:00_Eastern_Time_-_Petersburg,_Indiana' => '(GMT-05:00) Eastern Time - Petersburg, Indiana',
            'GMT_-05:00_Eastern_Time_-_Port_-au_-Prince' => '(GMT-05:00) Eastern Time - Port-au-Prince',
            'GMT_-05:00_Eastern_Time_-_Thunder_Bay' => '(GMT-05:00) Eastern Time - Thunder Bay',
            'GMT_-05:00_Eastern_Time_-_Toronto' => '(GMT-05:00) Eastern Time - Toronto',
            'GMT_-05:00_Eastern_Time_-_Vevay,_Indiana' => '(GMT-05:00) Eastern Time - Vevay, Indiana',
            'GMT_-05:00_Eastern_Time_-_Vincennes,_Indiana' => '(GMT-05:00) Eastern Time - Vincennes, Indiana',
            'GMT_-05:00_Eastern_Time_-_Winamac,_Indiana' => '(GMT-05:00) Eastern Time - Winamac, Indiana',
            'GMT_-05:00_Ecuador_Time' => '(GMT-05:00) Ecuador Time',
            'GMT_-05:00_Peru_Standard_Time' => '(GMT-05:00) Peru Standard Time',
            'GMT_-04:00_Amazon_Standard_Time_-_Boa_Vista' => '(GMT-04:00) Amazon Standard Time - Boa Vista',
            'GMT_-04:00_Amazon_Standard_Time_-_Campo_Grande' => '(GMT-04:00) Amazon Standard Time - Campo Grande',
            'GMT_-04:00_Amazon_Standard_Time_-_Cuiaba' => '(GMT-04:00) Amazon Standard Time - Cuiaba',
            'GMT_-04:00_Amazon_Standard_Time_-_Manaus' => '(GMT-04:00) Amazon Standard Time - Manaus',
            'GMT_-04:00_Amazon_Standard_Time_-_Porto_Velho' => '(GMT-04:00) Amazon Standard Time - Porto Velho',
            'GMT_-04:00_Atlantic_Standard_Time_-_Barbados' => '(GMT-04:00) Atlantic Standard Time - Barbados',
            'GMT_-04:00_Atlantic_Standard_Time_-_Blanc_-Sablon' => '(GMT-04:00) Atlantic Standard Time - Blanc-Sablon',
            'GMT_-04:00_Atlantic_Standard_Time_-_Curaçao' => '(GMT-04:00) Atlantic Standard Time - Curaçao',
            'GMT_-04:00_Atlantic_Standard_Time_-_Martinique' => '(GMT-04:00) Atlantic Standard Time - Martinique',
            'GMT_-04:00_Atlantic_Standard_Time_-_Port_of_Spain' => '(GMT-04:00) Atlantic Standard Time - Port of Spain',
            'GMT_-04:00_Atlantic_Standard_Time_-_Puerto_Rico' => '(GMT-04:00) Atlantic Standard Time - Puerto Rico',
            'GMT_-04:00_Atlantic_Standard_Time_-_Santo_Domingo' => '(GMT-04:00) Atlantic Standard Time - Santo Domingo',
            'GMT_-04:00_Atlantic_Time_-_Bermuda' => '(GMT-04:00) Atlantic Time - Bermuda',
            'GMT_-04:00_Atlantic_Time_-_Glace_Bay' => '(GMT-04:00) Atlantic Time - Glace Bay',
            'GMT_-04:00_Atlantic_Time_-_Goose_Bay' => '(GMT-04:00) Atlantic Time - Goose Bay',
            'GMT_-04:00_Atlantic_Time_-_Halifax' => '(GMT-04:00) Atlantic Time - Halifax',
            'GMT_-04:00_Atlantic_Time_-_Moncton' => '(GMT-04:00) Atlantic Time - Moncton',
            'GMT_-04:00_Atlantic_Time_-_Thule' => '(GMT-04:00) Atlantic Time - Thule',
            'GMT_-04:00_Bolivia_Time' => '(GMT-04:00) Bolivia Time',
            'GMT_-04:00_Guyana_Time' => '(GMT-04:00) Guyana Time',
            'GMT_-04:00_Venezuela_Time' => '(GMT-04:00) Venezuela Time',
            'GMT_-03:30_Newfoundland_Time' => '(GMT-03:30) Newfoundland Time',
            'GMT_-03:00_Argentina_Standard_Time_-_Buenos_Aires' => '(GMT-03:00) Argentina Standard Time - Buenos Aires',
            'GMT_-03:00_Argentina_Standard_Time_-_Catamarca' => '(GMT-03:00) Argentina Standard Time - Catamarca',
            'GMT_-03:00_Argentina_Standard_Time_-_Cordoba' => '(GMT-03:00) Argentina Standard Time - Cordoba',
            'GMT_-03:00_Argentina_Standard_Time_-_Jujuy' => '(GMT-03:00) Argentina Standard Time - Jujuy',
            'GMT_-03:00_Argentina_Standard_Time_-_La_Rioja' => '(GMT-03:00) Argentina Standard Time - La Rioja',
            'GMT_-03:00_Argentina_Standard_Time_-_Mendoza' => '(GMT-03:00) Argentina Standard Time - Mendoza',
            'GMT_-03:00_Argentina_Standard_Time_-_Rio_Gallegos' => '(GMT-03:00) Argentina Standard Time - Rio Gallegos',
            'GMT_-03:00_Argentina_Standard_Time_-_Salta' => '(GMT-03:00) Argentina Standard Time - Salta',
            'GMT_-03:00_Argentina_Standard_Time_-_San_Juan' => '(GMT-03:00) Argentina Standard Time - San Juan',
            'GMT_-03:00_Argentina_Standard_Time_-_San_Luis' => '(GMT-03:00) Argentina Standard Time - San Luis',
            'GMT_-03:00_Argentina_Standard_Time_-_Tucuman' => '(GMT-03:00) Argentina Standard Time - Tucuman',
            'GMT_-03:00_Argentina_Standard_Time_-_Ushuaia' => '(GMT-03:00) Argentina Standard Time - Ushuaia',
            'GMT_-03:00_Brasilia_Standard_Time_-_Araguaina' => '(GMT-03:00) Brasilia Standard Time - Araguaina',
            'GMT_-03:00_Brasilia_Standard_Time_-_Bahia' => '(GMT-03:00) Brasilia Standard Time - Bahia',
            'GMT_-03:00_Brasilia_Standard_Time_-_Belem' => '(GMT-03:00) Brasilia Standard Time - Belem',
            'GMT_-03:00_Brasilia_Standard_Time_-_Fortaleza' => '(GMT-03:00) Brasilia Standard Time - Fortaleza',
            'GMT_-03:00_Brasilia_Standard_Time_-_Maceio' => '(GMT-03:00) Brasilia Standard Time - Maceio',
            'GMT_-03:00_Brasilia_Standard_Time_-_Recife' => '(GMT-03:00) Brasilia Standard Time - Recife',
            'GMT_-03:00_Brasilia_Standard_Time_-_Santarem' => '(GMT-03:00) Brasilia Standard Time - Santarem',
            'GMT_-03:00_Brasilia_Standard_Time_-_Sao_Paulo' => '(GMT-03:00) Brasilia Standard Time - Sao Paulo',
            'GMT_-03:00_Chile_Time' => '(GMT-03:00) Chile Time',
            'GMT_-03:00_Falkland_Islands_Standard_Time' => '(GMT-03:00) Falkland Islands Standard Time',
            'GMT_-03:00_French_Guiana_Time' => '(GMT-03:00) French Guiana Time',
            'GMT_-03:00_Palmer_Time' => '(GMT-03:00) Palmer Time',
            'GMT_-03:00_Paraguay_Time' => '(GMT-03:00) Paraguay Time',
            'GMT_-03:00_Punta_Arenas_Time' => '(GMT-03:00) Punta Arenas Time',
            'GMT_-03:00_Rothera_Time' => '(GMT-03:00) Rothera Time',
            'GMT_-03:00_St._Pierre_&_Miquelon_Time' => '(GMT-03:00) St. Pierre & Miquelon Time',
            'GMT_-03:00_Suriname_Time' => '(GMT-03:00) Suriname Time',
            'GMT_-03:00_Uruguay_Standard_Time' => '(GMT-03:00) Uruguay Standard Time',
            'GMT_-03:00_West_Greenland_Time' => '(GMT-03:00) West Greenland Time',
            'GMT_-02:00_Fernando_de_Noronha_Standard_Time' => '(GMT-02:00) Fernando de Noronha Standard Time',
            'GMT_-02:00_South_Georgia_Time' => '(GMT-02:00) South Georgia Time',
            'GMT_-01:00_Azores_Time' => '(GMT-01:00) Azores Time',
            'GMT_-01:00_Cape_Verde_Standard_Time' => '(GMT-01:00) Cape Verde Standard Time',
            'GMT_-01:00_East_Greenland_Time' => '(GMT-01:00) East Greenland Time',
            'GMT_+00:00_Coordinated_Universal_Time' => '(GMT+00:00) Coordinated Universal Time',
            'GMT_+00:00_Greenwich_Mean_Time' => '(GMT+00:00) Greenwich Mean Time',
            'GMT_+00:00_Greenwich_Mean_Time_-_Abidjan' => '(GMT+00:00) Greenwich Mean Time - Abidjan',
            'GMT_+00:00_Greenwich_Mean_Time_-_Accra' => '(GMT+00:00) Greenwich Mean Time - Accra',
            'GMT_+00:00_Greenwich_Mean_Time_-_Bissau' => '(GMT+00:00) Greenwich Mean Time - Bissau',
            'GMT_+00:00_Greenwich_Mean_Time_-_Danmarkshavn' => '(GMT+00:00) Greenwich Mean Time - Danmarkshavn',
            'GMT_+00:00_Greenwich_Mean_Time_-_Monrovia' => '(GMT+00:00) Greenwich Mean Time - Monrovia',
            'GMT_+00:00_Greenwich_Mean_Time_-_Reykjavik' => '(GMT+00:00) Greenwich Mean Time - Reykjavik',
            'GMT_+00:00_Greenwich_Mean_Time_-_São_Tomé' => '(GMT+00:00) Greenwich Mean Time - São Tomé',
            'GMT_+00:00_Ireland_Time' => '(GMT+00:00) Ireland Time',
            'GMT_+00:00_Troll_Time' => '(GMT+00:00) Troll Time',
            'GMT_+00:00_United_Kingdom_Time' => '(GMT+00:00) United Kingdom Time',
            'GMT_+00:00_Western_European_Time_-_Canary' => '(GMT+00:00) Western European Time - Canary',
            'GMT_+00:00_Western_European_Time_-_Faroe' => '(GMT+00:00) Western European Time - Faroe',
            'GMT_+00:00_Western_European_Time_-_Lisbon' => '(GMT+00:00) Western European Time - Lisbon',
            'GMT_+00:00_Western_European_Time_-_Madeira' => '(GMT+00:00) Western European Time - Madeira',
            'GMT_+01:00_Central_European_Standard_Time_-_Algiers' => '(GMT+01:00) Central European Standard Time - Algiers',
            'GMT_+01:00_Central_European_Standard_Time_-_Tunis' => '(GMT+01:00) Central European Standard Time - Tunis',
            'GMT_+01:00_Central_European_Time_-_Amsterdam' => '(GMT+01:00) Central European Time - Amsterdam',
            'GMT_+01:00_Central_European_Time_-_Andorra' => '(GMT+01:00) Central European Time - Andorra',
            'GMT_+01:00_Central_European_Time_-_Belgrade' => '(GMT+01:00) Central European Time - Belgrade',
            'GMT_+01:00_Central_European_Time_-_Berlin' => '(GMT+01:00) Central European Time - Berlin',
            'GMT_+01:00_Central_European_Time_-_Brussels' => '(GMT+01:00) Central European Time - Brussels',
            'GMT_+01:00_Central_European_Time_-_Budapest' => '(GMT+01:00) Central European Time - Budapest',
            'GMT_+01:00_Central_European_Time_-_Ceuta' => '(GMT+01:00) Central European Time - Ceuta',
            'GMT_+01:00_Central_European_Time_-_Copenhagen' => '(GMT+01:00) Central European Time - Copenhagen',
            'GMT_+01:00_Central_European_Time_-_Gibraltar' => '(GMT+01:00) Central European Time - Gibraltar',
            'GMT_+01:00_Central_European_Time_-_Luxembourg' => '(GMT+01:00) Central European Time - Luxembourg',
            'GMT_+01:00_Central_European_Time_-_Madrid' => '(GMT+01:00) Central European Time - Madrid',
            'GMT_+01:00_Central_European_Time_-_Malta' => '(GMT+01:00) Central European Time - Malta',
            'GMT_+01:00_Central_European_Time_-_Monaco' => '(GMT+01:00) Central European Time - Monaco',
            'GMT_+01:00_Central_European_Time_-_Oslo' => '(GMT+01:00) Central European Time - Oslo',
            'GMT_+01:00_Central_European_Time_-_Paris' => '(GMT+01:00) Central European Time - Paris',
            'GMT_+01:00_Central_European_Time_-_Prague' => '(GMT+01:00) Central European Time - Prague',
            'GMT_+01:00_Central_European_Time_-_Rome' => '(GMT+01:00) Central European Time - Rome',
            'GMT_+01:00_Central_European_Time_-_Stockholm' => '(GMT+01:00) Central European Time - Stockholm',
            'GMT_+01:00_Central_European_Time_-_Tirane' => '(GMT+01:00) Central European Time - Tirane',
            'GMT_+01:00_Central_European_Time_-_Vienna' => '(GMT+01:00) Central European Time - Vienna',
            'GMT_+01:00_Central_European_Time_-_Warsaw' => '(GMT+01:00) Central European Time - Warsaw',
            'GMT_+01:00_Central_European_Time_-_Zurich' => '(GMT+01:00) Central European Time - Zurich',
            'GMT_+01:00_Morocco_Time' => '(GMT+01:00) Morocco Time',
            'GMT_+01:00_West_Africa_Standard_Time_-_Lagos' => '(GMT+01:00) West Africa Standard Time - Lagos',
            'GMT_+01:00_West_Africa_Standard_Time_-_Ndjamena' => '(GMT+01:00) West Africa Standard Time - Ndjamena',
            'GMT_+01:00_Western_Sahara_Time' => '(GMT+01:00) Western Sahara Time',
            'GMT_+02:00_Central_Africa_Time_-_Khartoum' => '(GMT+02:00) Central Africa Time - Khartoum',
            'GMT_+02:00_Central_Africa_Time_-_Maputo' => '(GMT+02:00) Central Africa Time - Maputo',
            'GMT_+02:00_Central_Africa_Time_-_Windhoek' => '(GMT+02:00) Central Africa Time - Windhoek',
            'GMT_+02:00_Eastern_European_Standard_Time_-_Cairo' => '(GMT+02:00) Eastern European Standard Time - Cairo',
            'GMT_+02:00_Eastern_European_Standard_Time_-_Kaliningrad' => '(GMT+02:00) Eastern European Standard Time - Kaliningrad',
            'GMT_+02:00_Eastern_European_Standard_Time_-_Tripoli' => '(GMT+02:00) Eastern European Standard Time - Tripoli',
            'GMT_+02:00_Eastern_European_Time_-_Amman' => '(GMT+02:00) Eastern European Time - Amman',
            'GMT_+02:00_Eastern_European_Time_-_Athens' => '(GMT+02:00) Eastern European Time - Athens',
            'GMT_+02:00_Eastern_European_Time_-_Beirut' => '(GMT+02:00) Eastern European Time - Beirut',
            'GMT_+02:00_Eastern_European_Time_-_Bucharest' => '(GMT+02:00) Eastern European Time - Bucharest',
            'GMT_+02:00_Eastern_European_Time_-_Chisinau' => '(GMT+02:00) Eastern European Time - Chisinau',
            'GMT_+02:00_Eastern_European_Time_-_Damascus' => '(GMT+02:00) Eastern European Time - Damascus',
            'GMT_+02:00_Eastern_European_Time_-_Gaza' => '(GMT+02:00) Eastern European Time - Gaza',
            'GMT_+02:00_Eastern_European_Time_-_Hebron' => '(GMT+02:00) Eastern European Time - Hebron',
            'GMT_+02:00_Eastern_European_Time_-_Helsinki' => '(GMT+02:00) Eastern European Time - Helsinki',
            'GMT_+02:00_Eastern_European_Time_-_Kiev' => '(GMT+02:00) Eastern European Time - Kiev',
            'GMT_+02:00_Eastern_European_Time_-_Nicosia' => '(GMT+02:00) Eastern European Time - Nicosia',
            'GMT_+02:00_Eastern_European_Time_-_Riga' => '(GMT+02:00) Eastern European Time - Riga',
            'GMT_+02:00_Eastern_European_Time_-_Sofia' => '(GMT+02:00) Eastern European Time - Sofia',
            'GMT_+02:00_Eastern_European_Time_-_Tallinn' => '(GMT+02:00) Eastern European Time - Tallinn',
            'GMT_+02:00_Eastern_European_Time_-_Uzhhorod' => '(GMT+02:00) Eastern European Time - Uzhhorod',
            'GMT_+02:00_Eastern_European_Time_-_Vilnius' => '(GMT+02:00) Eastern European Time - Vilnius',
            'GMT_+02:00_Eastern_European_Time_-_Zaporozhye' => '(GMT+02:00) Eastern European Time - Zaporozhye',
            'GMT_+02:00_Famagusta_Time' => '(GMT+02:00) Famagusta Time',
            'GMT_+02:00_Israel_Time' => '(GMT+02:00) Israel Time',
            'GMT_+02:00_South_Africa_Standard_Time' => '(GMT+02:00) South Africa Standard Time',
            'GMT_+03:00_Arabian_Standard_Time_-_Baghdad' => '(GMT+03:00) Arabian Standard Time - Baghdad',
            'GMT_+03:00_Arabian_Standard_Time_-_Qatar' => '(GMT+03:00) Arabian Standard Time - Qatar',
            'GMT_+03:00_Arabian_Standard_Time_-_Riyadh' => '(GMT+03:00) Arabian Standard Time - Riyadh',
            'GMT_+03:00_East_Africa_Time_-_Juba' => '(GMT+03:00) East Africa Time - Juba',
            'GMT_+03:00_East_Africa_Time_-_Nairobi' => '(GMT+03:00) East Africa Time - Nairobi',
            'GMT_+03:00_Kirov_Time' => '(GMT+03:00) Kirov Time',
            'GMT_+03:00_Moscow_Standard_Time_-_Minsk' => '(GMT+03:00) Moscow Standard Time - Minsk',
            'GMT_+03:00_Moscow_Standard_Time_-_Moscow' => '(GMT+03:00) Moscow Standard Time - Moscow',
            'GMT_+03:00_Moscow_Standard_Time_-_Simferopol' => '(GMT+03:00) Moscow Standard Time - Simferopol',
            'GMT_+03:00_Syowa_Time' => '(GMT+03:00) Syowa Time',
            'GMT_+03:00_Turkey_Time' => '(GMT+03:00) Turkey Time',
            'GMT_+04:00_Volgograd_Standard_Time' => '(GMT+04:00) Volgograd Standard Time',
            'GMT_+03:30_Iran_Time' => '(GMT+03:30) Iran Time',
            'GMT_+04:00_Armenia_Standard_Time' => '(GMT+04:00) Armenia Standard Time',
            'GMT_+04:00_Astrakhan_Time' => '(GMT+04:00) Astrakhan Time',
            'GMT_+04:00_Azerbaijan_Standard_Time' => '(GMT+04:00) Azerbaijan Standard Time',
            'GMT_+04:00_Georgia_Standard_Time' => '(GMT+04:00) Georgia Standard Time',
            'GMT_+04:00_Gulf_Standard_Time' => '(GMT+04:00) Gulf Standard Time',
            'GMT_+04:00_Mauritius_Standard_Time' => '(GMT+04:00) Mauritius Standard Time',
            'GMT_+04:00_Réunion_Time' => '(GMT+04:00) Réunion Time',
            'GMT_+04:00_Samara_Standard_Time' => '(GMT+04:00) Samara Standard Time',
            'GMT_+04:00_Saratov_Time' => '(GMT+04:00) Saratov Time',
            'GMT_+04:00_Seychelles_Time' => '(GMT+04:00) Seychelles Time',
            'GMT_+04:00_Ulyanovsk_Time' => '(GMT+04:00) Ulyanovsk Time',
            'GMT_+04:30_Afghanistan_Time' => '(GMT+04:30) Afghanistan Time',
            'GMT_+05:00_French_Southern_&_Antarctic_Time' => '(GMT+05:00) French Southern & Antarctic Time',
            'GMT_+05:00_Maldives_Time' => '(GMT+05:00) Maldives Time',
            'GMT_+05:00_Mawson_Time' => '(GMT+05:00) Mawson Time',
            'GMT_+05:00_Pakistan_Standard_Time' => '(GMT+05:00) Pakistan Standard Time',
            'GMT_+05:00_Tajikistan_Time' => '(GMT+05:00) Tajikistan Time',
            'GMT_+05:00_Turkmenistan_Standard_Time' => '(GMT+05:00) Turkmenistan Standard Time',
            'GMT_+05:00_Uzbekistan_Standard_Time_-_Samarkand' => '(GMT+05:00) Uzbekistan Standard Time - Samarkand',
            'GMT_+05:00_Uzbekistan_Standard_Time_-_Tashkent' => '(GMT+05:00) Uzbekistan Standard Time - Tashkent',
            'GMT_+05:00_West_Kazakhstan_Time_-_Aqtau' => '(GMT+05:00) West Kazakhstan Time - Aqtau',
            'GMT_+05:00_West_Kazakhstan_Time_-_Aqtobe' => '(GMT+05:00) West Kazakhstan Time - Aqtobe',
            'GMT_+05:00_West_Kazakhstan_Time_-_Atyrau' => '(GMT+05:00) West Kazakhstan Time - Atyrau',
            'GMT_+05:00_West_Kazakhstan_Time_-_Oral' => '(GMT+05:00) West Kazakhstan Time - Oral',
            'GMT_+05:00_West_Kazakhstan_Time_-_Qyzylorda' => '(GMT+05:00) West Kazakhstan Time - Qyzylorda',
            'GMT_+05:00_Yekaterinburg_Standard_Time' => '(GMT+05:00) Yekaterinburg Standard Time',
            'GMT_+05:30_India_Standard_Time_-_Colombo' => '(GMT+05:30) India Standard Time - Colombo',
            'GMT_+05:30_India_Standard_Time_-_Kolkata' => '(GMT+05:30) India Standard Time - Kolkata',
            'GMT_+05:45_Nepal_Time' => '(GMT+05:45) Nepal Time',
            'GMT_+06:00_Bangladesh_Standard_Time' => '(GMT+06:00) Bangladesh Standard Time',
            'GMT_+06:00_Bhutan_Time' => '(GMT+06:00) Bhutan Time',
            'GMT_+06:00_East_Kazakhstan_Time_-_Almaty' => '(GMT+06:00) East Kazakhstan Time - Almaty',
            'GMT_+06:00_East_Kazakhstan_Time_-_Kostanay' => '(GMT+06:00) East Kazakhstan Time - Kostanay',
            'GMT_+06:00_Indian_Ocean_Time' => '(GMT+06:00) Indian Ocean Time',
            'GMT_+06:00_Kyrgyzstan_Time' => '(GMT+06:00) Kyrgyzstan Time',
            'GMT_+06:00_Omsk_Standard_Time' => '(GMT+06:00) Omsk Standard Time',
            'GMT_+06:00_Urumqi_Time' => '(GMT+06:00) Urumqi Time',
            'GMT_+06:00_Vostok_Time' => '(GMT+06:00) Vostok Time',
            'GMT_+06:30_Cocos_Islands_Time' => '(GMT+06:30) Cocos Islands Time',
            'GMT_+06:30_Myanmar_Time' => '(GMT+06:30) Myanmar Time',
            'GMT_+07:00_Barnaul_Time' => '(GMT+07:00) Barnaul Time',
            'GMT_+07:00_Christmas_Island_Time' => '(GMT+07:00) Christmas Island Time',
            'GMT_+07:00_Davis_Time' => '(GMT+07:00) Davis Time',
            'GMT_+07:00_Hovd_Standard_Time' => '(GMT+07:00) Hovd Standard Time',
            'GMT_+07:00_Indochina_Time_-_Bangkok' => '(GMT+07:00) Indochina Time - Bangkok',
            'GMT_+07:00_Indochina_Time_-_Ho_Chi_Minh_City' => '(GMT+07:00) Indochina Time - Ho Chi Minh City',
            'GMT_+07:00_Krasnoyarsk_Standard_Time_-_Krasnoyarsk' => '(GMT+07:00) Krasnoyarsk Standard Time - Krasnoyarsk',
            'GMT_+07:00_Krasnoyarsk_Standard_Time_-_Novokuznetsk' => '(GMT+07:00) Krasnoyarsk Standard Time - Novokuznetsk',
            'GMT_+07:00_Novosibirsk_Standard_Time' => '(GMT+07:00) Novosibirsk Standard Time',
            'GMT_+07:00_Tomsk_Time' => '(GMT+07:00) Tomsk Time',
            'GMT_+07:00_Western_Indonesia_Time_-_Jakarta' => '(GMT+07:00) Western Indonesia Time - Jakarta',
            'GMT_+07:00_Western_Indonesia_Time_-_Pontianak' => '(GMT+07:00) Western Indonesia Time - Pontianak',
            'GMT_+08:00_Australian_Western_Standard_Time' => '(GMT+08:00) Australian Western Standard Time',
            'GMT_+08:00_Brunei_Darussalam_Time' => '(GMT+08:00) Brunei Darussalam Time',
            'GMT_+08:00_Central_Indonesia_Time' => '(GMT+08:00) Central Indonesia Time',
            'GMT_+08:00_China_Standard_Time_-_Macao' => '(GMT+08:00) China Standard Time - Macao',
            'GMT_+08:00_China_Standard_Time_-_Shanghai' => '(GMT+08:00) China Standard Time - Shanghai',
            'GMT_+08:00_Hong_Kong_Standard_Time' => '(GMT+08:00) Hong Kong Standard Time',
            'GMT_+08:00_Irkutsk_Standard_Time' => '(GMT+08:00) Irkutsk Standard Time',
            'GMT_+08:00_Malaysia_Time_-_Kuala_Lumpur' => '(GMT+08:00) Malaysia Time - Kuala Lumpur',
            'GMT_+08:00_Malaysia_Time_-_Kuching' => '(GMT+08:00) Malaysia Time - Kuching',
            'GMT_+08:00_Philippine_Standard_Time' => '(GMT+08:00) Philippine Standard Time',
            'GMT_+08:00_Singapore_Standard_Time' => '(GMT+08:00) Singapore Standard Time',
            'GMT_+08:00_Taipei_Standard_Time' => '(GMT+08:00) Taipei Standard Time',
            'GMT_+08:00_Ulaanbaatar_Standard_Time_-_Choibalsan' => '(GMT+08:00) Ulaanbaatar Standard Time - Choibalsan',
            'GMT_+08:00_Ulaanbaatar_Standard_Time_-_Ulaanbaatar' => '(GMT+08:00) Ulaanbaatar Standard Time - Ulaanbaatar',
            'GMT_+08:45_Australian_Central_Western_Standard_Time' => '(GMT+08:45) Australian Central Western Standard Time',
            'GMT_+09:00_East_Timor_Time' => '(GMT+09:00) East Timor Time',
            'GMT_+09:00_Eastern_Indonesia_Time' => '(GMT+09:00) Eastern Indonesia Time',
            'GMT_+09:00_Japan_Standard_Time' => '(GMT+09:00) Japan Standard Time',
            'GMT_+09:00_Korean_Standard_Time_-_Pyongyang' => '(GMT+09:00) Korean Standard Time - Pyongyang',
            'GMT_+09:00_Korean_Standard_Time_-_Seoul' => '(GMT+09:00) Korean Standard Time - Seoul',
            'GMT_+09:00_Palau_Time' => '(GMT+09:00) Palau Time',
            'GMT_+09:00_Yakutsk_Standard_Time_-_Chita' => '(GMT+09:00) Yakutsk Standard Time - Chita',
            'GMT_+09:00_Yakutsk_Standard_Time_-_Khandyga' => '(GMT+09:00) Yakutsk Standard Time - Khandyga',
            'GMT_+09:00_Yakutsk_Standard_Time_-_Yakutsk' => '(GMT+09:00) Yakutsk Standard Time - Yakutsk',
            'GMT_+09:30_Australian_Central_Standard_Time' => '(GMT+09:30) Australian Central Standard Time',
            'GMT_+10:00_Australian_Eastern_Standard_Time_-_Brisbane' => '(GMT+10:00) Australian Eastern Standard Time - Brisbane',
            'GMT_+10:00_Australian_Eastern_Standard_Time_-_Lindeman' => '(GMT+10:00) Australian Eastern Standard Time - Lindeman',
            'GMT_+10:00_Chamorro_Standard_Time' => '(GMT+10:00) Chamorro Standard Time',
            'GMT_+10:00_Chuuk_Time' => '(GMT+10:00) Chuuk Time',
            'GMT_+10:00_Dumont_-d’Urville_Time' => '(GMT+10:00) Dumont-d’Urville Time',
            'GMT_+10:00_Papua_New_Guinea_Time' => '(GMT+10:00) Papua New Guinea Time',
            'GMT_+10:00_Vladivostok_Standard_Time_-_Ust_-Nera' => '(GMT+10:00) Vladivostok Standard Time - Ust-Nera',
            'GMT_+10:00_Vladivostok_Standard_Time_-_Vladivostok' => '(GMT+10:00) Vladivostok Standard Time - Vladivostok',
            'GMT_+10:30_Central_Australia_Time_-_Adelaide' => '(GMT+10:30) Central Australia Time - Adelaide',
            'GMT_+10:30_Central_Australia_Time_-_Broken_Hill' => '(GMT+10:30) Central Australia Time - Broken Hill',
            'GMT_+11:00_Bougainville_Time' => '(GMT+11:00) Bougainville Time',
            'GMT_+11:00_Casey_Time' => '(GMT+11:00) Casey Time',
            'GMT_+11:00_Eastern_Australia_Time_-_Hobart' => '(GMT+11:00) Eastern Australia Time - Hobart',
            'GMT_+11:00_Eastern_Australia_Time_-_Macquarie' => '(GMT+11:00) Eastern Australia Time - Macquarie',
            'GMT_+11:00_Eastern_Australia_Time_-_Melbourne' => '(GMT+11:00) Eastern Australia Time - Melbourne',
            'GMT_+11:00_Eastern_Australia_Time_-_Sydney' => '(GMT+11:00) Eastern Australia Time - Sydney',
            'GMT_+11:00_Kosrae_Time' => '(GMT+11:00) Kosrae Time',
            'GMT_+11:00_Lord_Howe_Time' => '(GMT+11:00) Lord Howe Time',
            'GMT_+11:00_Magadan_Standard_Time' => '(GMT+11:00) Magadan Standard Time',
            'GMT_+11:00_New_Caledonia_Standard_Time' => '(GMT+11:00) New Caledonia Standard Time',
            'GMT_+11:00_Ponape_Time' => '(GMT+11:00) Ponape Time',
            'GMT_+11:00_Sakhalin_Standard_Time' => '(GMT+11:00) Sakhalin Standard Time',
            'GMT_+11:00_Solomon_Islands_Time' => '(GMT+11:00) Solomon Islands Time',
            'GMT_+11:00_Srednekolymsk_Time' => '(GMT+11:00) Srednekolymsk Time',
            'GMT_+11:00_Vanuatu_Standard_Time' => '(GMT+11:00) Vanuatu Standard Time',
            'GMT_+12:00_Anadyr_Standard_Time' => '(GMT+12:00) Anadyr Standard Time',
            'GMT_+12:00_Gilbert_Islands_Time' => '(GMT+12:00) Gilbert Islands Time',
            'GMT_+12:00_Marshall_Islands_Time_-_Kwajalein' => '(GMT+12:00) Marshall Islands Time - Kwajalein',
            'GMT_+12:00_Marshall_Islands_Time_-_Majuro' => '(GMT+12:00) Marshall Islands Time - Majuro',
            'GMT_+12:00_Nauru_Time' => '(GMT+12:00) Nauru Time',
            'GMT_+12:00_Norfolk_Island_Time' => '(GMT+12:00) Norfolk Island Time',
            'GMT_+12:00_Petropavlovsk_-Kamchatski_Standard_Time' => '(GMT+12:00) Petropavlovsk-Kamchatski Standard Time',
            'GMT_+12:00_Tuvalu_Time' => '(GMT+12:00) Tuvalu Time',
            'GMT_+12:00_Wake_Island_Time' => '(GMT+12:00) Wake Island Time',
            'GMT_+12:00_Wallis_&_Futuna_Time' => '(GMT+12:00) Wallis & Futuna Time',
            'GMT_+13:00_Fiji_Time' => '(GMT+13:00) Fiji Time',
            'GMT_+13:00_New_Zealand_Time' => '(GMT+13:00) New Zealand Time',
            'GMT_+13:00_Phoenix_Islands_Time' => '(GMT+13:00) Phoenix Islands Time',
            'GMT_+13:00_Tokelau_Time' => '(GMT+13:00) Tokelau Time',
            'GMT_+13:00_Tonga_Standard_Time' => '(GMT+13:00) Tonga Standard Time',
            'GMT_+13:45_Chatham_Time' => '(GMT+13:45) Chatham Time',
            'GMT_+14:00_Apia_Time' => '(GMT+14:00) Apia Time',
            'GMT_+14:00_Line_Islands_Time' => '(GMT+14:00) Line Islands Time'
        );
        // Check Day Saving Time
        if (empty($clock_type_dst)) {
             $clock_type_dst = 'false';
        }
        // Check the clock type
        $analog_checked = "checked=checked";
        $digital_checked = "";
        if ($clock_type == 'digital')
        {
            $analog_checked = "";
            $digital_checked = "checked=checked";
        }


        //$file = json_decode(maybe_unserialize(file_get_contents($src)));
        $apikey = get_option( 'pt_uc_google_apikey');
        if($apikey ==''){
          $msg = __('Goolge API is key required to include google fonts for digital clcoks.');
          printf( '<div class="notice notice-warning is-dismissible"><p>Warning: %s</p></div>', $msg );
        }
        $file = null;
        if((function_exists('curl_version') || extension_loaded('curl')) && $apikey !=''){



          $src = 'https://www.googleapis.com/webfonts/v1/webfonts?key='.$apikey;
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
              if($file->error){
                $msg = __('Google Fonts ').$file->error->message;
                printf( '<div class="notice notice-warning is-dismissible"><p>Warning: %s</p></div>', $msg );
              }
            }

            curl_close($ch);


        $family = array();
        /* Looping through google font familes to map the array */
        if (is_array($family) && isset($file->items))
        {
            foreach ($file->items as $k => $v)
            {
                $family[$v
                    ->family] = $v->family;
            }
        }
        if ($font_family)
        {
            $family[0] = $font_family;
        }
        else
        {
            $family[0] = '[ Select Font Family ]';
        }
        if (isset($file->items) && is_array($file))
        {
            foreach ($file->items as $k => $v)
            {
                $family[$v
                    ->family] = $v->family;
            }
        }

      }
        /* End Of Maping */
        if (!$font_size)
        {
            $font_size = 15;
        }
     if (!$analog_clock_border_style)
        {
            $analog_clock_border_style = "Solid";
        }

        if (!$analog_clock_border)
        {
            $analog_clock_border = 1;
        }

        ?>
        <div class="universal-clocks-metabox">
            <div class="universal-clocks-templates uca-page-wrap">
                <div class="uca-header">
                    <h4> <?php _e('General', 'universal-clocks'); ?></h4>
                </div>
                <div class="uca-general-box">

                    <!-- Get the time zone -->

                    <div class="uca-label-input">
                        <div class="uca-left-label">
                            <label><?php _e('Select Timezone:', 'universal-clocks'); ?></label>
                        </div>
                        <div class="uca-right-detail">
                            <select name="timezone_offset" id="timezone_offset" class="app-status">
                                <?php
        foreach ($timezones_g as $key => $status)
        {
            if ($key == $crt_timezone)
            {
                $selected = 'selected=selected';
            }
            else
            {
                $selected = '';
            }
            echo '<option value="' . $key . '"' . $selected . '>' . $status . '</option>';
        }
        ?>
                            </select><br/>
                            <span id="msg-timezone_offset" class="error" style="display:none;"><?php esc_html_e('Please select a timezone', 'universal-clocks'); ?></span>
                        </div>
                        <?php
        /*                                 * ****** End Of Digital CLocks ******** */
        ?>
                    </div>


                   <!--============================================
                  =            Check Day Saving Time             =
                  =============================================-->
                     <div class="uca-label-input">
                        <div class="uca-left-label">
                            <label><?php _e('Day Saving Time?', 'universal-clocks'); ?></label>
                        </div>
                        <div class="uca-right-detail">
                        <div class="child-label">
                                <input type="radio" name="clock_type_dst" id="true" class="clock_type_dst" value="true" <?php if($clock_type_dst === 'true') {
                                  echo 'checked="checked"'; } ?> />
                                <label for="true"><?php _e('Yes ', 'universal-clocks'); ?></label>
                            </div>
                            <div class="child-label">
                                <input type="radio" name="clock_type_dst" class="clock_type_dst" id="false" value="false" <?php if($clock_type_dst === 'false') {
                                  echo 'checked="checked"'; } ?> />
                                <label for="false"><?php _e('No ', 'universal-clocks'); ?></label>
                            </div>

                        </div>
                    </div>


                  <!--====  End of Check Day Saving Time   ====-->
                    <!-- Check Clock Type -->

                    <div class="uca-label-input">
                        <div class="uca-left-label">
                            <label><?php _e('Clock Type:', 'universal-clocks'); ?></label>
                        </div>
                        <div class="uca-right-detail">
                        <div class="child-label">
                                <input type="radio" name="clock_type" id="analog" class="clock_type" value="analog" <?php echo esc_attr($analog_checked); ?> />
                                <label for="analog"><?php _e('Analog Clock ', 'universal-clocks'); ?></label>
                            </div>
                            <div class="child-label">
                                <input type="radio" name="clock_type" class="clock_type" id="digital" value="digital" <?php echo esc_attr($digital_checked); ?> />
                                <label for="digital"><?php _e('Digtal   Clock ', 'universal-clocks'); ?></label>
                            </div>

                        </div>
                    </div>

                </div>
         <?php
        // Displaying Digital CLocks
        $hide_no_check = "checked=checked";
        $hide_yes_check = "";
        if ($hide_tittle == 'yes')
        {
            $hide_no_check = "";
            $hide_yes_check = "checked=checked";
        }
        ?>
                <div class="analog-group">
                    <div class="uca-header">
                        <h4> <?php _e('Clock Skin:', 'universal-clocks'); ?></h4>
                    </div>
                    <div class="uca-general-box uca-overflow-clock">

                        <div class="uca-analog-clocks">
                            <ul>
                            <?php
        /*         * **  get the clock skin   ***** */

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
                                if (empty($saved_template_id)) {
                                    $saved_template_id = 1;
                                   // update_post_meta($post->ID, 'template_id', '1');
                                }
                                foreach ($tmplates_data as $template_item)
                                {
                                    $template_id = $template_item['template_id'];
                                    $template_name = $template_item['template_name'];
                                    $filepath = plugin_dir_path(dirname(__FILE__)) . 'images/' . $template_name;
                                    if (file_exists($filepath))
                                    {
                                        $checked = "";
                                        if ($saved_template_id == $template_id)
                                        {
                                            $checked = "checked";
                                        }
                                ?>
                                             <div class="uca-analog-clock">
                                                             <li>
                                                 <label>
                                                   <input type="radio" class="template_ids" name="template_id" value="<?php echo esc_attr($template_id); ?>" <?php echo esc_attr($checked); ?> />
                                              <img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'images/' . $template_name; ?>">
                                                             </label>
                                                         </li>
                                                            </div>
                                                    <?php
                                        $checked = "";
                                    }
                                }

                                /*                             * **   End of  CLocks skin   ***** */
                                /*                             * **   End of Analog CLocks   ***** */
                        ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="uca-header ">
                    <h4><?php _e('Appearance', 'universal-clocks'); ?></h4>
                </div>
                <div class="uca-general-box">
                    <!-- get title option's -->
                    <div class="uca-label-input">
                        <div class="uca-left-label">
                            <label><?php _e('Hide The Timezone?', 'universal-clocks'); ?></label>
                        </div>
                        <div class="uca-right-detail">
                            <div class="child-label">
                                <input type="radio" name="hide_tittle_option" class="hide_tittle" value="no" id="usa-no" <?php echo esc_attr($hide_no_check); ?>>
                                <label for="usa-no"><?php _e('Show', 'universal-clocks'); ?></label>
                            </div>
                            <div class="child-label">
                                <input type="radio" name="hide_tittle_option" class="hide_tittle" value="yes" id="uca-yes" <?php echo esc_attr($hide_yes_check); ?>>
                                <label for="uca-yes"><?php _e('Hide', 'universal-clocks'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="digtal-group">
                        <!-- Get the Font Setting For digital clock -->
                        <div class="uca-label-input">
                            <div class="uca-left-label">
                                <label><?php _e('Font Family:', 'universal-clocks'); ?></label>
                            </div>
                            <div class="uca-right-detail">
                                <select name="time_font_family">
                                    <!-- Font family -->
                                    <?php
                                                foreach ($family as $key => $value)
                                                {
                                                    if ($key == $font_family)
                                                    {
                                                        $selected = 'selected=selected';
                                                        $key = $font_family;
                                                    }
                                                    else
                                                    {
                                                        $selected = '';
                                                    }
                                                    echo '<option value="' . $key . '"' . $selected . '>' . $value . '</option>';
                                                }
                                        ?>
                                </select> <br />
                            </div>
                        </div>
                        <!-- End of google fonts -->

                        <!-- font size -->

                        <div class="uca-label-input-child">
                            <div class="uca-left-label-child">
                                <label><?php _e('Font Size:', 'universal-clocks'); ?></label>
                            </div>
                            <div class="uca-right-detail-child">
                                <input type="number" name="time_font_size" min="0" max="100" value="<?php echo esc_attr($font_size); ?>"> <span class="uca-pixel">px</span>
                            </div>
                        </div>
                        <!-- font weight -->
                        <div class="uca-label-input-child">
                            <div class="uca-left-label-child">
                                <label><?php _e('Font Weight:', 'universal-clocks'); ?></label>
                            </div>
                            <div class="uca-right-detail-child">
                                <select name="time_font_weight">
                                    <option value="bold" <?php selected($font_weight, 'bold'); ?>><?php _e('Bold', 'universal-clocks'); ?></option>
                                    <option value="bolder" <?php selected($font_weight, 'bolder'); ?>><?php _e('Bolder', 'universal-clocks'); ?></option>
                                    <option value="normal" <?php selected($font_weight, 'normal'); ?>><?php _e('Normal', 'universal-clocks'); ?></option>
                                    <option value="lighter" <?php selected($font_weight, 'lighter'); ?>><?php _e('Lighter'); ?></option>
                                    <option value="100" <?php selected($font_weight, '100'); ?>><?php _e('100', 'universal-clocks'); ?></option>
                                    <option value="200" <?php selected($font_weight, '200'); ?>><?php _e('200', 'universal-clocks'); ?></option>
                                    <option value="300" <?php selected($font_weight, '300'); ?>><?php _e('300', 'universal-clocks'); ?></option>
                                    <option value="400" <?php selected($font_weight, '400'); ?>><?php _e('400', 'universal-clocks'); ?></option>
                                    <option value="500" <?php selected($font_weight, '500'); ?>><?php _e('500', 'universal-clocks'); ?></option>
                                    <option value="600" <?php selected($font_weight, '600'); ?>><?php _e('600', 'universal-clocks'); ?></option>
                                    <option value="700" <?php selected($font_weight, '700'); ?>><?php _e('700', 'universal-clocks'); ?></option>
                                    <option value="800" <?php selected($font_weight, '800'); ?>><?php _e('800', 'universal-clocks'); ?></option>
                                    <option value="900" <?php selected($font_weight, '900'); ?>><?php _e('900', 'universal-clocks'); ?></option>
                                </select>
                            </div>
                        </div>
                         <!-- Digital Clock Color -->
                        <div class="uca-label-input">
                            <div class="uca-left-label">
                                <label><?php _e('Clock Color:', 'universal-clocks'); ?></label>
                            </div>
                            <div class="uca-right-detail">
                                <input type="text" name="time_color" value="<?php echo esc_attr($color); ?>" class="color-field" />
                            </div>
                        </div>
                    </div>
                    <!-- Border Options -->
                    <div class="uca-label-input-child">
                        <div class="uca-left-label-child">
                            <label>
                                <?php _e(' Border Size: ', 'universal-clocks'); ?>
                            </label>
                        </div>
                        <div class="uca-right-detail-child">
                            <input type="number" name="analog_clock_border_width" min="0" max="100" value="<?php echo esc_attr($analog_clock_border); ?>" /> <span class="uca-pixel">px</span>
                        </div>
                    </div>
                    <div class="uca-label-input-child">
                        <div class="uca-left-label-child">
                            <label><?php _e('Border Style:  ', 'universal-clocks'); ?></label>
                        </div>
                        <div class="uca-right-detail-child">
                            <select name="analog_clock_border_style">
                                <option value="dotted " <?php selected($analog_clock_border_style, 'dotted'); ?>><?php _e('Dotted', 'universal-clocks'); ?> </option>
                                <option value="dashed" <?php selected($analog_clock_border_style, 'dashed'); ?>><?php _e('Dashed', 'universal-clocks'); ?></option>
                                <option value="solid" <?php selected($analog_clock_border_style, 'solid'); ?>><?php _e('Solid', 'universal-clocks'); ?> </option>
                                <option value="double" <?php selected($analog_clock_border_style, 'double'); ?>><?php _e('Double', 'universal-clocks'); ?></option>
                                <option value="groove" <?php selected($analog_clock_border_style, 'groove'); ?>><?php _e('Groove', 'universal-clocks'); ?></option>
                                <option value="ridge" <?php selected($analog_clock_border_style, 'ridge'); ?>><?php _e('Ridge', 'universal-clocks'); ?></option>
                                <option value="inset" <?php selected($analog_clock_border_style, 'inset'); ?>><?php _e('Inset', 'universal-clocks'); ?></option>
                                <option value="outset" <?php selected($analog_clock_border_style, 'outset'); ?>><?php _e('Outset', 'universal-clocks'); ?></option>
                                <option value="none" <?php selected($analog_clock_border_style, 'none'); ?>><?php _e('None', 'universal-clocks'); ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="uca-label-input">
                        <div class="uca-left-label">
                            <label><?php _e('Border Color:', 'universal-clocks'); ?></label>
                        </div>
                        <div class="uca-right-detail">
                            <input type="text" name="analog_clock_border_color" value="<?php echo esc_attr($analog_clock_border_color); ?>" class="color-field" />
                        </div>
                    </div>
                    <div class="analog-group">
                        <div class="universal-clocks-group">
                            <!-- get background color of analog clock -->

                            <div class="uca-label-input">
                                <div class="uca-left-label">
                                    <label><?php _e('Dial Background Color (Optional):', 'universal-clocks'); ?></label>
                                </div>
                                <div class="uca-right-detail">
                                    <input type="text" name="analog_time_color" value="<?php echo esc_attr($analog_color); ?>" class="color-field" /><br/>
                                    <span><dy style="color: red;" >* </dy><?php esc_html_e('Background color will only work on transparent clock dial.','universal-clocks'); ?></span>
                                </div>
                            </div>

                            <!-- Analog background radius -->
                        </div>

                    </div>
                </div>
                <?php /*         * ******  Display of Analog CLocks ******** */ ?>
            </div>
            <!--universal-clocks-templates-->
        </div>
    <?php
    }

    // Display shortcode inforamtion metabox
    public static function universal_clocks_meta_box_shortcode_output()
    {
        global $post;
?>
        <div class="uca-page-wrap">
        <?php
        echo '<p>' . esc_html__('For inserting manually, shortcode with slug of clcok posts as', 'universal-clocks');
        echo '<br><b>' . esc_html('[universal-clocks', 'universal-clocks');
?> slugs='<?php
        if (!strstr($_SERVER['REQUEST_URI'], 'wp-admin/post-new.php') && is_admin() && get_post_status($post->ID) != 'draft')
        {
            echo $post->post_name;
        }
        else
        {
            _e('Insert here slug-of-clock-post');
        }
?>'] </b> </p>
        <?php esc_html_e('Single Clock would appear like this', 'universal-clocks'); ?>


        <div class="uca-sidemeta-img">
            <div class="uca-image-model">
                <div class="uca-model-img">
    <img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'images/singleclock.png'; ?>" style="width:100%" onclick="openModal();currentSlide(1)" class="hover-shadow cursor">
  </div>
</div> </div>

                    <div id="ucamodel" class="modal">
  <span class="close cursor" onclick="closeModal()">&times;</span>
  <div class="modal-content">

    <div class="uca-model-slide">
      <img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'images/singleclock.png'; ?>" style="width:100%">
    </div>
</div>
</div>

        <?php echo '<p>' . esc_html__('For inserting multiple clocks manually, use Shortcode as', 'universal-clocks'); ?><br>
            <?php
        esc_html_e("[universal-clocks slugs='", "universal-clocks");
        if (!strstr($_SERVER['REQUEST_URI'], 'wp-admin/post-new.php') && is_admin() && get_post_status($post->ID) != 'draft')
        {
            echo $post->post_name;
        }
        else
        {
            _e("slug-of-clock-post", 'universal-clocks');
        }
        esc_html_e(", slug-of-other-clock-post']", "universal-clocks");
        echo '<br>' . esc_html('Multiple Clocks would appear like this', 'universal-clocks'); ?>
        <div class="uca-sidemeta-img">
            <div class="uca-image-model">
                <div class="uca-model-img">
    <img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'images/multipleclocks.png'; ?>" style="width:100%" onclick="openModal1();currentSlide1(2);" class="hover-shadow cursor">
  </div>
</div> </div>

                    <div id="ucamodel1" class="modal">
  <span class="close cursor" onclick="closeModal1()">&times;</span>
  <div class="modal-content">

    <div class="uca-model-slide1">
      <img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'images/multipleclocks.png'; ?>" style="width:100%">
    </div>
</div>
</div>
            <?php
        echo '<br><strong>' . esc_html('Use order Parameter', 'universal-clocks') . ' </strong>' . esc_html('to display the clocks in different orders', 'universal-clocks') . '<br> <b>' . esc_html('Default Value: ASC', 'universal-clocks') . '<br>' . esc_html('Accepted Values: DESC , ASC', 'universal-clocks') . '<br>' . esc_html('Example: order=DESC', 'universal-clocks') . '</b>  </p> </div>';

    }

    /* End of Shortcode Information Meta box */

    /**
     * Save clock meta box.
     *
     * @since   1.1.0
     *
     * @param   int     $post_id    Post id
     * @return  void
     */
    public static function save_universal_clocks_meta($post_id)
    {

        $POST_data = filter_input_array(INPUT_POST);
        foreach ($POST_data as $key => $value)
        {
            /**  options for clocks * */
            if (strstr($key, 'clock_type'))
            {
                update_post_meta($post_id, sanitize_key($key) , $value);
            }
             if (strstr($key, 'clock_type_dst'))
            {
                update_post_meta($post_id, sanitize_key($key) , $value);
            }
            if (strstr($key, 'hide_tittle_option'))
            {
                update_post_meta($post_id, sanitize_key($key) , $value);
            }

            /** options for digtal clcok type **/
            if (strstr($key, 'time_color'))
            {
                update_post_meta($post_id, sanitize_key($key) , $value);
            }
            if (strstr($key, 'time_font_family'))
            {
                update_post_meta($post_id, sanitize_key($key) , $value);
            }
            if (strstr($key, 'time_font_size'))
            {
                update_post_meta($post_id, sanitize_key($key) , $value);
            }
            if (strstr($key, 'time_font_weight'))
            {
                update_post_meta($post_id, sanitize_key($key) , $value);
            }

            /** options for analog clcok type **/
            if (strstr($key, 'analog_time_color'))
            {
                update_post_meta($post_id, sanitize_key($key) , $value);
            }
            if (strstr($key, 'template_id'))
            {
                update_post_meta($post_id, sanitize_key($key) , $value);
            }
            if (strstr($key, 'timezone_offset'))
            {
                update_post_meta($post_id, sanitize_key($key) , $value);
            }
            if (strstr($key, 'timezone_oftime_colorfset'))
            {
                update_post_meta($post_id, sanitize_key($key) , $value);
            }
            if (strstr($key, 'analog_clock_color_radius'))
            {
                update_post_meta($post_id, sanitize_key($key) , $value);
            }
            if (strstr($key, 'analog_clock_border_width'))
            {
                update_post_meta($post_id, sanitize_key($key) , $value);
            }
            if (strstr($key, 'analog_clock_border_style'))
            {
                update_post_meta($post_id, sanitize_key($key) , $value);
            }
            if (strstr($key, 'analog_clock_border_color'))
            {
                update_post_meta($post_id, sanitize_key($key) , $value);
            }
        }
    }
}
