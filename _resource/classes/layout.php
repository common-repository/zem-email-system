<?php

if (!defined('ABSPATH')) die('Access Denied');

class zemeslayout{

    static function noRecordFound(){
        $msg = '<div id="jjes-error-message-wrapper">
                    <div class="jjes-error-icon">
                        <i class="zemerror"></i>
                    </div>
                    <div class="jjes-error-info">
                        <span class="jjes-error-info-det">
                        '.__('Ooops Empty records ....!').'
                        </span>
                    </div>
                </div>
        ';
        echo $msg;
    }
}
?>