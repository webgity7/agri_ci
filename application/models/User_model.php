<?php
class User_model extends CI_Model {

    public function user_exist($username){
        $result=$this->db->select()->from('admin')->where('user_name',$username)->get()->row_array();
        return $result;
    }


}
