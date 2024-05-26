<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["upload"])) {
    // Capture form data
    $title = $_POST['title'];
    $subject_code = $_POST['subject_code'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $contact_name = $_POST['contact_name'];
    $contact_phone = $_POST['contact_phone'];
    $contact_email = $_POST['contact_email'];
    $filename = $_FILES['upload']['name'];
    $filedata = file_get_contents($_FILES['upload']['tmp_name']);

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'login');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Validate input
    if (empty($title) || empty($subject_code) || empty($price) || empty($description) || empty($contact_name) || empty($contact_phone) || empty($contact_email) || empty($filename) || empty($filedata)) {
        die("All fields are required.");
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO books (title, subject_code, price, description, contact_name, contact_phone, contact_email, filename, filedata) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ssdsssssb", $title, $subject_code, $price, $description, $contact_name, $contact_phone, $contact_email, $filename, $filedata);

    // Send long data
    $stmt->send_long_data(8, $filedata);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Book or notes uploaded successfully.";
        // Redirect to a confirmation or thank you page
        header('Location: buy.html');
        exit(); // Make sure to exit after redirect
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close connections
    $stmt->close();
    $conn->close();
} else {
    echo "No file uploaded.";
}
?>
