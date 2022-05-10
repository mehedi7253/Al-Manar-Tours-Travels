<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/4/2020
 * Time: 8:30 PM
 */
?>

<style>
    #topBtn{
        position: fixed;
        bottom: 40px;
        left: 40px;
        font-size: 22px;
        width: 50px;
        height: 50px;
        background: gray;
        color: white;
        border: none;
        cursor: pointer;
        display: none;
    }
    #topBtn:hover{
        background-color: black;
        color: white;
    }
    .open-button {
        /*background-color: red;*/
        color: #1c7430;
        padding: 16px 20px;
        border: none;
        cursor: pointer;
        opacity: 0.8;
        position: fixed;
        bottom: 23px;
        right: 28px;

        /*width: 280px;*/
    }

    /* The popup chat - hidden by default */
    .chat-popup {
        display: none;
        position: fixed;
        bottom: 0;
        right: 15px;
        border: 3px solid #f1f1f1;
        z-index: 9;
    }

    /* Add styles to the form container */
    .form-container {
        max-width: 400px;
        padding: 10px;
        background-color: white;
    }

    /* Set a style for the submit/send button */
    .form-container .cancel {
        background-color: #4CAF50;
        color: white;
        padding: 16px 20px;
        border: none;
        cursor: pointer;
        width: 100%;
        margin-bottom:10px;
        opacity: 0.8;
    }

    /* Add a red background color to the cancel button */
    .form-container .cancel {
        background-color: red;
    }

    /* Add some hover effects to buttons */
    .form-container .btn:hover, .open-button:hover {
        opacity: 1;
    }
</style>
<button id="topBtn"><i class="fas fa-arrow-up"></i></button>



<img src="../images/Chat-now.png" class="open-button" onclick="openForm()" style="height: 120px; width: 150px; ">

<!--    <i class="fas fa-comment open-button fa-3x" onclick="openForm()"></i>-->
<div class="chat-popup" id="myForm">
    <?php
    // check login
    if (not_logged_in() === true)
    {
        $m = '<span class="text-danger font-weight-bold mt-5">Please login first</span>';
    }else{
        if (isset($_POST['btn_msg']))
        {
            $msg    = $_POST['message'];
            $image  = $_POST['image'];
            $m_id   = $_POST['m_id'];
            $m_name = $_POST['m_name'];

            if ($msg && $image && $m_id && $m_name)
            {
                $created = @date('Y-m-d H:i:s');

                $chat = "INSERT INTO chating (message, image, m_id, m_name, date, status) VALUES ('$msg', '$image', '$m_id', '$m_name', '$created', '0')";
                $res_chat = mysqli_query($connect, $chat);
            }
        }
    }
    ?>
    <form action="" class="form-container" method="post">
        <h3>Chat With Admin</h3>
        <div class="card-body"  style="margin: 5px; padding: 5px; height: 300px; overflow: auto;">
            <?php
            if (not_logged_in() === true)
            {
                echo $m;
            }else{
                if (isset($_SESSION['id'])){
                    $id = $_SESSION['id'];

                    $view_message = "SELECT * FROM chating WHERE m_id = $id ORDER BY date ASC";
                    $res_msg = mysqli_query($connect, $view_message);

                    while ($msg = mysqli_fetch_assoc($res_msg)){?>
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <img src="../images/<?php echo $msg['image'];?>" style="height: 50px; width: 50px; border-radius: 50%;">
                            </div>
                            <input type="text" class="font-weight-bold form-control" value="<?php echo $msg['message'];?>" disabled style="height: 50px; border-radius: 16px; margin-left: 6px; margin-top: 10px">
                        </div>
                        <p class="text-dark float-right" style="font-size: 9px"><?php echo $msg['date'];?></p>
                    <?php }
                }
            }

            ?>
        </div>
        <div class="card-footer">
            <!--                <form action="" method="post" enctype="multipart/form-data">-->
            <div  class="form-group input-group">
                <input type="text" name="message" placeholder="Write Message...." class="form-control">
                <input type="number" name="m_id" hidden value="<?php echo $userdata['id'];?>" class="form-control">
                <input type="text" name="m_name"  hidden value="<?php echo $userdata['first_name'];?> <?php echo $userdata['last_name'];?>" class="form-control">
                <input type="text" name="image" hidden value="<?php echo $userdata['image'];?>" class="form-control">

                <div class="input-group-prepend">
                    <input type="submit" name="btn_msg" class="btn btn-info" value="send">
                </div>
            </div>
            <!--                </form>-->
        </div>
        <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
    </form>
</div>


<script>
    function openForm() {
        document.getElementById("myForm").style.display = "block";
    }

    function closeForm() {
        document.getElementById("myForm").style.display = "none";
    }
</script>
