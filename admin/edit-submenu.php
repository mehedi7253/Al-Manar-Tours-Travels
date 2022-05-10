<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/1/2020
 * Time: 8:50 AM
 */
?>
<?php
    session_start();
    if (!isset($_SESSION['email'])){
        header('Location: ../index.php');
    }

    require_once '../php/db_connect.php';
?>

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
                <li class="breadcrumb-item active">Update Sub Menu</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-10 mx-auto mt-4 mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-center">Update Sub Menu</h3>
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
                            if (isset($_GET['sub_menu']))
                            {
                                $id = $_GET['sub_menu'];
                                $sql = "SELECT * FROM submenu WHERE id = '$id'";
                                $res = mysqli_query($connect, $sql);

                                $data = mysqli_fetch_assoc($res);
                            }

                            if (isset($_POST['btn'])){
                                $menu_id     = $_POST['id'];
                                $menu_name   = $_POST['menu_name'];
                                $description = $_POST['description'];

                                if ($menu_name) {
                                    $update = "UPDATE submenu SET menu_name = '$menu_name', description = '$description' WHERE id = $menu_id";
                                    $res_up = mysqli_query($connect, $update);

                                    $_SESSION['success'] = 'Sub Menu Updated Successfully';
                                    echo "<script>document.location.href='edit-submenu.php?sub_menu=$id'</script>";
                                }
                                else
                                {
                                    $_SESSION['error'] = 'Sub Menu Updating Failed';
                                    echo "<script>document.location.href='edit-submenu.php?sub_menu=$id'</script>";
                                }
                            }
                            ?>
                            <form action="" method="post">
                                <div class="form-group">
                                    <label>Select Main Menu: </label>
                                    <input type="text" name="id" hidden class="form-control" value="<?php echo $data['id'];?>">
                                    <input value="<?php echo $data['main_menu'];?>" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Sub Menu Name: </label>
                                    <input type="text" name="menu_name" class="form-control" value="<?php echo $data['menu_name'];?>">
                                </div>
                                <div class="form-group">
                                    <label>Description: </label>
                                    <textarea name="description" class="form-control"> <?php echo $data['description'];?></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="btn" class="btn btn-success" value="Update Sub Menu">
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <a class="btn btn-info float-right" href="manage-submenu.php">Back</a>
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


