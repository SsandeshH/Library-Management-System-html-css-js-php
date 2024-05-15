<?php

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "lmsdb"; 


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['id'])) {
    $bookId = $_POST['id'];

    $sql = "DELETE FROM books WHERE id = $bookId";

    if ($conn->query($sql) === TRUE) {

        echo "Book record deleted successfully";
    } else {

        echo "Error deleting record: " . $conn->error;
    }
} else {

    echo "Book ID not provided";
}

$conn->close();
?>
