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
                <li class="breadcrumb-item active">Manage Event</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-12 mx-auto mt-4 mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h4>Manage Event <span class="float-right"><a href="add-event.php" class="btn btn-primary">Add Event</a></span></h4>
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
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Description</th>
                                        <th>Banner</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="myTable">
                                    <?php
                                        $select_event = "SELECT * FROM event";
                                        $result_event = mysqli_query($connect, $select_event);
                                    ?>
                                    <?php
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($result_event)){?>
                                        <tr class="text-center">
                                            <td><?php echo $i++;?></td>
                                            <td><?php echo $row['title'];?></td>
                                            <td class="text-capitalize"><?php echo $row['date'];?></td>
                                            <td><?php echo $row['time'];?></td>
                                            <td>
                                                <a href='#description' data-toggle='modal' class='btn btn-info btn-sm btn-flat desc' data-id='<?php echo $row['id'];?>'><i class='fa fa-eye'></i> View</a>
                                            </td>
                                            <td>
                                                <img src="../images/<?php echo $row['image'];?>" style="height: 50px; width: 50px">
                                            </td>
                                            <td>
                                                <a href="delete-event.php?delete_event=<?php echo $row['id'];?>" onclick="return confirm('Are You Sure To Remove...!!')" class="btn btn-danger">Delete</a>
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
                <h5 class="modal-title" id="formModal"> Event Description</h5>
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
            data: {id:id},
            dataType: 'json',
            success: function(response){
                $('.id').val(response.blog_id);
                $('#desc').html(response.application);

            }
        });
    }
</script>


<script>
    $(document).ready(function(){
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
</body>
</html>


