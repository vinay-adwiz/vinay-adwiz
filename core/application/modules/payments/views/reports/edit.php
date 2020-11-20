<?php

if (validation_errors()) :
?>
<div class='alert alert-block alert-error fade in'>
    <a class='close' data-dismiss='alert'>&times;</a>
    <h4 class='alert-heading'>
        <?php echo lang('payments_errors_message'); ?>
    </h4>
    <?php echo validation_errors(); ?>
</div>
<?php
endif;

$id = isset($payments->id) ? $payments->id : '';

?>
<div class='admin-box'>
    <h3>Payments</h3>
    <?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
        <fieldset>
            

            <div class="control-group<?php echo form_error('subscription_id') ? ' error' : ''; ?>">
                <?php echo form_label(lang('payments_field_subscription_id') . lang('bf_form_label_required'), 'subscription_id', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='subscription_id' type='text' required='required' name='subscription_id'  value="<?php echo set_value('subscription_id', isset($payments->subscription_id) ? $payments->subscription_id : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('subscription_id'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('reference_number') ? ' error' : ''; ?>">
                <?php echo form_label(lang('payments_field_reference_number') . lang('bf_form_label_required'), 'reference_number', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='reference_number' type='text' required='required' name='reference_number' maxlength='16' value="<?php echo set_value('reference_number', isset($payments->reference_number) ? $payments->reference_number : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('reference_number'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('payment_status') ? ' error' : ''; ?>">
                <?php echo form_label(lang('payments_field_payment_status') . lang('bf_form_label_required'), 'payment_status', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='payment_status' type='text' required='required' name='payment_status' maxlength='3' value="<?php echo set_value('payment_status', isset($payments->payment_status) ? $payments->payment_status : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('payment_status'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('amount') ? ' error' : ''; ?>">
                <?php echo form_label(lang('payments_field_amount') . lang('bf_form_label_required'), 'amount', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='amount' type='text' required='required' name='amount' maxlength='14' value="<?php echo set_value('amount', isset($payments->amount) ? $payments->amount : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('amount'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('currency') ? ' error' : ''; ?>">
                <?php echo form_label(lang('payments_field_currency') . lang('bf_form_label_required'), 'currency', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='currency' type='text' required='required' name='currency' maxlength='3' value="<?php echo set_value('currency', isset($payments->currency) ? $payments->currency : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('currency'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('reference_date') ? ' error' : ''; ?>">
                <?php echo form_label(lang('payments_field_reference_date') . lang('bf_form_label_required'), 'reference_date', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='reference_date' type='text' required='required' name='reference_date' maxlength='16' value="<?php echo set_value('reference_date', isset($payments->reference_date) ? $payments->reference_date : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('reference_date'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('transaction_number') ? ' error' : ''; ?>">
                <?php echo form_label(lang('payments_field_transaction_number'), 'transaction_number', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='transaction_number' type='text' name='transaction_number' maxlength='64' value="<?php echo set_value('transaction_number', isset($payments->transaction_number) ? $payments->transaction_number : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('transaction_number'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('approval_code') ? ' error' : ''; ?>">
                <?php echo form_label(lang('payments_field_approval_code'), 'approval_code', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='approval_code' type='text' name='approval_code' maxlength='32' value="<?php echo set_value('approval_code', isset($payments->approval_code) ? $payments->approval_code : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('approval_code'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('transaction_date') ? ' error' : ''; ?>">
                <?php echo form_label(lang('payments_field_transaction_date'), 'transaction_date', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='transaction_date' type='text' name='transaction_date' maxlength='16' value="<?php echo set_value('transaction_date', isset($payments->transaction_date) ? $payments->transaction_date : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('transaction_date'); ?></span>
                </div>
            </div>
        </fieldset>
        <fieldset class='form-actions'>
            <input type='submit' name='save' class='btn btn-primary' value="<?php echo lang('payments_action_edit'); ?>" />
            <?php echo lang('bf_or'); ?>
            <?php echo anchor(SITE_AREA . '/reports/payments', lang('payments_cancel'), 'class="btn btn-warning"'); ?>
            
            <?php if ($this->auth->has_permission('Payments.Reports.Delete')) : ?>
                <?php echo lang('bf_or'); ?>
                <button type='submit' name='delete' formnovalidate class='btn btn-danger' id='delete-me' onclick="return confirm('<?php e(js_escape(lang('payments_delete_confirm'))); ?>');">
                    <span class='icon-trash icon-white'></span>&nbsp;<?php echo lang('payments_delete_record'); ?>
                </button>
            <?php endif; ?>
        </fieldset>
    <?php echo form_close(); ?>
</div>