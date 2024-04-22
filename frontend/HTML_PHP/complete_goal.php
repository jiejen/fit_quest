<?php
    session_start();

    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "fitquest";
    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

    $cid = $_SESSION['user_id'];
    $goal = $_POST["goal"];

    $goalquery = "DELETE FROM goal WHERE goal_description = '$goal'";
    $result = mysqli_query($conn, $goalquery);
    
    header("Location: view_goals.php");

    mysqli_close($conn);
    exit();
?>