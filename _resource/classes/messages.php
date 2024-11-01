<?php
if (!defined('ABSPATH')) die('Access Denied');

class zemesMessages{

    public static function setLayoutMessage($message, $type) {
        $_SESSION['n_msg'] = $message;
        $_SESSION['n_type'] = $type;
    }

    public static function getLayoutMessage() {
        $message = '';
        if (isset($_SESSION['n_msg']) && isset($_SESSION['n_type'])) {
            $message = '<div class="' . $_SESSION['n_type'] . '"><p>' . $_SESSION['n_msg'] . '</p></div>';
        }
        echo $message;
        unset($_SESSION['n_msg']);
        unset($_SESSION['n_type']);
    }

    public static function getMessage($result, $entity_name){

        $final_message['message'] = '';
        $final_message['status'] = "updated";

        $entity_name = self::makeEntityName($entity_name);

        switch ($result) {
            case 'saved':
                $message2 = __('has been sucessfully saved','zem_emailsystem');
                if ($entity_name)
                    $final_message['message'] = $entity_name . ' ' . $message2;
            break;
            case 'save_error':
                $final_message['status'] = "error";
                $message2 = __('has not been saved','zem_emailsystem');
                if ($entity_name)
                    $final_message['message'] = $entity_name . ' ' . $message2;
            break;
            case 'deleted':
                $message2 = __('has been sucessfully deleted','zem_emailsystem');
                if ($entity_name)
                    $final_message['message'] = $entity_name . ' ' . $message2;
            break;
            case 'delete_error':
                $final_message['status'] = "error";
                $message2 = __('has not been deleted','zem_emailsystem');
                if ($entity_name){
                    $final_message['message'] = $entity_name . ' ' . $message2;
                }
            break;
            case 'published':
                $final_message['message'] = __('Record published sucessfully','zem_emailsystem');
            break;
            case 'publish_error':
                $final_message['status'] = "error";
                $final_message['message'] = zemesMessages::$counter.' '.__('Record has not been published','zem_emailsystem');
            break;
            case 'un_published':
                $final_message['message'] = __('Record unpublished sucessfully','zem_emailsystem');
            break;
            case 'un_publish_error':
                $final_message['status'] = "error";
                $final_message['message'] = zemesMessages::$counter.' '.__('Record has not been unpublished','zem_emailsystem');
            break;
            case 'in_use':
                $final_message['status'] = "error";
                $message2 = __('in use cannot deleted','zem_emailsystem');
                if ($entity_name)
                    $final_message['message'] = $entity_name . ' ' . $message2;
            break;
            case 'already_exist':
                $final_message['status'] = "error";
                $message2 = __('already exist','zem_emailsystem');
                if ($entity_name)
                    $final_message['message'] = $entity_name . ' ' . $message2;
                break;
            case 'sent':
                $message2 = __('Email').'(n) '.__ ('Sent sucessfully','zem_emailsystem');
                $final_message['message'] = $message2;
                break;
            case 'sent_error':
                $final_message['status'] = "error";
                $message2 = __('Email').'(n) '.__ ('not Sent sucessfully','zem_emailsystem');
                $final_message['message'] = $message2;
            break;
        }

        return $final_message;
    }

    static function makeEntityName($entity_name){
        switch ($entity_name) {
            case 'groups':
                $name = __('Group','zem_emailsystem');
                break;
            case 'emailaddress':
                $name = __('Email address','zem_emailsystem');
                break;
            case 'emailtemplate':
                $name = __('Email template','zem_emailsystem');
                break;
            case 'sendemail':
                $name = __('Email','zem_emailsystem');
                break;
            default:
                $name = __('Unknown','zem_emailsystem');
                break;
        }
        return $name;
    }
}
?>
