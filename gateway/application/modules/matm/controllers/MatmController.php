<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use GuzzleHttp\Client;

class MatmController extends Vite {


  public $data = array();

  public $client;


  public function __construct() {
      parent::__construct();
      $this->tnxType = 'matmTxn' ;
      $this->data['serid'] = 8;
      $this->data['api_key'] = 'MAN001;
      $this->data['active'] = 'MATM';
      $this->load->model('common_model');
      $this->load->model('users_model');
      $this->load->model('commission_model');
      $this->data['breadcrumbs'] = [array('url' => base_url('dashboard'), 'name' => 'MATM')];
      $this->data['bal'] = $this->common_model->wallet_balance($this->session->userdata('user_id'));
  }


  public function history() {
      
    $this->data['breadcrumbs'] = [array('url' => base_url('aeps'), 'name' => 'MATM'), array('url' => base_url('thistory'), 'name' => 'Transection History')];
    $this->data['param'] = $this->paremlink('/');
    $this->data['main_content'] = $this->load->view('list', $this->data, true);
    $this->data['is_script'] = $this->load->view('script', $this->data, true);
    $this->load->view('layout/index', $this->data);
    
  }

    public function commission() {
      
    $this->data['param'] = $this->paremlink('/');
    $this->data['main_content'] = $this->load->view('commission/index', $this->data, true);
    $this->data['is_script'] = $this->load->view('commission/script', $this->data, true);
    $this->load->view('layout/index', $this->data);
    
  }

    public function addCommissionForm() {

        if ($_POST) {
    
            $data = $this->security->xss_clean($_POST);
    
              if (isset($data['aepsCommissionForm'])) {
        
                $baseRole = $data['aepsCommissionForm'];
        
                $service = 1;
        
                $this->data['role_id'] = $baseRole;               
              //  $commissionList = $this->common_model->get_list($service, $baseRole);
        
        
                echo $this->load->view('commission/add', $this->data, true);
        
              } else {
                echo json_encode(['error' => 1, 'msg' => 'requeste not allowed']);
              }
    
        }

    }
    
    public function loadForm() {

        echo $this->load->view('commission/add', $this->data, true);

    }
  
    public function insert(){
      
        if ($_POST) {
       
               $data = $this->security->xss_clean($_POST);
               $data1['start_range'] = $data['start'];
               $data1['end_range'] = $data['end'];
               $data1['role_id'] = $data['role_id'];
               $data1['g_commission'] = $data['commision'];
               $data1['service_id'] = $this->data['serid'];
               $data1['c_flat	'] = isset($data['flat'])?1:0;
               $data1['created	'] = date("Y-m-d h:i:sa");
           
              if ($this->common_model->insert($data1,'service_commission')) {
               $this->session->set_flashdata(
                      array(
                        'status' => 1,
                        'msg' => " Insert Successfully"
                      )
                    );
                    redirect('aeps2/commission', 'refresh');
                }
        }
        
    }
  
    public function getcommission_list(){

        $uri = $this->security->xss_clean($_GET);
        
        $role_id = $uri['id'];
    
        if (!empty($uri)) {
        
            $query = '';

            $output = array();
          
            $data = array();

            if (isAdmin($this->session->userdata('user_roles'))) {
                
              $query .= "SELECT * from service_commission  where role_id = '$role_id'  AND service_id = {$this->data['serid']} ";
    
              $recordsFiltered = $this->users_model->row_count($query);

            }else{
                    
              $query .= "SELECT * from service_commission where role_id = '$role_id'  AND service_id = {$this->data['serid']} ";
    
              $recordsFiltered = $this->users_model->row_count($query);
    
            }

              if (!empty($_GET["search"]["value"])) {
                $query .= 'AND start_range LIKE "%' . $_GET["search"]["value"] . '%" ' ;
                // $query .= 'OR end_range "%' . $_GET["search"]["value"] . '%" ';
                
              }

              if (!empty($_GET["order"])) {
                $query .= 'ORDER BY ' . $_GET['order']['0']['column'] . ' ' . $_GET['order']['0']['dir'] . ' ';
              }
              $sql = $this->db->query($query);
              $filtered_rows = $sql->num_rows();
              if ($_GET["length"] != -1) {
                $query .= 'LIMIT ' . $_GET['start'] . ', ' . $_GET['length'];
              }
              $sql = $this->db->query($query);
              $result = $sql->result_array();

            $i = 1;
            foreach ($result as $row) {
              
                $sub_array = array();
           
    
                $sub_array[] = '<button type="button" class="btn btn-sm btn-info"  data-placement="bottom" onclick="Edit(' . $row['service_commission_id'] . ')" title="Edit Commission Information"><i class="fa fa-pencil-alt"></i></button>
               <button type="button" class="btn btn-sm btn-primary"  data-placement="bottom" onclick="Delete(' . $row['service_commission_id'] . ')" title="Delete Commission Information"><i class="fa fa-trash-alt"></i></button>';
           
                $sub_array[] = $row['start_range'];
                $sub_array[] = $row['end_range'];
                $sub_array[] = $row['g_commission'];
                $sub_array[] = $row['c_flat'];
    
                $data[] = $sub_array;
                $i++;
    
            }

              $output["draw"] = intval($_GET["draw"]);
              $output["recordsTotal"] = $filtered_rows;
              $output["recordsFiltered"] = $filtered_rows;
              $output["data"] = $data;

            echo json_encode($output);
        
        }
    
    }

    public function stan( ) {
     
        date_default_timezone_set("Asia/Calcutta");
        $today = date("H");
        $year = date("Y"); 
        $year =  $year;
        $year = substr( $year, -1);   
        $daycount =  date("z")+1;
        $ref = $year . $daycount. $today. mt_rand(100000, 999999);
        return $ref;
        // return mt_rand(99999999999, 999999999999);
    }

    public function utan( $node ) {

    // return $node . '00' . round(microtime(true));
    return mt_rand(100000, 999999);

    }
    
    public function get_transectionlist() {
        
  		$uri = $this->security->xss_clean($_GET);

  		if (isset($uri['key']) && !empty($uri['key'])) {

  			$query = '';
  			
  			$output = array();
  			
  			$duid = $uri['key'];
  			
  			$list = $uri['list'];
  			
  			$data = array();
  			
            if (isAdmin($this->session->userdata('user_roles'))) {
                    
              $query = "select * from submit_transection where service_id = {$this->data['serid']} ";
    
              $recordsFiltered = $this->users_model->row_count($query);
    
            }else{
              
              $member_id=$this->session->userdata('member_id');
              
              $query .= "SELECT * FROM submit_transection WHERE service_id = {$this->data['serid']} AND member_id='$member_id'";
    
              $recordsFiltered = $this->users_model->row_count($query);
    
            }

    	    if (!empty($_GET["search"]["value"])) {
                $query .= ' AND submit_transection.reference_number LIKE "%' . $_GET["search"]["value"] . '%" ';
                $query .= ' OR submit_transection.transection_mobile LIKE "%' . $_GET["search"]["value"] . '%" ';
           
    	    }

  			if(!empty($_GET["order"])){
  				$query .= 'ORDER BY '.$_GET['order']['0']['column'].' '.$_GET['order']['0']['dir'].' ';
  			}

  			else{
  				$query .= 'ORDER BY submit_transection.primary_id DESC ';
  			}

  			if($_GET["length"] != -1){
  				$query .= 'LIMIT ' . $_GET['start'] . ', ' . $_GET['length'];
  			}

  			$sql = $this->db->query($query);
  			$result = $sql->result_array();
  			

                $i = 1;

                foreach ($result as $row) {
                 if(!empty($row['transection_response']))
                {
                 $adhar=json_decode($row['transection_response']);
          		  if(!empty($adhar->last_aadhar))
                 {
          		 $adharstring="XXXXXXXX".$adhar->last_aadhar;
                 }
                 else
                 {
                     $adharstring="XXXXXXXXXXXX"; 
                 }
                }
                else
                {
                    $adharstring="XXXXXXXXXXXX";
                }
                $sub_array = array();
                
                //   $sub_array[] = '<a href="' . base_url('aeps2/print/') . $row['reference_number'] . '"> <button type="button" class="btn btn-sm btn-secondary"  data-placement="bottom" title="Edit Menu Information"><i class="fa fa-print"></i></button></a>';
        
                //   $sub_array = array();
                
                    if($row['transection_type'] == 'CW' && $row['transection_status'] == 0 && $row['transection_respcode'] == 0)
                      $sub_array[] = '<a href="' . base_url('aeps2/print/') . $row['reference_number'] . '"> <button type="button" class="btn btn-sm btn-secondary"  data-placement="bottom" title="Edit Menu Information"><i class="fa fa-print"></i></button></a>
                                               <button type="button" class="btn btn-sm btn-secondary" onclick="transaction_updated(' . $row['reference_number'] . ')" ><i class="fa fa-refresh"></i></button>';
                    else
                        $sub_array[] = '<a href="' . base_url('aeps2/print/') . $row['reference_number'] . '"> <button type="button" class="btn btn-sm btn-secondary"  data-placement="bottom" title="Edit Menu Information"><i class="fa fa-print"></i></button></a>';
        
                  $sub_array[] = $row['member_id'];
        
                  $sub_array[] = $row['reference_number'];
        
                  $sub_array[] = $row['transection_msg'];
        
                  $sub_array[] = $row['transection_mobile'];
        
                  $sub_array[] = $row['transection_amount'];
                  
                //   $sub_array[] = $row['transection_bank_code'];
        
                  $sub_array[] = $this->common_model->select_option($row['transection_bank_code'], 'iinno', 'bank_list')[0]['bankName'];
                  
                  $sub_array[] = $adharstring;
                  
                  $sub_array[] = $row['transection_id'];
        
                  $sub_array[] = $row['created'];
        
        
        
        
        
        
                  $data[] = $sub_array;
        
                  $i++;
        
                }
                
  			$output["draw"] = intval($_GET["draw"]);

            $output["recordsFiltered" ] =$recordsFiltered;	

  			$output["recordsTotal"] =$recordsFiltered;

  			$output["data"] = $data;
  			
  			echo json_encode($output);

  		}

  	}
  	
  	public function edit($id){
  	    
        $menu= $this->common_model->select_option($id, 'service_commission_id', 'service_commission');
        echo json_encode($menu[0]);
        
    }
    
    public function delete($id){
        if ($this->db->where("service_commission_id", $id)->delete('service_commission')) {
           echo 1;
        } else {
          echo 0;
        }
    }
  
    public function addupdate() {

        if ($_POST) {
    
          $data = $this->security->xss_clean($_POST);
    
          if (isset($data['addupdate'])) {
    
            $baseRole = $data['addupdate'];
    
            $service = $this->data['serid'];
    
            $commissionList = $this->commission_model->get_list($service, $baseRole);
    
    
            echo $this->load->view('commission/edit', $this->data, true);
    
          } else {
            echo json_encode(['error' => 1, 'msg' => 'requeste not allowed']);
          }
    
        }
    
    }
  
    public function update(){
      
        $data=array();
        $form = $this->security->xss_clean($_POST);
    
        $logme['start_range'] = $form['start'];
        $logme['end_range'] = $form['end'];
        $logme['g_commission'] = $form['commision'];
        $field = $form['service_commission_id']; 
     
        $logme['c_flat'] = isset($form['flat'])?1:0;
        $logme['role_id'] = $form['role_id'];
        $logme['service_id'] = $this->data['serid'];
        
        if ($this->common_model->update($logme, "service_commission_id", $field , 'service_commission')) {
            $this->session->set_flashdata(
              array(
                'status' => 1,
                'msg' => " Updated Successfully"
              )
            );
            redirect('aeps2/commission', 'refresh');
        }
    }
 
    private function commition_distribute($id,  $transection ) {


    $parentsList = self::checkparent($id);
    $i = 0;    
      foreach ($parentsList as $key => $value) {
    
        $commision = $this->commission_model->get_commision_by_role($value['role_id'], $this->data['serid'], $transection);
        
        if (!empty($commision)) {
            
              $userWallet = $this->common_model->get_user_wallet_balance($value['user_id']);
      
          if ($userWallet != 'none') {
                
                if($commision->c_flat == 0){
                    if($value['user_id'] == $id){
                        $nonflate = $transection * $commision->g_commission / 100;
                        
                        $updateBalance = $userWallet->balance + $nonflate + $transection;
                    }else{
                        
                        $nonflate = $transection * $commision->g_commission / 100;
                        
                        $updateBalance = $userWallet->balance + $nonflate;
                        
                    }
                
                }else{
                    
                    if($value['user_id'] == $id){
                        
                        $nonflate = $commision->g_commission;
                        $updateBalance = $userWallet->balance + $nonflate + $transection;
                    
                        
                    }else{
                        
                        $nonflate = $commision->g_commission;
                        $updateBalance = $userWallet->balance + $nonflate;
                        
                    }
                }
                
                if($value['user_id'] == $id){
                    
                    $createdbalance = $nonflate + $transection;
                
                }else{
                
                    $createdbalance = $nonflate;
                    
                }
                
            $updateWallet = [
              'balance' => $updateBalance,
            ];
                
                $logme = [
                  'wallet_id' => $userWallet->wallet_id,
                  'member_to' =>  $value['user_id'],
                  'member_from' =>  $value['user_id'],
                  'amount' =>  $transection,
                  'refrence' =>  "AEPSCASH_".self::walletrrn(),
                  'commission' =>  $nonflate,
                  'balance' => $userWallet->balance,
                  'closebalance' => $updateBalance,
                  'service_id' => $this->data['serid'],
                  'status' => 'success',
                  'stock_type'=> $this->tnxType,
                  'status' => 'success',
                  'type' => 'credit',
                  'mode' => 'Aeps Cash',
                  'bank' => 'Aeps',
                  'narration' => 'Aeps Commission Credit',
                  'date'=> date("Y-m-d h:i:sa"),
                
                ];
                
              
            
            if($id= $this->common_model->insert($logme, 'wallet_transaction')) {
                
              $message = [
                'msg' => 'Your wallet balance credited ' . $createdbalance . ' available balance is ' . $updateBalance,
                'user_id' => $value['user_id']
              ];
              $this->set_notification($message);

                $this->common_model->update($updateWallet, 'member_id', $value['user_id'], 'wallet');              
              
            }

          }else{
            $message = [
              'msg' => 'User Wallet not Found',
              'user_id' => $value['user_id']
            ];
            $this->set_notification($message);
          }
        }else{
          $message = [
            'msg' => 'Commission Not Found',
            'user_id' => $value['user_id']
          ];
          $this->set_notification($message);
        }
      }
  }
  
    private function checkparent($id, &$parents = array(), $level = 1) {
        $data = $this->users_model->get_parent_aeps($id);
 
      if (isset($data)) {
        $parents[$level]['user_id'] = $data->user_id;
        $parents[$level]['member_id'] = $data->member_id;
        $parents[$level]['parent'] = $data->parent;
        $parents[$level]['role_id'] = $data->role_id;
   
       $ak = self::checkparent($data->parent, $parents, $level+1);
      }
      return $parents;
     }
    
    private function walletrrn(){
        
        return mt_rand(999999, 9999999);
        
    }
    
    public function print($id){
        
        $query = "SELECT * FROM submit_transection WHERE reference_number = '{$id}'";
      
      	$sql = $this->db->query($query);
  			
  		$this->data['result'] = $sql->row();
  		
  		echo $this->load->view('print', $this->data, true);
  		
    }
    
}
