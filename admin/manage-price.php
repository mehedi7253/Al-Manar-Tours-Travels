<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/3/2020
 * Time: 9:05 PM
 */
?>
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
                <li class="breadcrumb-item active">Manage Packages Price</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-12 mx-auto mt-4 mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h4>Manage Package Price</h4>
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
                                        <th>Updated Price</th>
                                        <th>Price</th>
                                        <th>Delete</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $select_package = "SELECT * FROM package_price";
                                        $result_package = mysqli_query($connect, $select_package);
                                    ?>
                                    <?php
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($result_package)){?>
                                        <tr class="text-center">
                                            <td><?php echo $i++;?></td>
                                            <td><?php echo $row['package_name'];?></td>
                                            <td><?php echo number_format($row['price'], 2);?> T.K</td>
                                            <td>
                                                <?php
                                                //
                                                if (isset($_POST['update'])){
                                                    $p_id    = $_POST['id'];
                                                    $price   = $_POST['price'];

                                                    $sql = "UPDATE package_price SET price = '$price' WHERE id = $p_id";
                                                    $res = mysqli_query($connect, $sql);

                                                    echo "<script>document.location.href='manage-price.php'</script>";
                                                }
                                                ?>
                                                <form action="" method="post">
                                                    <div class="form-group">
                                                        <input name="id" hidden value="<?php echo $row['id'];?>">
                                                        <input type="number" id="price" name="price" class="col-6 mt-2" value="<?php echo $row['price'];?>">
                                                        <input type="submit" name="update" class="btn btn-info" value="Update">
                                                    </div>
                                                </form>
                                            </td>
                                            <td>
                                                <a href="delete-gallery.php?delete_package=<?php echo $row['id'];?>" class="btn btn-danger">Delete</a>
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



