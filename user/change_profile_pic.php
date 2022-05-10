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
                            <h3 class="text-capitalize text-dark">Change Profile Picture</h3>
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
                            if (isset($_POST['pic'])){
                                $fileinfo = PATHINFO($_FILES['image']['name']); // file info
                                $newfilename  = $fileinfo['filename']. "." .$fileinfo['extension']; // get file extention
                                move_uploaded_file($_FILES['image']['tmp_name'],"../images/" .$newfilename); // get file path and upload image into path
                                $location = $newfilename; // store image into path

                                $update_profie_pic = "UPDATE users SET image = '$location' WHERE id = '$userdata[id]'"; // image upload into database
                                mysqli_query($connect, $update_profie_pic); // connect with query and database


                                $sql = "SELECT * FROM users WHERE id = '$userdata[id]'"; // get user id
                                $records = mysqli_query($connect, $sql); // connect with query and database
                                $count = mysqli_num_rows($records);

                                if ($count == 1) {
                                    $row = mysqli_fetch_array($records);
                                    echo " $userdata[image]";

                                    echo "<script>document.location.href='change_profile_pic.php'</script>";

                                }
                            }
                            ?>
                            <div class="text-center">
                                <img src="../images/<?php echo $userdata['image'];?>" class="img-fluid" style="height: 200px; width: 200px; border-radius: 50%">
                            </div>
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Chose Photo</label>
                                    <input type="file" name="image" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="pic" class="btn btn-success" value="Change Profile Pic">
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




