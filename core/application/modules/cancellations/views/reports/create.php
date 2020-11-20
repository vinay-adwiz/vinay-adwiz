<?php

if (validation_errors()) :
?>
<div class='alert alert-block alert-error fade in'>
    <a class='close' data-dismiss='alert'>&times;</a>
    <h4 class='alert-heading'>
        <?php echo lang('cancellations_errors_message'); ?>
    </h4>
    <?php echo validation_errors(); ?>
</div>
<?php
endif;

$id = isset($cancellations->id) ? $cancellations->id : '';

?>
<div class='admin-box'>
    <h3>Cancellations</h3>
    <?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
        <fieldset>
            

            <div class="control-group<?php echo form_error('user_id') ? ' error' : ''; ?>">
                <?php echo form_label(lang('cancellations_field_user_id') . lang('bf_form_label_required'), 'user_id', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='user_id' type='text' required='required' name='user_id'  value="<?php echo set_value('user_id', isset($cancellations->user_id) ? $cancellations->user_id : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('user_id'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('cancellation_reason') ? ' error' : ''; ?>">
                <?php echo form_label(lang('cancellations_field_cancellation_reason') . lang('bf_form_label_required'), 'cancellation_reason', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='cancellation_reason' type='text' required='required' name='cancellation_reason'  value="<?php echo set_value('cancellation_reason', isset($cancellations->cancellation_reason) ? $cancellations->cancellation_reason : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('cancellation_reason'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('is_refunded') ? ' error' : ''; ?>">
                <?php echo form_label(lang('cancellations_field_is_refunded') . lang('bf_form_label_required'), 'is_refunded', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='is_refunded' type='text' required='required' name='is_refunded'  value="<?php echo set_value('is_refunded', isset($cancellations->is_refunded) ? $cancellations->is_refunded : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('is_refunded'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('refund_date') ? ' error' : ''; ?>">
                <?php echo form_label(lang('cancellations_field_refund_date') . lang('bf_form_label_required'), 'refund_date', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='refund_date' type='text' required='required' name='refund_date'  value="<?php echo set_value('refund_date', isset($cancellations->refund_date) ? $cancellations->refund_date : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('refund_date'); ?></span>
                </div>
            </div>
        </fieldset>
        <fieldset class='form-actions'>
            <input type='submit' name='save' class='btn btn-primary' value="<?php echo lang('cancellations_action_create'); ?>" />
            <?php echo lang('bf_or'); ?>
            <?php echo anchor(SITE_AREA . '/reports/cancellations', lang('cancellations_cancel'), 'class="btn btn-warning"'); ?>
            
        </fieldset>
    <?php echo form_close(); ?>
</div>