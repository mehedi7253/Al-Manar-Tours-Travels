<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/13/2020
 * Time: 11:35 PM
 */
?>
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
                <li class="breadcrumb-item active">Add New Package Price</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-10 mx-auto mt-4 mb-4">
                    <div class="card">
                        <div class="card-header bg-gray">
                            <h3>Add New Package <span class="float-right"><a href="manage-price.php" class="btn btn-primary">All Package price</a></span></h3>

                        </div>
                        <div class="card-body">
                            <h6>
                                <?php
                                if (isset($_POST['slider']))
                                {
                                    $package_name = $_POST['package_name'];
                                    $price        = $_POST['price'];

                                    if ($package_name ==''){
                                        echo "<span class='text-danger'>Please Enter Package Name</span><br/>";
                                    }elseif ($price == ''){
                                        echo "<span class='text-danger'>Please Enter Package Price</span><br/>";
                                    }else{
                                        $sql = "INSERT INTO package_price (package_name, price, status) VALUES ('$package_name', '$price', '0')";
                                        $res = mysqli_query($connect, $sql);

                                        if ($res){
                                            $_SESSION['success'] = 'Package Added Successfully';
                                        }else{
                                            $_SESSION['error'] = 'Adding package Failed';
                                        }
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
                            <form action="" method="post">
                                <div class="form-group">
                                    <label>Package Name</label>
                                    <input type="text" placeholder="Enter Package Name" class="form-control" name="package_name">
                                </div>
                                <div class="form-group">
                                    <label>Package Price</label>
                                    <input type="text" placeholder="Enter Package Price" class="form-control" name="price">
                                </div>
                                <div class="form-group">
                                    <label></label>
                                    <input type="submit" name="slider" class="btn btn-success" value="Add Now">
                                </div>
                            </form>
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


