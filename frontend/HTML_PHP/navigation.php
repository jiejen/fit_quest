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
    <link rel="stylesheet" href="path/to/styles.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="navigation.html">Home</a></li>
                <li><a href="profile.html">Profile</a></li>
                <li><a href="progress_tracking.html">Progress</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h1>Welcome Back <?php echo $_SESSION['fname']; ?>! </h1>
        </section>
    </main>

    <footer>
        <p>&copy; Fitness Tracking App</p>
    </footer>

    <!-- You can include JavaScript files here if needed -->
    <script src="path/to/scripts.js"></script>
</body>
</html>