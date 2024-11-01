<?php

if (!defined('ABSPATH')) die('Access Denied');

class zemesSendemailHandler{

    function __construct() {
        self::init();
    }

    function init() {
        if (zemesrequest::canaddview()) {
            $layout = zemesrequest::getLayout('zemel', null, 'formsendemail');
            switch ($layout) {
                case '_formsendemail':
                    break;
            }
            zemesincluder::display($layout , 'sendemail');
        }
    }

    function sendmail() {
        $data = zemesrequest::get('post');
        $result = zemesincluder::getObject('sendemail')->sendMail($data);
        $msg = zemesMessages::getMessage($result,'sendemail');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=sendemail&zemel=formsendemail");
        wp_redirect($url);
        exit;
    }
}
$jjeszemSendemailhand = new zemesSendemailHandler();
?>