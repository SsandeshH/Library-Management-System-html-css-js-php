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
  
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $description = $_POST['description'];
    $available = isset($_POST['available']) ? 1 : 0;

  
    $sql = "INSERT INTO books (title, author, genre, description, available) VALUES ('$title', '$author', '$genre', '$description', '$available')";

    if ($conn->query($sql) === TRUE) {
    
        echo "New book added successfully";
    } else {
       
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close database connection
$conn->close();
?>
