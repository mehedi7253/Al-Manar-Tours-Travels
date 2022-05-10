<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 10/31/2020
 * Time: 6:29 PM
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
                <li class="breadcrumb-item active">Add Slider</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-10 mx-auto mt-4 mb-4">
                    <div class="card">
                        <div class="card-header bg-gray">
                            <h3>Add New Slider <span class="float-right"><a href="manage-slider.php" class="btn btn-primary">All Slider</a></span></h3>

                        </div>
                        <div class="card-body">
                            <h6>
                                <?php
                                if (isset($_POST['slider']))
                                {
                                    $image = $_FILES['image']['name'];

                                    if ($image == "")
                                    {
                                        echo "<span class='text-danger'>Please Select an Image</span><br/>";
                                    }

                                    if ($image)
                                    {
                                        // upload image
                                        $fileinfo = PATHINFO($_FILES['image']['name']);
                                        $newFile = $fileinfo['filename']. "." . $fileinfo['extension'];
                                        move_uploaded_file($_FILES['image']['tmp_name'], "../images/" .$newFile);
                                        $location = $newFile;

                                        $add_slider = "INSERT INTO sliders (image) VALUES ('$image')"; // upload slider
                                        $result     = mysqli_query($connect, $add_slider); // connect with query and database

                                    $_SESSION['success'] = 'New Slider Added successfully';
//                                        echo "<script>document.location.href='add-slider.php'</script>";
                                    }else{
                                        $_SESSION['error'] = 'Adding New Slider Failed';
//                                        echo "<script>document.location.href='add-slider.php'</script>";
                                    }
                                }
                                ?>
                            </h6>
                            <?php
                            if(isset($_SESSION['error'])){
                                echo "
                                    <div class='alert alert-danger alert-dismissible'>
                                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                      <h6><i class='icon fa fa-warning'></i> Error!</h6>
                                      ".$_SESSION['error']."
                                    </div>
                              ";
                                unset($_SESSION['error']);
                            }
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
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Select Image</label>
                                    <input type="file" class="form-control" name="image">
                                </div>
                                <div class="form-group">
                                    <label></label>
                                    <input type="submit" name="slider" class="btn btn-success" value="Add Now">
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <a href="manage-slider.php" class="float-right text-decoration-none">View All Slider</a>
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
<!---->
<!--<div class="col-12 col-sm-6 col-lg-3">-->
<!--    <div class="card">-->
<!--        <div class="card-body text-center">-->
<!--            <div class="mb-2">Error Message</div>-->
<!--            <button class="btn btn-primary" id="toastr-4">Launch</button>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<?php include "front/footer.php";?>
</body>
</html>

