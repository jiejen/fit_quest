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
            <h1>View Goals</h1>
        </section>

        <?php
            $cid = $_SESSION['user_id'];
            $fetchsql = "SELECT * FROM goal WHERE client_id = $cid";
            $result = mysqli_query($conn, $fetchsql);

            if (mysqli_num_rows($result) > 0){
                // Output table header
                echo "<table border='1' style='width: 50%; border-collapse: collapse;'>";
                echo "<tr><th>Goal</th><th>Target Date</th></tr>";

                // Loop through each goal record
                while ($row = mysqli_fetch_assoc($result)) {
                    // Output table rows with goal log details
                    echo "<tr style='background-color: #f2f2f2;'>";
                    echo "<td style='padding: 8px; text-align: center;'>" . $row['goal_description'] . "</td>";
                    echo "<td style='padding: 8px; text-align: center;'>" . $row['target_date'] . "</td>";
                    echo "</tr>";
                }

                // Close the table
                echo "</table>";
            } else {
                // If no meal logs found, display a message
                echo "No goals left! Congratulations!";
            }
        ?>      
        
        <br>
        <br>
        <br>

        <section> 
            <h1>Complete Goals</h1>
        </section>

        <?php
            $fetchsql = "SELECT goal_description FROM goal WHERE client_id=$cid";
            $result = mysqli_query($conn, $fetchsql);
            $items = [];
            while ($row = $result->fetch_assoc()) {
                $items[] = $row;
            }
        ?>

        <form action="complete_goal.php" method="post">
            Select which goal you have completed: <br> <br>
            <select name="goal">
                <?php foreach ($items as $item): ?>
                    <option value="<?php echo $item['goal_description']; ?>">
                        <?php echo htmlspecialchars($item['goal_description']); ?>
                    </option>
                <?php endforeach; ?>
            </select> <br> <br>
            <button type="submit">Complete Goal</button>
        </form>
    </main>

    <footer>
        <p>&copy; Fitness Tracking App</p>
    </footer>

    <!-- You can include JavaScript files here if needed -->
    <script src="path/to/scripts.js"></script>
</body>
</html>
