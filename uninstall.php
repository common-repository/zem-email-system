<?php

if( ! defined('WP_UNINSTALL_PLUGIN'))
	exit();

global $wpdb;
$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}zememailsystem_settings" );
$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}zememailsystem_emailaddress" );
$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}zememailsystem_emailtemplates" );
$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}zememailsystem_groups" );