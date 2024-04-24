<?php
    session_start();

    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "fitquest";
    $conn = "";

    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

    $email = $_POST["email"];
    $password = $_POST["password"];

    $loginsql = "SELECT * FROM login_info WHERE email = '$email' AND pass_word = '$password'
    ";
    $result = mysqli_query($conn, $loginsql);

    if (mysqli_num_rows($result) == 1) {
        // User exists, redirect to home page or perform further actions
        $fnamesql = "SELECT first_name, last_name, user_id FROM sys_user WHERE email = '$email'";
        $fnameresult = mysqli_query($conn, $fnamesql);
        if (mysqli_num_rows($fnameresult) > 0){
            $row = mysqli_fetch_assoc($fnameresult);
            $id = $row['user_id'];
            $_SESSION['fname'] = $row['first_name'];
            $_SESSION['lname'] = $row['last_name'];
            $_SESSION['user_id'] = $id;
        }
        $clientsql = "SELECT trainer_id, height, weight FROM client_user WHERE client_id = '$id'";
        $clientresult = mysqli_query($conn, $clientsql);
        if (mysqli_num_rows($clientresult) > 0) {
            $row = mysqli_fetch_assoc($clientresult);
            $_SESSION['isClient'] = true;
            $_SESSION['trainer_id']= $row['trainer_id'];
            $_SESSION['height'] = $row['height'];
            $_SESSION['weight'] = $row['weight'];
        }
        header("Location: navigation.php");
    } else {
        header("Location: login.html?error=invalid_credentials");
    }

    mysqli_close($conn);
    exit();
?>
