<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/11/2020
 * Time: 10:02 PM
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
                    <a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Manage Multi Menu</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-12 mx-auto mt-4 mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h4>Manage Multi Menu <span class="float-right"><a href="add-multi.php" class="btn btn-primary">Add Multi Menu</a></span></h4>
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
                                        <th>Sub Menu</th>
                                        <th>Multi Menu</th>
                                        <th>Add Page</th>
                                        <th>View page's</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $select_submenu = "SELECT submenu.id AS sub_id, submenu.menu_name, multi_menu.id, multi_menu.multi_menu_name, multi_menu.id, multi_menu.status FROM submenu, multi_menu WHERE multi_menu.sub_menu_id =submenu.id "; //select query
                                        $result         = mysqli_query($connect, $select_submenu); //exicute
                                    ?>
                                    <?php
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($result)){?>
                                        <tr>
                                            <td><?php echo $i++;?></td>
                                            <td><?php echo $row['menu_name'];?></td>
                                            <td><?php echo $row['multi_menu_name'];?></td>
                                            <td>
                                                <a class="btn btn-primary" href="add-multi-page.php?multi_page=<?php echo $row['id'];?>">Add </a>
                                            </td>
                                            <td>
                                                <a class="btn btn-primary" href="manage-multi-page.php?multi_page=<?php echo $row['id'];?>">View</a>
                                            </td>
                                            <td>
                                                <?php
                                                $status = $row['status'];
                                                if (($status) == '0'){?>
                                                    <a href="multi_publish.php?status=<?php echo $row['id'];?>" class="btn btn-success" onclick="return confirm('Are You Sure To Un-publish')">Published</a>
                                                    <?php
                                                }
                                                if (($status) == '1'){?>
                                                    <a href="multi_publish.php?status=<?php echo $row['id'];?>" class="btn btn-danger" onclick="return confirm('Are You Sure To Published')">Publish Now</a>
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <a href="delete-gallery.php?delete_multi_menu=<?php echo $row['id'];?>" class="btn btn-danger">Delete</a>
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




