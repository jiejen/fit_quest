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

// Handle client removal
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remove_client_id'])) {
    $client_id = $_POST['remove_client_id'];

    $updateQuery = "UPDATE client_user SET trainer_id = NULL WHERE client_id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("i", $client_id);
    if ($stmt->execute()) {
        $_SESSION['message'] = "Client successfully unassigned.";
    } else {
        $_SESSION['message'] = "Failed to unassign client.";
    }
    $stmt->close();
}

// Fetch clients currently assigned to the logged-in trainer
$trainer_id = $_SESSION['user_id']; 
$query = "SELECT su.user_id, su.first_name, su.last_name FROM sys_user su JOIN client_user cu ON su.user_id = cu.client_id WHERE cu.trainer_id = '$trainer_id'";
$result = mysqli_query($conn, $query);

$options = "";
while ($row = mysqli_fetch_assoc($result)) {
    $client_id = $row['user_id'];
    $client_name = $row['first_name'] . ' ' . $row['last_name'];
    $options .= "<option value='$client_id'>$client_name</option>";
}
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remove Client - Fitness Tracking App</title>
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
    </header>

    <main>
    <h1>Remove Client</h1>
    <form action="" method="post">
        <label>Choose a client to unassign:</label>
        <select name="remove_client_id" required>
            <?php echo $options; ?>
        </select>
        <br /><br />
        <button type="submit">Remove Client</button>
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
        <p>&copy; FitQuest</p>
    </footer>

    <script src="path/to/scripts.js"></script>
</body>
</html>
