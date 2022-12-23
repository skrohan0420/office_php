<?php
    class Doctor_Model extends CI_Model {
        public function __construct(){
            parent::__construct();
            date_default_timezone_set('Asia/Kolkata');
        }

        private function random_six_digit_uid_generator(){
            return random_int(100000, 999999);
        }

        private function existInNormalAvailablities($userid){
            $this->db->where(key_doctor_uid, $userid);
            $query = $this->db->get(table_normal_availabilities);
            return $query->result_array();
        }

        private function getWeekDaysAlreadyExistInNormalTable($userid){
            $this->db->select(table_normal_availabilities.'.'.field_week_days_uids);
            $this->db->where(field_doctor_uid, $userid);
            $query = $this->db->get(table_normal_availabilities);
            return $query->result_array();
        }

        public function getDoctorByEmailAndPass($email, $password){
            $data = [
                field_email => $email,
                field_pass => $password
            ];       
            $query = $this->db->get_where(table_doctor, $data)->row();  
            return $query; 
        }

        public function getDoctorByEmail($email){  
            $data = [
                field_email => $email
            ];        
            $query = $this->db->get_where(table_doctor, $data)->row();  
            return $query; 
        }

        public function checkUserExistByEmail($email){
            $this->db->where(field_email ,$email);
            $query = $this->db->get(table_doctor);
            return $query->num_rows() > 0;
        }

        public function checkUserExistByUserId($userid){
            $this->db->where(field_uid ,$userid);
            $query = $this->db->get(table_doctor);
            return $query->num_rows() > 0;
        }

        public function setDoctorDetails($data){
            $this->db->insert(table_doctor,$data);
            $affected_rows = $this->db->affected_rows();
            return $affected_rows === 1;
        }

        public function updateDoctorDetails($data, $userid){
            $this->db->where(field_uid, $userid);
            $this->db->update(table_doctor, $data);
            $affected_rows = $this->db->affected_rows();
            return $affected_rows === 1;
        }

        public function updatePassword($useremail, $pass){
            $data = [
                field_pass => $pass
            ];
            $this->db->where(field_email, $useremail);
            $this->db->update(table_doctor, $data);
            $affected_rows = $this->db->affected_rows();
            return $affected_rows === 1;
        }

        public function getShortDetails($userid){
            $this->db->select(table_doctor.".". field_name .",".table_doctor.".". field_profile_image);
            $this->db->where(key_uid, $userid);
            $query = $this->db->get(table_doctor);
            $query = $query->result_array();            
            return $query;
        }

        public function getEducations(){
            $result = $this->db->get(table_educations)->result();
            return $result;
        }

        public function getSpecialities($speciality){
            $this->db->like('specialitie',$speciality, 'after');
            $result = $this->db->get(table_specialities)->result();
            return $result;
        }

        public function setClinic($userid, $name, $address, $landmark, $fees, $lat, $lng){
            $clinic_uid = $this->random_six_digit_uid_generator();
            $data = [
                field_doctor_id => $userid,
                field_uid => $clinic_uid,
                field_doctor_name => $name,
                field_clinic_address => $address,
                field_clinic_landmark => $landmark,                
                field_clinic_fees => $fees,                
                field_clinic_lat => $lat,
                field_clinic_lng => $lng,
                field_created_at => date("Y-m-d H:i:s"),
            ];
            $this->db->insert(table_clinics, $data);
            $affected_rows = $this->db->affected_rows();
            return ($affected_rows === 1)?$clinic_uid:"";
        }

        public function getClinics($userid){
            $data = [
                field_doctor_id => $userid
            ];
            $results = $this->db->get_where(table_clinics, $data)->result();
            return $results;
        }

        public function getAllPrescriptions($userid){
            $select =   table_prescription. "." .field_uid . " AS ". alise_prescription_id ." , " .
                        table_prescription. "." .field_medication ." , " .
                        table_prescription. "." .field_next_follow_up ." , " .
                        table_prescription. "." .field_summery ." , " .
                        table_prescription. "." .field_date ." , " .
                        table_prescription. "." .field_recommendation ." , " .
                        table_patients. "." .field_uid  . " AS ".  alise_patient_id ." , " .
                        table_patients. "." .field_name ." , " .
                        table_patients. "." .field_gender ." , " .
                        table_patients. "." .field_age;

            $join_doctor_id_patient_prescription = table_prescription . "." .field_doctor_id . " = ". table_patients . "." .field_doctor_id;
            $where = table_prescription . "." .field_doctor_id;

            $this->db->select($select);
            $this->db->from(table_prescription);
            $this->db->join(table_patients, $join_doctor_id_patient_prescription);
            $this->db->where($where, $userid);
            $query = $this->db->get();
            return $query->result();

            //MANUAL SQL QUERY

            // $sql = "select 
            //                 ih_prescriptions.uid as prescriptionId,
            //                 ih_prescriptions.next_follow_up,
            //                 ih_prescriptions.medication,
            //                 ih_prescriptions.summery,
            //                 ih_prescriptions.date,
            //                 ih_prescriptions.recommendation,
            //                 ih_patients.uid as patientsId,
            //                 ih_patients.name,
            //                 ih_patients.gender,
            //                 ih_patients.age
            //         FROM ih_prescriptions
            //         INNER JOIN ih_patients ON ih_prescriptions.doctor_id = ih_patients.doctor_id where ih_prescriptions.doctor_id = '$userid';";
           
            // $query = $this->db->query($sql);
            // return $query->result();            
        }

        private function getCountSuccessfulPatient($userid){
            $this->db->where(field_doctor_id, $userid);
            return $this->db->count_all_results(table_patients);
        }

        private function getCountProfessionalAchievements($userid){
            $this->db->where(field_doctor_id, $userid);
            return $this->db->count_all_results(table_professional_certificate);
        }

        private function getCountePrescription($userid){
            $this->db->where(field_doctor_id, $userid);
            return $this->db->count_all_results(table_prescription);
        }

        private function getCountExpericence($userid){
            $data = [
                field_uid => $userid
            ];
            $result = $this->db->select(field_experience)->from(table_doctor)->where($data)->get()->result();
            return $result[0]->experience;
        }

        public function getAllAchievements($userid){
            $process = function($id, $name, $value, $image){
                return [
                    key_id      => $id,
                    key_name    => $name,
                    key_value   => (string)$value,
                    key_image   => $image
                ];
            };
            $query = $this->db->get(table_achievements);
            $data = [];
            foreach ($query->result() as $row){
                switch($row->name){
                    case achievements_successful_patient:
                        $data[] = $process($row->id, $row->name, $this->getCountSuccessfulPatient($userid), base_url() . $row->image_path);
                        break;
                    case achievements_e_priscription:
                        $data[] = $process($row->id, $row->name, $this->getCountePrescription($userid), base_url() . $row->image_path);
                        break;
                    case achievements_experience:
                        $data[] = $process($row->id, $row->name, $this->getCountExpericence($userid), base_url() . $row->image_path);
                        break;
                    case achievements_certificate:
                        $data[] = $process($row->id, $row->name, $this->getCountProfessionalAchievements($userid), base_url() . $row->image_path);
                        break;    
                }
            }
            return $data;
        }

        public function getAllAvailabilites(){
            $query = $this->db->get(table_availability);
            return $query->result_array();
        }

        public function getAvailability($userid){
            $doc_avail = [];
            $res_arr = [];

            $availabiliies = $this->getAllAvailabilites();


            $this->db->select(table_doctor.'.'.field_availability);
            $this->db->where(field_uid, $userid);
            $query = $this->db->get(table_doctor);
            $query = $query->result_array();

            if($query[0][field_availability] != ''){
                //if availability exist
                $doc_avail = $query[0][field_availability];
                $doc_avail = explode(',', $doc_avail);

                foreach($availabiliies as $key => $value){
                    $is_selected = in_array($value[field_id], $doc_avail);
                    $res_arr[] = [
                        key_id => $value[field_id],
                        key_name => ucwords($value[field_categories]),
                        key_isSelected => $is_selected
                    ];
                }
            }else{
                foreach($availabiliies as $key => $value){
                    $res_arr[] = [
                        key_id => $value[field_id],
                        key_name => ucwords($value[field_categories]),
                        key_isSelected => false
                    ];
                }  
            }

            return $res_arr;
        }

        public function setAvailability($userid, $ids){
            $data = [
                field_availability => implode(',', $ids)
            ];
            $this->db->where(field_uid, $userid);
            $this->db->update(table_doctor, $data);
            $affected_rows = $this->db->affected_rows();
            return $affected_rows === 1;
        }

        public function getSelectedAvailability($userid){
            $doc_avail = [];
            $res_arr = [];

            $availabiliies = $this->getAllAvailabilites();

            $this->db->select(table_doctor.'.'.field_availability);
            $this->db->where(field_uid, $userid);
            $query = $this->db->get(table_doctor);
            $query = $query->result_array();

            if($query[0][field_availability] != ''){
                //if availability exist
                $doc_avail = $query[0][field_availability];
                $doc_avail = explode(',', $doc_avail);

                foreach($availabiliies as $key => $value){
                    $is_selected = in_array($value[field_id], $doc_avail);
                    if(!$is_selected) continue;
                    $res_arr[] = [
                        key_id => $value[field_id],
                        key_name => ucwords($value[field_categories]),
                        key_isSelected => $is_selected
                    ];
                }
            }

            return $res_arr;
        }

        public function getDaysInWeek($userid){
            $this->db->select(table_week_days.'.'.field_uid.','.table_week_days.'.'.field_color_code.','.table_week_days.'.'.field_short_name.','.table_week_days.'.'.field_full_name.',');
            $this->db->from(table_week_days);
            $query = $this->db->get();

            $query = $query->result_array();
            $res_arr = [];

            //check if doctorid alerady present in `ih_normal_availabilities` table
            $doctors_available_in_normal_table_data = $this->existInNormalAvailablities($userid);

            if(count($doctors_available_in_normal_table_data) == 0){

                foreach($query as $key => $value){
                    $res_arr[] = [
                        key_id => $value[field_uid],
                        key_color_code => $value[field_color_code],
                        key_short_name => $value[field_short_name],
                        key_full_name => $value[field_full_name],
                        key_isSelected => false
                    ];
                }
                return $res_arr;

            }else{
                //doctor already selected for normal apointment
                $week_days_data_from_normal_avail_table = $this->getWeekDaysAlreadyExistInNormalTable($userid);

                $arr="";
                foreach($week_days_data_from_normal_avail_table as $k => $v){
                    // print_r($v[field_week_days_uids]);
                    // array_push($arr,$v[field_week_days_uids]);
                    $arr .= $v[field_week_days_uids];
                    $arr .= ",";
                }

                $arr = explode(',', $arr);

                foreach($query as $key => $value){
                    $is_selected = false;
                    $is_selected = in_array($value[field_uid], $arr);
                    // if(!$is_selected) continue;
                    $res_arr[] = [
                        key_id => $value[field_uid],
                        key_color_code => $value[field_color_code],
                        key_short_name => $value[field_short_name],
                        key_full_name => $value[field_full_name],
                        key_isSelected => $is_selected
                    ];
                }
                return $res_arr;

            }
        }

        public function setVideoCallPrice($userid, $price){
            $data = [
                field_video_price => $price
            ];
            $this->db->where(field_uid, $userid);
            $this->db->update(table_doctor, $data);
            $affected_rows = $this->db->affected_rows();
            return $affected_rows === 1;
        }

        public function getPrice($userid, $purpose){
            if($purpose == purpose_video_calling){
                $this->db->select(field_video_price);
                $this->db->where(field_uid, $userid);
                $query = $this->db->get(table_doctor);
                $query = $query->result_array();
                return $query[0][field_video_price];
            }
        }

        private function getCountAvailability($userid, $tableName){
            $count = 0;
            $this->db->where(field_doctor_id, $userid);
            $count = $this->db->count_all($tableName);
            return $count;
        }

        public function getavailableTimings($userid, $purpose, $clinic_id){
            $res_arr = [];
            if($clinic_id == null){
                //for video or voice call purpose                
                
                if($purpose == purpose_video_calling || $purpose == purpose_voice_calling){
                    $purpose_category = ($purpose == purpose_video_calling)?appointment_category_video:appointment_category_voice;

                    if($this->getCountAvailability($userid, table_normal_availabilities) > 0){
                        $this->db->select(table_normal_availabilities.".". field_uid .",".table_normal_availabilities.".". field_week_days_uids .",". table_normal_availabilities.".".field_time_slots);
                        $this->db->from(table_doctor);
                        $this->db->join(table_normal_availabilities, table_doctor.'.'.field_uid.'='.table_normal_availabilities.'.'.field_doctor_uid);
                        $this->db->where(table_doctor.".".field_uid ."='". $userid."'");
                        $this->db->where(table_normal_availabilities.'.'.field_category_uid.'="'.$purpose_category.'"');
                        $query = $this->db->get();
                        $query = $query->result_array();
                        
                        foreach($query as $key => $val){
                            
                            $day_arr = explode(",",$val[field_week_days_uids]);

                            $day = "";
                            if(count($day_arr) > 1){
                                //if more than one days
                                foreach($day_arr as $k=>$v){
                                    $current_day = $v;
                                    $current_day = str_replace("day_", "", $current_day);
                                    $day .= ucfirst($current_day);

                                    if ($k != array_key_last($day_arr)) {
                                        $day .= ",";
                                    }                              
                                }
                                
                            }else{
                                $day = implode(",", $day_arr);
                                $day = ucfirst(str_replace("day_", "", $day));
                            }

                            $time_arr = explode(",",$val[field_time_slots]);
                            $start_time = "";
                            $end_time = "";
                            $full_time = "";
                            if(count($time_arr) > 1){
                                //more than one time slots
                                //print_r($time_arr);
                                foreach($time_arr as $k => $v){
                                    //print_r($v);
                                    $time_arr = $v;
                                    $time_arr = explode("-", $time_arr);
                                    $start_time =date('g:iA', strtotime($time_arr[0]));
                                    $end_time =date('g:iA', strtotime($time_arr[1]));
                                    $full_time .= $start_time ."-". $end_time;
                                    if ($k != array_key_last($time_arr)) {
                                        $full_time .= ",";
                                    }
                                }
                            }else{
                                //only have one time slot
                                $time_arr = $time_arr[0];
                                $time_arr = explode("-", $time_arr);
                                $start_time =date('g:iA', strtotime($time_arr[0]));
                                $end_time =date('g:iA', strtotime($time_arr[1]));
                                $full_time = $start_time ."-". $end_time;
                                //var_dump($time_arr);
                                //$time_arr = implode("-",$time_arr);

                            }
                            
                            $arr = [
                                key_id => $val[field_uid],
                                key_category => val_video,
                                key_day_range => $day,
                                key_time_range => $full_time,
                                key_indicator => 0 
                            ];

                            array_push($res_arr, $arr);
                        }                        
                    }                    
                }else if($purpose == purpose_voice_calling){

                }
            }else{

            }
            return $res_arr; 
        }

        public function setBankingDetails($userid, $upi_id="", $has_cancelled_cheque=false, $accountHolder="", $accountNumber="", $ifscCode="", $bankName="", $cancelled_cheque_path=""){
            if($has_cancelled_cheque){
                //insert file and bank details
                $data = [
                    key_uid => $this->random_six_digit_uid_generator(),
                    key_doctor_uid => $userid,
                    key_account_holder => $accountHolder,
                    key_account_number => $accountNumber,
                    key_ifsc_code => $ifscCode,
                    key_bank_name => $bankName,
                    key_cancelled_cheque_image_path => $cancelled_cheque_path
                ];
                $this->db->insert(table_bank_details, $data);
                return ($this->db->affected_rows() == 1)?true:false;    
            }else{
                //insert only upi id
                $data = [
                    'uid' => $this->random_six_digit_uid_generator(),
                    'doctor_id' => $userid,
                    'upi_id' => $upi_id
                ];
                $this->db->insert(table_bank_details, $data);
                return ($this->db->affected_rows() == 1)?true:false;              
            }
        }

        public function getFees($userid, $availability_id, $purpose = null){
            if($purpose == voice)
                $this->db->select(table_doctor . '.'. field_voice_price);
            else if($purpose == video)
                $this->db->select(table_doctor . '.'. field_video_price);
            $this->db->where(field_uid, $userid);
            $query = $this->db->get(table_doctor);
            $query = $query->result_array();
            if($purpose == voice) return $query[0]['voice_price'];
            else if($purpose == video) return $query[0]['video_price'];
            
        }

        private function day_arrangements($field_week_days_uids){
            $day_arr = explode(",",$field_week_days_uids);

            $day = "";
            if(count($day_arr) > 1){
                //if more than one days
                foreach($day_arr as $k=>$v){
                    $current_day = $v;
                    $current_day = str_replace("day_", "", $current_day);
                    $day .= ucfirst($current_day);

                    if ($k != array_key_last($day_arr)) {
                        $day .= ",";
                    }                              
                }
                
            }else{
                $day = implode(",", $day_arr);
                $day = ucfirst(str_replace("day_", "", $day));
            }
            return $day;
        }

        private function getNormalTimingsData($userid, $availability_id){
            $this->db->select(table_normal_availabilities.".". field_uid .",".table_normal_availabilities.".". field_week_days_uids .",". table_normal_availabilities.".".field_time_slots );
            $this->db->where(table_normal_availabilities.".".field_doctor_uid ."='". $userid."'");
            $this->db->where(table_normal_availabilities.'.'.field_category_uid.'="'.$availability_id.'"');
            $this->db->where(table_normal_availabilities.'.'.field_status.'=""');
            $this->db->from(table_normal_availabilities);
            $query = $this->db->get();
            $query = $query->result_array();

            
            $modified_data = [];

            if(!empty($query)){
                foreach($query as $key => $val){
                    $modified_data[] = [
                        key_id => $val[field_uid],
                        key_category => text_normal,
                        key_day_range => $this->day_arrangements($val[field_week_days_uids]),
                        key_time_range => $val[field_time_slots],
                        key_indicator => color_code_normal,
                    ];
                }
            }
            return $modified_data;
        }

        private function getSpecialTimingsData($userid, $availability_id){
            $this->db->select(table_special_availabilities.".". field_uid .",".table_special_availabilities.".". field_week_days_uids .",". table_special_availabilities.".".field_time_slots );
            $this->db->where(table_special_availabilities.".".field_doctor_uid ."='". $userid."'");
            $this->db->where(table_special_availabilities.'.'.field_category_uid.'="'.$availability_id.'"');
            $this->db->where(table_special_availabilities.'.'.field_status.'=""');
            $this->db->from(table_special_availabilities);
            $query = $this->db->get();
            $query = $query->result_array();
            // echo $this->db->last_query();
            $modified_data = [];

            if(!empty($query)){
                foreach($query as $key => $val){
                    $modified_data[] = [
                        key_id => $val[field_uid],
                        key_category => text_special,
                        key_day_range => $this->day_arrangements($val[field_week_days_uids]),
                        key_time_range => $val[field_time_slots],
                        key_indicator => color_code_special,
                    ];
                }
            }
            return $modified_data;
        }

        private function getHolidayTimingsData($userid, $availability_id){
            $this->db->select(table_holidays.".". field_uid .",".table_holidays.".". field_week_days_uids .",". table_holidays.".".field_time_slots );
            $this->db->where(table_holidays.".".field_doctor_uid ."='". $userid."'");
            $this->db->where(table_holidays.'.'.field_category_uid.'="'.$availability_id.'"');
            $this->db->where(table_holidays.'.'.field_status.'=""');
            $this->db->from(table_holidays);
            $query = $this->db->get();
             $query = $query->result_array();

            $modified_data = [];

            if(!empty($query)){
                foreach($query as $key => $val){
                    $modified_data[] = [
                        key_id => $val[field_uid],
                        key_category => text_holiday,
                        key_day_range => $this->day_arrangements($val[field_week_days_uids]),
                        key_time_range => $val[field_time_slots],
                        key_indicator => color_code_holiday,
                    ];
                }
            }
            return $modified_data;
        }

        public function getAvailabilityData($userid, $availability_id){
            
            $normal_data = [];

            $normal_data = $this->getNormalTimingsData($userid, $availability_id);
            $special_data = $this->getSpecialTimingsData($userid, $availability_id);
            $holiday_data = $this->getHolidayTimingsData($userid, $availability_id);
             
            if(!empty($normal_data)){
                // array_push($final_array, $normal_data);
            }
            if(!empty($special_data)){
                foreach($special_data as $key => $val){

                    array_push($normal_data, $val);
                }
            }
            if(!empty($holiday_data)){
                foreach($holiday_data as $key => $val){
                    array_push($normal_data, $val);
                }
            }
            return $normal_data;
        }

        public function UpdateFees($userid, $fees, $what_for){

            if($what_for == voice){
                //update voice price
                $this->db->where(field_uid, $userid);
                $this->db->update(table_doctor, [field_voice_price => $fees]);
            }else if($what_for == video){
                //update video price
                $this->db->where(field_uid, $userid);
                $this->db->update(table_doctor, [field_video_price => $fees]);
            }
            return ($this->db->affected_rows() == 1)?true:false;
        }

        public function DeleteVoiceOrVideoAvailibility($userid, $target_id, $category){
            $table = "";
            if($category == text_normal)
                $table = table_normal_availabilities;
            else if($category == text_special)
                $table = table_special_availabilities;
            else if($category == text_holiday)
                $table = table_holidays;
            if($table != ""){
                //update voice price
                $this->db->where(field_doctor_uid, $userid);
                $this->db->where(field_uid, $target_id);
                $this->db->update($table, [field_status => status_deactive]);
            }
            return ($this->db->affected_rows() == 1)?true:false;
        }

    }
?>