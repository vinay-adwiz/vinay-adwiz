
<?php

$errorClass   = empty($errorClass) ? ' error' : $errorClass;
$controlClass = empty($controlClass) ? 'span6' : $controlClass;
$fieldData = array(
    'errorClass'   => $errorClass,
    'controlClass' => $controlClass,
);

?>


<div class="hero-box hero-box-smaller full-bg-13 font-inverse" data-top-bottom="background-position: 50% 0px;" data-bottom-top="background-position: 50% -600px;">
    <div class="container">
        <h1 class="hero-heading wow fadeInDown" data-wow-duration="0.6s"><?php e(lang('my_classes')); ?></h1>
    </div>
    <div class="hero-overlay bg-black"></div>
</div>

<div id="page-content" class="col-md-8 center-margin frontend-components mrg25T">
    <div class="row">
        <div class="col-md-3 col-lg-2">
            <?php echo theme_view('sidemenu'); ?>
        </div>
        <div class="col-md-9 col-lg-10">
            <div id="page-title">
                <h2><?php e(lang('upcoming_classes')); ?></h2>
                <p>&nbsp;</p>
                <p> <?php echo Template::message(); ?></p>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <div class="panel">
                        <div class="panel-body">
                            <div class="scroll-columns">
<?php                       if (empty($upcoming_classes)) : ?>
                                <?php e(lang('no_upcoming_classes')); ?>
<?php                       else : ?>    
                                <div class="slide_more"><i class="glyph-icon icon-arrow-left"></i> <?php e(lang('slide_more')); ?></div>
                              <table class="table table-bordered table-condensed cf">
                                    <thead class="cf">
                                        <tr>
                                            <th><?php e(lang('curriculum_level')); ?></th>
                                            <th><?php e(lang('lesson')); ?></th>
                                            <th><?php e(lang('teacher')); ?></th>
                                            <th><?php e(lang('class_time')); ?></th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($upcoming_classes as $class) : 

                                            $class_start_time = strtotime($class['class_start_date'] . " " . $class['class_start_time']);
                                            $class_time = date('M j, Y g:i A', $class_start_time);
                                        ?>
                                        <tr>
                                            <td><?php echo @$class['curriculum_details']['level']; ?></td>
                                            
<?php                                   if ($class['curriculum_id'] == ASSESSMENT_CLASS_ID) {
?>
                                            <td><?php e(lang('assessment_plan')); ?></td>
<?php
                                        } else {
?>
                                            <td><?php echo @$class['curriculum_details']['topic']; ?> (<?php echo @$class['curriculum_details']['theme']; ?>)<br />Class URL: <a style="text-decoration: underline;" href="<?= $class['zoom_url']; ?>" target="_blank"><?= $class['zoom_url']; ?></a></td>
<?php
                                        } 
?>
                                            <td><a href="<?php echo site_url("/profiles/teacher/"); ?>/<?php echo @$class['teacher_details']['meta']->id; ?>"><?php echo @$class['teacher_details']['meta']->first_name; ?> <?php echo @$class['teacher_details']['meta']->last_name; ?></a></td>
                                            <td><?php echo $class_time; ?></td>
                                            <td><center><a href="<?php echo site_url("/users/cancel_class/".$class['id']); ?>"><button class="btn btn-danger"><?php e(lang('cancel_class')); ?></button></a></center></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
<?php                       endif; ?>                                   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
