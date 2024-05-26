<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture form data
    $username = $_POST['username'];
    $roll_number = $_POST['roll_number'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirm_password'];

    // Validate input
    if (empty($username) || empty($roll_number) || empty($email) || empty($password) || empty($confirmpassword)) {
        die("All fields are required.");
    }

    if ($password !== $confirmpassword) {
        die("Passwords do not match.");
    }

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'login');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO users (username, roll_number, email, password) VALUES (?, ?, ?, ?)");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ssss", $username, $roll_number, $email, $hashed_password);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to login page
        header('Location: login.html');
        exit(); // Make sure to exit after redirect
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close connections
    $stmt->close();
    $conn->close();
}
?>
