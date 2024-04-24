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
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="trainer.php">Home</a></li>
                <li><a href="view_clients.php">View Clients</a></li>
                <li><a href="add_clients.php">Add Clients</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h1>Clients</h1>
        </section>

        <?php
            $cid = $_SESSION['user_id'];
            // Query that joins sys_user with client_user to get all required details
            $fetchsql = "SELECT su.first_name, su.last_name, cu.weight, cu.height 
                         FROM sys_user su
                         JOIN client_user cu ON su.user_id = cu.client_id
                         WHERE cu.trainer_id = ?";
            
            $stmt = $conn->prepare($fetchsql);
            $stmt->bind_param("i", $cid);
            $stmt->execute();
            $result = $stmt->get_result();


            if (mysqli_num_rows($result) > 0){
                // Output table header
                echo "<table border='1' style='width: 50%; border-collapse: collapse;'>";
                echo "<tr><th>First Name</th><th>Last Name</th><th>Weight</th><th>Height</th>";

                // Loop through each meal log record
                while ($row = mysqli_fetch_assoc($result)) {
                    // Output table rows with meal log details
                    echo "<tr style='background-color: #f2f2f2;'>";
                    echo "<td style='padding: 8px; text-align: center;'>" . $row['first_name'] . "</td>";
                    echo "<td style='padding: 8px; text-align: center;'>" . $row['last_name'] . "</td>";
                    echo "<td style='padding: 8px; text-align: center;'>" . $row['weight'] . "</td>";
                    echo "<td style='padding: 8px; text-align: center;'>" . $row['height'] . "</td>";
                    echo "</tr>";
                }

                // Close the table
                echo "</table>";
            } else {
                // If no meal logs found, display a message
                echo "No clients found for this trainer.";
                
            }
            mysqli_close($conn);
        ?>      
        
        <br>
        <br>
        <br>

    </main>

    <footer>
        <p>&copy; FitQuest</p>
    </footer>

    <!-- You can include JavaScript files here if needed -->
    <script src="path/to/scripts.js"></script>
</body>
</html>
