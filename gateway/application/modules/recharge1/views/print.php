<html>
<head>
    <style>
        .box {
            height: 700px;
            border: 5px solid #6e6bb0;
            width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        table {
            line-height: 30px;
            padding-left: 10%;
        }

        .social {
            padding: 10px;
            border-radius: 50%;
            background: #6c6ab0;
            color: white;
            margin-left: 15px;
        }

        @media print {

            .no-print,
            .no-print * {
                display: none !important;
            }

            @page {
                margin-top: 0;
                margin-bottom: 0;
            }

            body {
                padding-top: 72px;
                padding-bottom: 72px;
            }
        }
    </style>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>

<body onload="window.print()">
    <a class="no-print" href="<?php echo base_url("recharge"); ?>" class="btn btn-primary">Back</a>
    <div>
        <div class="container box">
            <div class="image">
                <img src="<?php echo base_url() ?>optimum/logoside.png" height="100px">
                <h2 style="padding-left: 16px;margin-top: -11px;">Transaction Details</h2>
            </div>
            <table>
                <tr>
                    <td width="150px">Transaction Status</td>
                    <td>:</td>
                    <td><?php echo $result->transection_msg ?></td>
                </tr>
                <tr>
                    <td>Amount</td>
                    <td>:</td>
                    <td>Rs <?php echo $result->transection_amount ?></td>
                </tr>
                <tr>
                    <td>Transaction ID</td>
                    <td>:</td>
                    <td><?php echo $result->transection_id ?></td>
                </tr>
                <tr>
                    <td>Date & Time</td>
                    <td>:</td>
                    <td><?php echo $result->created ?></td>
                </tr>
                <tr>
                    <td>Service Name</td>
                    <td>:</td>
                    <td style="text-transform: capitalize;"><?php echo $result->transection_type ?></td>
                </tr>
                <tr>
                    <td>Transation Number</td>
                    <td>:</td>
                    <td><?php echo $result->transection_mobile ?></td>
                </tr>
            </table>
            <hr width="530px">
            </br>
            <div style="float: right;margin-right: 60px;">
                <span class="social"><i class="fab fa-twitter"></i></span>
                <span class="social"><i class="fab fa-instagram"></i></span>
            </div>
        </div>
    </div>

</body>

</html>