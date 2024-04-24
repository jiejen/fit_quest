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

$trainerId = $_SESSION['user_id'];


if (isset($_POST['delete']) && isset($_POST['exercise_log_id'])) {
    $logId = $_POST['exercise_log_id'];
    $deleteSql = "DELETE FROM exercise_log WHERE exercise_log_id = '$logId'";
    if (mysqli_query($conn, $deleteSql)) {
        echo '<script>alert("Exercise log deleted successfully.");</script>';
    } else {
        echo '<script>alert("Error deleting exercise log.");</script>';
    }
}


$fetchsql = "SELECT cu.client_id, su.first_name, su.last_name, el.exercise_log_id, el.exercise_log_date, e.exercise_name, el.weight
             FROM exercise_log el
             INNER JOIN client_user cu ON el.client_id = cu.client_id
             INNER JOIN sys_user su ON cu.client_id = su.user_id
             INNER JOIN exercise e ON el.exercise_id = e.exercise_id
             WHERE cu.trainer_id = '$trainerId'";

$result = mysqli_query($conn, $fetchsql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness Tracking App</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="trainer.php">Home</a></li>
                <li><a href="view_clients.php">View Clients</a></li>
                <li><a href="add_clients.php">Add Clients</a></li>
                <li><a href="trainer_view_meal_log.php">Client meal logs</a></li>
                <li><a href="trainer_view_exercise_log.php">Client exercise logs</a></li>
                <li style="float:right"><a href="logout.php" >Log Out</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h1>View Exercise Log</h1>
            <p>Here is a list of all your clients' exercises.</p>
        </section>
        <?php
        if (mysqli_num_rows($result) > 0) {
            echo "<table border='1' style='width: 100%; border-collapse: collapse;'>";
            echo "<tr><th>Client Name</th><th>Date</th><th>Exercise</th><th>Weight</th><th>Action</th></tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr style='background-color: #f2f2f2; text-align: center; height: 50px'>";
                echo "<td>" . htmlspecialchars($row['first_name']) . " " . htmlspecialchars($row['last_name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['exercise_log_date']) . "</td>";
                echo "<td>" . htmlspecialchars($row['exercise_name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['weight']) . "</td>";
                echo "<td><form method='post' action=''><input type='hidden' name='exercise_log_id' value='" . $row['exercise_log_id'] . "'><input type='submit' name='delete' value='Remove'></form></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No exercise logs found for your clients.</p>";
        }
        mysqli_close($conn);
        ?>
    </main>

    <footer>
        <p>&copy; FitQuest</p>
    </footer>

    <script src="path/to/scripts.js"></script>
</body>
</html>
