<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/13/2020
 * Time: 9:49 PM
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
    <title>Al Manar Travels & Tours</title>
    <link rel="stylesheet" href="assets/style/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="assets/style/main.css" type="text/css">
    <link rel="stylesheet" href="assets/style/footer.css" type="text/css">
    <link rel="icon" href="images/logo.JPG">
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
    .card_top{
        opacity: .8;
        overflow: hidden;
        background: rgb(0, 0, 0);
        background: rgba(0, 0, 0, 0.5);
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
                if (isset($_GET['sub_tour'])){
                    $id = $_GET['sub_tour'];

                    $sql = "SELECT * FROM sub_tour WHERE tour_id= $id";
                    $res = mysqli_query($connect, $sql);

                }
            ?>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 mt-3">
                        <?php
                            $sql_tour = "SELECT tour.title AS TourTile, tour.description As TourDdesc FROM tour WHERE tour_id = $id";
                            $res_tour = mysqli_query($connect, $sql_tour);

                            $data = mysqli_fetch_assoc($res_tour);
                        ?>
                        <h3 class="text-center font-weight-bold mt-5"><?php echo $data['TourTile'];?></h3>
                        <p class="text-justify font-weight-bold mt-3" style="line-height: 32px"><?php echo $data['TourDdesc'];?></p>
                    </div>
                </div>
            </div>
            <?php
                $i =1;
            while ($row = mysqli_fetch_assoc($res)){?>
                <div class="col-md-4 col-sm-12 float-left mt-5 mb-5">
                    <div class="card">
                        <div class="card-header">
                            <p class="text-center"> <?php echo $row['title'];?> <?php echo $i++;?> </p>
                        </div>
                        <div class="card-body">
                            <img src="images/<?php echo $row['image'];?>" class="card-img-top" style="height: 250px">
                            <hr style="border: 1px solid silver"/>
                            <h5 class="text-center font-weight-bold"><?php echo $row['title'];?></h5>
                            <p class="text-center font-weight-bold">Duration: <?php echo $row['duration'];?></p>
                            <p class="text-center font-weight-bold text-capitalize"> Package: <?php echo $row['package'];?></p>
                            <p class="text-center font-weight-bold">Tour Type: <?php echo $row['tour_type'];?></p>
                            <p class="text-center font-weight-bold">Price: <?php echo number_format($row['price'], 2);?> T.K</p><br/>
                        </div>
                        <div class="card-footer">
                            <a class="btn btn-primary float-right" href="tour_book.php?book=<?php echo $row['sub_tour_id'];?>">Book Now</a>
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









