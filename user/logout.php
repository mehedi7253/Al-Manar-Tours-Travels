<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 7/8/2020
 * Time: 5:27 PM
 */


    session_start();
    unset($_SESSION['email']); // destroy session
    session_destroy();
    header('location: login.php'); //go to login page

?>