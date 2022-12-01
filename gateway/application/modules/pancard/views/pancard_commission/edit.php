<div class="card card-body">
    <form method="post" id="filter" action="<?php echo base_url('pancard/pancard-commision-update'); ?>">
        <div class="">
            <div class="row">
                <div class="col-md-4">
                <div class="form-group">
                        <label class="form-control-label">Service Provider</label>
                        <select type="text" id="type" class="form-control" name="coupon_type">
                            <option value=""> -- Select Coupon Type --</option>
                            <option value="p-coupon">Physical Coupon</option>
                            <option value="e-coupon">Electronic Coupon</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-control-label" for="price">Coupon Price</label>
                        <input type="text" class="form-control" name="price" id="price" placeholder="Pancard Coupon Price">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-control-label" for="example3cols3Input">Commission</label>
                        <input type="text" class="form-control" name="commision" id="commision" placeholder="">
                    </div>
                </div>
                
                
                
                
            
            <div class="col-2">
              <input type="hidden" id="role_id"  name="role_id" class='btn btn-primary' value=""  required>
              <!-- <input type="hidden" id="service_commission_id"  name="service_commission_id" class='btn btn-primary' value=""  required> -->
              <input type="hidden" name="service_id" id="service_id" class='btn btn-primary' value=""  required>
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

                  
                 
                    <div class="text-center" id="update">
                    <button type="Submit" class="btn btn-primary my-4" id="update_btn">Update</button>
                   </div>
           
            </div>
        </div>
    </form>
</div>