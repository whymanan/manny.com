<div class="row">

    <div class="col-xl-4 order-xl-1">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0">GAS Bill Pay</h3>
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
                            <select name="operator" id="operator" class="form-control">
                                <option value="101">Vadodara Gas Limited	</option>
                                <option value="100">Unique Central Piped Gases Pvt Ltd (UCPGPL)</option>
                                <option value="86">Tripura Natural Gas</option>
                                <option value="283">Torrent Gas Moradabad Limited Formerly Siti Energy Limited	</option>
                                <option value="68">Siti Energy</option>
                                <option value="194">Sanwariya Gas Limited	</option>
                                <option value="84">Sabarmati Gas Limited (SGL)		</option>
                                <option value="282">Megha Gas</option>
                                <option value="107">Maharashtra Natural Gas Limited</option>
                                <option value="17">Mahanagar Gas Limited	</option>
                                 <option value="141">IRM Energy Private Limited	</option>
                                <option value="34">Indraprastha Gas</option>
                                <option value="129">Indian Oil-Adani Gas Private Limited</option>
                                <option value="286">Indane Gas</option>
                                <option value="80">Haryana City Gas</option>
                                 <option value="35">Gujarat Gas Company Limited</option>
                                <option value="156">Green Gas Limited(GGL)</option>
                                <option value="139">Gail Gas Limited		</option>
                                <option value="113">Charotar Gas Sahakari Mandali Ltd</option>
                                <option value="124">Central U.P. Gas Limited		</option>
                                <option value="177">Bhagyanagar Gas Limited		</option>
                                <option value="172">Assam Gas Company Limited		</option>
                                <option value="49">Adani Gas</option>
                                <option value="122">Aavantika Gas Ltd</option>
                                <option value="176">Indian Oil Corporation Limited</option>
                                <option value="286">Indane Gas</option>
                                <option value="168">Hindustan Petroleum Corporation Ltd (HPCL)</option>
                                <option value="173">Bharat Petroleum Corporation Limited (BPCL)</option>
                                
                                   
                                   
                                
                                
                               
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
                                 <input type="hidden" name="duedate" value="" id="duedate">
                                  <input type="hidden" name="username" value="" id="name">
                                  <button type="button" class="btn btn-primary my-4" id="fetch">Fetch Bill</button>
                            </div>
                        </div>
                    </div>
                       <div class="row fetch">
                             
                       </div>   
                       

                    <div >
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                        
                        <button type="submit" class="btn btn-primary my-4" id="submit_btn">Proceed</button>
                         <input type="hidden" name="type" value="gas" >
                         <input type="hidden" name="service" value="22" >
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
          var type ='gas';
          var service_id=22;
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