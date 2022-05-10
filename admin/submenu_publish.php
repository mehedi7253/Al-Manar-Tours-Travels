<?php

require_once '../php/db_connect.php';

if (isset($_GET['status'])){
    $status1 = $_GET['status'];

    $sql = "SELECT * FROM submenu WHERE id='$status1'";

    $result = mysqli_query($connect, $sql);

    while ($row = mysqli_fetch_object($result)){
        $status_var = $row->status;

        if ($status_var == '0'){
            $status_state = 1;
        }else{
            $status_state = 0;
        }
        $update = "UPDATE submenu SET status = '$status_state' WHERE id = '$status1'";

        $res = mysqli_query($connect, $update);

        if ($res){
            header('Location: manage-submenu.php');
        }else{
            echo  mysqli_error($res);
        }
    }
}

?>