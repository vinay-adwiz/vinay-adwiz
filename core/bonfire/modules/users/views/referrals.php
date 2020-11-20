
<div class="hero-box hero-box-smaller full-bg-13 font-inverse" data-top-bottom="background-position: 50% 0px;" data-bottom-top="background-position: 50% -600px;">
    <div class="container">
        <h1 class="hero-heading wow fadeInDown" data-wow-duration="0.6s"><?php e(lang('bf_referrals')); ?></h1>
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
                <h2><?php e(lang('bf_manage_referrals')); ?></h2>
                <p>&nbsp;</p>
                <p> <?php echo Template::message(); ?></p>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <div class="panel">
                        <div class="panel-body">
                            <div class="scroll-columns">
<?php                       if ($referrer_code === false) : ?>                                
                                <p><?php e(lang('referral_not_set_up')); ?></p>
                                <p>&nbsp;</p>
                                <?php   echo form_open($this->uri->uri_string(), array('class' => 'form-horizontal bordered-row', 'autocomplete' => 'off', 'id' => 'referral_code')); ?>
                                    <input type="hidden" name="generate_code" value="1" />
                                    <button class="btn btn-info" type="submit"><i class="glyph-icon icon-users"></i> <?php e(lang('create_referral_code')); ?></button>             
                                <?php echo form_close(); ?> 
<?php                       else : ?>  
                                <p><?php e(lang('referral_instructions')); ?></p>
                                <p>&nbsp;</p>
                                <p><?php e(lang('your_referral_url')); ?>: <a href="<?= $register_url ?>" target="_blank"><?= $register_url ?></a></p>
                                                                <!-- social sharing -->
                                <?php $encoded_url = urlencode($register_url); ?>
                    <?php function isMobile() {
                                return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
                            }
                            
                     ?>
                                <ul class="sharing-ul">
                                    <li class="sharing-li share-fb">
                                        <a target="_blank" title="Share this page on FB" href="http://www.facebook.com/sharer.php?u=<?= $encoded_url; ?>"><img src="<?php echo site_url('assets/social-icons/fb-icon.png') ?>" alt="facebook"/></a>
                                    </li>
                                    <li class="sharing-li share-gplus">
                                        <a target="_blank"title="Share this page on G+"  href="https://plus.google.com/share?url=<?= $encoded_url; ?>"><img src="<?php echo site_url('assets/social-icons/gplus-icon.png') ?>" alt="google-plus"/></a>
                                    </li>
                                    <?php
                                    if(isMobile()){
                                        echo '<li class="sharing-li share-whatsapp"><a href="whatsapp://send?text='.$register_url.'"><img src="'.site_url('assets/social-icons/whatsapp-icon.png').'" alt="whatsapp"/></a></li>';
                                    }
                                    else{
                                        echo '<li class="sharing-li share-whatsapp"><a title="Share this page on WHATSAPP" target="_blank" href="https://web.whatsapp.com/send?text='.$register_url.'"><img src="'.site_url('assets/social-icons/whatsapp-icon.png').'" alt="whatsapp"/></a></li>';    
                                    }
                                    ?>
                                    
                                    <li class="sharing-li share-line">
                                        <div class="line-it-button" data-lang="en" data-type="share-c" data-url="<?= $register_url ?>" style="display: none;"></div>
                                    </li>
                                    <li class="sharing-li share-email">
                                        <a title="Share this page with EMAIL" href="mailto:?subject=ลงทะเบียนกับ English Gang&body=เรียนภาษาอังกฤษออนไลน์กับครูต่างชาติเจ้าของภาษาด้วยหลักสูตรที่มีประสิทธิภาพ คลิกที่นี่ เพื่อลงทะเบียนพร้อมทำแบบทดสอบวัดระดับความรู้ฟรี!  <?= $register_url; ?>"><img src="<?php echo site_url('assets/social-icons/email-icon.png') ?>" alt="email"/></a>
                                    </li>
                                </ul>
<?php                       endif; ?>                                


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
