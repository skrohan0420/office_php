<?php 
defined('BASEPATH') or exit('nothing found');

class Admin_model extends CI_Model {

    public function __construct(){
        parent::__construct();
        date_default_timezone_set('Asia/Kolkata');  
    }

    public function print($data){
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        die();
    } 

    public function isAdmin($email, $password){

        $isAdmin = $this->db
                        ->select('*')
                        ->where(field_email,$email)
                        ->where(field_password,$password )
                        ->get(table_admin);
        $isAdmin = $isAdmin->num_rows();
        
        if($isAdmin > 0){
            return true;
        }
        return false;
    }

    public function adminData($email, $password){
        $adminData = $this->db
                            ->select('*')
                            ->where(field_email,$email)
                            ->where(field_password,$password )
                            ->get(table_admin);
        $adminData = $adminData->result_array();
        
        return $adminData[0];
    }

    public function total_income(){
        $total = $this->db
                        ->select('packages.price')
                        ->from('packages')
                        ->join('subscriptions', 'subscriptions.package_id = packages.uid')
                        ->get();

        $total = $total->result_array();
        return $total;
    }

    public function total_user(){
        $total = $this->db
                        ->select('*')
                        ->from(table_user)
                        ->get();

        $total = $total->num_rows();
        return $total;
    }

    public function total_subscriptions(){
        $total = $this->db
                        ->select('*')
                        ->from(table_subscriptions)
                        ->get();

        $total = $total->num_rows();
        return $total;                
    }

    public function total_kids(){
        $total = $this->db
                        ->select('*')
                        ->from(table_smart_card)
                        ->get();

        $total = $total->num_rows();
        return $total;                
    }
    
    private function user_list($users){
        foreach($users as $key => $val){
            $id = $val[key_id];
            $total_devices = $this->db
                                    ->select('*')
                                    ->where(field_user_id, $id)
                                    ->get(table_smart_card);
                                    
            $total_devices = $total_devices->num_rows();                    
            $users[$key][key_total_devices] =  $total_devices;
            


            $tracking_for_id = $val[key_tracking_for_id];
            $tracking_for = $this->db
                                    ->select(field_tracking_for)
                                    ->where(field_uid, $tracking_for_id)
                                    ->get(table_tracking_for);

            $tracking_for = $tracking_for->result_array();
            if(empty($users[$key][key_email])){
                $users[$key][key_email] = '-';
            }
            if(!empty($tracking_for)){
                $users[$key][key_tracking_for] = $tracking_for[0][key_tracking_for];             
            }else{
                $users[$key][key_tracking_for] = '-';
            }
            
            unset($users[$key][key_id]);
            unset($users[$key][key_created_at]);
            unset($users[$key][key_tracking_for_id]);
        }
        // $this->print($users);
        return $users;

    }

    public function new_users(){
        $new_users = $this->db
                            ->order_by(field_created_at, 'DESC')
                            ->select('name, email, phone_number, tracking_for_id, uid as id, created_at')
                            ->where("created_at >= DATE(NOW()) - INTERVAL 7 DAY")
                            ->from(table_user)
                            ->get();

        $new_users = $new_users->result_array();

        $new_users = $this->user_list($new_users);
        
        return $new_users;
    }

    public function all_devices(){

        $owner_dtls = $this->db
                            ->select('user.name, user.email')
                            ->from(table_user)
                            ->join(table_smart_card, 'smart_card.user_id = user.uid')
                            ->get();
        $owner_dtls = $owner_dtls->result_array();

        $device_dtls = $this->db
                            ->select('card_number, created_at, device_id')
                            ->from(table_smart_card)
                            ->get();
        $device_dtls  = $device_dtls->result_array();
           
        
        $details = [];
        foreach($owner_dtls as $key => $val){
            if(empty($owner_dtls[$key][key_email])){
                $owner_dtls[$key][key_email] = '-';
            }
            $details[$key] = array_merge($owner_dtls[$key], $device_dtls[$key]);
        }


        return $details;
    }

    public function all_users(){
        $all_users = $this->db
                        ->select('name, email, phone_number, tracking_for_id, uid as id, created_at')
                        ->from(table_user)
                        ->get();
        
        $all_users = $all_users->result_array();

        $all_users = $this->user_list($all_users);
        // $this->print($all_users);
        return $all_users;
    }

    public function subscriptions(){
        $subscriptions = [];
        $sub_dtls = $this->db
                        ->select('package_id,smart_card_id,expiry_date,created_at,status')
                        ->from('subscriptions')
                        ->get();

        $sub_dtls = $sub_dtls->result_array();
        // foreach($sub_dtls as $key => $val){
        //     $pkg_dtls = $this->db
        //                     ->select('price')
        //                     ->from('packages')
        //                     ->where('')
        //                     ->get()
        // }
        $this->print($sub_dtls);


    }


}
?>