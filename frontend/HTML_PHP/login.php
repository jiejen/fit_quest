<?php
session_start();

$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "fitquest";
$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $loginsql = "SELECT * FROM login_info WHERE email = ? AND pass_word = ?";
    $stmt = $conn->prepare($loginsql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $fnamesql = "SELECT first_name, last_name, user_id FROM sys_user WHERE email = ?";
        $fnamestmt = $conn->prepare($fnamesql);
        $fnamestmt->bind_param("s", $email);
        $fnamestmt->execute();
        $fnameresult = $fnamestmt->get_result();
        if ($fnameresult->num_rows > 0){
            $row = $fnameresult->fetch_assoc();
            $id = $row['user_id'];
            $_SESSION['fname'] = $row['first_name'];
            $_SESSION['lname'] = $row['last_name'];
            $_SESSION['user_id'] = $id;
            
            $clientsql = "SELECT trainer_id, height, weight FROM client_user WHERE client_id = ?";
            $clientstmt = $conn->prepare($clientsql);
            $clientstmt->bind_param("i", $id);
            $clientstmt->execute();
            $clientresult = $clientstmt->get_result();
            if ($clientresult->num_rows > 0) {
                $row = $clientresult->fetch_assoc();
                $_SESSION['isClient'] = true;
                $_SESSION['trainer_id'] = $row['trainer_id'];
                $_SESSION['height'] = $row['height'];
                $_SESSION['weight'] = $row['weight'];
                header("Location: navigation.php");
            } else {
            
                $_SESSION['isClient'] = false;
                header("Location: trainer.php"); 
            }
            $clientstmt->close();
        }
        $fnamestmt->close();
    } else {
        header("Location: login.html?error=invalid_credentials");
    }
    $stmt->close();
} else {
    header("Location: login.html?error=invalid_request");
}

mysqli_close($conn);
exit();
?>
