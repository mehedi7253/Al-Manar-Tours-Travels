<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/14/2020
 * Time: 8:59 PM
 */
?>
<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/1/2020
 * Time: 7:18 PM
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
                <?php
                //select all single package data
                if (isset($_GET['single']))
                {
                    $id = $_GET['single'];

                    $sql = "SELECT * FROM team_member, multi_menu, package_price, multi_menu_package WHERE 
                                multi_menu_package.multi_menu_id = multi_menu.id AND
                                multi_menu_package.package_type_id = package_price.id AND
                                multi_menu_package.member_id = team_member.id AND 
                                multi_menu_package.multi_menu_id = '$id'";
                    $res = mysqli_query($connect, $sql); // connect with query and database

                    $data = mysqli_fetch_assoc($res);
                }
                ?>
                <h3 class="mt-5 font-weight-bold"><?php echo $data['multi_menu_name'];?></h3>
                <h4 class="mt-5"><span class="text-info">Our Services :</span> <a href="hajj_packages.php" class="btn col-2" style="background-color: #37D117; color: white;">Hajj</a> <a href="umrah_packages.php" class="btn col-2" style="background-color: #FE6700; color: white;">Umrah</a> <a href="tours.php" class="btn col-2" style="background-color: #52AAF4; color: white;">Islamic Tours</a></h4>
            </div>
        </div>
    </div>
</section>

<section class="main_content">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 mb-5 mt-5">
                <div class="col-md-7 col-sm-12 float-left">
                    <div class="card">
                        <div class="card-header" style="background-color: #F7F7F7">
                            <h3 class="text-center font-weight-bold" style="color: #0983F7"><?php echo $data['multi_menu_name'];?></h3>
                        </div>
                        <div class="card-body" style="background-color: #F7F7F7">
                            <label class="font-weight-bold">Package Duration: <span class="font-weight-normal text-capitalize"><?php echo $data['duration'];?></span></label>
                            <p><span class="font-weight-bold">Package Details:</span> <?php echo $data['application'];?></p>                            <label class="font-weight-bold mt-4">Package Price: <span class="font-weight-bold text-capitalize text-primary "><?php echo number_format($data['price'], 2);?> Taka (Per Person)</span></label><br/>
                            <label class="font-weight-bold mt-4">Pre-Registration Info: <span class="font-weight-normal text-capitalize">
                                            <li class="ml-3">NID (National Id Card) Copy.</li>
                                            <li class="ml-3">Govt. Pre-registration Fee.</li>
                                            <li class="ml-3">Mobile Number.</li>
                                   </span>
                            </label><br/>
                            <div style="height: 100px; width: 100%; background-color: #005cbf">
                                <h3 class="text-center text-white text-capitalize font-weight-bold p-4">Shariah Consultant</h3>
                            </div>
                            <br/>
                            <label class="font-weight-bold ml-3 mt-5"><?php echo $data['name'];?></label><br/>
                            <label class="ml-3"><?php echo $data['position'];?></label><br/>
                        </div>
                        <div class="card-footer">
                            <a class="btn btn-info float-right" href="booking.php">Book Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-sm-12 float-left">
                    <!--Carousel Wrapper-->
                    <div id="carousel-example-2" class="carousel slide carousel-fade z-depth-1-half" data-ride="carousel">
                        <!--Indicators-->
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example-2" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example-2" data-slide-to="1"></li>
                            <li data-target="#carousel-example-2" data-slide-to="2"></li>
                        </ol>
                        <!--/.Indicators-->
                        <!--Slides-->
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active">
                                <div class="view">
                                    <img class="d-block w-100" src="images/5d99d9cc21f2a.png" alt="First slide" style="height: 250px">
                                    <div class="mask rgba-black-light"></div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <!--Mask color-->
                                <div class="view">
                                    <img class="d-block w-100" src="images/shutterstock-1281533530-400x300.png" alt="Second slide" style="height: 250px">
                                    <div class="mask rgba-black-light"></div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <!--Mask color-->
                                <div class="view">
                                    <img class="d-block w-100" src="images/Preaching-Authentic-Islam-in-Bangla-2-400x300.jpg" alt="Third slide" style="height: 250px">
                                    <div class="mask rgba-black-light"></div>
                                </div>
                            </div>
                        </div>
                        <!--/.Slides-->
                        <!--Controls-->
                        <a class="carousel-control-prev" href="#carousel-example-2" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carousel-example-2" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                        <!--/.Controls-->
                    </div>
                    <!--/.Carousel Wrapper-->

                    <div class="card mt-3">
                        <div class="card-header">
                            <h3 class="text-center">Send Message</h3>
                        </div>
                        <div class="card-body">
                            <?php
                            if (isset($_POST['btn']))
                            {
                                $name  = $_POST['name'];
                                $email = $_POST['email'];
                                $msg   = $_POST['message'];

                                if ($name && $email && $msg)
                                {
                                    $create = @date('Y-m-d H:i:s');
                                    $sql     = "INSERT INTO public_msg (name, email, message, date) VALUES ('$name','$email', '$msg', '$create')"; // insert booking data into database
                                    $res_msg = mysqli_query($connect, $sql); // connect with query and database

                                    echo "<span class='text-success'>Message Sent Successful</span>";
                                }

                            }
                            ?>
                            <form action="" method="post">
                                <div class="form-group">
                                    <label>Name:</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter Your Name">
                                </div>
                                <div class="form-group">
                                    <label>Email:</label>
                                    <input type="email" name="email" class="form-control" placeholder="Enter Your Email">
                                </div>
                                <div class="form-group">
                                    <label>Message:</label>
                                    <textarea name="message" class="form-control" placeholder="Enter Your Message"></textarea>
                                </div>
                                <div class="form-group">
                                    <label></label>
                                    <input type="submit" name="btn" class="btn btn-success" value="Send">
                                </div>
                            </form>
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



