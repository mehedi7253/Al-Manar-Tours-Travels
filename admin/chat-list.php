<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/6/2020
 * Time: 11:11 AM
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
                <li class="breadcrumb-item active">Chat Lsit</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-10 mx-auto mt-4 mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h3>Message List</h3>
                            <?php
                                $view_message = "SELECT id, message, image, m_id, m_name, status = 0, COUNT(m_id) FROM chating GROUP BY m_name";
                                $res = mysqli_query($connect, $view_message);

                            ?>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Name</th>
                                        <th>Reply</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($res)){?>
                                        <tr>
                                            <td><?php echo $i++;?></td>
                                            <td class="text-capitalize">
                                                <?php
                                                    $count = 0;
                                                    $sql2 = "SELECT * FROM chating WHERE status = '0' AND m_id = $row[m_id]";
                                                    $result = mysqli_query($connect, $sql2);
                                                    $count = mysqli_num_rows($result);
                                                ?>
                                                <?php echo $row['m_name'];?> <sup class="text-danger">
                                                    <?php
                                                        if ($count == 0){
                                                            echo '0';
                                                        }else{
                                                            if($count>0) { echo $count; }
                                                        }

                                                    ?> New Message</sup>
                                            </td>
                                            <td>
                                                <a class="text-decoration-none" href="reply.php?reply=<?php echo $row['m_id']?>">Reply</a>
                                            </td>
                                        </tr>
                                    <?php }?>
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




