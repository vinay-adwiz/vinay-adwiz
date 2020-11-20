<?php

if (validation_errors()) :
?>
<div class='alert alert-block alert-error fade in'>
    <a class='close' data-dismiss='alert'>&times;</a>
    <h4 class='alert-heading'>
        <?php echo lang('resumes_errors_message'); ?>
    </h4>
    <?php echo validation_errors(); ?>
</div>
<?php
endif;

$id = isset($resumes->id) ? $resumes->id : '';

?>
<div class='admin-box'>
    <h3>resumes</h3>
    <?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
        <fieldset>
            

            <div class="control-group<?php echo form_error('user_id') ? ' error' : ''; ?>">
                <?php echo form_label(lang('resumes_field_user_id') . lang('bf_form_label_required'), 'user_id', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='user_id' type='text' required='required' name='user_id'  value="<?php echo set_value('user_id', isset($resumes->user_id) ? $resumes->user_id : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('user_id'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('resume') ? ' error' : ''; ?>">
                <?php echo form_label(lang('resumes_field_resume') . lang('bf_form_label_required'), 'resume', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='resume' type='text' required='required' name='resume' maxlength='255' value="<?php echo set_value('resume', isset($resumes->resume) ? $resumes->resume : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('resume'); ?></span>
                </div>
            </div>
        </fieldset>
        <fieldset class='form-actions'>
            <input type='submit' name='save' class='btn btn-primary' value="<?php echo lang('resumes_action_create'); ?>" />
            <?php echo lang('bf_or'); ?>
            <?php echo anchor(SITE_AREA . '/reports/resumes', lang('resumes_cancel'), 'class="btn btn-warning"'); ?>
            
        </fieldset>
    <?php echo form_close(); ?>
</div>