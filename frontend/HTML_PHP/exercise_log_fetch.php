<?php
    session_start();

    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "fitquest";
    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

    $fetchsql = "SELECT exercise_name FROM exercise";
    $result = mysqli_query($conn, $fetchsql);

    $items = [];
    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
    }

    mysqli_close($conn);
    exit();
?>