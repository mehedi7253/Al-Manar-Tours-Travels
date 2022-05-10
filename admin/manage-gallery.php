
<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/5/2020
 * Time: 2:34 PM
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
                <li class="breadcrumb-item active">Manage Gallery</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-12 mx-auto mt-4 mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h4>Manage Gallery <span class="float-right"><a href="add-gallery.php" class="btn btn-primary">Add Gallery Image</a></span></h4>
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
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th>Add More Image</th>
                                        <th>More Images</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $select_gallery = "SELECT * FROM gallery";
                                        $result_gallery = mysqli_query($connect, $select_gallery);
                                    ?>
                                    <?php
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($result_gallery)){?>
                                        <tr class="text-center">
                                            <td><?php echo $i++;?></td>
                                            <td><?php echo $row['title'];?></td>
                                            <td>
                                                <img src="../images/<?php echo $row['image'];?>" style="height: 50px; width: 50px">
                                            </td>
                                            <td>
                                                <a class="btn btn-info" href="add-sub-image.php?add_more=<?php echo $row['gallery_id'];?>">Add More</a>
                                            </td>
                                            <td>
                                                <a class="btn btn-info" href="add-sub-image.php?add_more=<?php echo $row['gallery_id'];?>"><i class='fa fa-eye'></i> View</a>
                                            </td>
                                            <td>
                                                <a class="btn btn-danger" href="delete-gallery.php?delete=<?php echo $row['gallery_id'];?>" onclick="return confirm('Are You Sure to Delete..!!')">Delete</a>
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

