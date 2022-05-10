<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/6/2020
 * Time: 10:20 AM
 */

    session_start();
    if (!isset($_SESSION['email'])){
        header('Location: ../index.php');
    }

    require_once '../php/db_connect.php';


    if (isset($_GET['delete']))
    {
        $id = $_GET['delete'];

        $sql = "DELETE FROM gallery WHERE gallery_id = '$id'";
        $res = mysqli_query($connect, $sql);

        $_SESSION['success'] = 'Gallery Deleted successfully';
        header('Location: manage-gallery.php');
    }


    if (isset($_GET['delete_sub']))
    {
        $id_del = $_GET['delete_sub'];

        $sql_del = "DELETE FROM sub_gallery WHERE id = '$id_del'";
        $res_del = mysqli_query($connect, $sql_del);

        $del_red = $_SESSION['del'];

        $_SESSION['success'] = 'Image Deleted successfully';
        echo "<script>document.location.href='add-sub-image.php?add_more=$del_red'</script>";

    }


    if (isset($_GET['delete_blog']))
    {
        $id_blog = $_GET['delete_blog'];

        $sql_del = "DELETE FROM blogs WHERE blog_id = '$id_blog'";
        $res_del = mysqli_query($connect, $sql_del);

        $_SESSION['success'] = 'Blog Deleted successfully';

        header('Location: manage-blog.php');
    }

    if (isset($_GET['delete_package']))
    {
        $id_package = $_GET['delete_package'];

        $sql_del = "DELETE FROM packages WHERE pakage_id = '$id_package'";
        $res_del = mysqli_query($connect, $sql_del);

        $_SESSION['success'] = 'Package Deleted successfully';

        header('Location: manage-packages.php');
    }

    if (isset($_GET['delete_multi_menu']))
    {
        $id_multi = $_GET['delete_multi_menu'];

        $sql_del = "DELETE FROM multi_menu WHERE id = '$id_multi'";
        $res_del = mysqli_query($connect, $sql_del);

        $_SESSION['success'] = 'Multi Menu Deleted successfully';

        header('Location: manage-multi.php');
    }


    if (isset($_GET['delete_sub']))
    {
        $id_sub_tour = $_GET['delete_sub'];

        $sql_del = "DELETE FROM sub_tour WHERE sub_tour_id = '$id_sub_tour'";
        $res_del = mysqli_query($connect, $sql_del);

        $del_sub_image = $_SESSION['del'];

        $_SESSION['success'] = 'Image Deleted successful';
        echo "<script>document.location.href='add-sub-image.php?add_more=$del_sub_image'</script>";
    }

    if (isset($_GET['delete_tour']))
    {
        $id_tour = $_GET['delete_tour'];

        $sql_del = "DELETE FROM tour WHERE tour_id = '$id_tour'";
        $res_del = mysqli_query($connect, $sql_del);

        header('Location: manage-tour.php');
    }

    if (isset($_GET['delete_multi_page']))
    {
        $id_multi_page = $_GET['delete_multi_page'];

        $sql_del = "DELETE FROM multi_menu_package WHERE id = '$id_multi_page'";
        $res_del = mysqli_query($connect, $sql_del);

        $_SESSION['success'] = 'Multi Menu Page Deleted successfully';

        header('Location: manage-multi.php');
    }

    if (isset($_GET['delete_package']))
    {
        $delete_package_id = $_GET['delete_package'];

        $sql_del = "DELETE FROM package_price WHERE id = '$delete_package_id'";
        $res_del = mysqli_query($connect, $sql_del);

        $_SESSION['success'] = 'Package Deleted successfully';

        header('Location: manage-price.php');
    }






?>