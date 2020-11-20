<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

/*
 * Changes:
 * 1. This project contains .htaccess file for windows machine.
 *    Please update as per your requirements.
 *    Samples (Win/Linux): http://stackoverflow.com/questions/28525870/removing-index-php-from-url-in-codeigniter-on-mandriva
 *
 * 2. Change 'encryption_key' in application\config\config.php
 *    Link for encryption_key: http://jeffreybarke.net/tools/codeigniter-encryption-key-generator/
 * 
 * 3. Change 'jwt_key' in application\config\jwt.php    
 *
 */

class Zoom_auth extends REST_Controller
{
    
    /**
     * Setup the required libraries etc.
     *
     * @retun void
     */
    public function __construct()
    {
        parent::__construct();
        
        $key = ZOOM_AUTH_KEY;
        $token = array(
    		"iss" => $key,
            // The benefit of JWT is expiry tokens, we'll set this one to expire in 2 hours
    		"exp" => time() + 72000
    	);
        
        $output['token'] = AUTHORIZATION::generateToken($token);
        
        $this->set_response($output, REST_Controller::HTTP_OK);
        
        $data = $this->session->userdata('user');  

        $data['zoom_token'] = $output['token'];  
          
        $this->session->set_userdata('user', $data);         
        
        
    }
    
    /**
     * URL: http://localhost/CodeIgniter-JWT-Sample/auth/token
     * Method: GET
     */
    public function token_get()
    {
        $key = ZOOM_AUTH_KEY;
        $token = array(
    		"iss" => $key,
            // The benefit of JWT is expiry tokens, we'll set this one to expire in 1 minute
    		"exp" => time() + 3000
    	);
        
        if(!empty($_GET)){
            if($_GET['key']=='bf_zoom_users_token'){
                $output['token'] = AUTHORIZATION::generateToken($token);
                
                $this->set_response($output, REST_Controller::HTTP_OK);
                
                $data = $this->session->userdata('user');  
  
                $data['zoom_token'] = $output['token'];  
                  
                $this->session->set_userdata('user', $data);         
            }
        }
        
        //$this->response($this->db->get('books')->result());
        $key = ZOOM_AUTH_KEY;
        //$tokenData = array();
        $token = array(
    		"iss" => $key,
            // The benefit of JWT is expiry tokens, we'll set this one to expire in 1 minute
    		"exp" => time() + 3000
    	);
        
        $output['token'] = AUTHORIZATION::generateToken($token);
        
        $this->set_response($output, REST_Controller::HTTP_OK);
	    
    }

    /**
     * URL: http://localhost/CodeIgniter-JWT-Sample/auth/token
     * Method: POST
     * Header Key: Authorization
     * Value: Auth token generated in GET call
     */
    public function token_post()
    {
        $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
                $this->set_response($decodedToken, REST_Controller::HTTP_OK);
                return;
            }
        }

        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    }
    
    
}