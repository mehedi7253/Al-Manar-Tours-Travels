<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/5/2020
 * Time: 8:51 PM
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
                <li class="breadcrumb-item active">Add New Gallery</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-10 mx-auto mt-4 mb-5">
                    <div class="card mb-5">
                        <div class="card-header">
                            <h3>Add New Gallery <span class="float-right"><a class="btn btn-info" href="manage-gallery.php">View All Gallery</a></span></h3>
                        </div>
                        <div class="card-body">
                            <?php
                            if (isset($_POST['btn'])){
                                $title       = $_POST['title'];
                                $image      = $_FILES['image']['name'];


                                // check validation
                                if ($title == "")
                                {
                                    $_SESSION['title'] = 'Please Enter Title';
                                }
                                if ($image == "")
                                {
                                    $_SESSION['image'] = 'Please Chose A Image';
                                }

                                if ($title && $image){

                                    //upload uimage
                                    $fileinfo = PATHINFO($_FILES['image']['name']);
                                    $newFile = $fileinfo['filename']. "." . $fileinfo['extension'];
                                    move_uploaded_file($_FILES['image']['tmp_name'], "../images/" .$newFile);
                                    $location = $newFile;

                                    $sql = "INSERT INTO gallery (title, image) VALUES ('$title', '$image')"; // insert image gallery
                                    $res = mysqli_query($connect, $sql); // connect with query and database

                                    $_SESSION['success'] = 'New Gallery Added Successfully';
                                }else{
                                    $_SESSION['error'] = ' Adding New Gallery Failed..!!';
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
                                    <label>Gallery Title</label>
                                    <input type="text" name="title" placeholder="Enter Name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" name="image" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label></label>
                                    <input type="submit" name="btn" class="btn btn-success" value="Add New Gallery">
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
    //message
    $(function() {
        setTimeout(function() { $("#title").fadeOut(1500); }, 3000)
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



