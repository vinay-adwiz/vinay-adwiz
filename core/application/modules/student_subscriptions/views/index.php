<?php

$hiddenFields = array('id',);
?>
<h1 class='page-header'>
    <?php echo lang('student_subscriptions_area_title'); ?>
</h1>
<?php if (isset($records) && is_array($records) && count($records)) : ?>
<table class='table table-striped table-bordered'>
    <thead>
        <tr>
            
            <th>Student ID</th>
            <th>Plan ID</th>
            <th>Payment ID</th>
            <th>Completion Date</th>
            <th><?php echo lang('student_subscriptions_column_created'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($records as $record) :
        ?>
        <tr>
            <?php
            foreach($record as $field => $value) :
                if ( ! in_array($field, $hiddenFields)) :
            ?>
            <td>
                <?php
                if ($field == 'deleted') {
                    e(($value > 0) ? lang('student_subscriptions_true') : lang('student_subscriptions_false'));
                } else {
                    e($value);
                }
                ?>
            </td>
            <?php
                endif;
            endforeach;
            ?>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php

endif; ?>