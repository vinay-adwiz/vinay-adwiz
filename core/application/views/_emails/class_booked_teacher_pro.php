<p>Dear Teacher,</p>

<p>*<span style="color: red;">PLEASE CONFIRM THE FOLLOWING BOOKING TO SUPPORT</span>* </p>

<p>A new class has been booked for Teacher <?php echo $teacher_name ?> (<?php echo $teacher_email ?>) with Student <?php echo $student_name ?></p>

<p>Time: <?php echo $start_date ?> at <?php echo $start_time ?>. </p>

<p>Class ID: <?php echo $class_id ?></p>

<strong>Class Details</strong><br />
<?php
if ($class_level !== '0') {
?>
Level: <?php echo $class_level ?><br />
Unit: <?php echo $class_unit ?><br />
<?php
} ?>
Topic: <?php echo $topic ?><br />
Lesson PDF: <?php echo $lesson_pdf ?><br />
Zoom Meeting Password : 99999</p>

<p>Class is under main ZOOM account: <?php echo $zoom_meeting_owner ?></p>

<p>Use your password to login before clicking on the Class Join URL:  <a href="<?= $zoom_url ?>"><?= $zoom_url ?></a></p>

<?php
if (isset($double_class) && $double_class === true) {
   echo "<p>This is the second class of a double booking. Please use the same URL and teach for a full 50 minutes.</p>";
} 
?>

<p>When you start the class, please login as the host under the account name sent from the system with the corresponding password. Make sure to record the entire lesson on your own computer (not the cloud). When you are done, please provide feedback, upload the video to a sharing site such as Google Drive or Dropbox, and leave both the feedback and the URL recording of the class in the portal. Please shorten the video link here first: <a href="https://goo.gl/">https://goo.gl/</a></p>

<p>If you have any questions, just let us know. </p>

<p>Happy Teaching!</p>

