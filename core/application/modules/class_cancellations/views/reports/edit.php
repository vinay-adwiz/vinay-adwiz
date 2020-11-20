<?php

if (validation_errors()) :
?>
<div class='alert alert-block alert-error fade in'>
    <a class='close' data-dismiss='alert'>&times;</a>
    <h4 class='alert-heading'>
        <?php echo lang('class_cancellations_errors_message'); ?>
    </h4>
    <?php echo validation_errors(); ?>
</div>
<?php
endif;

$id = isset($class_cancellations->id) ? $class_cancellations->id : '';

?>
<div class='admin-box'>
    <h3>Class Cancellations</h3>
    <?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
        <fieldset>
            

            <div class="control-group<?php echo form_error('class_id') ? ' error' : ''; ?>">
                <?php echo form_label(lang('class_cancellations_field_class_id') . lang('bf_form_label_required'), 'class_id', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='class_id' type='text' required='required' name='class_id'  value="<?php echo set_value('class_id', isset($class_cancellations->class_id) ? $class_cancellations->class_id : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('class_id'); ?></span>
                </div>
            </div>

            <?php // Change the values in this array to populate your dropdown as required
                $options = array(
                );
                echo form_dropdown(array('name' => 'cancelled_by', 'required' => 'required'), $options, set_value('cancelled_by', isset($class_cancellations->cancelled_by) ? $class_cancellations->cancelled_by : ''), lang('class_cancellations_field_cancelled_by') . lang('bf_form_label_required'));
            ?>

            <div class="control-group<?php echo form_error('cancellation_reason') ? ' error' : ''; ?>">
                <?php echo form_label(lang('class_cancellations_field_cancellation_reason') . lang('bf_form_label_required'), 'cancellation_reason', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='cancellation_reason' type='text' required='required' name='cancellation_reason'  value="<?php echo set_value('cancellation_reason', isset($class_cancellations->cancellation_reason) ? $class_cancellations->cancellation_reason : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('cancellation_reason'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('chargeable') ? ' error' : ''; ?>">
                <?php echo form_label(lang('class_cancellations_field_chargeable') . lang('bf_form_label_required'), 'chargeable', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='chargeable' type='text' required='required' name='chargeable'  value="<?php echo set_value('chargeable', isset($class_cancellations->chargeable) ? $class_cancellations->chargeable : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('chargeable'); ?></span>
                </div>
            </div>
        </fieldset>
        <fieldset class='form-actions'>
            <input type='submit' name='save' class='btn btn-primary' value="<?php echo lang('class_cancellations_action_edit'); ?>" />
            <?php echo lang('bf_or'); ?>
            <?php echo anchor(SITE_AREA . '/reports/class_cancellations', lang('class_cancellations_cancel'), 'class="btn btn-warning"'); ?>
            
            <?php if ($this->auth->has_permission('Class_Cancellations.Reports.Delete')) : ?>
                <?php echo lang('bf_or'); ?>
                <button type='submit' name='delete' formnovalidate class='btn btn-danger' id='delete-me' onclick="return confirm('<?php e(js_escape(lang('class_cancellations_delete_confirm'))); ?>');">
                    <span class='icon-trash icon-white'></span>&nbsp;<?php echo lang('class_cancellations_delete_record'); ?>
                </button>
            <?php endif; ?>
        </fieldset>
    <?php echo form_close(); ?>
</div>