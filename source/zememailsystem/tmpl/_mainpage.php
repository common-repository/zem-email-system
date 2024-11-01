<div id="jjes-main-area">
    <div class="es-admin-title"><?php echo __('Zem Email System','zem_emailsystem');?></div>
    <div class="jjes-fill-line"><?php echo __('Controlpanel','zem_emailsystem');?></div>
    <div class="col-xs-4 col-md-3"><a class="color1 main-cp-menus" href="<?php echo admin_url('admin.php?page=groups');?>"><?php echo __('Groups','zem_emailsystem'); ?><span class="arrow-right"> </span> </a></div>
    <div class="col-xs-4 col-md-3"><a class="color2 main-cp-menus" href="<?php echo admin_url('admin.php?page=emailaddress');?>"><?php echo __('Email addresses','zem_emailsystem'); ?><span class="arrow-right"> </span> </a></div>
    <div class="col-xs-4 col-md-3"><a class="color3 main-cp-menus" href="<?php echo admin_url('admin.php?page=emailtemplate');?>"><?php echo __('Emailtemplates','zem_emailsystem'); ?><span class="arrow-right"> </span> </a></div>
    <div class="col-xs-4 col-md-3"><a class="color4 main-cp-menus" href="<?php echo admin_url('admin.php?page=sendemail');?>"><?php echo __('Send email','zem_emailsystem'); ?><span class="arrow-right"> </span> </a></div>
    <div class="jjes-fill-line"><?php echo __('Quick settings','zem_emailsystem');?></div>
    <?php 

        $zemessendername = get_option('zemes_sender_name');
        $zemessenderemail = get_option('zemes_sender_email');
        $zemespsize = get_option('zemes_p_size');

    ?>

<!--         <div class="zem-alert-box zem-error"><span>error: </span>Write your error message here.</div>
        <div class="zem-alert-box zem-success"><span>success: </span>Write your success message here.</div>
        <div class="zem-alert-box zem-warning"><span>warning: </span>Write your warning message here.</div>
        <div class="zem-alert-box zem-notice"><span>notice: </span>Write your notice message here.</div>        
 -->    

    <div id="result">
    </div>

    <form action="" id="zemesquickform">
        <div class="jjes-field-wrapper">
            <div class="col-xs-4 col-md-4 jjestitle"><?php echo __('Sender name','zem_emailsystem'); ?><font class="jjes-required">*</font></div>
            <div class="col-xs-8 col-md-8 jjesvalue"><?php echo zemeshtml::text('sendername', $zemessendername, array('class' => 'inputbox', 'data-validation' => 'required')) ?></div>
        </div>
        <div class="jjes-field-wrapper">
            <div class="col-xs-4 col-md-4 jjestitle"><?php echo __('Sender emailaddress','zem_emailsystem'); ?><font class="jjes-required">*</font></div>
            <div class="col-xs-8 col-md-8 jjesvalue"><?php echo zemeshtml::text('senderemailaddress', $zemessenderemail, array('class' => 'inputbox', 'data-validation' => 'required')) ?></div>
        </div>    
        <div class="jjes-field-wrapper">
            <div class="col-xs-4 col-md-4 jjestitle"><?php echo __('Number of records show per page','zem_emailsystem'); ?><font class="jjes-required">*</font></div>
            <div class="col-xs-8 col-md-8 jjesvalue"><?php echo zemeshtml::text('psize', $zemespsize, array('class' => 'inputbox', 'data-validation' => 'required')) ?></div>
        </div>    
        <div class="jjes-button-wrapper">
            <?php echo zemeshtml::submit('saveoption', __('Save options','zem_emailsystem'), array('class' => 'button')); ?>
        </div>
    </form>
</div>
<script type="text/javascript">
    jQuery(document).ready(function($){
        jQuery('#zemesquickform').submit(function(event){
            event.preventDefault();
            var sname = jQuery('#sendername').val();
            var semail = jQuery('#senderemailaddress').val();
            var psize = jQuery('#psize').val();
            $.post( '<?php echo admin_url('admin-ajax.php'); ?>' , { action: 'zemes_ajax' , zemod: 'settings', task: 'setQuickSettingsAjax', sendername : sname, senderemail : semail, psize : psize},
            function(data){
                if(data == 'ok'){
                    jQuery('#result').html('');
                    jQuery('#result').css('display','inline-block');
                    jQuery('div#result').html('<div class="zem-alert-box zem-success"><span>success: </span>Settings has been saved sucessfully.</div>');
                    setTimeout(function(){ 
                        jQuery('#result').fadeOut();

                    }, 3000);
                }
            });
        });
    });
</script>