<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/4/2020
 * Time: 2:03 PM
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
                            <h2>Pay Now</h2>
                            <?php
                            if (isset($_GET['pay'])){
                                $id = $_GET['pay'];

                                $sql = "SELECT * FROM  invoice, booking WHERE invoice.booking_id = booking.booking_id AND invoice.booking_id = $id"; // insert data into database
                                $res = mysqli_query($connect, $sql);

                                $customer_data = mysqli_fetch_assoc($res);

                                $amount = $customer_data['price'] - $customer_data['pay_amount']; // update payment
                                $due_amount = $customer_data['pay_amount'];
                                $total_due = $due_amount + $amount;

                                if (isset($_POST['pay']))
                                {
                                    $pay_amount = $_POST['pay_amount'];

                                    $sql_up = "UPDATE invoice SET pay_amount = '$pay_amount', payment_by = 'Bank' WHERE booking_id = $id";
                                    $res    = mysqli_query($connect, $sql_up);

                                    $_SESSION['success'] = 'Payment Successful';
                                    echo "<script>document.location.href='pay_history.php?'</script>";
                                }
                                if (isset($_POST['cancel']))
                                {
                                    $pay_amount = $_POST['pay_amount'];

                                    $sql_cancel    = "UPDATE invoice SET pay_amount = '$customer_data[pay_amount]' WHERE booking_id = $id";
                                    $res_cancel    = mysqli_query($connect, $sql_cancel);

                                    $_SESSION['error'] = 'Payment Cancel';
                                    echo "<script>document.location.href='pay_history.php?'</script>";
                                }
                            }
                            ?>
                        </div>
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label class="text-capitalize font-weight-bold">Account Holder : <?php echo $customer_data['name'];?></label><br/>
                                    <label class="font-weight-bold">Account Number :  <?php echo $customer_data['account_number'];?></label><br/>
                                </div>
                                <div class="form-group">
                                    <label>Payable Amount</label>
                                    <input type="text" name="pay_amount" hidden value="<?php echo $total_due;?>" class="form-control">
                                    <input type="text" value="<?php echo $amount;?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label></label>
                                    <input type="submit" name="pay" class="btn btn-success col-md-5" value="Pay Now">
                                    <input type="submit" name="cancel" class="btn btn-danger col-md-5" value="Cancel">
                                </div>
                            </form>
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





