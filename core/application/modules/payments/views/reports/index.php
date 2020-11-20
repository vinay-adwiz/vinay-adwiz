<?php

$num_columns	= 9;
$can_delete	= $this->auth->has_permission('Payments.Reports.Delete');
$can_edit		= $this->auth->has_permission('Payments.Reports.Edit');
$has_records	= isset($records) && is_array($records) && count($records);

if ($can_delete) {
    $num_columns++;
}
?>
<div class='admin-box'>
	<h3>
		<?php echo lang('payments_area_title'); ?>
	</h3>
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class='table table-striped'>
			<thead>
				<tr>
					<?php if ($can_delete && $has_records) : ?>
					<th class='column-check'><input class='check-all' type='checkbox' /></th>
					<?php endif;?>
					
					<th><?php echo lang('payments_field_subscription_id'); ?></th>
					<th><?php echo lang('payments_field_reference_number'); ?></th>
					<th><?php echo lang('payments_field_payment_status'); ?></th>
					<th><?php echo lang('payments_field_amount'); ?></th>
					<th><?php echo lang('payments_field_currency'); ?></th>
					<th><?php echo lang('payments_field_reference_date'); ?></th>
					<th><?php echo lang('payments_field_transaction_number'); ?></th>
					<th><?php echo lang('payments_field_approval_code'); ?></th>
					<th><?php echo lang('payments_field_transaction_date'); ?></th>
				</tr>
			</thead>
			<?php if ($has_records) : ?>
			<tfoot>
				<?php if ($can_delete) : ?>
				<tr>
					<td colspan='<?php echo $num_columns; ?>'>
						<?php echo lang('bf_with_selected'); ?>
						<input type='submit' name='delete' id='delete-me' class='btn btn-danger' value="<?php echo lang('bf_action_delete'); ?>" onclick="return confirm('<?php e(js_escape(lang('payments_delete_confirm'))); ?>')" />
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
					<td><?php echo anchor(SITE_AREA . '/reports/payments/edit/' . $record->id, '<span class="icon-pencil"></span> ' .  $record->subscription_id); ?></td>
				<?php else : ?>
					<td><?php e($record->subscription_id); ?></td>
				<?php endif; ?>
					<td><?php e($record->reference_number); ?></td>
					<td><?php e($record->payment_status); ?></td>
					<td><?php e($record->amount); ?></td>
					<td><?php e($record->currency); ?></td>
					<td><?php e($record->reference_date); ?></td>
					<td><?php e($record->transaction_number); ?></td>
					<td><?php e($record->approval_code); ?></td>
					<td><?php e($record->transaction_date); ?></td>
				</tr>
				<?php
					endforeach;
				else:
				?>
				<tr>
					<td colspan='<?php echo $num_columns; ?>'><?php echo lang('payments_records_empty'); ?></td>
				</tr>
				<?php endif; ?>
			</tbody>
		</table>
	<?php
    echo form_close();
    
    ?>
</div>