<?php

$errorClass = ' error';
$controlClass = 'span6';
$fieldData = array(
    'errorClass'    => $errorClass,
    'controlClass'  => $controlClass,
);

if (isset($password_hints)) {
    $fieldData['password_hints'] = $password_hints;
}

// For the settings form, $renderPayload should not be set to $current_user or
// $this->auth->user(), as it can't be assumed that $current_user is the same as
// the user being edited.
$renderPayload = null;
if (isset($current_user)) {
    $fieldData['current_user'] = $current_user;
}
if (isset($user)) {
    $fieldData['user'] = $user;
    $renderPayload = $user;
}

if (validation_errors()) :
?>
<div class='alert alert-error'>
    <?php echo validation_errors(); ?>
</div>
<?php
endif;

if (isset($user) && $user->banned) :
?>
<div class="alert alert-warning fade in">
    <h4 class="alert-heading"><?php echo lang('us_banned_admin_note'); ?></h4>
</div>
<?php
endif;

if (isset($password_hints)) :
?>
<div class="alert alert-info fade in">
    <a data-dismiss="alert" class="close">&times;</a>
    <?php echo $password_hints; ?>
</div>
<?php
endif;
?>
    <fieldset>
<?php        
    if ($page_type == 'create_user') :        ?>
        <legend>Create New User</legend>
<?php else: ?>
        <legend>Account Details</legend>
<?php endif; ?>        

<script type="text/javascript" src="<?= base_url(); ?>assets/widgets/uniform/uniform.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/widgets/uniform/uniform-demo.js"></script>

<!-- Boostrap Tabs -->

<script type="text/javascript" src="<?= base_url(); ?>assets/widgets/tabs/tabs.js"></script>

<!-- Chosen -->

<!--<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/chosen/chosen.css">-->
<script type="text/javascript" src="<?= base_url(); ?>assets/widgets/chosen/chosen.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/widgets/chosen/chosen-demo.js"></script>

<!-- Input switch -->

<!--<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/input-switch/inputswitch.css">-->
<script type="text/javascript" src="<?= base_url(); ?>assets/widgets/input-switch/inputswitch.js"></script>
<script type="text/javascript">
    /* Input switch */

    $(function() { "use strict";
        $('.input-switch').bootstrapSwitch();
    });
</script>

<!-- Textarea -->

<script type="text/javascript" src="<?= base_url(); ?>assets/widgets/textarea/textarea.js"></script>
<script type="text/javascript">
    /* Textarea autoresize */

    $(function() { "use strict";
        $('.textarea-autosize').autosize();
    });
</script>

<div class="row mailbox-wrapper">
<?php
  $page_class = (@$page_type == 'edit_user') ? 'col-md-8' : 'col-md-12';  
?>

   <div class="<?= $page_class ?>">
      <div class="example-box-wrapper">

<?php if (@$page_type == 'edit_user') : ?>        
         <ul class="list-group row list-group-icons">
            <li class="col-md-3 active">
<?php
              if (empty($resume) === false) : 
                $uploaded_time = strtotime($resume->created_on);
                $uploaded = date('d M Y', $uploaded_time);
?>              
               <a href="<?= base_url(); ?><?= $resume->resume_path ?>" target="_blank" class="list-group-item">
               <i class="glyph-icon font-red icon-bullhorn"></i>View Resume<br><small>(Uploaded <?= $uploaded ?>)</small></a>
<?php         else : ?>
                  <span class="list-group-item"><i class="glyph-icon font-red icon-bullhorn"></i>No resume uploaded<br />&nbsp;</span>
<?php         endif; ?>
            </li>
            <li class="col-md-3">
               <a href="#" data-toggle="tab" class="list-group-item">
               <i class="glyph-icon icon-dashboard"></i>Application Status<br />Phase 2</a>
            </li>
            <li class="col-md-3">
               <a href="#" data-toggle="tab" class="list-group-item">
               <i class="glyph-icon font-primary icon-camera"></i><br />Phase 2</a>
            </li>
            <li class="col-md-3">
               <a href="#" data-toggle="tab" class="list-group-item">
               <i class="glyph-icon font-blue-alt icon-globe"></i>TBD<br />Phase 2</a>
            </li>
         </ul>
<?php endif; // end edit user check ?>         
         <div class="tab-content">
            <div class="tab-pane pad0A fade active in" id="tab-example-4">
               <div class="content-box">
        <?php   echo form_open($this->uri->uri_string(), array('class' => 'form-horizontal pad15L pad15R bordered-row', 'autocomplete' => 'off', 'id' => 'create_user_form')); ?>

                    <?php
                        $first_name = isset($user->first_name) ? $user->first_name : '';
                        $first_name = isset($_POST['u_fname']) ? $_POST['u_fname'] : $first_name;
                    ?>
                     <div class="form-group remove-border <?php echo form_error('u_fname') ? 'has-error' : ''; ?>">
                        <label class="col-sm-3 control-label" for="u_fname">First Name:</label>
                        <div class="col-sm-6">
                           <input type="text" class="form-control <?php echo $controlClass; ?>" id="u_fname" placeholder="Enter your first name" name="u_fname" id="u_fname" value="<?= $first_name ?>" style="font-weight: 600;" />
                            <?php echo form_error('u_fname', '<div class="alert alert-error">', '</div>'); ?>
                        </div>
                     </div>
                    <?php
                        $last_name = isset($user->last_name) ? $user->last_name : '';
                        $last_name = isset($_POST['u_lname']) ? $_POST['u_lname'] : $last_name;
                    ?>
                     <div class="form-group <?php echo form_error('u_lname') ? 'has-error' : ''; ?>">
                        <label class="col-sm-3 control-label" name="u_lname" >Last Name:</label>
                        <div class="col-sm-6">
                           <input type="text" class="form-control <?php echo $controlClass; ?>" placeholder="Enter your last name" name="u_lname" id="u_lname" value="<?= $last_name ?>" style="font-weight: 600;" />
                            <?php echo form_error('u_lname', '<div class="alert alert-error">', '</div>'); ?>
                        </div>
                     </div>
                     <?php
                        $email = isset($user->email) ? $user->email : '';
                        $email = isset($_POST['email']) ? $_POST['email'] : $email;
                    ?>
                     <div class="form-group <?php echo form_error('email') ? 'has-error' : ''; ?>">
                        <label class="col-sm-3 control-label">Email:</label>
                        <div class="col-sm-6">
                           <input class="form-control <?php echo $controlClass; ?>" type="text" id="email" placeholder="Enter your email" name="email" value="<?= $email ?>" style="font-weight: 600;" />
                           <?php echo form_error('email', '<div class="alert alert-error">', '</div>'); ?>
                        </div>
                     </div>
                                                         
                    <div class="form-group <?php echo form_error('password') ? 'has-error' : ''; ?>">
                        <label class="col-sm-3 control-label">Password</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control <?php echo $controlClass; ?>" name="password" id="password" value="" placeholder="Enter password" style="font-weight: 600;"/>
                            <?php echo form_error('password', '<div class="alert alert-error">', '</div>'); ?>
                        </div>
                    </div>
                    
                    <div class="form-group <?php echo form_error('pass_confirm') ? 'has-error' : ''; ?>">
                        <label class="col-sm-3 control-label">Password Confirm</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control <?php echo $controlClass; ?>" name="pass_confirm" id="pass_confirm" value="" placeholder="Enter confirm password" style="font-weight: 600;"/>
                            <?php echo form_error('pass_confirm', '<div class="alert alert-error">', '</div>'); ?>
                        </div>
                    </div>
                     
                    <?php
                        $phone_number = isset($user->phone_number) ? $user->phone_number : '';
                        $phone_number = isset($_POST['phone_number']) ? $_POST['phone_number'] : $phone_number;
                    ?>                                     
                    <div class="form-group <?php echo form_error('phone_number') ? 'has-error' : ''; ?>">
                        <label class="col-sm-3 control-label">Phone Number</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="phone_number" id="phone_number" value="<?=$phone_number ?>" placeholder="Enter phone number" style="font-weight: 600;"/>
                            <?php echo form_error('phone_number', '<div class="alert alert-error">', '</div>'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <label for="role_id" class="col-sm-3 control-label"><?php echo lang('us_role'); ?></label>
                            <div class="col-sm-6">
                                <select name="role_id" id="role_id" class="form-control <?php echo $controlClass; ?>">
                                    <?php
                                    if (! empty($roles) && is_array($roles)) :
                                        foreach ($roles as $role) :
                                            if ($this->auth->has_permission('Permissions.' . ucfirst($role->role_name) . '.Manage')) :
                                                // The selected role is the role assigned to the
                                                // user or the site's default role.
                                                $selectedRole = isset($user) ? ($user->role_id == $role->role_id)
                                                    : ($role->default == 1);
                                    ?>
                                                <option value="<?php echo $role->role_id; ?>" <?php echo set_select('role_id', $role->role_id, $selectedRole); ?>>
                                                    <?php e(ucfirst($role->role_name)); ?>
                                                </option>
                                    <?php
                                            endif;
                                        endforeach;
                                    endif;
                                    ?>
                                </select>
                                <span class="help-inline"></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="input-group user_type">
                             <?php if(!empty($user->user_type)){ ?>
                                <label for="user_type" class="col-sm-3 control-label">User Type</label>
                                <div class="controls col-sm-6">
                                    <select name="user_type" id="user_type" class="user_type-select form-control">
                                        <?php if($user->user_type == 'teacher'){ ?>
                                                <option value="teacher">Teacher</option>
                                                <option value="student">Student</option>    
                                        <?php }elseif($user->user_type == 'student'){ ?>
                                                <option value="student">Student</option>
                                                <option value="teacher">Teacher</option>
                                        <?php } ?>
                                        
                                    </select>
                                </div>
                             <?php } ?>
                        </div>
                    </div>
                    
                    <?php
                    
                    
                    //if($this->uri->segment(4) == 'edit'){
                       
                    ?>
                    <?php
                            $paypal_email = isset($user->paypal_email) ? $user->paypal_email : '';
                            $paypal_email = isset($_POST['paypal_email']) ? $_POST['paypal_email'] : $paypal_email;
                    ?>                                     
                        <div class="form-group <?php echo form_error('paypal_email') ? 'has-error' : ''; ?>">
                            <div class="input-group paypal_email">
                                <label class="col-sm-3 control-label">Paypal Email</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="paypal_email" id="paypal_email" value="<?=$paypal_email ?>" placeholder="Enter paypal email">
                                    <?php echo form_error('paypal_email', '<div class="alert alert-error">', '</div>'); ?>
                                </div>
                            </div>
                        </div>    
                        
                        <div class="form-group <?php echo form_error('select_country') ? 'has-error' : ''; ?>">
                            <div class="input-group">
                                <label class="col-sm-3 control-label">Select Country</label>
                                <div class="col-sm-6">
                                        <select class="form-control" name="select_country" id="select_country">
                                            <option value="">Select Country</option>
                                            
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
                        </div>
                        
                        <div class="form-group <?php echo form_error('select_state') ? 'has-error' : ''; ?>">
                            <div class="input-group">
                                <label class="col-sm-3 control-label">State</label>
                                <div class="col-sm-6 select_state_div">
                                   <?php
                                   $selected_country = isset($user->country)?$user->country:'';
                                   if(!empty($selected_country)){
                                        $list_of_states = !empty($list_of_states[$selected_country])?$list_of_states[$selected_country]:'';
                                        if(!empty($list_of_states)){
                                   ?>         
                                           <select class="form-control" name="select_state" id="select_state">
                                                <option value="">Select State / Province</option>
                                                
                                                <?php
                                                
                                                foreach($list_of_states as $key => $states_list){
                                                    if(!empty($key)){
                                                            
                                                    ?>
                                                    <option value="<?php echo $key; ?>" <?php echo ((isset($user->state))?((trim($user->state) == $key)?'selected="selected"':''):"");?>><?php echo $states_list; ?></option>
                                                            
                                                    <?php
                                                    }
                                                } ?>
                                           </select> 
                                      <?php 
                                        }
                                        else{
                                            echo '<input type="text" class="form-control" placeholder="Enter State" name="select_state" id="select_state" value="'.$user->state.'" />';
                                        }         
                                  } 
                                  else{
                                      echo '<input type="text" class="form-control" placeholder="Enter State" name="select_state" id="select_state" />';          
                                  }
                                        
                                  ?>
                                    
                                    <?php echo form_error('select_state', '<div class="alert alert-error">', '</div>'); ?>
                                </div>
                            </div>
                        </div>   
                        
                        
                        <?php
       
                            $city = isset($user->city) ? $user->city : '';
                            $city = isset($_POST['city']) ? $_POST['city'] : $city;
                        ?>                                     
                            <div class="form-group <?php echo form_error('city') ? 'has-error' : ''; ?>">
                                <div class="input-group">
                                    <label class="col-sm-3 control-label">City</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="city" id="city" value="<?=$city ?>" placeholder="Enter City">
                                        <?php echo form_error('city', '<div class="alert alert-error">', '</div>'); ?>
                                    </div>
                                </div>
                            </div>
                            
                        <div class="form-group <?php echo form_error('select_timezone') ? 'has-error' : ''; ?>">
                            <div class="input-group">
                                <label class="col-sm-3 control-label">Select Timezone</label>
                                <div class="col-sm-6 select_timezone_div">
                                   
                                    <select class="form-control" name="select_timezone" id="select_timezone">
                                        <option value="">Select Timezone</option>
                                        
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
                                    <?php echo form_error('select_state', '<div class="alert alert-error">', '</div>'); ?>
                                </div>
                            </div>
                        </div>
                    
                    <?php //} //endif (url == 'edit') ?>
                    
            <?php
                if (isset($user)
                    && $this->auth->has_permission('Permissions.' . ucfirst($user->role_name) . '.Manage')
                    && $user->id != $this->auth->user_id()
                    && ($user->banned || $user->deleted)
                ) :
                    $field = ($user->active ? 'de' : '') . 'activate';
                ?>
                        <div class="form-group remove-border">
                            <label class="col-sm-3 control-label">&nbsp;</label>
                            <div class="col-sm-6">
                               <input type="checkbox" name="<?php echo $field; ?>" id="<?php echo $field; ?>" value="1" /> <?php echo lang("us_{$field}_note"); ?>
                            </div>
                        </div>
                    <?php if ($user->deleted) : ?>
                    
                        <div class="form-group remove-border">
                            <label class="col-sm-3 control-label">&nbsp;</label>
                            <div class="col-sm-6">
                               <input type="checkbox" name="restore" id="restore" value="1" /> <?php echo lang('us_restore_note'); ?>
                            </div>
                        </div>
                    <?php elseif ($user->banned) : ?>
                        <div class="form-group remove-border">
                            <label class="col-sm-3 control-label">&nbsp;</label>
                            <div class="col-sm-6">
                               <input type="checkbox" name="unban" id="unban" value="1" /> <?php echo lang('us_unban_note'); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>


                    <div class="button-pane mrg20T">
                        <input type="submit" name="save" class="btn btn-info" value="<?php echo lang('bf_action_save') . ' ' . lang('bf_user'); ?>" />
                        <a href="/admin/settings/users"><button class="btn btn-danger">Cancel</button></a>
                    </div>
<?php
            echo form_close();
?>                    
                </div>
            </div>
         </div>
      </div>
   </div>
<?php if (@$page_type == 'edit_user') : ?>      
   <div class="col-md-4">
      <div class="panel-layout">
         <div class="panel-box">
            <div class="panel-content image-box">
               <div class="ribbon">
                  <div class="bg-primary">Profile</div>
               </div>
               <div class="image-content font-white">
                  <div class="meta-box meta-box-bottom">
                     <img src="<?= base_url(); ?>assets/image-resources/gravatar.jpg" alt="" class="meta-image img-bordered img-circle">
                     <h3 class="meta-heading"><?= @$user->first_name ?> <?= @$user->last_name ?></h3>
                     <h4 class="meta-subheading"><?= empty($user->user_type) ? $user->role_name : ucfirst(@$user->user_type) ?></h4>
                  </div>
               </div>
               <img src="<?= base_url(); ?>assets/image-resources/blurred-bg/blurred-bg-13.jpg" alt="">
            </div>
         </div>
      </div>
   </div>
<?php endif; //end edit user check  ?>   
</div>


    </fieldset>
    <?php
    $canManageUser = false;
    if (! isset($user)) {
        $canManageUser = true;
    } elseif ($this->auth->has_permission('Permissions.' . ucfirst($user->role_name) . '.Manage')) {
        $canManageUser = true;
    }
    if ($canManageUser && $this->auth->has_permission('Bonfire.Roles.Manage')) :
    ?>


    
    
    <?php endif; ?>
    <fieldset>
        <?php
        // Allow modules to render custom fields.
        Events::trigger('render_user_form', $renderPayload);
        ?>
        <!-- Start of User Meta -->
        <?php $this->load->view('users/user_meta');?>
        <!-- End of User Meta -->
    </fieldset>



<script>

$(document).ready(function(){
    
    var url      = window.location.href;
    var n = url.lastIndexOf('/');
    var user_id = url.substring(n + 1);
    
    var Base64={_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(e){var t="";var n,r,i,s,o,u,a;var f=0;e=Base64._utf8_encode(e);while(f<e.length){n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);s=n>>2;o=(n&3)<<4|r>>4;u=(r&15)<<2|i>>6;a=i&63;if(isNaN(r)){u=a=64}else if(isNaN(i)){a=64}t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)}return t},decode:function(e){var t="";var n,r,i;var s,o,u,a;var f=0;e=e.replace(/[^A-Za-z0-9+/=]/g,"");while(f<e.length){s=this._keyStr.indexOf(e.charAt(f++));o=this._keyStr.indexOf(e.charAt(f++));u=this._keyStr.indexOf(e.charAt(f++));a=this._keyStr.indexOf(e.charAt(f++));n=s<<2|o>>4;r=(o&15)<<4|u>>2;i=(u&3)<<6|a;t=t+String.fromCharCode(n);if(u!=64){t=t+String.fromCharCode(r)}if(a!=64){t=t+String.fromCharCode(i)}}t=Base64._utf8_decode(t);return t},_utf8_encode:function(e){e=e.replace(/rn/g,"n");var t="";for(var n=0;n<e.length;n++){var r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r)}else if(r>127&&r<2048){t+=String.fromCharCode(r>>6|192);t+=String.fromCharCode(r&63|128)}else{t+=String.fromCharCode(r>>12|224);t+=String.fromCharCode(r>>6&63|128);t+=String.fromCharCode(r&63|128)}}return t},_utf8_decode:function(e){var t="";var n=0;var r=c1=c2=0;while(n<e.length){r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r);n++}else if(r>191&&r<224){c2=e.charCodeAt(n+1);t+=String.fromCharCode((r&31)<<6|c2&63);n+=2}else{c2=e.charCodeAt(n+1);c3=e.charCodeAt(n+2);t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3}}return t}}
    
    if(window.location.href.indexOf("admin/settings/users/create") > -1) 
    {
        var base_url = '<?php echo base_url(); ?>';
        
        $("#create_user_form").validate({
            
            rules: {
                // compound rule
                email: {
                  required: true,
                  email: true
                },
                password: {
                  required: true,
                  minlength: 8,
                  regexpass: true,
                },
                pass_confirm: {
                  required: true,
                  minlength: 8,
                  equalTo: "#password"
                },
                phone_number:{
                    minlength:10,
                    maxlength:12,
                    regex_phone:true
                },
                paypal_email:{
                    email: true  
                },
                select_country: {
                  required: true,
                },
                select_state: {
                  required: true,
                },
                city: {
                  required: true,
                },
                select_timezone: {
                  required: true,
                },
                
              },
             messages: {
                    email: {
                        required: "The Email field is required.",
                        email: "The Email field must contain a valid email address.",
                    },
                    password: {
                        required: "The Password field is required.",
                        minlength: "The Password field must be at least 8 characters long.",
                        regexpass: "The Password fiels must contain one uppercase, one lowercase, one number and one special character",
                    },
                    pass_confirm: {
                        required: "The Password (again) field is required.",
                        minlength: "The Password field must be at least 8 characters long.",
                        equalTo: "The Password field (again) does not match the Password field."
                    },
                    phone_number:{
                        minlength: "Phone number must be 10 characters long",
                        maxlenght: "Phone number must not exceed 12 characters",
                        regex_phone: "Enter valid phone number"
                    },
                    paypal_email:{
                        email: "The Paypal Email field must contain a valid email address.",    
                    },
                    select_country:{
                        required: "Select Country field is required.",
                    },
                    select_state:{
                        required: "Select State field is required.",
                    },
                    city:{
                        required: "City field is required.",
                    },
                    select_timezone:{
                        required: "Select Country field is required.",
                    }
                },
          submitHandler: function(form) {
            
                var role = $('#role_id').find(':selected').val();
                var email = $('#email').val(); 
                var pass = $('#password').val();
                var pass_confirm = $("#pass_confirm").val();
                var user_type = $("#user_type").val();
                var u_fname = $("#u_fname").val(); 
                var u_lname = $("#u_lname").val();
                var phone_number = $("#phone_number").val();
                var paypal_email = $("#paypal_email").val();
                var select_country = $("#select_country").val();
                var select_state = $("#select_state").val();
                var city = $("#city").val();
                var select_timezone = $("#select_timezone").val();
                
                var encode_email = Base64.encode('rad01'+email);
                var encode_pass = Base64.encode('Rad@01'+pass);
                
                    var _key = 'bf_user_register';
                    $.ajax({
                        type: "post",
                        url:'<?php echo site_url('admin/settings/users/ajax_create_user');?>',
                        dataType: 'json',
                        data: {phone_number:phone_number, email: email, password: pass,role_id:role,key:_key,pass_confirm:pass_confirm,user_type:user_type,u_fname:u_fname,u_lname:u_lname,paypal_email:paypal_email,select_country:select_country,select_state:select_state,city:city,select_timezone:select_timezone},
                        success: function(response) {
                            
                            if(response.status == 'success'){
                                 if(role != 4){
                                    
                                    var s_data = {
                            			'action': 'user_auto_register',
                                        'key': 'register_done',
                            			'email_id': encode_email,
                            			'pass_key': encode_pass,
                                        'user_id_in_code' : response.user_id_in_code,
                                        'role_id':role,
                            		};
                                    
                                     $.ajax({
                                            type: "POST",
                                            url: "<?= MAIN_WEBSITE_URL ?>/wp-admin/admin-ajax.php",
                                            data: s_data,
                                            success: function(response) {
                                                 console.log( response );
                                            },
                                        });   
                                 }
                            }
                            else{
                                
                            }
                        },complete: function (response){
                            window.location = '<?php echo site_url('admin/settings/users/');?>';
                        }
                    });    
                return false;
            
          }
        });
    
    } //if create
    else if(window.location.href.indexOf("admin/settings/users/edit/"+user_id) > -1){
        
        var base_url = '<?php echo base_url(); ?>';
        
        $("#create_user_form").validate({
            
            rules: {
                // compound rule
                email: {
                  required: true,
                  email: true
                },
                password: {
                  minlength: 8,
                  regexpass: true,
                },
                pass_confirm: {
                  minlength: 8,  
                  equalTo: "#password"
                },
                phone_number:{
                    minlength:10,
                    maxlength:12,
                    regex_phone:true
                },
                paypal_email:{
                    email: true  
                },
                select_country: {
                  required: true,
                },
                select_state: {
                  required: true,
                },
                city: {
                  required: true,
                },
                select_timezone: {
                  required: true,
                },
                
              },
             messages: {
                    email: {
                        required: "The Email field is required.",
                        email: "The Email field must contain a valid email address.",
                    },
                    password: {
                        minlength: "The Password field must be at least 8 characters long.", 
                        regexpass: "The Password fiels must contain one uppercase, one lowercase, one number and one special character",
                    },
                    pass_confirm: {
                        minlength: "The Password field must be at least 8 characters long.",
                        equalTo: "The Password field (again) does not match the Password field."
                    },
                    phone_number:{
                        minlength: "Phone number must be 10 characters long",
                        maxlenght: "Phone number must not exceed 12 characters",
                        regex_phone: "Enter valid phone number"
                    },
                    paypal_email:{
                        email: "The Paypal Email field must contain a valid email address.",    
                    }, 
                    select_country:{
                        required: "Select Country field is required.",
                    },
                    select_state:{
                        required: "Select State field is required.",
                    },
                    city:{
                        required: "City field is required.",
                    },
                    select_timezone:{
                        required: "Select Country field is required.",
                    }
                },
          submitHandler: function(form) {
            
                var role = $('#role_id').find(':selected').val();
                var email = $('#email').val(); 
                var pass = $('#password').val();
                var pass_confirm = $("#pass_confirm").val();
                var user_type = $("#user_type").val();
                var u_fname = $("#u_fname").val(); 
                var u_lname = $("#u_lname").val();
                var phone_number = $("#phone_number").val();
                var paypal_email = $("#paypal_email").val();
                var select_country = $("#select_country").val();
                var select_state = $("#select_state").val();
                var city = $("#city").val();
                var select_timezone = $("#select_timezone").val();
                
                var encode_email = Base64.encode('rad01'+email);
                var encode_pass = Base64.encode('Rad@01'+pass);
                
                    var _key = 'bf_user_edit';
                    $.ajax({
                        type: "post",
                        url:'<?php echo site_url('admin/settings/users/ajax_edit_user');?>',
                        dataType: 'json',
                        data: {phone_number:phone_number, user_id:user_id, email: email, password: pass,role_id:role,key:_key,pass_confirm:pass_confirm,user_type:user_type,u_fname:u_fname,u_lname:u_lname,paypal_email:paypal_email,select_country:select_country,select_state:select_state,city:city,select_timezone:select_timezone},
                        success: function(response) {
                            console.log(response);
                            if(response.status == 'success'){
                                
                                var s_data = {
                        			'action': 'user_auto_update',
                                    'key': 'update_done',
                        			'email_id': encode_email,
                        			'pass_key': encode_pass,
                                    'user_id':user_id,
                                    'role_id':role,
                                    'user_id_in_code' : response.user_id_in_code,
                        		};
                                     $.ajax({
                                            type: "POST",
                                            url: "<?= MAIN_WEBSITE_URL ?>/wp-admin/admin-ajax.php",
                                            data: s_data,
                                            success: function(response) {
                                                 console.log( response );
                                            },
                                        });   
                                
                            }
                            else{
                                
                            }
                        },complete: function (response){
                            window.location = url;
                        }
                    });    
                return false;
            
          }
        });
        
        
    } //else if edit

});


$(document).ready(function(){
    
    var check_user_type = '<?php if(!empty($user)){ echo "yes"; }else{ echo 'no'; } ?>';
    
    $(function () {
        
        var user_type = 'User Type';
        
        var select_user_type = '<label for="user_type" class="col-sm-3 control-label">'+user_type+'</label><div class="controls col-sm-6"><select name="user_type" id="user_type" class="user_type-select form-control"><option value="teacher">Teacher</option><option value="student">Student</option></select></div>';
        
        //var selected_text = $(this).find("option:selected").text();
        var selected_val = $('#role_id').val();
        
        if(check_user_type == "no"){
            if(selected_val == '4'){
                $('.user_type').html(select_user_type);
            }    
        }
        
        $("#role_id").change(function () {
            var selected_text = $(this).find("option:selected").text();
            var selected_val = $(this).val();
            
            
            if(selected_val == '4'){
                
                $('.user_type').html(select_user_type);
            }else if(selected_val != '4'){
                if(select_user_type){
                    $('.user_type').find('.control-label').remove();    
                    $('.user_type').find('.controls').remove();
                }
            }
            
        });
    });
});

</script>


<script type="text/javascript">

$(document).ready(function(){
    $("#select_country").on('change',function(){
        var selectedCountry = $("#select_country option:selected").val();
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('admin/settings/users/select_state');?>",
            data: { country : selectedCountry },
            success: function(data) {
                if(data.length != ''){
                    $(".select_state_div").html(data);    
                }else{
                    $(".select_state_div").html('<input type="text" class="form-control" placeholder="Enter State" name="select_state" id="select_state" />');
                }
                
                   
            } 
        });
    });
});
</script>


<script type="text/javascript">

$(document).ready(function(){
    $("#select_country").on('change',function(){
        var selectedCountry = $("#select_country option:selected").val();
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('admin/settings/users/select_timezone');?>",
            data: { country : selectedCountry },
            success: function(data) {
                if(data.length != ''){
                    $(".select_timezone_div").html(data);    
                }else{
                    $(".select_timezone_div").html('<select class="form-control" name="select_timezone" id="select_timezone"><option value="">Select Timezone</option></select>');
                }
                   
            } 
        });
    });
});
</script>
