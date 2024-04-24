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

$Meal = $_POST["Meal"];
$Calories = $_POST["Calories"];
$Carbs = $_POST["Carbs"];
$Fat = $_POST["Fat"];
$Protein = $_POST["Protein"];

$checkQuery = $conn->prepare("SELECT food_id FROM food WHERE food_name = ?");
$checkQuery->bind_param("s", $Meal);
$checkQuery->execute();
$checkResult = $checkQuery->get_result();
if ($checkResult->num_rows == 0) {
    $insertQuery = $conn->prepare("INSERT INTO food (food_name, calories, carbohydrates, fat, protein) VALUES (?, ?, ?, ?, ?)");
    $insertQuery->bind_param("sdddd", $Meal, $Calories, $Carbs, $Fat, $Protein);
    $insertQuery->execute();

    $insertQuery->close();
    unset($_SESSION['message']);
}
else{
    $_SESSION['message'] = "Meal already exists! Please input another Meal!";
}

$checkQuery->close();
mysqli_close($conn);

header("Location: add_Meal.php");
exit();
?>