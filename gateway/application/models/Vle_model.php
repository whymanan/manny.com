<?php
class Vle_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }
    public function update_vle_status($data){
        $this->db->where(['member_id'=>$this->session->userdata('member_id')])
        ->update('user',$data);
        return true;
    }
}
?>