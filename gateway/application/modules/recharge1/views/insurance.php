<div class="row">

    <div class="col-xl-4 order-xl-1">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0">Insurance Primium</h3>
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
                                            <option value="151">Aviva Life Insurance</option>
                                            <option value="201">Bajaj Allianz General Insurance</option>
                                            <option value="73">Bajaj Allianz Life Insurance</option>
                                            <option value="42">Bharti Axa Life Insurance</option>
                                            <option value="93">Canara HSBC Oriental Bank of Commerce Life Insurance</option>
                                            
                                            <option value="135">DHFL Pramerica Life Insurance Co. Ltd		</option>
                                            <option value="51">Edelweiss Tokio Life Insurance</option>
                                            <option value="145">Exide Life Insurance</option>
                                            <option value="197">Future Generali India Life Insurance Company Limited		</option>
                                            <option value="171">HDFC Life Insurance Co. Ltd</option>
                                            <option value="16">ICICI Prudential Life Insurance</option>
                                            
                                            <option value="106">IDBI federal Life Insurance</option>
                                            <option value="136">INDIA FIRST Life Insurance</option>
                                            <option value="241">Life Insurance Corporation</option>
                                            <option value="230">Max Bupa Health Insurance</option>
                                            <option value="137">Max Life Insurance</option>
                                            <option value="50">PNB Metlife	</option>
                                            
                                            <option value="193">Pramerica Life Insurance Limited</option>
                                            <option value="226">Reliance General Insurance Company Limited</option>
                                            <option value="206">Reliance Nippon Life Insurance</option>
                                            <option value="187">Religare Health Insurance Co Ltd</option>
                                            <option value="56">SBI Life Insurance</option>
                                            <option value="162">SBIG</option>
                                            
                                            <option value="231">Shriram General Insurance</option>
                                            <option value="223">Shriram Life Insurance Co Ltd</option>
                                            <option value="212">Star Union Dai Ichi Life Insurance</option>
                                            <option value="21">Tata AIA Life Insurance</option>
                                            <option value="211">Vastu Housing Finance Corporation Limited</option>
                                        </select>
                                </div>
                            </div>
                            
                              <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Policy Number</label>
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
                         <input type="hidden" name="type" value="insurance">
                         <input type="hidden" name="service" value="20">
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
               <table class="table align-items-center table-flush" id="billtransectionlist">
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
    
     var $transectionlist = $('#billtransectionlist');
           var duid = '<?php echo $this->session->userdata("member_id") ?>';
          var type ='insurance';
          var service_id=20;
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