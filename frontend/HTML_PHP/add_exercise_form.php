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

$exercise = $_POST["exercise"];

$checkQuery = $conn->prepare("SELECT exercise_id FROM exercise WHERE exercise_name = ?");
$checkQuery->bind_param("s", $exercise);
$checkQuery->execute();
$checkResult = $checkQuery->get_result();
if ($checkResult->num_rows == 0) {
    $insertQuery = $conn->prepare("INSERT INTO exercise (exercise_name) VALUES (?)");
    $insertQuery->bind_param("s", $exercise);
    $insertQuery->execute();

    $insertQuery->close();
    unset($_SESSION['message']);
}
else{
    $_SESSION['message'] = "Exercise already exists! Please input another exercise!";
}

$checkQuery->close();
mysqli_close($conn);

header("Location: add_exercise.php");
exit();
?>