<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Bonfire
 *
 * An open source project to allow developers get a jumpstart their development of CodeIgniter applications
 *
 * @package   Bonfire
 * @author    Bonfire Dev Team
 * @copyright Copyright (c) 2011 - 2013, Bonfire Dev Team
 * @license   http://guides.cibonfire.com/license.html
 * @link      http://cibonfire.com
 * @since     Version 1.0
 * @filesource
 */


if ( ! function_exists('getGender'))
{
    // Small function to convert gender code to name
    function getGender($gender) {

        if (strtoupper($gender) == 'M') {
            return 'Male';
        } elseif (strtoupper($gender) == 'F') {
            return 'Female';
        } {
            return 'Other';
        }
    }
}

function generate_referral_code($length) {

    $data = array('1','2','3','4','5','6','7','8','9','0','A','B','C','D','E','G', 'H', 'I', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T');
    $res = '';
    $random_keys=array_rand($data, $length);

    for ($i=0; $i<sizeof($random_keys); $i++){
        
        $res .= $data[$random_keys[$i]];
    }

    return $res;
}


if ( ! function_exists('in_string'))
{
	function in_string($haystack, $needle)
	{
		if (strpos($haystack, $needle) !== false) {
		    return true;
		} else {
			return false;
		}

	} //end in_string()
}

if ( ! function_exists('ttruncat'))
{
	function ttruncat($text,$numb) {

	    $text = strip_tags($text);

	    if (strlen($text) > $numb) {   
	        $text = substr($text, 0, $numb);
	        $text = substr($text,0,strrpos($text," "));
	        $etc = "...";
	        $text = $text.$etc;
	    }  

	   return $text;
	}
}


if (! function_exists('get_country_codes')) {
	function get_country_codes()
	{
		$CI =& get_instance();
		$CI->load->database();

		$result = array();
		$query = $CI->db->select('iso, dial_code')->get("countries");
		foreach ($query->result_array() as $item)
			$result[$item['iso']] = $item['dial_code'];
		return $result;
	}
}