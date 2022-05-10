<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/14/2020
 * Time: 12:59 PM
 */
?>
<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/4/2020
 * Time: 4:07 PM
 */

require_once '../php/config.php';

if(not_logged_in() === TRUE) {
    header('location: login.php');
}

$userdata = getUserDataByUserId($_SESSION['id']);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Al_Manar_Tours&Travels</title>
    <link rel="stylesheet" href="../assets/style/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="../assets/style/main.css" type="text/css">
    <link rel="stylesheet" href="../assets/style/footer.css" type="text/css">
    <link rel="icon" href="../images/<?php echo $userdata['image']?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>
<style>
    #topBtn{
        position: fixed;
        bottom: 40px;
        right: 40px;
        font-size: 22px;
        width: 50px;
        height: 50px;
        background: gray;
        color: white;
        border: none;
        cursor: pointer;
        display: none;
    }
    #topBtn:hover{
        background-color: black;
        color: white;
    }

</style>
<body>
<section class="header-top" style="background-color: silver">
    <?php include "../top_header.php";?>

</section>
<!--nav bar-->
<section class="menu_bar">
    <?php include "nav.php";?>
</section>


<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 mt-5 mb-5">
                <div class="col-md-4 col-sm-12 float-left">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-info text-capitalize"><?php echo $userdata['first_name'].' '.$userdata['last_name'];?> Profile</h3>
                        </div>
                        <div class="card-body">
                            <?php include "side_bar.php";?>
                        </div>
                    </div>
                </div>


                <div class="col-md-8 col-sm-12 float-left">
                    <div class="card">
                        <div class="card-header" >
                            <h4>Your Invoice</h4>
                            <?php
                            if (isset($_GET['invoice'])){
                                $invoice = $_GET['invoice'];

                                $sql1 = "SELECT * FROM tour_invoice WHERE tour_invoice_number = '$invoice'"; // select invoice by user id
                                $res1 = mysqli_query($connect, $sql1); // connect with query and database
                                $data1 = mysqli_fetch_assoc($res1);

                            }
                            ?>
                        </div>
                        <div class="card-body" id="mainFrame">
                            <div class="col-md-12">
                                <div class="invoice-title">
                                    <div class="invoice-number font-weight-bold">Invoice Number:  #<?php echo $data1['tour_invoice_number'];?>
                                        <span class="float-right">
                                            <?php
                                            $status = $data1['status'];
                                            if (($status) == '0'){?>
                                                <span class="text-success font-weight-bold">Payment Received</span>
                                                <?php
                                            }
                                            if (($status) == '1'){?>
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
                                            <span class="text-capitalize"><?php echo $userdata['first_name']. ' '.$userdata['last_name'];?></span><br>
                                            <?php echo $userdata['postal'].', '.$userdata['ps'];?><br>
                                            <?php echo $userdata['city'];?><br>
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
                                            <?php echo $data1['payment_method'];?><br>
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
                                                    <th class="text-center">Person</th>
                                                    <th class="text-center">Sub Total</th>
                                                    <th class="text-center">Total</th>
                                                </tr>
                                                <?php
                                                $sql = "SELECT * FROM tour_booking, tour_invoice, sub_tour WHERE  
                                                        tour_invoice.tour_booking_id = tour_booking.tour_book_id AND 
                                                        tour_booking.sub_tour_id = sub_tour.sub_tour_id AND
                                                        tour_invoice.tour_invoice_number ='$invoice'"; // select user information and view invoice

                                                $res = mysqli_query($connect, $sql); // connect with query and database
                                                $i =1;
                                                while ($row = mysqli_fetch_assoc($res)){?>
                                                    <tr>
                                                        <td><?php echo $row['title'];?></td>
                                                        <td class="text-capitalize"><?php echo $row['package'];?></td>
                                                        <td class="text-center"><?php echo $row['person'];?></td>
                                                        <td class="text-right">
                                                            <?php
                                                                $person = $row['person']; // total person
                                                                $price = $row['price']; // package price

                                                                // total price
                                                            echo $person.' X '.$price;
                                                            ?>
                                                        </td>
                                                        <td><?php echo  number_format($total_price = $person * $price, 2);?></td>
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
    </div>
</section>





<footer class="mainfooter" role="contentinfo">
    <?php include "../big_footer.php";?>
</footer>



<?php include "chat.php";?>

<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/bootstrap.js"></script>
<script src="../assets/js/topdown.js"></script>
<script type="text/javascript">
    $(document).on("scroll", function() {
        if ($(document).scrollTop() > 86) {
            $("#banner").addClass("w3hubs");
            // $("#banner").addClass("bgs");


        } else {
            $("#banner").removeClass("w3hubs");

        }
    });

</script>
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

