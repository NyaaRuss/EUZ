<?php

// Database connection parameters
$host = "localhost";
$dbname = "euz_admin";
$username = "root";
$password = "";

try {
    // Connect to the database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Set PDO to throw exceptions on error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Prepare SQL statement
    $sql = "SELECT id, SUM(amount) AS total_amount FROM payments GROUP BY id";
    
    // Execute the query
    $stmt = $pdo->query($sql);
    
    // Fetch all rows
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Display the results
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Total Amount</th></tr>";
    foreach ($results as $row) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['total_amount'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
} catch (PDOException $e) {
    // If an error occurs, display it
    echo "Error: " . $e->getMessage();
}

?>
