<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/3/2020
 * Time: 7:35 PM
 */

    require_once 'php/config.php';
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

        .hajj{
            background-image: url("images/religious-2262799_1920-1170x658.jpg");
            height: 400px;
            width: 100%;
            background-repeat: no-repeat;
            background-size: 100% 100%;
            border: 1px solid black;
            opacity: .8;
            overflow: hidden;
        }
        .hajj:hover{
            opacity: 1;
            background: rgb(0, 0, 0);
            background: rgba(0, 0, 0, 0.5);
            background-image: url("images/religious-2262799_1920-1170x658.jpg");
            height: 400px;
            width: 100%;
            background-repeat: no-repeat;
            background-size: 100% 100%;
            cursor: pointer;
        }
        .umrah{
            background-image: url("images/l-MAG-0218-Mecca-Disaster-1170x658.jpg");
            height: 400px;
            width: 100%;
            background-repeat: no-repeat;
            background-size: 100% 100%;
            border: 1px solid black;
            opacity: .8;
            overflow: hidden;
        }
        .umrah:hover{
            opacity: 1;
            background: rgb(0, 0, 0);
            background: rgba(0, 0, 0, 0.5);
            background-image: url("images/l-MAG-0218-Mecca-Disaster-1170x658.jpg");
            height: 400px;
            width: 100%;
            background-repeat: no-repeat;
            background-size: 100% 100%;
            cursor: pointer;
        }
        .tours{
            background-image: url("images/5-6-1170x658.jpg");
            height: 400px;
            width: 100%;
            background-repeat: no-repeat;
            background-size: 100% 100%;
            border: 1px solid black;
            opacity: .8;
            overflow: hidden;
        }
        .tours:hover{
            opacity: 1;
            background: rgb(0, 0, 0);
            background: rgba(0, 0, 0, 0.5);
            background-image: url("images/5-6-1170x658.jpg");
            height: 400px;
            width: 100%;
            background-repeat: no-repeat;
            background-size: 100% 100%;
            cursor: pointer;
        }
        .content_card{
            position: absolute;
            /*bottom: 0;*/
            height: 100%;
            background: rgb(0, 0, 0);
            background: rgba(0, 0, 0, 0.5);
            color: #f1f1f1;
            width: 100%;
        }

        .box{
            height: 300px;
            width: 100%;
            border: 2px solid black;
            position: relative;
            margin: 10px;
            float: left;
        }
        .image-box {
            position: relative;
            overflow: hidden;
        }
        .image-box img{
            height: 300px;
            width: 100%;
            transform: scale(1);
            transition: 1s;
            cursor: pointer;
        }

        .image-box:hover img{
            transform: scale(1.5);
        }
        .content{
            position: absolute;
            top: 4%;
            left: 4%;
            right: 4%;
            bottom: 4%;
            background-color: rgb(0,0,0,.5);
            transition: 1s;
            transform: scale(0);
        }

        .box:hover .content{
            transform: scale(1);
        }

        .content p{
            color: white;
            font-size: 20px;
            line-height: 20px;
            margin-top: 10px;
        }
        .testimonial{
            background-image: url("images/7 (1).jpg");
            height: auto;`
            width: 100%;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100% 100%;
            opacity: .8;
            position: relative;
        }




    </style>
<body>
    <section class="header-top" style="background-color: silver">
        <?php include 'top_header.php'?>
    </section>
    <!--nav bar-->
    <section class="menu_bar">
        <?php include "nav.php"?>
    </section>


    <section class="slier">
        <?php
            $sql = "SELECT * FROM sliders";  // select all slider from databse
            $res = mysqli_query($connect, $sql); // connect with query and database
            $numrow = mysqli_num_rows($res);
        ?>
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <?php
                // view slider
                for ($i=1; $i<=$numrow; $i++ ) {
                    echo "<li data-target=\"#carouselExampleIndicators\" data-slide-to=\"$i++\"></li>";
                }
                ?>
            </ol>
            <div class="carousel-inner" role="listbox">
                <?php
                for ($i=1; $i<=$numrow; $i++ ) {
                    $row = mysqli_fetch_assoc($res);

                    ?>

                    <?php
                    if ($i == 1) { ?>
                        <div class="carousel-item active">
                            <img class="d-block img-fluid" src="<?php echo "images/" . $row["image"]; ?>" alt="First slide" width="100%" style="height: 400px">
                        </div>

                    <?php } else { ?>
                        <div class="carousel-item">
                            <img class="d-block img-fluid" src="<?php echo "images/" . $row["image"]; ?>" alt="Second slide" width="100%" style="height: 400px">
                        </div>
                    <?php }
                }
                ?>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>


    <section class="main_content_one" style="background-color: #F5F5DC">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 mt-4 mb-5">
                    <h2 class="text-center font-weight-bolder mt-3">Our Services</h2>
                    <p class="text-center" style="font-size: 20px; ">Don't miss any Services!</p>
                    <div class="col-md-4 col-sm-12 mt-4 float-left">
                        <div class="card hajj">
                            <div class="card-body content_card">
                                <p class="text-center mt-3"><img src="images/illustration-holy-quran-icon-T0RB96.jpg" style="height: 50px; width: 50px;"></p>
                                <h2 class="text-center text-capitalize mt-3 text-white font-weight-bold">Hajj</h2>
                                <p class="text-center mt-4 text-white">Each year hundreds of Muslims embark on the holy journey of Hajj with Al Manar Tours and Travels Ltd. Cheap Hajj Packages are available without any hassle and with comfortable pilgrimage guarantee.</p>
                                <p class="text-center"><a href="hajj_packages.php" class="btn btn-info">View All</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12  mt-4 float-left">
                        <div class="card umrah">
                            <div class="card-body content_card">
                                <p class="text-center mt-3"><img src="images/white-icon-on-black-background-ramadan-vector-14766701.jpg" style="height: 50px; width: 50px;"></p>
                                <h2 class="text-center text-capitalize mt-3 text-white font-weight-bold">Umrah</h2>
                                <p class="text-center mt-4 text-white">Looking for Cheap Umrah Packages? You are indeed at the right place. Through its well linked network Al Manar Tours and Travels Ltd. provides the Umrah services at the cheapest rates available in the market.</p>
                                <p class="text-center"><a href="umrah_packages.php" class="btn btn-info">View All</a></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12  mt-4 float-left">
                        <div class="card tours">
                            <div class="card-body content_card">
                                <p class="text-center mt-3"><img src="images/fdb01354a7f787c8d3191c8759c7d428.png" style="height: 50px; width: 50px;"></p>
                                <h2 class="text-center text-capitalize mt-3 text-white font-weight-bold">Islamic Tours</h2>
                                <p class="text-center mt-4 text-white">Al Manar Tours and Travels Ltd. is one of the best Halal travel agencies in Bangladesh. We provide expert tourist Visa processing, cheap flights from Bangladesh, best tour packages, best price for hotel booking and other travel services.</p>
                                <p class="text-center"><a href="tours.php" class="btn btn-info">View All</a></p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="offers" style="background-color: #cce5ff">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 mb-5">
                    <h2 class="text-center font-weight-bolder mt-5">Hajj And Umrah Special Offers</h2>
                    <p class="text-center" style="font-size: 20px; ">Don't miss out on these special offers from us!</p>

                    <?php
                        $sql_get_package = "SELECT * FROM submenu, packages, package_price WHERE  packages.pakage_type_id = package_price.id AND submenu.id = packages.menu_id"; // select all package
                        $res_package     = mysqli_query($connect, $sql_get_package); // connect with query and database

                        while ($package = mysqli_fetch_assoc($res_package)){?>
                            <div class="col-md-4 col-sm-12 float-left mt-4">
                                <div class="card" style="background-color: #0D0D0F">
                                    <div class="card-body">
                                        <h4 class="text-center text-white"><?php echo $package['menu_name'];?></h4>
                                        <p class="text-center mt-5 text-white"><?php echo $package['package_name'];?></p>
                                        <p class="text-capitalize mt-5 text-center text-white">Per Person: <?php echo number_format($package['price'],2);?>T.K</p>
                                        <p class="text-capitalize mt-5 text-center text-white">Package's Duration: <?php echo $package['duration'];?></p>
                                        <p class="text-center"><a href="single_package.php?single=<?php echo $package['pakage_id'];?>" class="btn btn-info">View More</a></p>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    ?>
                </div>
            </div>
        </div>
    </section>


    <section class="team" style="background-color: #F5F5DC">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 mb-5">
                    <h3 class="text-center font-weight-bolder mt-5">Shariah Compliance Team</h3>

                    <?php
                        $get_team_member = "SELECT * FROM team_member"; // fetch all member from database
                        $res_team_member = mysqli_query($connect, $get_team_member); // connect with query and database

                        while ($team = mysqli_fetch_assoc($res_team_member)){?>
                            <div class="col-md-4 col-sm-12 mt-4 float-left">
                                <div class="card box">
                                    <div class="image-box">
                                        <img src="images/<?php echo $team['image'];?>">
                                    </div>
                                    <div class="content">
                                        <h1 class="text-center mt-5 text-white"><?php echo $team['name'];?></h1>
                                        <p class="text-center"><?php echo $team['position'];?></p>
                                        <p class="text-center mt-3"><a href="member_profile.php?profile=<?php echo $team['id'];?>" class="btn btn-info">View Profile</a></p>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    ?>
                </div>
            </div>
        </div>
    </section>


    <section class="count_timer">
        <div class="col-md-6 col-sm-12 float-left bg-dark" style="height: 250px">
           <div class="container">
               <div class="row">
                   <div class="col-md-12 col-sm-12 mt-5 mb-5">
                       <?php
                           $select_event = "SELECT * FROM event WHERE status = '0' ORDER BY id DESC"; //
                           $result_event = mysqli_query($connect, $select_event); // connect with query and database

                           $event = mysqli_fetch_assoc($result_event); // get event

//                           $event_date = date('M D, Y', strtotime($event['date']));
                           $event_date = $event['date']; // define variable and store date  on it
                           $event_time = $event['time']; // define ariable and store time on it

                           $date = date('M Y (D)', strtotime($event['date'])) // add date and time together

                       ?>
                       <h3 class="text-xl-center text-white"><?php echo $event['title'];?></h3>
                       <h4 class="mt-4 text-xl-center text-white">Start Date: <?php echo $date?></h4>
                       <h4 class="mt-3 text-xl-center text-white">Start Time: <?php echo date(" g:i:A ", strtotime($event_time))?></h4>
                   </div>
               </div>
           </div>
        </div>
        <div class="col-md-6 col-sm-12 float-left" style="background-color: #4F7FB6; height: 250px">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 mt-5 mb-5">
                        <h2 class="ml-5 font-weight-bolder text-white" id="demo" style="font-size: 50px;"></h2>
                        <div class="input-group form-group col-md-9 mt-3">
                            <input type="email" name="email" id="password" placeholder="Enter Email"  class="form-control ml-3" autocomplete="off" />
                            <div class="input-group-prepend">
                              <input type="submit" class="btn btn-success" value="Subscribe">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="row">
    </div>
    <section class="testimonial">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 mt-5 mb-5">
                    <h2 class="mt-5 text-white text-center font-weight-bold">Testimonial</h2>
                    <div class="col-md-6 col-sm-12 mt-4 float-left">
                        <p class="text-white text-justify" style="font-size: 19px; line-height: 31px">Excellent Services no complain what so ever, i would recommend all Hujjaaj to go with Al Manar Tours and Travels Ltd. The hajj package price was very reasonable. Haramain Hajj Umrah was very helpful all Sections specially Umrah Services.</p>
                    </div>
                    <div class="col-md-6 col-sm-12 mt-4 float-left">
                        <p class="text-white text-justify" style="font-size: 19px; line-height: 31px">Alhamdulillah, One of the best Islamic scholars of Bangladesh such as shaiykh doctor abu bakar muhammad zakaria and Shaiykh Ahmadullah will guide the people like us. This definitely will be a good moment for anyone In-sha-Allah. May omnipotent Allah bless this company. Aameen.</p>
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
    <script>
//        // Set the date we're counting down to
//        var countDownDate = new Date("Nov 3, 2020 13:26:26").getTime();
        var countDownDate = new Date("<?php echo $event_date?> <?php echo $event_time?> ").getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Output the result in an element with id="demo"
            document.getElementById("demo").innerHTML = days + "d " + hours + "h "
                + minutes + "m " + seconds + "s ";

            // If the count down is over, write some text
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("demo").innerHTML = "<span class='text-danger'>Event Finished</span>";
            }
        }, 1000);
    </script>


</body>
</html>
