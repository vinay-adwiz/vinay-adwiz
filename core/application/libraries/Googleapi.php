<?php
/**
 * @package Google API :  Google Client API
 *
 * @author TechArise Team
 *
 * @email  info@techarise.com
 *   
 * Description of Contact Controller
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Googleapi 
{
    /**
     * Googleapi constructor.
     */
    public function __construct() {        
      // load google client api
        $this->ci =& get_instance();
        
        require_once '../vendor/autoload.php';
        
        $this->client = new Google_Client();
        $application_creds = FCPATH.'gcal-details/'.$this->ci->config->item('calendar_file_name');//the Service Account generated cred in JSON
        $credentials_file = file_exists($application_creds) ? $application_creds : false;
        $redirect_uri = current_url();//'http://localhost/english_gang/english-gang-student/public/profiles/teacher/106';
        $this->client->setAuthConfig($credentials_file);
        $this->client->setApplicationName($this->ci->config->item('calendar_app_name'));
        $this->client->setAccessType('offline');
        $this->client->setPrompt('select_account consent');
        $this->client->addScope(Google_Service_Calendar::CALENDAR);
        
        $tokenPath = FCPATH.'gcal-details/calendar_token.json';
        if (file_exists($tokenPath)) {
            $accessToken = json_decode(file_get_contents($tokenPath), true);
            $this->client->setAccessToken($accessToken);
        }
        
        if ($this->client->isAccessTokenExpired()) {
            if ($this->client->getRefreshToken()) {
                $this->client->fetchAccessTokenWithRefreshToken($this->client->getRefreshToken());
            }else{
                $accessToken = $this->client->fetchAccessTokenWithAssertion();
                if (array_key_exists('error', $accessToken)) {
                    throw new Exception(join(', ', $accessToken));
                }else{
                    // Save the token to a file.
                    if (!file_exists(dirname($tokenPath))) {
                        mkdir(dirname($tokenPath), 0700, true);
                    }
                    file_put_contents($tokenPath, json_encode($this->client->getAccessToken()));
                }
            }
        } 
        /*require_once substr(FCPATH,0,-7).'vendor/autoload.php';
        $this->client = new Google_Client();
        //$this->client->setApplicationName('Calendar Api');
        $this->ci =& get_instance();
        $this->client->setClientId($this->ci->config->item('client_id'));
        $this->client->setClientSecret($this->ci->config->item('client_secret'));
        //$this->client->setRedirectUri($this->ci->config->base_url().'gc/auth/oauth');
        $this->client->addScope(Google_Service_Calendar::CALENDAR);
        //$this->client->addScope('profile');*/
    }

    public function loginUrl() {
        return $this->client->createAuthUrl();
    }

    public function getAuthenticate() {
        return $this->client->authenticate();
    }

    public function getAccessToken() {
        return $this->client->getAccessToken();
    }

    public function setAccessToken() {
        return $this->client->setAccessToken();
    }

    public function revokeToken() {
        return $this->client->revokeToken();
    }

    public function client() {
        return $this->client;
    }

    public function getUser() {
        $google_ouath = new Google_Service_Oauth2($this->client);
        return (object)$google_ouath->userinfo->get();
    }

    public function isAccessTokenExpired() {
        return $this->client->isAccessTokenExpired();
    }
}
?>