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
 * Date: 11/1/2020
 * Time: 11:56 AM
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
                <li class="breadcrumb-item active">Manage Tours</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-12 mx-auto mt-4 mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h4>Manage Tours <span class="float-right"><a href="add-tour.php" class="btn btn-primary">Add Tour</a></span></h4>
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
                            ?>
                            <div class="table-responsive">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                    <tr class="text-center">
                                        <th>Serial</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Add More</th>
                                        <th>Sub Tour Page</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $select_tour = "SELECT * FROM tour"; //  get all tour data
                                        $result_tour = mysqli_query($connect, $select_tour); // connect with database
                                    ?>
                                    <?php
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($result_tour)){?>
                                        <tr class="text-center">
                                            <td><?php echo $i++;?></td>
                                            <td><?php echo $row['title'];?></td>
                                            <td>
                                                <a href='#description' data-toggle='modal' class='btn btn-info btn-sm btn-flat desc' data-id='<?php echo $row['tour_id'];?>'><i class='fa fa-eye'></i> View</a>
                                            </td>
                                            <td>
                                                <a class="btn btn-primary" href="add-sub_tour.php?sub_tour=<?php echo $row['tour_id'];?>">Add More</a>
                                            </td>
                                            <td>
                                                <a class="btn btn-primary" href="all-sub_tour.php?all_tour=<?php echo $row['tour_id'];?>"><i class='fa fa-eye'></i> View</a>
                                            </td>
                                            <td>
                                                <a href="delete-gallery.php?delete_tour=<?php echo $row['tour_id'];?>" onclick="return confirm('Are You Sure To Delete...!!')" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
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





