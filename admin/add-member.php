<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/2/2020
 * Time: 6:52 PM
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
                <li class="breadcrumb-item active">Add New Member</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-10 mx-auto mt-4 mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h3>Add New Team Member <span class="float-right"><a class="btn btn-info" href="manage-member.php">View all Members</a></span></h3>
                        </div>
                        <div class="card-body">
                            <?php
                                if (isset($_POST['btn'])){
                                    $name       = $_POST['name'];
                                    $email      = $_POST['email'];
                                    $phone      = $_POST['phone'];
                                    $position   = $_POST['position'];
                                    $brief_desc = $_POST['application'];
                                    $image      = $_FILES['image']['name'];


                                    // check validation
                                    if ($name == "")
                                    {
                                        $_SESSION['name'] = 'Please Enter Name';
                                    }
                                    if ($email == "")
                                    {
                                        $_SESSION['emails'] = 'Please Enter Email';
                                    }
                                    if ($phone == "")
                                    {
                                        $_SESSION['phone'] = 'Please Enter Phone Number';
                                    }
                                    if ($position == "")
                                    {
                                        $_SESSION['position'] = 'Please Enter Position';
                                    }
                                    if ($brief_desc == "")
                                    {
                                        $_SESSION['desc'] = 'Please Enter Brief Description';
                                    }
                                    if ($image == "")
                                    {
                                        $_SESSION['image'] = 'Please Chose A Image';
                                    }

                                    if ($name && $email && $phone && $position && $brief_desc && $image){

                                        // upload image
                                        $fileinfo = PATHINFO($_FILES['image']['name']);
                                        $newFile = $fileinfo['filename']. "." . $fileinfo['extension'];
                                        move_uploaded_file($_FILES['image']['tmp_name'], "../images/" .$newFile);
                                        $location = $newFile;

                                        $sql = "INSERT INTO team_member (name, email, phone, position, application, image) VALUES ('$name', '$email', '$phone', '$position', '$brief_desc', '$image')"; // add member
                                        $res = mysqli_query($connect, $sql); // connect with query and database

                                        $_SESSION['success'] = 'Team Member Added Successfully';
                                    }else{
                                        $_SESSION['error'] = 'Adding New Team Member Failed..!!';
                                    }

                                }
                            ?>
                            <?php
                            // validation message
                            if(isset($_SESSION['name'])){
                                echo "
                                    <div class='alert alert-danger alert-dismissible' id='name' style='background-color: red; color: white'>
                                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                      <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['name']."
                                    </div>
                                    ";
                                unset($_SESSION['name']);
                            }
                            if(isset($_SESSION['emails'])){
                                echo "
                                    <div class='alert alert-danger alert-dismissible' id='emails' style='background-color: red; color: white'>
                                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                      <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['emails']."
                                    </div>
                                    ";
                                unset($_SESSION['emails']);
                            }
                            if(isset($_SESSION['phone'])){
                                echo "
                                    <div class='alert alert-danger alert-dismissible' id='phone' style='background-color: red; color: white'>
                                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                      <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['phone']."
                                    </div>
                                    ";
                                unset($_SESSION['phone']);
                            }
                            if(isset($_SESSION['position'])){
                                echo "
                                    <div class='alert alert-danger alert-dismissible' id='pos' style='background-color: red; color: white'>
                                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                      <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['position']."
                                    </div>
                                    ";
                                unset($_SESSION['position']);
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
                                    <label>Name</label>
                                    <input type="text" name="name" placeholder="Enter Name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" placeholder="Enter Email" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input type="text" name="phone" placeholder="Enter Phone Number" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Position</label>
                                    <input type="text" name="position" placeholder="Enter Email" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="application" id="application" class="form-control" placeholder="Enter Brief Description"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" name="image" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label></label>
                                    <input type="submit" name="btn" class="btn btn-success" value="Add New Member">
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <a href="admin_dashboard.php" class="btn btn-info float-right">Back</a>
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
    // validation message
    $(function() {
        setTimeout(function() { $("#name").fadeOut(1500); }, 3000)
    })
    $(function() {
        setTimeout(function() { $("#emails").fadeOut(1500); }, 3000)
    })
    $(function() {
        setTimeout(function() { $("#phone").fadeOut(1500); }, 3000)
    })
    $(function() {
        setTimeout(function() { $("#pos").fadeOut(1500); }, 3000)
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


