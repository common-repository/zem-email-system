<?php

if (!defined('ABSPATH')) die('Access Denied');

class zemesEmailaddressHandler{

    function __construct() {
        self::init();
    }

    function init() {
        if (zemesrequest::canaddview()) {
            $layout = zemesrequest::getLayout('zemel', null, 'emailaddresses');
            switch ($layout) {
                case '_emailaddresses':
                    zemesincluder::getObject('emailaddress')->getAllEmailaddress();
                    break;
                case '_formemailaddress':
                    $id = zemesrequest::getVar('zemesid');
                    zemesincluder::getObject('emailaddress')->getEmailaddressById($id);
                    break;
            }
            zemesincluder::display($layout , 'emailaddress');
        }
    }


    function save() {
        $data = zemesrequest::get('post');
        $result = zemesincluder::getObject('emailaddress')->storeEmailaddress($data);
        $msg = zemesMessages::getMessage($result,'emailaddress');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=emailaddress&zemel=emailaddresses");
        wp_redirect($url);
        exit;
    }

    function remove() {
        $id = zemesrequest::getVar('zemesid');
        $result = zemesincluder::getObject('emailaddress')->deleteEmailaddress($id);
        $msg = zemesMessages::getMessage($result,'emailaddress');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=emailaddress&zemel=emailaddresses");
        wp_redirect($url);
        exit;
    }

    function publish() {
        $pagenum = zemesrequest::getVar('pagenum');
        $id = zemesrequest::getVar('zemesid');
        $result = zemesincluder::getObject('emailaddress')->publishUnpublish($id,1);
        $msg = zemesMessages::getMessage($result,'emailaddress');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=emailaddress&zemel=emailaddresses");
        if($pagenum)
            $url .= "&pagenum=".$pagenum;
        wp_redirect($url);
        exit;
    }

    function unpublish() {
        $pagenum = zemesrequest::getVar('pagenum');
        $id = zemesrequest::getVar('zemesid');
        $result = zemesincluder::getObject('emailaddress')->publishUnpublish($id,0);
        $msg = zemesMessages::getMessage($result,'emailaddress');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=emailaddress&zemel=emailaddresses");
        if($pagenum)
            $url .= "&pagenum=".$pagenum;
        wp_redirect($url);
        exit;
    }
}
$jjeszemEmailaddresshand = new zemesEmailaddressHandler();
?>
