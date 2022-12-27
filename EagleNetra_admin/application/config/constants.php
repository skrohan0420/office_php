<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

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
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code
//////////////////////////////////////////////////////////
define('rest_controller_path', 'libraries/RestController.php');
//////////////////////////////////////////////////////////
define('header_allow_origin', 'Access-Control-Allow-Origin: *');
define('header_allow_headers', 'Access-Control-Allow-Headers: *');
define('header_allow_methods', "Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE, PATCH");
//////////////////////////////////////////////////////////
define('helper_form', 'form');
define('helper_url', 'url');
//////////////////////////////////////////////////////////
define('base_url','http://localhost/eaglenetra/');
/////////////////////////////////////////////////////////
define('lang_app_message', 'app_messages');
//////////////////////////////////////////////////////////
define('content_type_application_json', 'application/json');
//////////////////////////////////////////////////////////
define('library_upload', 'upload');
//////////////////////////////////////////////////////////
define('path_customer_profile_image', 'assets/images/customer_profile_image');
define('type_allowed', 'jpg|jpeg|png');
///////////////////////data_tables///////////////////////////////////
define('table_splash', 'splash_screen');

//////////////////////////////////////////////////////////
define('key_inserted','inserted');

//////////////////////////////////////////////////////////
define('text_base_url_found_successfully', 'base_url_found_successfully');
define('text_userid_required','user_id_required');
//////////////////////////////////////////////////////////
define('http_ok', 200);
define('http_no_content', 204);
define('http_bad_request',400);
define('http_forbidden_error',403);
define('http_not_found',404);
define('http_Conflict',409);
define('http_server_error',500);
define('http_unprocessable_entity',422); 
define('http_failed_dependency',424);
//////////////////////////////////////////////////////////
define('DATA', 'data');
define('HTTP_STATUS', 'http_status');
/////////////////////////get/////////////////////////////////
define('query_param_phone_number', 'phone_number');
define('query_param_otp', 'otp');
/////////////////////////post/////////////////////////////////
define('param_phone_number', 'phone_number');
  
//////////////////////////////////////////////////////////
define('file_profile_image', 'profile_image');
//////////////////////////////////////////////////////////
define('filename', 'file_name');
//////////////////////////////////////////////////////////
define('model_eagle', 'Eagle_model');
///////////////////////////////////////////////////////////
define('app_messages_lang','app_messages');
//////////////////////////////////////////////////////////
define('field_status','status');
define('field_type','type');
define('field_type_sarathi','sarathi');
define('field_user_id','user_id');
define('field_id', 'uid');
define('field_image', 'image');
define('field_heading', 'heading');
define('field_body', 'body');
define('field_description', 'description');
define('feild_status','status');
//////////////////////////////////////
define('key_user','user');

///////////////////////////////////////
define('constant_active','active');

