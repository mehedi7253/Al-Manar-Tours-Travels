<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/6/2020
 * Time: 10:48 AM
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
                <li class="breadcrumb-item active">Update Blog</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-10 mx-auto mt-4 mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update Blog</h4>
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
                            if (isset($_GET['blog']))
                            {
                                $id = $_GET['blog'];

                                $sql = "SELECT * FROM blogs WHERE blog_id = '$id'";
                                $res = mysqli_query($connect, $sql);
                                $data = mysqli_fetch_assoc($res);
                            }
                            if (isset($_POST['blog_up'])){
                                $blog_id     = $_POST['blog_id'];
                                $title       = $_POST['title'];
                                $description = $_POST['application'];

                                if ($title && $description)
                                {
                                    $sql_up = "UPDATE blogs SET title = '$title', application = '$description' WHERE blog_id = $blog_id";
                                    $res_up = mysqli_query($connect, $sql_up);

                                    $_SESSION['success'] = 'Blog Updated Successfully';
                                    echo "<script>document.location.href='edit-blog.php?blog=$id'</script>";

                                }else{
                                    $_SESSION['error'] = 'Blog Updating Failed';
                                    echo "<script>document.location.href='edit-blog.php?blog=$id'</script>";

                                }

                            }
                            ?>
                            <form action="" method="post">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input name="blog_id" class="form-control" hidden value="<?php echo $data['blog_id'];?>">
                                    <input class="form-control" name="title" type="text" value="<?php echo $data['title'];?>">
                                </div>
                                <div class="form-group">
                                    <label>Blog Description</label>
                                    <textarea name="application" id="application" class="form-control" placeholder="Enter Brief Description"><?php echo $data['application'];?></textarea>
                                </div>
                                <div class="form-group">
                                    <label></label>
                                    <input type="submit" name="blog_up" class="btn btn-success" value="Update Blog">
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <a href="manage-blog.php" class="btn btn-info float-right">Back</a>
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
</body>
</html>



