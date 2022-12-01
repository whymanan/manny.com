<div class="row">

    <div class="col-xl-12 order-xl-1">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0">Pancard Coupon</h3>
                    </div>
                    <div class="col-4 text-right">

                    </div>
                </div>
            </div>
            <div class="card-body">
                <?php 
                // pre($fetch_commision);
                // pre($_SESSION);
                // die();
                // echo $fetch_commision[0]['coupon_price']; 
                echo form_open('pancard/submit-coupon-request'); ?>

                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Coupon Type</label>
                            <div class="col-sm-9">
                                <select type="text" id="type" class="form-control" name="coupon_type">
                                    <option value=""> -- Select Coupon Type --</option>
                                    <option value="p-coupon">Physical Coupon</option>
                                    <option value="e-coupon">Electronic Coupon</option>
                                </select>
                                <?= form_error('type'); ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="qty">Coupon Quantity</label>
                            <div class="col-sm-9">
                                <input type="number" name="coupon_qty" class="form-control" placeholder="Coupon Qty." id="coupon_qty" value="<?= set_value('coupon_qty') ?>">
                                <?= form_error('coupon_qty'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Amount</label>
                            <div class="col-sm-9">
                                <input type="number" name="amount" class="form-control amount" value="<?= set_value('amount') ?>" placeholder="Amount">
                                <?= form_error('amount'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Enter UTR No.</label>
                            <div class="col-sm-9">
                                <input type="text" name="utr" class="form-control utr" value="<?= set_value('utr') ?>" placeholder="Enter UTR No.">
                                <?= form_error('utr'); ?>
                            </div>
                        </div>
                    </div>

                </div>

                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>"
                    value="<?php echo $this->security->get_csrf_hash();?>">

                <input type="submit" class="btn btn-primary" value="Submit">
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>