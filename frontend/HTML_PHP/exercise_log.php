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
    <title>Exercise Log - Fitness Tracking App</title>
    <!-- You can include CSS files here if needed -->
    <link rel="stylesheet" href="path/to/styles.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="home.html">Home</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <?php
            $fetchsql = "SELECT exercise_name FROM exercise";
            $result = mysqli_query($conn, $fetchsql);
            $items = [];
            while ($row = $result->fetch_assoc()) {
                $items[] = $row;
            }
            mysqli_close($conn);
        ?>
        <h1>Exercise Log</h1>
        <form action="exercise_log_fetch.php" method="post">
            Exercise Name: <br>
            <select name="itemDropdown">
                <?php foreach ($items as $item): ?>
                    <option value="<?php echo $item['exercise_name']; ?>">
                        <?php echo htmlspecialchars($item['exercise_name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br>
            <br>
            Date: <br>
            <input type="date" name="date" required> <br> <br>
            Weight: <br>
            <input type="number" name="weight" required> <br> <br>
            <br>
            <br>
            <button type="submit">Log Exercise</button>
        </form>

        <!-- You can include a section to display the logged exercises here -->
    </main>

    <footer>
        <p>&copy; Fitness Tracking App</p>
    </footer>

    <!-- You can include JavaScript files here if needed -->
    <script src="path/to/scripts.js"></script>
</body>
</html>