
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
        <h1 class="hero-heading wow fadeInDown" data-wow-duration="0.6s"><?php e(lang('my_users')); ?></h1>
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
                <h2><?php e(lang('my_users')); ?></h2>
                <p>&nbsp;</p>
                <p> <?php echo Template::message(); ?></p>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <div class="panel">
                        <div class="panel-body">
                            <div class="scroll-columns">
                            <?php  echo form_open_multipart($this->uri->uri_string(), array('class' => 'form-horizontal', 'autocomplete' => 'off', 'id' => 'add_user_emails')); ?>
                            <div class="form-group <?php echo empty($email_error) ? '' : 'has-error'; ?>">
                                <div class="col-sm-12" style="margin-bottom: 10px;">
                                    <span class="control-label" for="users_emails"><?php e(lang('enter_emails')); ?></span>
                                </div>
                                <div class="col-sm-12">

                        <?php
                                if (isset($_POST['users_emails'])) {
                                    $users_emails = $_POST['users_emails'];
                                } else {
                                    if (empty($all_users) === false) {
                                        $users_emails = '';
                                        foreach ($all_users as $usr) {
                                            $users_emails .= ltrim($usr['email']) . "\n";
                                        }
                                    } else { 
                                        $users_emails = '';
                                    }
                                }
                        ?>            
                                    <textarea name="users_emails" rows="10" class="form-control textarea-counter" id="users_emails"><?= $users_emails ?></textarea>
                                    <?php echo form_error('users_emails', '<div class="alert alert-error">', '</div>'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12 control-label">
                                    <input name="process_user_emails" type="hidden" value="1">
                                    <input class="btn btn-primary"  name="save" type="submit" value="Submit">
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
</div>
