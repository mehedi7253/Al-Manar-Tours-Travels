<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/6/2020
 * Time: 8:18 PM
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
                <h3 class="mt-5 font-weight-bold">Event</h3>
                <h4 class="mt-5"><span class="text-info">Our Services :</span> <a href="hajj_packages.php" class="btn col-2" style="background-color: #37D117; color: white;">Hajj</a> <a href="umrah_packages.php" class="btn col-2" style="background-color: #FE6700; color: white;">Umrah</a> <a href="tours.php" class="btn col-2" style="background-color: #52AAF4; color: white;">Islamic Tours</a></h4>
            </div>
        </div>
    </div>
</section>

<section class="main_content">
    <div class="container">
        <div class="row">
            <?php
            $sql_get_blog = "SELECT * FROM blogs WHERE status = '0'"; //fetch all data from blog table
            $res_blog     = mysqli_query($connect, $sql_get_blog); //execute query
            ?>

            <div class="col-md-12 col-sm-12 mb-5 mt-5">
                <h3 class="text-center font-weight-bold">Our Blogs</h3>
                <?php while ($row = mysqli_fetch_assoc($res_blog)){?>
                    <div class="col-md-12 col-sm-12 mt-4 float-left">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-md-5 mx-auto float-left p-2">
                                    <div class="card">
                                        <img src="images/<?php echo $row['image']?>" class="card-img-top" style="height: 200px">
                                    </div>
                                </div>
                                <div class="col-md-7 col-sm-12 float-left">
                                    <p class="font-weight-bold mt-3"><?php echo $row['title']?></p>
                                    <p class="font-italic font-weight-normal" style="font-size: 12px; color: darkred;margin-top: -3%; margin-left: 5%;">Posted On <?php echo date('M ,Y', strtotime($row['date']));?> By Admin</p>
                                    <p class="text-justify">
                                        <?php
                                            $blog_id = $row['blog_id'];
                                            $desc = $row['application'];
                                            $strcut = substr($desc,0,420); // after 430 word full content will not seen
                                            $desc = substr($strcut, 0, strrpos($strcut, ' ')).'....'.'<a href="single_page_blog.php?blog='.$blog_id.'" class="text-decoration-none">Read More</a>';
                                            echo $desc;
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }?>
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






