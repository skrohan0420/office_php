<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . rest_controller_path;     
use instanthealth\RestServer\RestController;

class Mycontroller extends REST_Controller {
    function test()
        {
            echo "RESTfull API";
            die;
        }
}

?>