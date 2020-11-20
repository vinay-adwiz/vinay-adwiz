
<div class="center-vertical">


    <div class="center-content row">

        <?php echo form_open($this->uri->uri_string(), array('class' => "col-md-4 col-sm-5 col-xs-11 col-lg-3 center-margin", 'autocomplete' => 'off')); ?>

            <h3 class="text-center pad25B font-gray text-transform-upr font-size-23"><?php echo lang('us_reset_password'); ?></h3>
            <div id="login-form" class="content-box bg-default">
                
                <div class="content-box-wrapper pad20A">
                    <div class="lang-select"><a href="<?php echo STUDENT_PORTAL_URL; ?>forgot_password/?lang=en">EN</a> | <a href="<?php echo STUDENT_PORTAL_URL; ?>forgot_password">ไทย</a> | <a href="<?php echo STUDENT_PORTAL_URL; ?>forgot_password/?lang=zh">中文</a></div>
                    <img class="mrg25B center-margin radius-all-100 display-block" src="<?= base_url(); ?>assets/image-resources/gravatar.jpg" alt="">
                    <?php echo Template::message(); ?>
                    <div class="alert alert-info fade in">
						<?php echo lang('us_reset_note'); ?>
					</div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon addon-inside bg-gray">
                                <i class="glyph-icon icon-envelope-o"></i>
                            </span>
                            <input type="email" class="form-control" id="exampleInputEmail1" name="email" id="email" value="<?php echo set_value('email') ?>" tabindex="1" placeholder="Enter Email" />
                        </div>
                    </div>
                    <div class="form-group">
<?php                        
                        if (isset($_GET['lang'])) {
?>                          <input type="hidden" name="lang" value="<?= $_GET['lang'] ?>" /> <?php 
                        } else {
?>                          <input type="hidden" name="lang" value="thai" /> <?php 
                        }
?>
                        <input type="submit" name="send" value="<?php e(lang('us_send_password')); ?>" tabindex="2"  class="btn btn-block btn-primary" />
                    </div>
                </div>
            </div>

        <?php echo form_close(); ?>

    </div>
</div>