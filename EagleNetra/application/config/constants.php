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
//////////////////////////////////////////////////////////
define('table_splash', 'splash_screen');
define('table_otp', 'otp');
define('table_user','user');
define('table_smart_card','smart_card');
define('table_safe_area', 'safe_area');
define('table_last_location','last_location');
define('table_last_user_location' , 'last_user_location');
define('table_location', 'location');
define('table_access_management', 'access_management');
define('table_tracking_for' , 'tracking_for');
define('table_emergency_numbers' , 'emergency_numbers');
//////////////////////////////////////////////////////////
define('key_inserted','inserted');









define('key_status', 'status');
define('key_message','message');
define('key_base_url','baseUrl');
define('key_version','version');
define('key_isAdded','isAdded');

define('key_name','name');
define('key_code','code');
define('key_date','date');
define('key_is_skipable','isSkipable');
define('key_intro_data', 'introData');
define('key_registration_data', 'registrationData');
define('key_user_status', 'userStatus');

define('key_id', 'id');
define('key_heading', 'heading');
define('key_body', 'body');
define('key_cover_image', 'coverImage');
define('key_response', 'responses');

define('key_codes','codes');
define('key_flag','flag');

define('key_get_started_data', 'getStartedData');
define('key_otp', 'otp');
define('key_user_id', 'userId');
define('key_is_sent' , 'isSent');

define('key_upload_path', 'upload_path');
define('key_allowed_types', 'allowed_types');
define('key_encrypt_name', 'encrypt_name');

define('key_intro_page_data', 'introPageData');
define('key_registration_page_data', 'registrationPageData');

define('key_description', 'description');
define('key_image', 'image');
define('key_is_matched', 'isMatched');

define('key_countries', 'countries');
define('key_states', 'states');
define('key_districts', 'districts');
define('key_cities', 'cities');

define('key_user_phone', 'userPhone');
define('key_genders', 'genders');
define('key_packages', 'packages');
define('key_done', 'isDone');
//////////////////////////////////////////////////////////
define('VALUE_NOT_REGISTERED', 'NOT REGISTERED');
define('VALUE_REGISTERED', 'REGISTERED');
//////////////////////////////////////////////////////////
define('text_base_url_found_successfully', 'base_url_found_successfully');
define('text_record_found', 'record_found');
define('text_no_record_found', 'no_record_found');
define('text_record_inserted', 'record_inserted');
define('text_no_record_inserted', 'record_not_inserted');
define('text_success', 'success');
define('text_failed', 'failed');
define('text_api_not_exist','api_not_exist');
define('text_otp_sent_successfully', 'otp_sent_successfully');
define('text_otp_sent_failure', 'otp_sent_failure');
define('text_mobile_number_must_be_ten_digit', 'mobile_number_must_be_ten_digit');
define('text_user_already_exist', 'user_already_exist');
define('text_user_not_exist', 'user_not_exist');
define('text_name_required', 'name_required');
define('text_email_required', 'email_required');
define('text_tracking_required', 'tracking_required');
define('text_registration_successfull', 'registration_successfull');
define('text_registration_failed', 'registration_failed');
define('text_image_upload_failed', 'image_upload_failed');
define('text_otp_not_matched', 'otp_not_matched');
define('text_otp_matched', 'otp_matched');
define('text_no_sarathi_found', 'no_sarathi_found');
define('text_no_driver_found', 'no_driver_found');
define('text_insufficient_km', 'insufficient_km');
define('text_aadhar_document_required', 'aadhar_document_required');
define('text_pan_document_required', 'pan_document_required');
define('text_card_number_required', 'card_number_required');
define('text_device_id_required', 'device_id_required');
define('text_class_age_required', 'class_age_required');
define('text_device_exists','text device exists');
define('text_device_added','device added');
define('text_number_required', 'number_required');
define('text_user_exist', 'user_exist');
define('text_user_id_required', 'user_id_required');
define('text_user_id_not_matched', 'user_id_not_matched');
define('text_new_user','new user');
define('text_safe_area_name_required', 'safe_area_name_required');
define('text_longitude_required', 'longitude_required');
define('text_latitude_required', 'latitude_required'); 
define('text_alert_on_required',  'alert_on_required');
define('text_safe_area_radius_required', 'safe_area_radius_required');
define('text_safe_area_address_required' ,'safe_area_address_required');
define('text_safe_area_added','safe_area_added');
define('text_loaction_updated','loaction_updated');
define('text_loaction_not_updated','loaction_not_updated');
define('text_device_id_not_found', 'device_id_not_found');
define('text_loaction_found', 'loaction_found');
define('text_loaction_not_found', 'loaction_not_found');
define('text_new_guardian_added','text_new_guardian_added');
define('text_all_feilds_are_required','text_all_feilds_are_required');
define('text_loaction_inserted', 'text_loaction_inserted');
define('text_loaction_not_inserted', 'text_loaction_not_inserted');
define('text_image_required' , 'image_required');
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
define('static_version_name', '1.0.0');
define('static_version_code', 1);
define('static_version_date', '06/07/2022');

define('STATIC_PLACE_COUNTRY', 'country');
define('STATIC_PLACE_STATE', 'state');
define('STATIC_PLACE_DISTRICT', 'district');
define('STATIC_PLACE_CITY', 'city');

define('STATIC_STATUS_ACTIVE', 'active');
define('STATIC_STATUS_DEACTIVE', 'deactive');
//////////////////////////////////////////////////////////
define('field_for', 'for');
define('field_specific_for_app', 'specific_for_app');
define('field_id', 'uid');
define('field_heading', 'heading');
define('field_body', 'body');
define('field_cover_image_path', 'cover_image_path');
define('field_otp', 'otp');
define('field_flag_path', 'flag_path');
define('field_code', 'code');
define('field_mobile', 'mobile');
define('field_name', 'name');
define('field_email', 'email');
define('field_value', 'value');
define('field_profile_image_path', 'profile_image_path');
define('field_created_at', 'created_at');
define('field_parent', 'parent');
define('field_user_type_id', 'user_type_id');
define('field_total_km_purchased', 'total_km_purchased');
define('field_assets', 'assets');
define('field_data', 'data');
define('field_document_id', 'document_id');
define('field_address_line_1','address_line_1');
define('field_account_holder_name', 'account_holder_name');
define('field_account_number', 'account_number');
define('field_ifsc', 'ifsc');
define('field_image', 'image');
define('field_description', 'description');
define('feild_status','status');

// define('field_address', 'address');
define('field_address_type_id', 'address_type_id');
define('field_city_id', 'city_id');
define('field_state_id', 'state_id');
define('field_district_id', 'district_id');
define('field_country_id', 'country_id');
define('field_pincode', 'pincode');
//////////////////////////////////////////////////////////
define('DATA', 'data');
define('HTTP_STATUS', 'http_status');
//////////////////////////////////////////////////////////
define('STATIC_VALUE_SWARATHI_REGISTRATION_SPLASH', 'registration');
define('STATIC_VALUE_DRIVER_REGISTRATION_SPLASH', 'registration');
define('STATIC_VALUE_CUSTOMER_GET_STARTED_SPLASH', 'get_started');
//////////////////////////////////////////////////////////
define('APP_SARATHI', 'sarathi');
define('APP_CUSTOMER', 'customer');
define('APP_DRIVER', 'driver');
//////////////////////////////////////////////////////////
define('query_param_mobile', 'mobile');
define('query_param_requested_api', 'requested_api');
define('query_param_otp', 'otp');
define('query_param_country_id', 'country_id');
define('query_param_state_id', 'state_id');
define('query_param_district_id', 'district_id');

define('query_param_page_size', 'pageSize');
define('query_param_page_no', 'pageNo');
define('query_param_sort_by', 'sortBy');
define('query_param_sort_dir', 'sortDir');
//////////////////////////////////////////////////////////
define('param_mobile', 'mobile');
define('param_name', 'name');
define('param_email', 'email');
define('param_selected_driver_package_id', 'selectedPackageId');
define('param_payment_mode', 'paymentMode');
define('param_account_holder_name', 'account_holder_name');
define('param_account_number', 'account_number');
define('param_ifsc', 'ifsc');
define('param_address', 'address');
define('param_addressProof', 'address_proof');
define('param_addressType_id', 'address_type_id');
define('param_city_id', 'city_id');
define('param_state_id', 'state_id');
define('param_district_id', 'district_id');
define('param_country_id', 'country_id');
define('param_pincode', 'pincode');

//////////////////////////////////////////////////////////
define('file_profile_image', 'profile_image');
//////////////////////////////////////////////////////////
define('filename', 'file_name');
//////////////////////////////////////////////////////////
define('model_sarathi', 'sarathi/Sarathi_model');
define('model_driver', 'driver/Driver_model');
define('model_uid_server', 'Uid_server_model');
define('model_common', 'Common_model');
//////////////////////////////////////////////////////////
define('value_base_url', 'base_url');
define('value_intro_page_data', 'intro_page_data');
define('value_registration_page_data', 'registration_page_data');

define('value_sort_dir_asc', 'asc');
define('value_sort_dir_desc', 'desc');
//////////////////////////////////////////////////////////
define('user_sarathi', 'user_sarathi');
define('user_driver', 'user_driver');
//////////////////////////////////////////////////////////
define('KEY_DOCUMENT', 'DOCUMENT');
define('KEY_USER', 'USER');
define('KEY_SARATHI', 'SARATHI');
define('KEY_GROUP', 'GROUP');
define('KEY_KYC', 'KYC');
define('KEY_ADDRESS', 'ADDRESS');
define('KEY_BANK_DETAILS', 'BANK_DETAILS');
//////////////////////////////////////////////////////////
define('UID_DOCUMENT_PREFIX', 'DOCUMENT_');
define('UID_USER_PREFIX', 'USER_');
define('UID_SARATHI_PREFIX', 'SARATHI_');
define('UID_GROUP_PREFIX', 'GROUP_');
define('UID_KYC_PREFIX', 'KYC_');
define('UID_ADDRESS_PREFIX', 'ADDRESS_');
define('UID_BANK_DETAILS_PREFIX', 'BANK_DETAILS_');
//////////////////////////////////////////////////////////
define('unit_km', 'KM');
//////////////////////////////////////////////////////////
define('KYC_PAN', 'pan');
define('KYC_AADHAR', 'aadhar');
//////////////// moloy - v1///////////////////////////////

define('app_messages_lang','app_messages');

define('field_status','status');
define('field_gender','gender');
define('field_dob','dob');
define('field_lname','lname');
define('field_fname','fname');
define('field_type','type');
define('field_type_sarathi','sarathi');
define('field_address','address');
define('field_address_image','address_document');
define('field_user_id','user_id');
define('field_unit_uid','unit_uid');
define('field_unit','unit');
define('field_aadhar_number','aadhar_number');
define('field_pan_number','pan_number');
define('field_support_doc_name','support_name');
define('field_support_doc_id','supporting_document_id');
define('field_support_doc_number','supporting_document_number');

define('field_professional_details','professional_details');
define('field_banking_details','banking_details');
define('field_address_details','address_details');
define('field_kyc_details','kyc_details');

define('field_short_description','terms_short_description');
define('field_long_description','terms_long_description');

define('field_privacy_short_description','privacy_short_description');
define('field_privacy_long_description','privacy_long_description');

define('field_help_short_description','help_short_description');
define('field_help_long_description','help_long_description');

define('field_help_name','name');
define('field_help_email','email');

define('field_help_subject','subject');
define('field_help_message','message');
define('field_sarathi_id','sarathi_id');
define('field_group_id', 'gid');



//////////////////////////////////////
define('key_user','user');
define('key_credit','credit');
define('key_is_added','isAdded');
define('key_is_reset','isReset');
define('key_is_submitted','isSubmitted');
define('key_short_desc','short_description');
define('key_long_desc','long_description');
define('key_data','data');
define('key_isreset','isReset');
define('key_types','types');
define('key_safe_area_status', 'safe_area_status');
///////////////////////////////////////
define('text_userid_required','user_id_required');
define('text_no_credit_found','no_credit_found');
define('text_credit_found','credit_found');
define('text_username_required','username_required');
define('text_userdetails_required','user details_required');
define('text_all_required','all_fields_are_required');
define('text_account_holder_name_required','account_holder_name_is_required');
define('text_account_number_required','account_numbe_is_required');
define('text_ifsc_code_required','ifsc_code_is_required');
define('text_terms_Conditions_found','terms_and_conditions_found');
define('text_terms_Conditions_not_found','terms_and_conditions_not_found');
define('text_privacy_policy_found','terms_and_conditions_not_found');
define('text_privacy_policy_not_found','privacy_policy_not_found');
define('text_help_found','help_is_found');
define('text_help_not_found','help_is_not_found');
define('text_help','help');
define('text_help_name_not_found','help_name_not_found');
define('text_help_email_not_found','help_email_not_found');
define('text_help_subject_not_found','help_subject_not_found');
define('text_help_message_not_found','help_message_not_found');
define('text_doument_found','document_status_found');
define('text_doument_not_found','doument_not_found');
define('text_mobile_number_verified', 'Mobile Number is Verified');
define('text_address_required', 'Address is required');
define('text_details_added' , 'details_added');
define('text_details_not_added' , 'details_not_added');
//////////////////////////////////////////////////////
define('path_address_document_image','assets/images/address_proof');
define('path_kyc_document_image','assets/images/kyc/');

//////////////////////////////////////////////////
define('aadharname','aadhar_name');
define('panname','pan_name');
define('supportname','support_name');

define('field_aadhar_image','aadhar_document');
define('field_pan_image','pan_document');
define('field_support_image','supporting_document');
define('field_date', 'Y-m-d H:i:s');
define('field_location', 'Asia/Kolkata');


define('field_modified_at', 'modified_at');
/////////////////////////////////////////////////
define('constant_submit', 'submitted');
define('constant_pending','pending');
define('constant_active','active');
///////////////////////////////////////////
define('STATIC_PERSONAL_DETAILS','DETAILS_PERSONAL');
define('STATIC_DETAILS_KYC','DETAILS_KYC');
define('STATIC_DETAILS_BANK','DETAILS_BANK');
define('STATIC_DETAILS_ADDRESS','DETAILS_ADDRESS');
////////////////end moloy/////////////////////////////////


////////////////moloy v2/////////////////////////////////
define('text_driver_found','driver_found');
define('text_driver_not_found','driver_not_found');
define('text_pan_required','pan_required');
define('text_aadhar_required','aadhar_required');
define('text_driver_status_changed','driver_status_changed');
define('text_driver_status_not_changed','driver_status_not_changed');
define('text_otp_sent','otp_sent');
define('text_otp_not_sent','otp_not_sent');
define('text_mobile_number_required','mobile_number_required');

////////////////end moloy/////////////////////////////////

///////////////////// moloy v3 /////////////////////////////////////

define('field_token','token');
define('field_refferal_code','refferal_code');
define('field_type_driver','driver');
define('field_as','as');
define('field_city','city');
define('field_rc_number','rc_number');
define('field_rc_image','rc_document');
define('field_insurance_document','insurance');
define('field_vehicle_permit_document','permit');
define('field_chasis_number','chasis_number');
define('field_chasis_image','chasis_image');
define('field_left_exterior_image','left_exterior_image');
define('field_right_exterior_image','right_exterior_image');
define('field_inside_image','inside_image');
define('field_number_plate_image','number_plate_image');
define('field_profile_image','profile_image');
define('field_vehicle_type_id','vehicle_type_id');
define('field_vehicle_number','vehicle_number');
define('field_licence_image','licence_document');
define('field_licence_number','licence_number');
define('field_phone_number', 'phone_number');

define('field_subject','subject');
define('field_message','message');


///////////////////////////////////////////////////////////////////

define('otp_validate_time','otp_validate_time');

//////////////////////////////////////////////////////

define('KEY_DRIVER','DRIVER');
define('KEY_TOKEN','TOKEN');

define('key_success','success');
define('key_isUser','isUser');

define('KEY_HELP','HELP');
define('KEY_VEHICLE','VEHICLE');
define('KEY_CARE','CARE');
//////////////////////////////////////////////////
define('UID_DRIVER_PREFIX','DRIVER_');
define('UID_TOKEN_PREFIX','TOKEN_');
define('UID_VEHICLE_PREFIX','VEHICLE_');
define('UID_HELP_PREFIX','HELP_');
define('UID_CARE_PREFIX','CARE_');
/////////////////////////////////////////////////////////////////
define('text_city_required','city_required');
define('text_gender_required','gender_required');
define('text_dob_required','dob_required');
define('text_invalid_refferal_code','invalid_refferal_code');
define('text_refferal_code_required','refferal_code_required');
define('text_vehicle_type','vehicle_type');
define('text_rc_required','rc_required');
define('text_insurance_required','insurance_required');
define('text_permit_required','permit_required');

define('text_chasis_number_required','chasis_number_required');
define('text_chasis_image_required','chasis_image_required');
define('text_left_exterior_image_required','left_exterior_image_required');
define('text_right_exterior_image_required','right_exterior_image_required');
define('text_inside_image_required','inside_image_required');
define('text_number_plate_image_required','number_plate_image_required');
define('text_profile_image_required','profile_image_required');
define('text_profile_image_success','profile_image_success');
define('text_city_list','city_list');

define('text_fetch_driver_profile','fetch_driver_profile');
define('text_vehicle_number_required','vehicle_number_required');
define('text_vehicle_id_required','vehicle_id_required');
define('text_vehicle_id_not_found','vehicle_id_not_found');
define('text_licence_document_required','licence_document_required');
define('text_licence_number_required','licence_number_required');

define('text_fetch_driver_documents','fetch_driver_documents');
define('text_subject_required','subject_required');
define('text_message_required','message_required');


///////////////////////////////////////////////////////////////////////////
define('VALUE_ACTIVE','ACTIVE');
define('STATIC_VALUE_RC','rc');
define('STATIC_VALUE_LICENCE','licence');
///////////////////////////////////////////////////////////////////////////
define('path_vehicle_document_image', 'assets/images/vehicle/');
define('path_driver_profile_image', 'assets/images/driver_profile_image/');

//////////////////////////////////////////////////////////////////////////
define('text_document_number_required','document_number_required');
define('text_document_image_required','document_image_required');
define('text_document_not_valid','document_not_valid');
define('text_re_enter_document_number_required','re_enter_document_number_required');
define('text_document_number_must_be_same','document_number_must_be_same');
///////////////////////////////////////////////////////////////////////
define('field_document_number','document_number');
define('field_document_name','document_name');
define('field_document_image','document_image');
define('field_type_id','type_id');
define('field_re_enter_document_number','re-enter_document_number');
///////////////////////////////////////////////////////////////
define('document_type_licence','licence');
define('document_type_aadhar','aadhar');
define('document_type_pan','pan');
define('document_type_insurance','insurance');
define('document_type_permit','permit');
define('document_type_rc','rc');

define('document_type_chasis','chasis');
define('document_type_inside','inside');
define('document_type_left_exterior','left_exterior');
define('document_type_right_exterior','right_exterior');
define('document_type_number_plate','number_plate');

//////////////////////////////////////////////////////////

define('document_name_aadhar','aadhar');
define('document_name_pan','pan');
define('document_name_rc','rc');

define('document_name_licence','vehicle_licence');
define('document_name_insurance','vehicle_insurance');
define('document_name_permit','vehicle_permit');

define('document_name_chassis','chassis');
define('document_name_back_with_no_plate','back_with_no_plate');
define('document_name_left_exterior','left_exterior');
define('document_name_right_exterior','right_exterior');
define('document_name_car_inside','car_inside');

///////////////////////////////////////////////////////////
define('param_refferal_code','refferal_code');
define('param_aadhar_number','aadhar_number');
define('param_pan_number','pan_number');
define('param_rc_number','rc_number');
define('param_insurance_document','insurance');
define('param_vehicle_permit_document','permit');
define('param_chasis_number','chasis_number');
define('param_gender','gender');
define('param_dob','dob');
define('param_vehicle_number','vehicle_number');
define('param_vehicle_type_id','vehicle_type_id');
define('param_licence_number','licence_number');
define('param_subject','subject');
define('param_message','message');
define('param_city','city');
define('param_document_number','document_number');


define('text_user_not_registered','user_not_registered');
////////////////////////////////////////////////////////////////
define('field_specific_level_user_id', 'specific_level_user_id');