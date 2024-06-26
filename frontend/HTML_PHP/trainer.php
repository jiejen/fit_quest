<?php
// Start the session
session_start();
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
                <li><a href="remove_client.php">Remove Clients</a></li>
                <li><a href="trainer_view_meal_log.php">Client meal logs</a></li>
                <li><a href="trainer_view_exercise_log.php">Client exercise logs</a></li>
                <li style="float:right"><a href="logout.php" >Log Out</a></li>
            </ul>
        </nav>

        <main>
        <section>
            <h1>Welcome <?php echo $_SESSION['fname']; ?>! </h1>
        </section>
    </main>
    </header>


    <footer>
        <p>&copy; FitQuest</p>
    </footer>

    <!-- You can include JavaScript files here if needed -->
    <script src="path/to/scripts.js"></script>
</body>
