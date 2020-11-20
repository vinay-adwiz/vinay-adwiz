
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
        <h1 class="hero-heading wow fadeInDown" data-wow-duration="0.6s">Zoom Users List</h1>
    </div>
    <div class="hero-overlay bg-black"></div>
</div>
<?php $numColumns = 4; ?>
<div id="page-content" class="col-md-8 center-margin frontend-components mrg25T">
    <div class="row">
        <div class="col-md-3 col-lg-2">
            <?php echo theme_view('sidemenu'); ?>
        </div>
        <div class="col-md-9 col-lg-10">
            <div id="page-title">
                <h2>Zoom Users List</h2>
                <p>&nbsp;</p>
            </div>
            <div class="row">
                <div class="col-md-12">
                    
                    <div class="panel">
                        <div class="panel-body">
                            <div class="message"></div>
                            <h3 class="title-hero">
                                Zoom Users
                            </h3>
                            <p> <?php echo Template::message(); ?></p>
                            <div class="example-box-wrapper">
                            
                            <?php 
                            
                            if(!empty($user_data->users)){

                            ?>

                               <table class="table table-bordered table-condensed cf">
                        			<thead class="cf">
                        				<tr>
                        					<th>Name</th>
                        					<th><?php echo lang('bf_email'); ?></th>
                        					<th class='action'>Action</th>
                        				</tr>
                        			</thead>
                        			
                        			<tbody class="users_data">
                                        <?php
                                        foreach($user_data->users as $z_user_data){
                                            ?>
                                            <tr>
                            					<td><?php
                            
                            						$name = @$z_user_data->first_name . " " . @$z_user_data->last_name;
                            	                    echo anchor(site_url("users/zoom/zoom_user/{$z_user_data->id}"), $name);
                            
                            						?>
                            					</td>
                            					<td><?php echo $z_user_data->email ? mailto($z_user_data->email) : ''; ?></td>
                            					
                            					<td class='action'>
                                                    <a href="<?php echo site_url('/users/zoom/edit_zoom_user/'.$z_user_data->id) ?>" class="btn btn-sm btn-primary edit_zoom_user" user_id="<?php echo $z_user_data->id; ?>">Edit</a>
                            						<a class="btn btn-sm btn-danger delete_zoom_user" user_id="<?php echo $z_user_data->id; ?>">Delete</a>
                            					</td>
                            				</tr>
                                            
                                            
                                            <?php
                                            
                                        }//foreach ?>
                                        
                        			</tbody>
                        
                        			<tfoot>
                        				<tr>
                        	                <td colspan="<?php echo $numColumns; ?>">
                        						
                        					</td>
                        				</tr>
                        			</tfoot>
                        
                        		</table> 
                              <?php
                              }
                              else{
                                    echo '<div class="row">No User(s)</div>';
                              }
                              
                              ?>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
var Base64={_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(e){var t="";var n,r,i,s,o,u,a;var f=0;e=Base64._utf8_encode(e);while(f<e.length){n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);s=n>>2;o=(n&3)<<4|r>>4;u=(r&15)<<2|i>>6;a=i&63;if(isNaN(r)){u=a=64}else if(isNaN(i)){a=64}t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)}return t},decode:function(e){var t="";var n,r,i;var s,o,u,a;var f=0;e=e.replace(/[^A-Za-z0-9+/=]/g,"");while(f<e.length){s=this._keyStr.indexOf(e.charAt(f++));o=this._keyStr.indexOf(e.charAt(f++));u=this._keyStr.indexOf(e.charAt(f++));a=this._keyStr.indexOf(e.charAt(f++));n=s<<2|o>>4;r=(o&15)<<4|u>>2;i=(u&3)<<6|a;t=t+String.fromCharCode(n);if(u!=64){t=t+String.fromCharCode(r)}if(a!=64){t=t+String.fromCharCode(i)}}t=Base64._utf8_decode(t);return t},_utf8_encode:function(e){e=e.replace(/rn/g,"n");var t="";for(var n=0;n<e.length;n++){var r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r)}else if(r>127&&r<2048){t+=String.fromCharCode(r>>6|192);t+=String.fromCharCode(r&63|128)}else{t+=String.fromCharCode(r>>12|224);t+=String.fromCharCode(r>>6&63|128);t+=String.fromCharCode(r&63|128)}}return t},_utf8_decode:function(e){var t="";var n=0;var r=c1=c2=0;while(n<e.length){r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r);n++}else if(r>191&&r<224){c2=e.charCodeAt(n+1);t+=String.fromCharCode((r&31)<<6|c2&63);n+=2}else{c2=e.charCodeAt(n+1);c3=e.charCodeAt(n+2);t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3}}return t}}
    
var loading_img = '<?php echo base_url('assets/img/loader.gif'); ?>';

</script>

<script>

$(document).ready(function(){
    $('.delete_zoom_user').click(function(e){
        e.preventDefault();
        if(confirm("Are you sure want to delete user")){
            var user_id = $(this).attr('user_id');
            
            var d_data = {
    			'key': 'bf_delete_zoom_user',
    			'zoom_user_id':user_id,
    		};
            
            $.ajax({
                type: "POST",
                url: "<?= site_url() ?>users/zoom/delete_zoom_user",
                data: d_data,
                dataType: 'json',
                success: function(response){
                    
                    if(response.status == "success"){
                        
                        $('.panel-body .message').html('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><div>Zoom user deleted successfully.</div></div>');   
       
                        window.location.href = '<?php echo site_url('users/zoom/zoom_users'); ?>';
       
                    }
                    else if(response.status == "error"){
                        
                        $('.panel-body .message').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><div>Error Zoom user not deleted</div></div>');
                        
                    }
                    else{
                        
                        $('.panel-body .message').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><div>Error Zoom user not deleted</div></div>');
                        
                    }
                    
                },
                
            });
            	
        }
        else{
        	
        }
        
        
    }); //delete user
    
    
});


/*
$(document).ready(function(){
    
    var _key = 'bf_zoom_users_token';
    
    $.ajax({
        type: "get",
        url:'<?php echo site_url('users/zoom_auth/token');?>',
        dataType: 'json',
        data: {key:_key},
        success: function(response) {
            
            var zoom_token = response.token;
            if(zoom_token.length > 0){
                
                var encode_token = Base64.encode('R@d@1'+zoom_token+'g@nG');
                            
                var s_data = {
        			'key': 'bf_zoom_users_list',
        			'zoom_token': encode_token,
        		};
                
                $.ajax({
                        type: "POST",
                        url: "<?= site_url() ?>users/zoom/get_users_list",
                        data: s_data,
                        beforeSend: function() {    
                            $('.users_data').hide().html('<tr><td colspan="4"><img src="'+loading_img+'" style="width:75px;height:75px; display:block;margin:0 auto;"/></td></tr>').fadeIn('slow');
                        },
                        success: function(data) {
                            
                             if(data.length > 0){
                                $('.users_data').hide().html(data).fadeIn('slow');
                               
                               //delete user
                                $('.delete_zoom_user').click(function(e){
                                    e.preventDefault();
                                    if(confirm("Are you sure want to delete user")){
                                        var user_id = $(this).attr('user_id');
                                        
                                        var d_data = {
                                			'key': 'bf_delete_zoom_user',
                                			'zoom_token': encode_token,
                                            'zoom_user_id':user_id,
                                		};
                                        
                                        $.ajax({
                                            type: "POST",
                                            url: "<?= site_url() ?>users/zoom/delete_zoom_user",
                                            data: d_data,
                                            dataType: 'json',
                                            success: function(response){
                                                
                                                if(response.status == "success"){
                                                    
                                                    $('.panel-body .message').html('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><div>Zoom user deleted successfully.</div></div>');   
                                   
                                                    window.location.href = '<?php echo site_url('users/zoom_users'); ?>';
                                   
                                                }
                                                else if(response.status == "error"){
                                                    
                                                    $('.panel-body .message').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><div>Error Zoom user not deleted</div></div>');
                                                    
                                                }
                                                else{
                                                    
                                                    $('.panel-body .message').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><div>Error Zoom user not deleted</div></div>');
                                                    
                                                }
                                                
                                            },
                                            
                                        });
                                        	
                                    }
                                    else{
                                    	
                                    }
                                    
                                    
                                }); //delete user
                                
                                
                             }//if data.length > 0
                             else{
                                $('.users_data').hide().html('<tr><td colspan="4">No User(s)</td></tr>').fadeIn('slow');
                             }
                        },
                    });
                
            }
        
        }
    });
    
        
return false;
    
}); */

</script>

<!-- Zoom Users List -->