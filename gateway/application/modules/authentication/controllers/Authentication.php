<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use GuzzleHttp\Client;

class Authentication extends CI_Controller {

    public $client;
    public function __construct(){
        parent::__construct();
        $this->client = new Client();
        $this->load->model('common_model');
        $this->load->model('users_model');
        $this->load->library(['auth', 'session']);
        $this->load->library('form_validation');
    }

    public function index() {
      if (check()) redirect(base_url('dashboard'), 'refresh');
        $data['main_content'] = $this->load->view('login', '', true);
        $this->load->view('index',$data);
    }

    public function login() {
      $data = $this->security->xss_clean($_POST);
      if($data) {


        $url = _SERVICE_API_.'login';
        #guzzle
        try {

          $response = $this->client->request('POST', $url, [
          'form_params' => [
              'member_id' => $data['member_id'],
              'latitude' => $data['latitude'],
              'longitude' => $data['longitude'],
              'password' => $data['password']
            ],
          ]
        );

          $user = $response->getBody()->getContents();

          if( $user ) {
             // pre($user);exit;
            $user = json_decode($user);
            $user_name = $this->users_model->get_name($user->user_id);
            $set_user = array(
              'expires_in' => $user->expires_in,
              'kyc_status' => $user->kyc_status,
              'user_id' => $user->user_id,
              
              'member_id' => $user->member_id,
              'user_name' => $user_name,
              'menu_permission' => $this->users_model->get_menu_config($user->role_id),
              'phone' => $user->phone,
              'user_roles' => $user->role_id,
              'latitude' => $user->latitude,
              'longitude' => $user->longitude,
              'token' => $user->token,
              'token_type' => $user->token_type,
              'user_id' => $user->user_id,
              'user_status' => $user->user_status,
              'user_type' => $user->user_type,
              'loginStatus' => true
            );
            $this->session->set_userdata($set_user);
            $result = [
              'uname' => $user_name,
              'status' => $response->getStatusCode(),
              'phrase' => $response->getReasonPhrase(),
              'loginStatus' => 1
            ];
            echo json_encode($result);
          }

        } catch (GuzzleHttp\Exception\BadResponseException $e) {
          #guzzle repose for future use
          $response = $e->getResponse();
          $responseBodyAsString = $response->getBody()->getContents();
          echo json_encode($responseBodyAsString);
        }
      } else {
    }
  }


  public function get_data()
  {
    $id=  $this->security->xss_clean($_POST['id']);
    $data=$this->common_model->user_check($id);
    //pre($data);exit;
    if(!$data){
      echo 0;
    } else{
        
        	$to = $data->email;
    		$subject = "Your OTP ";
    		$message = random_int(100000, 999999);
    		$from  = "info@vitefintech.com";
    		$headers = "From : $from";
    		
    		if(mail($to , $subject , $message, $headers)){
    		    
    		  $user_id =  $this->common_model->find_member('user','member_id',$id);
    		    $data = [
    		        
    		        'user_id' => $user_id->user_id,
    		        'phone' => $data->phone,
    		        'email' => $data->email
    		       
    		        ];
    		    
    		    $otp = [
    		        
        		        'otp' => $message,
        		        'user_id' => $user_id->user_id,
    		        
    		            ];
    		    
    		    $this->common_model->insert($otp,'otp_details');
		    
    		} 
    		
                echo json_encode($data);
                
    }
  }
    public function resetView() {
     echo $this->load->view('forget_pass');
    }
  public function verify_otp()
  {
    $id =  $this->security->xss_clean($_POST);
    if (!$this->common_model->check_otp($id)) {
      echo 0;
    } else {
        $data = [
            
            'user_id' => $id['user_id'],
            'value' => 1
            
            ];
            
      echo json_encode($data);
    
        
    }
  }
    public function resetPass() {
      $pass = self::randomPassword();
      $data =  array('email' => $_POST['email']);
      $data = self::send_email($data['email'],  $pass);

    }
    function logout(){
        $this->session->sess_destroy();
        redirect(base_url() . 'authentication', 'refresh');
    }
     public function send_email($email = '', $password = '') {
         $data=array();
        $data['email']=$email;

        $data['password']=$password;
        //  echo print_r($data['value']);
        //  echo print_r($email);exit;
        //   $email = $email;
           $subject = 'Password Reset!!';

          $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'info@rectorsol.com', // change it to yours
            'smtp_pass' => 'shash#13', // change it to yours
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
            );
          $this->email->set_header('MIME-Version', '1.0; charset=utf-8');
          $this->load->library('email', $config);
          $this->email->set_newline("\r\n");
          $this->email->from('info@rectorsol.com'); // change it to yours
          $this->email->to($email);// change it to yours
          $this->email->subject($subject);
          $this->email->set_mailtype('html');
         // $msg=$this->load->view('join/email');
          $this->email->message($this->load->view('email',$data,TRUE));
          $this->email->send();
    }
    function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
    
     function reset_pass(){
         
            $uri = $this->security->xss_clean($_POST);
            
            $password = password_hash($uri['password'], PASSWORD_DEFAULT);
            
            if($this->common_model->resetpass($uri['user_id'],$password)){
                
                $result = [
                            
                            "status" => true,
                            "msg"    => "Successfully"
                            
                          ];
                
                echo json_encode($result);
                
            }else{
                
                 $result = [
                            
                            "status" => false,
                            "msg"    => "Faild"
                            
                          ];
                
                echo json_encode($result);
                
            }
          
        }
    
}
