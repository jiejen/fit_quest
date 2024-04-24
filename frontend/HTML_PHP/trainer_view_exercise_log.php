
<?php
    session_start();

    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "fitquest";
    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness Tracking App</title>
    <!-- You can include CSS files here if needed -->
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
            <p>Here is a list of all your clients exercises.</p>
        </section>

        <?php
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            
            $trainerId = $_SESSION['user_id']; 
            
            
            $fetchsql = "SELECT cu.client_id, su.first_name, su.last_name, el.exercise_log_date, e.exercise_name, el.weight
                         FROM exercise_log el
                         INNER JOIN client_user cu ON el.client_id = cu.client_id
                         INNER JOIN sys_user su ON cu.client_id = su.user_id
                         INNER JOIN exercise e ON el.exercise_id = e.exercise_id
                         WHERE cu.trainer_id = '$trainerId'";
            
            $result = mysqli_query($conn, $fetchsql);
            
            if (mysqli_num_rows($result) > 0) {
                echo "<table border='1' style='width: 100%; border-collapse: collapse;'>";
                echo "<tr><th>Client Name</th><th>Date</th><th>Exercise</th><th>Weight</th></tr>";
            
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr style='background-color: #f2f2f2;'>";
                    echo "<td style='padding: 8px; text-align: center;'>" . htmlspecialchars($row['first_name']) . " " . htmlspecialchars($row['last_name']) . "</td>";
                    echo "<td style='padding: 8px; text-align: center;'>" . htmlspecialchars($row['exercise_log_date']) . "</td>";
                    echo "<td style='padding: 8px; text-align: center;'>" . htmlspecialchars($row['exercise_name']) . "</td>";
                    echo "<td style='padding: 8px; text-align: center;'>" . htmlspecialchars($row['weight']) . "</td>";
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

    <!-- You can include JavaScript files here if needed -->
    <script src="path/to/scripts.js"></script>
</body>
</html>