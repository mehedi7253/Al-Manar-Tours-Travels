<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/4/2020
 * Time: 9:31 AM
 */
?>
<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 10/29/2020
 * Time: 11:06 AM
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
                        <div class="card-header">
                            <h3 class="text-capitalize">Payment History</h3>
                        </div>
                        <div class="card-body">
                            <?php
                            if(isset($_SESSION['error'])){
                                echo "
                                        <div class='alert alert-danger alert-dismissible'>
                                          <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                          <h4><i class='icon fa fa-warning'></i> Error!</h4>
                                          ".$_SESSION['error']."
                                        </div>
                                     ";
                                unset($_SESSION['error']);
                            }
                            if(isset($_SESSION['success'])){
                                echo "
                                    <div class='alert alert-success alert-dismissible'>
                                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                      <h4><i class='icon fa fa-check'></i> Success!</h4>
                                      ".$_SESSION['success']."
                                    </div>
                               ";
                                unset($_SESSION['success']);
                            }
                            ?>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
<!--                                            <th>Name</th>-->
<!--                                            <th>Package</th>-->
                                            <th>Booking Date</th>
                                            <th>Total</th>
                                            <th>Due</th>
                                            <th>Pay</th>
                                            <th>Invoice</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $sql_get = "SELECT * FROM  booking, package_price WHERE
                                                  booking.package = package_price.id AND 
                                                  booking.user_id = '$userdata[id]' ORDER BY date DESC";
                                        $res_get = mysqli_query($connect, $sql_get); // select payment data from invoice
                                        $i = 1;
                                        while ($payment = mysqli_fetch_assoc($res_get)){?>
                                            <tr>
                                                <td><?php echo $i++;?></td>
<!--                                                <td>--><?php //echo $payment['booking_type'];?><!--</td>-->
<!--                                                <td>--><?php //echo $payment['package_name'];?><!--</td>-->
                                                <td><?php echo $payment['date'];?></td>
                                                <td><?php echo number_format($payment['price'],2);?></td>
                                                <td>
                                                    <?php

                                                        $sql_due = "SELECT booking_id, invoice_number, price, pay_amount, (price - pay_amount) AS DUE FROM invoice WHERE booking_id = '$payment[booking_id]'"; // invoice
                                                        $res_due = mysqli_query($connect, $sql_due);// connect with query and database

                                                        $due = mysqli_fetch_assoc($res_due);
                                                    ?>
                                                    <?php
                                                    // check due
                                                        if ($due){
                                                            if ($due !== 0)
                                                            {
                                                                echo number_format($due['DUE'],2).' '.'T.K';
                                                            }
                                                        }else{
                                                            echo number_format($payment['price'], 2).' '.'T.K';
                                                        }

                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    // if not duew
                                                        if ($due){
                                                            if ($payment['price'] == $due['pay_amount'])
                                                            {
                                                                echo '<span class="text-success font-weight-bold">Compelete</span>';
                                                            }else{
                                                                echo "<a class='btn btn-info' target='_blank' href='update_payment.php?pay=$payment[booking_id]'>Pay Now</a>";
                                                            }
                                                        }else{
                                                            echo "<a class='btn btn-info' target='_blank' href='pay_now.php?pay=$payment[booking_id]'>Pay Now</a>";
                                                        }
//
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    // if pay user able to vie3w invoice
                                                        if ($due == 0)
                                                        {
                                                            echo "<span class='btn btn-danger'>Pay First</span>";
                                                        }else{
                                                            echo "<a class='btn btn-info' href='invoice.php?invoice_id=$due[invoice_number]'>Invoice</a>";
                                                        }
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php }
                                    ?>
                                    </tbody>
                                </table>
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

</body>
</html>


