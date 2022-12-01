<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use GuzzleHttp\Client;
require APPPATH.'/libraries/REST_Controller.php';

class Bank extends REST_Controller {

     public function __construct() {
      parent::__construct();
    $this->load->model('common_model');
    $this->load->model('menu_model');
    $this->load->model('users_model');
    date_default_timezone_set("Asia/Kolkata");
    }
    private function _prepare_class_validation(){
        
            $this->load->library('form_validation');
			 
            $this->form_validation->set_rules('name', 'name', 'required');
            $this->form_validation->set_rules('phone', 'phone', 'required');
            $this->form_validation->set_rules('account_no', 'account_no', 'required');
            $this->form_validation->set_rules('ifsc', 'ifsc', 'required');
            $this->form_validation->set_rules('bank_name', 'bank_name', 'required');
            $this->form_validation->set_rules('member_id', 'member_id', 'required');
            $this->form_validation->set_rules('api_key', 'api_key', 'required');
			
    }
     private function _prepare_class_validation2(){
        
            $this->load->library('form_validation');
            $this->form_validation->set_rules('amount', 'amount', 'required');
            $this->form_validation->set_rules('member_id', 'member_id', 'required');
            $this->form_validation->set_rules('api_key', 'api_key', 'required');
			
    }
    
    //contact_create
    public function create_contact($name,$phone,$member_id) {
    $this->contact=[
           "name"=>$name,
           "contact"=>$phone,
           "type"=>'employee',
           "reference_id"=>"Widthdraw_".self::stan2(),
           "notes"=>[
            "random_key_1"=> $member_id,
           ]
          ];
    $data1=json_encode($this->contact);
    $curl = curl_init();
    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'https://api.razorpay.com/v1/contacts',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS =>$data1,
                         CURLOPT_HTTPHEADER => array(
                             'Content-Type: application/json',
                              'Authorization: Basic cnpwX2xpdmVfRnRBQnZqRmVSYk13VXk6c3p2eUFWWHIzMGc2dFBKaFZPaE53cjZT'
                              ),
     ));

 $response = curl_exec($curl);

 curl_close($curl);
 return $response;
}
    //found_acccount_create
    public function create_fund_account($fund_account) {
  $data=[
        "contact_id"=>$fund_account['contact_id'],
        "account_type"=> "bank_account",
        "bank_account"=> [
          "name"=> $fund_account['account_holder_name'],
          "ifsc"=> $fund_account['ifsc_code'],
          "account_number"=>$fund_account['account_no']
         ]
        ];
  $data1=json_encode($data);
  $curl = curl_init();
  curl_setopt_array($curl, array(
                      CURLOPT_URL => 'https://api.razorpay.com/v1/fund_accounts',
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => '',
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 0,
                      CURLOPT_FOLLOWLOCATION => true,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => 'POST',
                      CURLOPT_POSTFIELDS =>$data1,
                        CURLOPT_HTTPHEADER => array(
                            'Content-Type: application/json',
                            'Authorization: Basic cnpwX2xpdmVfRnRBQnZqRmVSYk13VXk6c3p2eUFWWHIzMGc2dFBKaFZPaE53cjZT'
                        ),
  ));

 $response = curl_exec($curl);

 curl_close($curl);
 return $response;
}
    
    //acccount_add
    public function add_post()
    {
     $data = $this->security->xss_clean($_POST);
     $this->_prepare_class_validation(); 
        
     if ($this->form_validation->run() === TRUE){ 
         if($this->common_model->member_id($data['api_key'])==1 && $this->common_model->member_id($data['member_id'])==1)
         {
             $user=$this->common_model->select_option($data['member_id'],'member_id','user');
             $user_id=$user[0]['user_id'];
             if ($data) {
                $contact_response=self::create_contact($data["name"],$data["phone"],$data['member_id']);
                $contact_response1=json_decode($contact_response);
                $fund_account=[
                        'account_holder_name' => $data["name"],
                        'account_no' => $data["account_no"],
                        'contact_id' => $contact_response1->id,
                        'ifsc_code' => $data["ifsc"],
                       ];
               $fund_account_response=self::create_fund_account($fund_account);
               $fund_account_response1=json_decode($fund_account_response);
               $logme = [

                   'account_holder_name' => $data["name"],

                   'account_no' => $data["account_no"],

                  'bank_name' => $data["bank_name"],

                   'phone_no' => $data["phone"],

                   'ifsc_code' => $data["ifsc"],

                  'fk_user_id' => $user_id,

                  'created_at' => date("Y-m-d h:i:sa"),

                  'contact_id'=>$fund_account_response1->contact_id,

                  'fund_account'=>$fund_account_response1->id,

                  'referanceid'=>$contact_response1->reference_id,
               
                  'varification'=>0,
                ];
             if(! $this->common_model->exists('user_bank_details',array("fk_user_id" => $user_id))) 
                $id = $this->common_model->insert($logme, 'user_bank_details');
             else
               $id = $this->common_model->update($logme,"fk_user_id", $user_id, 'user_bank_details');
             if ($id) {
                $message = [
                    'msg' => 'Your bank Details added Successfully ',
                    'member_id' => $data['member_id'],
                    'status'=>true,
                    'response_code'=>1
                     ];
                    echo json_encode($message);
                 } 

           }
         }
         else
         {
             $this->response(
                                            array(
                                            "status" => false,
                                            "msg" => "Access not authorize"
                            ), REST_Controller :: HTTP_NOT_FOUND); 
         }
     }
     else{
            
            $this->response(
                                            array(
                                            "status" => false,
                                            "msg" => "All field are needed"
                            ), REST_Controller :: HTTP_NOT_FOUND);            
                            
        }
        
    }
    
    
    //account_varify
    public function varify_post()
   {
       $data = $this->security->xss_clean($_POST);
      if(isset($data['api_key']) && !empty($data['api_key']) && isset($data['member_id']) && !empty($data['member_id'])){ 
          if($this->common_model->member_id($data['api_key'])==1 && $this->common_model->member_id($data['member_id'])==1)
           {
             $user=$this->common_model->select_option($data['member_id'],'member_id','user');
             $userid=$user[0]['user_id'];
             $this->db->select('*')->from('user_bank_details')->where('fk_user_id',$userid);
             $query = $this->db->get();
             $bank_details= $query->result_array();
             $this->db->select('*')->from('wallet')->where('member_id',$userid);
             $query = $this->db->get();
             $wallet= $query->result_array();
             if($wallet[0]['balance']>3.36){
           $this->data['varify']=[
             'accountNumber'=>$bank_details[0]['account_no'],
             'ifsc'=>$bank_details[0]['ifsc_code'],
             'bname'=>$bank_details[0]['account_holder_name'],
             'purpose'=>'Verification',
             'api_key'=>'MAN001'
            ];
    $response=self::varifyreturn();
    $response1=json_decode($response);
     if(isset($response1->status) && $response1->status==0 && !isset($response1->statusCode)){
        $this->db->select('*')->from('wallet')->where('member_id',$userid);
        $query = $this->db->get();
        $wallet= $query->result_array();
        $updateBalance=$wallet[0]['balance']-3.36;
        $updateWallet = [
          'balance' => $updateBalance,
        ];
    if($this->common_model->update($updateWallet, 'member_id',$userid, 'wallet')){
      if($response1->data->status=='Success'){
          $this->common_model->update(['varification'=>1,'account_holder_name'=>$response1->data->beneficiaryName],'fk_user_id', $userid, 'user_bank_details');
          $response=['response_code'=>1,'status'=>true,'msg'=>'Account varifeid'];
      }
       elseif($response1->data->status=='Failure' && isset($response1->data->error))
      {
          $response=['response_code'=>2,'status'=>true,'msg'=>$response1->data->error];
      }
       $log=[
         'wallet_id' => $wallet[0]['wallet_id'],
         'member_to' => $userid,
         'stock_type' => 'Main Bal',
         'status' => 'success',
         'balance' =>  $wallet[0]['balance'],
         'closebalance' => $updateBalance,
         'type' => 'debit',
         'mode' => 'Account Varification',
         'bank' =>  $bank_details[0]['bank_name'],
         'narration' => 'Account Varification',
         'trans_type'=>'deduct',
         'amount'=>3.36,
         'date' => date('Y-m-d'),
         ];
         $this->common_model->insert($log, 'wallet_transaction');
         echo json_encode($response);
      }
   }
     else{
       echo json_encode(['response_code'=>3,'status'=>true,'msg'=>$response1->msg]);
       }
 }
             else
             {

  $this->response(
                                            array(
                                            "status" => false,
                                            "response_code"=>2,
                                            "msg" => "Insufficience Balance"
                            ), REST_Controller :: HTTP_NOT_FOUND);
 
}  
            }
            else
            {
               $this->response(
                                            array(
                                            "status" => false,
                                            "msg" => "Access not authorize"
                            ), REST_Controller :: HTTP_NOT_FOUND); 
          }
      }
      else
      {
           $this->response(
                                            array(
                                            "status" => false,
                                            "msg" => "All field are needed"
                            ), REST_Controller :: HTTP_NOT_FOUND); 
      }
    }
    private function varifyreturn()
    {
      $this->client = new Client();

    //   print_r($this->data['varify']);
    //   exit();
    #guzzle
    try {
      $response = $this->client->request('POST', "https://vitefintech.com/viteapi/payu/accountVerify",[

        'decode_content' => false,
        'form_params' => $this->data['varify'],
      ]);
      return $response->getBody()->getContents();
    } catch (GuzzleHttp\Exception\BadResponseException $e) {
      #guzzle repose for future use
      $response = $e->getResponse();
      $responseBodyAsString = $response->getBody()->getContents();
      print_r($responseBodyAsString);
    }
 }
      
     //withdraw
      public function widthdraw_bal_post(){
          $data = $this->security->xss_clean($_POST);
          $this->_prepare_class_validation2(); 
          if ($this->form_validation->run() === TRUE){ 
            if($this->common_model->member_id($data['api_key'])==1 && $this->common_model->member_id($data['member_id'])==1){ 
               if ($_POST) {
                 $user=$this->common_model->select_option($data['member_id'],'member_id','user');
                 $userid=$user[0]['user_id'];
                 $this->db->select('*')->from('wallet')->where('member_id',$userid);
                 $query = $this->db->get();
                 $wallet= $query->result_array();
                  $charge=self::get_move_charge($data["amount"]);
                if($data["amount"]+$charge<$wallet[0]['balance']){
                    $userWallet = $this->common_model->bank_get($userid);
                   
                    $user_wallet=$wallet[0]['balance'] - (float)$data['amount'] - (float)$charge; 
                    $this->data['submitTransection'] = [
                                    "account_number"=>"4564568625148107",
                                    "fund_account_id"=>$userWallet->fund_account,
                                     "amount"=>$data["amount"]*100,
                                     "currency"=> "INR",
                                     "mode"=> "IMPS",
                                     "purpose"=> "refund",
                                     "queue_if_low_balance"=> false,
                                     "reference_id"=>"Widthdraw_".self::stan2(),
                                     "narration"=> "withdraw",
                                     "api_key"=>$data['api_key']                                             
                                     ];
                       $transaction1 = self::payout_service();
                       $transaction = json_decode($transaction1);
                       if($transaction->status == "processing"){
                        $this->common_model->update(array('balance' =>$user_wallet ), 'member_id',$userid, 'wallet');
                         $logme = [
                           
                        'member_to' => $userid,
                        'member_from' =>  1,
                        'amount' => $data["amount"],
                        'type'=> "debit",
                        'refrence' => $this->data['submitTransection']['reference_id'],
                        'trans_type' => "widthdraw",
                        'mode' => "Wallet Transfer",
                        'stock_type'=> "Main Bal",
                        'surcharge' => (float)$charge,
                        'balance' => $wallet[0]['balance'],
                        'closebalance' => $user_wallet,
                        'bank'=> $userWallet->bank_name,
                        'account_no' => $userWallet->account_no,
                        'narration'=> "Move To Bank Request",
                        'date'=> date("Y-m-d h:i:sa"),
                        'status' => 'accept',
                        'payout_response'=>$transaction1,
                       ];
                       $id= $this->common_model->insert($logme, 'wallet_transaction');
                       echo json_encode(['status'=>true,'response_code'=>1,'msg'=>'Successful']);                         
                       }
                       else
                       {
                         echo json_encode(['status'=>false,'response_code'=>0,'msg'=>'Failure']);
                       }
        
                }else{
                    $this->response(
                                            array(
                                            "status" => false,
                                            "response_code"=>2,
                                            "msg" => "Insufficience Balance"
                            ), REST_Controller :: HTTP_NOT_FOUND);
                }
            }
            }
            else
            {
            $this->response(
                                            array(
                                            "status" => false,
                                            "msg" => "Access not authorize"
                            ), REST_Controller :: HTTP_NOT_FOUND);   
          }
          }
          else
          {
               $this->response(
                                            array(
                                            "status" => false,
                                            "msg" => "All field are needed"
                            ), REST_Controller :: HTTP_NOT_FOUND); 
          }
    }
    
    //charge
    public function get_move_charge($amount) {
     
     $wallet_sevice_id = 40;
     $this->data['bal'] = $this->common_model->get_charge_by_move_bank($wallet_sevice_id,$amount);
     return $this->data['bal'];
  
   }
   //payout
    public function payout_service() {
         
      $this->client = new Client();
      
      $url = 'https://vitefintech.com/viteapi/razorpay';
      #guzzle
      try {
          $response = $this->client->request('POST', $url, [
                
                'form_params' => $this->data['submitTransection'],]);

          return $response->getBody()->getContents() ;
               

      } catch (GuzzleHttp\Exception\BadResponseException $e) {
        #guzzle repose for future use
        $response = $e->getResponse();
        $responseBodyAsString = $response->getBody()->getContents();
        print_r($responseBodyAsString);
      }
  }
     public function stan2( ) {
     
        date_default_timezone_set("Asia/Calcutta");
        $today = date("H");
        $year = date("Y"); 
        $year =  $year;
        $year = substr( $year, -1);   
        $daycount =  date("z")+1;
        $ref = $year . $daycount. $today. mt_rand(100000, 999999);
        return $ref;
    }
    public function banklist_post()
    {
      if(isset($_POST['api_key']) && !empty($_POST['api_key']) && isset($_POST['member_id']) && !empty($_POST['member_id']))
      {
          if($this->common_model->member_id($_POST['api_key'])==1 && $this->common_model->member_id($_POST['member_id'])==1){
               $user=$this->common_model->select_option($_POST['member_id'],'member_id','user');
               $userid=$user[0]['user_id'];
               $this->data['bank'] = $this->users_model->get_bank($userid);
               echo Json_encode(['response'=>1,'status'=>true,'data'=>$this->data['bank']]);
           }
           else
           {
               $this->response(
                                            array(
                                            "status" => false,
                                            "msg" => "Access not authorize"
                            ), REST_Controller :: HTTP_NOT_FOUND); 
               
           }
      }
      else
      {
            $this->response(
                                            array(
                                            "status" => false,
                                            "msg" => "All field are needed"
                            ), REST_Controller :: HTTP_NOT_FOUND); 
      }
    }
     public function generated_axis_account_post(){
        $data = $this->security->xss_clean($this->input->post());
        if(!empty($data['member_id']) && !empty($data['submerchant_id']))
        {
             if($this->common_model->member_id($data['member_id'])==1)
             {
                 if($this->common_model->member_id($data['submerchant_id'])==1)
                 {
                     $user=$this->common_model->select_option($data['submerchant_id'],'member_id','user');
                     $user_details=$this->common_model->select_option($user[0]['user_id'],'fk_user_id','user_detail');
                     $full_name=$user_details[0]['first_name']." ".$user_details[0]['last_name'];
                     $url = 'https://vitefintech.com/viteapi/api/account-opening';
                     $ch = curl_init();
                     curl_setopt($ch, CURLOPT_URL, $url);
                     curl_setopt($ch, CURLOPT_POST, 1);
                     curl_setopt(
                      $ch,
                    CURLOPT_POSTFIELDS,
                     http_build_query(
                    array(
                    'member_id' => $data['member_id'], // for member id, please contact to vitefintech.com.
                    'type' => 1, // 1 for saving account and 2 for current account
                    'retailer_id' => $data['submerchant_id'],
                     )
                    )
                    );
                     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                     $server_output = curl_exec($ch);
                     curl_close($ch);
                    // your modified code
       
                     $output = json_decode($server_output);
        
                     $this->data['output'] = $output;

                     $array_data = [
                        'member_id' => $data['submerchant_id'],
                        'user_name' => $full_name,
                        'user_roles' => $user[0]['role_id'],
                         'bank_url' => $output->data,
                           'type' => 1,
                        'created_at' => date('Y-m-d H:i:s')
                       ];
                     if($this->db->insert('bank_account_link_histroy',$array_data))
                     {
                         echo $server_output;
                     }
                 }
                 else
                 {
                     echo json_encode(['status'=>0,'response_code'=>11,'message'=>'Access denie for Submerchant']); 
                 }
             }
             else
             {
                echo json_encode(['status'=>0,'response_code'=>12,'message'=>'Access denie for Member']);
             }
        }
        else
        {
            echo Json_encode(['status'=>5,'response'=>5,'massage'=>'All field is Mandatory']);
        }
    }
}