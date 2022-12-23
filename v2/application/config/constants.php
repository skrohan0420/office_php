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
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest 
/////////////////////////////////////////////////////////////////////
define('rest_controller_path', 'libraries/RestController.php');
/////////////////////////////////////////////////////////////////////
define('header_allow_origin', 'Access-Control-Allow-Origin: *');
define('header_allow_methods', "Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE, PATCH");
/////////////////////////////////////////////////////////////////////
define('helper_form', 'form');
define('helper_url', 'url');
/////////////////////////////////////////////////////////////////////
define('library_form_validation', 'form_validation');
define('library_email', 'email');
define('library_upload', 'upload');
/////////////////////////////////////////////////////////////////////
define('lang_app_message', 'app_messages');
/////////////////////////////////////////////////////////////////////
define('key_success','status');
define('key_message','message');
define('key_status', 'status');
define('key_categories','categories');
define('key_appversion', 'appVersion');
define('key_versioncode','versionCode');
define('key_versionname','versionName');
define('key_date','date');
define('key_baseurl','baseUrl');
define('key_isSignInSuccess','isSignInSuccess');
define('key_isSignupSuccess','isSignupSuccess');
define('key_isClinicAdded','isClinicAdded');
define('key_userId','userId');
define('key_user', 'user');
define('key_otp', 'otp');
define('key_otpSent', 'otpSent');
define('key_errors', 'errors');
define('key_password', 'password');
define('key_password_reset_success', 'passwordResetSuccess');
define('key_professiona_details_updated', 'professionalDetailsUpdated');
define('key_educations', 'educations');
define('key_specialities', 'specialities');
define('key_id', 'id');
define('key_is_available', 'isAvailable');
define('key_total_timing', 'totalTiming');
define('key_name', 'name');
define('key_value', 'value');
define('key_image', 'image');
define('key_address', 'address');
define('key_availabilityTime', 'availabilityTime');
define('key_maxAppointmentCapacity', 'maxAppointmentCapacity');
define('key_availableWeekDays', 'availableWeekDays');
define('key_visitingFees', 'visitingFees');
define('key_clinics', 'clinics');
define('key_prescriptions', 'prescriptions');
define('key_prescriptions_id', 'prescriptionId');
define('key_patient_id', 'patientId');
define('key_patient_display_identity', 'patientDisplayIdentity');
define('key_medication', 'medication');
define('key_next_follow_up', 'nextFollowUp');
define('key_summary', 'summary');
define('key_recomendation', 'recomendation');
define('key_age', 'age');
define('key_achievements', 'professionalDetail');
define('key_upload_path', 'upload_path');
define('key_allowed_types', 'allowed_types');
define('key_encrypt_name', 'encrypt_name');
define('key_smtp_host','smtp_host');
define('key_smtp_port','smtp_port');
define('key_smtp_user','smtp_user');
define('key__smtp_auth','_smtp_auth');
define('key_smtp_pass','smtp_pass');
define('key_smtp_crypto','smtp_crypto');
define('key_protocol','protocol');
define('key_mailtype','mailtype');
define('key_send_multipart','send_multipart');
define('key_charset','charset');
define('key_wordwrap','wordwrap');
define('key_availabilities', 'availabilities');
define('key_isSelected', 'isSelected');
define('key_isAdded', 'isAdded');
define('key_days', 'days');
define('key_color_code','colorCode');
define('key_short_name','shortName');
define('key_full_name','fullName');
define('key_doctor_uid', 'doctor_uid');
define('key_price', 'price');
define('key_timings', 'timings');
define('key_category','category');
define('key_day_range','dayRange');
define('key_time_range','timeRange');
define('key_indicator','indicator');
define('key_uid', 'uid');
define('key_fees', 'fees');
define('key_account_holder', 'account_holder');
define('key_account_number', 'account_number');
define('key_ifsc_code', 'ifsc_code');
define('key_bank_name', 'bank_name');
define('key_cancelled_cheque_image_path', 'cancelled_cheque_image_path');
define('key_isFeesSet', 'isFeesSet');
define('key_isDeleted', 'isDeleted');
define('key_target_id', 'target_id');
define('key_submittedClinicId', 'submittedClinicId');
/////////////////////////////////////////////////////////////////////
define('format_app_version_date', "d M y");
////////////////////////////////////////////////////////////////////
define('filename', 'file_name');
////////////////////////////////////////////////////////////////////
define('field_uid', 'uid');
define('field_name', 'name');
define('field_email', 'email');
define('field_mobile', 'mobile');
define('field_pass', 'pass');
define('field_profile_img', 'profile_image');
define('field_education','education');
define('field_speciality','speciality');
define('field_licence','licence');
define('field_experience','experience');
define('field_aadhar_front','aadhar_front');
define('field_aadhar_back','aadhar_back');
define('field_doctor_id','doctor_id');
define('field_doctor_name','name');
define('field_clinic_address','address');
define('field_clinic_landmark','landmark');
define('field_clinic_opening_time','opening_time');
define('field_clinic_closing_time','closing_time');
define('field_clinic_fees','fees');
define('field_clinic_working_days','working_days');
define('field_clinic_lat','lat');
define('field_clinic_lng','lng');
define('field_clinic_max_appointment_capacity','max_appointment_capacity');
define('field_gender', 'gender');
define('field_age', 'age');
define('field_medication', 'medication');
define('field_next_follow_up', 'next_follow_up');
define('field_summery', 'summery');
define('field_date', 'date');
define('field_recommendation', 'recommendation');
define('field_categories', 'categories');
define('field_id', 'id');
define('field_is_selected', 'is_selected');
define('field_doctor_uid', 'doctor_uid');
define('field_availability_categories_id', 'availability_categories_id');
define('field_availability', 'availability');
define('field_color_code', 'color_code');
define('field_short_name', 'short_name');
define('field_full_name', 'full_name');
define('field_week_days_uids', 'week_days_uids');
define('field_video_price', 'video_price');
define('field_voice_price', 'voice_price');
define('field_time_slots', 'time_slots');
define('field_category_uid', 'category_uid');
define('field_profile_image', 'profile_image');
define('field_fees', 'fees');
define('field_status', 'status');
define('field_created_at', 'created_at');
////////////////////////////////////////////////////////////////////
define('alise_prescription_id', 'prescriptionId');
define('alise_patient_id', 'patientId');
////////////////////////////////////////////////////////////////////
define('achievements_successful_patient', 'Successful Patient');
define('achievements_e_priscription', 'ePriscription');
define('achievements_experience', 'Experience');
define('achievements_certificate', 'Certificated Achieved');
////////////////////////////////////////////////////////////////////
define('model_app', 'App');
define('model_doctor', 'Doctor_Model');
////////////////////////////////////////////////////////////////////
// define('', '')
////////////////////////////////////////////////////////////////////
define('text_app_version_fetched_successfully','app_version_fetched_successfully');
define('text_base_url_found_successfully', 'base_url_found_successfully');
define('text_email_require','email_is_reuqired');
define('text_password_require', 'password_require');
define('text_userid_require','userid_require');
define('text_check_all_fields','check_all_fields');
define('text_userid_password_require','userid_password_require');
define('text_successfully_loggedin', 'successfully_loggedin');
define('text_registration_successfull', 'registration_successfull');
define('text_error_occurred', 'error_occurred');
define('text_email_already_exist', 'email_already_exist');
define('text_invalid_image_format', 'invalid_image_format');
define('text_email_required', 'email_required');
define('text_email_not_exist', 'email_not_exist');
define('text_failed_to_sent_otp', 'failed_to_sent_otp');
define('text_otp_Sent', 'otp_sent');
define('text_password_reset_successfully', 'password_reset_successfully');
define('text_password_not_reset', 'password_not_reset');
define('text_userid_is_required', 'userid_is_reuqired');
define('text_record_inserted_successfully', 'record_inserted_successfully');
define('text_attach_aadhaar_front', 'attach_aadhaar_front');
define('text_attach_aadhaar_back', 'attach_aadhaar_back');
define('text_education_list_fetched_successfully', 'education_list_fetched_successfully');
define('text_education_list_fetched_unsuccessful', 'education_list_fetched_unsuccessful');
define('text_specialities_list_fetched_successfully', 'specialities_list_fetched_successfully');
define('text_specialities_list_fetched_unsuccessful', 'specialities_list_fetched_unsuccessful');
define('text_clinic_added_successfull', 'clinic_added_successfull');
define('text_no_record_found', 'no_record_found');
define('text_record_found', 'record_found');
define('text_invalid_user', 'invalid_user');
define('text_success', 'success');
define('text_failed', 'failed');
define('text_upiid_or_bankdetails','upiid_or_bankdetails');
define('text_normal', 'normal');
define('text_special', 'special');
define('text_holiday', 'holiday');
////////////////////////////////////////////////////////////////////
define('color_code_normal', '#43A047');
define('color_code_special', '#FFEB3B');
define('color_code_holiday', '#FF5722');
////////////////////////////////////////////////////////////////////
define('http_ok', 200);
define('http_bad_request',400);
define('http_forbidden_error',403);
define('http_not_found',404);
define('http_Conflict',409);
define('http_server_error',500);
define('http_unprocessable_entity',422); 
define('http_failed_dependency',424);
////////////////////////////////////////////////////////////////////
define('pattern_email',"/^[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,7}$/i");
////////////////////////////////////////////////////////////////////
define('table_doctor', 'ih_doctors');
define('table_educations', 'ih_educations');
define('table_specialities', 'ih_specialities');
define('table_clinics', 'ih_clinics');
define('table_prescription', 'ih_prescriptions');
define('table_patients', 'ih_patients');
define('table_professional_certificate', 'ih_professional_certificate');
define('table_achievements', 'ih_achievements');
define('table_availability', 'ih_availability_categories');
define('table_week_days', 'ih_week_days');
define('table_normal_availabilities', 'ih_normal_availabilities');
define('table_special_availabilities', 'ih_special_availabilities');
define('table_holidays', 'ih_holidays');
define('table_fees', 'ih_fees');
define('table_bank_details', 'ih_bank_details');
////////////////////////////////////////////////////////////////////
define('path_doctor_profile_image', 'assets/images/profile_image/');
define('path_doctor_doc_image', 'assets/images/user_document/');
define('path_doc_canceled_cheque', 'assets/images/canceled_cheque');
define('type_allowed', 'jpg|jpeg|png');
////////////////////////////////////////////////////////////////////
define('query_param_email' , 'email');
define('query_param_password' , 'password');
////////////////////////////////////////////////////////////////////
define('param_username' , 'name');
define('param_userid' , 'userId');
define('param_email' , 'email');
define('param_mobilenumber' , 'mobile');
define('param_password' , 'password');
define('param_user_image', 'profileImage');
define('param_user_cancelled_cheque', 'cancelled_cheque');
define('param_education','education');
define('param_speciality','speciality');
define('param_licence','licence');
define('param_experience','experience');
define('param_aadhar_card_front', 'aadhar_card_front');
define('param_aadhar_card_back', 'aadhar_card_back');
define('param_clinic_name', 'name');
define('param_clinic_address', 'address');
define('param_clinic_landmark', 'landmark');
define('param_clinic_opening_time', 'openingTime');
define('param_clinic_closing_time', 'closingTime');
define('param_fees', 'fees');
define('param_clinic_working_days_in_week', 'workingDaysInWeek');
define('param_clinic_lat', 'lat');
define('param_clinic_lng', 'lng');
////////////////////////////////////////////////////////////////////
define('smtp_host', 'instanthealth.in');
define('smtp_port','465');
define('smtp_user','info@instanthealth.in');
define('smtp_pass',']k|^3(cbs4_j');
define('smtp_crypto','ssl');
define('smtp_protocol', 'smtp');
define('smtp_mailtype', 'html');
define('smtp_charset','utf-8');
////////////////////////////////////////////////////////////////////
define('mail_sender_name', 'Instanthealth');
define('mail_subject', 'Instanthealth - Your Account Recovery Code');
////////////////////////////////////////////////////////////////////
define('text_email_message', 'email_message');
/////////////////////////////////////////////////////////////////////
define('appointment_category_video', 'appointment_category_video');
define('appointment_category_voice', 'appointment_category_voice');
define('appointment_category_clinic', 'appointment_category_clinic');
/////////////////////////////////////////////////////////////////////
define('purpose_video_calling', 'videoCalling');
define('purpose_voice_calling', 'voiceCalling');
define('purpose_clinics', 'clinics');
/////////////////////////////////////////////////////////////////////
define('day_monday', 'monday');
define('day_tuesday', 'tuesday');
define('day_wednesday', 'wednesday');
define('day_thursday', 'thursday');
define('day_friday', 'friday');
define('day_saturday', 'saturday');
define('day_sunday', 'sunday');
define('day_all', 'all');
/////////////////////////////////////////////////////////////////////
define('val_video', 'Video');
define('val_voice', 'Voice');
define('val_linic', 'Clinic');
/////////////////////////////////////////////////////////////////////
define('voice','voice');
define('video','video');
/////////////////////////////////////////////////////////////////////
define('status_active', 'active');
define('status_deactive', 'deactive');
define('status_available', 'available');
define('status_unavailable', 'unavailable');
/////////////////////////////////////////////////////////////////////
// define('','');