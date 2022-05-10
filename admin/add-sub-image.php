<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/5/2020
 * Time: 9:06 PM
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
                <li class="breadcrumb-item active">Add More Image</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-12 mx-auto mt-4 mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h3>Add More Gallery Image<span class="float-right"><a class="btn btn-info" href="manage-gallery.php">View All Gallery</a></span></h3>

                            <?php
                                if (isset($_GET['add_more'])){ // get main image id
                                    $id = $_GET['add_more'];
                                    $_SESSION['del'] = $id;
                                    $sql_get_image = "SELECT * FROM gallery WHERE gallery_id = $id"; //get image
                                    $res_image     = mysqli_query($connect, $sql_get_image); // connect with query and database

                                    $image = mysqli_fetch_assoc($res_image);
                                }
                            ?>
                        </div>
                        <div class="card-body">
                            <?php
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
                            <?php

                            if(isset($_POST['btn'])) {
                                //upload multiple image
                                foreach ($_FILES['image']['name'] as $key => $images) {
                                    $gallery_id = $_POST['gallery_id'];
                                    $image      = $_FILES['image']['name'] [$key];
//
                                    if ($image == "")
                                    {
                                        $_SESSION['image'] = 'Please Chose A Image';
                                    }


                                    if ($gallery_id && $images){
                                        $fileinfo = PATHINFO($_FILES['image']['name'][$key]);
                                        $newFile = $fileinfo['filename']. "." . $fileinfo['extension'];
                                        move_uploaded_file($_FILES['image']['tmp_name'][$key], "../images/" .$newFile);
                                        $location = $newFile;

                                        $sql = "INSERT INTO sub_gallery (gallery_id, image) VALUES ('$gallery_id', '$image')";
                                        $res = mysqli_query($connect, $sql);

                                        $_SESSION['success'] = 'Images Uploaded Successfully';
                                        echo "<script>document.location.href='add-sub-image.php?add_more=$id'</script>";
                                    }else{
                                        $_SESSION['error'] = 'Image Uploading Failed';
                                        echo "<script>document.location.href='add-sub-image.php?add_more=$id'</script>";
                                    }
                                }
                            }
                            ?>
                            <div class="col-md-5 col-sm-12 float-left">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Main Image</h5>
                                    </div>
                                    <div class="card-body">
                                        <img src="../images/<?php echo $image['image'];?>" style="height: 150px; width: 150px">
                                    </div>
                                    <div class="card-footer">
                                        <span class="text-center font-weight-bold">Add More image</span>
                                        <hr style="border-bottom: 1px solid silver"/>

                                        <form action="" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label>Chose Image</label>
                                                <input name="gallery_id" hidden value="<?php echo $image['gallery_id'];?>">
                                                <input type="file" name="image[]" class="form-control" multiple>
                                            </div>
                                            <div class="form-group">
                                                <label></label>
                                                <input type="submit" name="btn" class="btn btn-success" value="Upload">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7 col-sm-12 float-left">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="text-info">Sub Images</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr class="text-center">
                                                    <th>#</th>
                                                    <th>Image</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                    $sql_sub_image = "SELECT * FROM sub_gallery WHERE gallery_id = '$id'"; //fetch all image from sub gallery where gallery image id is equal equal sub galleryy image galler_id
                                                    $res_sub_image = mysqli_query($connect, $sql_sub_image); //connect with database and execute sql

                                                    $i = 1;
                                                    while ($imag = mysqli_fetch_assoc($res_sub_image)){?>
                                                        <tr class="text-center">
                                                            <td><?php echo $i++?></td>
                                                            <td>
                                                                <img src="../images/<?php echo $imag['image'];?>" style="height: 100px; width: 100px">
                                                            </td>
                                                            <td>
                                                                <a href="delete-gallery.php?delete_sub=<?php echo $imag['id'];?>" class="btn btn-danger" onclick="return confirm('Are you Sure To Delete...!!!')">Delete</a>
                                                            </td>
                                                        </tr>
                                                    <?php }
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="add-gallery.php" class="btn btn-info float-right">Back</a>
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
        setTimeout(function() { $("#image").fadeOut(1500); }, 3000)
    })
    $(function() {
        setTimeout(function() { $("#error").fadeOut(1500); }, 3000)
    })
</script>
</body>
</html>




