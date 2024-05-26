<?php
// Establish a database connection
$conn = new mysqli('localhost', 'root', '', 'login');

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the search query from the URL parameters
$searchQuery = $_GET['search-query'];

// Perform a search query
$sql = "SELECT * FROM books WHERE title LIKE '%$searchQuery%' OR subject_code LIKE '%$searchQuery%'";
$result = $conn->query($sql);

// Check if there are any results
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "Title: " . $row["title"]. " - Subject Code: " . $row["subject_code"]. "<br>";
        // Output other book details as needed
    }
} else {
    echo "No results found";
}

// Close the database connection
$conn->close();
?>
