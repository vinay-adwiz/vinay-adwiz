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

/**
 * Date Helpers
 *
 * Includes additional date-related functions helpful in Bonfire development.
 *
 * @package    Bonfire
 * @subpackage Helpers
 * @category   Helpers
 * @author     Bonfire Dev Team
 * @link       http://guides.cibonfire.com/helpers/address_helpers.html
 *
 */

if ( ! function_exists('relative_time'))
{
	/**
	 * Takes a UNIX timestamp and returns a string representing how long ago that date was, like "moments ago", "2 weeks ago", etc.
	 *
	 * @param $timestamp int A UNIX timestamp
	 *
	 * @return string A human-readable amount of time 'ago'
	 */
	function relative_time($timestamp)
	{
		if($timestamp != "" && !is_int($timestamp)){
			$timestamp = strtotime($timestamp);
		}

		if(!is_int($timestamp)){
			return "never";
		}

		$difference = time() - $timestamp;

		$periods = array("moment", "min", "hour", "day", "week",
		"month", "year", "decade");

		$lengths = array("60","60","24","7","4.35","12","10", "10");

		if ($difference >= 0)
		{
			// this was in the past
			$ending = "ago";
		}
		else
		{
			// this was in the future
			$difference = -$difference;
			$ending = "to go";
		}

		for ($j = 0; $difference >= $lengths[$j]; $j++)
		{
			$difference /= $lengths[$j];
		}

		$difference = round($difference);

		if ($difference != 1)
		{
			$periods[$j].= "s";
		}

		if ($difference < 60 && $j == 0)
		{
			$text = "$periods[$j] $ending";
		}
		else
		{
			$text = "$difference $periods[$j] $ending";
		}

		return $text;

	}//end relative_time()
}

//---------------------------------------------------------------

if (!function_exists('date_difference'))
{
	/**
	 * Returns the difference between two dates.
	 *
	 * @param $start mixed The start date in either unix timestamp or a format that can be used within strtotime().
	 * @param $end mixed The ending date in either unix timestamp or a format that can be used within strtotime().
	 * @param $interval string A string with the interval to use. Choices 'week', 'day', 'hour', 'minute'.
	 * @param $reformat boolean If TRUE, will reformat the time using strtotime().
	 *
	 * @return int A number representing the difference between the two dates in the interval desired.
	 */
	function date_difference($start=null, $end=null, $interval='day', $reformat=false)
	{
		if (is_null($start))
		{
			return false;
		}

		if (is_null($end))
		{
			$end = date('Y-m-d H:i:s');
		}

		$times = array(
			'week'		=> 604800,
			'day'		=> 86400,
			'hour'		=> 3600,
			'minute'	=> 60
		);

		if ($reformat === true)
		{
			$start 	= strtotime($start);
			$end	= strtotime($end);
		}

		$diff = $end - $start;

		return round($diff / $times[$interval]);

	}//end date_difference()
}

//---------------------------------------------------------------

if ( ! function_exists('user_time'))
{
	/**
	 * Converts unix time to a human readable time in user timezone
	 * or in a given timezone.
	 *
	 * For supported timezones visit - http://php.net/manual/timezones.php
	 * For accepted formats visit - http://php.net/manual/function.date.php
	 *
	 * @example echo user_time();
	 * @example echo user_time($timestamp, 'EET', 'l jS \of F Y h:i:s A');
	 *
	 * @param int    $timestamp A UNIX timestamp. If non is given current time will be used.
	 * @param string $timezone  The timezone we want to convert to. If none is given a current logged user timezone will be used.
	 * @param string $format    The format of the outputted date/time string
	 *
	 * @return string A string formatted according to the given format using the given timestamp and given timezone or the current time if no timestamp is given.
	 */
	function user_time($timestamp = NULL, $timezone = NULL, $format = 'r')
	{
		if ( ! $timezone)
		{
			$CI =& get_instance();
			$CI->load->library('users/auth');
			if ($CI->auth->is_logged_in())
			{
				$timezone = standard_timezone($CI->auth->user()->timezone);
			}
		}

		$timestamp = ($timestamp) ? $timestamp : time();

		$dtzone = new DateTimeZone($timezone);
		$dtime = new DateTime();

		return $dtime->setTimestamp($timestamp)->setTimeZone($dtzone)->format($format);

	}//end user_time()
}

//---------------------------------------------------------------

if ( ! function_exists('mysql_date_convert'))
{
	function mysql_date_convert($time_to_convert = NULL)
    {
    	if (is_null($time_to_convert)) {
			return date('Y-m-d G:i:s');
		} else {
			return date('Y-m-d G:i:s', $time_to_convert);
		}
	}
}


// formats date from DB in yyyy-mm-dd and hh:mm into nice clean readable format
if ( ! function_exists('format_class_date_time'))
{
	function format_class_date_time($the_date, $the_time)
    {
    	$date_ts = strtotime($the_date . " " . $the_time);
    	return date("F j Y, g:i A", $date_ts); 
	}
}

// Used to convert a time from Bangkok to other timezones
if ( ! function_exists('english_gang_time_conversions'))
{
	function english_gang_time_conversions($time_to_convert, $new_timezone)
    {
    	$date = new DateTime('2000-01-01 ' . $time_to_convert, new DateTimeZone('Asia/Bangkok'));

    	$date->setTimezone(new DateTimeZone($new_timezone));

    	// return time in 1:00 AM format
    	return $date->format('g:i A');
	}
}


if ( ! function_exists('standard_timezone'))
{
    /**
     * Convert CodeIgniter's time zone strings to standard PHP time zone strings
     *
     * @param String $ciTimezone A time zone string generated by CodeIgniter
     *
     * @return String    A PHP time zone string
     */
    function standard_timezone($ciTimezone)
    {
        switch ($ciTimezone) {
            case 'UM12':
                return 'Pacific/Kwajalein';
            case 'UM11':
                return 'Pacific/Midway';
            case 'UM10':
                return 'Pacific/Honolulu';
            case 'UM95':
                return 'Pacific/Marquesas';
            case 'UM9':
                return 'Pacific/Gambier';
            case 'UM8':
                return 'America/Los_Angeles';
            case 'UM7':
                return 'America/Boise';
            case 'UM6':
                return 'America/Chicago';
            case 'UM5':
                return 'America/New_York';
            case 'UM45':
                return 'America/Caracas';
            case 'UM4':
                return 'America/Sao_Paulo';
            case 'UM35':
                return 'America/St_Johns';
            case 'UM3':
                return 'America/Buenos_Aires';
            case 'UM2':
                return 'Atlantic/St_Helena';
            case 'UM1':
                return 'Atlantic/Azores';
            case 'UP1':
                return 'Europe/Berlin';
            case 'UP2':
                return 'Europe/Kaliningrad';
            case 'UP3':
                return 'Asia/Baghdad';
            case 'UP35':
                return 'Asia/Tehran';
            case 'UP4':
                return 'Asia/Baku';
            case 'UP45':
                return 'Asia/Kabul';
            case 'UP5':
                return 'Asia/Karachi';
            case 'UP55':
                return 'Asia/Calcutta';
            case 'UP575':
                return 'Asia/Kathmandu';
            case 'UP6':
                return 'Asia/Almaty';
            case 'UP65':
                return 'Asia/Rangoon';
            case 'UP7':
                return 'Asia/Bangkok';
            case 'UP8':
                return 'Asia/Hong_Kong';
            case 'UP875':
                return 'Australia/Eucla';
            case 'UP9':
                return 'Asia/Tokyo';
            case 'UP95':
                return 'Australia/Darwin';
            case 'UP10':
                return 'Australia/Melbourne';
            case 'UP105':
                return 'Australia/LHI';
            case 'UP11':
                return 'Asia/Magadan';
            case 'UP115':
                return 'Pacific/Norfolk';
            case 'UP12':
                return 'Pacific/Fiji';
            case 'UP1275':
                return 'Pacific/Chatham';
            case 'UP13':
                return 'Pacific/Samoa';
            case 'UP14':
                return 'Pacific/Kiritimati';
            case 'UTC':
            default:
                return 'UTC';
        }
    }
}