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


if (isset($_POST['delete']) && isset($_POST['food_log_id'])) {
    $logId = $_POST['food_log_id'];
    $deleteSql = "DELETE FROM food_log WHERE food_log_id = '$logId'";
    mysqli_query($conn, $deleteSql);
    echo '<script> alert("Meal log deleted successfully")</script>';
}


$fetchsql = "SELECT cu.client_id, su.first_name, su.last_name, fl.food_log_id, fl.food_log_date, f.food_name, fl.servings, f.calories, f.carbohydrates, f.fat, f.protein 
            FROM food_log fl
            INNER JOIN client_user cu ON fl.client_id = cu.client_id
            INNER JOIN sys_user su ON cu.client_id = su.user_id
            INNER JOIN food f ON fl.food_id = f.food_id
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
            <h1>View Meal Log</h1>
            <p>Here is a list of all your clients meals.</p>
        </section>
        <?php
        if (mysqli_num_rows($result) > 0) {
            echo "<table border='1' style='width: 100%; border-collapse: collapse;'>";
            echo "<tr><th>Client Name</th><th>Date</th><th>Food</th><th>Servings</th><th>Calories</th><th>Carbs</th><th>Fats</th><th>Proteins</th><th>Action</th></tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr style='background-color: #f2f2f2; text-align: center; height: 50px'>";
                echo "<td>" . htmlspecialchars($row['first_name']) . " " . htmlspecialchars($row['last_name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['food_log_date']) . "</td>";
                echo "<td>" . htmlspecialchars($row['food_name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['servings']) . "</td>";
                echo "<td>" . htmlspecialchars($row['calories']) . "</td>";
                echo "<td>" . htmlspecialchars($row['carbohydrates']) . "</td>";
                echo "<td>" . htmlspecialchars($row['fat']) . "</td>";
                echo "<td>" . htmlspecialchars($row['protein']) . "</td>";
                echo "<td><form method='post' action=''><input type='hidden' name='food_log_id' value='" . $row['food_log_id'] . "'><input type='submit' name='delete' value='Remove'></form></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No meal logs found for your clients.</p>";
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
