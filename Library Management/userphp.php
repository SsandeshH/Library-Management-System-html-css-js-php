<?php
session_start(); // Start the session

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input
    $username = $_POST['username'];
    $password = $_POST['password'];

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

    // Check if user exists in the database
    $sql = "SELECT * FROM registerData WHERE (email='$username' OR username='$username') AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User exists, set session and redirect to user dashboard
        $_SESSION['username'] = $username; // Save username in session
        header("Location: userPage.html"); // Redirect to userPage.php
        exit();
    } else {
        // User does not exist, redirect back to user login page with error flag in URL
        header("Location: userLogin.html?error=1");
        exit();
    }

    $conn->close();
}
?>
