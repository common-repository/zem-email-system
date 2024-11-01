<?php
if (!defined('ABSPATH')) die('Access Denied');

class zemesincluder {

    public static function getHandler($name) {
        include_once ZEMES_PLUGIN_DIR.'source/'.$name.'/handler.php';
        $classname = 'zemes'.$name .'handler';
        $obj = new $classname();
        return $obj;
    }

    public static function getObject($name) {
        include_once ZEMES_PLUGIN_DIR.'source/' . $name . '/class.php';
        $classname = 'zemes' . $name . 'class';
        $obj = new $classname();
        return $obj;
    }

    public static function getTable($name) {
        require_once ZEMES_PLUGIN_DIR . '_resource/classes/tables/ztable.php';
        include_once ZEMES_PLUGIN_DIR . '_resource/classes/tables/'.$name.'.php';
        $classname = 'zemes' . $name . 'zTable';
        $obj = new $classname();
        return $obj;
    }

    static function includeFile($filename, $module_name = null) {
        if ($module_name != null) {
            include_once ZEMES_PLUGIN_DIR.'source/'.$module_name.'/tmpl/'.$filename.'.php';
        } else {
            include_once ZEMES_PLUGIN_DIR.'source/'.$filename.'/handler.php';
        }
        return;
    }

    static function display($layout, $default_module='') {
        $module = (is_admin()) ? 'page' : 'zemod';
        $module = zemesrequest::getVar($module, null, $default_module);
        self::includeFile($layout, $module);
    }

}
?>