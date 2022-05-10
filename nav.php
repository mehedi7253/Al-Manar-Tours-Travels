

<script type="text/javascript">
    /// some script

    // jquery ready start
    $(document).ready(function() {
        // jQuery code

        //////////////////////// Prevent closing from click inside dropdown
        $(document).on('click', '.dropdown-menu', function (e) {
            e.stopPropagation();
        });

        // make it as accordion for smaller screens
        if ($(window).width() < 992) {
            $('.dropdown-menu a').click(function(e){
                e.preventDefault();
                if($(this).next('.submenu').length){
                    $(this).next('.submenu').toggle();
                }
                $('.dropdown').on('hide.bs.dropdown', function () {
                    $(this).find('.submenu').hide();
                })
            });
        }

    }); // jquery end
</script>

<style type="text/css">
    @media (min-width: 800px){
        .dropdown-menu .dropdown-toggle:after{
            border-top: .3em solid transparent;
            border-right: 0;
            border-bottom: .3em solid transparent;
            border-left: .3em solid;

        }

        .dropdown-menu .dropdown-menu{
            margin-left:0; margin-right: 0;

        }

        .dropdown-menu li{
            position: relative;

        }
        .nav-item .submenu{
            display: none;
            position: absolute;
            left:100%; top:-7px;
        }
        .nav-item .submenu-left{
            right:100%; left:auto;
        }

        .dropdown-menu > li:hover{ background-color: #f1f1f1 }
        .dropdown-menu > li:hover > .submenu{
            display: block;

        }
        #main_nav ul li{
            text-align: center;
        }
        #main_nav ul li a{
            font-size: 15px;
            color: #fff;
            font-weight: 500;
            padding: 25px;
            text-transform: uppercase;
        }
        #main_nav ul li a.active{
            color: green;

        }
        #main_nav ul li a:hover{
            color: #1BBD36;
            transition: all 0.3s ease-in-out;
            -moz-transition: all 0.3s ease-in-out;
            -webkit-transition: all 0.3s ease-in-out;
            -o-transition: all 0.3s ease-in-out;
        }

    }
</style>
<nav class="navbar navbar-expand-lg bg-dark navbar-dark m-0 p-0">

    <div class="container">

        <a class="navbar-brand" href="index.php"><span class="text-white font-weight-bold"><img src="images/logo.jpg" style="height: 50px; width: 120px"></a>

        <!--        <a class="navbar-brand" href="index.php"><span class="text-white font-weight-bold">Al Manar <span style="color: yellow">Travels <sapn class="text-danger">&</sapn> Tour</span></span></a>-->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="main_nav">

            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a href="index.php" class="nav-link" >Home</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link  dropdown-toggle" href="#" data-toggle="dropdown"> Hajj Offer </a>
                    <ul class="dropdown-menu bg-dark">
                        <li>
                            <?php
                            $hajj_offers = "SELECT * FROM submenu WHERE main_menu = 'hajj_offers' AND status = '0'"; // select all submenu
                            $result_hajj = mysqli_query($connect, $hajj_offers); // connect with query and database

                            while ($hajj = mysqli_fetch_assoc($result_hajj)){?>
                              <li> <a class="dropdown-item text-capitalize bg-dark" href="packages.php?package=<?php echo $hajj['id'];?>"><?php echo $hajj['menu_name'];?> &raquo</a>
                                    <ul class="submenu submenu-right dropdown-menu bg-dark">
                                        <?php
                                        $multi_menu = "select * from multi_menu WHERE multi_menu.sub_menu_id  = '$hajj[id]'"; // select all multi menu
                                        $multi_res  = mysqli_query($connect, $multi_menu); // connect with query and database
                                        while ($m = mysqli_fetch_assoc($multi_res)){?>
                                            <li><a class="dropdown-item bg-dark" href="multi_page.php?multi=<?php echo $m['id'];?>"> <?php echo $m['multi_menu_name'];?></a></li>
                                        <?php }
                                        ?>
                                    </ul>
                              </li>
                            <?php }
                            ?>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link  dropdown-toggle" href="#" data-toggle="dropdown"> Umrah Offer </a>
                    <ul class="dropdown-menu bg-dark">
                        <li>
                            <?php
                                $umrah_offers = "SELECT * FROM submenu WHERE main_menu = 'umrah_offers' AND status = '0'"; // select all submenu
                                $result_umrah = mysqli_query($connect, $umrah_offers);// connect with query and database

                            while ($umarh = mysqli_fetch_assoc($result_umrah)){?>
                                 <li> <a class="dropdown-item text-capitalize bg-dark" href="packages.php?package=<?php echo $umarh['id'];?>"><?php echo $umarh['menu_name'];?> &raquo</a>
                                    <ul class="submenu submenu-right dropdown-menu bg-dark">
                                        <?php
                                        $multi_menu = "select * from multi_menu WHERE multi_menu.sub_menu_id  = '$umarh[id]'";
                                        $multi_res  = mysqli_query($connect, $multi_menu);
                                        while ($m = mysqli_fetch_assoc($multi_res)){?>
                                            <li><a class="dropdown-item bg-dark" href="multi_page.php?multi=<?php echo $m['id'];?>"> <?php echo $m['multi_menu_name'];?></a></li>
                                        <?php }
                                        ?>
                                    </ul>
                                </li>
                                <?php }
                                ?>
                        </li>
                    </ul>
                </li>

                <li class="nav-item"><a href="tours.php" class="nav-link" > tours</a></li>
                <li class="nav-item"><a href="blog.php" class="nav-link" >Blogs</a></li>
                <li class="nav-item"><a href="booking.php" class="nav-link" >Booking</a></li>
                <li class="nav-item dropdown">
                    <?php
                    // check user login or not
                    if (not_logged_in() === true)
                    {
                        echo '<a href="user/login.php" class="nav-link">Login</a>';
                    }else {
                        //if user login then view user all data
                        $userdata = getUserDataByUserId($_SESSION['id']);

                        echo "
                            <li class='nav-item dropdown'><a class='nav-link  dropdown-toggle' data-toggle='dropdown' href='#'> $userdata[first_name] <img src='images/$userdata[image]' style='height: 30px; width: 30px; border-radius: 50%'></a>
                                <ul class='dropdown-menu dropdown-menu-right bg-dark'>
                                    <li><a href='user/dashboard.php' class='dropdown-item text-capitalize'>Profile</a></li>
                                    <li><a href='user/logout.php' class='dropdown-item text-capitalize'>Logout</a></li>
                                </ul>
                            </li>
                           ";
                    }
                    ?>
                </li>

            </ul>

        </div> <!-- navbar-collapse.// -->
    </div>

</nav>
