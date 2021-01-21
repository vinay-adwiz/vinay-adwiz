<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

define('ADMIN_ROLE_ID', '1');
define('EDITOR_ID', '2');
define('USER_ROLE_ID', '4');
define('DEVELOPER_ROLE_ID', '6');

define('APPLICATION_STATUS_PENDING', '1');
define('APPLICATION_STATUS_APPROVED', '2');
define('APPLICATION_STATUS_DECLINED', '3');

define('CURRICULUM_STARTER', '1');
define('CURRICULUM_BEGINNER', '2');
define('CURRICULUM_INTERMEDIATE', '3');

define('CLASS_STATUS_AVAILABLE', '1');
define('CLASS_STATUS_BOOKED', '2');
define('CLASS_STATUS_COMPLETED', '3');
define('CLASS_STATUS_CANCELLED_BY_STUDENT', '4');
define('CLASS_STATUS_CANCELLED_BY_TEACHER', '5');

define('FREE_CANCELLATION_PERIOD', 86400); // 24 hours in seconds
define('FREE_REFUND_PERIOD', 604800); // 1 week in seconds

define('ZOOM_AUTH_KEY', '2mCK26VNQkms1KELYeGArA');

define('ZOOM_USER_BASIC', '1');
define('ZOOM_USER_PRO', '2');
define('ZOOM_USER_CORP', '3');

define('ZOOM_MEETING_TYPE_INSTANT', '1');
define('ZOOM_MEETING_TYPE_SCHEDULED', '2');


define('PAYMENT_OPTION_SCB', 'SCB');
define('PAYMENT_OPTION_2C2P', '2C2P');
define('PAYMENT_OPTION_ALI', 'Alipay');

define('PLAN_TRIAL', '1');
define('PLAN_PACKAGE_A', '2');
define('PLAN_PACKAGE_B', '3');
define('PLAN_PACKAGE_C', '4');

define('ASSESSMENT_CLASS_ID', '1');
define('CURRENCY', 'THB');

define('META_KEY_PROFILE_VIEW', 'profile_views');
define('FEEDBACK_TYPE_STUDENT', '1');
define('FEEDBACK_TYPE_TEACHER', '2');

define('SUBSCRIPTION_STATUS_ACTIVE', '1');
define('SUBSCRIPTION_STATUS_COMPLETED', '2');
define('SUBSCRIPTION_STATUS_CANCELLED', '3');
define('SUBSCRIPTION_STATUS_REFUNDED', '4');
define('SUBSCRIPTION_STATUS_PENDING', '5');
define('SUBSCRIPTION_STATUS_PAYMENT_FAILED', '6');

define('REFERRAL_CODE_LENGTH', 6);
define('REFERRAL_CODE_USER_META', 'referrer_code');

define('WEEKDAY_START_PEAKHOUR', '17:00');
define('WEEKDAY_END_PEAKHOUR', '19:00');
define('WEEKEND_START_PEAKHOUR', '17:00');
define('WEEKEND_END_PEAKHOUR', '19:00');

if (ENVIRONMENT == 'local') {

	define('SCB_GATEWAY', 'https://nsips-test.scb.co.th:443/NSIPSWeb/NsipsMessageAction.do');
	define('SCB_MERCHANT_ID', '1000010390');
	define('SCB_TERMINAL', '16118978'); 
	define('MAIN_WEBSITE_THAI_URL', 'http://s.english-gang.fxs-dev.net/');
	define('MAIN_WEBSITE_URL', 'http://english-gang.fxs-dev.net/');
	define('ADMIN_PORTAL_URL', 'http://englishgang/admin/');
	define('WP_ADMIN_URL', 'http://english-gang.fxs-dev.net/wp-admin');
	define('STUDENT_PORTAL_URL', 'http://englishgang-student/');
	define('TEACHER_PORTAL_URL', 'http://englishgang/');
	define('SUPPORT_EMAIL', 'gerry@fxsiteworks.com');
	define('ADMIN_CLASS_NOTIFICATION', 'gerry@fxsiteworks.com');

	define("_2C2P_PAYMENT_URL", "https://demo2.2c2p.com/2C2PFrontEnd/RedirectV3/payment");
	define("_2C2P_API_SECRET_ID", "489F194EE55B669F3F546337D2E570C70099D4742ABA705481FB56DDF024D8EA");


} elseif (ENVIRONMENT == 'development') {
	define('SCB_GATEWAY', 'https://nsips-test.scb.co.th:443/NSIPSWeb/NsipsMessageAction.do');
	define('SCB_MERCHANT_ID', '1000010390');
	define('SCB_TERMINAL', '16118978'); 
	define('MAIN_WEBSITE_THAI_URL', 'http://s.english-gang.fxs-dev.net/');
	define('MAIN_WEBSITE_URL', 'http://english-gang.fxs-dev.net/');
	define('ADMIN_PORTAL_URL', 'http://portal.english-gang-corp.fxs-dev.net/admin/');
	define('WP_ADMIN_URL', 'http://english-gang.fxs-dev.net/wp-admin/');
	define('STUDENT_PORTAL_URL', 'http://learn.english-gang-corp.fxs-dev.net/');
	define('TEACHER_PORTAL_URL', 'http://portal.english-gang-corp.fxs-dev.net/');
	define('SUPPORT_EMAIL', 'gerry@fxsiteworks.com');
	define('ADMIN_CLASS_NOTIFICATION', 'gerry@fxsiteworks.com');

	define("_2C2P_PAYMENT_URL", "https://demo2.2c2p.com/2C2PFrontEnd/RedirectV3/payment");
	define("_2C2P_API_SECRET_ID", "489F194EE55B669F3F546337D2E570C70099D4742ABA705481FB56DDF024D8EA");
	
} else {
	define('SCB_GATEWAY', 'https://nsips.scb.co.th/NSIPSWeb/NsipsMessageAction.do');
	define('SCB_MERCHANT_ID', '1000018370');
	define('SCB_TERMINAL', '12611897'); 
	define('MAIN_WEBSITE_THAI_URL', 'http://englishgang.com/');
	define('MAIN_WEBSITE_URL', 'http://t.englishgang.com/');
	define('ADMIN_PORTAL_URL', 'http://portal.englishgangcorp.com/admin/');
	define('WP_ADMIN_URL', 'http://t.englishgang.com/wp-admin/');
	define('STUDENT_PORTAL_URL', 'https://learn.englishgangcorp.com/');
	define('TEACHER_PORTAL_URL', 'http://portal.englishgangcorp.com/');
	define('SUPPORT_EMAIL', 'support@englishgang.com');
	define('ADMIN_CLASS_NOTIFICATION', 'englishgangthailand@gmail.com');

	define("_2C2P_PAYMENT_URL", "https://t.2c2p.com/RedirectV3/payment");
	define("_2C2P_API_SECRET_ID", "C186C11D9DBAC619C8CB9B969C4832588B929CB4DDAB6550ED000AFBB5998587");
	
}

define('SUPPORT_EMAIL_EMAIL', 'EnglishGangthailand@gmail.com');
define('EMAIL_FROM', 'English Gang');
define('SMTP_SERVER', 'ssl://mail.englishgang.com');
define('SMTP_USERNAME', 'webmailer@englishgang.com');
define('SMTP_PASSWORD', '0fR3qbUa4y');


define("EG_TERMS_URL", "https://englishgang.com/terms-conditions/");

define('EDIT_USER_URL', ADMIN_PORTAL_URL . 'settings/users/edit/');

define('PAYMENT_STATUS_PENDING', 'PEN');
define('SCB_BACKURL', STUDENT_PORTAL_URL . 'subscription/response/'); 
define('SCB_SERVICE_ID', '01'); 
define('SCB_CURRENCY', 'THB'); 
define('SCB_COMMAND_AUTH', 'CRAUTH');
define('SCB_COMMAND_ENQ', 'CRINQ');

define("_2C2P_MERCHANT_ID", "764764000001257");
define("_2C2P_VERSION", "7.2");
define("_2C2P_CURRENCY", "764");

define("ALIPAY_PAYMENT_URL", "https://securepay.e-ghl.com/ipg/payment.aspx");
define("ALIPAY_MERCHANT_NAME", "ENGLISH GANG");
define("ALIPAY_MERCHANT_ID", "972");
define("ALIPAY_MERCHANT_PASSWORD", "c8R8GPuk");
define("ALIPAY_LANGUAGE_CODE", "EN");
define("ALIPAY_TIMEOUT", "780");
define("ALIPAY_EWALLET", "ANY");

define('LEARNCUBE_PUBLIC_KEY', '7dd47eb2a83f40f72e98fbad');
define('LEARNCUBE_PRIVATE_KEY', '1e694a267918ce81a72f4154a5483f08400e9388');


define('ZOOM_OVERRIDE_USER', 'support@englishgang.com');
define('ZOOM_USER_NOT_FOUND_CODE', '1001');

define("STUDENT_REFERRAL_URL", STUDENT_PORTAL_URL .  "referrals/");
define("STUDENT_REGISTER_URL", STUDENT_PORTAL_URL .  "register/");
/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
define('FOPEN_READ', 'rb');
define('FOPEN_READ_WRITE', 'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE', 'ab');
define('FOPEN_READ_WRITE_CREATE', 'a+b');
define('FOPEN_WRITE_CREATE_STRICT', 'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

// -----------------------------------------------------------------------------
// CI3 Constants - These may not be honored by the system (especially SHOW_DEBUG_BACKTRACE),
// but they are provided for forward-compatibility.
// -----------------------------------------------------------------------------

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
define('SHOW_DEBUG_BACKTRACE', true);

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions. Three such conventions are mentioned below, for
| those who wish to make use of them. The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
| Standard C/C++ Library (stdlibc):
| http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
| (This link also contains other GNU-specific conventions)
| BSD sysexits.h:
| http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
| Bash scripting:
| http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
define('EXIT_SUCCESS', 0); // no errors
define('EXIT_ERROR', 1); // generic error
define('EXIT_CONFIG', 3); // configuration error
define('EXIT_UNKNOWN_FILE', 4); // file not found
define('EXIT_UNKNOWN_CLASS', 5); // unknown class
define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
define('EXIT_USER_INPUT', 7); // invalid user input
define('EXIT_DATABASE', 8); // database error
define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

// -----------------------------------------------------------------------------
// Bonfire-specific Constants
// -----------------------------------------------------------------------------

define('BONFIRE_VERSION', 'v0.8.3');

// -----------------------------------------------------------------------------
// The 'App Area' allows you to specify the base folder used for all of the contexts
// in the app. By default, this is set to '/admin', but this does not make sense
// for all applications.
// -----------------------------------------------------------------------------
define('SITE_AREA', 'admin');

// -----------------------------------------------------------------------------
// The 'LOGIN_URL' and 'REGISTER_URL' constant allows changing of the url where
// the login page is accessible (asides from the controller-based 'users/login').
// This may be helpful for reducing brute force login attacks, as the login URL
// can be changed to something obscure, and the controller-based 'users/login' can
// be redirected to 403/4 in routes.php.
// -----------------------------------------------------------------------------
define('LOGIN_URL', 'login');
define('REGISTER_URL', 'register');

// -----------------------------------------------------------------------------
// The 'IS_AJAX' constant allows for a quick simple test as to whether the current
// request was made with XHR.
// -----------------------------------------------------------------------------
// @todo Shouldn't this work without the "? true : false" portion?
//
$ajax_request = (! empty($_SERVER['HTTP_X_REQUESTED_WITH'])
        && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
    ) ? true : false;
define('IS_AJAX', $ajax_request);
unset($ajax_request);
