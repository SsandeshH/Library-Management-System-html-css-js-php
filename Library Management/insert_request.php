<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    // User is not logged in, return error message
    echo "Error: User not logged in.";
    exit;
}

// Retrieve user's username from session
$username = $_SESSION['username'];

// Check if all required fields are set
if(isset($_POST['title']) && isset($_POST['author']) && isset($_POST['genre']) && isset($_POST['description'])) {
    // Database connection
    $servername = "localhost";
    $username_db = "root"; // Your MySQL username
    $password_db = ""; // Your MySQL password
    $dbname = "lmsdb";

    // Create connection
    $conn = new mysqli($servername, $username_db, $password_db, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare data for insertion
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $description = $_POST['description'];
    $status = "pending"; // Default status is set to "pending"
    $created_at = date("Y-m-d H:i:s"); // Current date and time

    // Check if the book is requestable (available)
    $checkBookAvailability = "SELECT * FROM books WHERE title='$title' AND available=1";
    $result = $conn->query($checkBookAvailability);
    if ($result->num_rows > 0) {
        // Book is available, insert book request into book_requests table
        $sql = "INSERT INTO book_requests (title, author, genre, description, status, created_at, userName) VALUES ('$title', '$author', '$genre', '$description', '$status', '$created_at', '$username')";

        if ($conn->query($sql) === TRUE) {
            echo "Book request submitted successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // Book is not available, display error message
        echo "Requesting isn't available at the moment for this book.";
    }

    $conn->close();
} else {
    // Required fields are not set, return error message
    echo "Error: Required fields are not set.";
}
?>
