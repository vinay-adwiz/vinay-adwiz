<div class="center-vertical">


    <div class="center-content row">

        <?php echo form_open($this->uri->uri_string(), array('class' => "col-md-4 col-sm-5 col-xs-11 col-lg-3 center-margin", 'autocomplete' => 'off')); ?>
        
        	<input type="hidden" name="user_id" value="<?php echo $user->id ?>" />
            <h3 class="text-center pad25B font-gray text-transform-upr font-size-23"><?php echo lang('us_reset_password'); ?></h3>
            <div id="login-form" class="content-box bg-default">
                
                <div class="content-box-wrapper pad20A">
                    <img class="mrg25B center-margin radius-all-100 display-block" src="<?= base_url(); ?>assets/image-resources/gravatar.jpg" alt="">
                    <?php echo Template::message(); ?>
                    <?php if (validation_errors()) : ?>
						<div class="alert alert-error fade in">
							<?php echo validation_errors(); ?>
						</div>
					<?php endif; ?>


                    <div class="alert alert-info fade in">
						<?php echo lang('us_reset_password_note'); ?>
					</div>

                    <div class="form-group">
                        <div class="input-group">
                            <input type="password" name="password" id="password" value="" placeholder="Password...." class="form-control" tabindex="1"  />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="password" name="pass_confirm" id="pass_confirm" value="" placeholder="<?php echo lang('bf_password_confirm'); ?>" class="form-control" tabindex="2"  />
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="set_password" id="submit"  value="<?php e(lang('us_set_password')); ?>" tabindex="3"  class="btn btn-block btn-primary" />
                    </div>
                </div>
            </div>

        <?php echo form_close(); ?>

    </div>
</div>
