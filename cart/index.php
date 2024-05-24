<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $image = $_POST['image'];
    $title = $_POST['title'];
    $price = $_POST['price'];

    // Database connection details
    $servername = "localhost";
    $username = "root"; // Default XAMPP username
    $password = ""; // Default XAMPP password is empty
    $dbname = "xyz";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die(json_encode(['error' => 'Connection failed: ' . $conn->connect_error]));
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO cart (img, prodtitle, prodprice) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $image, $title, $price);

    // Execute the query
    if ($stmt->execute()) {
        echo json_encode(['success' => 'Product added to cart']);
    } else {
        echo json_encode(['error' => 'Error adding product to cart']);
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>