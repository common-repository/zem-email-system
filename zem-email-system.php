<?php
/**
 * @package ZEM emailsystem
 */
/*
  Plugin Name: ZEM emailsystem
  Plugin URI: http://www.zemsolutions.com
  Description: ZEM emailsystem is easy to use Emailsystem. Zem emailsystem has an easy admin interface, user can send email in groups.
  Author: zem solutions
  Version: 1.0.0
  Author URI: http://www.zemsolutions.com
*/

if (!defined('ABSPATH')) die('Access Denied');

define( 'ZEMES_PLUGIN_DIR', plugin_dir_path( __FILE__ ));
define( 'ZEMES_PLUGIN_URL', plugin_dir_url( __FILE__ ));


register_activation_hook(__FILE__, array('zememailsystem' , 'zem_emailsystem_activate'));
register_deactivation_hook(__FILE__, array('zememailsystem', 'zem_emailsystem_deactivate'));

require_once(ZEMES_PLUGIN_DIR.'main.zemes.php');


add_action('init' , array('zememailsystem', 'zem_emailsystem_hooks'));

add_action('init', 'zem_emailstartsession', 1);
add_action('wp_logout', 'zem_email_endsession');
add_action('wp_login', 'zem_email_endsession');

function zem_emailstartsession() {
    if(!session_id()) {
        session_start();
    }
}

function zem_email_endsession() {
    session_destroy ();
}

?>