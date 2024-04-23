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
            <li><a href="navigation.php">Home</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="goal_setting.html">Set Goals</a></li>
                <li><a href="exercise_log.php">Log Exercises</a></li>
                <li><a href="meal_log.php">Log Meals</a></li>
                <li><a href="view_goals.php">View Goals</a></li>
                <li><a href="view_exercise_log.php">View Exercises</a></li>
                <li><a href="view_meal_log.php">View Meals</a></li>
                <li><a href="add_exercise.php">Custom Exercise</a></li>
                <li><a href="add_meal.php">Custom Meal</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h1>View Exercise Log</h1>
            <p>Here is a list of all of your exercises.</p>
        </section>

        <?php
            $cid = $_SESSION['user_id'];
            $fetchsql = "SELECT * FROM exercise_log WHERE client_id = $cid";
            $result = mysqli_query($conn, $fetchsql);

            if (mysqli_num_rows($result) > 0){
                // Output table header

                echo "<table border='1' style='width: 50%; border-collapse: collapse;'>";
                echo "<tr><th>Date</th><th>Exercise</th><th>Weight</th></tr>";

                // Loop through each exercise log record
                while ($row = mysqli_fetch_assoc($result)) {
                    $eid = $row['exercise_id'];
                    $fetchexercise = "SELECT * from exercise WHERE exercise_id = $eid";
                    $resultexercise = mysqli_query($conn, $fetchexercise);

                    if (mysqli_num_rows($resultexercise) > 0){
                        $exerciserow = mysqli_fetch_assoc($resultexercise);
                        $exercise_name = $exerciserow['exercise_name'];
                    }

                    // Output table rows with meal log details
                    echo "<tr style='background-color: #f2f2f2;'>";
                    echo "<td style='padding: 8px; text-align: center;'>" . $row['exercise_log_date'] . "</td>";
                    echo "<td style='padding: 8px; text-align: center;'>" . $exercise_name . "</td>";
                    echo "<td style='padding: 8px; text-align: center;'>" . $row['weight'] . "</td>";
                    echo "</tr>";
                }

                // Close the table
                echo "</table>";
            } else {
                // If no meal logs found, display a message
                echo "No meal logs found for this client.";
            }
            mysqli_close($conn);
        ?>       
    </main>

    <footer>
        <p>&copy; Fitness Tracking App</p>
    </footer>

    <!-- You can include JavaScript files here if needed -->
    <script src="path/to/scripts.js"></script>
</body>
</html>
