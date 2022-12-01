<div class="row">

    <div class="col-xl-4 order-xl-1">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0">Electricity Bill Pay</h3>
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
                                    <option value="10">Adani Electricity Mumbai Limited</option>
                                    <option value="54">Ajmer Vidyut Vitran Nigam Ltd</option>
                                    <option value="75">APEPDCL - Eastern Power Distribution CO AP Ltd.</option>
                                    <option value="76">APSPDCL - Southern Power Distribution CO AP Ltd. </option>
                                    <option value="70">Assam Power Distribution Company Ltd</option>

                                    <option value="103">Assam Power Distribution Company Ltd (NON-RAPDR) </option>
                                    <option value="36">Bangalore Electricity Supply</option>
                                    <option value="29">BEST</option>
                                    <option value="43">Bhagalpur Electricity Distribution Company (P) Ltd </option>
                                    <option value="78">Bharatpur Electricity Services Ltd. (BESL)</option>
                                    <option value="79">Bikaner Electricity Supply Limited (BkESL) </option>

                                    <option value="248">Brihan Mumbai Electric Supply And Transport Undertaking</option>
                                    <option value="249">Brihanmumbai Electric Supply And Transport </option>
                                    <option value="11">BSES Rajdhani Power Limited</option>
                                    <option value="12">BSES Yamuna Power Limited </option>
                                    <option value="47">Calcutta Electricity Supply Co. Ltd. </option>
                                    <option value="146">CESU, Odisha </option>

                                    <option value="104">Chamundeshwari Electricity Supply Corp Ltd (CESCOM)</option>
                                    <option value="207">Chandigarh Electricity Department </option>
                                    <option value="30">Chhattisgarh Electricity Board </option>
                                    <option value="25">Dakshin Gujarat Vij Company Ltd </option>
                                    <option value="98">Dakshin Haryana Bijli Vitran Nigam (DHBVN)</option>
                                    <option value="46">Daman and Diu Electricity Department </option>

                                    <option value="142">Department of Power, Nagaland </option>
                                    <option value="250">Dnh Power Distribution Company Limited </option>
                                    <option value="140">Goa Electricity Department</option>
                                    <option value="166">Government of Puducherry Electricity Department </option>
                                    <option value="91">Gulbarga Electricity Supply Company Limited</option>
                                    <option value="109">Himachal Pradesh Electricity </option>

                                    <option value="105">Hubli Electricity Supply Company Ltd (HESCOM)</option>
                                    <option value="251">India Power Corporation - West Bengal </option>
                                    <option value="252">India Power Corporation Limited" </option>
                                    <option value="32">Jaipur Vidyut Vitran Nigam Ltd</option>
                                    <option value="47">Jammu and Kashmir Power Development Department </option>
                                    <option value="38">Jamshedpur Utilities and Services Company</option>

                                    <option value="102">Jharkhand Bijli Vitran Nigam Limited (JBVNL) </option>
                                    <option value="33">Jodhpur Vidyut Vitran Nigam Ltd </option>
                                    <option value="67">Kanpur Electricity Supply Company Ltd </option>
                                    <option value="147">Kerala State Electricity Board Ltd. (KSEBL) </option>
                                    <option value="81">Kota Electricity Distribution Limited (KEDL) </option>
                                    <option value="253">M.p. Madhya Kshetra Vidyut Vitaran - Agriculture </option>

                                    <option value="117">M.P. Madhya Kshetra Vidyut Vitaran - RURAL </option>
                                    <option value="116">M.P. Madhya Kshetra Vidyut Vitaran - URBAN </option>
                                    <option value="37">M.P. Paschim Kshetra Vidyut Vitaran </option>
                                    <option value="118">M.P. Poorv Kshetra Vidyut Vitaran - URBAN</option>
                                    <option value="132">M.P. Poorv Kshetra Vidyut Vitaran – RURAL </option>
                                    <option value="24">Madhya Gujarat Vij Company Ltd Limited </option>

                                    <option value="18">Mahavitaran-Maharashtra State Electricity Distribution Company Ltd. (MSEDCL) </option>
                                    <option value="144">Mangalore Electricity Supply Co. Ltd (MESCOM) </option>
                                    <option value="48">Meghalaya Power Distribution Cor. Ltd</option>
                                    <option value="45">MP-Poorv Kshetra Vidyut Vitaran Co. Ltd.(Jabalpur)</option>
                                    <option value="254">Muzaffarpur Vidyut Vitran Limited </option>
                                    <option value="83">NESCO, Odisha </option>

                                    <option value="120">New Delhi Municipal Council (NDMC) - Electricity </option>
                                    <option value="31">Noida Power Company Limited </option>
                                    <option value="82">North Bihar Power Distribution Company Ltd. </option>
                                    <option value="255">Northern Power Distribution Of Telanagana Ltd </option>
                                    <option value="256">Odisha Discoms B2B</option>
                                    <option value="257">Odisha Discoms B2C </option>

                                    <option value="26">Paschim Gujarat Vij Company Ltd </option>
                                    <option value="258">Power & Electricity Department Government Of Mizoram</option>
                                    <option value="99">Punjab State Power Corporation Ltd (PSPCL)</option>
                                    <option value="259">Rajasthan Vidyut Vitran Nigam Limited </option>
                                    <option value="143">Sikkim Power - URBAN </option>
                                    <option value="133">Sikkim Power – RURAL </option>

                                    <option value="77">South Bihar Power Distribution Company Ltd </option>
                                    <option value="85">SOUTHCO, Odisha</option>
                                    <option value="94">Tamil Nadu Electricity Board (TNEB)</option>
                                    <option value="20">Tata Power Delhi Distribution Ltd</option>
                                    <option value="66">Tata Power Mumbai</option>
                                    <option value="297">Torrent power - Agra</option>
                                    <option value="40">Torrent power - Ahmedabad</option>
                                    <option value="296">Torrent power - Bhiwandi</option>
                                    <option value="295">Torrent power - Surat</option>
                                    <option value="87">TP Ajmer Distribution Ltd (TPADL)</option>
                                    <option value="260">Tp Center Odisha Distribution Limited</option>
                                    <option value="44">Tripura State Electricity Board</option>
                                    <option value="27">Uttar Gujarat Vij Company Ltd</option>
                                    <option value="97">Uttar Haryana Bijli Vitran Nigam (UHBVN)</option>
                                    <option value="95">Uttar Pradesh Power Corp Ltd (UPPCL) - RURAL</option>
                                    <option value="74">Uttar Pradesh Power Corp. Ltd. (UPPCL) - URBAN</option>
                                    <option value="89">Uttarakhand Power Corporation Limited</option>
                                    <option value="90">WESCO Utility</option>
                                    <option value="108">West Bengal State Electricity Distribution Co. Ltd</option>
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



                    <div id="submit">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                        <input type="hidden" name="amount" value="" id="amount">
                        <input type="hidden" name="duedate" value="" id="duedate">
                        <input type="hidden" name="username" value="" id="name">
                        <input type="hidden" name="service" value="18">
                        <input type="hidden" name="type" value="electrict">
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


        $('#fetch').on('click', function() {

            var account = $('#account').val();
            var operator = $('#operator').val();
            //console.log(operator);
            if (account != '' && operator != "") {
                $.ajax({

                    url: '<?php echo base_url('recharge/fetch_bill') ?>', //Mobile info
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        "account": account,
                        'operator': operator,
                        'mode': 'offline',
                        "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                    },
                    beforeSend: function() {
                        $('.fetch').append('<br><span><img width="100" height="100" src="<?php echo base_url('optimum/loading.svg') ?>" /></span>');
                    },
                    success: function(data) {
                         if(data.bill_fetch.status==false && data.bill_fetch.desc!=null){
                          Swal.fire(data.bill_fetch.desc)
                          $('.fetch').html('<div class="container text-center">Massage:'+ data.bill_fetch.desc +'</div>');
                         }
                         else if(data.bill_fetch.status==false && data.bill_fetch.desc==null)
                         {
                             Swal.fire("Invailid custumer Id or operator");
                          $('.fetch').html('<div class="container text-center">Massage:Invailid custumer Id or operator</div>');
                         }
                         else{
                             $('#amount').val(data.bill_fetch.Billamount);
                             $('#name').val(data.bill_fetch.CustomerName);
                             $('#duedate').val(data.duedate);
                             $('.fetch').html('<br><div class="container">Name : '+ data.bill_fetch.CustomerName+'<br> Due Amount : '+data.bill_fetch.Billamount+'<br> Due Date : '+data.duedate+'<br> Bill Date : '+data.BillDate); 
                             $('#submit_btn').show();
                         }

                    },
                    complete: function() {
                        $('#account').parent().find('span').remove();
                    },
                })
            } else {
                alert("please select operator or account id");
            }
        });

        $(document).on('click', '#clear', function() {
            $('#circle').val("");
            $('#operator').val("");
            $("#amount").val("");
            $("#mobile").val("");
        });
        var $transectionlist = $('#billtransectionlist');
        var duid = '<?php echo $this->session->userdata("member_id") ?>';
        var type = 'electrict';
        var service_id=18;

        var Api = '<?php echo base_url('recharge/RechargeController/'); ?>';
        var $table = $transectionlist.DataTable({
            "searching": false,
            "processing": true,
            "serverSide": true,
            "deferRender": true,
            "language": {
                "processing": '<img width="24" height="24" src="<?php echo base_url('optimum/loading.svg') ?>" />',
                "emptyTable": "No distributors data available ...",
            },
            "order": [],
            "ajax": {
                url: Api + "get_bill_history?key=" + duid + "&list=all&type=" + type+"&list=all&service_id="+service_id,
                type: "GET",
            },

            "pageLength": 10
        });
        // var $transectionlist = $('#billtransectionlist');
        // var duid = '<?php echo $this->session->userdata("member_id") ?>';
        // var type = 1;

        // var Api = '<?php echo base_url('recharge/RechargeController/'); ?>';
        // var $table = $transectionlist.DataTable({
        //     "searching": false,
        //     "processing": true,
        //     "serverSide": true,
        //     "deferRender": true,
        //     "language": {
        //         "processing": '<img width="24" height="24" src="<?php echo base_url('optimum/loading.svg') ?>" />',
        //         "emptyTable": "No distributors data available ...",
        //     },
        //     "order": [],
        //     "ajax": {
        //         url: Api + "get_bill_history?key=" + duid + "&list=all&type=" + type,
        //         type: "GET",
        //     },

        //     "pageLength": 10
        // });
    });
    
  function Print(id) {

var sureDel = confirm("Are you sure want to Print Reciept");
var $dmtTransactionPanel = $('#print');
if (sureDel == true) {
  window.location.replace("<?php echo base_url('/recharge/RechargeController/print/') ?>" + id);
}
}
</script>