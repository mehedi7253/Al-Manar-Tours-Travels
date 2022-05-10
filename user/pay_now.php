<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/4/2020
 * Time: 10:02 AM
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
                            <h2>Pay Now</h2>
                            <?php
                            if (isset($_GET['pay'])){
                                $id = $_GET['pay'];

                                $sql = "SELECT * FROM booking, package_price WHERE  booking.package = package_price.id AND booking_id = $id"; // payment
                                $res = mysqli_query($connect, $sql); // connect with query and database

                                $customer_data = mysqli_fetch_assoc($res);
                            }
                            ?>
                        </div>
                        <div class="card-body">
                            <nav>
                                <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true" style="background-color: #9fcdff"><span class="ml-3 text-dark font-weight-bold"><i class="far fa-credit-card fa-2x"></i> Bank </span> </a>
                                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false" style="background-color: #E3106D"> <span class="ml-3 text-dark font-weight-bold"><img src="../images/bkas.JPG" style="width: 50px; height: 50px">  Bkash</span></a>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
<!--                                    <div class="form_1">-->
                                        <div class="card-body" style="background-color: #9fcdff">
                                            <?php
                                            if (isset($_POST['bank']))
                                            {
                                                $user_id          = $_POST['user_id'];
                                                $booking_id       = $_POST['booking_id'];
                                                $account_number   = $_POST['account_number'];
                                                $price            = $_POST['price'];
                                                $package_price_id = $_POST['package_price_id'];
                                                $invoice = (rand(10,1000000));
                                                $create = @date('Y-m-d H:i:s');

                                                if ($account_number == "")
                                                {
                                                    echo "<span class='text-danger'>Enter your Account Number</span><br/>";
                                                }
                                                if ($account_number) {
                                                    $sql_bank = "INSERT INTO invoice (account_number, user_id, booking_id, invoice_number, payment_by, price, package_price_id, date, status) VALUES ('$account_number', '$user_id', '$booking_id', '$invoice', 'Bank', '$price', '$package_price_id', '$create', '1')"; // payment
                                                    $res_bank = mysqli_query($connect, $sql_bank); // connect with query and database
                                                    echo "<script>document.location.href='bank_next.php?pay=$id'</script>";
                                                }
                                            }
                                            ?>

                                            <form action="" method="post" class="mt-4">
                                                <div class="form-group col-md-10 mx-auto">
                                                    <label>Card Number</label>
                                                    <input name="user_id" hidden value="<?php echo $userdata['id'];?>">
                                                    <input name="booking_id" hidden value="<?php echo $customer_data['booking_id'];?>">
                                                    <input name="price" hidden value="<?php echo $customer_data['price'];?>">
                                                    <input name="package_price_id" hidden value="<?php echo $customer_data['package'];?>">
                                                    <input type="text" name="account_number"  class="form-control" placeholder="XXXX-XXXX-XXXX-XXXX">
                                                </div>
<!--                                                <div class="form-group  col-md-10 mx-auto">-->
<!--                                                    <input type="checkbox"> <span class="text-dark">I Agree To The Term And Condition</span>-->
<!--                                                </div>-->
                                                <div class="form-group col-10 mx-auto">
                                                    <label></label>
                                                    <input type="submit" name="bank" class="btn btn-success col-md-5" value="Next">
                                                    <a href="pay_history.php" type="reset" class="btn btn-danger col-md-5">Cancel</a>
                                                </div>
                                            </form>
                                        </div>
<!--                                    </div>-->
                                </div>
                                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                    <div class="card-body" style="background-color: #E3106D;">
                                        <?php
                                        if (isset($_POST['bkas']))
                                        {
                                            $user_id          = $_POST['user_id'];
                                            $booking_id       = $_POST['booking_id'];
                                            $account_number   = $_POST['account_number'];
                                            $price            = $_POST['price'];
                                            $package_price_id = $_POST['package_price_id'];
                                            $invoice = (rand(10,1000000));
                                            $create = @date('Y-m-d H:i:s');

                                            if ($account_number == "")
                                            {
                                                echo "<span class='text-white text-center mt-4'>Enter your Bkash Number</span><br/>";
                                            }
                                            if ($account_number) {
                                                $sql_bank = "INSERT INTO invoice (account_number, user_id, booking_id, package_price_id, invoice_number, payment_by, price, date, status) VALUES ('$account_number', '$user_id', '$booking_id', '$package_price_id', '$invoice', 'Bkash', '$price', '$create', '1')";
                                                $res_bank = mysqli_query($connect, $sql_bank);
                                                echo "<script>document.location.href='bkas_payment.php?pay=$id'</script>";
                                            }
                                        }
                                        ?>
                                        <p class="mt-4 text-center text-white">Bkash Check Out</p>
                                        <div class="col-md-8 mx-auto">
                                            <form action="" method="post">
                                                <div class="form-group">
                                                    <input name="user_id" hidden value="<?php echo $userdata['id'];?>">
                                                    <input name="booking_id" hidden value="<?php echo $customer_data['booking_id'];?>">
                                                    <input name="package_price_id" hidden value="<?php echo $customer_data['package'];?>">
                                                    <input name="price" hidden value="<?php echo $customer_data['price'];?>">

                                                    <label class="text-white">Enter Bkash Number</label>
                                                    <input type="number" name="account_number" placeholder="eg: 01XXXXXXXXX" class="form-control">

                                                </div>

<!--                                                <div class="form-group">-->
<!--                                                    <input type="checkbox"> <span class="text-white ml-2">I Agree To The Term And Condition</span>-->
<!--                                                </div>-->
                                                <div class="form-group">
                                                    <input type="submit" class="btn col-md-5 p-1" name="bkas" style="background-color: #B6195E; color: white">
                                                    <a href="pay_history.php" type="reset" class="btn col-md-5 p-1" style="background-color: #B6195E; color: white">Cancel</a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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



