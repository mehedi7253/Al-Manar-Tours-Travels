<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/6/2020
 * Time: 12:02 PM
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
                <li class="breadcrumb-item active">Message Reply</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-10 mx-auto mt-4 mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-center">Well Come To Chat box  <a href="chat-list.php" class="btn btn-info float-right">Home</a></h3>
                        </div>
                        <div class="card-body" style="margin: 5px; padding: 5px; height: 400px; overflow: auto;">
                            <p>
                                <?php
                                if (isset($_GET['reply'])){
                                    $id = $_GET['reply'];

                                    $view_message = "SELECT * FROM chating WHERE m_id = $id";
                                    $res = mysqli_query($connect, $view_message);

                                    $sql="UPDATE chating SET status=1 WHERE status = 0 AND m_id = $id";
                                    $result=mysqli_query($connect, $sql);


                                    $view_message2 = "SELECT * FROM chating WHERE m_id = $id";
                                    $res2 = mysqli_query($connect, $view_message2);

                                    $repy_msg = mysqli_fetch_assoc($res2);
                                }



                                ?>
                            </p>
                            <?php while ($row = mysqli_fetch_assoc($res)){?>

                                <div class="form-group input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <img src="../images/<?php echo $row['image'];?>" style="height: 50px; width: 50px; border-radius: 50%;">  </span>
                                    </div>
                                    <input class="font-weight-bold form-control"  disabled style="height: 64px; border-radius: 15px; margin-left: 8px;" value="<?php echo $row['message'];?>">
                                </div>
                                <p class="text-muted float-right" style="font-size: 9px"><?php echo $row['date'];?></p>
                            <?php }?>
                        </div>
                        <div class="card-footer">
                            <h1 class="text-danger">
                                <?php
                                if (isset($_POST['btn'])){
                                    $msg = $_POST['message'];
                                    $image = $_POST['image'];
                                    $m_id   = $_POST['m_id'];
                                    $m_name = $_POST['m_name'];

                                    $created = @date('Y-m-d H:i:s');
                                    $sql = "INSERT INTO chating (message, m_name, image, m_id, date) VALUES ('$msg','$m_name', '$image','$m_id', '$created')";
                                    $result = mysqli_query($connect, $sql);


//                                    header('Location: replly.php');
                                    echo "<script>document.location.href='reply.php?reply=$id'</script>";
                                }
                                ?>
                            </h1>
                            <form action="" method="post" enctype="multipart/form-data">
                                <div  class="form-group input-group">
                                    <input type="text" name="message" placeholder="Write Message...." class="form-control">

                                    <input type="text" name="m_id"  hidden value="<?php echo $repy_msg['m_id'];?>" class="form-control">
                                    <input type="text" name="m_name" hidden value="<?php echo $repy_msg['m_name'];?>" class="form-control">

                                    <input type="text" name="image"  value="admin.jpg" hidden class="form-control">

                                    <div class="input-group-prepend">
                                        <button type="submit" name="btn" class="btn btn-success">Send</button>
                                    </div>
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
</body>
</html>





