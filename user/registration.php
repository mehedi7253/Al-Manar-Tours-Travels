<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 10/29/2020
 * Time: 10:27 AM
 */

    include '../php/config.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Registration</title>
    <link rel="stylesheet" href="../assets/style/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="../assets/style/main.css" type="text/css">
    <link rel="icon" href="../images/logo.JPG">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>
<body style="background-color: silver">
<section class="header-top" style="background-color: silver">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="col-md-7 col-sm-12 float-left mt-2">
                    <p class="text-info tewji"><a class="text-decoration-none text-dark font-weight-bold" href="event.php">Event</a>  | <a class="text-decoration-none text-dark font-weight-bold" href="gallery.php">Gallery</a>  | <a class="text-decoration-none text-dark font-weight-bold" href="admin/index.php">Admin</a> <span class="text-dark ml-5"> <i class="fas fa-phone"></i> 01941697253</span> <span class="ml-4 text-dark"><i class="far fa-envelope"></i> <span class="text-dark">mdmehedihasan221@gmail.com</span></span></p>
                </div>
                <div class="col-md-5 col-sm-12 float-left">
                    <li class="nav-link float-right">
                        <a href=""><i class="fab fa-facebook-f ml-3 facebook"></i></a>
                        <a href=""><i class="fab fa-google-plus-g  ml-3 google"></i></a>
                        <a href=""><i class="fab fa-linkedin-in  ml-3 linkdin"></i></a>
                        <a href=""><i class="fab fa-youtube ml-3 youtube"></i></a>
                        <a href=""><i class="fab fa-twitter ml-3"></i></a>
                    </li>
                </div>
            </div>
        </div>
    </div>
</section>
<!--nav bar-->
<section class="menu_bar">
    <?php include "nav.php";?>
</section>
<section class="main_body">
    <div class="container">
        <div class="row">
            <div class="col-md-10 mx-auto mt-5 mb-5">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">User Registration</h4>
                    </div>
                    <div class="card-body">
                        <?php

                        if(logged_in() === TRUE) {
                            header('location: dashboard.php');
                        }
                        if ($_POST) {
                            $first_name = $_POST['first_name'];
                            $last_name  = $_POST['last_name'];
                            $email      = $_POST['email'];
                            $phone      = $_POST['phone'];
                            $gender     = $_POST['gender'];
                            $city       = $_POST['city'];
                            $ps         = $_POST['ps'];
                            $postal     = $_POST['postal'];
                            $birth      = $_POST['date_of_birth'];
                            $password   = $_POST['password'];
                            $cpassword  = $_POST['cpassword'];
                            $image      = $_FILES['image']['name'];
//                            $has = hash('sha256', $password);

                            // check validation
                            if ($first_name == '') {
                                $_SESSION['first_name'] = 'First Name Must Not Empty.!!';
                            } elseif ($last_name == '') {
                                $_SESSION['last_name'] = 'Last Name Must Not Empty.!!';
                            } elseif ($email == '') {
                                $_SESSION['emails'] = 'Email Must Not Empty.!!';
                            } elseif ($phone == '') {
                                $_SESSION['phone'] = 'Phone Number Must Not Empty.!!';
                            }elseif (strlen($phone)<11){
                                $_SESSION['phone_lentgh'] = 'Phone Number Should Be 11 Digit!';
                            }elseif (strlen($phone)>11){
                                $_SESSION['phone_lentgh2'] = 'Phone Number Should Be 11 Digit!';
                            }elseif ($city == ''){
                                $_SESSION['city'] = 'Enter Your City';
                            }elseif ($ps == ''){
                                $_SESSION['ps'] = 'Enter Police Station';
                            }elseif ($postal == ''){
                                $_SESSION['postal'] = 'Enter Post Code';
                            }elseif ($birth == ''){
                                $_SESSION['db'] = 'Select Date Of Birth';
                            }elseif ($gender == '') {
                                $_SESSION['gender'] = 'Gender Must Not Empty.!!';
                            } elseif ($password == '') {
                                $_SESSION['pass'] = 'Password Must Not Empty.!!';
                            } elseif (preg_match('/\s/', $password)) {
                                $_SESSION['miss'] = 'Password Must Have No Space.!';
                            } elseif ($cpassword == '') {
                                $_SESSION['con_pass'] = 'Confirm Password Must Not Empty.!!';
                            }elseif ($image == ''){
                                $_SESSION['image'] = 'Chose an Image';
                            }
                            else {
                                // check user and password validation
                                    if ($password == $cpassword) {
                                        if (userExists($email) === TRUE) {
                                            $_SESSION['email_exist'] = $_POST['email'].' '.'All Ready Exist';
//                                        echo $_POST['email'] . "<span class='text-danger'> already exists !!</span>";
                                        } else {
                                            if (registerUser() === TRUE) {
                                                $_SESSION['success'] = 'Successfully Registered';
                                            } else {
                                                $_SESSION['error'] = 'Failed To Registerd';
                                            }
                                        }
                                    } else {
                                        $_SESSION['pas_con'] = 'Confirm password does not match with given password';
//                                    echo "<span class='text-danger'>   <sup class='font-weight-bold'>*</sup></span>";
                                    }
                                }

                        }

                        ?>
                        <div>
                            <?php
                            // validation message
                            if(isset($_SESSION['first_name'])){
                                echo "
                                <div class='alert alert-danger alert-dismissible' id='fname' style='background-color: red; color: white'>
                                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                  <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['first_name']."
                                </div>
                                ";
                                unset($_SESSION['first_name']);
                            }
                            if(isset($_SESSION['last_name'])){
                                echo "
                                <div class='alert alert-danger alert-dismissible' id='lname' style='background-color: red; color: white'>
                                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                  <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['last_name']."
                                </div>
                                ";
                                unset($_SESSION['last_name']);
                            }
                            if(isset($_SESSION['emails'])){
                                echo "
                                <div class='alert alert-danger alert-dismissible' id='email' style='background-color: red; color: white'>
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
                            if(isset($_SESSION['gender'])){
                                echo "
                                <div class='alert alert-danger alert-dismissible' id='gender' style='background-color: red; color: white'>
                                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                  <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['gender']."
                                </div>
                                ";
                                unset($_SESSION['gender']);
                            }
                            if(isset($_SESSION['pass'])){
                                echo "
                                <div class='alert alert-danger alert-dismissible' id='pass' style='background-color: red; color: white'>
                                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                  <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['pass']."
                                </div>
                                ";
                                unset($_SESSION['pass']);
                            }
                            if(isset($_SESSION['con_pass'])){
                                echo "
                                <div class='alert alert-danger alert-dismissible' id='con_pass' style='background-color: red; color: white'>
                                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                  <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['con_pass']."
                                </div>
                                ";
                                unset($_SESSION['con_pass']);
                            }
                            if(isset($_SESSION['miss'])){
                                echo "
                                <div class='alert alert-danger alert-dismissible' id='miss' style='background-color: red; color: white'>
                                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                  <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['miss']."
                                </div>
                                ";
                                unset($_SESSION['miss']);
                            }
                            if(isset($_SESSION['email_exist'])){
                                echo "
                                <div class='alert alert-danger alert-dismissible' id='email_exist' style='background-color: red; color: white'>
                                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                  <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['email_exist']."
                                </div>
                                ";
                                unset($_SESSION['email_exist']);
                            }
                            if(isset($_SESSION['pas_con'])){
                                echo "
                                <div class='alert alert-danger alert-dismissible' id='pass_con' style='background-color: red; color: white'>
                                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                  <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['pas_con']."
                                </div>
                                ";
                                unset($_SESSION['pas_con']);
                            }
                            if(isset($_SESSION['image'])){
                                echo "
                                <div class='alert alert-danger alert-dismissible' id='image' style='background-color: red; color: white'>
                                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                  <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['image']."
                                </div>
                                ";
                                unset($_SESSION['image']);
                            }
                            if(isset($_SESSION['phone_lentgh'])){
                                echo "
                                <div class='alert alert-danger alert-dismissible' id='phone_lentgh' style='background-color: red; color: white'>
                                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                  <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['phone_lentgh']."
                                </div>
                                ";
                                unset($_SESSION['phone_lentgh']);
                            }
                            if(isset($_SESSION['phone_lentgh2'])){
                                echo "
                                <div class='alert alert-danger alert-dismissible' id='phone_lentgh2' style='background-color: red; color: white'>
                                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                  <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['phone_lentgh2']."
                                </div>
                                ";
                                unset($_SESSION['phone_lentgh2']);
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

                            if(isset($_SESSION['city'])){
                                echo "
                                <div class='alert alert-danger alert-dismissible' id='city' style='background-color: red; color: white'>
                                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                  <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['city']."
                                </div>
                                ";
                                unset($_SESSION['city']);
                            }
                            if(isset($_SESSION['postal'])){
                                echo "
                                <div class='alert alert-danger alert-dismissible' id='postal' style='background-color: red; color: white'>
                                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                  <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['postal']."
                                </div>
                                ";
                                unset($_SESSION['postal']);
                            }
                            if(isset($_SESSION['ps'])){
                                echo "
                                <div class='alert alert-danger alert-dismissible' id='ps' style='background-color: red; color: white'>
                                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                  <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['ps']."
                                </div>
                                ";
                                unset($_SESSION['ps']);
                            }
                            if(isset($_SESSION['db'])){
                                echo "
                                <div class='alert alert-danger alert-dismissible' id='db' style='background-color: red; color: white'>
                                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                  <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['db']."
                                </div>
                                ";
                                unset($_SESSION['db']);
                            }
                            ?>
                        </div>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group col-md-6 float-left">
                                <label>First Name <sup class="text-danger font-weight-bold">*</sup></label>
                                <input type="text" name="first_name" placeholder="Enter First Name" class="form-control" value="<?php if($_POST) {
                                    echo $_POST['first_name'];
                                } ?>">
                            </div>
                            <div class="form-group col-md-6 float-left">
                                <label>Last Name <sup class="text-danger font-weight-bold">*</sup></label>
                                <input type="text" name="last_name" placeholder="Enter Last Name" class="form-control"value="<?php if($_POST) {
                                    echo $_POST['last_name'];
                                } ?>">
                            </div>
                            <div class="form-group col-md-6 float-left">
                                <label>Email <sup class="text-danger font-weight-bold">*</sup></label>
                                <input type="email" name="email" placeholder="Enter Email Address" class="form-control"value="<?php if($_POST) {
                                    echo $_POST['email'];
                                } ?>">
                            </div>
                            <div class="form-group col-md-6 float-left">
                                <label>Phone <sup class="text-danger font-weight-bold">*</sup></label>
                                <input type="text" name="phone" placeholder="Enter Phone Number" class="form-control" value="<?php if($_POST) {
                                    echo $_POST['phone'];
                                } ?>">
                            </div>
                            <div class="form-group col-md-6 float-left">
                                <label>Police Station <sup class="text-danger font-weight-bold">*</sup></label>
                                <input type="text" name="ps" placeholder="Enter Police Station" class="form-control" value="<?php if($_POST) {
                                    echo $_POST['ps'];
                                } ?>">
                            </div>
                            <div class="form-group col-md-6 float-left">
                                <label>Postal/Zip <sup class="text-danger font-weight-bold">*</sup></label>
                                <input type="text" name="postal" placeholder="Enter Post Code" class="form-control" value="<?php if($_POST) {
                                    echo $_POST['postal'];
                                } ?>">
                            </div>
                            <div class="form-group col-md-6 float-left">
                                <label>City <sup class="text-danger font-weight-bold">*</sup></label>
                                <input type="text" name="city" placeholder="Enter City Name" class="form-control" value="<?php if($_POST) {
                                    echo $_POST['city'];
                                } ?>">
                            </div>
                            <div class="form-group col-md-6 float-left">
                                <label>Birth Date <sup class="text-danger font-weight-bold">*</sup></label>
                                <input type="date" name="date_of_birth" class="form-control" value="<?php if($_POST) {
                                    echo $_POST['date_of_birth'];
                                } ?>">
                            </div>
                            <div class="form-group col-md-6 float-left">
                                <label>Password <sup class="text-danger font-weight-bold">*</sup></label>
                                <input type="password" name="password"  placeholder="Enter Your Password" class="form-control">
                            </div>
                            <div  class="form-group  col-md-6 float-left">
                                <label>Confirm Password <sup class="text-danger font-weight-bold">*</sup></label>
                                <input type="password" name="cpassword" id="confirmPassword" placeholder="Confirm Password" class="form-control" autocomplete="off" />
                            </div>
                            <div class="form-group col-md-6 float-left">
                                <label>Gender <sup class="text-danger font-weight-bold">*</sup></label><br/>
                                <input type="radio" checked name="gender" value="Male"> Male
                                <input type="radio" name="gender" value="Fe Male"> Fe-Male
                            </div>
                            <div class="form-group col-md-6 float-left">
                                <label>Image <sup class="text-danger font-weight-bold">*</sup></label>
                                <input type="file" name="image" class="form-control"  value="<?php if($_POST) {
                                    echo $_POST['image'];
                                } ?>">
                            </div>
                            <div class="form-group col-md-6 float-left">
                                <label class="p-2"></label>
                                <input type="submit" name="user_reg" class="btn btn-info btn-block" value="Submit">
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <p class="float-right">All Ready Have Account <span><a href="login.php" class="text-decoration-none">Login Here</a></span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="fotter bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <p class="text-center p-2 text-white">This site is created By @ <b> <i>Md. Mehedi hasan</i></b></p>
            </div>
        </div>
    </div>
</section>
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/bootstrap.js"></script>
<script>
    // validation
    $(function() {
        setTimeout(function() { $("#fname").fadeOut(1500); }, 3000)
    })
    $(function() {
        setTimeout(function() { $("#lname").fadeOut(1500); }, 3000)
    })
    $(function() {
        setTimeout(function() { $("#email").fadeOut(1500); }, 3000)
    })
    $(function() {
        setTimeout(function() { $("#phone").fadeOut(1500); }, 3000)
    })
    $(function() {
        setTimeout(function() { $("#pass").fadeOut(1500); }, 3000)
    })
    $(function() {
        setTimeout(function() { $("#con_pass").fadeOut(1500); }, 3000)
    })
    $(function() {
        setTimeout(function() { $("#error").fadeOut(1500); }, 3000)
    })
    $(function() {
        setTimeout(function() { $("#email_exist").fadeOut(1500); }, 5000)
    })
    $(function() {
        setTimeout(function() { $("#pass_con").fadeOut(1500); }, 3000)
    })
    $(function() {
        setTimeout(function() { $("#image").fadeOut(1500); }, 3000)
    })
    $(function() {
        setTimeout(function() { $("#miss").fadeOut(1500); }, 3000)
    })
    $(function() {
        setTimeout(function() { $("#phone_lentgh").fadeOut(1500); }, 3000)
    })
    $(function() {
        setTimeout(function() { $("#phone_lentgh2").fadeOut(1500); }, 3000)
    })

    $(function() {
        setTimeout(function() { $("#city").fadeOut(1500); }, 3000)
    })
    $(function() {
        setTimeout(function() { $("#ps").fadeOut(1500); }, 3000)
    })
    $(function() {
        setTimeout(function() { $("#postal").fadeOut(1500); }, 3000)
    })
    $(function() {
        setTimeout(function() { $("#db").fadeOut(1500); }, 3000)
    })


</script>
</body>
</html>


