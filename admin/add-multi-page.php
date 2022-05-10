<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/14/2020
 * Time: 7:33 PM
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
                <li class="breadcrumb-item active">Add Multi Menu Package</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-10 mx-auto mt-4 mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h3>Add Multi Menu Package <span class="float-right"><a href="manage-multi.php" class="btn btn-info">All Multi Page's</a></span></h3>
                        </div>
                        <div class="card-body">
                            <?php
                            if (isset($_GET['multi_page'])){
                                $id = $_GET['multi_page'];

                                $multi_menu = "SELECT * FROM multi_menu WHERE id = '$id'";
                                $res_menu   = mysqli_query($connect, $multi_menu);

                                $data = mysqli_fetch_assoc($res_menu);
                            }
                            if (isset($_POST['package']))
                            {
                                $multi_menu_id = $_POST['multi_menu_id'];
                                $pakage_type   = $_POST['package_type_id'];
                                $duration      = $_POST['duration'];
                                $application   = $_POST['application'];
                                $team_member   = $_POST['member_id'];
                                $image         = $_FILES['image']['name'];


                                // check validation
                                if ($duration == "")
                                {
                                    $_SESSION['duration'] = 'Please Enter package Duration';
                                }
//
                                if ($application == "")
                                {
                                    $_SESSION['app'] = 'Please Enter Package Details';
                                }
                                if ($image == "")
                                {
                                    $_SESSION['image'] = 'Please Chose a Package Image';
                                }

                                if ($pakage_type && $duration && $application && $image) {
                                    // upload image
                                    $fileinfo = PATHINFO($_FILES['image']['name']);
                                    $newFile = $fileinfo['filename'] . "." . $fileinfo['extension'];
                                    move_uploaded_file($_FILES['image']['tmp_name'], "../images/" . $newFile);
                                    $location = $newFile;

                                    $add_package = "INSERT INTO multi_menu_package (multi_menu_id, package_type_id, duration, application, member_id, image) VALUES ('$multi_menu_id', '$pakage_type', '$duration', '$application', '$team_member', '$image')";
                                    $result_pack = mysqli_query($connect, $add_package); // connect with query and database

                                    $_SESSION['success'] = 'New Multi Package Added Successfully';
                                }else{
                                    $_SESSION['error'] = 'Adding New Multi Package Failed';
                                }
                            }
                            ?>
                            <?php
                            if(isset($_SESSION['duration'])){
                                echo "
                                            <div class='alert alert-danger alert-dismissible' id='duration' style='background-color: red; color: white'>
                                              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                              <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['duration']."
                                            </div>
                                          ";
                                unset($_SESSION['duration']);
                            }
                            if(isset($_SESSION['app'])){
                                echo "
                                                <div class='alert alert-danger alert-dismissible' id='app' style='background-color: red; color: white'>
                                                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                  <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['app']."
                                                </div>
                                              ";
                                unset($_SESSION['app']);
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
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Main Multi Menu</label>
                                    <input type="text" disabled class="form-control" value="<?php echo $data['multi_menu_name'];?>">
                                    <input type="text" hidden class="form-control" name="multi_menu_id" value="<?php echo $data['id'];?>">
                                </div>
                                <div class="form-group">
                                    <label>Select Package Type</label>
                                    <select name="package_type_id" class="form-control">
                                        <?php
                                        $sql = "SELECT * FROM package_price";
                                        $res = mysqli_query($connect, $sql);

                                        echo '<option>--------Select Package Type---------</option>';
                                        while ($price = mysqli_fetch_assoc($res)){?>
                                            <option value="<?php echo $price['id'];?>"><?php echo $price['package_name'];?></option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Select Shariah Consultant</label>
                                    <?php
                                    $select_member = "SELECT * FROM team_member";
                                    $res_member    = mysqli_query($connect, $select_member);
                                    ?>
                                    <select name="member_id" class="form-control">
                                        <option>--------Select One---------</option>
                                        <?php
                                        while ($member = mysqli_fetch_assoc($res_member)){?>
                                            <option value="<?php echo $member['id'];?>"><?php echo $member['name'];?> </option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Package Duration</label>
                                    <input type="text" name="duration" class="form-control" placeholder="Enter Package Duration" value="<?php if($_POST) {
                                        echo $_POST['duration'];
                                    } ?>">
                                </div>

                                <div class="form-group">
                                    <label>Package Details</label>
                                    <textarea class="form-control" id="application" name="application" placeholder="Write Description"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Chose Image</label>
                                    <input type="file" name="image" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label></label>
                                    <input type="submit" name="package" class="btn btn-success" value="Add New Multi Package">
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
        setTimeout(function() { $("#duration").fadeOut(1500); }, 3000)
    })

    //    $(function() {
    //        setTimeout(function() { $("#price").fadeOut(1500); }, 3000)
    //
    //    })
    $(function() {
        setTimeout(function() { $("#description").fadeOut(1500); }, 3000)
    })

    $(function() {
        setTimeout(function() { $("#app").fadeOut(1500); }, 3000)

    })
    $(function() {
        setTimeout(function() { $("#image").fadeOut(1500); }, 3000)
    })
    $(function() {
        setTimeout(function() { $("#hideDiv").fadeOut(1500); }, 3000)
    })
</script>
</body>
</html>



