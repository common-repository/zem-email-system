<script type="text/javascript">
    jQuery(document).ready(function ($) {
        //$.validate();
    });
</script>
<?php
    zemesMessages::getLayoutMessage();
?>
<div id="jjes-main-area">
    <div class="es-admin-title"><?php echo __('Send Email','zem_emailsystem');?></div>
    <div class="jjes-content-area">
        <form id="jjes-saveform" method="post" action="<?php echo admin_url("admin.php?page=sendemail&task=sendmail"); ?>">
            <div class="jjes-field-wrapper">
                <div class="col-xs-4 col-md-3 jjes-title"><?php echo __('Select Email Template'); ?><font class="jjes-required">*</font></div>
                <div class="col-xs-8 col-md-9 jjes-value"><?php echo zemeshtml::select('emailtemplateid', zemesincluder::getObject('emailtemplate')->getEmailtemplateCombo() , isset(zememailsystem::$items[0]->emailtemplateid) ? zememailsystem::$items[0]->emailtemplateid : '', __('Select template','zem_emailsystem') ,array('class' => 'inputbox select', 'data-validation' => 'required' , '')) ?></div>
            </div>
            <div class="jjes-field-wrapper">
                <div class="col-xs-4 col-md-3 jjes-title"><?php echo __('Subject','zem_emailsystem'); ?><font class="jjes-required">*</font></div>
                <div class="col-xs-8 col-md-9 jjes-value"><?php echo zemeshtml::text('subject', isset(zememailsystem::$items[0]->subject) ? zememailsystem::$items[0]->subject : '', array('class' => 'inputbox', 'data-validation' => 'required')) ?></div>
            </div>
            <div class="jjes-field-wrapper">
                <div class="col-xs-4 col-md-3 jjes-title"><?php echo __('Body','zem_emailsystem'); ?><font class="jjes-required">*</font></div>
                <div class="col-xs-8 col-md-9 jjes-value"><?php echo wp_editor( isset(zememailsystem::$items[0]->body) ? zememailsystem::$items[0]->body : '' , 'body', array('media_buttons' => false) ) ?></div>
            </div>
            <div class="jjes-field-wrapper">
                <div class="col-xs-4 col-md-3 jjes-title"><?php echo __('Email to group'); ?><font class="jjes-required">*</font></div>
                <div class="col-xs-8 col-md-9 jjes-value"><?php echo zemeshtml::select('groupid', zemesincluder::getObject('groups')->getGroupCombo() , isset(zememailsystem::$items[0]->groupid) ? zememailsystem::$items[0]->groupid : '', __('Select group','zem_emailsystem') ,array('class' => 'inputbox select', 'data-validation' => 'required')) ?></div>
            </div>
            <?php echo zemeshtml::hidden('formrequest', 'zemesform'); ?>
            <div class="jjes-submit-wrapper">
                <?php echo zemeshtml::submit('save', __('Send email','zem_emailsystem'), array('class' => 'button')); ?>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    jQuery(document).ready(function($){
        jQuery('#emailtemplateid').change(function(){
            var id = $(this).find(":selected").val();
            if(id){
                $.post( '<?php echo admin_url('admin-ajax.php'); ?>' , { action: 'zemes_ajax' , zemod: 'emailtemplate', task: 'getTemplateForAjax' , templateid: id },
                function(data){
                    data = jQuery.parseJSON(data);
                    jQuery('#subject').val(data.subject);
                    tinyMCE.activeEditor.setContent(data.body);
                });
            }
        });
    });
</script>
