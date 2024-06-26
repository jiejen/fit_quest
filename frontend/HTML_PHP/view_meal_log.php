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
            <h1>View Meal Log</h1>
            <p>Here is a list of all of your meals.</p>
        </section>

        <?php
            $cid = $_SESSION['user_id'];
            $fetchsql = "SELECT * FROM food_log WHERE client_id = $cid";
            $result = mysqli_query($conn, $fetchsql);

            if (mysqli_num_rows($result) > 0){
                // Output table header
                echo "<table border='1' style='width: 50%; border-collapse: collapse;'>";
                echo "<tr><th>Date</th><th>Food</th><th>Servings</th><th>Calories</th><th>Carbs</th><th>Fats</th><th>Proteins</th><th>Action</th></tr>";

                // Loop through each meal log record
                while ($row = mysqli_fetch_assoc($result)) {
                    $fid = $row['food_id'];
                    $fetchfood = "SELECT * from food WHERE food_id = $fid";
                    $resultfood = mysqli_query($conn, $fetchfood);

                    if (mysqli_num_rows($resultfood) > 0){
                        $foodrow = mysqli_fetch_assoc($resultfood);
                        $food_name = $foodrow['food_name'];
                        $food_calories = $foodrow['calories'];
                        $food_carbs = $foodrow['carbohydrates'];
                        $food_fat = $foodrow['fat'];
                        $food_protein = $foodrow['protein'];
                    }

                    echo "<tr style='background-color: #f2f2f2; height: 50px'>";
                    echo "<td style='padding: 8px; text-align: center;'>" . $row['food_log_date'] . "</td>";
                    echo "<td style='padding: 8px; text-align: center;'>" . $food_name . "</td>";
                    echo "<td style='padding: 8px; text-align: center;'>" . $row['servings'] . "</td>";
                    echo "<td style='padding: 8px; text-align: center;'>" . $food_calories . "</td>";
                    echo "<td style='padding: 8px; text-align: center;'>" . $food_carbs . "</td>";
                    echo "<td style='padding: 8px; text-align: center;'>" . $food_fat. "</td>";
                    echo "<td style='padding: 8px; text-align: center;'>" . $food_protein. "</td>";
                    echo "<td style='padding: 8px; text-align: center;'><form action='delete_meal.php' method='POST'><input type='hidden' name='food_log_id' value='" . $row['food_log_id'] . "'><input type='submit' value='Remove' onclick='return confirm(\"Are you sure you want to remove this meal?\");'></form></td>";
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
        <p>&copy; FitQuest</p>
    </footer>

    <!-- You can include JavaScript files here if needed -->
    <script src="path/to/scripts.js"></script>
</body>
</html>
