<?php
if (!defined('ABSPATH')) die('Access Denied');

class zemessettingsclass {

    function __construct(){}

    function getZeminitSettings() {
        include_once(ABSPATH.'wp-admin/includes/plugin.php');
        if (is_plugin_active('zem-email-system/zem-email-system.php')) {
            if( ! get_option('zemes_sender_name'))
                update_option('zemes_sender_name', get_bloginfo ('name'));
            if( ! get_option('zemes_sender_email'))
                update_option('zemes_sender_email', get_bloginfo ('admin_email'));
            if( ! get_option('zemes_p_size'))
                update_option('zemes_p_size', 10 );
            zememailsystem::$settings['pagination_default_size'] = get_option('zemes_p_size');
        }
    }

    function setQuickSettingsAjax(){
        $sname = zemesrequest::getVar('sendername');
        $semail = zemesrequest::getVar('senderemail');
        $psize = zemesrequest::getVar('psize');
        $error = false;
        if( update_option('zemes_sender_name', $sname))
            $error = true;
        if( update_option('zemes_sender_email', $semail))
            $error = true;
        if( update_option('zemes_p_size', $psize))
            $error = true;
        if($error)
            return 'ok';
    }
}
?>
