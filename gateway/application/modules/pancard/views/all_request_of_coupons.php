<div class="content-wrapper">
    <div class="row" id="proBanner">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center text-white bg-primary py-1">All requested Coupons</h1>
                </div>
                <div class="card-body">
                    <div class="container-fluid">

                        <table class="table table-bordered mt-2">
                            <tr>
                                <th>#</th>
                                <th>REQUEST ID</th>
                                <th>MEMBER ID</th>
                                <th>VLE ID</th>
                                <th>COUPON DETAILS</th>
                                <th>Requested By</th>
                                <th>STATUS</th>
                                <!-- <th>ACTION</th> -->
                            </tr>
                            <?php
                            // if($fetch->num_rows() > 0) { 
                            foreach ($fetch as $row) : ?>
                                <tr>
                                    <td><?= $row->coupon_request_id; ?></td>
                                    <td><?= $row->coupon_reference_id . "<br><h3>UTR No. - ". $row->coupon_utr_number."</h3>"; ?></td>
                                    <td><?= $row->vite_member_id; ?></td>
                                    <td><?= $row->vle_member_id; ?></td>
                                    <td class="d-flex flex-column font-weight-bold">
                                        <span class="p-1">Type - <?= $row->coupon_type; ?></span>
                                        <span class="p-1">Coupon QTY. - <?= $row->coupon_qty; ?></span>
                                        <span class="p-1">Total - <?= $row->total_amount; ?></span>
                                        <span class="p-1">Date -
                                            <?= date("d M, Y H:i:s", strtotime($row->created_at)); ?></span>
                                    </td>
                                    <td><?= $row->member_role; ?></td>
                                    <td><?php
                                        $status = $row->coupon_request_status;
                                        switch ($status) {
                                            case "0":
                                                echo "<span id='badge_$row->coupon_request_id'>
                                <span class='badge badge-warning' title='Pending'>Pending</span>
                            </span>";
                                                break;
                                            case "1":
                                                echo "<span id='badge_$row->coupon_request_id'>
                                    <span class='badge badge-success'  title='Approved'>Approved</span>
                                </span>";
                                                break;
                                            case "2":
                                                echo "<span id='badge_$row->coupon_request_id'>
                                    <span class='badge badge-danger' title='Rejected'>Reject</span>
                                </span>";
                                                break;
                                            default:
                                                echo "<span <span class='badge badge-primary' title='Rejected'>Something went wrong! so please contact main head department.</span>";
                                        }
                                        ?></td>
                                    <!-- <td>
                                    <button class="btn btn-primary">Check Status</button>
                                </td> -->
                                </tr>
                            <?php
                            endforeach;
                            // } else{
                            //     echo '<h1>No more records';
                            // }
                            ?>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>