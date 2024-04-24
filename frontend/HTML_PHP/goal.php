<?php
    session_start();

    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "fitquest";
    $conn = "";

    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

    $clientid = $_SESSION['user_id'];
    $goal = $_POST["goal"];
    $date = $_POST["date"];
    
    $goalsql = "INSERT INTO goal (client_id, goal_description, target_date) VALUES ('$clientid', '$goal', '$date')";
    mysqli_query($conn, $goalsql);

    header("Location: goal_setting.html");

    mysqli_close($conn);
    exit();
?>