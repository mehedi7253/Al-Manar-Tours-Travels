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
                <li class="breadcrumb-item active">Manage Member</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-12 mx-auto mt-4 mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h4>Manage Team Member <span class="float-right"><a href="add-member.php" class="btn btn-primary">Add Member</a></span></h4>
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
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                        <th>Profile</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $select_member = "SELECT * FROM team_member";
                                        $result_member = mysqli_query($connect, $select_member);
                                    ?>
                                    <?php
                                        $i = 1;
                                        while ($row = mysqli_fetch_assoc($result_member)){?>
                                            <tr class="text-center">
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $row['name'];?></td>
                                                <td class="text-capitalize"><?php echo $row['position'];?></td>
                                                <td><?php echo $row['phone'];?></td>
                                                <td><?php echo $row['email'];?><td>
                                                    <a href="delete-member.php?delete_member=<?php echo $row['id'];?>" onclick="return confirm('Are You Sure To Remove...!!')" class="btn btn-danger">Delete</a>
                                                </td>
                                                <td>
                                                    <a href="view-member.php?profile=<?php echo $row['id'];?>" class="btn btn-info"><i class='fa fa-eye'></i> View</a>
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


