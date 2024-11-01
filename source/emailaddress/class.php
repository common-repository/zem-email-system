<?php

if (!defined('ABSPATH')) die('Access Denied');

class zemesEmailaddressClass{

    function __construct() {}

    function getEmailaddressById($id) {
        if(!is_numeric($id)) return false;
        $query = "SELECT * FROM ".zemesdb::$prefix."zememailsystem_emailaddress WHERE id = ".$id;
        zememailsystem::$items[0] = zemesdb::get_row($query);
        return;
    }

    function getAllEmailaddress() {
        $emailaddress = zemesrequest::getVar('searchemailaddress');
        $inquery='';
        if ($emailaddress) {
            $inquery = " WHERE emailaddress LIKE '%$emailaddress%' ORDER BY emailaddress";
        }else{
            $inquery = " ORDER BY emailaddress";
        }
        zememailsystem::$items['filter']['searchemailaddress'] = $emailaddress;

        //pagination
        $query = "SELECT COUNT(id) FROM ".zemesdb::$prefix."zememailsystem_emailaddress";
        $query .= $inquery;
        $total = zemesdb::get_var($query);
        zememailsystem::$pager['total'] = $total;
        zememailsystem::$pager['pagination'] = zememailsystem::getPagination($total);

        //data
        $query = "SELECT eadd.* ,gr.name AS groupname
            FROM ".zemesdb::$prefix."zememailsystem_emailaddress AS eadd
            JOIN ".zemesdb::$prefix."zememailsystem_groups AS gr ON gr.id = eadd.groupid
            ";

        $query .= $inquery;
        $query .= " LIMIT ".zememailsystem::$pager['offset']." , ".zememailsystem::$pager['limit'];
        zememailsystem::$items[0] = zemesdb::get_results($query);

        return;
    }

    function storeEmailaddress($data) {
        if(empty($data)) return false;
        if($data['id']==''){
            $result = $this->isEmailaddressExist($data['emailaddress']);
            if ($result == true){
                return ALREADY_EXIST;
            }
        }
        $row = zemesincluder::getTable('emailaddress');
        if (!$row->bind($data)) {
            return SAVE_ERROR;
        }
        if (!$row->store()) {
            return SAVE_ERROR;
        }
        return SAVED;
    }

    function deleteEmailaddress($id) {
        if(!is_numeric($id)) return false;
        $row = zemesincluder::getTable('emailaddress');
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
        $row = zemesincluder::getTable('emailaddress');
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

    function isEmailaddressExist($emailaddress) {
        $query = "SELECT COUNT(id) FROM ".zemesdb::$prefix."zememailsystem_emailaddress WHERE emailaddress = '{$emailaddress}'";
        $result = zemesdb::get_var($query);
        if ($result > 0)
            return true;
        else
            return false;
    }

    function getEmailaddressCombo() {
        $query = "SELECT id, emailaddress AS text FROM `".zemesdb::$prefix."zememailsystem_emailaddress` WHERE status = 1";
        $query.= " ORDER BY emailaddress ";
        $rows = zemesdb::get_results($query);
        return $rows;
    }
}
?>