<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/13/2020
 * Time: 8:45 PM
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
                <li class="breadcrumb-item active">Manage Sub Tours</li>
            </ol>

            <?php
                if (isset($_GET['all_tour'])){
                    $id = $_GET['all_tour'];

                    $sql = "SELECT * FROM sub_tour WHERE tour_id = $id";
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
                    <?php $i = 1; while ($row = mysqli_fetch_assoc($res)){?>
                        <div class="col-md-4 col-sm-12 mt-4 float-left">
                            <div class="card">
                                <h3 class="text-center">Sub Tour <?php echo $i++;?></h3>
                                <hr style="border: 1px solid silver"/>
                                <img src="../images/<?php echo $row['image'];?>" class="card-img-top" style="height: 250px">
                              <div class="card-body">
                                  <h5 class="text-center font-weight-bold"><?php echo $row['title'];?></h5><br/>
                                  <p class="text-center font-weight-bold">Duration: <?php echo $row['duration'];?></p><br/>
                                  <p class="text-center font-weight-bold text-capitalize"> Package: <?php echo $row['package'];?></p><br/>
                                  <p class="text-center font-weight-bold">Tour Type: <?php echo $row['tour_type'];?></p><br/>
                                  <p class="text-center font-weight-bold">Price: <?php echo number_format($row['price'], 2);?> T.K</p><br/>
                              </div>
                                <div class="card-footer">
                                    <a href="delete-gallery.php?delete_sub=<?php echo $row['sub_tour_id'];?>" class="btn btn-danger float-right" onclick="return confirm('Are Sure To Delete...!!')">Delete</a>
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






