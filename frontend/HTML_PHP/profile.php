<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - Fitness Tracking App</title>
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
        <h1>User Profile</h1>

        <!-- You can include a section to display the user's profile information here -->
        <section>
            <h2>Personal Information</h2>
            <p>Name: <?php echo $_SESSION['fname']; ?> <?php echo $_SESSION['lname']; ?></p>
            <p>Weight: <?php echo $_SESSION['weight']; ?> lb</p>
            <p>Height: <?php echo $_SESSION['height']; ?> cm</p>
        </section>
    </main>

    <footer>
        <p>&copy; Fitness Tracking App</p>
    </footer>

    <!-- You can include JavaScript files here if needed -->
    <script src="path/to/scripts.js"></script>
</body>
</html>
