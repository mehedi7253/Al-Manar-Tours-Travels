<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/2/2020
 * Time: 8:11 PM
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
                <li class="breadcrumb-item active">Add New Event</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-10 mx-auto mt-4 mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h3>Add New Event <span class="float-right"><a class="btn btn-info" href="manage-event.php">View all Event</a></span></h3>
                        </div>
                        <div class="card-body">
                            <?php
                            if (isset($_POST['btn'])){
                                $title       = $_POST['title'];
                                $date        = $_POST['date'];
                                $time        = $_POST['time'];
                                $description = $_POST['application'];
                                $image      = $_FILES['image']['name'];


                                // check validation
                                if ($title == "")
                                {
                                    $_SESSION['title'] = 'Please Enter Title';
                                }
                                if ($date == "")
                                {
                                    $_SESSION['date'] = 'Please Select Date';
                                }
                                if ($time == "")
                                {
                                    $_SESSION['time'] = 'Please Select Time';
                                }
                                if ($description == "")
                                {
                                    $_SESSION['desc'] = 'Please Enter Brief Description';
                                }
                                if ($image == "")
                                {
                                    $_SESSION['image'] = 'Please Chose A banner';
                                }

                                if ($title && $date && $time && $description && $image){

                                    //imae upload
                                    $fileinfo = PATHINFO($_FILES['image']['name']);
                                    $newFile = $fileinfo['filename']. "." . $fileinfo['extension'];
                                    move_uploaded_file($_FILES['image']['tmp_name'], "../images/" .$newFile);
                                    $location = $newFile;

                                    $sql = "INSERT INTO event (title, date, time, application, image, status) VALUES ('$title', '$date', '$time', '$description', '$image', '0')"; // insert event data into databse
                                    $res = mysqli_query($connect, $sql); // connect with query and database

                                    $_SESSION['success'] = 'New Event Added Successfully';
                                }else{
                                    $_SESSION['error'] = 'Adding New Event Failed..!!';
                                }

                            }
                            ?>
                            <?php
                            //validation messahge
                            if(isset($_SESSION['title'])){
                                echo "
                                    <div class='alert alert-danger alert-dismissible' id='title' style='background-color: red; color: white'>
                                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                      <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['title']."
                                    </div>
                                    ";
                                unset($_SESSION['title']);
                            }
                            if(isset($_SESSION['date'])){
                                echo "
                                    <div class='alert alert-danger alert-dismissible' id='date' style='background-color: red; color: white'>
                                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                      <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['date']."
                                    </div>
                                    ";
                                unset($_SESSION['date']);
                            }
                            if(isset($_SESSION['time'])){
                                echo "
                                    <div class='alert alert-danger alert-dismissible' id='time' style='background-color: red; color: white'>
                                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                      <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['time']."
                                    </div>
                                    ";
                                unset($_SESSION['time']);
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
                            if(isset($_SESSION['image'])){
                                echo "
                                    <div class='alert alert-danger alert-dismissible' id='image' style='background-color: red; color: white'>
                                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                      <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['image']."
                                    </div>
                                    ";
                                unset($_SESSION['image']);
                            }
                            if(isset($_SESSION['error'])){
                                echo "
                                    <div class='alert alert-danger alert-dismissible' id='error' style='background-color: red; color: white'>
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
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Event Title</label>
                                    <input type="text" name="title" placeholder="Enter Name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Event Date</label>
                                    <input type="date" name="date"  class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Event Time</label>
                                    <input type="time" name="time" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="application" id="application" class="form-control" placeholder="Enter Brief Description"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Banner</label>
                                    <input type="file" name="image" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label></label>
                                    <input type="submit" name="btn" class="btn btn-success" value="Add New Event">
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
<script>
    $(function() {
        setTimeout(function() { $("#title").fadeOut(1500); }, 3000)
    })
    $(function() {
        setTimeout(function() { $("#date").fadeOut(1500); }, 3000)
    })
    $(function() {
        setTimeout(function() { $("#time").fadeOut(1500); }, 3000)
    })
    $(function() {
        setTimeout(function() { $("#desc").fadeOut(1500); }, 3000)
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



