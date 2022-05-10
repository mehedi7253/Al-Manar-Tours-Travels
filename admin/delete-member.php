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


    if (isset($_GET['delete_member']))
    {
        $id = $_GET['delete_member'];
        $sql = "DELETE FROM team_member WHERE id = '$id'";
        $res = mysqli_query($connect, $sql);

        $_SESSION['success'] = 'Member Removed successfully';
        header('Location: manage-member.php');
    }
?>

