<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/3/2020
 * Time: 11:54 AM
 */
?>

<?php

include "php/config.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Al_Manar_Tours&Travels</title>
    <link rel="stylesheet" href="assets/style/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="assets/style/main.css" type="text/css">
    <link rel="stylesheet" href="assets/style/footer.css" type="text/css">
    <link rel="icon" href="images/logo.jpg">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>
<style>
    .slider{
        background-image: url("images/pakage.JPG");
        height: 200px;
        width: 100%;
        background-repeat: no-repeat;
        background-size: 100% 100%;
    }
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
<body style="background-color: #F7FBFF">
<section class="header-top" style="background-color: silver">
    <?php include "top_header.php";?>
</section>
<!--nav bar-->
<section class="menu_bar">
    <?php include "nav.php"?>
</section>

<section class="slider">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">

                <h2 class="mt-5 font-weight-bold">Book Now</h2>

                <h4 class="mt-5"><span class="text-info">Our Services :</span> <a href="hajj_packages.php" class="btn col-2" style="background-color: #37D117; color: white;">Hajj</a> <a href="umrah_packages.php" class="btn col-2" style="background-color: #FE6700; color: white;">Umrah</a> <a href="tours.php" class="btn col-2" style="background-color: #52AAF4; color: white;">Islamic Tours</a></h4>
            </div>
        </div>
    </div>
</section>

<section class="main_content">
    <div class="container">
        <div class="row">
            <div class="col-md-10 mx-auto mt-4 mb-5">
                <div class="card" style="background-color: #F7FBFF">
                    <div class="card-header">
                        <h3 class="text-center text-capitalize">book Now</h3>
                    </div>
                    <div class="card-body">
                        <?php
                            // check login user
                            if (not_logged_in() === true)
                            {
                                if (isset($_POST['book'])) {
                                    $_SESSION['login'] = 'You Have To Login First Before Booking.....Try Again';
                                }
                            }else{
                                if (isset($_POST['book'])) {
                                    $user_id = $_POST['user_id'];
                                    $name = $_POST['name'];
                                    $email = $_POST['email'];
                                    $phone = $_POST['phone'];
                                    $country = $_POST['country'];
                                    $type = $_POST['booking_type'];
                                    $package = $_POST['package'];
                                    $comment = $_POST['comment'];

                                    if ($name == "") {
                                        $_SESSION['name'] = 'Please Enter Name';
                                    }
                                    if ($email == "") {
                                        $_SESSION['emails'] = 'Please Enter Email';
                                    }
                                    if ($phone == "") {
                                        $_SESSION['phone'] = 'Please Enter Phone';
                                    }
                                    if ($country == "") {
                                        $_SESSION['country'] = 'Please Select Country Name';
                                    }
                                    if ($type == "") {
                                        $_SESSION['type'] = 'Please Select Type';
                                    }
                                    if ($package == "") {
                                        $_SESSION['package'] = 'Please Select Package';
                                    }

                                    if ($user_id && $name && $email && $phone && $country && $type && $package && $comment) {
                                        $create = @date('Y-m-d H:i:s');
                                        $booking = "INSERT INTO booking (user_id, name, email, phone, country, booking_type, package, comment, status, date) VALUES ('$user_id', '$name', '$email', '$phone', '$country', '$type', '$package', '$comment', '1', '$create')"; // insert booking data
                                        $result = mysqli_query($connect, $booking);

                                        $_SESSION['success'] = 'Booking Successful....<br/><a href="user/pay_history.php" class="text-info text-decoration-none">Please Complete Your Payment Within 72 Hours</a>';
                                    } else {
                                        $_SESSION['error'] = 'Booking Failed';
                                    }
                                }
                            }
                        ?>
                        <?php
                        // validation message
                        if(isset($_SESSION['name'])){
                            echo "
                                <div class='alert alert-danger alert-dismissible' id='name' style='background-color: red; color: white'>
                                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                  <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['name']."
                                </div>
                                ";
                            unset($_SESSION['name']);
                        }
                        if(isset($_SESSION['emails'])){
                            echo "
                                <div class='alert alert-danger alert-dismissible' id='emails' style='background-color: red; color: white'>
                                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                  <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['emails']."
                                </div>
                            ";
                            unset($_SESSION['emails']);
                        }
                        if(isset($_SESSION['phone'])){
                            echo "
                                <div class='alert alert-danger alert-dismissible' id='phone' style='background-color: red; color: white'>
                                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                  <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['phone']."
                                </div>
                            ";
                            unset($_SESSION['phone']);
                        }
                        if(isset($_SESSION['country'])){
                            echo "
                                <div class='alert alert-danger alert-dismissible' id='country' style='background-color: red; color: white'>
                                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                  <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['country']."
                                </div>
                                ";
                            unset($_SESSION['country']);
                        }
                        if(isset($_SESSION['package'])){
                            echo "
                                <div class='alert alert-danger alert-dismissible' id='package' style='background-color: red; color: white'>
                                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                  <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['package']."
                                </div>
                                    ";
                            unset($_SESSION['package']);
                        }
                        if(isset($_SESSION['type'])){
                            echo "
                                <div class='alert alert-danger alert-dismissible' id='type' style='background-color: red; color: white'>
                                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                  <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['type']."
                                </div>
                                ";
                            unset($_SESSION['type']);
                        }
                        if(isset($_SESSION['login'])){
                            echo "
                                <div class='alert alert-danger alert-dismissible' id='login' style='background-color: red; color: white'>
                                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                  <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['login']."
                                </div>
                                ";
                            unset($_SESSION['login']);
                        }
                        if(isset($_SESSION['success'])){
                            echo "
                                <div class='alert alert-success alert-dismissible'>
                                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                  <h6><i class='icon fa fa-check'></i> Success!</h6>
                                  ".$_SESSION['success']."
                                </div>
                              ";
                            unset($_SESSION['success']);
                        }
                        if(isset($_SESSION['error'])){
                            echo "
                                    <div class='alert alert-danger alert-dismissible' id='error' style='background-color: red; color: white'>
                                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                      <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['error']."
                                    </div>
                                    ";
                            unset($_SESSION['error']);
                        }
                        ?>
                        <form action="" method="post">
                            <div class="form-group col-md-6 float-left">
                                <label> Name <sup class="text-danger font-weight-bold">*</sup></label>
                                <input hidden type="text" name="user_id" value="<?php if (isset($userdata)){echo $userdata['id'];}?>">
                                <input type="text" name="name" placeholder="Enter Name" class="form-control" value="<?php if($_POST) {
                                    echo $_POST['name'];
                                } else { if (isset($userdata)){
                                    echo $userdata['first_name'].' '.$userdata['last_name'];}
                                } ?>">
                            </div>
                            <div class="form-group col-md-6 float-left">
                                <label> Email <sup class="text-danger font-weight-bold">*</sup></label>
                                <input type="email" name="email" placeholder="Enter Email" class="form-control" value="<?php if($_POST) {
                                    echo $_POST['email'];
                                } else {
                                    if (isset($userdata))
                                    {echo $userdata['email'];}
                                } ?>">
                            </div>
                            <div class="form-group col-md-6 float-left">
                                <label> Phone <sup class="text-danger font-weight-bold">*</sup></label>
                                <input type="number" name="phone" placeholder="Enter phone Number" class="form-control" value="<?php if($_POST) {
                                    echo $_POST['phone'];
                                } else {
                                    if (isset($userdata))
                                    {echo $userdata['phone'];}
                                } ?>">
                            </div>
                            <div class="form-group col-md-6 float-left">
                                <label> Country <sup class="text-danger font-weight-bold">*</sup></label>
                                <select name="country" class="form-control">
                                    <option value="bangladesh">Bangladesh</option>
                                    <option value="india">Inida</option>
                                    <option value="pakistan">Pakistan</option>
                                    <option value="nepal">Nepal</option>
                                    <option value="afghanistan">Afghanistan</option>
                                    <option value="algeria">Algeria</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6 float-left">
                                <label> Select Type <sup class="text-danger font-weight-bold">*</sup></label>
                                <select name="booking_type" class="form-control">
                                    <option value="Hajj">Hajj</option>
                                    <option value="Umrah">Umrah</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6 float-left">
                                <label> Chose Package <sup class="text-danger font-weight-bold">*</sup></label>
                                <select name="package" class="form-control">
                                    <?php
                                        $sql = "SELECT * FROM package_price";
                                        $res = mysqli_query($connect, $sql);

                                        while ($row = mysqli_fetch_assoc($res)){?>
                                            <option value="<?php echo $row['id'];?>"><?php echo $row['package_name'];?></option>
                                    <?php }
                                    ?>

                                </select>
                            </div>
                            <div class="form-group col-12 float-left">
                                <label> Comment</label>
                                <textarea class="form-control" name="comment" placeholder="Enter Comment"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="book" class="btn btn-primary col-md-3 ml-3" value="Book Now">
                            </div>
                            <div class="card-footer">
                    <div class="d-flex  justify-content-center links">
                        Already have an account?<a href="user/login.php" class="text-decoration-none"> <span class="ml-2">Login / </span></a>
                        <a href="user/registration.php" class="text-decoration-none"> <span class="ml-2">Registration Now</span></a>
                    </div>
                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




<footer class="mainfooter" role="contentinfo">
    <?php include "big_footer.php";?>
</footer>



 <?php include "chat.php";?>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/topdown.js"></script>
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
<script>
    // validation sweet alert
    $(function() {
        setTimeout(function() { $("#name").fadeOut(1500); }, 3000)
    })
    $(function() {
        setTimeout(function() { $("#emails").fadeOut(1500); }, 3000)
    })
    $(function() {
        setTimeout(function() { $("#phone").fadeOut(1500); }, 3000)
    })
    $(function() {
        setTimeout(function() { $("#country").fadeOut(1500); }, 3000)
    })
    $(function() {
        setTimeout(function() { $("#package").fadeOut(1500); }, 3000)
    })
    $(function() {
        setTimeout(function() { $("#type").fadeOut(1500); }, 3000)
    })

    $(function() {
        setTimeout(function() { $("#login").fadeOut(1500); }, 5000)
    })
</script>
</body>
</html>



