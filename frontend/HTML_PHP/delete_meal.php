<?php
    session_start();
    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "fitquest";
    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $food_log_id = $_POST['food_log_id'];  // Get the food_log_id from the form submission

        $deleteSql = "DELETE FROM food_log WHERE food_log_id = ?";
        $stmt = mysqli_prepare($conn, $deleteSql);
        mysqli_stmt_bind_param($stmt, 'i', $food_log_id);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "Meal deleted successfully.";
        } else {
            echo "Error deleting meal.";
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        header('Location: view_meal_log.php');  // Redirect back to the meal log page
        exit();
    }
?>
