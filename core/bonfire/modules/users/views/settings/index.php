
<!-- Boostrap Tabs -->

<script type="text/javascript" src="<?= base_url(); ?>assets/widgets/tabs/tabs.js"></script>

<!-- Tabdrop Responsive -->

<script type="text/javascript" src="<?= base_url(); ?>assets/widgets/tabs/tabs-responsive.js"></script>
<script type="text/javascript">
    /* Responsive tabs */
    $(function() { "use strict";
        $('.nav-responsive').tabdrop();
    });
</script>

<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-body">
                <div class="col-md-6 col-xs-12" style="float: right; overflow:hidden;">
                    <?php   echo form_open($this->uri->uri_string(), array('class' => 'form-horizontal pad15L pad15R bordered-row', 'autocomplete' => 'off', 'id' => 'user_search_form')); ?>
                    <input type="text" class="form-control" name="search_data" id="search_data" placeholder="Search all users by first name, last name or email" onkeyup="ajaxSearch();" />
                    <?php echo form_close(); ?>
                </div>
                <h3 class="title-hero">
                    Manage Users
                </h3>
                
                <div class="example-box-wrapper">
                    
                    <ul class="nav-responsive nav nav-tabs">
                    	<li<?php echo $filter_type == 'all' ? ' class="active"' : ''; ?>><?php echo anchor($index_url, lang('us_tab_all')); ?></li>
						<li<?php echo $filter_type == 'teachers' ? ' class="active"' : ''; ?>><?php echo anchor("{$index_url}teachers/", 'Teachers'); ?></li>
						<li<?php echo $filter_type == 'students' ? ' class="active"' : ''; ?>><?php echo anchor("{$index_url}students/", 'Students'); ?></li>
						<li<?php echo $filter_type == 'inactive' ? ' class="active"' : ''; ?>><?php echo anchor("{$index_url}inactive/", lang('us_tab_inactive')); ?></li>
						<li<?php echo $filter_type == 'banned' ? ' class="active"' : ''; ?>><?php echo anchor("{$index_url}banned/", lang('us_tab_banned')); ?></li>
						<li<?php echo $filter_type == 'deleted' ? ' class="active"' : ''; ?>><?php echo anchor("{$index_url}deleted/", lang('us_tab_deleted')); ?></li>
                    </ul>
                    <div class="tab-content">
                        <?php //if (empty($users) || ! is_array($users)) : ?>
<p><?php //echo lang('us_no_users'); ?></p>
<?php
//else :
    $numColumns = 7;
    echo form_open();
?>
    <div class="scroll-columns">
        <table class="table table-bordered table-condensed cf">
			<thead class="cf">
				<tr>
					<th class="column-check"><input class="check-all" type="checkbox" /></th>
					<th class='id'><?php echo lang('bf_id'); ?></th>
					<th>Name</th>
					<th><?php echo lang('bf_email'); ?></th>
					<th><?php echo lang('us_role'); ?></th>
					<th class='last-login'><?php echo lang('us_last_login'); ?></th>
					<th class='status'><?php echo lang('us_status'); ?></th>
				</tr>
			</thead>
			
			<tbody class="users_data">
	            <?php /* foreach ($users as $user) : ?>
				<tr>
					<td class="column-check"><input type="checkbox" name="checked[]" value="<?php echo $user->id; ?>" /></td>
					<td class='id'><?php echo $user->id; ?></td>
					<td><?php

						$name = @$user->meta->first_name . " " . @$user->meta->last_name;
	                    echo anchor(site_url(SITE_AREA . "/settings/users/edit/{$user->id}"), $name);

						if ($user->banned) :
						?>
	                    <span class="btn btn-sm btn-warning"><?php echo lang('us_tab_banned'); ?></span>
						<?php endif; ?>
					</td>
					<td><?php echo $user->email ? mailto($user->email) : ''; ?></td>
					<td><?php echo $roles[$user->role_id]->role_name; ?></td>
					<td class='last-login'><?php echo $user->last_login != '0000-00-00 00:00:00' ? date('M j, y g:i A', strtotime($user->last_login)) : '---'; ?></td>
					<td class='status'>
						<?php if ($user->active) : ?>
						<span class="btn btn-sm btn-primary"><?php echo lang('us_active'); ?></span>
						<?php else : ?>
						<span class="btn btn-sm btn-info"><?php echo lang('us_inactive'); ?></span>
						<?php endif; ?>
					</td>
				</tr>
	            <?php endforeach; */ ?>
			</tbody>

			<tfoot>
				<tr>
	                <td colspan="<?php echo $numColumns; ?>">
						<?php
						echo lang('bf_with_selected');

						if ($filter_type == 'deleted') :
						?>
						<input type="submit" name="restore" class="btn btn-primary" value="<?php echo lang('bf_action_restore'); ?>" />
						<input type="submit" name="purge" class="btn btn-danger" value="<?php echo lang('bf_action_purge'); ?>" onclick="return confirm('<?php e(js_escape(lang('us_purge_del_confirm'))); ?>')" />
						<?php else : ?>
						<input type="submit" name="activate" class="btn btn-primary" value="<?php echo lang('bf_action_activate'); ?>" />
						<input type="submit" name="deactivate" class="btn btn-azure" value="<?php echo lang('bf_action_deactivate'); ?>" />
						<input type="submit" name="ban" class="btn btn-warning" value="<?php echo lang('bf_action_ban'); ?>" />
						<input type="submit" name="delete" class="btn btn-danger" id="delete-me" value="<?php echo lang('bf_action_delete'); ?>" onclick="return confirm('<?php e(js_escape(lang('us_delete_account_confirm'))); ?>')" />
						<?php endif;?>
					</td>
				</tr>
			</tfoot>

		</table>
	</div>
    <div id="postList">
        <?php //echo $this->ajax_pagination->create_links(); ?>
    </div>
<?php
    echo form_close();
    //echo $this->pagination->create_links();
//endif;
?>

<?php  $last_uri_segment = $this->uri->segment_array(); 

$last_uri = end($last_uri_segment);
echo '<input type="hidden" id="last_uri" value="'.$last_uri.'" />';
?>
<script>
$(document).ready(function(){
    
    var last_uri = '<?php echo $last_uri; ?>';
    var url;
    if(last_uri == 'teachers'){
        url = 'teachers';
    }
    else if(last_uri == 'students'){
        url = 'students';
    }
    else if(last_uri == 'inactive'){
        url = 'inactive';
    }
    else if(last_uri == 'banned'){
        url = 'banned';
    }
    else if(last_uri == 'deleted'){
        url = 'deleted';
    }
    else{
        url = 'all';
    }

        
    var _key = 'without_search_key';
        
    var post_data = {
        'key': _key,
        'last_uri':url,
        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
    };

    $.ajax({
        type: "GET",
        url: "<?php echo site_url('admin/settings/users'); ?>",
        data: post_data,
        success: function (response) {
            var res = $.parseJSON(response);
            
            var users = res.users;
            var row_count = res.count;
            var target = res.target;
            var n_base_url = res.base_url;
            var per_page = res.per_page;
            var last_uri = res.last_uri;
            
            if(users == 'no_user_found'){
                $('.users_data').hide().html('<tr><td></td><td>No Records Found</td></tr>').fadeIn('slow');
            }
            else{
                var s_data = {
        			'key': 'get_user_detail',
        			'user_id':users,
                    'row_count':row_count,
        		};
                
                 $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('admin/settings/users/search_query_result') ?>",
                    data: s_data,
                    success: function(data) {
                        
                        if(data.length > 0){
                            $('.users_data').hide().html(data).fadeIn('slow');
                            $('.pagination.pagination-right').hide();
                            var p_data = {
                    			'row_count':row_count,
                                'target':target,
                                'n_base_url':n_base_url,
                                'per_page':per_page,
                                'last_uri':last_uri,
                    		};
                            $.ajax({
                                type: "POST",
                                url: "<?php echo site_url('admin/settings/users/get_pagination') ?>",
                                data: p_data,
                                success: function(data) {
                                    
                                    if(data.length > 0){
                                        $('#postList').hide().html(data).fadeIn('slow');
                                    }
                                },
                            });  
                            
                            //$('.pagination.pagination-right').show('slow');
                        }
                    },
                 });  
            }
        }
     });
    
});
</script>

<script type="text/javascript">



function ajaxSearch()
{
    var input_data = $('#search_data').val();

    if (input_data.length == 0)
    {
        var _key = 'search_key';
        
        var post_data = {
            'search_data': input_data,
            'key': _key,
            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
        };

        $.ajax({
            type: "GET",
            url: "<?php echo site_url('admin/settings/users'); ?>",
            data: post_data,
            
            success: function (response) {
                
                var res = $.parseJSON(response);
                
                var users = res.users;
                var row_count = res.count;
                
                var row_count = res.count;
                var target = res.target;
                var n_base_url = res.base_url;
                var per_page = res.per_page;
                
                if(users == 'no_user_found'){
                    $('.users_data').hide().html('<tr><td></td><td>No Records Found</td></tr>').fadeIn('slow');
                }
                else{
                    var s_data = {
            			'key': 'get_user_detail',
            			'user_id':users,
                        'row_count':row_count,
            		};
                    
                     $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('admin/settings/users/search_query_result') ?>",
                        data: s_data,
                        success: function(data) {
                            
                            if(data.length > 0){
                                $('.users_data').hide().html(data).fadeIn('slow');
                                $('.pagination.pagination-right').hide();
                                var p_data = {
                        			'row_count':row_count,
                                    'target':target,
                                    'n_base_url':n_base_url,
                                    'per_page':per_page,
                        		};
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo site_url('admin/settings/users/get_pagination') ?>",
                                    data: p_data,
                                    success: function(data) {
                                        
                                        if(data.length > 0){
                                            $('#postList').hide().html(data).fadeIn('slow');
                                        }
                                    },
                                }); 
                            }
                        },
                     });  
                }  
            }
         });
        
    }
    else
    {
        var _key = 'search_key';
        
        var post_data = {
            'search_data': input_data,
            'key': _key,
            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
        };

        $.ajax({
            type: "GET",
            url: "<?php echo site_url('admin/settings/users'); ?>",
            data: post_data,
            
            success: function (response) {
                
                var res = $.parseJSON(response);
                var row_count = res.count;
                var users = res.users;
                
                var row_count = res.count;
                var target = res.target;
                var n_base_url = res.base_url;
                var per_page = res.per_page;
                var user_search_data = res.search;
                var search_data = res.search_data;
                
                if(users == 'no_user_found'){
                    $('.users_data').hide().html('<tr><td></td><td>No Records Found</td></tr>').fadeIn('slow');
                }
                else{
                    var s_data = {
            			'key': 'get_user_detail',
            			'user_id':users,
                        'row_count':row_count,
            		};
                    
                     $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('admin/settings/users/search_query_result') ?>",
                        data: s_data,
                        success: function(data) {
                            
                            if(data.length > 0){
                                $('.users_data').hide().html(data).fadeIn('slow');
                                $('.pagination.pagination-right').hide();
                                var p_data = {
                        			'row_count':row_count,
                                    'target':target,
                                    'n_base_url':n_base_url,
                                    'per_page':per_page,
                                    'user_search_data':user_search_data,
                                    'search_data':search_data,
                        		};
                                
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo site_url('admin/settings/users/get_pagination') ?>",
                                    data: p_data,
                                    success: function(data) {
                                        
                                        if(data.length > 0){
                                            $('#postList').hide().html(data).fadeIn('slow');
                                        }
                                    },
                                }); 
                            }
                        },
                     });  
                }

            }
         });

     }
}
</script>


