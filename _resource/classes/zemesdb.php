<?php

if (!defined('ABSPATH')) die('Access Denied');

class zemesdb {

    public static $db;
    public static $prefix;

    static function init() {
        global $wpdb;
        self::$db = $wpdb;
        self::$prefix = $wpdb->prefix;
    }

    public static function get_var($query){
        $result = self::$db->get_var($query);
        return $result;
    }
    
    public static function get_row($query){
        $result = self::$db->get_row($query);
        return $result;
    }
    
    public static function get_results($query){
        $result = self::$db->get_results($query);
        return $result;
    }

    public static function query($query){
        $result = self::$db->query($query);
        return $result;
    }

    public static function insert($dataarray, $tablename){

        $result = self::$db->insert(self::$prefix .'zememailsystem_'.$tablename, $dataarray);
        if ($result) {
            return self::$db->insert_id;
        } else {

            return false;
        }
    }

    public static function update($dataarray, $tablename){// id is must to updates
        $where = array('id' => $dataarray['id']);
        unset($dataarray['id']);
        $result = self::$db->update( self::$prefix .'zememailsystem_'.$tablename , $dataarray, $where );
        if ($result === false) {
            return false;
        } else {
            return true;
        }
    }

    public static function delete($dataarray, $tablename){
        $result = self::$db->delete(self::$prefix .'zememailsystem_'.$tablename, $dataarray);
        if ($result === false) {

            return false;
        } else {
            return true;
        }
    }
}
zemesdb::init();
?>