<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Curl function start
if(! function_exists('get_web_page'))
{
    function get_web_page($url, $post_arr=array(), $type="POST", $auth="")
    {
        $user_agent='Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0';
        
        //$post_arr = array("temp_id"=>2);
        $options = array(

            CURLOPT_CUSTOMREQUEST  =>((count($post_arr) > 0)?$type:(($type == "DELETE")?$type:"GET")),        //set request type post or get
            CURLOPT_POST           =>((count($post_arr) > 0)?true:false),        //set to GET or POST
            CURLOPT_USERAGENT      => $user_agent, //set user agent
            CURLOPT_COOKIEFILE     =>"cookie.txt", //set cookie file
            CURLOPT_COOKIEJAR      =>"cookie.txt", //set cookie jar
            CURLOPT_RETURNTRANSFER => true,     // return web page
            CURLOPT_HEADER         => false,    // don't return headers
            CURLOPT_FOLLOWLOCATION => true,     // follow redirects
            CURLOPT_ENCODING       => "",       // handle all encodings
            CURLOPT_AUTOREFERER    => true,     // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
            CURLOPT_TIMEOUT        => 120,      // timeout on response
            CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
            CURLOPT_SSL_VERIFYPEER => false,
        );
        
        //set post varibles
        if(count($post_arr) > 0)
        {
            $field_string = json_encode($post_arr);
            //$field_string = http_build_query($post_arr);
            $options[CURLOPT_HTTPHEADER] = array('Content-Length: ' . strlen($field_string),"Content-Type: application/json; charset=utf-8", 'Accept: application/json');
            if(strlen(trim($auth)) > 0){ $options[CURLOPT_HTTPHEADER][] =  "Authorization: ".$auth; }
            $options[CURLOPT_POSTFIELDS] = $field_string;
            //$url = $url."?".$field_string;
        }else{
            if(strlen(trim($auth)) > 0){
                $options[CURLOPT_HTTPHEADER] = array("Content-Type: application/json; charset=utf-8", 'Accept: application/json', 'Authorization: '.$auth);
            }
        }
        //End
       
        if (isset($proxy)) {    // If the $proxy variable is set, then
            //$options[CURLOPT_PROXY] = $proxy;
            //$options[CURLOPT_HTTPPROXYTUNNEL] = 0;
        }
        
        //print_r($options);die;
        $ch      = curl_init( $url );
        curl_setopt_array( $ch, $options );
        $content = curl_exec( $ch );
        $err     = curl_errno( $ch );
        $errmsg  = curl_error( $ch );
        $header  = curl_getinfo( $ch );
        curl_close( $ch );

        $header['errno']   = $err;
        $header['errmsg']  = $errmsg;
        $header['content'] = $content;
        //print_r($header);die;
        return $header;
    }
}
//End