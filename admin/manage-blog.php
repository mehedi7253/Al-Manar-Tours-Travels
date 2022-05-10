<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/5/2020
 * Time: 2:34 PM
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
                <li class="breadcrumb-item active">Manage Blogs</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-12 mx-auto mt-4 mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h4>Manage Blogs <span class="float-right"><a href="add-blog.php" class="btn btn-primary">Add Blog</a></span></h4>
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
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $select_blog = "SELECT * FROM blogs";
                                    $result_blog = mysqli_query($connect, $select_blog);
                                    ?>
                                    <?php
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($result_blog)){?>
                                        <tr class="text-center">
                                            <td><?php echo $i++;?></td>
                                            <td><?php echo $row['title'];?></td>
                                            <td>
                                                <a href='#description' data-toggle='modal' class='btn btn-info btn-sm btn-flat desc' data-id='<?php echo $row['blog_id'];?>'><i class='fa fa-eye'></i> View</a>
                                            </td>
                                            <td>
                                                <img src="../images/<?php echo $row['image'];?>" style="height: 50px; width: 50px">
                                            </td>
                                            <td>
                                                <?php
                                                $status = $row['status'];
                                                if (($status) == '0'){?>
                                                    <a href="blog_publish.php?status=<?php echo $row['blog_id'];?>" class="btn btn-success" onclick="return confirm('Are You Sure To Un-publish')">Published</a>
                                                    <?php
                                                }
                                                if (($status) == '1'){?>
                                                    <a href="blog_publish.php?status=<?php echo $row['blog_id'];?>" class="btn btn-danger" onclick="return confirm('Are You Sure To Published')">Publish Now</a>
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <a href="edit-blog.php?blog=<?php echo $row['blog_id'];?>" class="btn btn-info">Edit</a>
                                                <a href="delete-gallery.php?delete_blog=<?php echo $row['blog_id']?>" class="btn btn-danger">Delete</a>
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

</body>
</html>



<!-- Description -->

<div class="modal fade" id="description" tabindex="-1" role="dialog" aria-labelledby="formModal"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModal"> Blog Description</h5>
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
            data: {blog_id:id},
            dataType: 'json',
            success: function(response){
                $('.blog_id').val(response.blog_id);
                $('#desc').html(response.application);

            }
        });
    }
</script>

