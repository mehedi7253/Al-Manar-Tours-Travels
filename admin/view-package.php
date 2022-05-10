<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/1/2020
 * Time: 12:09 PM
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
                <li class="breadcrumb-item active">package</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <?php
                if (isset($_GET['view']))
                {
                    $id = $_GET['view'];
                    $sql = "SELECT * FROM packages,package_price WHERE packages.pakage_type_id = package_price.id AND pakage_id = '$id'";
                    $res = mysqli_query($connect, $sql);

                    $data = mysqli_fetch_assoc($res);
                }
                ?>
                <div class="col-md-10 mx-auto mt-2 mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-capitalize"><span class="text-info"><?php echo $data['package_name'];?></span> Information</h3>
                        </div>
                        <div class="card-body">
                            <div class="col-md-4 col-sm-12 float-left">
                                <img src="../images/<?php echo $data['image'];?>" style="height: 250px; width: 90%">
                            </div>
                            <div class="col-md-8 col-sm-12 float-left">
                               <div class="form-group">
                                   <label class="font-weight-bold text-capitalize">Package Duration <span class="ml-3">:</span>  <?php echo $data['duration'];?></label>
                               </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Package Price <span class="ml-5">:</span> <?php echo number_format($data['price'], 2);?> T.K</label>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Package Description <span class="ml-2">:</span>  <?php echo $data['application'];?></label>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="manage-packages.php" class="float-right btn btn-info">Back</a>
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
