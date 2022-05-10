<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/2/2020
 * Time: 7:47 PM
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
                <li class="breadcrumb-item active">package</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <?php
                if (isset($_GET['profile']))
                {
                    $id = $_GET['profile'];

                    $sql = "SELECT * FROM team_member WHERE id = '$id'";
                    $res = mysqli_query($connect, $sql);

                    $data = mysqli_fetch_assoc($res);
                }
                ?>
                <div class="col-md-12 mx-auto mt-2 mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-capitalize"><span class="text-info"><?php echo $data['name'];?></span> Information</h3>
                        </div>
                        <div class="card-body">
                            <div class="col-md-4 col-sm-12 float-left">
                                <img src="../images/<?php echo $data['image'];?>" style="height: 250px; width: 100%">
                                <h3 class="mt-2 font-weight-bold text-center">Position: <br/><?php echo $data['position'];?></h3>
                            </div>
                            <div class="col-md-8 col-sm-12 float-left">
                                <div class="form-group">
                                    <label class="font-weight-bold text-capitalize">Name <span class="ml-3">:</span>  <?php echo $data['name'];?></label>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Phone <span class="ml-3">:</span> <?php echo $data['phone'];?></label>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Email <span class="ml-4">:</span>  <?php echo $data['email'];?></label>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Brief Description : <br/><span class="ml-1 font-weight-normal text-justify"> <?php echo $data['application'];?></span> </label>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="manage-member.php" class="float-right btn btn-info">Back</a>
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

