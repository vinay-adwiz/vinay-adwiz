<?php

if (validation_errors()) :
?>
<div class='alert alert-block alert-error fade in'>
    <a class='close' data-dismiss='alert'>&times;</a>
    <h4 class='alert-heading'>
        <?php echo lang('class_schedules_errors_message'); ?>
    </h4>
    <?php echo validation_errors(); ?>
</div>
<?php
endif;

$id = isset($class_schedules->id) ? $class_schedules->id : '';

?>
<div class='admin-box'>
    <h3>Class Schedules</h3>
    <?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
        <fieldset>
            

            <div class="control-group<?php echo form_error('available_start_date') ? ' error' : ''; ?>">
                <?php echo form_label(lang('class_schedules_field_available_start_date') . lang('bf_form_label_required'), 'available_start_date', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='available_start_date' type='text' required='required' name='available_start_date'  value="<?php echo set_value('available_start_date', isset($class_schedules->available_start_date) ? $class_schedules->available_start_date : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('available_start_date'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('available_start_time') ? ' error' : ''; ?>">
                <?php echo form_label(lang('class_schedules_field_available_start_time') . lang('bf_form_label_required'), 'available_start_time', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='available_start_time' type='text' required='required' name='available_start_time'  value="<?php echo set_value('available_start_time', isset($class_schedules->available_start_time) ? $class_schedules->available_start_time : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('available_start_time'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('available_end_date') ? ' error' : ''; ?>">
                <?php echo form_label(lang('class_schedules_field_available_end_date') . lang('bf_form_label_required'), 'available_end_date', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='available_end_date' type='text' required='required' name='available_end_date'  value="<?php echo set_value('available_end_date', isset($class_schedules->available_end_date) ? $class_schedules->available_end_date : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('available_end_date'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('available_end_time') ? ' error' : ''; ?>">
                <?php echo form_label(lang('class_schedules_field_available_end_time') . lang('bf_form_label_required'), 'available_end_time', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='available_end_time' type='text' required='required' name='available_end_time'  value="<?php echo set_value('available_end_time', isset($class_schedules->available_end_time) ? $class_schedules->available_end_time : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('available_end_time'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('teacher_id') ? ' error' : ''; ?>">
                <?php echo form_label(lang('class_schedules_field_teacher_id') . lang('bf_form_label_required'), 'teacher_id', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='teacher_id' type='text' required='required' name='teacher_id'  value="<?php echo set_value('teacher_id', isset($class_schedules->teacher_id) ? $class_schedules->teacher_id : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('teacher_id'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('student_id') ? ' error' : ''; ?>">
                <?php echo form_label(lang('class_schedules_field_student_id'), 'student_id', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='student_id' type='text' name='student_id'  value="<?php echo set_value('student_id', isset($class_schedules->student_id) ? $class_schedules->student_id : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('student_id'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('curriculum_id') ? ' error' : ''; ?>">
                <?php echo form_label(lang('class_schedules_field_curriculum_id'), 'curriculum_id', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='curriculum_id' type='text' name='curriculum_id'  value="<?php echo set_value('curriculum_id', isset($class_schedules->curriculum_id) ? $class_schedules->curriculum_id : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('curriculum_id'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('is_peak_period') ? ' error' : ''; ?>">
                <?php echo form_label(lang('class_schedules_field_is_peak_period') . lang('bf_form_label_required'), 'is_peak_period', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='is_peak_period' type='text' required='required' name='is_peak_period'  value="<?php echo set_value('is_peak_period', isset($class_schedules->is_peak_period) ? $class_schedules->is_peak_period : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('is_peak_period'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('zoom_url') ? ' error' : ''; ?>">
                <?php echo form_label(lang('class_schedules_field_zoom_url'), 'zoom_url', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='zoom_url' type='text' name='zoom_url' maxlength='255' value="<?php echo set_value('zoom_url', isset($class_schedules->zoom_url) ? $class_schedules->zoom_url : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('zoom_url'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('status') ? ' error' : ''; ?>">
                <?php echo form_label(lang('class_schedules_field_status') . lang('bf_form_label_required'), 'status', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='status' type='text' required='required' name='status'  value="<?php echo set_value('status', isset($class_schedules->status) ? $class_schedules->status : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('status'); ?></span>
                </div>
            </div>
        </fieldset>
        <fieldset class='form-actions'>
            <input type='submit' name='save' class='btn btn-primary' value="<?php echo lang('class_schedules_action_edit'); ?>" />
            <?php echo lang('bf_or'); ?>
            <?php echo anchor(SITE_AREA . '/content/class_schedules', lang('class_schedules_cancel'), 'class="btn btn-warning"'); ?>
            
            <?php if ($this->auth->has_permission('Class_Schedules.Content.Delete')) : ?>
                <?php echo lang('bf_or'); ?>
                <button type='submit' name='delete' formnovalidate class='btn btn-danger' id='delete-me' onclick="return confirm('<?php e(js_escape(lang('class_schedules_delete_confirm'))); ?>');">
                    <span class='icon-trash icon-white'></span>&nbsp;<?php echo lang('class_schedules_delete_record'); ?>
                </button>
            <?php endif; ?>
        </fieldset>
    <?php echo form_close(); ?>
</div>