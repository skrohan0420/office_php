<?php
defined('BASEPATH') or exit('nothing found');
require APPPATH . rest_controller_path;     
use eaglenetra\RestServer\RestController;

class Eagle extends RestController{


    public function __construct(){
        header(header_allow_origin);
        header(header_allow_methods);

        parent::__construct();
        $this->load->database();   
        $this->load->helper(helper_url);
        $this->lang->load(app_messages_lang);      
    }

    public function new_uid(){
        return (bin2hex(openssl_random_pseudo_bytes(16)).'_'.time());
    }

    private function do_upload($path,$send_img){
        $config[key_upload_path]   = './'.$path;
        $config[key_allowed_types] = '*'; 
        $config[key_encrypt_name] = TRUE;

        $this->load->library(library_upload, $config);
        $this->upload->initialize($config);

        if (!$this->upload->do_upload($send_img)){
            return false;           
        }
        else{
            return true;
        }
    }

    private function initializeEagleModel(){
        $this->load->model('Eagle_model');
    }
    
    private function newotp(){
        return rand(1000 , 9999);
    }

    private function final_response($resp,$response){
        $final_response[DATA] = $resp($response);
        $final_response[HTTP_STATUS] = http_ok;
        return $final_response;
    }

    private function lang_message($str){
        return ($this->lang->line($str));
    }

    private function splashScreen(){
        $resp = function($data){
            $data_final = [
                key_status => $data[0],
                key_message => $data[1],
                key_data => $data[2]
            ];
            return $data_final;
        };
        $this->initializeEagleModel();
        $splashData = $this->Eagle_model->getSplashScreen();
        $message = (!empty($splashData)) ? $this->lang_message(text_record_found) : $this->lang_message(text_no_record_found);
        $response = [true , $message , $splashData];
        return $this->final_response($resp,$response);
    }

    private function signIn(){
        $resp = function($data){
            $data_final = [
                key_status => $data[0],
                key_message => $data[1],
                key_otp => $data[2]
            ];
            return $data_final;
        };
        $this->initializeEagleModel();
        $number = $this->input->post('phoneNumber');
        if(!empty($number) && strlen($number) == 10 ){
            $isregistered = $this->Eagle_model->registered($number);
            if(!$isregistered){
                $otp = strval($this->newotp());
                $uid = 'USER_' . $this->new_uid();
                $this->Eagle_model->addNumOtp($number, $otp, $uid);
            }
            $otp = $this->Eagle_model->getOtp($number);
            $otp = $otp[0]['otp'];
            $message = $isregistered ? $this->lang_message(text_user_already_exist) : $this->lang_message(text_new_user);
            $response = [true , $message , $otp];
            return $this->final_response($resp,$response);
        }
        $message =  $this->lang_message(text_mobile_number_must_be_ten_digit);    
        $response = [true , $message , false];
        return $this->final_response($resp,$response);     
    }

    private function vaidateOtp(){
        $resp = function($data){
            $data_final = [
                key_status => $data[0],
                key_message => $data[1],
                key_id =>  $data[2]
            ];
            return $data_final;
        };
        $number = $this->input->get('phoneNumber');
        $otp = $this->input->get('otp');

        $this->initializeEagleModel();

        $result = $this->Eagle_model->validateOtp($number,$otp);
        $message = '';
        $message = $result ? $this->lang_message(text_otp_matched) : $this->lang_message(text_otp_not_matched);

        $response = [true , $message, $result];
        return $this->final_response($resp,$response);
    }

    private function completeRegistration($id){
        $resp = function($data){
            $data_final = [
                key_status => $data[0],
                key_message => $data[1],
                key_inserted => $data[2]
            ];
            return $data_final;
        };
        $this->initializeEagleModel();
        
        $path = 'assets';

        if($this->do_upload($path, file_profile_image)){

            $img = $path .'/'. $this->upload->data(filename);
            
        }else{
            $message = $this->lang_message(text_image_upload_failed);
            $response = [false, $message];
            return $this->final_response($resp,$response);
        }       
        
        $name = $this->input->post('userName');
        $email = $this->input->post('userEmail');
        $trackingFor = $this->input->post('trackingFor');
        $base_img =  $img;

        if(!empty($name) && !empty($email) && !empty($trackingFor)){
            $setData = $this->Eagle_model->completeRegistration($name, $email, $trackingFor,$id, $base_img);
            $message = $setData ? $this->lang_message(text_registration_successfull) : $this->lang_message(text_registration_failed);
            $response = [true ,$message , $setData ];
            return $this->final_response($resp,$response); 
        }
        $response = [true , $this->lang_message(text_all_feilds_are_required), false];
        return $this->final_response($resp,$response); 
    }

    private function addSmartCardDetails($user_id = null){
        $resp = function($data){
            $data_final = [
                key_status => $data[0],
                key_message => $data[1],
                key_inserted => $data[2]
            ];
            return $data_final;
        };
        $this->initializeEagleModel();

        $path = 'assets';

        if($this->do_upload($path, file_profile_image)){
            $img = $path .'/'. $this->upload->data(filename);
        }else{
            $message = $this->lang_message(text_image_upload_failed);
            $response = [false, $message, null];
            return $this->final_response($resp,$response);  
        }
        $name = $this->input->post('name');
        $cardNumber = $this->input->post('cardNumber');
        $deviceId = $this->input->post('deviceId');
        $class = $this->input->post('class');
        $age = $this->input->post('age');
        $number1 = $this->input->post('number1');
        $number2 = $this->input->post('number2');
        $number3 = $this->input->post('number3');

        if(!empty($name) && 
           !empty($cardNumber) && 
           !empty($deviceId) && 
           !empty($class) && 
           !empty($age) && 
           (!empty($number1) || 
           !empty($number2) || 
           !empty($number3))){
            $numbers = array(
                'n1' => $number1,
                'n2' => $number2,
                'n3' => $number3
            );
            foreach($numbers as $key => $val ){
                if($numbers[$key] == ''){
                    unset($numbers[$key]);
                }
            }
            $setData = $this->Eagle_model->addSmartCardDetails($name,$user_id, $cardNumber, $deviceId, $class, $age, $numbers, $img);
            $message = $setData ? $this->lang_message(text_details_added) : $this->lang_message(text_device_exists);
            $response = [true ,$message,  $setData ];
            return $this->final_response($resp,$response);     
        }
        $response = [true , $this->lang_message(text_all_feilds_are_required), false];
        return $this->final_response($resp,$response);  
    }

    private function getKidsData($user_id){
        $resp = function($data){
            $data_final = [
                key_status => $data[0],
                key_message => $data[1],
                key_data => $data[2]
            ];
            return $data_final;
        };
        $this->initializeEagleModel();
        $userExists = $this->Eagle_model->userExists($user_id);
        if($userExists){
            $kidsData = $this->Eagle_model->getKidsData($user_id);
            $response = [true , $this->lang_message(text_user_exist), $kidsData];
            return $this->final_response($resp,$response);
        }
        $response = [true , $this->lang_message(text_user_not_exist), null];
        return $this->final_response($resp,$response);          
    }

    private function setSafeArea($user_id){
        $resp = function($data){
            $data_final = [
                key_status => $data[0],
                key_message => $data[1],
                key_inserted => $data[2]
            ];
            return $data_final;
        };
        $this->initializeEagleModel();
        $userExists = $this->Eagle_model->userExists($user_id);
        if($userExists){
            $safeAreaName = $this->input->post('safeAreaName');
            $longitude = $this->input->post('longitude');
            $latitude = $this->input->post('Latitude');
            $address = $this->input->post('address');
            $safeAreaRadius = $this->input->post('safe_area_radius');
            $alertOnExit = $this->input->post('alertOnExit');
            $alertOnEntry = $this->input->post('alertOnEntry');
            if( !empty($safeAreaName) &&
                !empty($longitude) &&
                !empty($latitude) &&
                !empty($safeAreaRadius) &&
                !empty($address)){
                $result = $this
                        ->Eagle_model
                        ->setSafeArea($address,$safeAreaName,$longitude,$latitude,$alertOnExit,$alertOnEntry,$safeAreaRadius,$user_id);
                $response = [true , $this->lang_message(text_safe_area_added), true];
                return $this->final_response($resp,$response);
            }
            $response = [true , $this->lang_message(text_all_feilds_are_required), false];
            return $this->final_response($resp,$response);  
            
        }
        $response = [true , $this->lang_message(text_user_not_exist), false];
        return $this->final_response($resp,$response);
    }

    private function getUserDetails($user_id){
        $resp = function($data){
            $data_final = [
                key_status => $data[0],
                key_message => $data[1],
                key_data => $data[2]
            ];
            return $data_final;
        };
        $this->initializeEagleModel();
        $userExists = $this->Eagle_model->userExists($user_id);
        if($userExists){
            $userData = $this->Eagle_model->getUserDetails($user_id);
            $response = [true , $this->lang_message(text_record_found), $userData ];
            return $this->final_response($resp,$response);
        }
        $response = [true , $this->lang_message(text_user_not_exist), null];
        return $this->final_response($resp,$response);
        
    }

    private function getSafeArea($user_id){
        $resp = function($data){
            $data_final = [
                key_status => $data[0],
                key_message => $data[1],
                key_data => $data[2]
            ];
            return $data_final;
        };
        $this->initializeEagleModel();

        $userExists = $this->Eagle_model->userExists($user_id);

        if($userExists){
            $safeAreaData = $this->Eagle_model->getSafeArea($user_id);

            $response = [true , $this->lang_message(text_user_exist), $safeAreaData];
            return $this->final_response($resp,$response);
        }
        $response = [true , $this->lang_message(text_user_not_exist), null];
        return $this->final_response($resp,$response);        
    }

    private function setSafeAreaStatus($safeAreaId){
        $resp = function($data){
            $data_final = [
                key_status => $data[0],
                key_message => $data[1],
                key_safe_area_status => $data[2]
            ];
            return $data_final;
        };
        $this->initializeEagleModel();
        $KeyExists = $this->Eagle_model->keyExists($safeAreaId);
        if($KeyExists){
            $isActive = $this->Eagle_model->setSafeAreaStatus($safeAreaId); 
            $response = [true , $this->lang_message(text_status_updated), $isActive];
            return $this->final_response($resp,$response);
        }
        $response = [true , $this->lang_message(text_user_not_exist), false];
        return $this->final_response($resp,$response);
    }

    private function setLocation($smartCardId){
        $resp = function($data){
            $data_final = [
                key_status => $data[0],
                key_message => $data[1],
                key_inserted => $data[2]
            ];
            return $data_final;
        };
        $this->initializeEagleModel();
        $smartCardExists = $this->Eagle_model->smartCardExists($smartCardId );
        if($smartCardExists){
            $long = $this->input->post('long');
            $lat = $this->input->post('lat');
            $setData = $this->Eagle_model->setLocation($smartCardId,$long,$lat);
            $response = [true, $this->lang_message(text_loaction_inserted),true];
            return $this->final_response($resp,$response);
        }
        $response = [true, $this->lang_message(text_loaction_not_inserted),false];
        return $this->final_response($resp,$response);
    }

    private function getLocation($smartCardId){
        $resp = function($data){
            $data_final = [
                key_status => $data[0],
                key_message => $data[1],
                key_data => $data[2]
            ];
            return $data_final;
        };
        $this->initializeEagleModel();

        $smartCardExists = $this->Eagle_model->smartCardExists($smartCardId);

        if($smartCardExists){
            $latLong = $this->Eagle_model->getLocation($smartCardId);
            $response = [true, $this->lang_message(text_loaction_found), $latLong];
            return $this->final_response($resp,$response);
        }
        $response = [true, $this->lang_message(text_loaction_not_found), null];
        return $this->final_response($resp,$response);        
    }

    private function getLocationHistory($smartCardId){
        $resp = function($data){
            $data_final = [
                key_status => $data[0],
                key_message => $data[1],
                key_data => $data[2]
            ];
            return $data_final;
        };
        $this->initializeEagleModel();

        $smartCardExists = $this->Eagle_model->smartCardExists($smartCardId);

        if($smartCardExists){
            $latLong = $this->Eagle_model->getLocationHistory($smartCardId);
            $response = [true, $this->lang_message(text_loaction_found), $latLong];
            return $this->final_response($resp,$response);  
        }
        $response = [true, $this->lang_message(text_loaction_not_found), null];
        return $this->final_response($resp,$response);  
        
    }

    private function addSecondaryParent($user_id){
        $resp = function($data){
            $data_final = [
                key_status => $data[0],
                key_message => $data[1],
                key_inserted => $data[2]
            ];
            return $data_final;            
        };
        $this->initializeEagleModel(); 
        $number = $this->input->post('number');
        $name = $this->input->post('name');
        $relationship = $this->input->post('relationship');
        $userExists =  $this->Eagle_model->userExists($user_id);
        $numberExists = $this->Eagle_model->numberExists($number);

        if(!$userExists){
            $response = [true, $this->lang_message(text_user_not_exist),false];
            return $this->final_response($resp,$response);
        }
        if(empty($name) || empty($number) || empty($relationship)){
            $response = [true, $this->lang_message(text_all_feilds_are_required),false];
            return $this->final_response($resp,$response);
        }  
        if($numberExists){
            $response = [true, $this->lang_message(text_user_already_exist),false];
            return $this->final_response($resp,$response);
        }
        $addDetails = $this->Eagle_model->addSecondaryParent($name, $number, $relationship);
        $message = $addDetails ? $this->lang_message(text_details_added) : $this->lang_message(text_details_not_added);
        $response = [true,$message,$addDetails];
        return $this->final_response($resp,$response);
    }
    

   








    public function addSecondaryParent_post($user_id){
        $response = $this->addSecondaryParent($user_id);
        $this->response($response[DATA], $response[HTTP_STATUS]);
    }

    public function getLocation_get($smartCardId){
        $response = $this->getLocation($smartCardId);
        $this->response($response[DATA], $response[HTTP_STATUS]);
    }

    public function getLocationHistory_get($smartCardId){
        $response = $this->getLocationHistory($smartCardId);
        $this->response($response[DATA], $response[HTTP_STATUS]);
    }

    public function setLocation_post($smartCardId){
        $response = $this->setLocation($smartCardId);
        $this->response($response[DATA], $response[HTTP_STATUS]);
    }

    public function setSafeAreaStatus_post($safeAreaId){
        $response = $this->setSafeAreaStatus($safeAreaId);
        $this->response($response[DATA], $response[HTTP_STATUS]);
    }

    public function getSafeArea_get($user_id){
        $response = $this->getSafeArea($user_id);
        $this->response($response[DATA], $response[HTTP_STATUS]);
    }

    public function getUserDetails_get($user_id){
        $response = $this->getUserDetails($user_id);
        $this->response($response[DATA], $response[HTTP_STATUS]);
    }

    public function setSafeArea_post($user_id){
        $response = $this->setSafeArea($user_id);
        $this->response($response[DATA], $response[HTTP_STATUS]);
    }

    public function getKidsData_get($user_id){
        $response = $this->getKidsData($user_id);
        $this->response($response[DATA], $response[HTTP_STATUS]);
    }

    public function addSmartCardDetails_post($user_id){
        $response = $this->addSmartCardDetails($user_id);
        $this->response($response[DATA], $response[HTTP_STATUS]);
    }

    public function validateOtp_get(){
        $response = $this->vaidateOtp();
        $this->response($response[DATA], $response[HTTP_STATUS]);
    }

    public function completeRegistration_post($id){
        $response = $this->completeRegistration($id);
        $this->response($response[DATA], $response[HTTP_STATUS]);
    }

    public function signIn_post(){
        $response = $this->signIn();
        $this->response($response[DATA], $response[HTTP_STATUS]);
    }
   
    public function splashScreen_get(){
        $response = $this->splashScreen();
        $this->response($response[DATA], $response[HTTP_STATUS]);
    }

    


}
?>
