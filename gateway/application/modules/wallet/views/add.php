<div class="row">
    <div class="col-xl-12 order-xl-1">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0">Add Balance</h3>
                    </div>
                    <div class="col-4 text-right">
                        <h3 class="mb-0">Balance :- Rs : <?php echo $bal?></h3>
                    </div>
                </div>
            </div>
            <div class="card-body" >
                <!-- <form name="validate" role="form" action="<?php echo base_url('wallet/submit'); ?>" method="post" -->
                    <!-- enctype="multipart/form-data" autocomplete="off"> -->
                    <div class="pl-lg-4">

                        <div class="row">
                           
                            <div class="col-sm-2 ">
                            <p style=" padding:15px;"> Amount <span style="color:red;"> * </span> </p>
                            </div>
                            <div class="col-sm-4" ">
                            <p style=" padding:10px;">
                                <input name="amount" id="wallet_amount" type="text" class="form-control" autocomplete="off">
                            </div>

                            <div class="col-sm-2">
                                <p style="padding:15px;"> Remark <span style="color:red;"> </span> </p>
                            </div>
                            <div class="col-sm-4">
                             <input name="remark" type="text"   class="form-control" autocomplete="off">

                            </div>

                            <div class="col-sm-2">
                                <p style="padding:15px;">Email Id <span style="color:red;"> * </span> </p>
                            </div>
                            <div class="col-sm-4">
                            <input name="email_id" type="email" id="wallet_email"  class="form-control" autocomplete="off">                            
                            </div>

                        </div>

                        <div class="text-center">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>"
                                autocomplete="off">
                            <input type="hidden" id="type" value="add" autocomplete="off">
                            <input type="button" name="" value="Submit" class="btn btn-primary" onclick="triggerLayer(result.token,result.access);">
                            <input id="submit" class="btn btn-primary" name="submit" value="Pay" type="submit" onclick="Approve();">
                            <!-- <button type="reset"  class="btn btn-danger"> Reset </button> -->
                        </div>

                    </div>
                <!-- </form> -->
            </div>
        </div>
    </div>
</div>
