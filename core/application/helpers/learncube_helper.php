<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
    /**
     * 
     * Get a validation token to make an API call
     * Tokens are only valid for 5 minutes
     * 
     * */
    function get_auth_token($api_public_key,$api_private_key){
        
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://app.learncube.com/api/virtual-classroom/get-api-token/');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"api_public_key\": \"".$api_public_key."\", \"api_private_key\": \"".$api_private_key."\"}");
        curl_setopt($ch, CURLOPT_POST, 1);

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            return false;
        }
        curl_close ($ch);

        $res = json_decode($result);

        if (isset($res->token)) {
            return $res->token;
        } else {
            return false;
        }
    }

 
    function create_learncube_class($room_token, $description, $start_class, $end_class, $max_participants) {

        $learncube_token = get_auth_token(LEARNCUBE_PUBLIC_KEY, LEARNCUBE_PRIVATE_KEY); 

        if ($learncube_token) {

            $ch = curl_init();

            $query_string = "room_token=".$room_token."&description=".$description."&start=".$start_class."&end=".$end_class."&max_participants=" . $max_participants;

            curl_setopt($ch, CURLOPT_URL,"https://app.learncube.com/api/virtual-classroom/classrooms/");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $query_string);


            $headers = array();
            $headers[] = 'Authorization: Bearer ' . $learncube_token;
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                //echo 'Error:' . curl_error($ch);
                return false;
            }
            curl_close ($ch);

            $res = json_decode($result);
            return $res;

        } else {
            return false;
        }
    }

    function sso_user_exists($student_id) {

        $learncube_token = get_auth_token(LEARNCUBE_PUBLIC_KEY, LEARNCUBE_PRIVATE_KEY);

        if ($learncube_token) {

            $ch = curl_init();

            $user_reference = generate_sso_user_reference($student_id);

            curl_setopt($ch, CURLOPT_URL,"https://englishgang.live-online-classes.com/rest-api/v3/users/" . $user_reference . "/");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
           
            $headers = array();
            $headers[] = 'Authorization: Bearer ' . $learncube_token;
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $result = curl_exec($ch);
            $header  = curl_getinfo( $ch );
            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch); 
                die();
            }
            curl_close ($ch);

            $res = json_decode($result);
            // echo "<pre>"; 
            // print_r($header); print_r($result); 
            // print_r($res); 
            //print_r($learncube_token); 
            // die();
            if (empty($res) || $res === false || @$res->detail === 'Not found.') {
                return false;
            } else {
                return true;
            }
        } else {
            die('Invalid Authorization Token');
        }
    }
    
    function create_learncube_user($c_data) {

        $learncube_token = get_auth_token(LEARNCUBE_PUBLIC_KEY, LEARNCUBE_PRIVATE_KEY); 

        if ($learncube_token) {
            $c_data = json_encode($c_data);
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL,"https://englishgang.live-online-classes.com/rest-api/v3/create-user/");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $c_data);
            
            $headers = array();
            $headers[] = "Content-Length: ".strlen($c_data);
            $headers[] = "Content-Type: application/json; charset=utf-8";
            $headers[] = 'Accept: application/json';
            $headers[] = 'Authorization: Bearer ' . $learncube_token;
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            
            $result = curl_exec($ch);
            // $info = curl_getinfo($ch);
            // dump($info); die();
            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch); 
                die();
            }
            curl_close ($ch);
            $res = json_decode($result);
            if (empty($res) || $res === false) {
                return false;
            } else {
                return $res;
            }
        } else {
            die('Invalid Authorization Token');
        }
    }

    function generate_room_token( $student_id) {
        return 'EG' . $student_id . '-' . date('YmdGis');
    }

    function generate_sso_user_reference( $student_id) {
        return $student_id . '-EG';
    }

    function generate_sso_validation_token( $student_id) {
        $create_token = 'EG' . $student_id . '-' . date('Ymd');
        return md5($create_token);
    }

    function generate_class_room_url( $room_token, $user_id) {
        return LEARNCUBE_CLASS_URL . "?pub_key=".LEARNCUBE_PUBLIC_KEY."&room_token=".$room_token."&userid=" . $user_id;
    }

    function format_learncube_iso_date($timestamp) {
        return  date('Y-m-d\TG:s', $timestamp);
    }
