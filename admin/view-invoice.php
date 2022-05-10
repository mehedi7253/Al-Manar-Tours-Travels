<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/4/2020
 * Time: 9:15 PM
 */
session_start();
if (!isset($_SESSION['email'])){
    header('Location: ../index.php');
}

require_once '../php/db_connect.php';?>
<?php include "front/header.php"; ?>

<body id="page-top">

<?php include "front/nav.php";?>



<div id="wrapper">
    <?php include "front/sidebar.php";?>

    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="admin_dashboard.php">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Invoice</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-10 mx-auto mt-4 mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h3>View Invoice</h3>
                            <?php
                            if (isset($_GET['invoice'])){
                                $invoice = $_GET['invoice'];

                                $_SESSION['invoice_number'] = $invoice;

                                $sql1 = "SELECT * FROM users, invoice WHERE invoice.user_id = users.id AND invoice.invoice_number = '$invoice'";
                                $res1 = mysqli_query($connect, $sql1);
                                $data1 = mysqli_fetch_assoc($res1);

                            }
                            ?>
                        </div>
                        <div class="card-body" id="mainFrame">
                            <div class="col-md-12">
                                <div class="invoice-title">
                                    <div class="invoice-number font-weight-bold">Invoice Number:  #<?php echo $data1['invoice_number'];?>
                                        <span class="float-right">
                                             <?php
                                             $status = $data1['status'];
                                             if (($status) == '1'){?>
                                                 <span class="text-success font-weight-bold">Payment Received</span>
                                                 <?php
                                             }
                                             if (($status) == '0'){?>
                                                 <span class="text-danger font-weight-bold">Pending</span>
                                                 <?php
                                             }
                                             ?>
                                        </span>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <address>
                                            <strong>Billed To:</strong><br>
                                            <span class="text-capitalize"><?php echo $data1['first_name']. ' '.$data1['last_name'];?></span><br>
                                            <?php echo $data1['postal'].', '.$data1['ps'];?><br>
                                            <?php echo $data1['city'];?><br>
                                        </address>
                                    </div>
                                    <div class="col-md-6 text-md-right">
                                        <address>
                                            <strong>Payment Date:</strong><br>
                                            <?php echo $data1['date'];?><br><br><br>
                                        </address>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <address>
                                            <strong>Payment Method:</strong><br>
                                            <?php echo $data1['payment_by'];?><br>
                                        </address>
                                    </div>
                                    <div class="col-md-6 text-md-right">
                                        <address>
                                            <strong>Account Number:</strong><br>
                                            <?php echo $data1['account_number'];?><br><br><br>
                                        </address>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="section-title">Booking Summary</div>
                                        <p class="section-lead">All items here cannot be deleted.</p>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-md">
                                                <tr>
                                                    <th class="text-center">Package</th>
                                                    <th class="text-center">Package Type</th>
                                                    <th class="text-center">Price</th>
                                                    <th class="text-center">Due</th>
                                                    <th class="text-center">Status</th>
                                                </tr>
                                                <?php
                                                $sql = "SELECT * FROM booking, invoice, package_price WHERE 
                                                        invoice.booking_id = booking.booking_id AND
                                                         booking.package = package_price.id AND 
                                                         invoice.invoice_number = '$invoice'";

                                                $res = mysqli_query($connect, $sql);
                                                $i =1;
                                                while ($row = mysqli_fetch_assoc($res)){?>
                                                    <tr class="text-center">
                                                        <td><?php echo $row['booking_type'];?></td>
                                                        <td><?php echo $row['package_name'];?></td>
                                                        <td class="text-center"><?php echo number_format($row['price'], '2');?> T.K</td>
                                                        <td>
                                                            <?php
                                                            $pro_price = $row['price'];
                                                            $pay_price = $row['pay_amount'];

                                                            $total_price = $pro_price - $pay_price;
                                                            echo number_format($total_price,2 );
                                                            ?> T.K
                                                        </td>
                                                        <td>
                                                            <?php
                                                            $status = $data1['status'];
                                                            if (($status) == '1'){?>
                                                                <span class="text-success font-weight-bold">Payment Received</span>
                                                                <?php
                                                            }
                                                            if (($status) == '0'){?>
                                                                <span class="text-danger font-weight-bold">Payment Pending</span>
                                                                <?php
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                <?php }?>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-md-right">
                                <button class="btn btn-warning btn-icon icon-left" type="pss" id="prntPSS"><i class="fas fa-print"></i> Print</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <?php include "front/sub_footer.php";?>
    </div>
    <!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->


<?php include "front/footer.php";?>
<script type="application/javascript">
    // print invoice
    $(document).ready(function () {

        $('#prntPSS').click(function() {
            var printContents = $('#mainFrame').html();
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        });

    });
</script>
</body>
</html>



