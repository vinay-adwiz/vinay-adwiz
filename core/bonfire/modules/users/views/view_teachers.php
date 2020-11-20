<div class="hero-box hero-box-smaller full-bg-13 font-inverse" data-top-bottom="background-position: 50% 0px;" data-bottom-top="background-position: 50% -600px;">
    <div class="container">
        <h1 class="hero-heading wow fadeInDown" data-wow-duration="0.6s"><?php e(lang('bf_view_available_teachers')); ?></h1>
    </div>
    <div class="hero-overlay bg-black"></div>
</div>

<!-- Mixitup -->

<script type="text/javascript" src="<?= base_url(); ?>assets/widgets/mixitup/mixitup.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/widgets/mixitup/images-loaded.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/widgets/mixitup/isotope.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/widgets/mixitup/portfolio-demo.js"></script>
<!-- Modal -->
<div id="loader_modal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="background: rgba(0,0,0,0.5);">
    <div class="modal-body" style="top: 40%;">
        <img src="<?php echo base_url('themes/englishgang/images/loader.gif') ?>" width="100px;" style="margin: auto;display: block;"/>
    </div>
</div>

<div class="portfolio-controls portfolio-nav-alt bg-blue clearfix controls">
    <div class="container text-center">
        <ul class="float-none">
            <li class="filter"><a href="<?= STUDENT_PORTAL_URL ?>" style="color: #fff;"><span class="glyph-icon icon-home" style="font-size: 17px;"></span> <?php e(lang('bf_home_page')); ?></a></li>
            <?php
            
            $is_fav = false;

            if (empty($teachers) === false) :
                foreach($teachers as $teacher){
                    
                    if($is_fav == false){

                        if($teacher['is_favorite'] == 1){
                            
                            $hover_class_fav = 'hover_1';
                            $hover_class_male = 'hover_3';
                            $hover_class_female = 'hover_4';
                            $hover_class_all = 'hover_2';
                            
                            $data_cat_fav = '1';
                            $data_cat_male = '3';
                            $data_cat_female = '4';
                            $data_cat_all = '2';
                            
                            echo '<li class="filter active" data-filter="'.$hover_class_fav.'">'.lang('my_favorites').'</li><li class="filter" data-filter="'.$hover_class_all.'">'.lang('bf_view_all_teachers').'</li>';
                            
                            $is_fav = true;
                            
                        }
                        
                    }
                    
                }
            endif; // check empty teachers
            
            $preff_teacher_gender = '';
            
            if($is_fav == false){
                
                $hover_class_fav = 'hover_4';
                $hover_class_male = 'hover_2';
                $hover_class_female = 'hover_3';
                $hover_class_all = 'hover_1';
                
                $data_cat_fav = '4';
                $data_cat_male = '2';
                $data_cat_female = '3';
                $data_cat_all = '1';
                
                echo '<li class="filter" data-filter="'.$hover_class_fav.'">'.lang('my_favorites').'</li><li class="filter active" data-filter="'.$hover_class_all.'">'.lang('bf_view_all_teachers').'</li>';
                
            }//$is_fav == false
            
            
            ?>
        </ul>
    </div>
</div>

<div class="container">

    

    <ul id="portfolio-grid" class="reset-ul teachers-list">
<?php

    // Load all favorite teachers
    if (empty($teachers) === false) {

        $count = 0;
        foreach ($teachers as $key => $val) :
            if($val['is_teacher_in_selected_daterange'] == true){
                if ((@$val['is_favorite'] == 1 && @$val['details']['meta']->unavailable_teach == '0') || (@$val['is_favorite'] == 1 && $is_assessment === true)) {
                
                    $count++;
    ?>
                    <li class="teacher-list mix <?php echo $hover_class_fav; ?>" data-cat="<?php echo $data_cat_fav; ?>">
                        <div class="thumbnail-box-wrapper">
                            <div class="thumbnail-box">
    <?php
                            if ($is_assessment === false || ($is_assessment && @$val['details']['meta']->allow_assessment == '1')) { ?>
                                <a class="thumb-link" href="<?php echo site_url("profiles/teacher/" . $val['id']); ?>" title=""></a>
                                <div class="thumb-content">
                                    <div class="center-vertical">
                                        <div class="center-content">
                                            <i class="icon-helper icon-center animated zoomInUp font-white glyph-icon icon-linecons-camera"></i>
                                        </div>
                                    </div>
                                </div>
    <?php                            
                            } else {
    ?>
                                <div class="thumb-content">
                                    <div class="center-vertical">
                                        <div class="center-content">
                                            <span class="unavail-center  animated zoomInUp font-white"><?= lang('unavailable_asseements') ?></span>
                                        </div>
                                    </div>
                                </div>
    <?php                            
                            }
    
    ?>
                                <div class="thumb-overlay bg-black"></div>
    <?php
                            if (empty($val['details']['avatar'])) {
    ?>
                                <img src="<?= base_url(); ?>assets/images/default-avatar.jpg" alt="<?= @$val['details']['meta']->first_name ?> <?= @$val['details']['meta']->last_name ?>">
    <?php                            
                            }   else {
    ?>                    
                            <img src="<?= TEACHER_PORTAL_URL ?><?= @$val['details']['avatar'] ?>" alt="<?= @$val['details']['meta']->first_name ?> <?= @$val['details']['meta']->last_name ?>">
    <?php                   } ?>    
                            </div>
                            <div class="thumb-pane">
                                <h3 class="thumb-heading animated rollIn">
                                    <?php   if ($val['is_favorite']) { ?> <i class="glyph-icon icon-star gold"></i><?php } ?>
    
    <?php
                                    if ($is_assessment === false || ($is_assessment && @$val['details']['meta']->allow_assessment == '1')) { ?>
                                        <a href="<?php echo site_url("profiles/teacher/" . $val['id']); ?>">
    <?php                           } ?>                                    
                                        <?= @$val['details']['meta']->first_name ?> <?= @$val['details']['meta']->last_name ?>
    <?php
                                    if ($is_assessment === false || ($is_assessment && @$val['details']['meta']->allow_assessment == '1')) { ?>
                                        </a>
    <?php                           } ?> 
    
    
                                    <p><?php e(lang('bf_profile_highlight')); ?>: <?= @$val['details']['public_profile']->highlight ?></p>
                                </h3>
                            </div>
                        </div>
                    </li>
    <?php       }
            }//is_teacher_in_selected_daterange

        endforeach;

        if ($count === 0) {
?>
            <li class="teacher-list mix <?php echo $hover_class_fav; ?>" data-cat="<?php echo $data_cat_fav; ?>" style="box-shadow: none;">
                <?php e(lang('favs_not_set')); ?>
            </li>
<?php
        }
    } // my_fav
    
    
    
    // Load all teachers
    if (empty($teachers)) {
?>
        <?php e(lang('bf_no_teachers')); ?>
<?php
    } else {    
        $is_avaiable_teacher = false;
        
        foreach ($teachers as $key => $val) :
        
            if($val['is_teacher_in_selected_daterange'] == true){
                if (@$val['details']['meta']->unavailable_teach == '0' || $is_assessment === true ) : 
?>
                    <li class="teacher-list mix <?php echo $hover_class_all; ?>" data-cat="<?php echo $data_cat_all; ?>">
                        <div class="thumbnail-box-wrapper">
                            <div class="thumbnail-box">
        <?php
                                if ($is_assessment === false || ($is_assessment && @$val['details']['meta']->allow_assessment == '1')) { ?>
                                    <a class="thumb-link" href="<?php echo site_url("profiles/teacher/" . $val['id']); ?>" title=""></a>
                                    <div class="thumb-content">
                                        <div class="center-vertical">
                                            <div class="center-content">
                                                <i class="icon-helper icon-center animated zoomInUp font-white glyph-icon icon-linecons-camera"></i>
                                            </div>
                                        </div>
                                    </div>
        <?php                            
                                } else {
        ?>
                                    <div class="thumb-content">
                                        <div class="center-vertical">
                                            <div class="center-content">
                                                <span class="unavail-center  animated zoomInUp font-white"><?= lang('unavailable_asseements') ?></span>
                                            </div>
                                        </div>
                                    </div>
        <?php                            
                                }
        
        ?>
                                <div class="thumb-overlay bg-black"></div>
        <?php
                                if (empty($val['details']['avatar'])) {
        ?>
                                    <img src="<?= base_url(); ?>assets/images/default-avatar.jpg" alt="<?= @$val['details']['meta']->first_name ?> <?= @$val['details']['meta']->last_name ?>">
        <?php                            
                                }   else {
        ?>                    
                                <img src="<?= TEACHER_PORTAL_URL ?><?= @$val['details']['avatar'] ?>" alt="<?= @$val['details']['meta']->first_name ?> <?= @$val['details']['meta']->last_name ?>">
        <?php                   } ?>                        
                            </div>
                            <div class="thumb-pane">
                                <h3 class="thumb-heading animated rollIn">
                                    <?php   if ($val['is_favorite']) { ?> <i class="glyph-icon icon-star gold"></i><?php } ?>
        <?php
                                        if ($is_assessment === false || ($is_assessment && @$val['details']['meta']->allow_assessment == '1')) { ?>
                                            <a href="<?php echo site_url("profiles/teacher/" . $val['id']); ?>">
        <?php                           } ?>                                    
                                            <?= @$val['details']['meta']->first_name ?> <?= @$val['details']['meta']->last_name ?>
        <?php
                                        if ($is_assessment === false || ($is_assessment && @$val['details']['meta']->allow_assessment == '1')) { ?>
                                            </a>
        <?php                           } ?> 
                                    <p><?php e(lang('bf_profile_highlight')); ?>: <?= @$val['details']['public_profile']->highlight ?></p
                                </h3>
                            </div>
                        </div>
                    </li>
        <?php
                        $is_avaiable_teacher = true;
                endif; // end check if avail
            }//is_teacher_in_selected_daterange

        endforeach; 
        if($is_avaiable_teacher == false){
            ?>
            <li class="teacher-list mix <?php echo $hover_class_all; ?>" data-cat="<?php echo $data_cat_all; ?>" style=" box-shadow: none;">
                <?php echo lang('bf_no_teachers'); ?>
            </li> <?php            
        }
    }
?>

</ul>

<div class="row" style="padding-top: 50px;">
        <div class="col-md-6">
            <div class="panel">
                <div class="panel-body">
                    <h3 class="title-hero">
                        Preferred time
                    </h3>
                    <div class="example-box-wrapper">
                        <form class="form-horizontal bordered-row" role="form">
                            <div class="form-group">
                                <label for="" class="col-sm-4 control-label">I want to study between</label>
                                <div class="col-sm-8">
                                    <div class="input-prepend input-group">
                                        <span class="add-on input-group-addon">
                                            <i class="glyph-icon icon-calendar"></i>
                                        </span>
<?php                                   $start_date = date('d/m/Y'); 
                                        $end_date = date("d/m/Y", time() + 86400);
?>                                        
                                        <input type="text" name="daterangepicker-time" id="daterangepicker-time" class="form-control" value="<?= $start_date ?> - <?= $end_date ?>">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>        

<div style="clear: both;"></div>

</div>