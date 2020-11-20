
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
        <h1 class="hero-heading wow fadeInDown" data-wow-duration="0.6s">My Resume</h1>
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
                <h2>Upload My Resume</h2>
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
                                My Resume
                            </h3>
                            <p> <?php echo Template::message(); ?></p>
                            <div class="example-box-wrapper">
                            
                            <?php 
                              
                              //<span class="text-danger" id="message"></span>
                               if(!empty($resumes)){
                                    $resume_file = $resumes[0]['resume'];
                                    $user_id = $resumes[0]['user_id'];   
                                
                                 
                                 
                                      if($resume_file != ""){
                                        
                                        echo '<a href="'.site_url('/uploads/resumes/'.$user_id.'/'.$resume_file).'" class="btn btn-info"><i class="glyph-icon icon-eye"></i> View resume</a> ';
                                        echo '<button res_id="'.$user_id.'" class="btn btn-danger remove_resume"><i class="glyph-icon icon-trash-o"></i>  Delete Resume</button>';

                                    } else{
                                        
                                      
                                ?>
                                    <p>You haven't uploaded a resume yet.</p>
                                    <br />
                                    <div class="form-group">
                                        <a href="#" id="resume_button" class="btn btn-info btn-block"><i class="glyph-icon icon-upload"></i> Upload My Resume</a>
                                        
                                        <!-- Modal  data-toggle="modal" data-target="#uploadModalAdmin" -->
                                          <div class="modal fade" id="uploadModalAdmin" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                              <!-- Modal content-->
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                  <h4 class="modal-title">Upload Resume</h4>
                                                </div>
                                                
                                                <?php echo form_open_multipart(site_url('/users/upload_resume'), 'id="resume_dropzone"' ,'class="dropzone bg-gray col-md-10 center-margin"'); ?>          
                                                     <div class="modal-body">       
                                                        <div class="form-group">
                                                            <div id="upload-files-dropzone" class="dropzone" action="#">
                                                                <div class="dropzone-previews"></div>
                                                            </div> 
                                                        </div>
                                                      </div>
                                                    
                                                  <?php echo form_close(); ?> 
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-default" data-dismiss="modal"> Close</button>
                                                </div>
                                              </div>
                                              
                                            </div>
                                          </div>
                                        <!-- <div class="col-sm-12 control-label"><input class="btn btn-primary"  name="save" type="submit" value="Upload My Resume"></div> -->
                                    </div>
                                
                                <?php  }  //nested else
                                
                                
                                }else{ ?>
                                    
                                    <p>You haven't uploaded a resume yet.</p>
                                    <br />
                                    <div class="form-group">
                                        <a href="#" id="resume_button" class="btn btn-info btn-block"><i class="glyph-icon icon-upload"></i> Upload My Resume</a>
                                        
                                        <!-- Modal  data-toggle="modal" data-target="#uploadModalAdmin" -->
                                          <div class="modal fade" id="uploadModalAdmin" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                              <!-- Modal content-->
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                  <h4 class="modal-title">Upload Resume</h4>
                                                </div>
                                                
                                                <?php echo form_open_multipart(site_url('/users/upload_resume'), 'id="resume_dropzone"' ,'class="dropzone bg-gray col-md-10 center-margin"'); ?>          
                                                     <div class="modal-body">       
                                                        <div class="form-group">
                                                            <div id="upload-files-dropzone" class="dropzone" action="#">
                                                                <div class="dropzone-previews"></div>
                                                            </div> 
                                                        </div>
                                                      </div>
                                                    
                                                  <?php echo form_close(); ?> 
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-default" data-dismiss="modal"> Close</button>
                                                </div>
                                              </div>
                                              
                                            </div>
                                          </div>
                                        <!-- <div class="col-sm-12 control-label"><input class="btn btn-primary"  name="save" type="submit" value="Upload My Resume"></div> -->
                                    </div>
                                
                                <?php } //else ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(function () {
    $("#resume_button").click(function(){
        $('#uploadModalAdmin').modal('show');
        $('#uploadModalAdmin').addClass('in');
    });
});
</script>

<script type="text/javascript">
$(document).ready(function(){
    
    $('.remove_resume').click(function(e){
        e.preventDefault();
        var res_id = $(this).attr('res_id');
        if (confirm('Are you sure?')) {
            $.ajax({
                    type: "post",
                    url:'<?php echo site_url('users/remove_resume');?>',
                    data: {res_id: res_id},
                    success: function(response) {
                        
                        
                    },complete: function (response){
                        window.location = '<?php echo site_url('users/resume');?>';
                    }
                }); 
        }
        
    });
    
    
});

</script>
