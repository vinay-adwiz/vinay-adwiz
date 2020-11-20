
<div class="hero-box hero-box-smaller full-bg-13 font-inverse" data-top-bottom="background-position: 50% 0px;" data-bottom-top="background-position: 50% -600px;">
    <div class="container">
        <h1 class="hero-heading wow fadeInDown" data-wow-duration="0.6s"><?php e(lang('my_account')); ?></h1>
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
                <h2><?php e(lang('bf_cancel_account')); ?></h2>
                <p>&nbsp;</p>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <div class="panel">
                        <div class="panel-body">
                            <div class="message"></div>
                            <p class="title-hero">
                                <?php e(lang('cancel_instructions')); ?> 
<?php                                
                                 if (empty($current_package) === false) {
                                    echo ' ';
                                    e(sprintf(lang('packages_available'), $current_package[0]['remaining_classes']));
                                    echo ' ';
                                    e(lang('cancel_lose')); 
                                }
                        ?>
                            </p>
                            
                            <p>&nbsp;</p>
                            <div class="example-box-wrapper">
                            <?php echo form_open($this->uri->uri_string(), array('class' => 'form-horizontal bordered-row', 'autocomplete' => 'off')); ?>
                            <?php
                                $reason = isset($_POST['reason']) ? $_POST['reason'] : '';
                        ?>                                     
                                <div class="form-group <?php echo form_error('reason') ? 'has-error' : ''; ?>">
                                    <label class="col-sm-3 control-label" for="reason"><?php e(lang('cancellation_reason')); ?></label>
                                    <div class="col-sm-6">
                                        <textarea class="form-control" name="reason" id="reason" placeholder="<?php e(lang('enter_reason')); ?>"><?=$reason ?></textarea>
                                        <?php echo form_error('reason', '<div class="alert alert-error">', '</div>'); ?>
                                    </div>
                                </div>
                                
<?php                           if (empty($current_package) === false && $current_package[0]['eligible_refund'] == 1) { 
?>
                                <div class="form-group <?php echo form_error('accept_checkbox') ? 'has-error' : ''; ?>">
                                    <div class="col-sm-3">&nbsp;</div>
                                    <div class="col-sm-6">
                            <?php
                                        $request_refund = isset($_POST['request_refund']) ? $_POST['request_refund'] : '';
                            ?>           
                                        <input type="checkbox" name="request_refund" value="refund" id="request_refund" /> <label class="control-label"><?php e(lang('request_a_refund')); ?></label>
                                        <?php echo form_error('request_refund', '<div class="alert alert-error">', '</div>'); ?>
                                    </div>
                                </div>
<?php                           } ?>
                                <div class="form-group <?php echo form_error('accept_checkbox') ? 'has-error' : ''; ?>">
                                    <div class="col-sm-3">&nbsp;</div>
                                    <div class="col-sm-6">
                            <?php
                                        $accept_checkbox = isset($_POST['accept_checkbox']) ? $_POST['accept_checkbox'] : '';
                            ?>           
                                        <input type="checkbox" name="accept_checkbox" value="accept" id="accept_checkbox" /> <label class="control-label"><?php e(lang('cancellation_accept')); ?></label>
                                        <?php echo form_error('accept_checkbox', '<div class="alert alert-error">', '</div>'); ?>
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
