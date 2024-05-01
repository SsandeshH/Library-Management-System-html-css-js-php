<?php
// Database configuration
$servername = "localhost";
$username = "root"; // Default username for XAMPP
$password = ""; // Default password for XAMPP
$dbname = "lmsDb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user input from registration form
$email = $_POST['email'];
$username= $_POST['username'];
$password = $_POST['password']; // NOTE: In production, password should be hashed for security

// Prepare SQL statement to insert user into database
$sql = "INSERT INTO registerdata (email,username, password) VALUES ('$email', '$username' ,'$password')";


// Your database connection and insertion code here...

if ($conn->query($sql) === TRUE) {
    // Registration successful
    session_start();
    $_SESSION['registration_success'] = true;
    $redirect_delay = 3; // Delay in seconds before redirection
    header("refresh:$redirect_delay;url=index.html"); // Redirect to the index page after the delay
    echo "Registration successful! You will be redirected to the homepage in $redirect_delay seconds.";
    exit();
} else {
    // Registration failed
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>


$conn->close();
?>
