<?php

if (!defined('ABSPATH')) die('Access Denied');

class zemesEmailTemplateClass{

    function __construct() {}

    function getEmailtemplateById($id) {
        if(!is_numeric($id)) return false;
        $query = "SELECT * FROM ".zemesdb::$prefix."zememailsystem_emailtemplates WHERE id=".$id;
        zememailsystem::$items[0] = zemesdb::get_row($query);
        return;
    }

    function getAllEmailtemplates() {
        $title = zemesrequest::getVar('searchtitle');
        $inquery='';
        if ($title) {
            $inquery = " WHERE title LIKE '%$title%' ORDER BY title";
        }else{
            $inquery = " ORDER BY title";
        }
        zememailsystem::$items['filter']['searchtitle'] = $title;

        //pagination
        $query = "SELECT COUNT(id) FROM ".zemesdb::$prefix."zememailsystem_emailtemplates";
        $query .= $inquery;
        $total = zemesdb::get_var($query);
        zememailsystem::$pager['total'] = $total;
        zememailsystem::$pager['pagination'] = zememailsystem::getPagination($total);

        //data
        $query = "SELECT et.id, et.title, et.status, et.created FROM ".zemesdb::$prefix."zememailsystem_emailtemplates AS et";
        $query .= $inquery;
        $query .= " LIMIT ".zememailsystem::$pager['offset']." , ".zememailsystem::$pager['limit'];
        zememailsystem::$items[0] = zemesdb::get_results($query);

        return;
    }

    function storeEmailTemplate($data) {
        if(empty($data)) return false;

        $data['body'] = stripcslashes($data['body']);
        $row = zemesincluder::getTable('emailtemplate');
        if (!$row->bind($data)) {
            return SAVE_ERROR;
        }
        if (!$row->store()) {
            return SAVE_ERROR;
        }
        return SAVED;
    }

    function deleteEmailtemplate($id) {
        if(!is_numeric($id)) return false;
        $row = zemesincluder::getTable('emailtemplate');
        if (true) {
            if (!$row->delete($id)) {
                return DELETE_ERROR;
            }
        }else{
            return IN_USE;
        }
        return DELETED;
    }

    function publishUnpublish($id , $status) {
        if(!is_numeric($status)) return false;
        $row = zemesincluder::getTable('emailtemplate');
        if($status==1){
            if($row->update(array('id' => $id, 'status' => 1))){
                return PUBLISHED;
            }else{
                return PUBLISH_ERROR;
            }
        }elseif($status==0){
            if($row->update(array('id' => $id, 'status' => 0))){
                return UN_PUBLISHED;
            }else{
                return UN_PUBLISH_ERROR;
            }
        }
    }

    function getEmailtemplateCombo() {
        $query = "SELECT id, title AS text FROM `".zemesdb::$prefix."zememailsystem_emailtemplates` WHERE status = 1";
        $query.= " ORDER BY text ASC";
        $rows = zemesdb::get_results($query);
        return $rows;
    }

    function getTemplateForAjax(){
        $templateid = zemesrequest::getVar('templateid');
        if( ! is_numeric($templateid))
            return false;
        $query = "SELECT et.subject, et.body FROM ".zemesdb::$prefix."zememailsystem_emailtemplates AS et
                    WHERE et.status = 1 AND et.id = ".$templateid;
        $result = zemesdb::get_row($query);
        if($result){
            return json_encode($result);
        }
        return '';
    }
}
?>