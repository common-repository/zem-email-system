<?php
if (!defined('ABSPATH')) die('Access Denied');

class zemesrequest {

    static function canAddView() {
        if (self::getVar('formrequest','post') == 'zemesform'){
            return false;
        }
        elseif (self::getVar('action','get') == 'zemesaction'){
            return false;
        }
        else{
            return true;
        }
    }

    static function getLayout($name, $method = null, $defaultvalue = null) {
        $layout = self::getVar($name, $method, $defaultvalue);
        if (is_admin()) {
            $layout = '_'.$layout;
        }
        return $layout;
    }

    static function getVar($name, $method = null, $defaultvalue = null) {
        $value = null;
        if ($method == null) {
            if (isset($_GET[$name])) {
                $value = $_GET[$name];
            } elseif (isset($_POST[$name])) {
                $value = $_POST[$name];
            } elseif (get_query_var($name)) {
                $value = get_query_var($name);
            }
        } else {
            $method = strtolower($method);
            switch ($method) {
                case 'post':
                    if (isset($_POST[$name]))
                        $value = $_POST[$name];
                    break;
                case 'get':
                    if (isset($_GET[$name]))
                        $value = $_GET[$name];
                    break;
            }
        }
        if ($value == null)
            $value = $defaultvalue;
        return $value;
    }

    static function get($method = null) {
        $array = null;
        if ($method != null) {
            $method = strtolower($method);
            switch ($method) {
                case 'post':
                    $array = $_POST;
                    break;
                case 'get':
                    $array = $_GET;
                    break;
            }
        }
        return $array;
    }

}
?>