<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/1/2020
 * Time: 8:51 AM
 */
?>
<?php
    session_start();
    if (!isset($_SESSION['email'])){
        header('Location: ../index.php');
    }

    require_once '../php/db_connect.php';


    if (isset($_GET['delete_menu']))
    {
        $id = $_GET['delete_menu'];
        $sql = "DELETE FROM submenu WHERE id = '$id'";
        $res = mysqli_query($connect, $sql);

        $_SESSION['success'] = 'Sub Menu Deleted successfully';
        header('Location: manage-submenu.php');
    }
?>
