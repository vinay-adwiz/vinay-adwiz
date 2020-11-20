
<div class="center-vertical">


    <div class="center-content row">

        <?php echo form_open(LOGIN_URL, array('autocomplete' => 'off', 'class' => 'col-md-4 col-sm-5 col-xs-11 col-lg-3 center-margin')); ?>
            <h3 class="text-center pad25B font-gray text-transform-upr font-size-23">English Gang <span class="opacity-80">Portal Login</span></h3>
            <div id="login-form" class="content-box bg-default">
                
                <div class="content-box-wrapper pad20A">
                    <img class="mrg25B center-margin radius-all-100 display-block" src="<?= base_url(); ?>assets/image-resources/gravatar.jpg" alt="">
                    <?php echo Template::message(); ?>
                    <div class="lang-select"><a href="<?php echo STUDENT_PORTAL_URL; ?>login/?lang=en">EN</a> | <a href="<?php echo STUDENT_PORTAL_URL; ?>login">ไทย</a> | <a href="<?php echo STUDENT_PORTAL_URL; ?>login/?lang=zh">中文</a></div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon addon-inside bg-gray">
                                <i class="glyph-icon icon-envelope-o"></i>
                            </span>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="<?php echo lang('bf_email'); ?>" name="login" id="login_value" value="<?php echo set_value('login'); ?>" tabindex="1" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon addon-inside bg-gray">
                                <i class="glyph-icon icon-unlock-alt"></i>
                            </span>
                            <input type="password" name="password" id="password" value="" tabindex="2" class="form-control" placeholder="<?php echo lang('my_password'); ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="log-me-in" id="submit" value="<?php echo lang('us_login'); ?>" tabindex="5"  class="btn btn-block btn-primary login-button" />
                        </a>
                    </div>
                    <div class="row">
                        <div class="checkbox-primary col-md-6" style="height: 20px;">
                            <?php if ($this->settings_lib->item('auth.allow_remember')) : ?>
                            <label>
                                <input type="checkbox" name="remember_me" id="remember_me" value="1" tabindex="3" class="custom-checkbox">
                                <?php echo lang('us_remember_note'); ?>
                            </label>
                        <?php endif; ?>

                            
                        </div>
                        <div class="text-right col-md-6">
                            <a href="<?= base_url(); ?>forgot_password" cla title="Recover password"><?php echo lang('us_forgot_your_password'); ?></a>
                        </div>
                    </div>
                </div>
            </div>

        <?php echo form_close(); ?>

    </div>
</div>


