<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Zoom extends Front_Controller
{
    
    /**
     * Setup the required libraries etc.
     *
     * @retun void
     */
    public function __construct()
    {
        parent::__construct();
        
        
        // Load facebook library
		$this->load->library('facebook');

        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->load->model('users/user_model');

        $this->load->library('users/auth');

        $this->lang->load('users');
        
        if(!$this->auth->is_logged_in()){    
            redirect('/');
        }           
        
    }
    
    /**
     * 
     * Get all zoom user with url = ./users/zoom/zoom_users 
     * 
     * */
    public function zoom_users(){
        
        $user = $this->session->userdata('user'); 
        
        $curl_data = get_web_page("https://api.zoom.us/v2/users",array(),"GET", 'Bearer '.$user['zoom_token']);
                
        $user_data = json_decode($curl_data['content']);
        
        Template::set('user_data',$user_data);        
        Template::set_view('users/zoom_users/index');
        Template::render();
        
    }
    
    /**
     * 
     * get and display all zoom users list url = ./users/zoom_user 
     * 
     * */
     
    /*public function get_users_list(){
        
        
        
        
        Template::set_view('users/zoom_users/index');
        Template::render();
        
        $return_array = array();
        
        if(!empty($_POST)){
            
            if($_POST['key'] == 'bf_zoom_users_list'){
                
                $zoom_token = base64_decode($_POST['zoom_token']);
                
                $explode_token = explode('R@d@1',$zoom_token);
                
                $explode_token = explode('g@nG',$explode_token[1]);
                
                $curl_data = get_web_page("https://api.zoom.us/v2/users",array(),"GET", 'Bearer '.$explode_token[0]);
                
                $response = json_decode($curl_data['content']);
                
                foreach($response->users as $user_data){
                    ?>
                    <tr>
    					<td><?php
    
    						$name = @$user_data->first_name . " " . @$user_data->last_name;
    	                    echo anchor(site_url("users/zoom_user/{$user_data->id}"), $name);
    
    						?>
    					</td>
    					<td><?php echo $user_data->email ? mailto($user_data->email) : ''; ?></td>
    					
    					<td class='action'>
                            <a href="<?php echo site_url('/users/edit_zoom_user/'.$user_data->id) ?>" class="btn btn-sm btn-primary edit_zoom_user" user_id="<?php echo $user_data->id; ?>">Edit</a>
    						<a class="btn btn-sm btn-danger delete_zoom_user" user_id="<?php echo $user_data->id; ?>">Delete</a>
    					</td>
    				</tr>
                    
                    
                    <?php
                    
                }//foreach   
            }
            
        }
        
    }*/
    
    
    /**
     * 
     * Add zoom user with url = ./users/zoom/add_zoom_user 
     * 
     * */
    public function add_zoom_user(){
        
        Template::set_view('users/zoom_users/add_zoom_user');
        Template::render();
    }
    
    /**
     * 
     * Add zoom user with type = 2 url = ./users/zoom/add_zoom_user 
     * 
     * */
     
    public function create_zoom_user(){
        
        $return_array = array();
        
        if(!empty($_POST)){
            
            if($_POST['key'] == 'bf_add_zoom_user'){
                
                $user = $this->session->userdata('user'); 
        
                $first_name = $_POST['zoom_fname'];
                $last_name  = $_POST['zoom_lname'];
                $email      = $_POST['zoom_email'];
                
                
                $create_user = array();
        
                $create_user['action'] = "create";
                $create_user['user_info']['email'] = $email;
                $create_user['user_info']['type'] = 2;
                $create_user['user_info']['first_name'] = $first_name;
                $create_user['user_info']['last_name'] = $last_name;
                
                $curl_data = get_web_page("https://api.zoom.us/v2/users",$create_user,"POST", 'Bearer '.$user['zoom_token']);
                
                $response = json_decode($curl_data['content']);
                
                
                if(!empty($response->id)){
                    $return_array['status'] = 'success';
                }
                else{
                    $return_array['status'] = 'error';
                }
                
            }
        }
        
        echo json_encode($return_array);
        
    }
    
    
    /**
     * 
     * Delete zoom user with type = 2 url = ./users/delete_zoom_user 
     * 
     * */
     
    public function delete_zoom_user(){
        
        
        $user = $this->session->userdata('user'); 
        
        $return_array = array();
        
        if(!empty($_POST)){
            
            if($_POST['key'] == 'bf_delete_zoom_user'){
                
                $user_id = $_POST['zoom_user_id'];
                
                $curl_data = get_web_page("https://api.zoom.us/v2/users/".$user_id,array(),"DELETE", 'Bearer '.$user['zoom_token']);

                if($curl_data['http_code'] == "204"){
                    $return_array['status'] = 'success';
                }
                else{
                    $return_array['status'] = 'error';
                }
                
            }
        }
        
        echo json_encode($return_array);
        
        
    }
    
    
    /**
     * 
     * Retrive zoom user with url = ./users/zoom/zoom_user/zoom_user_id 
     * 
     * */
    public function zoom_user($user_id = ''){
        
        $user = $this->session->userdata('user'); 
        
        $curl_data = get_web_page("https://api.zoom.us/v2/users/".$user_id,array(),"GET", 'Bearer '.$user['zoom_token']);
        
        $user_data = json_decode($curl_data['content']);
        
        Template::set('user_data',$user_data);
        Template::set('user_id',$user_id);
        Template::set_view('users/zoom_users/zoom_user');
        Template::render();
    }
    
    
    /**
     * 
     * Retrieve zoom user. url = ./users/zoom/zoom_user/zoom_user_id 
     * 
     * */
     
    /*public function retrieve_zoom_user(){
        
        $return_array = array();
        
        if(!empty($_POST)){
            
            if($_POST['key'] == 'bf_retrieve_zoom_user'){
                
                $zoom_token = base64_decode($_POST['zoom_token']);
                
                $explode_token = explode('R@d@1',$zoom_token);
                
                $explode_token = explode('g@nG',$explode_token[1]);
                
                $user_id = $_POST['zoom_user_id'];
                
                $curl_data = get_web_page("https://api.zoom.us/v2/users/".$user_id,array(),"GET", 'Bearer '.$explode_token[0]);
                
                if(!empty($curl_data['content'])){
                    $response = json_decode($curl_data['content']);
                    
                    echo '<tr>
        					<td style="font-weight: 600;">Name</td>
        					<td>'.$response->first_name.' '.$response->last_name.'</td>
        				 </tr>
                         <tr>    	
        					<td style="font-weight: 600;">Email</td>
                            <td>'.mailto($response->email).'</td>
        				</tr>
                        <tr>    	
        					<td style="font-weight: 600;">Timezone</td>
                            <td>'.$response->timezone.'</td>
        				</tr>';
                        
                }

            }
        }

    }*/
    
    
    /**
     * 
     * edit zoom user with url = ./users/zoom/edit_zoom_user/zoom_user_id 
     * 
     * */
    public function edit_zoom_user($user_id = ''){
        
        $user = $this->session->userdata('user'); 
        
        $curl_data = get_web_page("https://api.zoom.us/v2/users/".$user_id,array(),"GET", 'Bearer '.$user['zoom_token']);
        
        $user_data = json_decode($curl_data['content']);
        
        Template::set('user_id',$user_id);
        Template::set('user_data',$user_data);
        Template::set_view('users/zoom_users/edit_zoom_user');
        Template::render();
    }
    
    public function update_zoom_user(){
        
        $user = $this->session->userdata('user'); 
        
        $return_array = array();
        
        if(!empty($_POST)){
            
            if($_POST['key'] == 'bf_update_zoom_user'){
                
                $user_id = $_POST['user_id'];
                $zoom_fname = $_POST['zoom_fname'];
                $zoom_lname = $_POST['zoom_lname'];
                $zoom_email = $_POST['zoom_email'];
                
                
                $update_user = array();
        
                $update_user['email'] = $zoom_email;
                $update_user['first_name'] = $zoom_fname;
                $update_user['last_name'] = $zoom_lname;
                
                $curl_data = get_web_page("https://api.zoom.us/v2/users/".$user_id,$update_user,"PATCH", 'Bearer '.$user['zoom_token']);
                
                if($curl_data['http_code'] == "204"){
                    $return_array['status'] = 'success';
                }
                else{
                    $return_array['status'] = 'error';
                }
            }
            
            echo json_encode($return_array);
            
        }
        
    }
    
}