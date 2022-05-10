<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/7/2020
 * Time: 10:15 AM
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
                <h3 class="mt-5 font-weight-bold">Blog</h3>
                <h4 class="mt-5"><span class="text-info">Our Services :</span> <a href="hajj_packages.php" class="btn col-2" style="background-color: #37D117; color: white;">Hajj</a> <a href="umrah_packages.php" class="btn col-2" style="background-color: #FE6700; color: white;">Umrah</a> <a href="tours.php" class="btn col-2" style="background-color: #52AAF4; color: white;">Islamic Tours</a></h4>
            </div>
        </div>
    </div>
</section>

<section class="main_content">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-12 float-left mt-5 mb-5">
                <?php
                    if (isset($_GET['blog']))
                    {
                        $id = $_GET['blog'];

                        $sql = "SELECT * FROM blogs WHERE blog_id = $id"; // get all blog by id
                        $res = mysqli_query($connect, $sql); // connect with query and database
                        $blog = mysqli_fetch_assoc($res);
                    }
                ?>
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center mt-3"><?php echo $blog['title'];?></h2>
                        <img src="images/<?php echo $blog['image']?>" class="card-img-top mt-3" style="height: 250px">
                    </div>
                    <div class="card-body">
                        <p class="text-justify mt-2"><?php echo $blog['application'];?></p>
                    </div>
                    <div class="card-footer">
                        <p class="font-italic float-right font-weight-normal" style="font-size: 12px; color: darkred; margin-left: 5%;">Posted On <?php echo date('M ,Y', strtotime($blog['date']));?> By Admin</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12 float-left mt-5 mb-5">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">More Blogs</h3>
                    </div>
                    <?php
                        $sql_get_blog = "SELECT * FROM blogs WHERE status = '0'"; //fetch all data from blog table
                        $res_blog     = mysqli_query($connect, $sql_get_blog); //execute query
                     while ($row = mysqli_fetch_assoc($res_blog)){?>
                        <div class="card-body" style="border-bottom: 1px solid silver">
                            <img class="float-left" src="images/<?php echo $row['image'];?>"  style="height: 100px; width: 100px; margin: 9px">
                            <p style="text-align: justify; padding: 3px; margin-top: -40p%">
                                <span class="font-weight-bold"><?php echo $row['title'];?></span><br/>
                                <span style="font-size: 12px; color: darkred;">Posted On <?php echo date('M ,Y', strtotime($row['date']));?> By admin</span><br/>

                                <?php
                                    $blog_id = $row['blog_id'];
                                    $desc = $row['application'];
                                    $strcut = substr($desc,0,200);
                                    $desc = substr($strcut, 0, strrpos($strcut, ' ')).'....'.'<a href="single_page_blog.php?blog='.$blog_id.'" class="text-decoration-none">Full Blog</a>';
                                    echo $desc;
                                ?>
                            </p>
                        </div>
                    <?php }?>
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







