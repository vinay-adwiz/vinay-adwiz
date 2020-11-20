<?php

if (validation_errors()) :
?>
<div class='alert alert-block alert-error fade in'>
    <a class='close' data-dismiss='alert'>&times;</a>
    <h4 class='alert-heading'>
        <?php echo lang('favorite_teachers_errors_message'); ?>
    </h4>
    <?php echo validation_errors(); ?>
</div>
<?php
endif;

$id = isset($favorite_teachers->id) ? $favorite_teachers->id : '';

?>
<div class='admin-box'>
    <h3>Favorite Teachers</h3>
    <?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
        <fieldset>
            

            <div class="control-group<?php echo form_error('student_id') ? ' error' : ''; ?>">
                <?php echo form_label(lang('favorite_teachers_field_student_id') . lang('bf_form_label_required'), 'student_id', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='student_id' type='text' required='required' name='student_id'  value="<?php echo set_value('student_id', isset($favorite_teachers->student_id) ? $favorite_teachers->student_id : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('student_id'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('teacher_id') ? ' error' : ''; ?>">
                <?php echo form_label(lang('favorite_teachers_field_teacher_id') . lang('bf_form_label_required'), 'teacher_id', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='teacher_id' type='text' required='required' name='teacher_id'  value="<?php echo set_value('teacher_id', isset($favorite_teachers->teacher_id) ? $favorite_teachers->teacher_id : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('teacher_id'); ?></span>
                </div>
            </div>
        </fieldset>
        <fieldset class='form-actions'>
            <input type='submit' name='save' class='btn btn-primary' value="<?php echo lang('favorite_teachers_action_create'); ?>" />
            <?php echo lang('bf_or'); ?>
            <?php echo anchor(SITE_AREA . '/settings/favorite_teachers', lang('favorite_teachers_cancel'), 'class="btn btn-warning"'); ?>
            
        </fieldset>
    <?php echo form_close(); ?>
</div>