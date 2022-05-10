<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/1/2020
 * Time: 12:42 PM
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
                <li class="breadcrumb-item active">Update package</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-10 mx-auto mt-4 mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update Package</h4>
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

                            if(isset($_SESSION['error'])){
                                echo "
                                        <div class='alert alert-danger alert-dismissible'>
                                          <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                          <h6><i class='icon fa fa-check'></i> Error!</h6>
                                          ".$_SESSION['error']."
                                        </div>
                                      ";
                                unset($_SESSION['error']);
                            }
                            ?>
                            <?php
                                if (isset($_GET['edit_package']))
                                {
                                    $id = $_GET['edit_package'];

                                    $sql = "SELECT * FROM packages,package_price WHERE packages.pakage_type_id = package_price.id AND pakage_id = '$id'";
                                    $res = mysqli_query($connect, $sql);
                                    $data = mysqli_fetch_assoc($res);
                                }
                                if (isset($_POST['package_up'])){
                                    $pakage_id = $_POST['pakage_id'];
                                    $duration    = $_POST['duration'];
                                    $application = $_POST['application'];

                                    if ($duration && $application)
                                    {
                                        $sql_up = "UPDATE packages SET duration = '$duration', application = '$application' WHERE pakage_id = $pakage_id";
                                        $res_up = mysqli_query($connect, $sql_up);

                                        $_SESSION['success'] = 'Package Updated Successfully';
                                        echo "<script>document.location.href='edit-package.php?edit_package=$id'</script>";

                                    }else{
                                        $_SESSION['error'] = 'package Updating Failed';
                                        echo "<script>document.location.href='edit-package.php?edit_package=$id'</script>";

                                    }

                                }
                            ?>
                            <form action="" method="post">
                                <div class="form-group">
                                    <label> Package Type</label>
                                    <input name="pakage_id" class="form-control" hidden value="<?php echo $data['pakage_id'];?>">
                                    <input class="form-control" disabled value="<?php echo $data['package_name'];?>">
                                </div>
                                <div class="form-group">
                                    <label>Package Duration</label>
                                    <input type="text" name="duration" class="form-control" value="<?php echo $data['duration'];?>">
                                </div>
                                <div class="form-group">
                                    <label>Package Price</label>
                                    <input type="text" name="" disabled class="form-control"  value="<?php echo $data['price'];?>">
                                </div>
                                <div class="form-group">
                                    <label>Package Details</label>
                                    <textarea class="form-control" name="application"><?php echo $data['application']?></textarea>
                                </div>
                                <div class="form-group">
                                    <label></label>
                                    <input type="submit" name="package_up" class="btn btn-success" value="Update package">
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <a href="manage-packages.php" class="btn btn-info float-right">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>This Site is Created by @ Arif Masud</span>
                </div>
            </div>
        </footer>
    </div>
    <!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->


<?php include "front/footer.php";?>

<script>
    CKEDITOR.replace('application',
        {
            height:300,
            resize_enabled:true,
            wordcount: {
                showParagraphs: false,
                showWordCount: true,
                showCharCount: true,
                countSpacesAsChars: true,
                countHTML: false,

                maxCharCount: 20}
        });
</script>
</body>
</html>


