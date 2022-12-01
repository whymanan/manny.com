<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
// filter
<div class="collapse" id="collapseExample">
  <div class="card card-body">
    <form method="post" id="filter">
      <div class="form-row">
        <div class="col-2">
          <input type="date"  id="date_from" name="date_from" class="form-control form-control-sm" value="<?php echo date('Y-m-d') ?>">
        </div>
        <div class="col-2">
          <input type="date" id="date_to" name="date_to" class="form-control form-control-sm" value="<?php echo date('Y-m-d') ?>">
        </div>
       <?php if (isAdmin($this->session->userdata('user_roles'))){?>
        <div class="col-2">
          <select id="searchBymember" name="searchBymeber" class="form-control form-control-sm" >
            <option value="">-- Select Member Id --</option>
            <?php foreach($member_list as $value){?>
            <option value="<?php echo $value['member_id'];?>"><?php  echo $value['member_id'];?></option>
            }
            <?php }?>
          </select>
        </div>
        <?php }?>
        <div class="col-2">
          <select id="searchByCat" name="searchByCat" class="form-control form-control-sm" >
            <option value="">-- Select Category --</option>
            <option value="reference_number">Reference Id</option>
            <option value="transection_id">TRANSECTION ID</option>
            <option value="transection_mobile">PHONE</option>
          </select>
        </div>
      
        <div class="col-2">
          <input type="text" id="searchValue" class="form-control form-control-sm" placeholder="Search" >
        </div>
         <div class="col-2">
          <select id="searchBystatus" name="searchBystatus" class="form-control form-control-sm" >
            <option value="">-- Select Status --</option>
            <option value="success">Success</option>
            <option value="failure">Failure</option>
            <option value="other">Other</option>
          </select>
        </div>
        </br>
        </br>
        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
        <div style="float:right">
        <button id='simplefilter' class="btn btn-primary btn-xs"> <i class="fas fa-search"></i> Search</button>
        <button  id='export' class="btn btn-primary btn-xs"> <i class="fas fa-eraser"></i> Export</button>
        </div>
      </div>
    </form>
  </div>
</div>
<div class="row">

    <div class="col-xl-4 order-xl-1">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0">Broadband Bill Pay</h3>
                    </div>
                    <div class="col-4 text-right">

                    </div>
                </div>
            </div>
            <div class="card-body">
                <form name="validate" role="form" action="<?php echo base_url('recharge/bill_submit'); ?>" method="post" enctype="multipart/form-data" autocomplete="off">
                   



                   
                        <div class="row">
                            
                              
                                
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Service Provider</label>
                                        <select name="operator" id="operator" class="form-control select2">
                                            <option value="">Select Provider</option>
                                            <option value="52">ACT BroadBand</option>
                                            <option value="320">AirJaldi - Rural Broadband</option>
                                            <option value="115">Airtel Broadband</option>
                                            <option value="319">Alliance Broadband Services Pvt. Ltd	</option>
                                            <option value="150">ASIANET Broadband (ASIANET)</option>
                                            
                                            <option value="148">Comway Broadband		</option>
                                            <option value="58">Connect BroadBand</option>
                                            <option value="169">Den Broadband</option>
                                            <option value="489">DWAN Supports Private Ltd		</option>
                                            <option value="400">Excell Broadband</option>
                                            <option value="461">Ficus Telecom Pvt Ltd		</option>
                                            
                                            <option value="192">Flash Fibernet</option>
                                            <option value="149">Fusionnet Web Services Private Limited</option>
                                            <option value="431">GTPL KCBPL Broadband Pvt Ltd</option>
                                            <option value="57">Hathway</option>
                                            <option value="164">Instalinks</option>
                                            <option value="175">Instanet Broadband	</option>
                                            
                                            <option value="224">ION</option>
                                            <option value="487">Kerala Vision Broadband Pvt Ltd</option>
                                            <option value="494">Limras Eronet</option>
                                            <option value="495">Linkio Fibernet</option>
                                            <option value="167">Mnet Broadband</option>
                                            <option value="19">MTNL Delhi Broadband</option>
                                            
                                            <option value="186">Netplus Broadband</option>
                                            <option value="65">Nextra Broadband</option>
                                            <option value="395">Skylink Fibernet Private Limited</option>
                                            <option value="59">SpectraNet Broadband</option>
                                            <option value="443">Swifttele Enterprises Private Limited</option>
                                            <option value="170">Timbl Broadband</option>
                                            
                                            <option value="114">TTN BroadBand</option>
                                            <option value="174">Vfibernet Broadband</option>
                                            <option value="430">Wish Net Pvt Ltd</option>
                                        </select>
                                </div>
                            </div>
                            
                              <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Account Id</label>
                                    <input type="text" name="account" id="account" class="form-control clear" required>
                                     <button type="button" class="btn btn-primary my-4 text-center" id="fetch">Fetch Bill</button>
                                </div>
                            </div>
                       
                    </div>
                        <div class="row fetch">
                             
                       </div>
    


                    <div  id="submit">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                         <input type="hidden" name="amount" value="" id="amount">
                          <input type="hidden" name="duedate" value="" id="duedate">
                         <input type="hidden" name="username" value="" id="name">
                         <input type="hidden" id="recharge_type" name="type" value="broadband">
                         <input type="hidden" id="serviceid" name="service" value="42">
                        <button type="submit" class="btn btn-primary my-4" id="submit_btn">Proceed to pay</button>
                    </div>

                   
                </form>
            </div>
        </div>
    </div>
    <div class="col-xl-8 order-xl-2">
        <div class="card">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">Transaction List</h3>
                    </div>

                </div>
            </div>
            <div class="table-responsive">
                <!-- Projects table -->
               <table class="table align-items-center table-flush" id="transectionlist">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Trn id</th>
                            <th scope="col">Details</th>
                             <th scope="col">Mobile</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Status</th>
                             <th scope="col">Created At</th>

                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
 $(document).ready(function() {
  $('#view_plan').hide();
   $('#submit_btn').hide();
     
   
   $('#fetch').on('click', function(){
      
      var account = $('#account').val();
       var operator = $('#operator').val();
       //console.log(operator);
       if(account!='' && operator!=""){
      $.ajax({
        
        url: '<?php echo base_url('recharge/fetch_bill') ?>', //Mobile info
        type: 'POST',
        dataType: 'json',
        data: {"account":account,'operator' : operator,'mode':'online',"<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"},
        beforeSend: function() {
          $('.fetch').append('<br><span><img width="100" height="100" src="<?php echo base_url('optimum/loading.svg') ?>" /></span>');
        },
        success: function(data) {
           console.log(data);
          if(data.status==false){
              Swal.fire(data.message)
          $('.fetch').html('<div class="container text-center">Massage:'+ data.message +'</div>');
           
          }
          else{
              $('#amount').val(data.bill_fetch.billAmount);
              $('#name').val(data.bill_fetch.userName);
               $('#duedate').val(data.bill_fetch.dueDate);
              $('.fetch').html('<br><div class="container">Name : '+ data.bill_fetch.userName+'<br> Due Amount : '+data.bill_fetch.billAmount); 
                $('#submit_btn').show();
          }
        
     
          
        },
        complete: function() {
          $('#account').parent().find('span').remove();
        },
      })
        }else{
            alert("please fill account id");
        }
    });
    
     var $transectionlist = $('#transectionlist');
           var duid = '<?php echo $this->session->userdata("member_id") ?>';
          var type ='broadband';
          var service_id=42;
      var Api = '<?php echo base_url('recharge/RechargeController/'); ?>';
     var $table = $transectionlist.DataTable({
      "searching": false,
      "processing": true,
      "serverSide": true,
      "deferRender": true,
      "language": {
        "processing": '<img width="24" height="24" src="<?php echo base_url('optimum/loading.svg') ?>" />',
        "emptyTable": "No data available ...",
      },
      "order": [],
      "ajax": {
        url: Api + "get_bill_history?key=" + duid + "&list=all&type="+type+"&list=all&service_id="+service_id,
        type: "GET",
      },

      "pageLength": 10
    });
 });
 

 function Print(id) {

var sureDel = confirm("Are you sure want to Print Reciept");
var $dmtTransactionPanel = $('#print');
if (sureDel == true) {
  window.location.replace("<?php echo base_url('/recharge/RechargeController/print/') ?>" + id);
}
}
 
    </script>