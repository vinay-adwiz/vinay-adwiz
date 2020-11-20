<?php

if (validation_errors()) :
?>
<div class='alert alert-block alert-error fade in'>
    <a class='close' data-dismiss='alert'>&times;</a>
    <h4 class='alert-heading'>
        <?php echo lang('feedback_errors_message'); ?>
    </h4>
    <?php echo validation_errors(); ?>
</div>
<?php
endif;

$id = isset($feedback->id) ? $feedback->id : '';

?>
<div class='admin-box'>
    <h3>Feedback</h3>
    <?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
        <fieldset>
            

            <div class="control-group<?php echo form_error('user_id') ? ' error' : ''; ?>">
                <?php echo form_label(lang('feedback_field_user_id') . lang('bf_form_label_required'), 'user_id', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='user_id' type='text' required='required' name='user_id'  value="<?php echo set_value('user_id', isset($feedback->user_id) ? $feedback->user_id : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('user_id'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('provided_by') ? ' error' : ''; ?>">
                <?php echo form_label(lang('feedback_field_provided_by') . lang('bf_form_label_required'), 'provided_by', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='provided_by' type='text' required='required' name='provided_by'  value="<?php echo set_value('provided_by', isset($feedback->provided_by) ? $feedback->provided_by : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('provided_by'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('feedback_type') ? ' error' : ''; ?>">
                <?php echo form_label(lang('feedback_field_feedback_type') . lang('bf_form_label_required'), 'feedback_type', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='feedback_type' type='text' required='required' name='feedback_type'  value="<?php echo set_value('feedback_type', isset($feedback->feedback_type) ? $feedback->feedback_type : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('feedback_type'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('class_id') ? ' error' : ''; ?>">
                <?php echo form_label(lang('feedback_field_class_id'), 'class_id', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='class_id' type='text' name='class_id'  value="<?php echo set_value('class_id', isset($feedback->class_id) ? $feedback->class_id : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('class_id'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('rating') ? ' error' : ''; ?>">
                <?php echo form_label(lang('feedback_field_rating'), 'rating', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='rating' type='text' name='rating' maxlength='10' value="<?php echo set_value('rating', isset($feedback->rating) ? $feedback->rating : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('rating'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('feedback') ? ' error' : ''; ?>">
                <?php echo form_label(lang('feedback_field_feedback'), 'feedback', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='feedback' type='text' name='feedback'  value="<?php echo set_value('feedback', isset($feedback->feedback) ? $feedback->feedback : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('feedback'); ?></span>
                </div>
            </div>
        </fieldset>
        <fieldset class='form-actions'>
            <input type='submit' name='save' class='btn btn-primary' value="<?php echo lang('feedback_action_edit'); ?>" />
            <?php echo lang('bf_or'); ?>
            <?php echo anchor(SITE_AREA . '/reports/feedback', lang('feedback_cancel'), 'class="btn btn-warning"'); ?>
            
            <?php if ($this->auth->has_permission('Feedback.Reports.Delete')) : ?>
                <?php echo lang('bf_or'); ?>
                <button type='submit' name='delete' formnovalidate class='btn btn-danger' id='delete-me' onclick="return confirm('<?php e(js_escape(lang('feedback_delete_confirm'))); ?>');">
                    <span class='icon-trash icon-white'></span>&nbsp;<?php echo lang('feedback_delete_record'); ?>
                </button>
            <?php endif; ?>
        </fieldset>
    <?php echo form_close(); ?>
</div>