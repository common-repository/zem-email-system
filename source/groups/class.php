<?php

if (!defined('ABSPATH')) die('Access Denied');

class zemesGroupsClass{

    function __construct() {}

    function getGroupById($id) {
        if(!is_numeric($id)) return false;
        $query = "SELECT * FROM ".zemesdb::$prefix."zememailsystem_groups WHERE id=".$id;
        zememailsystem::$items[0] = zemesdb::get_row($query);
        return;
    }

    function getAllGroups() {
        $name = zemesrequest::getVar('searchname');
        $inquery='';
        if ($name) {
            $inquery = " WHERE name LIKE '%$name%' ORDER BY name";
        }else{
            $inquery = " ORDER BY name";
        }
        zememailsystem::$items['filter']['searchname'] = $name;

        //pagination
        $query = "SELECT COUNT(id) FROM ".zemesdb::$prefix."zememailsystem_groups";
        $query .= $inquery;
        $total = zemesdb::get_var($query);
        zememailsystem::$pager['total'] = $total;
        zememailsystem::$pager['pagination'] = zememailsystem::getPagination($total);

        //data
        $query = "SELECT gr.* , (SELECT COUNT(addr.id) FROM ".zemesdb::$prefix."zememailsystem_emailaddress AS addr WHERE addr.groupid = gr.id) AS totaladdresses
                    FROM ".zemesdb::$prefix."zememailsystem_groups AS gr";
        $query .= $inquery;
        $query .= " LIMIT ".zememailsystem::$pager['offset']." , ".zememailsystem::$pager['limit'];
        zememailsystem::$items[0] = zemesdb::get_results($query);

        return;
    }

    function storeGroup($data) {
        if(empty($data)) return false;
        if($data['id']==''){
            $result = $this->isGroupExist($data['name']);
            if ($result == true){
                return ALREADY_EXIST;
            }
        }
        $row = zemesincluder::getTable('groups');
        if (!$row->bind($data)) {
            return SAVE_ERROR;
        }
        if (!$row->store()) {
            return SAVE_ERROR;
        }
        return SAVED;
    }

    function deleteGroup($id) {
        if(!is_numeric($id)) return false;
        $row = zemesincluder::getTable('groups');
        if ($this->groupCanDelete($id) == true) {
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
        $row = zemesincluder::getTable('groups');
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

    function groupCanDelete($id) {
        $query = "SELECT COUNT(eadd.id) FROM `".zemesdb::$prefix."zememailsystem_emailaddress` AS eadd
                    WHERE eadd.groupid = ".$id;
        $total = zemesdb::get_var($query);
        if ($total > 0)
            return false;
        else
            return true;
    }

    function isGroupExist($name) {
        $query = "SELECT COUNT(id) FROM ".zemesdb::$prefix."zememailsystem_groups WHERE name = '{$name}'";
        $result = zemesdb::get_var($query);
        if ($result > 0)
            return true;
        else
            return false;
    }

    function getGroupCombo() {
        $query = "SELECT id, name AS text FROM `".zemesdb::$prefix."zememailsystem_groups` WHERE status = 1";
        $query.= " ORDER BY text ASC";
        $rows = zemesdb::get_results($query);
        return $rows;
    }
}
?>