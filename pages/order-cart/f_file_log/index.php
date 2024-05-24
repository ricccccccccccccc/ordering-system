<?php

// Database connection parameters
  $host = "localhost";
  $dbname = "xyz";
  $username = "root";
  $password = "";

try {
  // Create a new PDO instance
  // Create a new PDO instance
$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

// Set the PDO error mode to exception
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Prepare and execute the SQL query to fetch todos
$query = "SELECT * FROM cart";
$stmt = $pdo->query($query);

// Fetch all rows as associative arrays
$todos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Output the fetched todos as JSON
header("Content-Type: application/json");
echo json_encode($todos);

} catch (PDOException $e) {
  echo "Database connection failed: " . $e->getMessage();
}

?>