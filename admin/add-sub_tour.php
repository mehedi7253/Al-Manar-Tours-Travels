<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/13/2020
 * Time: 8:08 PM
 */
?>
<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/12/2020
 * Time: 10:27 PM
 */
?>
<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/5/2020
 * Time: 2:33 PM
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
                <li class="breadcrumb-item active">Add New Sub Tour</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-10 mx-auto mt-4 mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h3>Add New Sub Tour <span class="float-right"><a class="btn btn-info" href="manage-tour.php">View all Tour</a></span></h3>
                        </div>
                        <div class="card-body">
                            <?php

                                //get main tour
                            if (isset($_GET['sub_tour'])){
                                $main_tour_id = $_GET['sub_tour'];

                                $main_tour = "SELECT * FROM tour WHERE tour_id = $main_tour_id";
                                $res_tour  = mysqli_query($connect, $main_tour);

                                $data = mysqli_fetch_assoc($res_tour);
                            }
                            if (isset($_POST['btn'])){
                                $tour_id     = $_POST['tour_id'];
                                $title       = $_POST['title'];
                                $duration    = $_POST['duration'];
                                $tour_type   = $_POST['tour_type'];
                                $package     = $_POST['package'];
                                $price       = $_POST['price'];
                                $image      = $_FILES['image']['name'];


                                //validation

                               if ($tour_id == ''){
                                   $_SESSION['tour_id'] = 'Enter Tour ID';
                               }elseif ($title == ''){
                                   $_SESSION['title'] = 'Enter Title';
                               }elseif ($duration == ''){
                                   $_SESSION['duration'] = 'Enter Duration';
                               }elseif ($tour_type == ''){
                                   $_SESSION['tour_tpe'] = 'Select Tour Type';
                               }elseif ($package == ''){
                                   $_SESSION['package'] = 'Select Package';
                               }elseif ($price == ''){
                                   $_SESSION['price'] = 'Enter Price';
                               }elseif ($image == ''){
                                   $_SESSION['image'] = 'Select Image';
                               }else{
                                   $fileinfo = PATHINFO($_FILES['image']['name']);
                                   $newFile = $fileinfo['filename']. "." . $fileinfo['extension'];
                                   move_uploaded_file($_FILES['image']['tmp_name'], "../images/" .$newFile);
                                   $location = $newFile;

                                   $sql_sub_tour = "INSERT INTO sub_tour (tour_id, title, duration, tour_type, package, price, image) VALUES ('$tour_id', '$title', '$duration', '$tour_type', '$package','$price', '$image')";
                                   $res_sub_tour = mysqli_query($connect, $sql_sub_tour);

                                   if ($res_sub_tour){
                                       $_SESSION['success'] = 'New Sub Tour Created Successfully';
                                   }else{
                                       $_SESSION['error'] = 'Creating New Sub Tour Failed..!!';
                                   }
                               }
                            }
                            ?>
                            <?php
                            if(isset($_SESSION['title'])){
                                echo "
                                    <div class='alert alert-danger alert-dismissible' id='title' style='background-color: red; color: white'>
                                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                      <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['title']."
                                    </div>
                                    ";
                                unset($_SESSION['title']);
                            }
                            if(isset($_SESSION['duration'])){
                                echo "
                                    <div class='alert alert-danger alert-dismissible' id='duration' style='background-color: red; color: white'>
                                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                      <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['duration']."
                                    </div>
                                    ";
                                unset($_SESSION['duration']);
                            }
                            if(isset($_SESSION['tour_tpe'])){
                                echo "
                                    <div class='alert alert-danger alert-dismissible' id='tour_tpe' style='background-color: red; color: white'>
                                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                      <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['tour_tpe']."
                                    </div>
                                    ";
                                unset($_SESSION['tour_tpe']);
                            }
                            if(isset($_SESSION['package'])){
                                echo "
                                    <div class='alert alert-danger alert-dismissible' id='package' style='background-color: red; color: white'>
                                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                      <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['package']."
                                    </div>
                                    ";
                                unset($_SESSION['package']);
                            }
                            if(isset($_SESSION['price'])){
                                echo "
                                    <div class='alert alert-danger alert-dismissible' id='price' style='background-color: red; color: white'>
                                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                      <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['price']."
                                    </div>
                                    ";
                                unset($_SESSION['price']);
                            }
                            if(isset($_SESSION['image'])){
                                echo "
                                    <div class='alert alert-danger alert-dismissible' id='image' style='background-color: red; color: white'>
                                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                      <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['image']."
                                    </div>
                                    ";
                                unset($_SESSION['image']);
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
                                    <label>Main Tour Name</label>
                                    <input type="text" hidden name="tour_id" value="<?php echo $data['tour_id'];?>" placeholder="Enter Title" class="form-control">
                                    <input type="text" disabled value="<?php echo $data['title'];?>" placeholder="Enter Title" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Tour Title</label>
                                    <input type="text" name="title" placeholder="Enter Title" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Tour Type</label>
                                    <select name="tour_type" class="form-control">
                                        <option>------Select One-------</option>
                                        <option value="Singe Tour">Single Tour</option>
                                        <option value="Family Tour">Family Tour</option>
                                        <option value="Group Tour">Group Tour</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Duration</label>
                                    <input type="text" name="duration" class="form-control" placeholder="Enter Duration">
                                </div>
                                <div class="form-group">
                                    <label>Package</label>
                                    <select name="package" class="form-control">
                                        <option>------Select One-------</option>
                                        <option value="vip">VIP</option>
                                        <option value="economic">Economic</option>
                                        <option value="standard">Standard</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="text" class="form-control" name="price" placeholder="Enter Price">
                                </div>
                                <div class="form-group">
                                    <label>Tour Image</label>
                                    <input type="file" name="image" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label></label>
                                    <input type="submit" name="btn" class="btn btn-success" value="Add New Sub Tour">
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
    //validation message
    $(function() {
        setTimeout(function() { $("#title").fadeOut(1500); }, 3000)
    })
    $(function() {
        setTimeout(function() { $("#duration").fadeOut(1500); }, 3000)
    })
    $(function() {
        setTimeout(function() { $("#tour_tpe").fadeOut(1500); }, 3000)
    })
    $(function() {
        setTimeout(function() { $("#tour_tpe").fadeOut(1500); }, 3000)
    })
    $(function() {
        setTimeout(function() { $("#package").fadeOut(1500); }, 3000)
    })
    $(function() {
        setTimeout(function() { $("#price").fadeOut(1500); }, 3000)
    })
    $(function() {
        setTimeout(function() { $("#image").fadeOut(1500); }, 3000)
    })
    $(function() {
        setTimeout(function() { $("#error").fadeOut(1500); }, 3000)
    })
</script>
</body>
</html>





