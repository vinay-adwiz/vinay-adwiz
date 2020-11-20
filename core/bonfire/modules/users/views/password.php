
<?php

$errorClass   = empty($errorClass) ? ' error' : $errorClass;
$controlClass = empty($controlClass) ? 'span6' : $controlClass;
$fieldData = array(
    'errorClass'   => $errorClass,
    'controlClass' => $controlClass,
);

if (isset($password_hints)) {
    $fieldData['password_hints'] = $password_hints;
}

// In order for $renderPayload to be set properly, the order of the isset() checks
// for $current_user, $user, and $this->auth should be maintained. An if/elseif
// structure could be used for $renderPayload, but the separate if statements would
// still be needed to set $fieldData properly.
$renderPayload = null;
if (isset($current_user)) {
    $fieldData['current_user'] = $current_user;
    $renderPayload = $current_user;
}
if (isset($user)) {
    $fieldData['user'] = $user;
    $renderPayload = $user;
}
if (empty($renderPayload) && isset($this->auth)) {
    $renderPayload = $this->auth->user();
}

?>

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
                <h2><?php e(lang('change_password')); ?></h2>
                <p>&nbsp;</p>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <div class="panel">
                        <div class="panel-body">
                            <h3 class="title-hero">
                               <?php e(lang('my_password')); ?>
                            </h3>
                            <p> <?php echo Template::message(); ?>
                            <div class="example-box-wrapper">
                                <?php echo form_open($this->uri->uri_string(), array('class' => 'form-horizontal bordered-row', 'autocomplete' => 'off')); ?>
                                     <?php if(!empty($user_details) && $user_details->is_fb_pass == 0){ ?>
                                         <div class="form-group <?php echo form_error('old_password') ? 'has-error' : ''; ?>">
                                            <label class="col-sm-3 control-label"><?php e(lang('old_password')); ?></label>
                                            <div class="col-sm-6">
                                                <input type="password" name="old_password" id="old_password"  class="form-control" value="<?php echo set_value('old_password'); ?>" placeholder="<?php e(lang('enter_old_password')); ?>">
                                                <?php echo form_error('old_password', '<div class="alert alert-error">', '</div>'); ?>
                                            </div>
                                        </div> 
                                    <?php } ?> 
                                    <div class="form-group <?php echo form_error('password') ? 'has-error' : ''; ?>">
                                        <label class="col-sm-3 control-label"><?php e(lang('new_password')); ?></label>
                                        <div class="col-sm-6">
                                            <input type="password" name="password" class="form-control" value="<?php echo set_value('password'); ?>" placeholder="<?php e(lang('enter_new_password')); ?>">
                                            <?php echo form_error('password', '<div class="alert alert-error">', '</div>'); ?>
                                        </div>
                                    </div>                                    
                                    <div class="form-group <?php echo form_error('pass_confirm') ? 'has-error' : ''; ?>">
                                        <label class="col-sm-3 control-label"><?php e(lang('confirm_password')); ?></label>
                                        <div class="col-sm-6">
                                            <input type="password" name="pass_confirm" id="pass_confirm"  class="form-control" value="<?php echo set_value('pass_confirm'); ?>" placeholder="<?php e(lang('confirm_new_password')); ?>">
                                            <?php echo form_error('pass_confirm', '<div class="alert alert-error">', '</div>'); ?>
                                        </div>
                                    </div>
                                         
                                    <div class="form-group">
                                        <input type="hidden" name="set_password" value="1" />
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