<?php

// Database connection parameters
  $host = "localhost";
  $dbname = "xyz";
  $username = "root";
  $password = "";

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare and execute the SQL query to fetch the count of rows in the 'cart' table
    $query = "SELECT COUNT(*) as count FROM cart";
    $stmt = $pdo->query($query);

    // Fetch the result
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Output the fetched count as JSON
    header("Content-Type: application/json");
    echo json_encode($result);

} catch (PDOException $e) {
  echo "Database connection failed: " . $e->getMessage();
}

?>