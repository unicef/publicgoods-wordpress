<?php
/**
  * Plugin Name: Google Analytics for WordPress
  * Plugin URI: https://amanvermaa.wordpress.com/?ref=analytics
  * Author: Aman Verma
  * Author URI: https://twitter.com/amanverma217
  * Description: Google Analytics for WordPress plugin allows you to track your website by entering your google analytics tracking code.
  * Tags: google analytics plugin, analytics for website, universal analytics of website, google analytics, website google analytics plugin wordpress, google analytics for wordpress, GA code, google analytics script, google analytics for woocommerce, googleanalytics
  * Version: 1.3
  * License: GPLv2 or later
  * License URI: http://www.gnu.org/licenses/gpl-2.0.html 
 **/


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action('admin_menu', 'gaw_create_menu');
function gaw_create_menu()
{
   add_menu_page('Google Analytics Settings', 'Google Analytics', 'administrator', 'google-analytics-settings-page', 'fn_gaw_settings_page', 'dashicons-chart-bar');
   add_action( 'admin_init', 'fn_gaw_register_mysettings' );
}


/*****register settings options****/
function fn_gaw_register_mysettings()
{
   register_setting( 'gaw-settings-group', 'gaw_analytics_id' );
   register_setting( 'gaw-settings-group', 'gaw_disable_track' );
}

/*****settings options****/
function fn_gaw_settings_page()
{
   require plugin_dir_path(__FILE__) . 'options.php';
}
$gaw_disable = get_option('gaw_disable_track', 'No');


function fn_gaw_analytics() {
  $web_property_id = get_option('gaw_analytics_id');
?>
  <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $web_property_id ?>"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', '<?php echo $web_property_id ?>');
  </script>
<?php
}


if ( $gaw_disable == 'No' ) {
   add_action('wp_head', 'fn_gaw_analytics');
}