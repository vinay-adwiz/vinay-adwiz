
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
                <h2><?php e(lang('cancel_class')); ?></h2>
                <p>&nbsp;</p>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <div class="panel">
                        <div class="panel-body">
                            <h3 class="title-hero">
                                <?= @$curriculum_details['topic'] ?>
                            </h3>
                            <p class="title-hero">
<?php
                                if ($is_chargeable) {
                                    e(lang('cancellation_paid'));
                                } else {
                                    e(lang('cancellation_free'));
                                }
                        ?>    
                            </p>    
                            <p> <?php echo Template::message(); ?></p>
                            <div class="example-box-wrapper">
                        <?php echo form_open($this->uri->uri_string(), array('class' => 'form-horizontal bordered-row', 'autocomplete' => 'off')); ?>
                             <div class="form-group <?php echo form_error('cancellation_reason') ? 'has-error' : ''; ?>">
                                <label class="col-sm-3 control-label"><?php e(lang('cancellation_reason')); ?></label>
                                <div class="col-sm-6">
                        <?php
                                    $cancellation_reason = isset($_POST['cancellation_reason']) ? $_POST['cancellation_reason'] : '';
                        ?>           
                                    <textarea class="form-control" name="cancellation_reason" id="cancellation_reason" value="<?= $cancellation_reason ?>" placeholder="<?php e(lang('cancellation_reason_help')); ?>"><?= $cancellation_reason ?></textarea> 
                                    <?php echo form_error('cancellation_reason', '<div class="alert alert-error">', '</div>'); ?>
                                </div>
                            </div>
                        <?php
                                if ($is_chargeable) :
                        ?>    
                                    <div class="form-group <?php echo form_error('accept_checkbox') ? 'has-error' : ''; ?>">
                                        <div class="col-sm-3">&nbsp;</div>
                                        <div class="col-sm-6">
                                <?php
                                            $accept_checkbox = isset($_POST['accept_checkbox']) ? $_POST['accept_checkbox'] : '';
                                ?>           
                                            <input type="checkbox" name="accept_checkbox" value="accept" id="accept_checkbox" /> <label class="control-label"><?php e(lang('cancellation_paid_accept')); ?></label>
                                            <?php echo form_error('accept_checkbox', '<div class="alert alert-error">', '</div>'); ?>
                                        </div>
                                    </div>
                        <?php
                                endif;
                        ?>
                            <input type="hidden" name="process_cancel" value="1" />
                            <div class="form-group">
                                <div class="col-sm-12 control-label"><input class="btn btn-primary"  name="save" type="submit" value="<?php e(lang('submit')); ?>"></div>
                            </div>
                        <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
