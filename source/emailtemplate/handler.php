<?php

if (!defined('ABSPATH')) die('Access Denied');

class zemesEmailTemplateHandler{

    function __construct() {
        self::init();
    }

    function init() {
        if (zemesrequest::canaddview()) {
            $layout = zemesrequest::getLayout('zemel', null, 'emailtemplates');
            switch ($layout) {
                case '_emailtemplates':
                    zemesincluder::getObject('emailtemplate')->getAllEmailtemplates();
                    break;
                case '_formemailtemplate':
                    $id = zemesrequest::getVar('zemesid');
                    zemesincluder::getObject('emailtemplate')->getEmailtemplateById($id);
                    break;
            }
            zemesincluder::display($layout , 'emailtemplate');
        }
    }

    function save() {
        $data = zemesrequest::get('post');
        $result = zemesincluder::getObject('emailtemplate')->storeEmailTemplate($data);
        $msg = zemesMessages::getMessage($result,'emailtemplate');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=emailtemplate&zemel=emailtemplates");
        wp_redirect($url);
        exit;
    }
    function remove() {
        $id = zemesrequest::getVar('zemesid');
        $result = zemesincluder::getObject('emailtemplate')->deleteEmailtemplate($id);
        $msg = zemesMessages::getMessage($result,'emailtemplate');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=emailtemplate&zemel=emailtemplates");
        wp_redirect($url);
        exit;
    }

    function publish() {
        $pagenum = zemesrequest::getVar('pagenum');
        $id = zemesrequest::getVar('zemesid');
        $result = zemesincluder::getObject('emailtemplate')->publishUnpublish($id,1);
        $msg = zemesMessages::getMessage($result,'emailtemplate');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=emailtemplate&zemel=emailtemplates");
        if($pagenum)
            $url .= "&pagenum=".$pagenum;
        wp_redirect($url);
        exit;
    }

    function unpublish() {
        $pagenum = zemesrequest::getVar('pagenum');
        $id = zemesrequest::getVar('zemesid');
        $result = zemesincluder::getObject('emailtemplate')->publishUnpublish($id,0);
        $msg = zemesMessages::getMessage($result,'emailtemplate');
        zemesMessages::setLayoutMessage( $msg['message'], $msg['status']);
        $url = admin_url("admin.php?page=emailtemplate&zemel=emailtemplates");
        if($pagenum)
            $url .= "&pagenum=".$pagenum;
        wp_redirect($url);
        exit;
    }
}
$jjeszemEmailTemplatehand = new zemesemailTEmplateHandler();
?>