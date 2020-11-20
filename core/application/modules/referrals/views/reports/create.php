<?php

if (validation_errors()) :
?>
<div class='alert alert-block alert-error fade in'>
    <a class='close' data-dismiss='alert'>&times;</a>
    <h4 class='alert-heading'>
        <?php echo lang('referrals_errors_message'); ?>
    </h4>
    <?php echo validation_errors(); ?>
</div>
<?php
endif;

$id = isset($referrals->id) ? $referrals->id : '';

?>
<div class='admin-box'>
    <h3>Referrals</h3>
    <?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
        <fieldset>
            

            <div class="control-group<?php echo form_error('user_id') ? ' error' : ''; ?>">
                <?php echo form_label(lang('referrals_field_user_id') . lang('bf_form_label_required'), 'user_id', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='user_id' type='text' required='required' name='user_id'  value="<?php echo set_value('user_id', isset($referrals->user_id) ? $referrals->user_id : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('user_id'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('referrer_id') ? ' error' : ''; ?>">
                <?php echo form_label(lang('referrals_field_referrer_id') . lang('bf_form_label_required'), 'referrer_id', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='referrer_id' type='text' required='required' name='referrer_id'  value="<?php echo set_value('referrer_id', isset($referrals->referrer_id) ? $referrals->referrer_id : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('referrer_id'); ?></span>
                </div>
            </div>
        </fieldset>
        <fieldset class='form-actions'>
            <input type='submit' name='save' class='btn btn-primary' value="<?php echo lang('referrals_action_create'); ?>" />
            <?php echo lang('bf_or'); ?>
            <?php echo anchor(SITE_AREA . '/reports/referrals', lang('referrals_cancel'), 'class="btn btn-warning"'); ?>
            
        </fieldset>
    <?php echo form_close(); ?>
</div>