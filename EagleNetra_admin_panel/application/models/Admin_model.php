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
        $pkg_price = $this->db
                        ->select(field_price)
                        ->from(table_packages)
                        ->join(table_subscriptions, 'subscriptions.package_id = packages.uid')
                        ->get();
        $device_id = $this->db
                        ->select(field_device_id)
                        ->from(table_smart_card)
                        ->join(table_subscriptions, 'subscriptions.smart_card_id = smart_card.uid')
                        ->get();
        $device_id = $device_id->result_array();    
        $pkg_price = $pkg_price->result_array();
        foreach($device_id as $key => $val){
            $q = $this->db
                    ->select(field_user_id)
                    ->from(table_smart_card)
                    ->where(field_device_id,$device_id[$key][key_device_id])
                    ->get();
            $q = $q->result_array();  
            $user_id[] = $q[0][key_user_id]; 
        }
        if(!empty($user_id)){
            foreach($user_id as $key => $val){
                $q = $this->db
                            ->select('name, phone_number, email')
                            ->where('uid',$user_id[$key])
                            ->from('user')
                            ->get();
                $q = $q->result_array();
                $user_dtls[] = $q[0];
            }
            $sub_dtls = $this->db
                            ->select('created_at , expiry_date , status')
                            ->from('subscriptions')
                            ->get();
            $sub_dtls = $sub_dtls->result_array();
            foreach($sub_dtls as $key => $val){
                $sub_dtls[$key]['name'] = $user_dtls[$key]['name'];
                $sub_dtls[$key]['phone_number'] = $user_dtls[$key]['phone_number'];
                $sub_dtls[$key]['email'] = $user_dtls[$key]['email'];
                $sub_dtls[$key]['price'] = $pkg_price[$key]['price'];
                $sub_dtls[$key]['device_id'] = $device_id[$key]['device_id'];
            }
            return $sub_dtls;
        }
        return false;
        
        // $this->print($sub_dtls);
        // $this->print($user_dtls);
        // $this->print($user_id);
        // $this->print($pkg_price);
        // $this->print($device_id);
       
    }  

    public function all_kids(){
        $kids_dtls = $this->db
                            ->select('
                                smart_card.uid,
                                smart_card.device_id,
                                smart_card.name as kid,
                                smart_card.card_number,
                                smart_card.class,
                                smart_card.age,
                                smart_card.profile_image,
                                user.name as parent
                            ')
                            ->from('smart_card')
                            ->join('user', 'smart_card.user_id = user.uid')
                            ->get();
        $kids_dtls = $kids_dtls->result_array();


        foreach($kids_dtls as $key=>$val){
            $em_nums = $this->db
                            ->select('emergency_contact')
                            ->from('emergency_numbers')
                            ->where('smart_card_id',$val['uid'])
                            ->get();
            $em_nums = $em_nums->result_array();


           
            foreach($em_nums as $keys => $vals){
                $kids_dtls[$keys]['emergency_contact']  = $em_nums;
            }
            
            
        }

        // $this->print($kids_dtls);
        // die();
        return $kids_dtls;
    }

}
?>