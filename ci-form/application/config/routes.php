<?php
defined('BASEPATH') OR exit('No direct script access allowed');



$route['default_controller'] = 'MyController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['register'] = 'MyController/register';
$route['login'] = 'MyController/index';
$route['dashboard'] = 'MyController/dashboard';
