<?php
    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "fitquest";
    $conn = "";

    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $usertype = $_POST["user-type"];
    $weight = $_POST["weight"];
    $height = $_POST["height"];
    
    $logininfo = "INSERT INTO login_info (email, pass_word) VALUES ('$email', '$password')";
    mysqli_query($conn, $logininfo);
    
    $sysuser = "INSERT INTO sys_user (first_name, last_name, email)
                VALUES ('$fname', '$lname', '$email')";
    mysqli_query($conn, $sysuser);
    
    if ($usertype = "client"){
        $getclientid = "SELECT user_id FROM sys_user WHERE email = '$email'";
        $result = mysqli_query($conn, $getclientid);
        if (mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            $clientid = $row['user_id'];
        }
        $clientinfo = "INSERT INTO client_user (client_id, weight, height)
                        VALUES ('$clientid', '$weight', '$height')";
        mysqli_query($conn, $clientinfo);
    }

    mysqli_close($conn);

    header("Location: home.html");
    exit();
?>