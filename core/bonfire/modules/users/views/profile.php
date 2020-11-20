
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
                <h2><?php e(lang('update_personal_details')); ?></h2>
                <p>&nbsp;</p>
                <?php /*if (validation_errors()) : ?>
                    <div class="alert alert-error">
                        <?php echo validation_errors(); ?>
                    </div>
                    <?php
                    endif;*/
                ?>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <div class="panel">
                        <div class="panel-body">
                            <h3 class="title-hero">
                                <?php e(lang('bf_user_settings')); ?>
                            </h3>
                            <p> <?php echo Template::message(); ?>
                            <div class="example-box-wrapper">
                                <?php echo form_open($this->uri->uri_string(), array('class' => 'form-horizontal bordered-row', 'autocomplete' => 'off')); ?>
                                     <div class="form-group <?php echo form_error('u_fname') ? 'has-error' : ''; ?>">
                                        <label class="col-sm-3 control-label"><?php e(lang('us_first_name')); ?></label>
                                        <div class="col-sm-6">
                                <?php
                                
                                        $first_name = isset($user->first_name) ? $user->first_name : '';
                                        $first_name = isset($_POST['u_fname']) ? $_POST['u_fname'] : $first_name;
                                ?>            
                                            <input type="text" class="form-control" name="u_fname" id="u_fname" value="<?=$first_name ?>" placeholder="<?php e(lang('us_last_name')); ?>">
                                            <?php echo form_error('u_fname', '<div class="alert alert-error">', '</div>'); ?>
                                        </div>
                                    </div>
                                <?php
                                        $last_name = isset($user->last_name) ? $user->last_name : '';
                                        $last_name = isset($_POST['u_lname']) ? $_POST['u_lname'] : $last_name;
                                ?>                                     
                                    <div class="form-group <?php echo form_error('u_lname') ? 'has-error' : ''; ?>">
                                        <label class="col-sm-3 control-label"><?php e(lang('us_last_name')); ?></label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="u_lname" id="u_lname" value="<?=$last_name ?>" placeholder="<?php e(lang('us_last_name')); ?>">
                                            <?php echo form_error('u_lname', '<div class="alert alert-error">', '</div>'); ?>
                                        </div>
                                    </div>
                                <?php
                                        $email = isset($user->email) ? $user->email : '';
                                        $email = isset($_POST['email']) ? $_POST['email'] : $email;
                                ?>     
                                    <div class="form-group <?php echo form_error('email') ? 'has-error' : ''; ?>">
                                        <label class="col-sm-3 control-label"><?php e(lang('bf_email')); ?></label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="email" name="email"  value="<?=$email ?>" placeholder="<?php e(lang('bf_email')); ?>">
                                            <?php echo form_error('email', '<div class="alert alert-error">', '</div>'); ?>
                                        </div>
                                    </div>
                                    
                               <?php
                                        $phone_number = isset($user->phone_number) ? $user->phone_number : '';
                                        $phone_number = isset($_POST['phone_number']) ? $_POST['phone_number'] : $phone_number;
                                ?>                                     
                                    <div class="form-group <?php echo form_error('phone_number') ? 'has-error' : ''; ?>">
                                        <label class="col-sm-3 control-label"><?php e(lang('bf_phn_no')); ?></label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="phone_number" id="phone_number" value="<?=$phone_number ?>" placeholder="<?php e(lang('bf_phn_no')); ?>">
                                            <?php echo form_error('phone_number', '<div class="alert alert-error">', '</div>'); ?>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="form-group <?php echo form_error('language') ? 'has-error' : ''; ?>">
                                        <label class="col-sm-3 control-label"><?php e(lang('bf_language')); ?></label>
                                        <div class="col-sm-6">
                                                <select class="form-control" name="language" id="language">
                                                    <option value=""><?php e(lang('bf_language')); ?></option>
                                                    
                                                    <?php
                                                        foreach($list_of_languages as $key => $language_list){
                                                            if(!empty($key)){
                                                                ?>
                                                                
                                                                <option value="<?php echo $language_list['name']; ?>" <?php echo ((isset($user->language))?((trim($user->language) == $language_list['name'])?'selected="selected"':''):"");?>><?php echo $key; ?></option>
                                                                
                                                                <?php
                                                               
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                            <?php echo form_error('language', '<div class="alert alert-error">', '</div>'); ?>
                                        </div>
                                    </div>
                                    
                                <?php
                                        $facebook_id = isset($user->facebook_id) ? $user->facebook_id : '';
                                        $facebook_id = isset($_POST['facebook_id']) ? $_POST['facebook_id'] : $facebook_id;
                                ?>    
                                    <div class="form-group <?php echo form_error('facebook_id') ? 'has-error' : ''; ?>">
                                        <label class="col-sm-3 control-label">Facebook ID</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="facebook_id" id="facebook_id" value="<?=$facebook_id ?>" placeholder="Enter Facebook ID">
                                            <?php echo form_error('facebook_id', '<div class="alert alert-error">', '</div>'); ?>
                                        </div>
                                    </div>
                                <?php
                                        $line_id = isset($user->line_id) ? $user->line_id : '';
                                        $line_id = isset($_POST['line_id']) ? $_POST['line_id'] : $line_id;
                                ?>  
                                        
                                    <div class="form-group <?php echo form_error('line_id') ? 'has-error' : ''; ?>">
                                        <label class="col-sm-3 control-label">LINE ID</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="line_id" id="line_id" value="<?=$line_id ?>" placeholder="Enter LINE ID">
                                            <?php echo form_error('line_id', '<div class="alert alert-error">', '</div>'); ?>
                                        </div>
                                    </div>
                                    
                                <?php
                                        $address_1 = isset($user->address_1) ? $user->address_1 : '';
                                        $address_1 = isset($_POST['address_1']) ? $_POST['address_1'] : $address_1;
                                ?>  
                                        
                                    <div class="form-group <?php echo form_error('address_1') ? 'has-error' : ''; ?>">
                                        <label class="col-sm-3 control-label"><?php e(lang('us_address_1')); ?></label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="address_1" id="address_1" value="<?=$address_1 ?>" placeholder="<?php e(lang('us_address_1')); ?>">
                                            <?php echo form_error('address_1', '<div class="alert alert-error">', '</div>'); ?>
                                        </div>
                                    </div>    
                               
                               <?php
                                        $address_2 = isset($user->address_2) ? $user->address_2 : '';
                                        $address_2 = isset($_POST['address_2']) ? $_POST['address_2'] : $address_2;
                                ?>  
                                        
                                    <div class="form-group <?php echo form_error('address_2') ? 'has-error' : ''; ?>">
                                        <label class="col-sm-3 control-label"><?php e(lang('us_address_2')); ?></label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="address_2" id="address_2" value="<?=$address_2 ?>" placeholder="<?php e(lang('us_address_2')); ?>">
                                            <?php echo form_error('address_2', '<div class="alert alert-error">', '</div>'); ?>
                                        </div>
                                    </div>     

                                    <div class="form-group <?php echo form_error('select_country') ? 'has-error' : ''; ?>">
                                        <label class="col-sm-3 control-label"><?php e(lang('us_country')); ?></label>
                                        <div class="col-sm-6">
                                                <select class="form-control" name="select_country" id="select_country">
                                                    <option value=""><?php e(lang('us_country')); ?></option>
                                                    
                                                    <?php
                                                        foreach($list_of_countries as $key => $countries_list){
                                                            if(!empty($key)){
                                                                ?>
                                                                
                                                                <option value="<?php echo $key; ?>" <?php echo ((isset($user->country))?((trim($user->country) == $key)?'selected="selected"':''):"");?>><?php echo $countries_list['printable']; ?></option>
                                                                
                                                                <?php
                                                               
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                            <?php echo form_error('select_country', '<div class="alert alert-error">', '</div>'); ?>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group <?php echo form_error('select_state') ? 'has-error' : ''; ?>">
                                        <label class="col-sm-3 control-label"><?php e(lang('us_state')); ?></label>
                                        <div class="col-sm-6 select_state_div">
                                           <?php
                                           $selected_country = isset($user->country)?$user->country:'';
                                           if(!empty($selected_country)){
                                                $list_of_states = !empty($list_of_states[$selected_country])?$list_of_states[$selected_country]:'';
                                                if(!empty($list_of_states)){
                                                
                                           ?>
                                                   <select class="form-control" name="select_state" id="select_state">
                                                        <option value=""><?php e(lang('us_state')); ?></option>
                                                        
                                                        <?php
                                                        
                                                            foreach($list_of_states as $key => $states_list){
                                                                if(!empty($key)){
                                                                    
                                                                    ?>
                                                                    <option value="<?php echo $key; ?>" <?php echo ((isset($user->state))?((trim($user->state) == $key)?'selected="selected"':''):"");?>><?php echo $states_list; ?></option>
                                                                    
                                                                    <?php
                                                                }
                                                            }
                                                           ?>
                                                   </select>
                                           <?php
                                                }else{
                                                    echo '<input type="text" class="form-control" placeholder="'.lang('bf_select_state').'" name="select_state" id="select_state" value="'.$user->state.'" />';
                                                }
                                           } 
                                           else{
                                                echo '<input type="text" class="form-control" placeholder="'.lang('bf_select_state').'" name="select_state" id="select_state" />';
                                           }
                                                
                                           ?>
                                            
                                            <?php echo form_error('select_state', '<div class="alert alert-error">', '</div>'); ?>
                                        </div>
                                    </div>   
                                    
                                    
                                    <?php
                   
                                        $city = isset($user->city) ? $user->city : '';
                                        $city = isset($_POST['city']) ? $_POST['city'] : $city;
                                    ?>                                     
                                    <div class="form-group <?php echo form_error('city') ? 'has-error' : ''; ?>">
                                        <label class="col-sm-3 control-label"><?php e(lang('us_city')); ?></label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="city" id="city" value="<?=$city ?>" placeholder="<?php e(lang('us_city')); ?>">
                                            <?php echo form_error('city', '<div class="alert alert-error">', '</div>'); ?>
                                        </div>
                                    </div>
                                    
                                    <?php
                                        $post_code = isset($user->post_code) ? $user->post_code : '';
                                        $post_code = isset($_POST['post_code']) ? $_POST['post_code'] : $post_code;
                                ?>  
                                        
                                    <div class="form-group <?php echo form_error('post_code') ? 'has-error' : ''; ?>">
                                        <label class="col-sm-3 control-label"><?php e(lang('us_zipcode')); ?></label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="post_code" id="post_code" value="<?=$post_code ?>" placeholder="<?php e(lang('us_zipcode')); ?>">
                                            <?php echo form_error('post_code', '<div class="alert alert-error">', '</div>'); ?>
                                        </div>
                                    </div>  
                                        
                                    <div class="form-group <?php echo form_error('select_timezone') ? 'has-error' : ''; ?>">
                                        <label class="col-sm-3 control-label"><?php e(lang('bf_timezone')); ?></label>
                                        <div class="col-sm-6 select_timezone_div">
                                           
                                            <select class="form-control" name="select_timezone" id="select_timezone">
                                                <option value=""><?php e(lang('bf_timezone')); ?></option>
                                                
                                                <?php
                                                
                                                $selected_country = isset($user->country)?$user->country:'';
                                                if(!empty($selected_country)){
                                                    $timezone_array = \DateTimeZone::listIdentifiers(\DateTimeZone::PER_COUNTRY, $selected_country);
                                                    if(!empty($timezone_array)){
                                                        $count_timezone = count($timezone_array);
                                                        for($i=0;$i<$count_timezone;$i++){ ?>

                                                            <option value="<?php echo $timezone_array[$i]; ?>" <?php echo ((isset($user->timezone))?((trim($user->timezone) == $timezone_array[$i])?'selected="selected"':''):"");?>><?php echo $timezone_array[$i]; ?></option>
                                                                
                                                        <?php
                                                        }
                                                    
                                                    }
                                                    else{
                                                        
                                                    }
                                                        
                                                }
                                                else{
                                                    
                                                }
                                                
                                                ?>
                                            </select>
                                            <?php echo form_error('select_timezone', '<div class="alert alert-error">', '</div>'); ?>
                                        </div>
                                    </div>
                                    <p>&nbsp;</p>
                                    <h3 class="title-hero">
                                        My Child's Details
                                    </h3>
                                    <?php
                   
                                        $child_dob = isset($user->child_dob) ? $user->child_dob : '';
                                        $child_dob = isset($_POST['child_dob']) ? $_POST['child_dob'] : $child_dob;
                                    ?>  
                                    <div class="form-group <?php echo form_error('child_dob') ? 'has-error' : ''; ?>">
                                        <label class="col-sm-3 control-label"><?php e(lang('childs_dob')); ?></label>
                                        <div class="col-sm-6">
                                            <div class="input-group date form_date col-md-5" data-date="" data-date-format="dd/mm/yyyy" data-link-field="child_dob" data-link-format="dd/mm/yyyy">
                                                <input class="form-control" size="16" type="text" value="<?= $child_dob ?>" readonly>
                                                <span class="input-group-addon"><span class="glyph-icon icon-close glyphicon-remove"></span></span>
                                                <span class="input-group-addon"><span class="glyph-icon icon-calendar glyphicon-calendar"></span></span>
                                            </div>
                                            <input type="hidden" name="child_dob" id="child_dob" value="<?= $child_dob ?>" /><br/>
                                            <?php echo form_error('child_dob', '<div class="alert alert-error">', '</div>'); ?>
                                        </div>
                                    </div>

                                    <?php
                                        $child_gender = isset($user->child_gender) ? $user->child_gender : '';
                                        $child_gender = isset($_POST['child_gender']) ? $_POST['child_gender'] : $child_gender;
                                    ?>  
                                    <div class="form-group <?php echo form_error('child_gender') ? 'has-error' : ''; ?>">
                                        <label class="col-sm-3 control-label" for="child_gender"><?php e(lang('childs_gender')); ?></label>
                                        <div class="col-sm-6">
                                            <select class="form-control" name="child_gender" id="child_gender">
                                                <option value=""><?php e(lang('gender')); ?></option>
                                                <option value="male" <?php if ($child_gender == 'male') echo 'selected="selected"'; ?>><?php e(lang('bf_male')); ?></option>
                                                <option value="female" <?php if ($child_gender == 'female') echo 'selected="selected"'; ?>><?php e(lang('bf_female')); ?></option>
                                            </select>
                                            <?php echo form_error('child_gender', '<div class="alert alert-error">', '</div>'); ?>
                                        </div>     
                                    </div>

                                    <?php
                                        $child_grade_level = isset($user->child_grade_level) ? $user->child_grade_level : '';
                                        $child_grade_level = isset($_POST['child_grade_level']) ? $_POST['child_grade_level'] : $child_grade_level;
                                    ?>  
                                    <div class="form-group <?php echo form_error('child_grade_level') ? 'has-error' : ''; ?>">
                                        <label class="col-sm-3 control-label"><?php e(lang('childs_grade_level')); ?></label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="child_grade_level" value="<?php echo $child_grade_level; ?>" name="child_grade_level"  placeholder="<?php e(lang('childs_grade_level')); ?>" />
                                            <?php echo form_error('child_grade_level', '<div class="alert alert-error">', '</div>'); ?>
                                        </div>
                                    </div>

                                    <?php
                                        $child_school = isset($user->child_school) ? $user->child_school : '';
                                        $child_school = isset($_POST['child_school']) ? $_POST['child_school'] : $child_school;
                                    ?>  
                                    <div class="form-group <?php echo form_error('child_school') ? 'has-error' : ''; ?>">
                                        <label class="col-sm-3 control-label"><?php e(lang('school_name')); ?></label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="child_school" value="<?php echo $child_school; ?>" name="child_school" placeholder="<?php e(lang('school_name')); ?>" />
                                            <?php echo form_error('child_school', '<div class="alert alert-error">', '</div>'); ?>
                                        </div>
                                    </div>

                                    <?php
                                        $child_hours_english = isset($user->child_hours_english) ? $user->child_hours_english : '';
                                        $child_hours_english = isset($_POST['child_hours_english']) ? $_POST['child_hours_english'] : $child_hours_english;
                                    ?>  
                                    <div class="form-group <?php echo form_error('child_hours_english') ? 'has-error' : ''; ?>">
                                        <label class="col-sm-3 control-label"><?php e(lang('hours_english')); ?></label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="child_hours_english" value="<?php echo $child_hours_english; ?>" name="child_hours_english" placeholder="<?php e(lang('hours_english')); ?>" />
                                            <?php echo form_error('child_hours_english', '<div class="alert alert-error">', '</div>'); ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
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
