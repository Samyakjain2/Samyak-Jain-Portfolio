<?php
// Database configuration
$servername = "localhost"; // Change this to your database server name
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$database = "samyak_jain"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Prepare and bind statement
    $stmt = $conn->prepare("INSERT INTO comments (username, email, subject, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $email, $subject, $message);

    // Execute statement
    if ($stmt->execute()) {
        echo "Message sent successfully!";
    } else {
        // Log error for yourself
        error_log("Error: " . $stmt->error);
        echo "Oops! Something went wrong. Please try again later.";
    }

    // Close prepared statement
    $stmt->close();
}

// Close database connection
$conn->close();
?>
