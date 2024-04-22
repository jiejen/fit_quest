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
    
    $loginsql = "SELECT * FROM login_info WHERE email = '$email' AND pass_word = '$password'";
    $result = mysqli_query($conn, $loginsql);

    if (mysqli_num_rows($result) == 1) {
        // User exists, redirect to home page or perform further actions
        $fnamesql = "SELECT first_name, user_id FROM sys_user WHERE email = '$email'";
        $fnameresult = mysqli_query($conn, $fnamesql);
        if (mysqli_num_rows($fnameresult) > 0){
            $row = mysqli_fetch_assoc($fnameresult);
            $_SESSION['fname'] = $row['first_name'];
            $_SESSION['user_id'] = $row['user_id'];
        }
        $clientsql = "SELECT * FROM client_user WHERE client_id = '$email' AND pass_word = '$password'";
    $result = mysqli_query($conn, $loginsql);

        header("Location: navigation.php");
    } else {
        header("Location: login.html?error=invalid_credentials");
    }

    mysqli_close($conn);
    exit();
?>