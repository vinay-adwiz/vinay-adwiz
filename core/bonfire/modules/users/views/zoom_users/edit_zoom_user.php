
<?php

$errorClass   = empty($errorClass) ? ' error' : $errorClass;
$controlClass = empty($controlClass) ? 'span6' : $controlClass;
$fieldData = array(
    'errorClass'   => $errorClass,
    'controlClass' => $controlClass,
);

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
        <h1 class="hero-heading wow fadeInDown" data-wow-duration="0.6s">Edit Zoom User</h1>
    </div>
    <div class="hero-overlay bg-black"></div>
</div>
<?php $numColumns = 2; ?>
<div id="page-content" class="col-md-8 center-margin frontend-components mrg25T">
    <div class="row">
        <div class="col-md-3 col-lg-2">
            <?php echo theme_view('sidemenu'); ?>
        </div>
        <div class="col-md-9 col-lg-10">
            <div id="page-title">
                <h2>Edit Zoom User Details</h2>
                <p>&nbsp;</p>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <div class="panel">
                        <div class="panel-body">
                            <div class="message"></div>
                            <h3 class="title-hero">
                                Edit Zoom User Details
                            </h3>
                            
                            <div class="example-box-wrapper">
                                <?php
                                if(!empty($user_id)){
                                    if(!empty($user_data)){ ?>
                                        
                                        <?php echo form_open_multipart($this->uri->uri_string(), array('class' => 'form-horizontal bordered-row', 'autocomplete' => 'off', 'id' => 'edit_zoom_user_profile')); ?>
                                         <div class="form-group <?php echo form_error('first_name') ? 'has-error' : ''; ?>">
                                            <label class="col-sm-3 control-label">First Name</label>
                                            <div class="col-sm-6">
                                    <?php
                                            $first_name = isset($user_data->first_name) ? $user_data->first_name : '';
                                            $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : $first_name;
                                    ?>            
                                                <input type="text" class="form-control" name="first_name" id="first_name" value="<?=$first_name ?>" placeholder="Enter first name" />
                                                <?php echo form_error('first_name', '<div class="alert alert-error">', '</div>'); ?>
                                            </div>
                                        </div>
    
                                        <div class="form-group <?php echo form_error('last_name') ? 'has-error' : ''; ?>">
                                            <label class="col-sm-3 control-label">Last Name</label>
                                            <div class="col-sm-6">
                                    <?php
                                            $last_name = isset($user_data->last_name) ? $user_data->last_name : '';
                                            $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : $last_name;
                                    ?>            
                                                <input type="text" class="form-control" name="last_name" id="last_name" value="<?=$last_name ?>" placeholder="Enter last name" />
                                                <?php echo form_error('youtube', '<div class="alert alert-error">', '</div>'); ?>
                                            </div>
                                        </div>
    
                                        <div class="form-group <?php echo form_error('email') ? 'has-error' : ''; ?>">
                                            <label class="col-sm-3 control-label">Email</label>
                                            <div class="col-sm-6">
                                    <?php
                                            $email = isset($user_data->email) ? $user_data->email : '';
                                            $email = isset($_POST['email']) ? $_POST['email'] : $email;
    
                                    ?>            
                                                <input type="text" class="form-control" name="email" id="email" value="<?=$email ?>" placeholder="Enter email" />
                                                <?php echo form_error('email', '<div class="alert alert-error">', '</div>'); ?>
                                            </div>
                                        </div>
                                        
                                        <input type="hidden" class="form-control" name="user_id" id="user_id" value="<?php echo $user_id; ?>"/>
                                        
                                        <div class="form-group">
                                            <div class="col-sm-12 control-label"><input class="btn btn-primary"  name="save" type="submit" value="Submit" /></div>
                                        </div>
    
                                    <?php echo form_close(); ?>
                                        
                                    <?php } //if !$user_data
                                    else{ ?>
                                        <div class="">No Data Related This User</div>
                                    <?php } //else 
                                
                                } //if !$user_id
                                else{ ?>
                                    <div class="">No Data Related This User</div>
                                <?php } //else ?>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    
    $('#edit_zoom_user_profile').validate({
    
        rules: {
            // compound rule
            first_name: {
              required: true,
            },
            last_name: {
              required: true,
            },
            email:{
               required: true,
               email: true
            }
            
          },
         messages: {
                first_name: {
                    required:"The first name field is required",
                },
                last_name: {
                    required: "The last name field is required.",
                },
                email:{
                    required: "The email field is required.",
                    email: "The Email field must contain a valid email address.",
                }
            },
      submitHandler: function(form) {
        
        
            var _key = 'bf_update_zoom_user';
            
            var zoom_fname = $('#first_name').val(); 
            var zoom_lname = $('#last_name').val(); 
            var zoom_email = $('#email').val();
            var user_id = $('#user_id').val(); 
            
            $.ajax({
                type: "post",
                url:'<?php echo site_url('users/zoom/update_zoom_user');?>',
                dataType: 'json',
                data:{key:_key,zoom_fname:zoom_fname,zoom_lname:zoom_lname,zoom_email:zoom_email,user_id:user_id},
                success: function(response) {
                    console.log(response);
                    if(response.status == 'success'){
                        
                       $('.panel-body .message').html('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><div>Zoom user updated successfully.</div></div>');
                       
                       window.location.href = '<?php echo site_url('users/zoom/zoom_user/'); ?>/'+user_id;
                               
                    }
                    else if(response.status == 'error'){
                        
                        $('.panel-body .message').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><div>Error: Zoom user not updated</div></div>');
                        $('#zoom_email').addClass('error');
                        
                    }
                    else{
                        
                        $('.panel-body .message').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><div>Error: Zoom user not updated</div></div>');
                    }
                }
            });
        
                
            return false;
        
      }
    });
    
    
});


</script>



<!-- Retrieve Zoom User Details -->