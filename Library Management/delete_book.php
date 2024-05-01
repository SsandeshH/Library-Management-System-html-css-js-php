<?php
// Database connection details
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$dbname = "lmsdbbooks"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the book ID is provided in the request
if (isset($_POST['id'])) {
    $bookId = $_POST['id'];

    // Prepare SQL statement to delete the book record
    $sql = "DELETE FROM books WHERE id = $bookId";

    if ($conn->query($sql) === TRUE) {
        // Book record deleted successfully
        echo "Book record deleted successfully";
    } else {
        // Error occurred while deleting the book record
        echo "Error deleting record: " . $conn->error;
    }
} else {
    // No book ID provided in the request
    echo "Book ID not provided";
}

// Close database connection
$conn->close();
?>
