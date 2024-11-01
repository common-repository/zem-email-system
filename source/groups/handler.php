<?php

if (!defined('ABSPATH')) die('Access Denied');

class zemesGroupsHandler{

    function __construct() {
        self::init();
    }

    function init() {
        if (zemesrequest::canaddview()) {
            $layout = zemesrequest::getLayout('zemel', null, 'groups');
            switch ($layout) {
                case '_groups':
                    zemesincluder::getObject('groups')->getAllGroups();
                    break;
                case '_formgroup':
                    $id = zemesrequest::getVar('zemesid');
                    zemesincluder::getObject('groups')->getGroupById($id);
                    break;
            }
            zemesincluder::display($layout , 'groups');
        }
    }


    function save() {
        $data = zemesrequest::get('post');
        $result = zemesincluder::getObject('groups')->storeGroup($data);
        $msg = zemesMessages::getMessage($result,'groups');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=groups&zemel=groups");
        wp_redirect($url);
        exit;
    }

    function remove() {
        $id = zemesrequest::getVar('zemesid');
        $result = zemesincluder::getObject('groups')->deleteGroup($id);
        $msg = zemesMessages::getMessage($result,'groups');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=groups&zemel=groups");
        wp_redirect($url);
        exit;
    }

    function publish() {
        $pagenum = zemesrequest::getVar('pagenum');
        $id = zemesrequest::getVar('zemesid');
        $result = zemesincluder::getObject('groups')->publishUnpublish($id,1);
        $msg = zemesMessages::getMessage($result,'groups');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=groups&zemel=groups");
        if($pagenum)
            $url .= "&pagenum=".$pagenum;
        wp_redirect($url);
        exit;
    }

    function unpublish() {
        $pagenum = zemesrequest::getVar('pagenum');
        $id = zemesrequest::getVar('zemesid');
        $result = zemesincluder::getObject('groups')->publishUnpublish($id,0);
        $msg = zemesMessages::getMessage($result,'groups');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=groups&zemel=groups");
        if($pagenum)
            $url .= "&pagenum=".$pagenum;
        wp_redirect($url);
        exit;
    }
}
$jjeszemGroupshand = new zemesGroupsHandler();
?>