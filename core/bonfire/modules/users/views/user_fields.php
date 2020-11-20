<?php /* /users/views/user_fields.php */

$currentMethod = $this->router->fetch_method();

$errorClass     = empty($errorClass) ? ' error' : $errorClass;
$controlClass   = empty($controlClass) ? 'span4' : $controlClass;
$registerClass  = $currentMethod == 'register' ? ' required' : '';
$editSettings   = $currentMethod == 'edit';

$defaultLanguage = isset($user->language) ? $user->language : strtolower(settings_item('language'));
$defaultTimezone = isset($user->timezone) ? $user->timezone : strtoupper(settings_item('site.default_user_timezone'));

?>

<div class="form-group <?php echo form_error('u_fname') ? $errorClass : ''; ?>">
    <div class="input-group">
        <span class="input-group-addon addon-inside bg-gray">
            <i class="glyph-icon icon-user"></i>
        </span>
        <input type="text" class="form-control <?php echo $controlClass; ?>" id="u_fname" placeholder="<?php e(lang('register_form_firstname')); ?>" name="u_fname" id="u_fname" value="<?php echo set_value('u_fname', isset($user) ? $user->first_name : ''); ?>" style="font-weight: 600;" />
        <span class="help-inline"><?php echo form_error('u_fname'); ?></span>
    </div>
</div>

<div class="form-group <?php echo form_error('u_lname') ? $errorClass : ''; ?>">
    <div class="input-group">
        <span class="input-group-addon addon-inside bg-gray">
            <i class="glyph-icon icon-user"></i>
        </span>
        <input type="text" class="form-control <?php echo $controlClass; ?>" id="u_lname" placeholder="<?php e(lang('register_form_lastname')); ?>" name="u_lname" id="u_lname" value="<?php echo set_value('u_lname', isset($user) ? $user->last_name : ''); ?>" style="font-weight: 600;" />
        <span class="help-inline"><?php echo form_error('u_lname'); ?></span>
    </div>
</div>

<div class="form-group <?php echo form_error('phone_number') ? $errorClass : ''; ?>">
    <div class="input-group">
        <span class="input-group-addon addon-inside bg-gray">
            <i class="glyph-icon icon-phone"></i>
        </span>
        <input class="form-control <?php echo $controlClass; ?>" type="text" id="phone_number" placeholder="<?php e(lang('register_form_phone')); ?>" name="phone_number" style="font-weight: 600;" />
        <span class="help-inline"><?php echo form_error('phone_number'); ?></span>
    </div>
</div>

<div class="form-group <?php echo form_error('email') ? $errorClass : ''; ?>">
    <div class="input-group">
        <span class="input-group-addon addon-inside bg-gray">
            <i class="glyph-icon icon-envelope-o"></i>
        </span>
        <input class="form-control <?php echo $controlClass; ?>" type="text" id="email" placeholder="<?php e(lang('register_form_email')); ?>" name="email" value="<?php echo set_value('email', isset($user) ? $user->email : ''); ?>" style="font-weight: 600;" />
        <span class="help-inline"><?php echo form_error('email'); ?></span>
    </div>
</div>

<div class="form-group <?php echo form_error('password') ? $errorClass : ''; ?>">
    <div class="input-group">
        <span class="input-group-addon addon-inside bg-gray">
            <i class="glyph-icon icon-lock"></i>
        </span>
        <input class="form-control <?php echo $controlClass; ?>" type="password" id="password" placeholder="<?php e(lang('register_form_password')); ?>" name="password" value="" style="font-weight: 600;" />
        <span class="help-inline"><?php echo form_error('password'); ?></span>
        <p class="help-block"><small><?php e(lang('password_hints')); ?></small></p>
    </div>
</div>

<div class="form-group <?php echo form_error('pass_confirm') ? $errorClass : ''; ?>">
    <div class="input-group">
        <span class="input-group-addon addon-inside bg-gray">
            <i class="glyph-icon icon-lock"></i>
        </span>
        <input class="form-control <?php echo $controlClass; ?>" type="password" id="pass_confirm" placeholder="<?php e(lang('register_form_repeat_pwd')); ?>" name="pass_confirm" value="" style="font-weight: 600;" />
        <span class="help-inline"><?php echo form_error('pass_confirm'); ?></span>
        <?php
        
         if(current_url() == site_url('/register')){ ?>
            <input class="form-control" type="hidden" id="user_type" name="user_type" value="teacher"/>    
        <?php } ?>
        
    </div>
</div>

<?php if(current_url() == site_url('/register')){ 

$ref_code = isset($_GET['ref'])?$_GET['ref']:'';
    
?>
<div class="form-group <?php echo form_error('ref_code') ? $errorClass : ''; ?>">
    <div class="input-group">
        <span class="input-group-addon addon-inside bg-gray">
            <i class="glyph-icon icon-pencil-square"></i>
        </span>
        <input class="form-control <?php echo $controlClass; ?>" type="ref_code" id="ref_code" placeholder="<?php e(lang('register_form_ref_code')); ?>" name="ref_code" style="font-weight: 600;" value="<?php echo $ref_code; ?>" <?php echo (!empty($ref_code))?'disabled="disabled"':'' ?> />
        <span class="help-inline"><?php echo form_error('ref_code'); ?></span>
    </div>
</div>

<?php } ?>

<?php if ($editSettings) : ?>


<div class="form-group <?php echo form_error('force_password_reset') ? $errorClass : ''; ?>">
    <div class="input-group">
        <input class="form-control" type="checkbox" id="force_password_reset" name="force_password_reset" value="1" <?php echo set_checkbox('force_password_reset', empty($user->force_password_reset)); ?> />
        <?php echo lang('us_force_password_reset'); ?>
    </div>
</div>

<?php
endif;

if (isset($_GET['lang'])) {
    
    switch ($_GET['lang']) {
        case 'zh':
            $lang = 'chinese';
            break;
        case 'en':
            $lang = 'english';
            break;
        default:
            $lang = 'thai';
            break;
}

} else {
    $lang = 'thai';
}

?>
<input type="hidden" id="language" name="language" value="<?= $lang ?>" />

<script>
$(document).ready(function(){
    
    $("#register_form").validate({
            
            rules: {
                // compound rule
                u_fname:{
                    required: true,
                },
                u_lname:{
                    required: true,
                },
                email: {
                  required: true,
                  regexemail: true
                },
                phone_number:{
                    required: true,
                    minlength:10,
                    maxlength:12,
                    regex_phone:true
                },
                password: {
                  required: true,
                  minlength: 6,
                  regexpass: true,
                },
                pass_confirm: {
                  required: true,
                  minlength: 6,
                  equalTo: "#password"
                }
                
              },
             messages: {
                    u_fname: {
                        required: "<?php e(lang('js_u_fname_req')); ?>",
                    },
                    u_lname: {
                        required: "<?php e(lang('js_u_lname_req')); ?>",
                    },
                    email: {
                        required: "<?php e(lang('js_email_req')); ?>",
                        regexemail: "<?php e(lang('js_email_regx')); ?>",
                    },
                    phone_number:{
                        required: "<?php e(lang('js_phn_no_req')); ?>",
                        minlength: "<?php e(lang('js_phn_no_min_len')); ?>",
                        maxlenght: "<?php e(lang('js_phn_no_max_len')); ?>",
                        regex_phone: "<?php e(lang('js_phn_no_regx')); ?>",
                    },
                    password: {
                        required: "<?php e(lang('js_pass_req')); ?>",
                        minlength: "<?php e(lang('js_pass_min_len')); ?>",
                        regexpass: "<?php e(lang('js_pass_regx')); ?>",
                    },
                    pass_confirm: {
                        required: "<?php e(lang('js_pass_con_req')); ?>",
                        minlength: "<?php e(lang('js_pass_con_min_len')); ?>",
                        equalTo: "<?php e(lang('js_passwords_equal')); ?>"
                    }
                },
          submitHandler: function(form) {
            
                var role = 4;
                var email = $('#email').val(); 
                var phone_number = $("#phone_number").val();
                var pass = $('#password').val();
                var pass_confirm = $("#pass_confirm").val();
                var user_type = "student";
                var u_fname = $("#u_fname").val(); 
                var u_lname = $("#u_lname").val();
                var ref_code = $("#ref_code").val();
                var ulanguage = $('[name="language"]').val();
                
                    var _key = 'bf_new_user_register';
                    $.ajax({
                        type: "post",
                        url:'<?php echo site_url('users/ajax_register_user');?>',
                        dataType: 'json',
                        data: {email: email, password: pass,role_id:role,key:_key,pass_confirm:pass_confirm,user_type:user_type,u_fname:u_fname,u_lname:u_lname,ref_code:ref_code,phone_number:phone_number,language:ulanguage},
                        success: function(response) {
                            
                            if(response.status == 'success'){
                                
                                $('.message').html('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><div><?php e(lang("js_acct_created_successfully")); ?></div></div>');
                                
                                setTimeout(function(){ window.location = '<?php echo site_url();?>'; }, 2000);
                                 
                            }
                            else if(response.status == "no_ref"){
                                $("#ref_code").addClass("error");
                                $("#ref_code").removeClass("valid");
                                $("#ref_code").parent('div').append('<label id="ref_code-error" class="error" for="ref_code"><?php e(lang("js_ref_code_err")); ?></label>');
                            }
                            else if(response.status == "error"){
                                $("#email").addClass("error");
                                $("#email").removeClass("valid");
                                $("#email").parent('div').append('<label id="email-error" class="error" for="email"><?php e(lang("js_email_error")); ?></label>');
                            }else{
                                
                            }
                        }
                    });    
                return false;
            
          }
        });

});
</script>

<script>
$(document).ready(function(){
    
    $('.fb_register').click(function(e){
        e.preventDefault();
        
        var fb_anchor = $(this).attr('href');
        
        if($.trim($('#ref_code').val()) != ''){
            var ref_code = $.trim($('#ref_code').val());
            
            var _key = 'bf_check_ref_code';
            $.ajax({
                type: "post",
                url:'<?php echo site_url('users/check_ref_code');?>',
                dataType: 'json',
                data: {ref_code: ref_code,key:_key},
                success: function(response) {
                    
                    if(response.status == 'has_ref'){
                        
                        window.location = fb_anchor;
                         
                    }
                    else if(response.status == "no_ref"){
                        $('#ref_code-error').remove();
                        $("#ref_code").addClass("error");
                        $("#ref_code").removeClass("valid");
                        $("#ref_code").parent('div').append('<label id="ref_code-error" class="error" for="ref_code"><?php e(lang("js_ref_code_err")); ?></label>');
                    }
                    else if(response.status == "error"){
                        $('#ref_code-error').remove();
                        $("#ref_code").addClass("error");
                        $("#ref_code").removeClass("valid");
                        $("#ref_code").parent('div').append('<label id="ref_code-error" class="error" for="ref_code"><?php e(lang("js_ref_code_err_2")); ?></label>');
                    }else{
                        
                    }
                }
            });
                
        }
        else{
            window.location = fb_anchor;
        }
        
    });
    
});
</script>

<?php
