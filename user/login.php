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
    <title>User Login</title>
    <link rel="stylesheet" href="../assets/style/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="../assets/style/main.css" type="text/css">
    <link rel="icon" href="../images/logo.JPG">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>
<style>
    .cust_log{
        height: auto;
        width:100%;
        background-image: url("../images/banner.jpg");
        background-size: 100% 100%;
        background-repeat: no-repeat;
    }
    .admin_card{
        margin-top: 100px;
        margin-bottom: 150px;
    }
</style>
<body class="cust_log">
<section class="header-top" style="background-color: silver">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="col-md-7 col-sm-12 float-left mt-2">
                    <p class="text-info tewji"><a class="text-decoration-none text-dark font-weight-bold" href="event.php">Event</a>  | <a class="text-decoration-none text-dark font-weight-bold" href="gallery.php">Gallery</a>   <span class="text-dark ml-5"> <i class="fas fa-phone"></i> 01941697253</span> <span class="ml-4 text-dark"><i class="far fa-envelope"></i> <span class="text-dark">mdmehedihasan221@gmail.com</span></span></p>
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
   <?php include "nav.php"?>
</section>
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card admin_card">
                <div class="card-header">
                    <h1 class="text-center">User Login</h1>
                    <?php

                    //generel user login
                         if($_POST) {
                             $email = $_POST['email'];
                             $password = $_POST['password'];

                             if ($email == "") {
                                 echo "<span class='text-danger'>* Email Field is Required</span> <br />";
                             }

                             if ($password == "") {
                                 echo "<span class='text-danger'>* Password Field is Required </span> <br />";
                             }

                             // check user email
                             if ($email && $password) {
                                 if ($email == 'admin@gmail.com') {
                                     if (isset($_SESSION['email'])) {
                                         header('Location: ../admin.admin_dashboard.php');
                                     }
                                     $sql = "SELECT * FROM admin WHERE email ='$email' AND password = '$password'";

                                     $result = mysqli_query($connect, $sql);

                                     $row = mysqli_num_rows($result);
                                     if ($row == 1) {
                                         $_SESSION['email'] = $email;
                                         echo "<script>document.location.href='../admin/admin_dashboard.php'</script>";
                                     } else {
                                         echo "<span class='text-danger'>user does not exists</span>";
                                     }
                                 } else {
                                     if (userExists($email) == TRUE) {
                                         $login = login($email, $password);
                                         if ($login) {
                                             $userdata = userdata($email);

                                             $_SESSION['id'] = $userdata['id'];

                                             echo "<script>document.location.href='dashboard.php'</script>";
                                             exit();

                                         } else {
                                             echo "<span class='text-danger'>Incorrect Email/password combination</span>";
                                         }
                                     } else {
                                         echo "<span class='text-danger'>User does not exists</span>";
                                     }
                                 }
                             }

                         }
                    ?>

                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" name="email" class="form-control" placeholder="Email">
                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" name="password" class="form-control" placeholder="password">
                        </div>
                        <br />
                        <div>
                            <button class="btn btn-success col-4" name="login" type="submit">Login</button>
                            <button class="btn btn-danger col-4"  type="reset">Cancel</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="d-flex  justify-content-center links">
                        Don't have an account?<a href="registration.php" class="text-decoration-none"> <span class="ml-2">Registration Now</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="fotter bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <p class="text-center p-2 text-white">This site is created By @ <b> <i>Md. Mehedi Hasan</i></b></p>
            </div>
        </div>
    </div>
</section>

<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/bootstrap.js"></script>
<script src="../assets/js/topdown.js"></script>
</body>
</html>

