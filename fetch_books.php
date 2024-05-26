<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'login');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch data from books table
$sql = "SELECT title,subject_code,price,description,contact_name,contact_phone,contact_email FROM books";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<div>";
        echo "<h2>" . $row["title"] . "</h2>";
        echo "<p>Subject Code: " . $row["subject_code"] . "</p>";
        echo "<p>Price: $" . $row["price"] . "</p>";
        echo "<p>Description: " . $row["description"] . "</p>";
        echo "<p>Contact: " . $row["contact_name"] . ", Phone: " . $row["contact_phone"] . ", Email: " . $row["contact_email"] . "</p>";
        echo "</div>";
    }
} else {
    echo "No books available";
}
$conn->close();
?>
