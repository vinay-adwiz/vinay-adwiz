            <div id="accordion" class="panel-group">
               
                <div class="panel">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="display-block" href="<?= STUDENT_PORTAL_URL ?>">
                                <?php echo lang('bf_home_page'); ?>
                            </a>
                        </h4>
                    </div>
                </div>

                <!-- <div class="panel">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="display-block" href="<?php echo site_url("users/packages/"); ?>">
                                <?php echo lang('bf_purchase_package'); ?>
                            </a>
                        </h4>
                    </div>
                </div> -->
<div class="panel">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" class="display-block" href="#Elements">
                                <?php echo lang('my_account'); ?>
                                <i class="glyph-icon icon-angle-right float-right"></i>
                            </a>
                        </h4>
                    </div>
                    <div id="Elements" class="panel-collapse <?php if (isset($menu_page_type) === false || (isset($menu_page_type) && $menu_page_type !== 'my_account')) echo 'collapse'; ?>">
                        <div class="panel-body">
                            <ul class="nav">
                                <li <?php if (@$menu_subpage_type == 'update_profile') echo 'class="active"'; ?>><a href="<?php echo site_url("users/profile/"); ?>" title="Buttons"><span><?php echo lang('update_personal_details'); ?></span></a></li>
                                <li <?php if (@$menu_subpage_type == 'change_password') echo 'class="active"'; ?>><a href="<?php echo site_url("users/password/"); ?>" title="Labels &amp; Badges"><span><?php echo lang('change_password'); ?></a></li>
                                <li <?php if (@$menu_subpage_type == 'manage_users') echo 'class="active"'; ?>><a href="<?php echo site_url("users/manage_users/"); ?>" title="Labels &amp; Badges"><span><?php echo lang('manage_users'); ?></a></li>
                                <li <?php if (@$menu_subpage_type == 'cancel_account') echo 'class="active"'; ?>><a href="<?php echo site_url("users/cancel/"); ?>" title="Labels &amp; Badges"><span><?php echo lang('bf_cancel_account'); ?></a></li>
                            </ul>
                        </div>
                    </div>
                </div>


                <div class="panel">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" class="display-block" href="#Elements2">
                                <?php echo lang('my_classes'); ?>
                                <i class="glyph-icon icon-angle-right float-right"></i>
                            </a>
                        </h4>
                    </div>
                    <div id="Elements2" class="panel-collapse <?php if (isset($menu_page_type) === false || (isset($menu_page_type) && $menu_page_type !== 'my_classes')) echo 'collapse'; ?>">
                        <div class="panel-body">
                            <ul class="nav">
                                <li <?php if (@$menu_subpage_type == 'view_teachers') echo 'class="active"'; ?>><a href="<?php echo site_url("profiles/teachers/"); ?>" title="Buttons"><span><?php echo lang('book_a_class'); ?></span></a></li>
                                <li <?php if (@$menu_subpage_type == 'upcoming_classes') echo 'class="active"'; ?>><a href="<?php echo site_url("users/upcoming_classes/"); ?>" title="Labels &amp; Badges"><span><?php echo lang('upcoming_classes'); ?></a></li>
                                <li <?php if (@$menu_subpage_type == 'completed_classes') echo 'class="active"'; ?>><a href="<?php echo site_url("users/completed_classes/"); ?>" title="Labels &amp; Badges"><span><?php echo lang('completed_classes'); ?></a></li>
                                <li <?php if (@$menu_subpage_type == 'my_feedback') echo 'class="active"'; ?>><a href="<?php echo site_url("users/feedback/"); ?>" title="Labels &amp; Badges"><span><?php echo lang('my_feedback'); ?></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="panel">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="display-block" href="<?php echo site_url("users/packages/"); ?>">
                                <?php echo lang('bf_purchase_package'); ?>
                            </a>
                        </h4>
                    </div>
                </div>

                <div class="panel">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="display-block" href="<?php echo site_url("users/referrals/"); ?>">
                                <?php echo lang('bf_referrals'); ?>
                            </a>
                        </h4>
                    </div>
                </div>


                <div class="panel">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="display-block" href="<?php echo site_url("logout"); ?>">
                                <?php echo lang('bf_action_logout'); ?>
                            </a>
                        </h4>
                    </div>
                </div>
            </div>