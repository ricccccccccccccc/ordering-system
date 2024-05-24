<?php
// Check if the request method is POST
//if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data sent from the client
    $recordId = $_POST['ID'];
    $orderdate = $_POST['orderdate'];
    $stats = $_POST['stats'];


    // Here you would typically connect to your database and update the record with the provided ID,
    // setting the new quantity and subtotal values.
    // Replace the following lines with your actual database update code.

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

    $stmt = $conn->prepare('UPDATE cart SET orderdate = ?, status = ? WHERE ID = ?');
    $stmt->bind_param("sss", $orderdate, $stats, $recordId); // 'dds' stands for double, double, string
    $stmt->execute();

    // Check if the update was successful
    if ($stmt->affected_rows > 0) {
        $response = array('success' => true, 'message' => 'Record updated successfully.');
    } else {
        $response = array('success' => false, 'message' => 'Failed to update record.');
    }

    // Send the response back to the client
    header('Content-Type: application/json');
    echo json_encode($response);
// } else {
//     // If the request method is not POST, return an error
//     http_response_code(405); // Method Not Allowed
//     echo json_encode(array('error' => 'Method not allowed.'));
// }
?>