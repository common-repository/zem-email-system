<?php

if (!defined('ABSPATH')) die('Access Denied');

class zememailsystemactivation {

    static function zememailsystem_activate() {
        self::zem_activate();
    }

    private static function zem_activate(){
        $query = "CREATE TABLE IF NOT EXISTS `".zemesdb::$prefix."zememailsystem_settings` (
				  `settingname` varchar(60) NOT NULL,
				  `settingvalue` varchar(260) NOT NULL
				) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
        	zemesdb::query($query);

        $runConfig = zemesdb::get_var("SELECT COUNT(settingname) FROM `" . zemesdb::$prefix."zememailsystem_settings`");
        if ($runConfig == 0) {

        	$query = "CREATE TABLE IF NOT EXISTS `".zemesdb::$prefix."zememailsystem_emailaddress` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `emailaddress` varchar(100) NOT NULL,
			  `groupid` int(11) NOT NULL,
			  `status` tinyint(1) NOT NULL,
			  `created` datetime DEFAULT NULL,
			  PRIMARY KEY (`id`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
            zemesdb::query($query);

            $query = "CREATE TABLE IF NOT EXISTS `".zemesdb::$prefix."zememailsystem_emailtemplates` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `title` varchar(300) NOT NULL,
			  `subject` varchar(255) DEFAULT NULL,
			  `body` text,
			  `status` tinyint(1) DEFAULT NULL,
			  `created` datetime DEFAULT NULL,
			  PRIMARY KEY (`id`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;";
            zemesdb::query($query);

            $query = "INSERT INTO `".zemesdb::$prefix."zememailsystem_emailtemplates` (`id`, `title`, `subject`, `body`, `status`, `created`) VALUES
			(1, 'Sample email template', 'Sample email template subject', '<h3><span style=\"color: #ff0000;\">Sample message body,</span></h3>\r\n<span style=\"color: #000000;\">This is an really sample email template body your can choose your message body which ever you want,This is an really sample email template body your can choose your message body which ever you want,</span>\r\n\r\n<strong><span style=\"text-decoration: underline;\"><span style=\"color: #3366ff;\"></span></span></strong>\r\n<ul>\r\n	<li><span style=\"color: #ff0000;\"><strong>One </strong></span></li>\r\n	<li><span style=\"color: #ff0000;\"><strong>Two </strong></span></li>\r\n	<li><span style=\"color: #ff0000;\"><strong>Three</strong></span></li>\r\n</ul>\r\n<h1 style=\"text-align: center;\"><span style=\"color: #000000;\">Because this is an sample email body</span></h1>\r\n\r\n<hr />\r\n\r\n<blockquote>This is qoutes\r\n<p style=\"text-align: right;\">text align right</p>\r\n<p style=\"text-align: left;\">Me in left side</p>\r\n<p style=\"text-align: center;\">And this is centered with some <span style=\"color: #0000ff;\"><strong>bold</strong></span> , <span style=\"color: #0000ff;\"><em>italic</em></span>, words</p>\r\n\r\n\r\n<hr />\r\n<p style=\"text-align: center;\"></p>\r\n</blockquote>\r\n<div style=\"margin-top: 10px; padding: 12px 15px; color: #555555; background: #ffecec; border: 1px solid #f5aca6;\">\r\n\r\n<span style=\"color: red;\"><strong>DO NOT REPLY TO THIS E-MAIL</strong></span>\r\n\r\nThis is an automated e-mail message sent from our XYZ. Do not reply to this e-mail.\r\n\r\n</div>', 1, '2016-05-19 17:31:14');";
            zemesdb::query($query);

			$query = "CREATE TABLE IF NOT EXISTS `".zemesdb::$prefix."zememailsystem_groups` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `name` varchar(150) NOT NULL,
			  `status` tinyint(1) NOT NULL,
			  `created` datetime NOT NULL,
			  PRIMARY KEY (`id`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=5;";
            zemesdb::query($query);

			$query = "INSERT INTO `".zemesdb::$prefix."zememailsystem_groups` (`id`, `name`, `status`, `created`) VALUES
				(1, 'Friends', 1, '2016-05-19 17:29:42'),
				(2, 'Family', 1, '2016-05-19 17:29:55'),
				(3, 'Business', 1, '2016-05-19 17:30:05'),
				(4, 'Office', 0, '2016-05-19 17:30:21');";
            zemesdb::query($query);

			$query = "INSERT INTO `".zemesdb::$prefix."zememailsystem_settings` (`settingname`, `settingvalue`) VALUES
				('zem_solutions_url','www.zemsolutions.com')";
            zemesdb::query($query);

        }
    }
}
?>