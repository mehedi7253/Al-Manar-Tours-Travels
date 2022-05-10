<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/12/2020
 * Time: 10:38 PM
 */

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
    .slider {
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
                <h3 class="mt-5 font-weight-bold">Islamic Tour</h3>
                <h4 class="mt-5"><span class="text-info">Our Services :</span> <a href="hajj_packages.php" class="btn col-2" style="background-color: #37D117; color: white;">Hajj</a> <a href="umrah_packages.php" class="btn col-2" style="background-color: #FE6700; color: white;">Umrah</a> <a href="tours.php" class="btn col-2" style="background-color: #52AAF4; color: white;">Islamic Tours</a></h4>
            </div>
        </div>
    </div>
</section>

<section class="main_content">
    <div class="container">
        <div class="row">

            <?php
                $sql = "SELECT * FROM tour"; // get all
                $res = mysqli_query($connect, $sql); // connect with query and database

            while ($row = mysqli_fetch_assoc($res)){?>
                <div class="col-md-4 col-sm-12 float-left mt-5 mb-5">
                    <div class="card">
                         <img src="images/<?php echo $row['image'];?>" class="card-img-top" style="height: 200px">
                        <div class="card-body">
                            <h6 class="mt-3 font-weight-bold"><?php echo $row['title'];?></h6>
                            <hr style="border-bottom: 1px solid silver"/>
                            <p class=" text-justify"><?php echo $row['description'];?></p>
                            <p class="text-center"><a class="btn btn-info" href="sub_tour.php?sub_tour=<?php echo $row['tour_id'];?>">Details</a></p>
                        </div>
                    </div>
                </div>

            <?php }?>

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








