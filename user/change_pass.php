<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/3/2020
 * Time: 10:59 AM
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
                            <h3 class="text-capitalize text-dark">Change password</h3>
                        </div>
                        <div class="card-body">
                            <?php
                            // check validation
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
                            // change password
                            if (isset($_POST['change_pass'])){
                                $old_pass = $_POST['old_pass'];
                                $new_pass = $_POST['password'];

                                $has_pass = hash('sha256', $old_pass); // hash password
                                $new_pass_hash = hash('sha256', $new_pass); // passsword hash into sha256

                                if ($old_pass == ''){
                                    echo "<span class='text-danger'>Type Your Old Password</span><br/>";
                                }elseif ($new_pass == ''){
                                    echo "<span class='text-danger'>Type Your New Password</span><br/>";
                                }elseif (preg_match('/\s/', $new_pass)) {
                                    echo "<span class='text-danger'>Password Must Have No Space</span><br/>";
                                }else{
                                    if ($old_pass && $has_pass){
                                        $sql = "SELECT * FROM users WHERE id = '$userdata[id]' AND password = '$has_pass'"; // check password hash
                                        $result = mysqli_query($connect, $sql); // connect with query and database

                                        $up = mysqli_fetch_assoc($result);

                                        if ($up !=0){
                                            $change_pass = "UPDATE users SET password = '$new_pass_hash' WHERE id = '$userdata[id]'"; // update password
                                            $res_change  = mysqli_query($connect, $change_pass);// connect with query and database

                                            $_SESSION['success'] = 'Password Change Successful';
                                            echo "<script>document.location.href='change_pass.php'</script>";
                                        }else{
                                            $_SESSION['error'] = 'Password Does Not Match With Current Password';
                                            echo "<script>document.location.href='change_pass.php'</script>";                                        }
                                    }
                                }
                            }
                            ?>

                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Type Your Old Password</label>
                                    <input type="password" placeholder="Enter Old Password" name="old_pass" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Type New Password</label>
                                    <input type="password" placeholder="Enter New Password" name="password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="change_pass" class="btn btn-success" value="Change Password">
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
</body>
</html>



