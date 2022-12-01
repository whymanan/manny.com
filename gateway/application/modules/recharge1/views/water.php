<div class="row">

    <div class="col-xl-4 order-xl-1">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0">Water Bill Pay</h3>
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
                            <select name="operator" class="form-control">
                                <option value="216">Ahmedabad Municipal Corporation</option>
                                <option value="125">Bhopal Municipal Corporation</option>
                                <option value="39">Bangalore Water Supply and Sewerage Board</option>
                                <option value="500">City Municipal Council –Ilkal</option>
                                <option value="163">Department of Public Health Engineering-Water, Mizoram</option>
                                <option value="154">Delhi Jal Board (BBPS)</option>
                                <option value="161">Delhi Development Authority (DDA) - Water</option>
                                <option value="127">Gwalior Municipal Corporation</option>
                                <option value="138">Greater Warangal Municipal Corporation – Water</option>
                                <option value="112">Hyderabad Metropolitan Water Supply and Sewerage Board</option>
                                <option value="155">Haryana Urban Development Authority</option>
                                <option value="126">Indore Municipal Corporation</option>
                                <option value="425">Jammu Kashmir Water Billing-JKPHE Kashmir		</option>
                                <option value="426">Jammu Kashmir Water Billing-JKPHE Jammu</option>
                                <option value="292">Jalkal Vibhag Nagar Nigam Prayagraj</option>
                                <option value="128">Jabalpur Municipal Corporation</option>
                                <option value="179">Kerala Water Authority (KWA)</option>
                                <option value="225">Kalyan Dombivali Municipal Corporation - Water</option>
                                <option value="158">Mysuru Citi Corporation</option>
                                <option value="92">Municipal Corporation of Gurugram</option>
                                <option value="165">Municipal corporation of Amritsar</option>
                                <option value="123">Municipal Corporation Ludhiana – Water</option>
                                
                                <option value="121">Municipal Corporation Jalandhar</option>
                                <option value="208">Municipal Corporation Chandigarh</option>
                                <option value="464">MCGM Water Department	</option>
                                <option value="213">Madhya Pradesh Urban Administration and Development - Water	</option>
                                <option value="119">New Delhi Municipal Council (NDMC) - Water</option>
                                <option value="367">Nagar Nigam Aligarh- water</option>
                                <option value="159">Punjab Municipal Corporations/Councils</option>
                                <option value="71">Pune Municipal Corporation Water</option>
                                <option value="372">Public Health Engineering Department, Haryana</option>
                                <option value="412">Port Blair Municipal Council - Water</option>
                                <option value="152">Ranchi Municipal Corporation</option>
                                <option value="130">Surat Municipal Corporation</option>
                                <option value="153">Silvassa Municipal Council</option>
                                <option value="423">Shivamogga City Corporation - Water Tax</option>
                                <option value="69">Uttarakhand Jal Sansthan</option>
                                <option value="88">Urban Improvement Trust (UIT) - Bhiwadi</option>
                                <option value="134">Ujjain Nagar Nigam – PHED</option>
                                <option value="392">Vatva Industrial Estate Infrastructure Development Ltd</option>
                                <option value="413">Vasai Virar Municipal Corporation - Water</option>
                                <option value="309">Vasai Virar Municipal Corporation</option>
                               
                            </select>
                            </div>
                        </div>
                    </div>
                      <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Customer No/Account No</label>
                                <input type="text" name="account" id="account" class="form-control clear" required>
                                 <input type="hidden" name="amount" id="amount"  >
                                  <button type="button" class="btn btn-primary my-4" id="fetch">Fetch Bill</button>
                            </div>
                        </div>
                    </div>
                       <div class="row fetch">
                             
                       </div>   
                       

                    <div >
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                        <button type="submit" class="btn btn-primary my-4" id="submit_btn">Proceed</button>
                        <input type="hidden" name="amount" value="" id="amount">
                          <input type="hidden" name="duedate" value="" id="duedate">
                         <input type="hidden" name="username" value="" id="name"> 
                        <input type="hidden" name="type" value="water" >
                         <input type="hidden" name="service" value="19" >
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
                <table class="table align-items-center table-flush" id="billtransectionlist">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Print</th>
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
    
     var $transectionlist = $('#billtransectionlist');
           var duid = '<?php echo $this->session->userdata("member_id") ?>';
          var type ='water';
          var service_id=19;
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