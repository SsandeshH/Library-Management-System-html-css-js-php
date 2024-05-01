<?php

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "lmsdbbooks"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$id = $_POST['id'];
$title = $_POST['title'];
$author = $_POST['author'];
$genre = $_POST['genre'];
$available = $_POST['available']; 


$sql = "UPDATE books SET title='$title', author='$author', genre='$genre', available='$available' WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    header("Location: admin_dashboard.php");
    exit();
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>
