<?php
    session_start();
    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "fitquest";
    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['exercise_log_id'])) {
        $exercise_log_id = $_POST['exercise_log_id']; 

        $deleteSql = "DELETE FROM exercise_log WHERE exercise_log_id = ?";
        $stmt = mysqli_prepare($conn, $deleteSql);
        mysqli_stmt_bind_param($stmt, 'i', $exercise_log_id);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "Exercise log deleted successfully.";
        } else {
            echo "Error deleting exercise log.";
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        header('Location: view_exercise_log.php'); 
        exit();
    }
?>
