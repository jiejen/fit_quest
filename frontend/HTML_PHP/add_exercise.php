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
    <title>Custom Exercise - Fitness Tracking App</title>
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

    <main>`
        <h1>Enter Your Own Exercise</h1>
        
        <form action="add_exercise_form.php" method="post">
            Exercise Name: <br>
            <input type="text" name="exercise">
            <br /> <br />
            <button type="submit">Add Exercise</button>
            <br />
            <?php
            if (isset($_SESSION['message'])) {
                echo '<p style="color: red;">' . $_SESSION['message'] . '</p>'; 
                unset($_SESSION['message']); 
            }
        ?>
        </form>
    
    </main>

    <footer>
        <p>&copy; Fitness Tracking App</p>
    </footer>

    <script src="path/to/scripts.js"></script>
</body>
</html>