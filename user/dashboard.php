<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 10/29/2020
 * Time: 11:06 AM
 */

    require_once '../php/config.php';

    if(not_logged_in() === TRUE) {
        header('location: login.php'); // check user login
    }

    $userdata = getUserDataByUserId($_SESSION['id']); // get user all data

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
                            <h3 class="text-capitalize text-info"><?php echo $userdata['first_name'].' '.$userdata['last_name'];?> Informain</h3>
                        </div>
                        <div class="card-body">
                            <div class="col-md-4 col-sm-12 float-left">
                                <img src="../images/<?php echo $userdata['image'];?>" class="img-fluid" style="height: 200px; width: 200px;">
                            </div>

                            <div class="col-md-8 col-sm-12 float-left">
                                <div class="form-group">
                                    <label class="font-weight-bold text-capitalize">Name <span class="ml-2">:</span>  <?php echo $userdata['first_name'].' '.$userdata['last_name'];?></label>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Email <span class="ml-3">:</span>  <?php echo $userdata['email'];?></label>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold text-capitalize">Phone <span class="ml-2">:</span>  <?php echo $userdata['phone'];?></label>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold text-capitalize">Post <span class="ml-4">:</span>  <?php echo $userdata['ps'];?></label>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold text-capitalize">City <span class="ml-4">:</span>  <?php echo $userdata['city'];?></label>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold text-capitalize">Post Code <span class="ml-1">:</span>  <?php echo $userdata['postal'];?></label>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold text-capitalize">Full Address <span class="ml-2">:</span> <?php echo $userdata['ps'].', '.$userdata['postal'].', '.$userdata['city'];?></label>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold text-capitalize">Birth Date <span class="ml-2">:</span>  <?php echo date('d - M - Y', strtotime($userdata['date_of_birth']))?></label>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold text-capitalize">Gender <span class="ml-2">:</span> <?php echo $userdata['gender'];?></label>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a class="float-right btn btn-info" href="update_profile.php">Update Profile</a>
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

