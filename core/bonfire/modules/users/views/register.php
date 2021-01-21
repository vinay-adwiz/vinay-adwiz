<?php

$errorClass   = empty($errorClass) ? ' error' : $errorClass;
$controlClass = empty($controlClass) ? 'span6' : $controlClass;
$fieldData = array(
    'errorClass'    => $errorClass,
    'controlClass'  => $controlClass,
);

?>
<style scoped='scoped'>
#register p.already-registered {
    text-align: center;
}
</style>
<div class="center-vertical">
    <div class="center-content row">
        
        <section id="register">
            <div class="row-fluid">
                <div class="span12">
                    <?php echo form_open(site_url(REGISTER_URL), array('class' => "form-horizontal col-md-4 col-sm-5 col-xs-11 col-lg-3 center-margin", 'autocomplete' => 'off', 'id'=>'register_form')); ?>
                        <h3 class="page-header text-center pad25B font-gray text-transform-upr font-size-23"><?php echo lang('register_online'); ?></h3>
                        <?php if (validation_errors()) : ?>
                        <div class="alert alert-error fade in">
                            <?php echo validation_errors(); ?>
                        </div>
                        <?php endif; ?>
                    <?php if (0) { ?>    
                        <div class="alert alert-info fade in">
                            <h4 class="alert-heading"><?php echo lang('bf_required_note'); ?></h4>
                            <?php
                            if (isset($password_hints)) {
                                echo $password_hints;
                            }
                            ?>
                        </div>
                    <?php } ?>    
                        <div id="register-form" class="content-box bg-default">
                            
                            <div class="content-box-wrapper pad20A">
                                
                                <img class="mrg25B center-margin display-block" src="<?= base_url(); ?>assets/image-resources/gravatar.jpg" alt="">
                                <div class="message"></div>
                                <div class="lang-select"><a href="<?php echo STUDENT_PORTAL_URL; ?>register/?lang=en">EN</a> | <a href="<?php echo STUDENT_PORTAL_URL; ?>register">ไทย</a> | <a href="<?php echo STUDENT_PORTAL_URL; ?>register/?lang=zh">中文</a></div>
                                <?php Template::block('user_fields', 'user_fields', $fieldData); ?>
                                
                                <div class="form-group">
                                    <?php
                                    // Allow modules to render custom fields. No payload is passed
                                    // since the user has not been created, yet.
                                    Events::trigger('render_user_form');
                                    ?>
                                    <!-- Start of User Meta -->
                                    <?php $this->load->view('users/user_meta', array('frontend_only' => true)); ?>
                                    <!-- End of User Meta -->
                                </div>
                                
                                <div class="form-group">
                                    <input class="btn btn-primary btn-block" type="submit" name="register" id="submit" value="<?php echo lang('us_register'); ?>" />
                                
                                  <!--   <center>OR</center>
                                    
                                    <a href="<?php echo $authUrl; ?>" class="fb_register btn btn-block btn-info" style="width:100%; margin: 0px auto; margin-bottom: 29px;">
                                        <?php echo lang('signup_with_fb'); ?>
                                    </a>
                                     -->
                                     <br />
                                    <p class='already-registered'>
                                        <?php echo lang('us_already_registered'); ?>
                                        <?php echo anchor(LOGIN_URL, lang('bf_action_login')); ?>
                                    </p>
                                </div>
                                
                            </div>
                            
                        </div>
                        
                    <?php echo form_close(); ?>
                    
                </div>
            </div>
        </section>
        
    </div><!-- // center-content -->
</div> <!-- // center-vertical -->
