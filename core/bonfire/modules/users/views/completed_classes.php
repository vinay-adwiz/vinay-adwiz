
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
                <h2><?php e(lang('classes_completed_to_date')); ?></h2>
                <p>&nbsp;</p>
                <?php echo Template::message(); ?>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <div class="panel">
                        <div class="panel-body">
                            <div class="scroll-columns">
<?php                       if (empty($completed_classes)) : ?>
                                <?php e(lang('no_completed_classes')); ?>
<?php                       else : ?>

                                <div class="row filter_div">  
                                  <div class="col-md-9 col-xs-12">
                                        <?php echo form_open($this->uri->uri_string(), array('class' => 'form-inline', 'autocomplete' => 'off', 'id' => 'class_filter_form')); ?>
                                        <?php $c_class_start_date = $completed_classes[0]['class_start_date'];
                                        
                                            $c_class_start_date = explode('-',$c_class_start_date);
                                            
                                            $class_start_year = $c_class_start_date[0];
                                            $class_start_month = $c_class_start_date[1];
                                        
                                        ?>
                                          <div class="form-group">
                                            <label class="sr-only" for="choose_month">Month:</label>
                                            <select class="form-control" name="choose_month" class="choose_month" id="choose_month">
                                            <?php
                                                echo '<option value="">Select Month</option>';
                                                if(!empty($start_month)){
                                                    foreach($start_month as $month){ 
                                                        
                                                        $month_name = date('F', mktime(0, 0, 0, $month, 10));
                                                        ?>
                                                        
                                                        <option value="<?php echo $month ?>" <?php if(!empty($filter_array['month'])): if($class_start_month == $month){ echo 'selected="selected"'; } endif; ?>>
                                                            <?php echo $month_name; ?>
                                                        </option>
                                                   <?php }
                                                }
                                                
                                            ?>
                                             </select>
                                          </div>
                                          <div class="form-group">
                                            <label class="sr-only" for="choose_year">Year:</label>
                                            <select class="form-control" class="choose_year" name="choose_year" id="choose_year">
                                                <?php
                                                echo '<option value="">Select Year</option>';
                                                if(!empty($start_year)){
                                                    foreach($start_year as $year){ ?>
                                                        <option value="<?php echo $year ?>" <?php if(!empty($filter_array['year'])): if($class_start_year == $year){ echo 'selected="selected"'; } endif; ?>>
                                                            <?php echo $year; ?>
                                                        </option>
                                                    <?php }
                                                }
                                                
                                            ?>
                                             </select>
                                          </div>
                                          <input type="submit" name="submit" value="Filter" class="btn btn-primary" />
                                        <?php
                                           echo form_close();
                                        ?> 
                                  </div>
                                  <div class="col-md-3 col-xs-12" class="clr_filter">
                                    <?php if(!empty($filter_active)): ?>
                                        <?php echo form_open($this->uri->uri_string(), array('class' => 'form-inline', 'autocomplete' => 'off', 'id' => 'class_filter_form')); ?><button type="submit" name="clr_filter" class="btn btn-sm btn-danger">&times; Clear Fiter(s)</button><?php
                                               echo form_close();
                                            ?> 
                                     <?php endif; ?>   
                                  </div>  
                              </div>
                              <br />    

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
                                        <?php foreach ($completed_classes as $class) : 
                                            $class_start_time = strtotime($class['class_start_date'] . " " . $class['class_start_time']);
                                            $class_time = date('M j, Y g:i A', $class_start_time);
                                        ?>
                                        <tr>
                                            <td><?php echo @$class['curriculum_details']['level']; ?></td>
                                            <td><?php echo @$class['curriculum_details']['topic']; ?> <?php if (empty($class['curriculum_details']['theme']) === false) { ?>(<?php echo $class['curriculum_details']['theme']; ?>)<?php } // end empty theme check ?></td>
                                            <td><a href="<?php echo site_url("/profiles/teacher/"); ?>/<?php echo @$class['teacher_details']['meta']->id; ?>"><?php echo @$class['teacher_details']['meta']->first_name; ?> <?php echo @$class['teacher_details']['meta']->last_name; ?></a></td>
                                            <td><?php echo $class_time; ?></td>
                                            <td>
                                    <?php   if (empty($class['feedback'])) : ?>
                                                <center><a href="<?php echo site_url("/class/feedback/"); ?>/<?php echo $class['id']; ?>"><button class="btn btn-blue-alt"><?php e(lang('provide_feedback')); ?></button></a></center>
                                    <?php   endif; ?>
                                            </td>
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
