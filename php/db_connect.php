<?php


    $servername = "almanar-server.mysql.database.azure.com";
    $username   = "xzepnnomko";
    $password   = "855G5M5SOB6TMVQ0$";
    $dbname     = "almanar-database";

    // crearte connection
    $connect = new Mysqli($servername, $username, $password, $dbname);

    // check connection
    if($connect->connect_error) {
        die("Connection Failed : " . $connect->error);
    } else {
        // echo "Successfully Connected";
    }


?>
