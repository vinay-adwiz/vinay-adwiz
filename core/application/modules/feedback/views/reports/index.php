<?php

$num_columns	= 8;
$can_delete	= $this->auth->has_permission('Feedback.Reports.Delete');
$can_edit		= $this->auth->has_permission('Feedback.Reports.Edit');
$has_records	= isset($records) && is_array($records) && count($records);

if ($can_delete) {
    $num_columns++;
}
?>
<div class='admin-box'>
	<h3>
		<?php echo lang('feedback_area_title'); ?>
	</h3>
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class='table table-striped'>
			<thead>
				<tr>
					<?php if ($can_delete && $has_records) : ?>
					<th class='column-check'><input class='check-all' type='checkbox' /></th>
					<?php endif;?>
					
					<th><?php echo lang('feedback_field_user_id'); ?></th>
					<th><?php echo lang('feedback_field_provided_by'); ?></th>
					<th><?php echo lang('feedback_field_feedback_type'); ?></th>
					<th><?php echo lang('feedback_field_class_id'); ?></th>
					<th><?php echo lang('feedback_field_rating'); ?></th>
					<th><?php echo lang('feedback_field_feedback'); ?></th>
					<th><?php echo lang('feedback_column_created'); ?></th>
				</tr>
			</thead>
			<?php if ($has_records) : ?>
			<tfoot>
				<?php if ($can_delete) : ?>
				<tr>
					<td colspan='<?php echo $num_columns; ?>'>
						<?php echo lang('bf_with_selected'); ?>
						<input type='submit' name='delete' id='delete-me' class='btn btn-danger' value="<?php echo lang('bf_action_delete'); ?>" onclick="return confirm('<?php e(js_escape(lang('feedback_delete_confirm'))); ?>')" />
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
					<td><?php echo anchor(SITE_AREA . '/reports/feedback/edit/' . $record->id, '<span class="icon-pencil"></span> ' .  $record->user_id); ?></td>
				<?php else : ?>
					<td><?php e($record->user_id); ?></td>
				<?php endif; ?>
					<td><?php e($record->provided_by); ?></td>
					<td><?php e($record->feedback_type); ?></td>
					<td><?php e($record->class_id); ?></td>
					<td><?php e($record->rating); ?></td>
					<td><?php e($record->feedback); ?></td>
					<td><?php e($record->created_on); ?></td>
				</tr>
				<?php
					endforeach;
				else:
				?>
				<tr>
					<td colspan='<?php echo $num_columns; ?>'><?php echo lang('feedback_records_empty'); ?></td>
				</tr>
				<?php endif; ?>
			</tbody>
		</table>
	<?php
    echo form_close();
    
    ?>
</div>