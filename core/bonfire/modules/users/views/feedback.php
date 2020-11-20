
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
        <h1 class="hero-heading wow fadeInDown" data-wow-duration="0.6s"><?php e(lang('feedback')); ?></h1>
    </div>
    <div class="hero-overlay bg-black"></div>
</div>

<div id="page-content" class="col-md-8 center-margin frontend-components mrg25T">
    <div class="row">
        <div class="col-md-3 col-lg-2">
            <?php echo theme_view('sidemenu'); ?>
        </div>
        <div class="col-md-9 col-lg-10">
            <div id="page-title" style="border-bottom: none;">
                <h2><?php e(lang('my_feedback')); ?></h2>
                <p>&nbsp;</p>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <?php if(!empty($feedbacks)){
                            $i = 0;
                            foreach($feedbacks as $feedback){
                                ?>
                                <div class="col-md-6">
                                    <div class="testimonial-box">
                                        <div class="popover top">
                                            <div class="arrow float-right"></div>
                                           
                                            <div class="popover-content">
                                                <i class="glyph-icon icon-quote-left"></i>
                                                <p><?php echo $feedback['feedback']; ?></p>
                                                <div id="rateYo<?php echo $feedback['id'] ?>" style="margin: 0 auto;"></div>
                                                <script>
                                                    $(function () {
                                                      $("#rateYo"+"<?php echo $feedback['id'] ?>").rateYo({
                                                        rating: '<?php echo $feedback['rating'] ?>',
                                                        readOnly: true,
                                                        starWidth: "20px",
                                                      });
                                                    });
                                                </script>
                                            </div>
                                        </div>
                                        <div class="testimonial-author-wrapper">
                                            <div class="testimonial-author">
                                                <b><?php echo @$feedback['teacher']->first_name.' '.@$feedback['teacher']->last_name; ?></b>
                                                <span>
                                                    <?php echo @$feedback['curriculum']->topic; ?>
                                                    <?php 
                                                    if (isset($feedback['class']->class_start_date) && isset($feedback['class']->class_start_time)) {
                                                        echo ' - ' . format_class_date_time($feedback['class']->class_start_date, $feedback['class']->class_start_time);
                                                    }
                                                    ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $i = $i+1;
                                if($i%2 == '0'){
                                    echo '<div class="clearfix"></div>';
                                }
                            }
                        }//$feedbacks
                        else{
                            ?>
                            <div class="col-md-12">
                                <?php
                                e(lang('no_feedback'));
                                ?>
                            </div>
                            <?php
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
