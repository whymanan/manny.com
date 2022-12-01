<div class="content-wrapper">
    <div class="row" id="proBanner">
        <div class="col-lg-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Pancard Banlance</h5>
                            <span class="h2 font-weight-bold mb-0">Rs. <?= $total[0]['bal']; ?></span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                <i class="ni ni-money-coins"></i>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-lg-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                <h3>Add Balance</h3>
                </div>
                <div class="card-body">
                    <?php 
                    // pre($wallet); 
                    ?>
                    <form action="" method="post">
                    <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="text" class="form-control" name="amount" placeholder="Amount" id="amount" required>
                        </div>
                        <div class="form-group">
                            <label for="remark">Remark</label>
                            <input type="text" class="form-control" name="remark" placeholder="Remark" id="remark" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>