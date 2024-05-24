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

if (isset($_POST['id'])) {

$id = $_POST['id'];

// Prepare and execute the SQL query to fetch todos
$query = "DELETE FROM cart WHERE ID = :id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);

if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }
}

} catch (PDOException $e) {
  echo "Database connection failed: " . $e->getMessage();
}
?>