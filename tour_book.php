<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/13/2020
 * Time: 10:11 PM
 */
?>
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

                <h2 class="mt-5 font-weight-bold">Islamic Tour-Book Now</h2>

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

                        //get book data
                        if (isset($_GET['book'])){
                             $id = $_GET['book'];

                             $sql_subtour = "SELECT * FROM sub_tour WHERE sub_tour_id = $id";
                             $res_subtour = mysqli_query($connect, $sql_subtour);

                             $data = mysqli_fetch_assoc($res_subtour);
                        }
                        // check login user
                        if (not_logged_in() === true)
                        {
                            if (isset($_POST['book'])) {
                                $_SESSION['login'] = 'You Have To Login First Before Booking.....Try Again';
                            }
                        }else{
                            if (isset($_POST['book'])) {

                                $sub_tour_id = $_POST['sub_tour_id'];
                                $user_id     = $_POST['user_id'];
                                $name        = $_POST['name'];
                                $email       = $_POST['email'];
                                $phone       = $_POST['phone'];
                                $person      = $_POST['person'];

                                if ($name == ''){
                                    echo "<span class='text-danger'>Please Enter Name</span><br/>";
                                }elseif ($email == ''){
                                    echo "<span class='text-danger'>Please Enter Email</span><br/>";
                                }elseif ($phone == ''){
                                    echo "<span class='text-danger'>Please Enter Phone Number</span><br/>";
                                }elseif ($person == ''){
                                    echo "<span class='text-danger'>Please Enter Person's</span><br/>";
                                }else{

                                    $create = @date('Y-m-d H:i:s');

                                    $tour_book = "INSERT INTO tour_booking (user_id, sub_tour_id, name, email, phone, person, date) VALUES ('$user_id', '$sub_tour_id', '$name', '$email', '$phone', '$person', '$create')";
                                    $res_tour  = mysqli_query($connect, $tour_book);

                                    if ($res_tour){
                                        $_SESSION['success'] = 'Booking Successful';
                                    }else{
                                        $_SESSION['success'] = 'Booking Failed...!!';
                                    }
                                }

                            }
                        }
                        ?>

                        <?php
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
                            <div class="form-group col-md-6 col-sm-12 float-left">
                                <label> Tour Name <sup class="text-danger font-weight-bold">*</sup></label>
                                <input hidden type="text" name="user_id" value="<?php if (isset($userdata)){echo $userdata['id'];}?>">
                                <input type="text" name="sub_tour_id" hidden class="form-control" value="<?php echo $data['sub_tour_id']?>">
                                <input disabled class="form-control" value="<?php echo $data['title']?>">
                            </div>
                            <div class="form-group col-md-6 col-sm-12 float-left">
                                <label> Tour Type <sup class="text-danger font-weight-bold">*</sup></label>
                                <input  disabled class="form-control" value="<?php echo $data['tour_type']?>">
                            </div>
                            <div class="form-group col-md-6 col-sm-12 float-left">
                                <label> Tour Duration <sup class="text-danger font-weight-bold">*</sup></label>
                                <input  disabled class="form-control" value="<?php echo $data['duration']?>">
                            </div>
                            <div class="form-group col-md-6 col-sm-12 float-left">
                                <label> Package <sup class="text-danger font-weight-bold">*</sup></label>
                                <input  disabled class="form-control" value="<?php echo $data['package']?>">
                            </div>
                            <div class="form-group col-md-6 col-sm-12 float-left">
                                <label> Package Price <sup class="text-danger font-weight-bold">*</sup></label>
                                <input  disabled class="form-control" value="<?php echo number_format($data['price'], 2)?> T.K" >
                            </div>

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
                                <label> Number Of Person <sup class="text-danger font-weight-bold">*</sup></label>
                                <input type="number" name="person" placeholder="Enter Number of person Want to go" class="form-control" value="<?php if($_POST) {
                                    echo $_POST['phone'];
                                } ?>">
                            </div>

                            <div class="form-group">
                                <label class=""></label>
                                <input type="submit" name="book" class="btn mt-3 btn-primary btn-block" value="Book Now">
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
        setTimeout(function() { $("#login").fadeOut(1500); }, 5000)
    })
</script>
</body>
</html>




