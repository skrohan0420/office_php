<?php 
defined('BASEPATH') or exit('nothing found');

class Admin_model extends CI_Model {

    public function __construct(){
        parent::__construct();
        date_default_timezone_set('Asia/Kolkata');  
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

                        // ->select('*');
                        // ->from('articles');
                        // ->join('category', 'category.id = articles.id');
                        // ->join('comments', 'comments.id = articles.id');

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

    public function new_users(){
        $new_users = $this->db
                            ->order_by('created_at', 'DESC')
                            ->select('name, email, phone_number, tracking_for_id, uid as id, created_at')
                            ->where("created_at >= DATE(NOW()) - INTERVAL 7 DAY")
                            ->from(table_user)
                            ->get();

        $new_users = $new_users->result_array();

        foreach($new_users as $key => $val){
            $id = $val['id'];
            $total_devices = $this->db
                                    ->select('*')
                                    ->where('user_id', $id)
                                    ->get(table_smart_card);
                                    
            $total_devices = $total_devices->num_rows();                    
            $new_users[$key]['total_devices'] =  $total_devices;
            


            $tracking_for_id = $val['tracking_for_id'];
            $tracking_for = $this->db
                                    ->select('tracking_for')
                                    ->where('uid', $tracking_for_id)
                                    ->get(table_tracking_for);

            $tracking_for = $tracking_for->result_array();
            echo '<pre>';
            print_r($tracking_for);
            // $tracking_for = $tracking_for[0]['tracking_for'];

            // $new_users[$key]['tracking_for'] = $tracking_for;



        }

       
        echo '<pre>';
        return $new_users;
    }




}
?>