
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
        <h1 class="hero-heading wow fadeInDown" data-wow-duration="0.6s">Zoom User Details</h1>
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
                <h2>Zoom User Details</h2>
                <p>&nbsp;</p>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-body">
                            <div class="message"></div>
                            <h3 class="title-hero">
                                Zoom User Details
                            </h3>
                            <div class="example-box-wrapper">
                               <table class="table table-bordered table-condensed cf">
                        			<thead class="cf">
                        				<tr>
                        					<th class="text-center" colspan="<?php echo $numColumns; ?>">User Details</th>
                        				</tr>
                        			</thead>
                        			
                                    <tbody class="users_data">
                                        <?php if(!empty($user_id)){ ?>
                                            <?php if(!empty($user_data)){ ?>
                                	            <tr>
                                					<td style="font-weight: 600;">Name</td>
                                					<td><?php echo @$user_data->first_name.' '.@$user_data->last_name;?></td>
                                				 </tr>
                                                 <tr>    	
                                					<td style="font-weight: 600;">Email</td>
                                                    <td><?php echo mailto(@$user_data->email); ?></td>
                                				</tr>
                                                <tr>    	
                                					<td style="font-weight: 600;">Timezone</td>
                                                    <td><?php echo @$user_data->timezone; ?></td>
                                				</tr>
                                            <?php }
                                            else{ ?>
                                                <tr><td colspan="<?php echo $numColumns; ?>">No Data Related This User</td></tr>
                                            
                                            <?php } ?>
                                        <?php }
                                        else{ ?>
                                            <tr><td colspan="<?php echo $numColumns; ?>">No Data Related This User</td></tr>
                                        <?php } ?>
                        			</tbody>
                        
                        			<tfoot>
                        				<tr>
                        	                <td colspan="<?php echo $numColumns; ?>">
                        						
                        					</td>
                        				</tr>
                        			</tfoot>
                        
                        		</table>
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
/*$(document).ready(function(){
    
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
                
                var _key = 'bf_retrieve_zoom_user';
                
                var user_id = '<?php echo (!empty($user_id))?$user_id:''; ?>';
                
                if(user_id.length > 0){
                    
                    $.ajax({
                        type: "post",
                        url:'<?php echo site_url('users/zoom/retrieve_zoom_user');?>',
                        data:{key:_key,zoom_token:encode_token,zoom_user_id:user_id},
                        beforeSend: function() {    
                            $('.users_data').hide().html('<tr><td colspan="4"><img src="'+loading_img+'" style="width:75px;height:75px; display:block;margin:0 auto;"/></td></tr>').fadeIn('slow');
                        },
                        success: function(data) {
                            
                            if(data.length > 0){
                                $('.users_data').hide().html(data).fadeIn('slow');
                               
                             }//if data.length > 0
                             else{
                                $('.users_data').hide().html('<tr><td colspan="2">No Data Related This User</td></tr>').fadeIn('slow');
                             }
                        }
                    });
                
                }
                else{
                    $('.users_data').hide().html('<tr><td colspan="2">No Data Related This User</td></tr>').fadeIn('slow');
                }
                
                
            }
        
        }
    });
        
    return false;
    
    
});*/

</script>

<!-- Retrieve Zoom User Details -->