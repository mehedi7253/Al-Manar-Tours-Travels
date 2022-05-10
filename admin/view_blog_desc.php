<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/5/2020
 * Time: 3:23 PM
 */

    require_once "../php/db_connect.php";

    if (isset($_POST['blog_id'])){
        $id = $_POST['blog_id'];

        $sql = "SELECT * FROM blogs WHERE blog_id = $id";
        $res = mysqli_query($connect, $sql);

        $row = mysqli_fetch_assoc($res);

        echo json_encode($row);
    }

    if (isset($_POST['id'])){
        $id = $_POST['id'];

        $sql_event = "SELECT * FROM event WHERE id = $id";
        $res_event = mysqli_query($connect, $sql_event);

        $row = mysqli_fetch_assoc($res_event);

        echo json_encode($row);
    }



    if (isset($_POST['tour_id'])){
        $tour_id = $_POST['tour_id'];

        $sql_tour = "SELECT * FROM tour WHERE tour_id = $tour_id";
        $res_tour = mysqli_query($connect, $sql_tour);

        $row = mysqli_fetch_assoc($res_tour);

        echo json_encode($row);
    }

    if (isset($_POST['id'])){
        $tour_id = $_POST['id'];

        $sql_tour2 = "SELECT * FROM tour WHERE tour_id = $tour_id";
        $res_tour2 = mysqli_query($connect, $sql_tour2);

        $row = mysqli_fetch_assoc($res_tour2);

        echo json_encode($row);
    }



?>

