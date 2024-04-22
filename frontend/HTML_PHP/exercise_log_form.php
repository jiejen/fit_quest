<?php
    session_start();

    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "fitquest";
    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

    $cid = $_SESSION['user_id'];
    $exercise = $_POST["exercise"];
    $dt = $_POST["date"];
    $w = $_POST["weight"];
    
    $idquery = "SELECT * FROM exercise WHERE exercise_id = 1";
    $result = mysqli_query($conn, $idquery);
    if (mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        //$eid = $row['exercise_id'];
        echo$row['exercise_id'];
        echo$row['exercise_name'];
        echo$exercise;
    }

    $idquery = "SELECT * FROM exercise WHERE exercise_name = '$exercise'";
    $result = mysqli_query($conn, $idquery);

    if (mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $eid = $row['exercise_id'];
        echo$row['exercise_name'];
    }
    
    $formatted_date = date('Y-m-d', strtotime($dt));

    $addrecord = "INSERT INTO exercise_log (client_id, exercise_log_date, exercise_id, weight)
                  VALUES ($cid, '$formatted_date', $eid, $w)";

    mysqli_query($conn, $addrecord);

    //header("Location: exercise_log.php");

    mysqli_close($conn);
    exit();
?>