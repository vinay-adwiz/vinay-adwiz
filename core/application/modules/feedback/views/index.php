<?php

$hiddenFields = array('id',);
?>
<h1 class='page-header'>
    <?php echo lang('feedback_area_title'); ?>
</h1>
<?php if (isset($records) && is_array($records) && count($records)) : ?>
<table class='table table-striped table-bordered'>
    <thead>
        <tr>
            
            <th>User ID</th>
            <th>Feedback Provided By</th>
            <th>Feedback Type</th>
            <th>Class ID</th>
            <th>Rating</th>
            <th>Feedback</th>
            <th><?php echo lang('feedback_column_created'); ?></th>
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
                    e(($value > 0) ? lang('feedback_true') : lang('feedback_false'));
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