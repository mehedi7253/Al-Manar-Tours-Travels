<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/4/2020
 * Time: 9:02 PM
 */
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
                    <a href="admin_dashboard.php">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Manage Booking</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-12 mx-auto mt-4 mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h4>Manage Tour Booking List <span class="float-right"></h4>
                        </div>
                        <div class="card-body">
                            <?php
                            if(isset($_SESSION['success'])){
                                echo "
                                        <div class='alert alert-success alert-dismissible'>
                                          <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                          <h6><i class='icon fa fa-check'></i> Success!</h6>
                                          ".$_SESSION['success']."
                                        </div>
                                      ";
                                unset($_SESSION['success']);
                            }
                            ?>
                            <?php
                                $select_member = "SELECT * FROM tour_booking, sub_tour, users WHERE tour_booking.sub_tour_id = sub_tour.sub_tour_id AND tour_booking.user_id = users.id";
                                $result_member = mysqli_query($connect, $select_member);
                            ?>
                            <?php
                            if (isset($_POST['search']))
                            {
                                $searchKey = $_POST['src'];
                                $sql_s = "SELECT * FROM tour_booking, sub_tour, users WHERE 
                                        tour_booking.sub_tour_id = sub_tour.sub_tour_id AND 
                                        tour_booking.user_id = users.id AND 
                                        sub_tour.package = '$searchKey'";
                                $res_s = mysqli_query($connect, $sql_s);

                                $rows = $res_s->num_rows;

                            }
                            ?>
                            <form action="" method="post">
                                <div class="form-group input-group col-md-4">
                                    <select class="form-control" name="src">
                                        <option>---Select Package----</option>
                                        <option value="vip">VIP</option>
                                        <option value="standard">Standard</option>
                                        <option value="executive">Executive</option>
                                        <option value="standard economic">Standard Economic</option>

                                    </select>
                                    <input type="submit" class="btn btn-info ml-2" name="search" value="Submit">
                                </div>
                            </form>
                            <div class="table-responsive" >
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                    <tr class="text-center">
                                        <th>Serial</th>
                                        <th>Invoice</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Place</th>
                                        <th>Package</th>
                                        <th>Person</th>
                                        <th>Booking Date</th>
                                    </tr>
                                    </thead>
                                    <tbody id="myTables">
                                    <?php
                                    if (isset($_POST['search'])== true) {
                                        if ($rows > 0) {
                                            $i = 1;
                                            while ($row = mysqli_fetch_assoc($res_s)) {
                                                ?>
                                                <tr class="text-center">
                                                    <td><?php echo $i++; ?></td>
                                                    <td>
                                                        <?php
                                                        //get invoice data
                                                            $sql_invoice = "SELECT * FROM tour_invoice, tour_booking WHERE 
                                                                            tour_invoice.tour_booking_id = tour_booking.tour_book_id AND 
                                                                            tour_invoice.tour_booking_id = '$row[tour_book_id]'";
                                                            $res_invoice = mysqli_query($connect, $sql_invoice);

                                                            $invoice = mysqli_fetch_assoc($res_invoice);
                                                        ?>
                                                        <?php
                                                        if (!isset($invoice['tour_booking_id'])){
                                                            echo '<span class="text-danger font-weight-bold">Payment Pending</span>';
                                                        }else{
                                                            echo '<a class="text-decoration-none" href="tour_invoice.php?invoice='.$invoice['tour_invoice_number'].'">'.$invoice['tour_invoice_number'].'</a>';
                                                        }
                                                        ?>
<!--                                                        echo "<a href='tour_invoice.php?invoice=$invoice[tour_invoice_number]' class='text-decoration-none' $row[tour_invoice_number]</a>";-->

                                                    </td>
                                                    <td class="text-capitalize"><?php echo $row['name'];?></td>
                                                    <td><?php echo $row['email']; ?></td>
                                                    <td><?php echo $row['title']; ?></td>
                                                    <td class="text-uppercase"><?php echo $row['package']; ?></td>
                                                    <td><?php echo $row['person']; ?></td>
                                                    <td><?php echo $row['date']; ?></td>
                                                </tr>
                                            <?php }
                                        }
                                    } else {
                                        $i = 1;
                                        while ($data = mysqli_fetch_assoc($result_member)) {
                                            ?>
                                            <tr class="text-center">
                                                <td><?php echo $i++; ?></td>
                                                <td>
                                                    <?php
                                                    //get invoice data
                                                    $sql_invoice2 = "SELECT * FROM tour_invoice, tour_booking WHERE 
                                                                            tour_invoice.tour_booking_id = tour_booking.tour_book_id AND 
                                                                            tour_invoice.tour_booking_id = '$data[tour_book_id]'";
                                                    $res_invoice2 = mysqli_query($connect, $sql_invoice2);

                                                    $invoice2 = mysqli_fetch_assoc($res_invoice2);
                                                    ?>
                                                    <?php
                                                    if (!isset($invoice2['tour_booking_id'])){
                                                        echo '<span class="text-danger font-weight-bold">Payment Pending</span>';
                                                    }else{
                                                        echo '<a class="text-decoration-none" href="tour_invoice.php?invoice='.$invoice2['tour_invoice_number'].'">'.$invoice2['tour_invoice_number'].'</a>';
                                                    }
                                                    ?>
                                                    <!--                                                        echo "<a href='tour_invoice.php?invoice=$invoice[tour_invoice_number]' class='text-decoration-none' $row[tour_invoice_number]</a>";-->

                                                </td>
                                                <td class="text-capitalize"><?php echo $data['name'];?></td>
                                                <td><?php echo $data['email']; ?></td>
                                                <td><?php echo $data['title']; ?></td>
                                                <td class="text-uppercase"><?php echo $data['package']; ?></td>
                                                <td><?php echo $data['person']; ?></td>
                                                <td><?php echo $data['date']; ?></td>
                                            </tr>
                                        <?php }
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
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



