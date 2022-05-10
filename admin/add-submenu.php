<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 10/31/2020
 * Time: 9:43 PM
 */
?>
<?php
session_start();
if (!isset($_SESSION['email'])){
    header('Location: index.php');
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
                <li class="breadcrumb-item active">Add Sub Menu</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-10 mx-auto mt-4 mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h3>Add Submenu <span class="float-right"><a href="manage-submenu.php" class="btn btn-primary">All Sub Menu</a></span></h3>
                        </div>
                        <div class="card-body">
                            <h5>
                                <?php
                                    if (isset($_POST['btn']))
                                    {
                                        $main_menu   = $_POST['main_menu'];
                                        $menu_name   = $_POST['menu_name'];
                                        $description = $_POST['description'];

                                        //check validation
                                        if ($menu_name == ""){
                                           $_SESSION['menu_name'] = 'Please Enter Sub Menu Name';
                                        }
                                        if ($description == ""){
                                            $_SESSION['desc'] = 'Please Enter Description';
                                        }

                                        if ($main_menu && $menu_name)
                                        {
                                            $create = @date('Y-m-d H:i:s');

                                            $add_submenu = "INSERT INTO submenu (main_menu, menu_name, status, description, date) VALUES ('$main_menu', '$menu_name', '1', '$description', '$create')"; // add submenu
                                            $result      = mysqli_query($connect, $add_submenu); // connect with query and database

                                            $_SESSION['success'] = 'New Sub Menu Added successfully';
//                                        echo "<script>document.location.href='add-slider.php'</script>";
                                        }else{
                                            $_SESSION['error'] = 'Adding New Sub Menu Failed';
//                                        echo "<script>document.location.href='add-slider.php'</script>";

                                        }
                                    }
                                ?>
                            </h5>
                            <?php
                                if(isset($_SESSION['menu_name'])){
                                    echo "
                                        <div class='alert alert-danger alert-dismissible' id='hideDiv1' style='background-color: red; color: white'>
                                          <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                          <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['menu_name']."
                                        </div>
                                      ";
                                    unset($_SESSION['menu_name']);
                                }
                                if(isset($_SESSION['desc'])){
                                    echo "
                                                <div class='alert alert-danger alert-dismissible' id='desc' style='background-color: red; color: white'>
                                                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                  <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['desc']."
                                                </div>
                                          ";
                                    unset($_SESSION['desc']);
                                }
                                if(isset($_SESSION['error'])){
                                    echo "
                                        <div class='alert alert-danger alert-dismissible' id='hideDiv' style='background-color: red; color: white'>
                                          <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                          <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['error']."
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
                                    <label>Select Main Menu: </label>
                                    <select class="form-control" name="main_menu">
                                        <option>-------Select one--------</option>
                                        <option value="hajj_offers">Hajj Offers</option>
                                        <option value="umrah_offers">Umrah Offers</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Sub Menu Name: </label>
                                    <input type="text" name="menu_name" class="form-control" placeholder="Enter Sub Menu Name">
                                </div>
                                <div class="form-group">
                                    <label>Sub Menu Description: </label>
                                    <textarea name="description" class="form-control" placeholder="Enter Description"></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="btn" class="btn btn-success" value="Add New Sub Menu">
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


<?php include "front/footer.php";?>
<script>
    $(function() {
        setTimeout(function() { $("#hideDiv").fadeOut(1500); }, 5000)
    })

    $(function() {
        setTimeout(function() { $("#hideDiv1").fadeOut(1500); }, 5000)

    })
    $(function() {
        setTimeout(function() { $("#desc").fadeOut(1500); }, 5000)

    })
</script>
</body>
</html>


