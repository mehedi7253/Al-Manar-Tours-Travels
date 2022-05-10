<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 10/31/2020
 * Time: 6:35 PM
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
                    <a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Manage Sliders</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-12 mx-auto mt-4 mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h4>Manage Sliders <span class="float-right"><a href="add-slider.php" class="btn btn-primary">Add Slider</a></span></h4>
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
                                    <tr>
                                        <th>Serial</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $select_slider = "SELECT * FROM sliders";
                                        $result        = mysqli_query($connect, $select_slider);
                                    ?>
                                    <?php
                                        $i = 1;
                                        while ($row = mysqli_fetch_assoc($result)){?>
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td>
                                                    <img src="../images/<?php echo $row['image'];?>" style="height: 100px; width: 150px"></td>
                                                <td>
                                                    <a href="delete-slider.php?delete_slider=<?php echo $row['id'];?>" class="btn btn-danger">Delete</a>
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


