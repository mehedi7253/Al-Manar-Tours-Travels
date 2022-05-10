<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/2/2020
 * Time: 9:40 PM
 */


    session_start();
    if (!isset($_SESSION['email'])){
        header('Location: ../index.php');
    }

    require_once '../php/db_connect.php';


    if (isset($_GET['delete_event']))
    {
        $id = $_GET['delete_event'];

        $sql = "DELETE FROM event WHERE id = '$id'";
        $res = mysqli_query($connect, $sql);

        $_SESSION['success'] = 'Event Deleted successfully';
        header('Location: manage-event.php');
    }

?>

