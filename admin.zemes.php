<?php

if (!defined('ABSPATH')) die('Access Denied');

class zememailsystemadmin {

    function __construct() {
        add_action('admin_menu', array($this, 'zemadminmenu'));
    }

    function zemadminmenu() {
        add_menu_page(__('Zem Email System Control Panel', 'zem_emailsystem'),
                __('Zem Email System', 'zem_emailsystem'),
                'manage_options',
                'zememailsystem',
                array($this, 'kickAdminPage'),
                ''
        );
        add_submenu_page('zememailsystem_hide',
                __('ZEM Configuration', 'zem_emailsystem'),
                __('Settings', 'zem_emailsystem'),
                'manage_options',
                'settings',
                array($this, 'kickAdminPage') 
        );
        add_submenu_page('zememailsystem',
                __('ZEM Groups', 'zem_emailsystem'),
                __('Groups', 'zem_emailsystem'),
                'manage_options',
                'groups',
                array($this, 'kickAdminPage') 
        );
        add_submenu_page('zememailsystem',
                __('ZEM Email Addresses', 'zem_emailsystem'),
                __('Email Addresses', 'zem_emailsystem'),
                'manage_options',
                'emailaddress',
                array($this, 'kickAdminPage') 
        );
        add_submenu_page('zememailsystem',
                __('ZEM Email Template', 'zem_emailsystem'),
                __('Email Templates', 'zem_emailsystem'),
                'manage_options',
                'emailtemplate',
                array($this, 'kickAdminPage') 
        );
        add_submenu_page('zememailsystem',
                __('ZEM Send Email', 'zem_emailsystem'),
                __('Send Email', 'zem_emailsystem'),
                'manage_options',
                'sendemail',
                array($this, 'kickAdminPage') 
        );
    }

    function kickAdminPage() {
        zememailsystem::addStyleSheets();
        $page = zemesrequest::getVar('page');
        zemesincluder::includeFile($page);
    }
}
$zememailsystemadmin = new zememailsystemadmin();

?>
