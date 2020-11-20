<div class="hero-box hero-box-smaller full-bg-13 font-inverse" data-top-bottom="background-position: 50% 0px;" data-bottom-top="background-position: 50% -600px;">
    <div class="container">
        <h1 class="hero-heading wow fadeInDown" data-wow-duration="0.6s"><?php echo lang('title_student_portal'); ?></h1>
    </div>
    <div class="hero-overlay bg-black"></div>
</div>

<div id="page-content" class="col-md-8 center-margin frontend-components mrg25T">
    <div class="row">
        <div class="col-md-3 col-lg-2">
            <?php echo theme_view('sidemenu'); ?>
        </div>
        <div class="col-md-9 col-lg-10">

            <!-- Skycons -->
            <script type="text/javascript" src="<?= base_url(); ?>assets/widgets/skycons/skycons.js"></script>

            <div id="page-title">
                <h2><?php echo lang('title_welcome_student_portal'); ?></h2>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="content-box">
                        <div class="content-box-wrapper">
                        <?php  if (isset($student_remaining) === FALSE || $student_remaining < 1) : ?>         
                                <h3><?php e(lang('no_more_credit')); ?></h3>
                                <br /><p><a href="<?php echo site_url("users/packages/"); ?>" class="bs-label bg-green" title="book now" style="padding: 7px; font-size: 14px;"><?php e(lang('buy_more_credits')); ?></a></p>
                        <?php   else: ?>
                                <h3><?php echo sprintf(lang('num_remaining_classes'), $student_remaining); ?></h3>
                        <?php   endif; ?>
                        </div>    
                    </div>    
                    <div class="content-box">
                        <h3 class="content-box-header content-box-header-alt bg-white">
                            <?php e(lang('upcoming_classes')); ?>
                        </h3>
                        <div class="content-box-wrapper">
                            <div class="panel-body">
<?php                       if (empty($next_class)) : ?>
                            <?php e(lang('no_upcoming_classes')); ?>
<?php                       else : ?>                                
                                <ul class="todo-box">
                                    <li class="border-red">
                                        <label for="todo-1"><?php e(lang('next_class_is')); ?>:</label> <?= $next_class->topic ?>&nbsp;&nbsp;
                                        <br /><br /><a href="<?php echo site_url("profiles/teachers/"); ?>" class="bs-label bg-green" title="book now" style="padding: 7px; font-size: 14px;"><?php e(lang('book_now')); ?></a>
                                    </li>
                                </ul>    
<?php                       endif; ?>                                   
                            </div>
                        </div>    
                    </div>

                </div>    
                <div class="col-md-6">
                    <div class="content-box">
                        <h3 class="content-box-header content-box-header-alt bg-white">
                            <?php e(lang('bf_my_calendar')); ?>
                        </h3>
                        <div class="content-box-wrapper my-calendar">
                            <div class="example-box-wrapper">
                                <div class="timeline-box timeline-box-right">
<?php                           if (empty($all_upcoming_classes)) : ?>
                                        <?php e(lang('no_upcoming_classes')); ?>&nbsp;&nbsp;<a href="<?php echo site_url("profiles/teachers/"); ?>" class="bs-label bg-green" title=""><?php e(lang('book_now')); ?></a>
<?php                           else : 

                                    foreach ($all_upcoming_classes as $class) :
?>    
                                    <div class="tl-row">
                                        <div class="tl-item">
                                            <div class="popover left">
                                                <div class="arrow"></div>
                                                <div class="popover-content">
                                                    <div class="tl-label bs-label label-info"><?= $class['curriculum_details']['topic'] ?></div>
                                                    <div class="tl-time" style="opacity: 1">
                                                        <i class="glyph-icon icon-clock-o"></i>
                                                        <?php echo format_class_date_time($class['class_start_date'], $class['class_start_time']); ?>
                                                    </div><br />
                                                    <p class="tl-content"><strong><?php e(lang('bf_teacher')); ?>:</strong>&nbsp;&nbsp;<a href="<?php echo site_url("profiles/teacher/" . $class['teacher_id']); ?>"><?= $class['teacher_details']['meta']->first_name ?> <?= $class['teacher_details']['meta']->last_name ?></a></p>
                                                    <p class="tl-content"><strong><?php e(lang('bf_themes')); ?>:</strong>&nbsp;&nbsp;<?= $class['curriculum_details']['theme'] ?></p>
                                                    <p class="tl-content"><strong><?php e(lang('bf_phrases')); ?>:</strong><br />
<?php                                                   $phrases = explode('|', $class['curriculum_details']['phrases']);
                                                        foreach ($phrases as $phrase) {
                                                            //echo $phrase . "<br />";
                                                            $http_ary = explode('http', $phrase);
                                                            foreach ($http_ary as $link) {
                                                                if (empty($link) === false) {
                                                                    $full_link = 'http' . $link;
                                                                    $url = '@(http(s)?)?(://)?(([a-zA-Z])([-\w]+\.)+([^\s\.]+[^\s]*)+[^,.\s])@';
                                                                    $string = preg_replace($url, '<a href="http$2://$4" target="_blank" title="$0">$0</a>', $full_link);
                                                                    echo $string;
                                                                }
                                                            }

                                                        }
?>
                                                    </p>
                                                    <p class="tl-content"><strong><?php e(lang('bf_vocabulary')); ?>:</strong><br />
<?php                                                   $vocabulary = explode('|', $class['curriculum_details']['vocabulary']);
                                                        foreach ($vocabulary as $vocab) {
                                                            echo $vocab . "<br />";
                                                        }
?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
<?php                               endforeach;
                                endif; ?>                                        
                                </div>
                            </div>    
                        </div>
                    </div>
                </div>
                <!-- <div class="col-md-12">
                   <form action="<?php echo site_url('users/book_new_class'); ?>" method="post" class="book_new_class">
                       <input type="hidden" name="key" value="book_a_class" /> 
                       <input class="btn btn-primary _book_class" name="save" type="submit" value="<?php echo lang('book_a_class'); ?>"/>
                   </form>
                </div>     -->
            </div> 
        </div>
    </div>
</div>
