<p>Hi Admin,</p>

<p>A new class has been booked for Teacher <?php echo $teacher_name ?> (<?= $teacher_email ?>) with Student <?php echo $student_name ?> (<?= $student_email ?>)</p>
<p>Time: <?php echo $start_date ?> at <?php echo $start_time ?>. </p>

<p>Class ID: <a href="<?= ADMIN_PORTAL_URL ?>settings/users/class_history/<?= $teacher_id ?>"><?php echo $class_id ?></a></p>

<p><strong>Class Details</strong><br />
Level: <?= $level ?><br />
Unit: <?= $unit ?><br />
Topic: <?= $topic ?><br />
Theme: <?= $theme ?><br />
Lesson PDF: <?php echo $lesson_pdf ?> <br />
</p>	

<?php if(!empty($zoom_url)){
    echo '<p>Class Join Url: <a href="'.$zoom_url.'">'.$zoom_url.'</a><br />';    
    echo '<p>Class is under main ZOOM account: '. $zoom_meeting_owner . '</p>';
} ?>

Thank you.

                                                               