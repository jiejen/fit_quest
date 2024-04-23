<?php
session_start();

$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "fitquest";
$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['newWeight'])) {
    $newWeight = $_POST['newWeight'];
    $userId = $_SESSION['user_id']; 

    
    $stmt = $conn->prepare("UPDATE client_user SET weight = ? WHERE client_id = ?");
    $stmt->bind_param("ii", $newWeight, $userId);
    $stmt->execute();
    
    if ($stmt->affected_rows > 0) {
        $_SESSION['weight'] = $newWeight; 
        echo '<script>alert("Weight updated successfully!")</script>'; 
    } else {
        echo '<script>alert("Weight update failed!")</script>';     }

    $stmt->close();
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - Fitness Tracking App</title>
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

        <section>
            <h2>Personal Information</h2>
            <p>Name: <?php echo $_SESSION['fname'] . " " . $_SESSION['lname']; ?></p>
            <p>Weight: <?php echo $_SESSION['weight']; ?> lb</p>
            <p>Height: <?php echo $_SESSION['height']; ?> cm</p>
            
            <form action="" method="post">
                <label for="newWeight">Update Weight (lb):</label>
                <input type="number" id="newWeight" min = "3"   name="newWeight" required>
                <button type="submit">Update Weight</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; Fitness Tracking App</p>
    </footer>

    <script src="path/to/scripts.js"></script>
</body>
</html>
