<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/1/2020
 * Time: 8:44 AM
 */
?>
    <?php
        session_start();
        if (!isset($_SESSION['email'])){
            header('Location: ../index.php');
        }

        require_once '../php/db_connect.php';


        if (isset($_GET['delete_slider']))
        {
            $id = $_GET['delete_slider'];
            $sql = "DELETE FROM sliders WHERE id = '$id'";
            $res = mysqli_query($connect, $sql);

            $_SESSION['success'] = ' Slider Deleted successfully';
            header('Location: manage-slider.php');
        }
    ?>

