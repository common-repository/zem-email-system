<?php

if (!defined('ABSPATH')) die('Access Denied');

class zemeszememailsystemHandler{

    function __construct() {
        self::init();
    }

    function init() {
        if (zemesrequest::canaddview()) {
            $layout = zemesrequest::getLayout('zemel', null, 'mainpage');
            switch ($layout) {
                case '_mainpage':
                    //zemesincluder::getObject('zememailsystem')->getAllzememailsystem();
                    break;
            }
            zemesincluder::display($layout , 'zememailsystem');
        }
    }
}
$jjeszemzememailsystemhand = new zemeszememailsystemHandler();
?>