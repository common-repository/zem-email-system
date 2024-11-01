<?php
if (!defined('ABSPATH')) die('Access Denied');

class zememailsystem{

	public static $items;
    public static $settings;
    public static $pager;

    function __construct() {
        self::include_classes();
        self::$items = array();
        self::get_options();
    }

    static function zem_emailsystem_hooks(){
        add_action("wp_ajax_zemes_ajax", array( 'zememailsystem' , "ajaxresponce"));
        add_action("wp_ajax_nopriv_zemes_ajax", array( 'zememailsystem' , "ajaxresponce"));
        self::handleifformrequest();
        self::handleifdeleterequest();
    }

    static function ajaxresponce() {
        $module = zemesrequest::getVar('zemod');
        $task = zemesrequest::getVar('task');
        $result = zemesincluder::getObject($module)->$task();
        echo $result;
        exit(0);
    }

    private static function handleifformrequest() {
        
        $formrequest = zemesrequest::getVar('formrequest', 'post');
        if ($formrequest == 'zemesform') {
            $modulename = (is_admin()) ? 'page' : 'zemod';
            $module = zemesrequest::getVar($modulename);
            zemesincluder::includeFile($module);
            $class = 'zemes' . $module . "Handler";
            $task = zemesrequest::getVar('task');
            $obj = new $class;
            $obj->$task();
        }
    }

    private static function handleifdeleterequest() {
        $action = zemesrequest::getVar('action', 'get');
        if ($action == 'zemesaction') {
            $modulename = (is_admin()) ? 'page' : 'zemod';
            $module = zemesrequest::getVar($modulename);
            zemesincluder::includeFile($module);
            $class = 'zemes' . $module . "Handler";
            $action = zemesrequest::getVar('task');
            $obj = new $class;
            $obj->$action();
        }
    }

    function include_classes() {
        require_once 'admin.zemes.php';
        require_once '_resource/classes/includer.php';
        require_once '_resource/classes/formfield.php';
        require_once '_resource/classes/request.php';
        require_once '_resource/classes/zemesdb.php';
        require_once '_resource/classes/constants.php';
        require_once '_resource/classes/messages.php';
        require_once '_resource/classes/layout.php';
    }

    private static function get_options(){
        zemesincluder::getObject('settings')->getZeminitSettings();
    }

    static function getPagination($total) {
        $pagenum = isset($_GET['pagenum']) ? absint($_GET['pagenum']) : 1;
        self::$pager['limit'] =  self::$settings['pagination_default_size'];
        self::$pager['offset'] = ( $pagenum - 1 ) * self::$pager['limit'];
        $num_of_pages = ceil($total / self::$pager['limit']);
        $result = paginate_links(array(
            'base' => add_query_arg('pagenum', '%#%'),
            'format' => '',
            'prev_next' => true,
            'prev_text' => __('Previous', 'zem_emailsystem'),
            'next_text' => __('Next', 'zem_emailsystem'),
            'total' => $num_of_pages,
            'current' => $pagenum,
            'add_args' => false,
        ));
        return $result;
    }
    
    static function zem_emailsystem_activate() {
        include_once '_resource/classes/activation.php';
        zememailsystemactivation::zememailsystem_activate();
    }

    function ajaxhandler() {
        $module = zemesrequest::getVar('zemod');
        $task = zemesrequest::getVar('task');
        $result = zemesincluder::getObject($module)->$task();
        echo $result;
        exit;
    }

    static function zem_emailsystem_deactivate() {
        include_once '_resource/classes/deactivation.php';
        zememailsystemdeactivation::zememailsystem_deactivate();
    }

    static function addStyleSheets() {
        wp_enqueue_style('jjeasyemail-bootstrap', ZEMES_PLUGIN_URL . '_resource/styles/bootstrap.min.css');
        wp_enqueue_style('jjeasyemail-admincss',ZEMES_PLUGIN_URL . '_resource/styles/admin.css');
        wp_enqueue_style('jjeasyemail-fawesomemin',ZEMES_PLUGIN_URL . '_resource/styles/font-awesome-4.6.3/css/font-awesome.min.css');
    }
}

$zememailsystemobj = new zememailsystem();

?>