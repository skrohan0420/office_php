<?php
defined('BASEPATH') or exit('nothing found');
require APPPATH . rest_controller_path;     
use chriskacerguis\RestServer\RestController;

class Users extends RestController{ 

    public function __construct(){
        parent::__construct();
        $this->load->model('User_model');
    }

    private function user_list($id){
        $resp = function($data){
            $data_final = [
                key_status => $data[0],
                key_message => $data[1],
                key_user => $data[2]
            ];
            return $data_final;
        };
        $userData = $this->User_model->getUserById($id);

        if(!empty($userData)){
            $message = 'text_record_found';
            $response = [true , $message , $userData];

            $final_response[DATA] = $resp($response);
            $final_response[HTTP_STATUS] = http_ok;
            return $final_response;
        }else{
            $message ='text_no_record_found';
            $response = [false, $message, $userData];

            $final_response[DATA] = $resp($response);
            $final_response[HTTP_STATUS] = http_ok;
            return $final_response;
        }
    }

    public function getUser_get($id){
        $response = $this->user_list($id);
        $this->response($response[DATA], $response[HTTP_STATUS]);
    }
   


    // private function country_list(){
    //     $resp = function($data){
    //         $data_final = [
    //             key_status => $data[0],
    //             key_message => $data[1],
    //             key_countries => $data[2]
    //         ];
    //         return $data_final;
    //     };

    //     $this->init_common_model();
    //     $countries = $this->Common_model->get_country_list();

    //     $countries_final = [];
    //     if(!empty($countries)){
            
    //         foreach($countries as $key => $value){
    //             $countries_final[] = [
    //                 key_id => $value[field_id],                    
    //                 key_name => ucwords($value[field_name])            
    //             ];
    //         }
    //         $message = $this->lang_message(text_record_found);
    //         $response = [true, $message, $countries_final];

    //         $final_response[DATA] = $resp($response);
    //         $final_response[HTTP_STATUS] = http_ok;
    //         return $final_response;
            
    //     }else{
    //         $message = $this->lang_message(text_no_record_found);
    //         $response = [false, $message, $countries_final];

    //         $final_response[DATA] = $resp($response);
    //         $final_response[HTTP_STATUS] = http_ok;
    //         return $final_response;
    //     }
    // }

    // public function countries_get(){
    //     $response = $this->country_list();
    //     $this->response($response[DATA], $response[HTTP_STATUS]);
    // }

}
?>