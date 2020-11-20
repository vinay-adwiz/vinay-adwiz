<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
    /**
     * 
     * Get all zoom user with url = ./users/zoom/zoom_users 
     * 
     * */
    function zoom_users($user){
        
        $curl_data = get_web_page("https://api.zoom.us/v2/users",array(),"GET", 'Bearer '.$user['zoom_token']);
        $user_data = json_decode($curl_data['content']);
        
        return $user_data;
    }
    
   
    /**
     * 
     * Delete zoom user with type = 2 url = ./users/delete_zoom_user 
     * 
     * */
     
    function delete_zoom_user(){
        
        
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
     * Retrieve zoom user with url = ./users/zoom/zoom_user/zoom_user_id 
     * 
     * */
    function zoom_user($user_email = '', $zoom_token){

        $curl_data = get_web_page("https://api.zoom.us/v2/users/".$user_email,array(),"GET", 'Bearer '.$zoom_token['zoom_token']);
        $user_data = json_decode($curl_data['content']);
        
        // $curl_meeting_data = get_web_page("https://api.zoom.us/v2/users/".$user_email."/meetings",array(),"GET", 'Bearer '.$user['zoom_token']);
        // $user_meetings = json_decode($curl_meeting_data['content']);
        
        return $user_data;
    }
    
    /**
     * 
     * Retrive zoom user with url = ./users/zoom/zoom_meeting/zoom_meeting_id 
     * 
     * */
    function zoom_meeting($meeting_id = ''){
        
        $user = $this->session->userdata('user'); 
        
        $curl_data = get_web_page("https://api.zoom.us/v2/meetings/".$meeting_id,array(),"GET", 'Bearer '.$user['zoom_token']);
        
        $meeting_data = json_decode($curl_data['content']);
        
        Template::set('meeting_data',$meeting_data);
        Template::set('meeting_id',$meeting_id);
        Template::set_view('users/zoom_users/zoom_meeting');
        Template::render();
    }
    
    
    /**
     * 
     * Delete zoom meeting 
     * 
     * */
     
    function delete_zoom_meeting(){
        
        $user = $this->session->userdata('user'); 
        
        $return_array = array();
        
        if(!empty($_POST)){
            
            if($_POST['key'] == 'bf_delete_zoom_meeting'){
                
                $zoom_meeting_id = $_POST['zoom_meeting_id'];
                
                $curl_data = get_web_page("https://api.zoom.us/v2/meetings/".$zoom_meeting_id,array(),"DELETE", 'Bearer '.$user['zoom_token']);

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
     * Show add zoom meeting form with url = ./users/zoom/add_zoom_meeting 
     * 
     * */
    function add_zoom_meeting(){
        
        $this->load->config('timezones');
        
        $timezones = $this->config->item('countries.timezones');
        
        $user_email = $this->session->userdata('login_email');
        $user = $this->session->userdata('user'); 
        
        $check_user = zoom_user($user_email, $zoom_token);
        if($check_user->code = ZOOM_USER_NOT_FOUND_CODE) {
            $teacher_email = ZOOM_OVERRIDE_USER;
        }

        $curl_data = get_web_page("https://api.zoom.us/v2/users/".$user_email,array(),"GET", 'Bearer '.$user['zoom_token']);
        
        $response = json_decode($curl_data['content']);
        
        Template::set('user_data',$response);
        Template::set('timezones',$timezones);
        Template::set_view('users/zoom_users/add_zoom_meeting');
        Template::render();
    }

    /**
     * 
     * Create a zoom meeting 
     * 
     * */
     
    function create_zoom_meeting($teacher_email, $zoom_token, $meeting_details) {

        $create_meeting = array();

        $create_meeting['topic'] = $meeting_details['topic'];  // this is lesson name passed in from calendar
        $create_meeting['type'] = ZOOM_MEETING_TYPE_SCHEDULED;
        $create_meeting['start_time'] = date('c', strtotime($meeting_details['start_date'].' '.$meeting_details['start_time']));
        $create_meeting['duration'] = '30';
        $create_meeting['timezone'] = 'Asia/Bangkok';
        
        $curl_data = get_web_page("https://api.zoom.us/v2/users/".$teacher_email."/meetings",$create_meeting,"POST", 'Bearer '.$zoom_token['zoom_token']);
        
        $response = json_decode($curl_data['content']);

        return $response;
        
    }