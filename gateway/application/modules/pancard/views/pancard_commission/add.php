<div class="card card-body">
    <form method="post" id="filter"
        action="<?php echo base_url('pancard/save-pancard-commision'); ?>">
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
                        <input type="text" class="form-control" name="commision" placeholder="Commission">
                    </div>
                </div>
                

                <div class="col-2">
                    <input type="hidden" id="role_id" name="role_id" class='btn btn-primary'
                        value="<?php echo $role_id ?>" required>
                    <input type="hidden" name="service_id" id="service_id" class='btn btn-primary' value="41" required>
                    <!--<input type="hidden" name="<? $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />-->
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>"
                        value="<?php echo $this->security->get_csrf_hash();?>">


                    <div class="text-center" id="submit_btn">
                        <button type="Submit" class="btn btn-primary">Submit</button>
                    </div>


                </div>
            </div>
    </form>
</div>