<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Doctor';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['appVersion'] = 'doctor/appVersion';
$route['baseUrl'] = 'doctor/baseUrl';
$route['user'] = 'doctor/user';
$route['users/(:any)'] = 'doctor/userShortDetails/$1'; //pending
$route['users'] = 'doctor/users';
$route['passwordResetOtp'] = 'doctor/passwordResetOtp';
$route['doctorEducations'] = 'doctor/doctorEducations';
$route['doctorSpecialities'] = 'doctor/doctorSpecialities';
$route['clinics'] = 'doctor/clinics';

$route['users/(:any)/password'] = 'doctor/changePassword/$1';
$route['users/(:any)/details'] = 'doctor/doctorDetails/$1';
$route['users/(:any)/clinics'] = 'doctor/clinics/$1';
$route['users/(:any)/prescriptions'] = 'doctor/prescriptions/$1';
$route['users/(:any)/achievements'] = 'doctor/achievements/$1';
$route['users/(:any)/availabilityCategories'] = 'doctor/availabilityCategories/$1';
$route['users/(:any)/selectedAvailabilities'] = 'doctor/selectedAvailabilities/$1';
$route['users/(:any)/availabilities'] = 'doctor/availabilities/$1';
$route['users/(:any)/daysInWeek'] = 'doctor/daysInWeek/$1';
$route['users/(:any)/videoCallPrice'] = 'doctor/videoCallPrice/$1';
$route['users/(:any)/bankingDetails'] = 'doctor/bankingDetails/$1';


$route['users/(:any)/videoCalling/availableTimings'] = 'doctor/availableTimings/$1';
$route['users/(:any)/voiceCalling/availableTimings'] = 'doctor/availableTimings/$1';
$route['users/(:any)/clinics/(:any)/availableTimings'] = 'doctor/availableTimings/$1/$2';

// $route['users/(:any)/availability/voiceWithFees'] = 'doctor/voiceWithFees/$1';
// $route['users/(:any)/availability/voiceCallingFees'] = 'doctor/voiceCallingFees/$1';
// $route['users/(:any)/availability/deleteVoice'] = 'doctor/deleteVoice/$1';

// $route['users/(:any)/availability/videoCallingFees'] = 'doctor/videoCallingFees/$1';
// $route['users/(:any)/availability/deleteVideo'] = 'doctor/deleteVideo/$1';

//delete schedule
$route['users/(:any)/availability/voiceCallingSchedule/(:any)/(:any)'] = 'doctor/voiceSchedule/$1/$2/$3';
$route['users/(:any)/availability/videoCallingSchedule/(:any)/(:any)'] = 'doctor/videoSchedule/$1/$2/$3';

$route['users/(:any)/availability/fees/videoCalling'] = 'doctor/videoCallingFees/$1';
$route['users/(:any)/availability/videoCallingSchedule'] = 'doctor/videoCallingFees/$1';

$route['users/(:any)/availability/fees/voiceCalling'] = 'doctor/voiceCallingFees/$1';
$route['users/(:any)/availability/voiceCallingSchedule'] = 'doctor/voiceCallingFees/$1';

$route['users/(:any)/availability/clinic'] = 'doctor/clinics/$1';