<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'login');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($hashed_password);
    $stmt->fetch();

    // Verify password
    if (password_verify($password, $hashed_password)) {
        echo "Login successful...";
        // Redirect to the desired page after successful login
        header('Location: sell.html');
        exit(); // Make sure to exit after redirect
    } else {
        echo "Invalid username or password.";
    }

    // Close connections
    $stmt->close();
    $conn->close();
}
?>
