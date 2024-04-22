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
    <link rel="stylesheet" href="path/to/styles.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="navigation.php">Home</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h1>View Goals</h1>
            <p>Here is a list of all of your goals.</p>
        </section>

        <?php
            $cid = $_SESSION['user_id'];
            $fetchsql = "SELECT * FROM goal WHERE client_id = $cid";
            $result = mysqli_query($conn, $fetchsql);

            if (mysqli_num_rows($result) > 0){
                // Output table header
                echo "<table border='1'>";
                echo "<tr><th>Goal</th><th>Target Date</th></tr>";

                // Loop through each meal log record
                while ($row = mysqli_fetch_assoc($result)) {
                    // Output table rows with meal log details
                    echo "<tr>";
                    echo "<td>" . $row['goal_description'] . "</td>";
                    echo "<td>" . $row['target_date'] . "</td>";
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
        
        <br>
        <br>
        <br>

        <section>
            <h1>View Goals</h1>
            <p>Here is a list of all of your goals.</p>
        </section>

        <form action="complete_goal.php" method="post">
            Complete Goals: <br>
            Date: <br>
            <input type="date" name="date" required> <br> <br>
            Servings: <br>
            <input type="number" name="servings" min="0" required> <br> <br>

            <button type="submit">Log Meal</button>
        </form>

    </main>

    <footer>
        <p>&copy; Fitness Tracking App</p>
    </footer>

    <!-- You can include JavaScript files here if needed -->
    <script src="path/to/scripts.js"></script>
</body>
</html>
