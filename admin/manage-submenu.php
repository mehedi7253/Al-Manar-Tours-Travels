<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 10/31/2020
 * Time: 9:43 PM
 */
?>
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
                <li class="breadcrumb-item active">Manage Sub Menu</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-12 mx-auto mt-4 mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h4>Manage Sub Menu <span class="float-right"><a href="add-submenu.php" class="btn btn-primary">Add Sub Menu</a></span></h4>
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
                            <div class="table-responsive">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Main Menu</th>
                                        <th>Sub Menu</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $select_submenu = "SELECT * FROM submenu";
                                        $result         = mysqli_query($connect, $select_submenu);
                                    ?>
                                    <?php
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($result)){?>
                                        <tr>
                                            <td><?php echo $i++;?></td>
                                            <td><?php echo $row['main_menu'];?></td>
                                            <td><?php echo $row['menu_name'];?></td>
                                            <td>
                                                <?php
                                                $status = $row['status'];
                                                if (($status) == '0'){?>
                                                    <a href="submenu_publish.php?status=<?php echo $row['id'];?>" class="btn btn-success" onclick="return confirm('Are You Sure To Un-publish')">Published</a>
                                                    <?php
                                                }
                                                if (($status) == '1'){?>
                                                        <a href="submenu_publish.php?status=<?php echo $row['id'];?>" class="btn btn-danger" onclick="return confirm('Are You Sure To Published')">Publish Now</a>
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <a href="edit-submenu.php?sub_menu=<?php echo $row['id'];?>" class="btn btn-info">Edit</a>
                                                <a href="delete-submenu.php?delete_menu=<?php echo $row['id'];?>" class="btn btn-danger">Delete</a>
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



