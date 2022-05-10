<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/3/2020
 * Time: 10:59 AM
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
                            <h3 class="text-capitalize text-dark">Update <a href="dashboard.php" class="text-info text-decoration-none"><?php echo $userdata['first_name'].' '.$userdata['last_name'];?></a> Profile</h3>
                        </div>
                        <div class="card-body">
                            <?php
                            // validation message
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
                            <?php
                                if (isset($_POST['user_update']))
                                {
                                    $id         = $_POST['id'];
                                    $first_name = $_POST['first_name'];
                                    $last_name  = $_POST['last_name'];
                                    $phone      = $_POST['phone'];
//                                    $address    = $_POST['address'];
                                    $city       = $_POST['city'];
                                    $ps         = $_POST['ps'];
                                    $postal     = $_POST['postal'];
                                    $birth      = $_POST['date_of_birth'];
                                    $gender     = $_POST['gender'];


                                    if ($first_name == '') {
                                        $_SESSION['first_name'] = 'First Name Must Not Empty.!!';
                                    } elseif ($last_name == '') {
                                        $_SESSION['last_name'] = 'Last Name Must Not Empty.!!';
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
                                    }else{
                                        //update profile
                                        if ($first_name && $last_name  && $phone  && $city && $ps && $birth && $gender) {
                                            $sql = "UPDATE users SET 
                                                    first_name    = '$first_name',
                                                    last_name     = '$last_name',
                                                    phone         = '$phone',
                                                    city          = '$city',
                                                    ps            = '$ps',
                                                    postal        = '$postal',
                                                    date_of_birth = '$birth',
                                                    gender        = '$gender'
                                                    
                                                    WHERE id = '$id'
                                                ";
                                            $res = mysqli_query($connect, $sql);

                                            $_SESSION['success'] = 'Profile Update Successful';
                                            echo "<script>document.location.href='update_profile.php'</script>";
                                        }else{
                                            $_SESSION['error'] = 'Profile Update Failed...!!';
                                            echo "<script>document.location.href='update_profile.php'</script>";
                                        }
                                    }

                            }
                            ?>
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

                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group col-md-6 float-left">
                                    <label>First Name</label>
                                    <input type="text" name="id" hidden placeholder="Enter First Name" class="form-control" value="<?php echo $userdata['id'];?>">
                                    <input type="text" name="first_name" placeholder="Enter First Name" class="form-control" value="<?php echo $userdata['first_name'];?>">
                                </div>
                                <div class="form-group col-md-6 float-left">
                                    <label>Last Name</label>
                                    <input type="text" name="last_name" placeholder="Enter Last Name" class="form-control" value="<?php echo $userdata['last_name'];?>">
                                </div>
                                <div class="form-group col-md-6 float-left">
                                    <label>Email</label>
                                    <input type="email"  placeholder="Enter Email Address" disabled class="form-control"value="<?php echo $userdata['email']; ?>">
                                </div>
                                <div class="form-group col-md-6 float-left">
                                    <label>Phone</label>
                                    <input type="number" name="phone" placeholder="Enter Phone Number" class="form-control" value="<?php echo $userdata['phone']; ?>">
                                </div>
<!--                                <div class="form-group col-md-12 float-left">-->
<!--                                    <label> Address</label>-->
<!--                                    <textarea name="address" placeholder="Enter Your Street Address" class="form-control">--><?php //echo $userdata['address']; ?><!--</textarea>-->
<!--                                </div>-->
                                <div class="form-group col-md-6 float-left">
                                    <label>Police Station</label>
                                    <input type="text" name="ps" placeholder="Enter Police Station" class="form-control" value="<?php echo $userdata['ps']; ?>">
                                </div>
                                <div class="form-group col-md-6 float-left">
                                    <label>City</label>
                                    <input type="text" name="city" placeholder="Enter City Name" class="form-control" value="<?php echo $userdata['city'];?>">
                                </div>
                                <div class="form-group col-md-6 float-left">
                                    <label>Postal/Zip</label>
                                    <input type="text" name="postal" placeholder="Enter Email Address" class="form-control" value="<?php echo $userdata['postal']; ?>">
                                </div>
                                <div class="form-group col-md-6 float-left">
                                    <label>Birth Date</label>
                                    <input type="date" name="date_of_birth" class="form-control" value="<?php echo $userdata['date_of_birth']; ?>">
                                </div>
                                <div class="form-group col-md-6 float-left">
                                    <label>Gender </label><br/>
                                    <input type="radio" checked name="gender" value="Male"> Male
                                    <input type="radio" name="gender" value="Fe Male"> Fe-Male
                                </div>

                                <div class="form-group col-md-6 float-left">
                                    <label class="p-2"></label>
                                    <input type="submit" name="user_update" class="btn btn-info btn-block" value="Update">
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <a class="float-right btn btn-info" href="dashboard.php"> Profile</a>
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


