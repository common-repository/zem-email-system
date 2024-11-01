<?php

if (!defined('ABSPATH')) die('Access Denied');

class zemesSendemailClass{

    function __construct() {}

    function sendMail($data){
        if(empty($data))
            return SENT_ERROR;
        $groupid = $data['groupid'];
        $subject = $data['subject'];
        $body = $data['body'];
        if(!is_numeric($groupid))
            return SENT_ERROR;
        if(empty($subject))
            return SENT_ERROR;
        if(empty($body))
            return SENT_ERROR;

        $query = "SELECT eadd.emailaddress
            FROM ".zemesdb::$prefix."zememailsystem_emailaddress AS eadd WHERE eadd.status = 1 AND eadd.groupid = ".$groupid;
        
        $results = zemesdb::get_results($query);
        $emailaddress = array();
        foreach ($results as $obj) {
            $emailaddress[] = $obj->emailaddress;
        }

        $senderName = get_option('zemes_sender_name');
        $senderEmail = get_option('zemes_sender_email');


        $headers = 'From: ' . $senderName . ' <' . $senderEmail . '>' . "\r\n";
        add_filter('wp_mail_content_type', create_function('', 'return "text/html"; '));
        $body = preg_replace('/\r?\n|\r/', '<br/>', $body);
        $body = str_replace(array("\r\n", "\r", "\n"), "<br/>", $body);
        $body = nl2br($body);

        $result = wp_mail( $emailaddress, $subject, $body, $headers );
        if($result)
            return SENT;
        return SENT_ERROR;
    }
}
?>
