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
    <title>Meal Log - Fitness Tracking App</title>
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
        <?php
            $fetchsql = "SELECT food_name FROM food";
            $result = mysqli_query($conn, $fetchsql);
            $items = [];
            while ($row = $result->fetch_assoc()) {
                $items[] = $row;
            }
            mysqli_close($conn);
        ?>
        <h1>Meal Log</h1>
        <form action="meal_log_form.php" method="post">
            Meal Name: <br>
            <select name="food">
                <?php foreach ($items as $item): ?>
                    <option value="<?php echo $item['food_name']; ?>">
                        <?php echo htmlspecialchars($item['food_name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br>
            <br>
            Date: <br>
            <input type="date" name="date" required> <br> <br>
            Servings: <br>
            <input type="number" name="servings" min="0" required> <br> <br>

            <button type="submit">Log Meal</button>
        </form>

        <!-- You can include a section to display the logged meals and nutrition information here -->
    </main>

    <footer>
        <p>&copy; Fitness Tracking App</p>
    </footer>

    <!-- You can include JavaScript files here if needed -->
    <script src="path/to/scripts.js"></script>
</body>
</html>
