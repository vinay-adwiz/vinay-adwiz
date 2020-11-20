<?php

$num_columns	= 11;
$can_delete	= $this->auth->has_permission('Class_Schedules.Content.Delete');
$can_edit		= $this->auth->has_permission('Class_Schedules.Content.Edit');
$has_records	= isset($records) && is_array($records) && count($records);

if ($can_delete) {
    $num_columns++;
}
?>
<div class='admin-box'>
	<h3>
		<?php echo lang('class_schedules_area_title'); ?>
	</h3>
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class='table table-striped'>
			<thead>
				<tr>
					<?php if ($can_delete && $has_records) : ?>
					<th class='column-check'><input class='check-all' type='checkbox' /></th>
					<?php endif;?>
					
					<th><?php echo lang('class_schedules_field_available_start_date'); ?></th>
					<th><?php echo lang('class_schedules_field_available_start_time'); ?></th>
					<th><?php echo lang('class_schedules_field_available_end_date'); ?></th>
					<th><?php echo lang('class_schedules_field_available_end_time'); ?></th>
					<th><?php echo lang('class_schedules_field_teacher_id'); ?></th>
					<th><?php echo lang('class_schedules_field_student_id'); ?></th>
					<th><?php echo lang('class_schedules_field_curriculum_id'); ?></th>
					<th><?php echo lang('class_schedules_field_is_peak_period'); ?></th>
					<th><?php echo lang('class_schedules_field_zoom_url'); ?></th>
					<th><?php echo lang('class_schedules_field_status'); ?></th>
					<th><?php echo lang('class_schedules_column_created'); ?></th>
				</tr>
			</thead>
			<?php if ($has_records) : ?>
			<tfoot>
				<?php if ($can_delete) : ?>
				<tr>
					<td colspan='<?php echo $num_columns; ?>'>
						<?php echo lang('bf_with_selected'); ?>
						<input type='submit' name='delete' id='delete-me' class='btn btn-danger' value="<?php echo lang('bf_action_delete'); ?>" onclick="return confirm('<?php e(js_escape(lang('class_schedules_delete_confirm'))); ?>')" />
					</td>
				</tr>
				<?php endif; ?>
			</tfoot>
			<?php endif; ?>
			<tbody>
				<?php
				if ($has_records) :
					foreach ($records as $record) :
				?>
				<tr>
					<?php if ($can_delete) : ?>
					<td class='column-check'><input type='checkbox' name='checked[]' value='<?php echo $record->id; ?>' /></td>
					<?php endif;?>
					
				<?php if ($can_edit) : ?>
					<td><?php echo anchor(SITE_AREA . '/content/class_schedules/edit/' . $record->id, '<span class="icon-pencil"></span> ' .  $record->available_start_date); ?></td>
				<?php else : ?>
					<td><?php e($record->available_start_date); ?></td>
				<?php endif; ?>
					<td><?php e($record->available_start_time); ?></td>
					<td><?php e($record->available_end_date); ?></td>
					<td><?php e($record->available_end_time); ?></td>
					<td><?php e($record->teacher_id); ?></td>
					<td><?php e($record->student_id); ?></td>
					<td><?php e($record->curriculum_id); ?></td>
					<td><?php e($record->is_peak_period); ?></td>
					<td><?php e($record->zoom_url); ?></td>
					<td><?php e($record->status); ?></td>
					<td><?php e($record->created_on); ?></td>
				</tr>
				<?php
					endforeach;
				else:
				?>
				<tr>
					<td colspan='<?php echo $num_columns; ?>'><?php echo lang('class_schedules_records_empty'); ?></td>
				</tr>
				<?php endif; ?>
			</tbody>
		</table>
	<?php
    echo form_close();
    
    ?>
</div>