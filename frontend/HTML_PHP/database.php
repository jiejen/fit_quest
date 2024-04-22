<?php
    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "fitquest";
    $conn = "";

    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
    if($conn){
        echo"You are connected!";
    }
    else{
        echo"Could not connect!";
    }
    mysqli_close($conn);
?>