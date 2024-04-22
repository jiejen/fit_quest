<?php
    session_start();

    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "fitquest";
    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

    $cid = $_SESSION['user_id'];
    $food = $_POST["food"];
    $dt = $_POST["date"];
    $servings = $_POST["servings"];
    
    $idquery = "SELECT food_id FROM food WHERE food_name = '$food'";
    $result = mysqli_query($conn, $idquery);

    if (mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $fid = $row['food_id'];
    }

    $formatted_date = date('Y-m-d', strtotime($dt));
    
    $addrecord = "INSERT INTO food_log (client_id, food_log_date, food_id, servings)
                  VALUES ($cid, '$formatted_date', $fid, $servings)";

    mysqli_query($conn, $addrecord);

    header("Location: meal_log.php");

    mysqli_close($conn);
    exit();
?>