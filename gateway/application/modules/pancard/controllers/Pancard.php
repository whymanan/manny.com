<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pancard extends vite{
    public $data = array();
    public $client;

    public function __construct()
    {
        parent::__construct();
        $this->tnxType = 'Pancard';
        $this->load->model('common_model');
        $this->load->model('menu_model');
        $this->load->model('commission_model');
        $this->load->model('users_model');
        $this->load->model('Vle_model');
        $this->data['serid'] = '4';
        $this->data['active'] = 'pancard';
        $this->data['breadcrumbs'] = [array('url' => base_url('pancard/coupon-request'), 'name' => 'pancard')];
        $this->data['bal'] = $this->common_model->wallet_balance($this->session->userdata('user_id'));
        $this->data['fetch_commision'] = $this->db->where('pc_role_id',$this->session->userdata('user_roles'))->get('pancard_commision')->result_array();
        $this->load->helper('url');
        //  $this->load->library('zip');
    }

    public function vle_registration()
    {
        $this->data['check_vle_status'] = $this->db->where('member_id',$this->session->userdata('member_id'))->select('vle_status')->get('user')->row_array();
        $this->data['main_content'] = $this->load->view('vle_registration', $this->data, true);
        $this->data['is_script'] = $this->load->view('script', $this->data, true);
        $this->load->view('layout/index', $this->data);
    }

    public function submit_vle(){
        $this->form_validation->set_rules('name', 'Full Name', 'required');
        $this->form_validation->set_rules('mob', 'Mobile No.', 'required|numeric|exact_length[10]');
        $this->form_validation->set_rules('email', 'Email', 'required|is_unique[vle_pancard.vle_email]');
        $this->form_validation->set_rules('shop', 'Shop', 'required');
        $this->form_validation->set_rules('pin', 'pincode', 'required');
        $this->form_validation->set_rules('loc', 'District', 'required');
        $this->form_validation->set_rules('state', 'State Name', 'required');
        $this->form_validation->set_rules('uid', 'Aadhar card No.', 'required|exact_length[12]');
        $this->form_validation->set_rules('pan', 'PANCARD No.', 'required');
        $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
        if($this->form_validation->run() == true) {
        /* API URL */
        $url = 'http://emopay.co.in/vite/api/pancard/vle-reg';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, 
        http_build_query(
             array(
                'name' => $this->input->post('name'),
                'mob' => $this->input->post('mob'),
                'email' => $this->input->post('email'),
                'shop' => $this->input->post('shop'),
                'loc' => $this->input->post('loc'),
                'state' => $this->input->post('state'),
                'pin' => $this->input->post('pin'),
                'uid' => $this->input->post('uid'),
                'pan' => $this->input->post('pan'),
                'member_id'=> $this->session->userdata('member_id')

                )
            ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close ($ch);
        $decode_data = json_decode($server_output);
            if($decode_data->status ==200) {
                // echo 'Success'; exit;
                $data = [
                    'vle_status' => 'active'
                ];
                if($this->Vle_model->update_vle_status($data)){
                    $json = [
                        'status' => 200,
                        'message' => 'Your VLE Registration has been successfull'
                    ];
                }
            } if($decode_data->status == '401') {
                $json = [
                    'status' => 203,
                    'message' => 'VLE Already exists'
                ];
            }
        }else{
            $json = array(
                "status"=>0,
                "message"=> "Please check your email id or mobile no. is not duplicate",
                "name_error" => form_error('name'),
                "mob_error" => form_error('mob'),
                "email_error" => form_error('email'),
                "shop_error" => form_error('shop'),
                "pin_error" => form_error('pin'),
                "location_error" => form_error('loc'),
                "state_error" => form_error('state'),
                "uid_error" => form_error('uid'),
                "pan_error" => form_error('pan'),
            );
        }

        echo json_encode($json);
    }

    public function pancard_commision(){
        $this->data['main_content'] = $this->load->view('pancard_commission/index', $this->data, true);
    $this->data['is_script'] = $this->load->view('pancard_commission/script', $this->data, true);
    $this->load->view('layout/index', $this->data);
    }

    public function pancard_CommissionForm()
  {

    if ($_POST) {

      $data = $this->security->xss_clean($_POST);


      if (isset($data['aepsCommissionForm'])) {

        $baseRole = $data['aepsCommissionForm'];

        $service = 41;

        $this->data['role_id'] = $baseRole;
        //  $commissionList = $this->common_model->get_list($service, $baseRole);


        echo $this->load->view('pancard_commission/add', $this->data, true);
      } else {
        echo json_encode(['error' => 1, 'msg' => 'requeste not allowed']);
      }
    }
  }

  public function save_pancard_commision(){
      $data = [
          'pc_coupon_type' => $this->input->post('coupon_type'),
          'coupon_price' => $this->input->post('price'),
          'pc_commision'  => $this->input->post('commision'),
          'pc_role_id'    => $this->input->post('role_id'),
          'pc_service_id' => $this->input->post('service_id'),
          'pc_created_at' => date('Y-m-d H:i:s')
      ];

      $query = $this->db->insert('pancard_commision', $data);
      if($query){
          return redirect('pancard/commision');
      }
    
  }

  public function pancard_get_list(){
    $uri = $this->security->xss_clean($_GET);
    //   pre($uri);
    //   exit();
    $role_id = $uri['id'];

    if (!empty($uri)) {
      $query = '';

      $output = array();




      $data = array();

      if (isAdmin($this->session->userdata('user_roles'))) {

        $query .= "SELECT * from pancard_commision  where pc_role_id = '$role_id'  AND pc_service_id =41 ";

        $recordsFiltered = $this->users_model->row_count($query);
      } else {

        $query .= "SELECT * from service_commission where pc_role_id = '$role_id'  AND pc_service_id =41 ";

        $recordsFiltered = $this->users_model->row_count($query);
      }

      if (!empty($_GET["search"]["value"])) {
        $query .= 'AND start_range LIKE "%' . $_GET["search"]["value"] . '%" ';
        // $query .= 'OR end_range "%' . $_GET["search"]["value"] . '%" ';
        // $query .= 'OR g_commission LIKE "%' . $_GET["search"]["value"] . '%" ';
        // $query .= 'OR max_commission LIKE "%' . $_GET["search"]["value"] . '%" ';
        // $query .= 'OR c_flate LIKE "%' . $_GET["search"]["value"] . '%" ';

      }

      if (!empty($_GET["order"])) {
        $query .= 'ORDER BY ' . $_GET['order']['0']['column'] . ' ' . $_GET['order']['0']['dir'] . ' ';
      }
      $sql = $this->db->query($query);
      //   pre($sql);exit;
      $filtered_rows = $sql->num_rows();
      if ($_GET["length"] != -1) {
        $query .= 'LIMIT ' . $_GET['start'] . ', ' . $_GET['length'];
      }
      //	echo $query;exit;

      $sql = $this->db->query($query);
      $result = $sql->result_array();

      $i = 1;
      foreach ($result as $row) {
        $sub_array = array();


        $sub_array[] = '<button type="button" class="btn btn-sm btn-info"  data-placement="bottom" onclick="Edit(' . $row['pc_id'] . ')" title="Edit Commission Information"><i class="fa fa-pencil-alt"></i></button>
           <button type="button" class="btn btn-sm btn-primary"  data-placement="bottom" onclick="Delete(' . $row['pc_id'] . ')" title="Delete Commission Information"><i class="fa fa-trash-alt"></i></button>';
        $sub_array[] = $row['pc_coupon_type'];
        $sub_array[] = $row['coupon_price'];
        $sub_array[] = $row['pc_commision'];
        $sub_array[] = date('d M, Y', strtotime($row['pc_created_at']));
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

  public function pancard_commissionedit($id){
      $query = $this->db->where('pc_id',$id)
      ->get('pancard_commision');

      echo json_encode($query->result_array()[0]);

  }

  public function pancard_commissionaddupdate(){
    $data = array();
    $form = $this->security->xss_clean($_POST);
    $baseRole = $form['addupdate'];
    $data = [
        'role_id' => $form['addupdate']
    ];

    echo $this->load->view('pancard_commission/edit', $this->data, true);
  }

  public function pancard_commision_update(){
    $data = array();
    $form = $this->security->xss_clean($_POST);
    // pre($form); exit;
    $data = [
        'pc_coupon_type' =>$form['coupon_type'],
        'coupon_price' =>$form['price'],
        'pc_commision' => $form['commision'],
        'pc_role_id' => $form['role_id'],
    ];

    if($this->db->where('pc_id',$form['service_id'])->update('pancard_commision',$data)){
        $this->session->set_flashdata(
            array(
              'status' => 1,
              'msg' => " Updated Successfully"
            )
          );
          redirect('pancard/commision', 'refresh');
    }

  }
  public function pancard_commision_delete($id){
    //   pre($_GET); exit;
    if($this->db->where('pc_id',$id)->delete('pancard_commision')){
        echo 1;
    } else{
        echo 0;
    }
  }

  public function coupon_request()
    {
        $this->data['fetch_commision'] = $this->db->where('pc_role_id',$this->session->userdata('user_roles'))->get('pancard_commision')->result_array();
        $this->data['main_content'] = $this->load->view('coupon_request', $this->data, true);
        $this->data['is_script'] = $this->load->view('script', $this->data, true);
        $this->load->view('layout/index', $this->data);
    }
  public function submit_coupon_request(){
    
    $this->load->library('form_validation');
    $this->form_validation->set_rules('coupon_type', 'Coupon type', 'required');
    $this->form_validation->set_rules('coupon_qty', 'Coupon Type', 'required|numeric');
    $this->form_validation->set_rules('amount', 'Total Amount', 'required|numeric');
    $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
    
    if($this->form_validation->run() == true) {
       $q =  $this->db->get('vle_pancard')->num_rows();
        if($q > 0){
        $query = $this->db->where('user_id',$this->session->userdata('user_id'))
        ->join('roles','roles.roles_id=user.role_id','left')
        ->join('vle_pancard','vle_pancard.vle_user_id=user.user_id','left')
        ->select('vle_id,role')
        ->get('user')
        ->result_array();
        if($query[0]['vle_id'] != ''){
        $data = [
            'request_id' => $query[0]['vle_id'].date('YmdHis'),
            'member_id' => $this->session->userdata('member_id'),
            'vle_member_id' => $query[0]['vle_id'],
            'coupon_type'=>$this->input->post('coupon_type'),
            'coupon_qty' => $this->input->post('coupon_qty'),
            'total_amount' => $this->input->post('amount'),
            'member_role' => $this->session->userdata('user_roles'),
            'coupon_request' => '0',
            'coupon_utr_number' => $this->input->post('utr'),
            'created_at' => date('d-m-Y H:i:s')
        ];

        $url = 'https://emopay.co.in/vite/api/v1/pancard/coupon_request';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, 
        http_build_query(array(
          'request_id' => $query[0]['vle_id'].date('YmdHis'),
            'member_id' => $this->session->userdata('member_id'),
            'vle_member_id' => $query[0]['vle_id'],
            'coupon_type'=>$this->input->post('coupon_type'),
            'coupon_qty' => $this->input->post('coupon_qty'),
            'total_amount' => $this->input->post('amount'),
            'member_role' => $this->session->userdata('user_roles'),
            'coupon_request' => '0',
            'coupon_utr_number' => $this->input->post('utr'),
            'created_at' => date('d-m-Y H:i:s')
        )));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close ($ch);
        $decode_data = json_decode($server_output);
        // echo 'ok';
        // pre($decode_data);
        // die();
        if($decode_data->status == '200') {
            if($this->db->insert('all_coupon_request',$data)){
                echo '<script>alert("Coupon request has been done!");</script>';
                echo '<script>window.open("'.base_url("pancard/all-requests").'","_SELF");</script>';
            }
            
        } else {
            $json = [
                'status' => 203,
                'message' => 'Something went wrong'
            ];
        }
        } else{
            return redirect('pancard/vle-registration');
        }
        }else{
            return redirect('pancard/coupon-request');
        }
    } else{
      $this->data['fetch_commision'] = $this->db->where('pc_role_id',$this->session->userdata('user_roles'))->get('pancard_commision')->result_array();

        $this->data['main_content'] = $this->load->view('coupon_request', $this->data, true);
        $this->data['is_script'] = $this->load->view('script', $this->data, true);
        $this->load->view('layout/index', $this->data);
    }
  }

  public function all_coupon_request(){
    /* API URL */
    $url = 'https://emopay.co.in/vite/api/v1/pancard/fetch_all_coupon_request';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, 
    http_build_query(
         array(
            'member_id'=> $this->session->userdata('member_id')
            )
        ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_output = curl_exec($ch);
    curl_close ($ch);
    $decode_data = json_decode($server_output);
    
    $this->data['fetch'] = $decode_data;
    $this->data['main_content']=$this->load->view('all_request_of_coupons',$this->data,true);
    $this->data['my_script']=$this->load->view('script',$this->data,true);
    $this->load->view('layout/index',$this->data);
  } 
  
  public function pancard_wallet(){
    if($this->common_model->check_pancard_wallet($this->session->userdata('user_id'))){
      $this->data['total'] = $this->common_model->pancard_wallet_balance_total($this->session->userdata('user_roles'));
    }
    $this->data['main_content']=$this->load->view('pancard_wallet',$this->data,true);
    $this->data['my_script']=$this->load->view('script',$this->data,true);
    $this->load->view('layout/index',$this->data);
  }

}
