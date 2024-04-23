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
    <title>Custom Meal - Fitness Tracking App</title>
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
        <h1>Enter Your Own Meal</h1>
        
        <form action="add_meal_form.php" method="post">
            Meal Name: <br>
            <input type="text" name="Meal" required> <br /><br />
            Amount of Calories: <br>
            <input type = "number" name = "Calories" required> 
            <br /><br />
            Amount of Carbohydrates: <br>
            <input type = "number" name = "Carbs" required> <br/>
            <br />
            Amount of Fat: <br>
            <input type = "number" name = "Fat" required><br/>
            <br />
            Amount of Protein: <br> 
            <input type = "number" name = "Protein" required>
            <br />
            <br /> <br />
            <button type="submit">Add Meal</button>
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