
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
<body>
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
                <?php
                if (isset($_GET['profile'])) // get membet profile by member id
                {
                    $id = $_GET['profile'];

                    $sql = "SELECT * FROM team_member WHERE id = '$id'";  // view member profile
                    $res = mysqli_query($connect, $sql); // connect with query and database

                    $data = mysqli_fetch_assoc($res);
                }
                ?>
                <h2 class="mt-5 font-weight-bold"><?php echo $data['name'];?></h2>

                <h4 class="mt-5"><span class="text-info">Our Services :</span> <a href="hajj_packages.php" class="btn col-2" style="background-color: #37D117; color: white;">Hajj</a> <a href="umrah_packages.php" class="btn col-2" style="background-color: #FE6700; color: white;">Umrah</a> <a href="tours.php" class="btn col-2" style="background-color: #52AAF4; color: white;">Islamic Tours</a></h4>
            </div>
        </div>
    </div>
</section>

<section class="main_content">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 mt-4 mb-5">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-4 col-sm-12 float-left">
                            <img src="images/<?php echo $data['image'];?>" style="height: 250px; width: 100%">
                            <h3 class="mt-2 font-weight-bold text-center">Position: <br/><?php echo $data['position'];?></h3>
                        </div>
                        <div class="col-md-8 col-sm-12 float-left">
                            <div class="form-group">
                                <label class="font-weight-bold text-capitalize">Name <span class="ml-3">:</span>  <?php echo $data['name'];?></label>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Phone <span class="ml-3">:</span> <?php echo $data['phone'];?></label>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Email <span class="ml-4">:</span>  <?php echo $data['email'];?></label>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Brief Description : <br/><span class="ml-1 font-weight-normal text-justify"> <?php echo $data['application'];?></span> </label>
                            </div>
                        </div>
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
</body>
</html>


