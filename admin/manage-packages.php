<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/1/2020
 * Time: 11:56 AM
 */
?>
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
                    <a href="admin_dashboard.php">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Manage Packages</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-12 mx-auto mt-4 mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h4>Manage Sliders <span class="float-right"><a href="add-package.php" class="btn btn-primary">Add Package</a></span></h4>
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
                            <div class="table-responsive">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                    <tr class="text-center">
                                        <th>Serial</th>
                                        <th>Type</th>
                                        <th>Duration</th>
                                        <th>Shariah Consultant</th>
                                        <th>Action</th>
                                        <th>More</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $select_package = "SELECT * FROM package_price, packages, team_member WHERE packages.pakage_type_id = package_price.id AND packages.member_id = team_member.id";
                                    $result_package = mysqli_query($connect, $select_package);
                                    ?>
                                    <?php
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($result_package)){?>
                                        <tr class="text-center">
                                            <td><?php echo $i++;?></td>
                                            <td><?php echo $row['package_name'];?></td>
                                            <td class="text-capitalize"><?php echo $row['duration'];?></td>
                                            <td><?php echo $row['name'];?></td>
                                            <td>
                                                <a href="edit-package.php?edit_package=<?php echo $row['pakage_id'];?>" class="btn btn-primary">Edit</a>
                                                <a href="delete-gallery.php?delete_package=<?php echo $row['pakage_id'];?>" onclick="return confirm('Are You Sure To Delete...!!')" class="btn btn-danger">Delete</a>
                                            </td>
                                            <td>
                                                <a href="view-package.php?view=<?php echo $row['pakage_id'];?>" class="btn btn-info"><i class='fa fa-eye'></i> View</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
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


