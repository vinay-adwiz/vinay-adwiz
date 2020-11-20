<div class="center-vertical">
    <div class="center-content row">
        <div class="col-md-4 col-sm-5 col-xs-11 col-lg-3 center-margin">
            <h3 class="text-center pad25B font-gray text-transform-upr font-size-23"><?php e(lang('en_ref_signup')); ?></h3>
            <div id="login-form" class="content-box bg-default">
                
                <div class="content-box-wrapper pad20A">
                    <img class="mrg25B center-margin radius-all-100 display-block" src="<?= base_url(); ?>assets/image-resources/gravatar.jpg" alt="">
                    <center>
                        <p><?php e(lang('eg_referrals')); ?></p>
                        <br />
                        <p><a href="<?= STUDENT_REGISTER_URL ?>?ref=<?= $ref_code ?>"><?= STUDENT_REGISTER_URL ?>?ref=<?= $ref_code ?></a>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>
