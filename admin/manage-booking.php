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
                            <h4>Manage Booking List <span class="float-right"></h4>
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
                                $select_member = "SELECT * FROM users, booking, invoice, package_price WHERE
                                                             invoice.booking_id = booking.booking_id AND
                                                             invoice.user_id = users.id AND
                                                             booking.package = package_price.id";
                                $result_member = mysqli_query($connect, $select_member);
                            ?>
                            <?php
                                if (isset($_POST['search']))
                                {
                                    $searchKey = $_POST['src'];
                                    $sql_s = "SELECT * FROM users, booking, invoice, package_price WHERE 
                                              invoice.booking_id = booking.booking_id AND
                                              invoice.user_id = users.id AND
                                              booking.package = package_price.id AND 
                                              invoice.package_price_id = '$searchKey'";
                                    $res_s = mysqli_query($connect, $sql_s);

                                    $rows = $res_s->num_rows;

                                }
                            ?>
                            <form action="" method="post">
                                <div class="form-group input-group col-md-4">
                                    <select class="form-control" name="src">
                                        <option>---Select Package----</option>
                                        <option value="1">VIP</option>
                                        <option value="2">Standard</option>
                                        <option value="3">Executive</option>
                                        <option value="4">Economic</option>

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
                                        <th>Package</th>
                                        <th>Package Type</th>
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
                                                        <a href="view-invoice.php?invoice=<?php echo $row['invoice_number']; ?>" class="text-decoration-none"><?php echo $row['invoice_number']; ?></a>
                                                    </td>
                                                    <td><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></td>
                                                    <td><?php echo $row['email']; ?></td>
                                                    <td><?php echo $row['booking_type']; ?></td>
                                                    <td><?php echo $row['package_name']; ?></td>
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
                                                        <a href="view-invoice.php?invoice=<?php echo $data['invoice_number']; ?>" class="text-decoration-none"><?php echo $data['invoice_number']; ?></a>
                                                    </td>
                                                    <td><?php echo $data['first_name'] . ' ' . $data['last_name']; ?></td>
                                                    <td><?php echo $data['email']; ?></td>
                                                    <td><?php echo $data['booking_type']; ?></td>
                                                    <td><?php echo $data['package_name']; ?></td>
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



