<p>Hi Admin,</p>

<p>The class for Teacher <?php echo $teacher_name ?> (<?= $teacher_email ?>) has been cancelled by Student <?php echo $student_name ?> (<?= $student_email ?>)</p>
<p>
<?php if (isset($is_chargeable) && $is_chargeable == '1') {
	echo 'This is a chargeable cancellation';
} else {
	echo 'This is a non chargeable cancellation';
} ?>
</p>
<p>Time: <?php echo $start_date ?> at <?php echo $start_time ?>. </p>

<p>Class ID: <a href="<?= ADMIN_PORTAL_URL ?>settings/users/class_history/<?= $teacher_id ?>"><?php echo $class_id ?></a></p>

<p><strong>Class Details</strong><br />
Level: <?= $level ?><br />
Unit: <?= $unit ?><br />
Topic: <?= $topic ?><br />
Theme: <?= $theme ?><br />
</p>	

<?php if(!empty($zoom_url)){
    echo '<p>ZOOM Url: <a href="'.$zoom_url.'">'.$zoom_url.'</a></p>';    
} ?>

Thank you.
