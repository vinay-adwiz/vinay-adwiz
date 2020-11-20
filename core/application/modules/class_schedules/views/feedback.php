
<div class="hero-box hero-box-smaller full-bg-13 font-inverse" data-top-bottom="background-position: 50% 0px;" data-bottom-top="background-position: 50% -600px;">
    <div class="container">
        <h1 class="hero-heading wow fadeInDown" data-wow-duration="0.6s"><?php e(lang('feedback')); ?></h1>
    </div>
    <div class="hero-overlay bg-black"></div>
</div>
<?php
$class_date_time = format_class_date_time($class_details['class_start_date'],$class_details['class_start_time']);
?>
<div id="page-content" class="col-md-8 center-margin frontend-components mrg25T">
    <div class="row">
        <div class="col-md-3 col-lg-2">
            <?php echo theme_view('sidemenu'); ?>
        </div>
        <div class="col-md-9 col-lg-10">
            <div id="page-title">
                <h2><?php e(lang('teacher_feedback')); ?></h2>
                <p>&nbsp;</p>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <div class="panel">
                        <div class="panel-body">
                            <div class="message"></div>
                            <h3 class="title-hero">
                                <?php e(lang('feedback_instructions')); ?>
                            </h3>
                            <p class="title-hero">                               
                                <?php e(lang('teacher')); ?>: <a href="<?php echo site_url("profiles/teacher/" . $class_details['teacher_id']); ?>"><?= @$class_details['teacher']->first_name ?> <?= @$class_details['teacher']->last_name ?></a><br />
                                <?php e(lang('lesson')); ?>: <?= $curriculum['topic'] ?><br />
                                <?php e(lang('class_date')); ?>: <?= $class_date_time ?><br />
                            </p>    
                            <p>&nbsp;</p>
                            <div class="example-box-wrapper">
                            <?php echo form_open($this->uri->uri_string(), array('class' => 'form-horizontal bordered-row', 'autocomplete' => 'off')); ?>
                            <?php
                                $feedback = isset($_POST['feedback']) ? $_POST['feedback'] : '';
                        ?>                                     
                                <div class="form-group <?php echo form_error('feedback') ? 'has-error' : ''; ?>">
                                    <label class="col-sm-3 control-label" for="feedback"><?php e(lang('teacher_feedback')); ?></label>
                                    <div class="col-sm-9">
                                        <textarea class="ckeditor" name="feedback" id="feedback" placeholder="<?php e(lang('enter_feedback')); ?>"><?=$feedback ?></textarea>
                                        <?php echo form_error('feedback', '<div class="alert alert-error">', '</div>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="send_feedback" value="1" />
                                    <div class="col-sm-12 control-label"><input class="btn btn-primary"  name="save" type="submit" value="<?php e(lang('submit')); ?>"></div>
                                </div>
                            </div>    
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
