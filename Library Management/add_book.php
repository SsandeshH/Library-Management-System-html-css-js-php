<?php

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "lmsdbbooks"; 


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $description = $_POST['description'];
    $available = isset($_POST['available']) ? 1 : 0;

    // Prepare SQL statement to insert a new book
    $sql = "INSERT INTO books (title, author, genre, description, available) VALUES ('$title', '$author', '$genre', '$description', '$available')";

    if ($conn->query($sql) === TRUE) {
        // Book added successfully
        echo "New book added successfully";
    } else {
        // Error occurred while adding the book
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close database connection
$conn->close();
?>
