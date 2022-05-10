<?php
    session_start();
    if (!isset($_SESSION['email'])){
        header('Location: ../index.php');
}

require_once '../php/db_connect.php';?>
<?php include "front/header.php"; ?>

<body id="page-top">

<?php include "front/nav.php";?>



<div id="wrapper">
   <?php include "front/sidebar.php";?>

    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Overview</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-xl-4 col-sm-6 mb-3">
                    <div class="card text-white bg-primary o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas fa-fw fa-comments"></i>
                            </div>
                            <div class="mr-5">
                                <?php
                                $sql = "SELECT count(id) AS totalMember FROM team_member"; //select all id from team member table
                                $res = mysqli_query($connect, $sql);
                                $values = mysqli_fetch_assoc($res);
                                $num_rows = $values['totalMember']; //toatal number of available data in database
                                echo "<span style='font-size: 30px;'>$num_rows</span>"; //print data
                                ?>

                            </div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="manage-member.php">
                            <span class="float-left">Total Member</span>
                            <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
                        </a>
                    </div>
                </div>

                <div class="col-xl-4 col-sm-6 mb-3">
                    <div class="card text-white bg-secondary o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas fa-fw fa-list"></i>
                            </div>
                            <div class="mr-5">
                                <?php
                                $sql = "SELECT count(booking_id) AS totalbooking FROM booking"; //select all id from booking tabele table
                                $res = mysqli_query($connect, $sql);
                                $values = mysqli_fetch_assoc($res);
                                $num_rows = $values['totalbooking']; //toatal number of available data in database
                                echo "<span style='font-size: 30px;'>$num_rows</span>"; //print data
                                ?>
                            </div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="manage-booking.php">
                            <span class="float-left">Total Hajj & Umrah Booking</span>
                            <span class="float-right">
                  <i class="fas fa-angle-right"></i></span></a>
                    </div>
                </div>

                <div class="col-xl-4 col-sm-6 mb-3">
                    <div class="card text-white bg-info o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas fa-fw fa-list"></i>
                            </div>
                            <div class="mr-5">
                                <?php
                                $sql = "SELECT count(tour_book_id) AS TourBook FROM tour_booking"; //select all id from booking tabele table
                                $res = mysqli_query($connect, $sql);
                                $values = mysqli_fetch_assoc($res);
                                $num_rows = $values['TourBook']; //toatal number of available data in database
                                echo "<span style='font-size: 30px;'>$num_rows</span>"; //print data
                                ?>
                            </div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="tour-booking.php">
                            <span class="float-left">Total Islamic Tours Booking</span>
                            <span class="float-right">
                  <i class="fas fa-angle-right"></i></span></a>
                    </div>
                </div>


                <div class="col-xl-4 col-sm-6 mb-3">
                    <div class="card text-white bg-danger o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas fa-fw fa-list"></i>
                            </div>
                            <div class="mr-5">
                                <?php
                                $sql = "SELECT  SUM(pay_amount) AS total_amount FROM invoice"; //select all pay amount and sum them form from invoice table
                                $res = mysqli_query($connect, $sql);
                                $values = mysqli_fetch_assoc($res);
                                $num_rows = number_format($values['total_amount'],2).' '.'T.K'; //total earn
                                echo "<span style='font-size: 30px;'>$num_rows</span>"; //print data
                                ?>
                            </div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="manage-booking.php">
                            <span class="float-left">Total Earn Hajj & Umrah</span>
                            <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
                        </a>
                    </div>
                </div>


                <div class="col-xl-4 col-sm-6 mb-3">
                    <div class="card text-white bg-secondary o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas fa-fw fa-list"></i>
                            </div>
                            <div class="mr-5">
                                <?php
                                $sql = "SELECT  SUM(pay_amount) AS total_amount FROM tour_invoice"; //select all pay amount and sum them form from invoice table
                                $res = mysqli_query($connect, $sql);
                                $values = mysqli_fetch_assoc($res);
                                $num_rows = number_format($values['total_amount'],2).' '.'T.K'; //total earn
                                echo "<span style='font-size: 30px;'>$num_rows</span>"; //print data
                                ?>
                            </div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="tour-booking.php">
                            <span class="float-left">Total Earn Islamic Tours</span>
                            <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
                        </a>
                    </div>
                </div>


            </div>
        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <?php include "front/sub_footer.php";?>
    </div>
    <!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->


    <?php include "front/footer.php";?>

</body>
</html>
