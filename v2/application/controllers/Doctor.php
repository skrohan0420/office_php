<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . rest_controller_path;     
use instanthealth\RestServer\RestController;

class Doctor extends RestController  {  

    private $doctor_profile_image_path = path_doctor_profile_image;
    private $doctor_doc_image_path = path_doctor_doc_image;
    private $doctor_canceled_cheque_path = path_doc_canceled_cheque;
    private $allowed_type = type_allowed;  

    public function __construct() {
        header(header_allow_origin);
        header(header_allow_methods);

        parent::__construct();
        $this->load->database();
        $this->load->helper(array(helper_form, helper_url));
        $this->load->library(library_form_validation);
        $this->lang->load(lang_app_message);        
    }

    private function initializeApp(){
        $this->load->model(model_app);
    }  

    private function initializeDoctorModel(){
        $this->load->model(model_doctor);
    }  

    private function new_uid(){
        return (bin2hex(openssl_random_pseudo_bytes(16)) . time());
    }

    private function newotp(){
        return rand(1000,9999);
    }

    private function do_upload($path,$send_img){
        $config[key_upload_path]   = './'.$path;
        $config[key_allowed_types] = $this->allowed_type; 
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

    private function lang_message($str){
        return($this->lang->line($str));
    }

    private function do_mail($info){
        $this->load->library(library_email);

        $mail_config[key_smtp_host] = smtp_host;
        $mail_config[key_smtp_port] = smtp_port;
        $mail_config[key_smtp_user] = smtp_user;
        $mail_config[key__smtp_auth] = TRUE;
        $mail_config[key_smtp_pass] = smtp_pass;
        $mail_config[key_smtp_crypto] = smtp_crypto;
        $mail_config[key_protocol] = smtp_protocol;
        $mail_config[key_mailtype] = smtp_mailtype;
        $mail_config[key_send_multipart] = FALSE;
        $mail_config[key_charset] = smtp_charset;
        $mail_config[key_wordwrap] = TRUE;

        $this->email->initialize($mail_config);
        $this->email->set_newline("\r\n");              
        $this->email->from(smtp_user, mail_sender_name);

        $this->email->to($info->email);

        $otp = $this->newotp();

        $this->email->subject(mail_subject);

        $message =  sprintf($this->lang_message(text_email_message), $info->name, $otp);
        $this->email->message($message);
        // $this->email->message('Hi ,'.$info->name.'
        // We received a request to reset your Account password.
        // Enter the following password reset code:'.$otp);
       
        if($this->email->send()){
            $data = [
                key_status => true,
                key_message => $this->lang_message(text_otp_Sent),
                key_otpSent => true,
                key_otp => $otp,
                key_userId => $info->uid
            ];
            
            $this->response($data, http_ok);

        }else if(!$this->email->send()){           
            $data = [
                key_status => false,
                key_message => $this->lang_message(text_failed_to_sent_otp),
                key_otpSent => false,
                key_otp => '',
                key_userId => ""
            ];
            
            $this->response($data, http_failed_dependency);            
        }
    }

    private function appVersion(){
        $this->initializeApp();
        $appVersion = $this->App->app_version();        
        $message = $this->lang_message(text_app_version_fetched_successfully);

        $date = date_create($appVersion[0]->release_date);
        $date = date_format($date, format_app_version_date);

        $data = [
            key_success=>true,
            key_message=>$message,
            key_appversion=>[
                key_versioncode=>(int)$appVersion[0]->version_code,
                key_versionname=>$appVersion[0]->version_name,
                key_date=> $date
            ]
        ];
        return $data;
    }

    private function baseUrl(){
        $message = $this->lang_message(text_base_url_found_successfully);
        $data = [
            key_status => true,
            key_message => $message,
            key_baseurl => base_url()
        ];
        return $data;
    }

    private function changePassword($useremail = null, $pass){ //For changing Password
        if($useremail != null){
            $this->initializeDoctorModel();
            $result = $this->Doctor_Model->updatePassword($useremail, $pass);

            if($result)
                return [true, $this->lang_message(text_password_reset_successfully),true, http_ok];
            else      
                return [false, $this->lang_message(text_password_not_reset),false, http_forbidden_error];
        }else{
            return [false, $this->lang_message(text_password_not_reset),false, http_bad_request];
        }
    }

    private function userSignIn($email, $pass){
        $this->initializeDoctorModel();

        if(!isset($email)){ 
            return [false, $this->lang_message(text_email_require), false, '', http_bad_request];
        }

        if(!isset($pass)){
            return [false, $this->lang_message(text_password_require), false, '', http_bad_request];
        }

        $member = $this->Doctor_Model->getDoctorByEmailAndPass($email, $pass);

        if(!isset($member)) {
            return [true, $this->lang_message(text_userid_password_require), false, '', http_bad_request];
        }

        return [true, $this->lang_message(text_successfully_loggedin), true, $member->uid, http_ok]; 
    }

    private function passwordResetOtp($email){
        $this->initializeDoctorModel();
        if(!isset($email) || $email == null) {
            return [false, $this->lang_message(text_email_required), "", false, '', http_bad_request];
        }else{            
            $check_user_exist = $this->Doctor_Model->checkUserExistByEmail($email);
            if($check_user_exist){
                $info = $this->Doctor_Model->getDoctorByEmail($email);
                return $this->do_mail($info);
            }else{
                return [false, $this->lang_message(text_email_not_exist),"", false, '', http_Conflict]; 
            }
        }
    }

    private function doctorEducations(){
        $this->initializeDoctorModel();
        $results = $this->Doctor_Model->getEducations();
        if( isset($results) ){ 
            $list = [];
            foreach($results as $val){
                array_push($list, $val->degree);
            }
            return [true, $this->lang_message(text_education_list_fetched_successfully), $list, http_ok];                 
        }
        return [false, $this->lang_message(text_education_list_fetched_unsuccessful), [], http_not_found];  
    }

    private function doctorSpecialities($speciality){
        $list = [];
        if($speciality == ""){
            //if speciality blank then it returns blank array
            return [true, $this->lang_message(text_specialities_list_fetched_successfully), $list, http_ok];
        }
        $this->initializeDoctorModel();
        $results = $this->Doctor_Model->getSpecialities($speciality);
        
        if(!isset($results)){
            return [false, $this->lang_message(text_specialities_list_fetched_unsuccessful), [], http_not_found];
        }
        foreach($results as $val){
            $list = [];          
            foreach($results as $val){
                array_push($list, [key_id => $val->uid, key_name => $val->specialitie]);
            }
        }
        return [true, $this->lang_message(text_specialities_list_fetched_successfully), $list, http_ok];
    }

    private function addClinic($userid, $name, $address, $landmark, $fees, $lat, $lng){
        if( !isset($userid) || $userid==null){
            return [false, $this->lang_message(text_userid_require), false, http_bad_request];
        }

        $this->initializeDoctorModel();
        $check_user_exist = $this->Doctor_Model->checkUserExistByUserId($userid);

        if(!$check_user_exist){
            return [false, $this->lang_message(text_error_occurred), false, http_bad_request];
        }
        if( empty($name) ||  empty($address) || empty($landmark) || empty($fees) || empty($lat)|| empty($lng)){
            return [false, $this->lang_message(text_check_all_fields), false, http_bad_request];
        }

        $this->initializeDoctorModel();
        $added_clinic_id = $this->Doctor_Model->setClinic($userid, $name, $address, $landmark, $fees, $lat, $lng);

        if(!empty($added_clinic_id)){
            return [true, $this->lang_message(text_clinic_added_successfull), true, $added_clinic_id, http_ok];
        }else{
            return [false, $this->lang_message(text_error_occurred), false, $added_clinic_id, http_bad_request];
        }
    }

    private function _getClinics($userid){
        if( !isset($userid) || $userid==null){
            return [false, $this->lang_message(text_userid_require), [], http_bad_request];
        }

        $this->initializeDoctorModel();
        $check_user_exist = $this->Doctor_Model->checkUserExistByUserId($userid);

        if(!$check_user_exist){
            return [false, $this->lang_message(text_invalid_user), [], http_bad_request];
        }

        $results = $this->Doctor_Model->getClinics($userid);
        $data_count = count($results);

        $listOfClinics = [];

        if($data_count < 1){
            return [ true, $this->lang_message(text_no_record_found), [], http_not_found ];
        }
        foreach ($results as $result){
            $listOfClinics[] = array(
                key_id => $result->id,
                key_name => $result->name,
                key_address => $result->address,
                key_availabilityTime => $result->opening_time . " - " . $result->closing_time,
                key_maxAppointmentCapacity => (int)$result->max_appointment_capacity,
                key_availableWeekDays => $result->working_days,
                key_visitingFees => (float)$result->fees,
                key_is_available => (boolean)$result->is_available,
                key_total_timing => (int)0
            );
        }  
        return [true, $this->lang_message(text_record_found), $listOfClinics, http_ok];
    }

    private function _getPrescriptions($userid){
        if( !isset($userid) || $userid==null){
            return [false, $this->lang_message(text_userid_require), [], http_bad_request];
        }

        $this->initializeDoctorModel();
        $check_user_exist = $this->Doctor_Model->checkUserExistByUserId($userid);

        if(!$check_user_exist){
            return [false, $this->lang_message(text_invalid_user), [], http_bad_request];
        }

        $results = $this->Doctor_Model->getAllPrescriptions($userid);
        $data_count = count($results);

        $listOfPrescriptions = [];

        if($data_count < 1){
            return [ false, $this->lang_message(text_no_record_found), [], http_not_found ];
        }
        foreach ($results as $result){
            $listOfPrescriptions[] = array(
                key_patient_id              => $result->patientId,
                key_prescriptions_id        => $result->prescriptionId,
                key_patient_display_identity=> $result->name . " ( " . $result->gender . " - " . $result->age . " )",
                key_next_follow_up          => $result->next_follow_up,
                key_medication              => $result->medication,
                key_summary                 => $result->summery,
                key_date                    => $result->date,
                key_age                     => (int)$result->age,
                key_recomendation           => $result->recommendation
            );
        }  
        return [true, $this->lang_message(text_record_found), $listOfPrescriptions, http_ok];
    }

    private function _getAllAchievements($userid){
        if( !isset($userid) || $userid===null){
            return [false, $this->lang_message(text_userid_require), [], http_bad_request];
        }

        $this->initializeDoctorModel();
        $user_exists = $this->Doctor_Model->checkUserExistByUserId($userid);

        if(!$user_exists){
            return [false, $this->lang_message(text_invalid_user), [], http_forbidden_error];
        }

        $results = $this->Doctor_Model->getAllAchievements($userid);

        
        return [true, $this->lang_message(text_record_found), $results, http_ok];
    }

    private function availabilityCategories($userid){
        $this->initializeDoctorModel();
        $availability = $this->Doctor_Model->getAvailability($userid);
        return [true, $this->lang_message(text_record_found), $availability, http_ok];
    }

    private function selectedAvailabilities($userid, $ids){
        $this->initializeDoctorModel();
        $result = $this->Doctor_Model->setAvailability($userid, $ids);
        return [true, $this->lang_message(text_record_found), $result, http_ok];
    }

    private function availabilities($userid){
        $this->initializeDoctorModel();
        $result = $this->Doctor_Model->getSelectedAvailability($userid);
        return [true, $this->lang_message(text_record_found), $result, http_ok];
    }

    private function daysInWeek($userid){
        $this->initializeDoctorModel();
        $result = $this->Doctor_Model->getDaysInWeek($userid);
        return [true, $this->lang_message(text_record_found), $result, http_ok];
    }

    private function videoCallPrice($userid, $price){
        $this->initializeDoctorModel();
        $result = $this->Doctor_Model->setVideoCallPrice($userid, $price);
        return ($result)?
            [true, $this->lang_message(text_success), $result, http_ok]
            :
            [false, $this->lang_message(text_failed), $result, http_ok];
    }

    private function bankingDetails($userid, $data){
        $this->initializeDoctorModel();

        if( $data['upi_id'] != null && $data['brief_details'] == 'null' ){
            $upi_id = $data['upi_id'];
            $accountHolder = null;
            $accountNumber = null;
            $ifscCode = null;
            $bankName = null;
        }else{
            $upi_id = null;
            $brief_details = json_decode($data['brief_details']);

            $accountHolder = $brief_details->accountHolder;
            $accountNumber = $brief_details->accountNumber;
            $ifscCode = $brief_details->ifscCode;
            $bankName = $brief_details->bankName;
        }

        

        $has_cancelled_cheque = false;

        if(!empty($_FILES['cancelled_cheque']['name'])) {
            //File not exist
            $has_cancelled_cheque = true;
        }else{
            //File exist
            $has_cancelled_cheque = false;
        }

        $path = $this->doctor_canceled_cheque_path;
        if(!empty($upi_id) && !empty($accountHolder) && !empty($accountNumber) && !empty($ifscCode) && !empty($bankName) && $has_cancelled_cheque){
            //All fields have data
            return [false, $this->lang_message(text_upiid_or_bankdetails), false, http_bad_request];
        }else if(!empty($upi_id) && !empty($accountHolder) && !empty($accountNumber) && !empty($ifscCode)){
            return [false, $this->lang_message(text_upiid_or_bankdetails), false, http_bad_request];
        }else if(!empty($upi_id) &&$has_cancelled_cheque ){
            return [false, $this->lang_message(text_upiid_or_bankdetails), false, http_bad_request];
        }else if(!empty($upi_id) && empty($accountHolder) && empty($accountNumber) && empty($ifscCode) && empty($bankName) && !$has_cancelled_cheque){
            //insert upi id in database
            $add_bank_details = $this->Doctor_Model->setBankingDetails($userid, $upi_id, $has_cancelled_cheque);
            if($add_bank_details)
                return [true, $this->lang_message(text_success), true, http_ok];
        }else if(empty($upi_id) && !empty($accountHolder) && !empty($accountNumber) && !empty($ifscCode)&& !empty($bankName) && $has_cancelled_cheque){            
            //insert bank details and blank cheque
            if($this->do_upload($path, param_user_cancelled_cheque)){
                $img = $path . $this->upload->data(filename);
                $add_bank_details = $this->Doctor_Model->setBankingDetails($userid, $upi_id, $has_cancelled_cheque, $accountHolder, $accountNumber, $ifscCode, $bankName, $img);
                if($add_bank_details)
                    return [true, $this->lang_message(text_success), true, http_ok];
            }else{
                 return [false, $this->lang_message(text_error_occurred), false, http_ok];
            }
        }else{
            return [false, $this->lang_message(text_error_occurred), false, http_ok];
        }       
    }

    private function availableTimings($userid, $purpose, $clinic_id){
        $this->initializeDoctorModel();

        $price = $this->Doctor_Model->getPrice($userid, $purpose);

        $result = $this->Doctor_Model->getavailableTimings($userid, $purpose, $clinic_id);

        // print_r($result);

        return [true, $this->lang_message(text_success),$price, $result, http_ok];
    }

    private function userShortDetails($userid){
        if( !isset($userid) || $userid==null){
            return [false, $this->lang_message(text_userid_require), [], http_bad_request];
        }

        $this->initializeDoctorModel();
        $check_user_exist = $this->Doctor_Model->checkUserExistByUserId($userid);

        if(!$check_user_exist){
            return [false, $this->lang_message(text_invalid_user), [], http_bad_request];
        }

        $results = $this->Doctor_Model->getShortDetails($userid);
        $results = $results[0];
        return [true, $this->lang_message(text_success), $results, http_ok];
    }

    private function getAvailibilityData($userid, $availability_id, $purpose){
        if( !isset($userid) || $userid==null){
            return [false, $this->lang_message(text_userid_require), [], http_bad_request];
        }

        $this->initializeDoctorModel();
        $check_user_exist = $this->Doctor_Model->checkUserExistByUserId($userid);

        if(!$check_user_exist){
            return [false, $this->lang_message(text_invalid_user), [], http_bad_request];
        }

        if($availability_id == null || $availability_id == 'null' || empty($availability_id))
            return [false, $this->lang_message(text_failed), 0, [], http_bad_request];

        $fees = $this->Doctor_Model->getFees($userid, $availability_id, $purpose); // it will get data from ih_fees table according to user and voice or video id

        $results = $this->Doctor_Model->getAvailabilityData($userid, $availability_id);
        
        return [true, $this->lang_message(text_success), $fees, $results, http_ok];
    }

    private function updateCallingFees($userid, $fees, $what_for){
        if( !isset($userid) || $userid==null){
            return [false, $this->lang_message(text_userid_require), [], http_bad_request];
        }

        $this->initializeDoctorModel();
        $check_user_exist = $this->Doctor_Model->checkUserExistByUserId($userid);

        if(!$check_user_exist){
            return [false, $this->lang_message(text_invalid_user), [], http_bad_request];
        }

        $results = $this->Doctor_Model->UpdateFees($userid, $fees, $what_for);
        
        if($fees == null) return [false, $this->lang_message(text_error_occurred), false, http_bad_request];

        return ($results)?
        [true, $this->lang_message(text_success), true, http_ok]
        :
        [false, $this->lang_message(text_error_occurred), false, http_bad_request]
        ;
    }

    private function deleteVoiceOrVideo($userid, $target_id, $category){

        if( !isset($userid) || $userid==null){
            return [false, $this->lang_message(text_userid_require), [], http_bad_request];
        }

        $this->initializeDoctorModel();
        $check_user_exist = $this->Doctor_Model->checkUserExistByUserId($userid);

        if(!$check_user_exist){
            return [false, $this->lang_message(text_invalid_user), [], http_bad_request];
        }

        $results = $this->Doctor_Model->DeleteVoiceOrVideoAvailibility($userid, $target_id, $category);
        
        return ($results)?
        [true, $this->lang_message(text_success), true, http_ok]
        :
        [false, $this->lang_message(text_error_occurred), false, http_bad_request]
        ;
    }

    public function appVersion_get(){
        $response = $this->appVersion();

        $this->response($response, http_ok);
    }

    public function baseUrl_get(){   
        $response = $this->baseUrl();

        $this->response($response, http_ok);
    }

    public function user_get(){
        $resp = function($data){
            $data_final = [
                key_status => $data[0],
                key_message => $data[1],
                key_isSignInSuccess => $data[2],
                key_userId => $data[3]
            ];            
            $this->response($data_final, $data[4]);
        };        

        $email = $this->input->get(query_param_email);
        $pass = $this->input->get(query_param_password);

        $response = $this->userSignIn($email, $pass);
        $resp($response);          
    }

    public function users_post(){
        $resp = function($status, $message, $isSignupSuccess, $userId, $errors, $http_code){
            $data = [
                key_status => $status,
                key_message => $message,
                key_isSignupSuccess => $isSignupSuccess,
                key_userId => $userId,
                key_errors => $errors,
            ];
            
            $this->response($data, $http_code);
        };
        
        $this->form_validation->set_rules(param_username, param_username,'trim|required|min_length[3]');
        $this->form_validation->set_rules(param_email,param_email, 'trim|required|valid_email');
        $this->form_validation->set_rules(param_mobilenumber,param_mobilenumber,'trim|required|numeric|min_length[10]|max_length[10]');
        $this->form_validation->set_rules(param_password,param_password,'trim|required');

        
        if($this->form_validation->run() == FALSE){
            $errors = $this->form_validation->error_array();
            $error = [];
            foreach($errors as $name => $message){
                array_push($error, array(key_name=>$name, key_message=>$message));
            }
            $resp(false, $this->lang_message(text_error_occurred), false, '', $error, http_bad_request);
        }else{

            $name =  $this->input->post(param_username);
            $email =  $this->input->post(param_email);
            $mobile =  $this->input->post(param_mobilenumber);
            $password =  $this->input->post(param_password);

            $path = $this->doctor_profile_image_path;

            $this->initializeDoctorModel();

            // if( !$this->Doctor_Model->checkUserExistByEmail($email) ){

                if($this->do_upload($path, param_user_image)){

                    $img = $path . $this->upload->data(filename);

                    $uid = $this->new_uid();

                    $data = array(  
                        field_uid => $uid,
                        field_name => $name,
                        field_email => $email,
                        field_mobile => $mobile,
                        field_pass => $password,
                        field_profile_img => $img,
                    );  

                    if($this->Doctor_Model->setDoctorDetails($data)){
                        
                        $resp(true, $this->lang_message(text_registration_successfull), true, $uid, 0, http_ok);
                    }else{
                        $resp(false, $this->lang_message(text_error_occurred), false, '', 0, http_bad_request);
                    }
                }else{
                    $resp(false, $this->lang_message(text_invalid_image_format), false, '', 1, http_unprocessable_entity);
                }
            // }else{          
            //     $resp(false, $this->lang_message(text_email_already_exist), false, '', 0, http_Conflict);
            // }
        }
    }

    public function userShortDetails_get($userid = null){
        $resp = function($data){
            $data_final = [
                key_status => $data[0],
                key_message => $data[1],
                key_user => $data[2],
            ];
            
            $this->response($data_final, $data[3]);
        };

        if($this->input->get('detailsLevel') == 'shortProfile'){
            $response = $this->userShortDetails($userid);
            // $response = [true, $this->lang_message(text_success), $this->userShortDetails($userid), http_ok];
            $resp($response);
        }else{
            $response = [false, $this->lang_message(text_error_occurred), [], http_bad_request];
            $resp($response);
        }
    }

    public function passwordResetOtp_get(){
        $resp = function($data){
            $data_final = [
                key_status => $data[0],
                key_message => $data[1],
                key_otpSent => $data[3],
                key_otp => $data[2],
                key_userId => $data[4]
            ];            
            $this->response($data_final, $data[5]);            
        };

        $email = $this->input->get(query_param_email);

        $response = $this->passwordResetOtp($email);
        $resp($response);
    }

    public function changePassword_put($useremail = null){
        $resp = function($data){
            $data1 = [
                key_status => $data[0],
                key_message => $data[1],
                key_password_reset_success => $data[2]
            ];            
            $this->response($data1, $data[3]);            
        }; 

        $pass =  $this->put(key_password);

        //Referance : url decode : https://stackoverflow.com/questions/1756862/url-decoding-in-php
        $useremail = urldecode($useremail);

        $response = $this->changePassword($useremail, $pass);
        $resp($response);        
    } 

    public function doctorDetails_post($userid = null){

        $resp = function($status, $message, $professionalDetailsUpdated, $errors, $http_code){
            $data = [
                key_status => $status,
                key_message => $message,
                key_professiona_details_updated => $professionalDetailsUpdated
            ];
            
            $this->response($data, $http_code);            
        };
        // $resp(false, $_FILES ,true,[], http_ok);

        $this->form_validation->set_rules(param_education, param_education,'trim|required');
        $this->form_validation->set_rules(param_speciality, param_speciality,'trim|required');
        $this->form_validation->set_rules(param_licence, param_licence,'trim|required');
        $this->form_validation->set_rules(param_experience, param_experience,'trim|required|numeric|min_length[1]|max_length[2]');

        if($this->form_validation->run() == FALSE){ //Form validation Failed
            $errors = $this->form_validation->error_array();
            $error = [];
            foreach($errors as $name => $message){
                array_push($error, array(key_name=>$name, key_message=>$message));
            }
            $resp(false, $this->lang_message(text_error_occurred), false, $error, http_bad_request);
        }

        if($userid == null){    //userid not provided
            $resp(false, $this->lang_message(text_userid_is_required), false, [], http_forbidden_error);
        }

        $this->initializeDoctorModel();
        $user_exist = $this->Doctor_Model->checkUserExistByUserId($userid);
        if(!$user_exist){   // User not exist
            $resp(false, $this->lang_message(text_error_occurred), false,[], http_bad_request);
        }

        $path = $this->doctor_doc_image_path;
        
        $aadhar_card_front = param_aadhar_card_front;
        if(!isset($aadhar_card_front)){    //aadhar front image not attached
            $resp(false,$this->lang_message(text_attach_aadhaar_front),false,[], http_bad_request);
        }

        $aadhar_card_back = param_aadhar_card_back;
        if(!isset($aadhar_card_back)){     //aadhar back image not attached
            $resp(false,$this->lang_message(text_attach_aadhaar_back),false,[], http_bad_request);
        }
        
        //take all post variables
        $education = $this->input->post(param_education);
        $speciality = $this->input->post(param_speciality);
        $licence = $this->input->post(param_licence);
        $experience = $this->input->post(param_experience);

        if(!$this->do_upload($path,$aadhar_card_front)){   //aadhar front upload failed
            $resp(false, $this->lang_message(text_invalid_image_format), false,[], http_unprocessable_entity); 
        }
        $aadhar_front = $path.$this->upload->data(filename);

        if(!$this->do_upload($path, $aadhar_card_back)){     //aadhar back upload failed
            $resp(false, $this->lang_message(text_invalid_image_format), false,[], http_unprocessable_entity);
        }        
        $aadhar_back = $path.$this->upload->data(filename);

        $data = array(  
            field_uid => $userid,
            field_education => $education,
            field_speciality => $speciality,
            field_licence => $licence,
            field_experience => $experience,
            field_aadhar_front => $aadhar_front,
            field_aadhar_back => $aadhar_back
        );

        $result = $this->Doctor_Model->updateDoctorDetails($data, $userid);

        if($result === true){   //updated successfully
            $resp(true, $this->lang_message(text_record_inserted_successfully), true,[], http_ok);
        }else{  //could not update
            $resp(false, $this->lang_message(text_error_occurred), false,[], http_bad_request); 
        }        
    }

    public function doctorEducations_get(){
        $resp = function($data){
            $data_final = [
                key_status => $data[0],
                key_message => $data[1],
                key_educations => $data[2]
            ];            
            $this->response($data_final, $data[3]);
        };
        $response = $this->doctorEducations();
        $resp($response);
    }

    public function doctorSpecialities_get(){
        $resp = function($data){
            $data_final = [
                key_status => $data[0],
                key_message => $data[1],
                key_specialities => $data[2]
            ];        
            
            $this->response($data_final, $data[3]);
        };
        $speciality = $this->input->get('speciality');
        $response = $this->doctorSpecialities($speciality);
        $resp($response);
    }

    public function clinics_post($userid = null){
        $resp = function($data){
            $data_final = [
                key_status => $data[0],
                key_message => $data[1],
                key_isClinicAdded => $data[2],
                key_submittedClinicId => $data[3]
            ];
            
            $this->response($data_final, $data[4]);
        };

        $name = $this->input->post(param_clinic_name);
        $address = $this->input->post(param_clinic_address);
        $landmark = $this->input->post(param_clinic_landmark);
        // $opening_time = $this->input->post(param_clinic_opening_time);
        // $closing_time = $this->input->post(param_clinic_closing_time);
        $fees = $this->input->post(param_fees);
        // $working_days_in_week = $this->input->post(param_clinic_working_days_in_week);
        $lat = $this->input->post(param_clinic_lat);
        $lng = $this->input->post(param_clinic_lng);
        // $max_appointment_capacity = 0;

        $response = $this->addClinic($userid, $name, $address, $landmark, $fees, $lat, $lng);
        $resp($response);
    }

    public function clinics_get($userid = null){
        $resp = function($data){
            $data_final = [
                key_status => $data[0],
                key_message => $data[1],
                key_clinics => $data[2],
            ];
            
            $this->response($data_final, $data[3]);
        };
        $response = $this->_getClinics($userid);
        $resp($response);
    }

    public function prescriptions_get($userid = null){
        $resp = function($data){
            $data_final = [
                key_status => $data[0],
                key_message => $data[1],
                key_prescriptions => $data[2],
            ];
            
            $this->response($data_final, $data[3]);
        };
        $response = $this->_getPrescriptions($userid);
        $resp($response);
    }

    public function achievements_get($userid = null){
        $resp = function($data){
            $data_final = [
                key_status => $data[0],
                key_message => $data[1],
                key_achievements => $data[2],
            ];
            
            $this->response($data_final, $data[3]);
        };
        $response = $this->_getAllAchievements($userid);
        $resp($response);
    }

    public function availabilityCategories_get($userid = null){
         $resp = function($data){
            $data_final = [
                key_status => $data[0],
                key_message => $data[1],
                key_availabilities => $data[2],
            ];            
            $this->response($data_final, $data[3]);
        };
        $response = $this->availabilityCategories($userid);
        $resp($response);
    }

    public function selectedAvailabilities_put($userid = null){
         $resp = function($data){
            $data_final = [
                key_status => $data[0],
                key_message => $data[1],
                key_isAdded => $data[2],
            ];            
            $this->response($data_final, $data[3]);
        };
        $ids = $this->put('ids');
        $response = $this->selectedAvailabilities($userid, $ids);
        $resp($response);
    }

    public function availabilities_get($userid = null){
        $resp = function($data){
            $data_final = [
                key_status => $data[0],
                key_message => $data[1],
                key_categories => $data[2],
            ];            
            $this->response($data_final, $data[3]);
        };

        $response = $this->availabilities($userid);
        $resp($response);
    }

    public function daysInWeek_get($userid = null){
        $resp = function($data){
            $data_final = [
                key_status => $data[0],
                key_message => $data[1],
                key_days => $data[2],
            ];            
            $this->response($data_final, $data[3]);
        };

        $response = $this->daysInWeek($userid);
        $resp($response);
    }

    public function videoCallPrice_post($userid = null){
        $resp = function($data){
            $data_final = [
                key_status => $data[0],
                key_message => $data[1],
                key_isAdded => $data[2],
            ];            
            $this->response($data_final, $data[3]);
        };
        $price = $this->input->post('price');
        $response = $this->videoCallPrice($userid, $price);
        $resp($response);
    }

    public function availableTimings_get($userid = null, $clinic_id = null){
        $resp = function($data){
            $data_final = [
                key_status => $data[0],
                key_message => $data[1],
                key_price => $data[2],
                key_timings => $data[3],
            ];            
            $this->response($data_final, $data[4]);
        };

        $purpose = $this->uri->segment(3);

        $response = $this->availableTimings($userid, $purpose, $clinic_id);
        $resp($response);
    }

    public function bankingDetails_post($userid = null){
        $resp = function($data){
            $data_final = [
                key_status => $data[0],
                key_message => $data[1],
                key_isAdded => $data[2],
            ];            
            $this->response($data_final, $data[3]);
        };
        $response = $this->bankingDetails($userid, $_POST);
        $resp($response);
    }

    public function voiceCallingFees_get($userid = null){
        $resp = function($data){
            $data_final = [
                key_status => $data[0],
                key_message => $data[1],
                key_fees => $data[2],
                key_timings => $data[3]                
            ];
            $this->response($data_final, $data[4]);
        };
        $availability_id = $this->input->get('id');
        $response = $this->getAvailibilityData($userid, $availability_id, voice);
        $resp($response);
    }

    public function voiceCallingFees_put($userid = null){
        $resp = function($data){
            $data_final = [
                key_status => $data[0],
                key_message => $data[1],
                key_isFeesSet => $data[2]             
            ];
            $this->response($data_final, $data[3]);
        };
        $id = $this->put(key_id);        
        $fees = $this->put(key_fees);
        $response = $this->updateCallingFees($userid, $fees, voice);
        $resp($response);
    }

    public function voiceSchedule_delete($userid = null, $category = null, $target_id = null){
        $resp = function($data){
            $data_final = [
                key_status => $data[0],
                key_message => $data[1],
                key_isDeleted => $data[2]             
            ];
            $this->response($data_final, $data[3]);
        };
        // $id = $this->put(key_id);        
        // $target_id = $this->put(key_target_id);
        // $category = $this->put(key_category);
        $response = $this->deleteVoiceOrVideo($userid, $target_id, $category);
        $resp($response);
    }

    public function videoCallingFees_get($userid = null){
        $resp = function($data){
            $data_final = [
                key_status => $data[0],
                key_message => $data[1],
                key_fees => $data[2],
                key_timings => $data[3]                
            ];
            $this->response($data_final, $data[4]);
        };
        $availability_id = $this->input->get('id');
        $response = $this->getAvailibilityData($userid, $availability_id, video);
        $resp($response);
    }

    public function videoCallingFees_put($userid = null){
        $resp = function($data){
            $data_final = [
                key_status => $data[0],
                key_message => $data[1],
                key_isFeesSet => $data[2]             
            ];
            $this->response($data_final, $data[3]);
        };
        $id = $this->put(key_id);        
        $fees = $this->put(key_fees);        
        // echo $fees;
        $response = $this->updateCallingFees($userid, $fees, video);
        $resp($response);
    }

    public function videoSchedule_delete($userid = null, $category = null, $target_id = null){
        $resp = function($data){
            $data_final = [
                key_status => $data[0],
                key_message => $data[1],
                key_isDeleted => $data[2]             
            ];
            $this->response($data_final, $data[3]);
        };
              
        $response = $this->deleteVoiceOrVideo($userid, $target_id, $category);
        $resp($response);
    }



}
