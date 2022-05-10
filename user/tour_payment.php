<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/14/2020
 * Time: 12:22 PM
 */
?>
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
                            if (isset($_GET['book_id'])){
                                $id = $_GET['book_id'];

                                $sql = "SELECT * FROM tour_booking, sub_tour WHERE  tour_booking.sub_tour_id = sub_tour.sub_tour_id AND tour_book_id = $id"; // payment
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
                                            $booking_id       = $_POST['tour_booking_id'];
                                            $account_number   = $_POST['account_number'];
                                            $sub_tour_id      = $_POST['sub_tour_id'];
                                            $price            = $_POST['price'];
                                            $person           = $_POST['person'];
                                            $tour_invoice_number = (rand(10,1000000));
                                            $create = @date('Y-m-d H:i:s');

                                            if ($account_number == "")
                                            {
                                                echo "<span class='text-danger'>Enter your Account Number</span><br/>";
                                            }
                                            if ($account_number) {
                                                $sql_bank = "INSERT INTO tour_invoice (user_id, tour_booking_id, account_number, sub_tour_id, price, person, tour_invoice_number, date, status) VALUES ('$user_id', '$booking_id', '$account_number', '$sub_tour_id', '$price', '$person', '$tour_invoice_number', '$create', '0')"; // payment
                                                $res_bank = mysqli_query($connect, $sql_bank); // connect with query and database
                                                echo "<script>document.location.href='bank_next_tour.php?pay=$id'</script>";
                                            }
                                        }
                                        ?>

                                        <form action="" method="post" class="mt-4">
                                            <div class="form-group col-md-10 mx-auto">
                                                <label>Card Number</label>
                                                <input name="user_id"  hidden value="<?php echo $userdata['id'];?>">
                                                <input name="tour_booking_id" hidden  value="<?php echo $customer_data['tour_book_id'];?>">
                                                <input name="sub_tour_id" hidden  value="<?php echo $customer_data['sub_tour_id'];?>">
                                                <input name="price" hidden value="<?php echo $customer_data['price'] * $customer_data['person'];?>">
                                                <input name="person" hidden value="<?php echo $customer_data['person'];?>">
                                                <input type="text" name="account_number"  class="form-control" placeholder="XXXX-XXXX-XXXX-XXXX">
                                            </div>
<!--                                            <div class="form-group  col-md-10 mx-auto">-->
<!--                                                <input type="checkbox"> <span class="text-dark">I Agree To The Term And Condition</span>-->
<!--                                            </div>-->
                                            <div class="form-group col-10 mx-auto">
                                                <label></label>
                                                <input type="submit" name="bank" class="btn btn-success col-md-5" value="Next">
                                                <a href="tour_pay_history.php" type="reset" class="btn btn-danger col-md-5">Cancel</a>
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
                                                $booking_id       = $_POST['tour_booking_id'];
                                                $account_number   = $_POST['account_number'];
                                                $sub_tour_id      = $_POST['sub_tour_id'];
                                                $price            = $_POST['price'];
                                                $person           = $_POST['person'];
                                                $tour_invoice_number = (rand(10,1000000));
                                                $create = @date('Y-m-d H:i:s');

                                                if ($account_number == "")
                                                {
                                                    echo "<span class='text-danger'>Enter your Account Number</span><br/>";
                                                }
                                                if ($account_number) {
                                                    $sql_bank = "INSERT INTO tour_invoice (user_id, tour_booking_id, account_number, sub_tour_id, price, person, tour_invoice_number, date, status) VALUES ('$user_id', '$booking_id', '$account_number', '$sub_tour_id', '$price', '$person', '$tour_invoice_number', '$create', '0')"; // payment
                                                    $res_bank = mysqli_query($connect, $sql_bank); // connect with query and database
                                                    echo "<script>document.location.href='bkas_tour.php?pay=$id'</script>";
                                                }
                                            }
                                        ?>
                                        <p class="mt-4 text-center text-white">Bkash Check Out</p>
                                        <div class="col-md-8 mx-auto">
                                            <form action="" method="post">
                                                <div class="form-group">
                                                    <input name="user_id"  hidden value="<?php echo $userdata['id'];?>">
                                                    <input name="tour_booking_id" hidden  value="<?php echo $customer_data['tour_book_id'];?>">
                                                    <input name="sub_tour_id" hidden  value="<?php echo $customer_data['sub_tour_id'];?>">
                                                    <input name="price" hidden value="<?php echo $customer_data['price'] * $customer_data['person'];?>">
                                                    <input name="person" hidden value="<?php echo $customer_data['person'];?>">

                                                    <label class="text-white">Enter Bkash Number</label>
                                                    <input type="number" name="account_number" placeholder="eg: 01XXXXXXXXX" class="form-control">

                                                </div>

<!--                                                <div class="form-group">-->
<!--                                                    <input type="checkbox"> <span class="text-white ml-2">I Agree To The Term And Condition</span>-->
<!--                                                </div>-->
                                                <div class="form-group">
                                                    <input type="submit" class="btn col-md-5 p-1" name="bkas" style="background-color: #B6195E; color: white">
                                                    <a href="tour_pay_history.php" type="reset" class="btn col-md-5 p-1" style="background-color: #B6195E; color: white">Cancel</a>
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




