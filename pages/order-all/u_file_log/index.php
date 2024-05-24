<?php
// Assuming you have a database connection
// Replace 'your_database', 'your_username', 'your_password' with your actual database credentials
$dsn = 'mysql:host=localhost;dbname=xyz;charset=utf8mb4';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming you have received the record ID and updated data
    $recordId = $_POST['id'];
    $updatedData = $_POST['updatedData'];

    try {
        // Prepare the UPDATE query
        $stmt = $pdo->prepare("UPDATE cart SET status = :status WHERE ID = :id");

        // Bind parameters
        $stmt->bindParam(':status', $updatedData['status']);
        $stmt->bindParam(':id', $recordId);

        // Execute the query
        $stmt->execute();

        // Respond with success message
        echo json_encode(['status' => 'success', 'message' => 'Changes saved successfully']);
    } catch (PDOException $e) {
        // Respond with error message
        echo json_encode(['status' => 'error', 'message' => 'Error saving changes: ' . $e->getMessage()]);
    }
} else {
    // Respond with an error if the request method is not POST
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
