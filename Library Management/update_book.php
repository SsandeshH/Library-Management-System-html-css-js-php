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

// Get form data
$id = $_POST['id'];
$title = $_POST['title'];
$author = $_POST['author'];
$genre = $_POST['genre'];
$available = $_POST['available']; // Check if the checkbox is checked

// Update the record in the database
$sql = "UPDATE books SET title='$title', author='$author', genre='$genre', available='$available' WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    // Redirect back to the admin dashboard page
    header("Location: admin_dashboard.php");
    exit();
} else {
    echo "Error updating record: " . $conn->error;
}

// Close database connection
$conn->close();
?>
