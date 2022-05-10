<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/14/2020
 * Time: 8:24 PM
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
                <li class="breadcrumb-item active">Multi Menu Page</li>
            </ol>

            <?php
            if (isset($_GET['multi_page'])){
                $id = $_GET['multi_page'];

                $sql = "SELECT * FROM team_member, multi_menu, package_price, multi_menu_package WHERE 
                        multi_menu_package.multi_menu_id = multi_menu.id AND
                        multi_menu_package.package_type_id = package_price.id AND
                        multi_menu_package.member_id = team_member.id AND 
                        multi_menu_package.multi_menu_id = '$id' ";
                $res = mysqli_query($connect, $sql);
            }
            ?>
            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-12 mx-auto mt-4 mb-5">
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
                    ?>
                    <?php  while ($data = mysqli_fetch_assoc($res)){?>
                        <div class="col-md-4 col-sm-12 mt-4 float-left">
                            <div class="card">
                                <div class="card-header" style="background-color: #F7F7F7">
                                    <h3 class="text-center font-weight-bold" style="color: #0983F7"><?php echo $data['multi_menu_name'];?></h3>
                                </div>
                                <div class="card-body" style="background-color: #F7F7F7">
                                    <img src="../images/<?php echo $data['image'];?>" class="card-img-top" style="height: 200px">
                                    <p class="font-weight-bold mt-5">Package Duration: <span class="font-weight-normal text-capitalize"><?php echo $data['duration'];?></span></p><br/>
                                    <p class="font-weight-bold mt-4">Package Description: <span class="font-weight-normal text-justify"><?php echo $data['application'];?></span></p><br/>
                                    <p class="font-weight-bold mt-4">Package Price: <span class="font-weight-bold text-capitalize text-primary "><?php echo number_format($data['price'], 2);?> Taka (Per Person)</span></p><br/>
                                    <label class="font-weight-bold mt-4">Pre-Registration Info: <span class="font-weight-normal text-capitalize">
                                            <li class="ml-3">NID (National Id Card) Copy.</li>
                                            <li class="ml-3">Govt. Pre-registration Fee.</li>
                                            <li class="ml-3">Mobile Number.</li>
                                   </span>
                                    </label><br/>
                                    <h3 class=" text-capitalize font-weight-bold mt-5">Shariah Consultant</h3>
                                    <br/>
                                    <label class="font-weight-bold ml-3"><?php echo $data['name'];?></label><br/>
                                    <label class="ml-3"><?php echo $data['position'];?></label><br/>
                                </div>
                                <div class="card-footer">
                                    <a class="btn btn-danger float-right" href="delete-gallery.php?delete_multi_page=<?php echo $data['id'];?>" onclick="return confirm('Are You Sure To Delete..!')">Delete</a>
                                </div>
                            </div>
                        </div>
                    <?php }?>

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

<!-- Description -->

<div class="modal fade" id="description" tabindex="-1" role="dialog" aria-labelledby="formModal"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModal"> Tour Description</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="desc"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            </div>
        </div>
    </div>
</div>





<script>
    $(document).on('click', '.desc', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        getRow(id);
    });


    function getRow(id){
        $.ajax({
            type: 'POST',
            url: 'view_blog_desc.php',
            data: {tour_id:id},
            dataType: 'json',
            success: function(response){
                $('.tour_id').val(response.tour_id);
                $('#desc').html(response.description);

            }
        });
    }
</script>
</body>
</html>







